<?php

// auto-loading fix
Yii::setPathOfAlias('P3PageTranslation', dirname(__FILE__));
Yii::import('P3PageTranslation.*');

class P3PageTranslation extends BaseP3PageTranslation {

    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function init() {
        return parent::init();
    }

    public function __toString() {
        return (string) $this->language;
    }

    public function behaviors() {
        return array_merge(parent::behaviors(), array(
            ));
    }

    public function rules() {
        return array_merge(
                array(
                array('seoUrl', 'match', 'pattern' => '/^[a-z0-9\-]+$/', 'message' => 'SEO URL must only conatin lowercase characters, numbers and dashes'),
                ), parent::rules()
        );
    }

}
