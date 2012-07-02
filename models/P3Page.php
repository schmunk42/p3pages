<?php

// auto-loading fix
Yii::setPathOfAlias('P3Page', dirname(__FILE__));
Yii::import('P3Page.*');

class P3Page extends BaseP3Page {

    const PAGE_ID_KEY = 'pageId';
    const PAGE_NAME_KEY = 'pageName';

    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function init() {
        return parent::init();
    }

    public function __toString() {
        return (string) $this->layout;
    }

    public function behaviors() {
        return array_merge(
                array(
                #'JSON' => array(
                #'class' => 'ext.phundament.p3extensions.behaviors.P3JSONBehavior',
                #),
                'MetaData' => array(
                    'class' => 'ext.phundament.p3extensions.behaviors.P3MetaDataBehavior',
                    'metaDataRelation' => 'p3PageMeta',
                    'parentRelation' => 'treeParent',
                    'childrenRelation' => 'p3PageMetas',
                    'contentRelation' => 'id0',
                ),
                'Translation' => array(
                    'class' => 'ext.phundament.p3extensions.behaviors.P3TranslationBehavior',
                    'relation' => 'p3PageTranslations',
                    'fallbackLanguage' => (isset(Yii::app()->params['p3.fallbackLanguage'])) ? Yii::app()->params['p3.fallbackLanguage'] : 'en',
                    'fallbackIndicator' => array('menuName'=>' *'),
                    'fallbackValue' => 'Page*',

                //'attributesBlacklist' => array('loadfrom'),
                )
                ), parent::behaviors()
        );
    }

    public function rules() {
        return array_merge(
                /* array('column1, column2', 'rule'), */
                parent::rules()
        );
    }

    public function createUrl($additionalParams = array(), $absolute = false) {

        if ($this->id == 1) {
            return Yii::app()->homeUrl;
        } elseif (is_array(CJSON::decode($this->route)) && count(CJSON::decode($this->route)) !== 0) {
            $link = CJSON::decode($this->route);
        } elseif ($this->route && $this->route !== "{}") { // omit JSON ediotr defaults
            return $this->route;
        } else {
            $link['route'] = '/p3pages/default/page';
            $link['params'] = CMap::mergeArray($additionalParams, array(P3Page::PAGE_ID_KEY => $this->id, P3Page::PAGE_NAME_KEY => $this->t('seoUrl')));
        }

        if (isset($link['route'])) {
            $params = (isset($link['params'])) ? $link['params'] : array();
            if ($absolute === true)
                return Yii::app()->controller->createAbsoluteUrl($link['route'], $params);
            else
                return Yii::app()->controller->createUrl($link['route'], $params);
        } else {
            #echo $this->id."---";
            throw new Exception('Could not determine URL string.');
        }
    }

    public function get_label() {
        return "#". $this->id . ' ' . $this->t('menuName', null, true);
    }

    public function isActive() {
        return (self::getActivePage()->id == $this->id);
    }

    public static function getActivePage() {
        static $page;

        if (isset($page)) {
            return $page;
        } elseif (isset($_GET[P3Page::PAGE_ID_KEY])) {
            return $page = P3Page::model()->findByPk($_GET[P3Page::PAGE_ID_KEY]);
        } elseif (isset($_GET[P3Page::PAGE_NAME_KEY])) {
            return $page = P3Page::model()->findByAttributes(array('name' => $_GET[P2Page::PAGE_NAME_KEY]));
        } else {
            // try to find page via route
            $criteria = new CDbCriteria;
            $criteria->condition = "route LIKE :route";
            $criteria->params = array(':route'=>"%".Yii::app()->controller->route."%");
            $model = P3Page::model()->find($criteria);

            if ($model !== null) {
                return $model;
            } else {
                return new P3Page;
            }
        }
    }

    static public function getMenuItems($rootNode) {
        #$models = P3Page::model()->findAll();
        #$rootNode = P3Page::model()->findByAttributes(array('layout'=>'_BootMenu'));
        if (!$rootNode instanceof P3Page) {
            Yii::log('Invalid root node', CLogger::LEVEL_WARNING);
            return array();
        }
        $models = $rootNode->getChildren();
        $items = array();
        foreach ($models AS $model) {
            $items[] = array('label' => $model->t('menuName', null, true), 'url' => $model->createUrl(), 'active' => $model->isActive());
        }
        return $items;
    }

}
