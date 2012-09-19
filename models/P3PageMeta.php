<?php

// auto-loading fix
Yii::setPathOfAlias('P3PageMeta', dirname(__FILE__));
Yii::import('P3PageMeta.*');

class P3PageMeta extends BaseP3PageMeta {

    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function init() {
        return parent::init();
    }

    public function __toString() {
        return (string) $this->type;
    }

    public function behaviors() {
        return array_merge(
                array(
                'MetaData' => array(
                    'class' => 'P3MetaDataBehavior',
                    'metaDataRelation' => '_self_',
                ),
                ), parent::behaviors()
        );
    }

    public function rules() {
        return array_merge(
                /* array('column1, column2', 'rule'), */
                parent::rules()
        );
    }

    public function get_label() {
        return '#' . $this->id0->id . ' ' . $this->id0->t('menuName', Yii::app()->language, Yii::app()->params['p3.fallbackLanguage']);
    }

}
