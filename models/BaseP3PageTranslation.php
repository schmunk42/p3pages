<?php

/**
 * This is the model base class for the table "p3_page_translation".
 *
 * Columns in table "p3_page_translation" available as properties of the model:
 * @property integer $id
 * @property integer $p3_page_id
 * @property integer $status
 * @property string $language
 * @property string $menu_name
 * @property string $page_title
 * @property string $url_param
 * @property string $keywords
 * @property string $description
 * @property string $access_owner
 * @property string $access_read
 * @property string $access_update
 * @property string $access_delete
 * @property string $created_at
 * @property string $updated_at
 * @property integer $copied_from_id
 *
 * Relations of table "p3_page_translation" available as properties of the model:
 * @property P3Page $p3Page
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
        return array_merge(
            parent::rules(), array(
                array('p3_page_id, status, language, menu_name, created_at', 'required'),
                array('page_title, url_param, keywords, description, access_owner, access_read, access_update, access_delete, updated_at, copied_from_id', 'default', 'setOnEmpty' => true, 'value' => null),
                array('p3_page_id, status, copied_from_id', 'numerical', 'integerOnly' => true),
                array('language', 'length', 'max' => 8),
                array('menu_name', 'length', 'max' => 128),
                array('page_title, url_param', 'length', 'max' => 255),
                array('access_owner', 'length', 'max' => 64),
                array('access_read, access_update, access_delete', 'length', 'max' => 256),
                array('keywords, description, updated_at', 'safe'),
                array('id, p3_page_id, status, language, menu_name, page_title, url_param, keywords, description, access_owner, access_read, access_update, access_delete, created_at, updated_at, copied_from_id', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->language;
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(), array(
                'savedRelated' => array(
                    'class' => '\GtcSaveRelationsBehavior'
                )
            )
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
            'id' => Yii::t('P3PagesModule.crud', 'ID'),
            'p3_page_id' => Yii::t('P3PagesModule.crud', 'P3 Page'),
            'status' => Yii::t('P3PagesModule.crud', 'Status'),
            'language' => Yii::t('P3PagesModule.crud', 'Language'),
            'menu_name' => Yii::t('P3PagesModule.crud', 'Menu Name'),
            'page_title' => Yii::t('P3PagesModule.crud', 'Page Title'),
            'url_param' => Yii::t('P3PagesModule.crud', 'Url Param'),
            'keywords' => Yii::t('P3PagesModule.crud', 'Keywords'),
            'description' => Yii::t('P3PagesModule.crud', 'Description'),
            'access_owner' => Yii::t('P3PagesModule.crud', 'Access Owner'),
            'access_read' => Yii::t('P3PagesModule.crud', 'Access Read'),
            'access_update' => Yii::t('P3PagesModule.crud', 'Access Update'),
            'access_delete' => Yii::t('P3PagesModule.crud', 'Access Delete'),
            'created_at' => Yii::t('P3PagesModule.crud', 'Created At'),
            'updated_at' => Yii::t('P3PagesModule.crud', 'Updated At'),
            'copied_from_id' => Yii::t('P3PagesModule.crud', 'Copied From'),
        );
    }

    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.p3_page_id', $this->p3_page_id);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('t.language', $this->language, true);
        $criteria->compare('t.menu_name', $this->menu_name, true);
        $criteria->compare('t.page_title', $this->page_title, true);
        $criteria->compare('t.url_param', $this->url_param, true);
        $criteria->compare('t.keywords', $this->keywords, true);
        $criteria->compare('t.description', $this->description, true);
        $criteria->compare('t.access_owner', $this->access_owner, true);
        $criteria->compare('t.access_read', $this->access_read, true);
        $criteria->compare('t.access_update', $this->access_update, true);
        $criteria->compare('t.access_delete', $this->access_delete, true);
        $criteria->compare('t.created_at', $this->created_at, true);
        $criteria->compare('t.updated_at', $this->updated_at, true);
        $criteria->compare('t.copied_from_id', $this->copied_from_id);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

}
