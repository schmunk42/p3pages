<?php

/**
 * This is the model base class for the table "p3_page_translation".
 * Columns in table "p3_page_translation" available as properties of the model:
 * @property integer $id
 * @property integer $p3_page_id
 * @property string  $language
 * @property string  $seoUrl
 * @property string  $pageTitle
 * @property string  $menuName
 * @property string  $keywords
 * @property string  $description
 *           Relations of table "p3_page_translation" available as properties of the model:
 * @property P3Page  $p3Page
 * @package  p3pages.models
 * @category db.ar
 */
abstract class BaseP3PageTranslation extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'p3_page_translation';
    }

    public function rules()
    {
        return array(
            array('p3_page_id, menuName', 'required'),
            array(
                'language, seoUrl, pageTitle, keywords, description',
                'default',
                'setOnEmpty' => true,
                'value'      => null
            ),
            array('p3_page_id', 'numerical', 'integerOnly' => true),
            array('language', 'length', 'max' => 8),
            array('seoUrl, pageTitle', 'length', 'max' => 255),
            array('menuName', 'length', 'max' => 128),
            array('keywords, description', 'safe'),
            array(
                'id, p3_page_id, language, seoUrl, pageTitle, menuName, keywords, description',
                'safe',
                'on' => 'search'
            ),
        );
    }

    public function relations()
    {
        return array(
            'p3Page' => array(self::BELONGS_TO, 'P3Page', 'p3_page_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id'          => Yii::t('P3PagesModule.crud', 'ID'),
            'p3_page_id'  => Yii::t('P3PagesModule.crud', 'P3 Page'),
            'language'    => Yii::t('P3PagesModule.crud', 'Language'),
            'seoUrl'      => Yii::t('P3PagesModule.crud', 'SEO URL'),
            'pageTitle'   => Yii::t('P3PagesModule.crud', 'Page Title'),
            'menuName'    => Yii::t('P3PagesModule.crud', 'Menu Name'),
            'keywords'    => Yii::t('P3PagesModule.crud', 'Keywords'),
            'description' => Yii::t('P3PagesModule.crud', 'Description'),
        );
    }


    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('p3_page_id', $this->p3_page_id);
        $criteria->compare('language', $this->language, true);
        $criteria->compare('seoUrl', $this->seoUrl, true);
        $criteria->compare('pageTitle', $this->pageTitle, true);
        $criteria->compare('menuName', $this->menuName, true);
        $criteria->compare('keywords', $this->keywords, true);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider(get_class($this), array(
                                                              'criteria' => $criteria,
                                                         ));
    }

    public function get_label()
    {
        return '#' . $this->id;

    }

}
