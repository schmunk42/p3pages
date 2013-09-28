<?php

// auto-loading
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

    public function getItemLabel()
    {
        return parent::getItemLabel();
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            array(
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

}
