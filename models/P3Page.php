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

    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
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
                 'MetaData'    => array(
                     'class'            => 'P3MetaDataBehavior',
                     'metaDataRelation' => 'p3PageMeta',
                     'parentRelation'   => 'treeParent',
                     'childrenRelation' => 'p3PageMetas',
                     'contentRelation'  => 'id0',
                 ),
                 'Translation' => array(
                     'class'             => 'P3TranslationBehavior',
                     'relation'          => 'p3PageTranslations',
                     'fallbackLanguage'  => (isset(Yii::app()->params['p3.fallbackLanguage'])) ?
                         Yii::app()->params['p3.fallbackLanguage'] : 'en',
                     'fallbackIndicator' => array('menuName' => ' *'),
                     'fallbackValue'     => 'Page*',
                 )
            ), parent::behaviors()
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
                     'pattern' => '/^[a-zA-Z0-9-]*$/',
                     'message' => 'May only container letters numbers and dashes'
                 ),
            ),
            parent::rules()
        );
    }

    public function createUrl($additionalParams = array(), $absolute = false)
    {

        if (is_array(CJSON::decode($this->route)) && count(CJSON::decode($this->route)) !== 0) {
            $link = CJSON::decode($this->route);
        }
        else {
            $link['route']  = '/p3pages/default/page';
            $link['params'] = CMap::mergeArray($additionalParams, array(P3Page::PAGE_ID_KEY   => $this->id,
                                                                        P3Page::PAGE_NAME_KEY => $this->t('seoUrl')));
        }

        if (isset($link['route'])) {
            $params = (isset($link['params'])) ? $link['params'] : array();
            if ($absolute === true) {
                return Yii::app()->controller->createAbsoluteUrl($link['route'], $params);
            }
            else {
                return Yii::app()->controller->createUrl($link['route'], $params);
            }
        }
        elseif (isset($link['url'])) {
            return $link['url'];
        }
        else {
            Yii::log('Could not determine URL string for P3Page #' . $this->id, CLogger::LEVEL_WARNING);
        }
    }

    public function isActive()
    {
        if (self::getActivePage() !== null) {
            return (self::getActivePage()->id == $this->id);
        }
        else {
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
            $breadcrumbs[$model->t('menuName')] = ($withLinks)?$model->createUrl():null;
            $model         = $model->getParent();
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
            // do nothing when found, note it may be "null"
        }
        elseif (isset($_GET[P3Page::PAGE_ID_KEY])) {
            $_activePage = P3Page::model()->findByPk($_GET[P3Page::PAGE_ID_KEY]);
        }
        elseif (isset($_GET[P3Page::PAGE_NAME_KEY])) {
            $_activePage = P3Page::model()->findByAttributes(array('name' => $_GET[P3Page::PAGE_NAME_KEY]));
        }
        else {
            // try to find page via route
            $criteria            = new CDbCriteria;
            $criteria->condition = "route LIKE :route";
            $criteria->params    = array(':route' => "%" . Yii::app()->controller->route . "%");

            $_activePage = P3Page::model()->find($criteria);
        }

        return $_activePage;
    }

    static public function getMenuItems($rootNode, $maxDepth = null, $level = 0)
    {
        if (!$rootNode instanceof P3Page) {
            Yii::log('Invalid root node', CLogger::LEVEL_WARNING);

            return array();
        }

        $models = $rootNode->getChildren();
        $items  = array();
        foreach ($models AS $model) {
            if ($model->id == $rootNode->id) {
                //echo "recursion";
                break;
            }
            $item = array('label'       => $model->t('menuName', null, true),
                          'url'         => $model->createUrl(),
                          'nameId'      => $model->nameId,
                          'itemOptions' => ($model->nameId) ? array('class' => 'page-' . $model->nameId) : null,
                          'active'      => ($model->isActive() || $model->isActiveParent()));

            if (($maxDepth !== null && $maxDepth <= $level) || $model->getMenuItems($model) === array()) {
                // do nothing
            }
            else {
                $item['items'] = $model->getMenuItems($model, $maxDepth, $level + 1);
            }

            $items[] = $item;
        }

        return $items;
    }

}
