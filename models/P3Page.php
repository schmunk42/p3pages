<?php

// auto-loading
Yii::setPathOfAlias('P3Page', dirname(__FILE__));
Yii::import('P3Page.*');

class P3Page extends BaseP3Page
{
    const PAGE_ID_KEY   = 'pageId';
    const PAGE_NAME_KEY = 'pageName';

    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function init()
    {
        return parent::init();
    }

    public function getItemLabel()
    {
        return parent::getItemLabel();
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            array(
                 'Access'        => array(
                     'class' => '\PhAccessBehavior'
                 ),
                 'AdjacencyList' => array(
                     'class'            => '\AdjacencyListBehavior',
                     'parentAttribute'  => 'tree_parent_id',
                     'parentRelation'   => 'treeParent',
                     'childrenRelation' => 'p3Pages'
                 ),
                 'Translatable'  => array(
                     'class'                 => 'vendor.mikehaertl.translatable.Translatable',
                     'translationAttributes' => array(
                         'menu_name',
                         'page_title',
                         'url_param',
                         'keywords',
                         'description'
                     ),
                     'translationRelation'   => 'p3PageTranslations',
                     'fallbackColumns'       => array(
                         'menu_name'   => 'default_menu_name',
                         'page_title'  => 'default_page_title',
                         'url_param'   => 'default_url_param',
                         'keywords'    => 'default_keywords',
                         'description' => 'default_description',
                     ),
                 ),
                 'Timestamp' => array(
                     'class'             => 'zii.behaviors.CTimestampBehavior',
                     'createAttribute'   => 'created_at',
                     'updateAttribute'   => 'updated_at',
                     'setUpdateOnCreate' => true,
                 ),
            )
        );
    }

    public function rules()
    {
        return array_merge(
            parent::rules()
        /* , array(
          array('column1, column2', 'rule1'),
          array('column3', 'rule2'),
          ) */
        );
    }

    public function createUrl($additionalParams = array(), $absolute = false)
    {

        if (is_array(CJSON::decode($this->url_json)) && count(CJSON::decode($this->url_json)) !== 0) {
            $link = CJSON::decode($this->url_json);
        } else {
            $link['route']  = '/p3pages/default/page';
            $link['params'] = CMap::mergeArray(
                $additionalParams,
                array(
                     P3Page::PAGE_ID_KEY   => $this->id,
                     P3Page::PAGE_NAME_KEY => $this->url_param
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

    public function getBreadcrumbs($withLinks = true)
    {
        $model       = $this;
        $breadcrumbs = array();

        while ($model->getParent()) {
            $breadcrumbs[$model->menu_name] = ($withLinks) ? $model->createUrl() : null;
            $model                          = $model->getParent();
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
            $_activePage = P3Page::model()->localized()->findByAttributes(
                array('nameId' => $_GET[P3Page::PAGE_NAME_KEY])
            );
            $_traceMsg   = ' found by nameId';
        } else {
            // try to find page via route
            $criteria            = new CDbCriteria;
            $criteria->condition = "url_json LIKE :route";
            $criteria->params    = array(':route' => "%" . Yii::app()->controller->route . "%");
            #TODO: $criteria->mergeWith(P3Page::model()->localized()->getDbCriteria()); // obtain scope from behavior
            $_activePage = P3Page::model()->find($criteria);
            $_traceMsg   = " found by route '" . Yii::app()->controller->route . "'";
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

        $cacheId = "p3pages.models.menuItems." . Yii::app()->language . ".{$rootNode->id}.{$maxDepth}.{$level}";
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
            $itemOptions                = array();
            $itemOptions['data-pageId'] = $model->id;
            if (!empty($model->nameId)) {
                $itemOptions['data-pageNameId'] = $model->nameId;
                $itemOptions['class']           = 'page-' . $model->nameId;
            }
            $item = array(
                'label'       => $model->menu_name,
                'url'         => $model->createUrl(),
                'nameId'      => $model->name_id,
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

        $depBase    = new CDbCacheDependency("SELECT MAX(p3_page_meta.modifiedAt) FROM p3_page_meta");
        $depTrans   = new CDbCacheDependency("SELECT MAX(p3_page_translation.modifiedAt) FROM p3_page_translation");
        $depDelete  = New CGlobalStateCacheDependency('p3extensions.behaviors.P3MetaDataBehavior:lastDelete:p3_page');
        $dependency = new CChainedCacheDependency(array($depBase, $depTrans, $depDelete));

        Yii::trace("Saving menu items ({$cacheId}) to cache", "p3pages.models.P3Page");
        Yii::app()->cache->set($cacheId, $items, 0, $dependency);

        return $items;
    }
}
