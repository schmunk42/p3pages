<?php

/**
 * This is the model base class for the table "p3_page".
 * Columns in table "p3_page" available as properties of the model:
 * @property integer             $id
 * @property string              $layout
 * @property string              $view
 * @property string              $route
 * @property string              $nameId
 * Relations of table "p3_page" available as properties of the model:
 * @property P3PageMeta          $p3PageMeta
 * @property P3PageTranslation[] $p3PageTranslations
 */
abstract class BaseP3Page extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'p3_page';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(),
            array(
                 array('layout, view, route, nameId', 'default', 'setOnEmpty' => true, 'value' => null),
                 array('layout, view', 'length', 'max' => 128),
                 array('route', 'length', 'max' => 255),
                 array('nameId', 'length', 'max' => 64),
                 array('id, layout, view, route, nameId', 'safe', 'on' => 'search'),
            )
        );
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            array(
                 'savedRelated' => array(
                     'class' => '\GtcSaveRelationsBehavior'
                 )
            )
        );
    }

    public function relations()
    {
        return array(
            'p3PageMeta'         => array(self::HAS_ONE, 'P3PageMeta', 'id'),
            'p3PageTranslations' => array(self::HAS_MANY, 'P3PageTranslation', 'p3_page_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id'     => Yii::t('P3PagesModule.crud', 'ID'),
            'layout' => Yii::t('P3PagesModule.crud', 'Layout'),
            'view'   => Yii::t('P3PagesModule.crud', 'View'),
            'route'  => Yii::t('P3PagesModule.crud', 'Route'),
            'nameId' => Yii::t('P3PagesModule.crud', 'Name'),
        );
    }


    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.layout', $this->layout, true);
        $criteria->compare('t.view', $this->view, true);
        $criteria->compare('t.route', $this->route, true);
        $criteria->compare('t.nameId', $this->nameId, true);

        return new CActiveDataProvider(get_class($this), array(
                                                              'criteria' => $criteria,
                                                         ));
    }

}
