<?php
/**
 * P3Page is the model class for page node translations
 * @author   Tobias Munk <schmunk@usrbin.de>
 * @package  p3pages.models
 * @category db.ar
 */

// auto-loading fix
Yii::setPathOfAlias('P3PageTranslation', dirname(__FILE__));
Yii::import('P3PageTranslation.*');

class P3PageTranslation extends BaseP3PageTranslation
{

    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function init()
    {
        return parent::init();
    }

    public function __toString()
    {
        return (string)$this->language;
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            array(
                 'Timestamp' => array(
                     'class'             => 'zii.behaviors.CTimestampBehavior',
                     'createAttribute'   => 'createdAt',
                     'updateAttribute'   => 'modifiedAt',
                     'setUpdateOnCreate' => true,
                 ),
            )
        );
    }

    public function rules()
    {
        return array_merge(
            array(
                 array(
                     'seoUrl',
                     'match',
                     'pattern' => '/^[a-z0-9_\-]+$/',
                     'message' => Yii::t(
                         'P3PagesModule.crud',
                         'SEO URL must only contain lowercase characters, numbers, underscores and dashes'
                     )
                 ),
            ),
            parent::rules()
        );
    }

}
