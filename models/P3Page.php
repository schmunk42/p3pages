<?php
/**
 * P3Page is the model class for page nodes
 * @author   Tobias Munk <schmunk@usrbin.de>
 * @package  p3pages.models
 * @category db.ar
 */

// auto-loading fix
Yii::setPathOfAlias('P3Page', dirname(__FILE__));
Yii::import('P3Page.*');

class P3Page extends BaseP3Page
{
    const PAGE_ID_KEY   = 'pageId';
    const PAGE_NAME_KEY = 'pageName';

    public function get_label()
    {
        return $this->t('menuName', null, true) . " #" . $this->id;
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function init()
    {
        return parent::init();
    }

    public function defaultScope()
    {
        return array('with' => array('p3PageMeta', 'p3PageTranslations'));
    }

    public function behaviors()
    {
        return array_merge(
            array(
                 'MetaData' => array(
                     'class'            => 'P3MetaDataBehavior',
                     'metaDataRelation' => 'p3PageMeta',
                     'parentRelation'   => 'treeParent',
                     'childrenRelation' => 'p3PageMetas',
                     'contentRelation'  => 'id0',
                     'defaultLanguage'  => (Yii::app()->params['P3Page.defaultLanguage']) ?
                         Yii::app()->params['P3Page.defaultLanguage'] : P3MetaDataBehavior::ALL_LANGUAGES,
                     'defaultStatus'    => (Yii::app()->params['P3Page.defaultStatus']) ?
                         Yii::app()->params['P3Page.defaultStatus'] : P3MetaDataBehavior::STATUS_ACTIVE,
                 ),
                 'Translation' => array(
                     'class'             => 'P3TranslationBehavior',
                     'relation'          => 'p3PageTranslations',
                     'fallbackLanguage'  => (isset(Yii::app()->params['P3Page.fallbackLanguage'])) ?
                         Yii::app()->params['P3Page.fallbackLanguage'] : Yii::app()->sourceLanguage,
                     'fallbackIndicator' => (isset(Yii::app()->params['P3Page.fallbackIndicator'])) ?
                         Yii::app()->params['P3Page.fallbackIndicator'] : array('menuName' => ' *'),
                     'fallbackValue'     => (isset(Yii::app()->params['P3Page.fallbackValue'])) ?
                         Yii::app()->params['P3Page.fallbackValue'] : "[Page Name]",
                 )
            ),
            parent::behaviors()
        );
    }

    public function rules()
    {
        return array_merge(
            array(
                 array(
                     'route',
                     'match',
                     'pattern' => '/"route":"|"url":"|{}/',
                     'message' => 'If not empty, route JSON must contain a \'route\' or \'url\' element'
                 ),
            ),
            array(
                 array(
                     'nameId',
                     'match',
                     'pattern' => '/^[a-zA-Z0-9-_]*$/',
                     'message' => 'May only container letters numbers, underscores and dashes'
                 ),
            ),
            parent::rules()
        );
    }

    public function createUrl($additionalParams = array(), $absolute = false)
    {

        if (is_array(CJSON::decode($this->route)) && count(CJSON::decode($this->route)) !== 0) {
            $link = CJSON::decode($this->route);
        } else {
            $link['route']  = '/p3pages/default/page';
            $link['params'] = CMap::mergeArray(
                $additionalParams,
                array(
                     P3Page::PAGE_ID_KEY   => $this->id,
                     P3Page::PAGE_NAME_KEY => $this->t('seoUrl')
                )
            );
        }

        if (isset($link['route'])) {
            $params = (isset($link['params'])) ? $link['params'] : array();
            if ($absolute === true) {
                return Yii::app()->controller->createAbsoluteUrl($link['route'], $params);
            } else {
                return Yii::app()->controller->createUrl($link['route'], $params);
            }
        } elseif (isset($link['url'])) {
            return $link['url'];
        } else {
            Yii::log('Could not determine URL string for P3Page #' . $this->id, CLogger::LEVEL_WARNING);
        }
    }

    public function isActive()
    {
        if (self::getActivePage() !== null) {
            return (self::getActivePage()->id == $this->id);
        } else {
            return false;
        }
    }

    public function isActiveParent($model = null)
    {
        if ($model === null) {
            $model = $this;
        }
        if (count($model->getChildren())) {
            foreach ($model->getChildren() AS $childModel) {
                if ((self::getActivePage()) && $childModel->id === self::getActivePage()->id) {
                    return true;
                }
                if (count($childModel->getChildren()) && $childModel) {
                    return $this->isActiveParent($childModel);
                }
            }
        }

        return false;
    }

    public function getBreadcrumbs($withLinks = true)
    {
        $model       = $this;
        $breadcrumbs = array();

        while ($model->getParent()) {
            $breadcrumbs[$model->t('menuName')] = ($withLinks) ? $model->createUrl() : null;
            $model                              = $model->getParent();
        }
        $breadcrumbs = array_reverse($breadcrumbs);

        end($breadcrumbs);
        $menuName = key($breadcrumbs);
        array_pop($breadcrumbs);
        $breadcrumbs[] = $menuName;

        return $breadcrumbs;
    }

    static public function getActivePage()
    {
        static $_activePage = false;

        if ($_activePage !== false) {
            // just return the page when already found, note it may be "null"
            return $_activePage;
        } elseif (isset($_GET[P3Page::PAGE_ID_KEY])) {
            $_activePage = P3Page::model()->localized()->findByPk($_GET[P3Page::PAGE_ID_KEY]);
            $_traceMsg   = ' found by id';
        } elseif (isset($_GET[P3Page::PAGE_NAME_KEY])) {
            $_activePage = P3Page::model()->localized()->findByAttributes(array('nameId' => $_GET[P3Page::PAGE_NAME_KEY]));
            $_traceMsg   = ' found by nameId';
        } else {
            // try to find page via route
            $criteria            = new CDbCriteria;
            $criteria->condition = "route LIKE :route";
            $criteria->params    = array(':route' => "%" . Yii::app()->controller->route . "%");
            $criteria->mergeWith(P3Page::model()->localized()->getDbCriteria()); // obtain scope from behavior
            $_activePage         = P3Page::model()->find($criteria);
            $_traceMsg           = " found by route '" . Yii::app()->controller->route . "'";
        }

        if ($_activePage !== null) {
            Yii::trace("Active page #{$_activePage->id} " . $_traceMsg, 'p3pages.models');
        } else {
            Yii::trace("Active page not found in database", 'p3pages.models');
        }

        return $_activePage;
    }

    static public function getMenuItems($rootNode, $maxDepth = null, $level = 0)
    {
        if (!$rootNode instanceof P3Page) {
            Yii::log('Invalid root node', CLogger::LEVEL_WARNING);

            return array();
        }

        $cacheId = "p3pages.models.menuItems.".Yii::app()->language.".{$rootNode->id}.{$maxDepth}.{$level}";
        if ($cachedItems = Yii::app()->cache->get($cacheId)) {
            Yii::trace("Loading menu items ({$cacheId}) from cache", "p3pages.models.P3Page");
            return $cachedItems;
        }

        $models = $rootNode->getChildren();
        $items  = array();
        foreach ($models AS $model) {
            if ($model->id == $rootNode->id) {
                //echo "recursion";
                break;
            }

            // prepare node identifiers
            $itemOptions = array();
            $itemOptions['data-pageId'] = $model->id;
            if(!empty($model->nameId)) {
                $itemOptions['data-pageNameId'] = $model->nameId;
                $itemOptions['class'] = 'page-'.$model->nameId;
            }
            $item = array(
                'label'       => $model->t('menuName', null, true),
                'url'         => $model->createUrl(),
                'nameId'      => $model->nameId,
                'itemOptions' => $itemOptions,
                // check for active item is disabled since 0.14.0 because of performance issues,
                // select the active item via JavaScript and pageId data key
            );

            if (($maxDepth !== null && $maxDepth <= $level) || $model->getMenuItems($model) === array()) {
                // do nothing
            } else {
                $item['items'] = $model->getMenuItems($model, $maxDepth, $level + 1);
            }

            $items[] = $item;
        }

        // TODO: should check translation also(!!!)
        $dependency = new CDbCacheDependency("SELECT MAX(modifiedAt) FROM p3_page_meta");

        Yii::trace("Saving menu items ({$cacheId}) to cache", "p3pages.models.P3Page");
        Yii::app()->cache->set($cacheId, $items, 0, $dependency);

        return $items;
    }

    static public function registerSelectActivePageScript($selector = '')
    {
        $page = self::getActivePage();
        $pageId = ($page) ? $page->id : null;
        $script = "$('{$selector} *[data-pageId=\"{$pageId}\"]').addClass('active');";
        $script .= "$('{$selector} *[data-pageId=\"{$pageId}\"]').parent().parent().addClass('active');"; // TODO !!!!!!!
        Yii::app()->clientScript->registerScript('p3pages.models.P3Page.jsSelectActivePage', $script, CClientScript::POS_END);
    }

}
