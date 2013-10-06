<?php

/**
 * This is the model base class for the table "p3_page".
 *
 * Columns in table "p3_page" available as properties of the model:
 * @property integer $id
 * @property string $default_menu_name
 * @property string $status
 * @property integer $tree_parent_id
 * @property integer $tree_position
 * @property string $name_id
 * @property string $default_url_param
 * @property string $default_page_title
 * @property string $layout
 * @property string $view
 * @property string $url_json
 * @property string $default_keywords
 * @property string $default_description
 * @property string $custom_data_json
 * @property string $access_owner
 * @property string $access_domain
 * @property string $access_read
 * @property string $access_update
 * @property string $access_delete
 * @property string $access_append
 * @property integer $copied_from_id
 * @property string $created_at
 * @property string $updated_at
 *
 * Relations of table "p3_page" available as properties of the model:
 * @property P3Page $treeParent
 * @property P3Page[] $p3Pages
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
            parent::rules(), array(
                array('default_menu_name, status, access_owner, access_domain', 'required'),
                array('tree_parent_id, tree_position, name_id, default_url_param, default_page_title, layout, view, url_json, default_keywords, default_description, custom_data_json, access_read, access_update, access_delete, access_append, copied_from_id, created_at, updated_at', 'default', 'setOnEmpty' => true, 'value' => null),
                array('tree_parent_id, tree_position, copied_from_id', 'numerical', 'integerOnly' => true),
                array('default_menu_name, layout, view', 'length', 'max' => 128),
                array('status', 'length', 'max' => 32),
                array('name_id, access_owner', 'length', 'max' => 64),
                array('default_url_param, default_page_title', 'length', 'max' => 255),
                array('access_domain', 'length', 'max' => 8),
                array('access_read, access_update, access_delete, access_append', 'length', 'max' => 256),
                array('url_json, default_keywords, default_description, custom_data_json, created_at, updated_at', 'safe'),
                array('id, default_menu_name, status, tree_parent_id, tree_position, name_id, default_url_param, default_page_title, layout, view, url_json, default_keywords, default_description, custom_data_json, access_owner, access_domain, access_read, access_update, access_delete, access_append, copied_from_id, created_at, updated_at', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->default_menu_name;
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
            'treeParent' => array(self::BELONGS_TO, 'P3Page', 'tree_parent_id'),
            'p3Pages' => array(self::HAS_MANY, 'P3Page', 'tree_parent_id'),
            'p3PageTranslations' => array(self::HAS_MANY, 'P3PageTranslation', 'p3_page_id', 'index' => 'language'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('P3PagesModule.model', 'ID'),
            'default_menu_name' => Yii::t('P3PagesModule.model', 'Default Menu Name'),
            'status' => Yii::t('P3PagesModule.model', 'Status'),
            'tree_parent_id' => Yii::t('P3PagesModule.model', 'Tree Parent'),
            'tree_position' => Yii::t('P3PagesModule.model', 'Tree Position'),
            'name_id' => Yii::t('P3PagesModule.model', 'Name'),
            'default_url_param' => Yii::t('P3PagesModule.model', 'Default Url Param'),
            'default_page_title' => Yii::t('P3PagesModule.model', 'Default Page Title'),
            'layout' => Yii::t('P3PagesModule.model', 'Layout'),
            'view' => Yii::t('P3PagesModule.model', 'View'),
            'url_json' => Yii::t('P3PagesModule.model', 'Url Json'),
            'default_keywords' => Yii::t('P3PagesModule.model', 'Default Keywords'),
            'default_description' => Yii::t('P3PagesModule.model', 'Default Description'),
            'custom_data_json' => Yii::t('P3PagesModule.model', 'Custom Data Json'),
            'access_owner' => Yii::t('P3PagesModule.model', 'Access Owner'),
            'access_domain' => Yii::t('P3PagesModule.model', 'Access Domain'),
            'access_read' => Yii::t('P3PagesModule.model', 'Access Read'),
            'access_update' => Yii::t('P3PagesModule.model', 'Access Update'),
            'access_delete' => Yii::t('P3PagesModule.model', 'Access Delete'),
            'access_append' => Yii::t('P3PagesModule.model', 'Access Append'),
            'copied_from_id' => Yii::t('P3PagesModule.model', 'Copied From'),
            'created_at' => Yii::t('P3PagesModule.model', 'Created At'),
            'updated_at' => Yii::t('P3PagesModule.model', 'Updated At'),
        );
    }

    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.default_menu_name', $this->default_menu_name, true);
        $criteria->compare('t.status', $this->status, true);
        $criteria->compare('t.tree_parent_id', $this->tree_parent_id);
        $criteria->compare('t.tree_position', $this->tree_position);
        $criteria->compare('t.name_id', $this->name_id, true);
        $criteria->compare('t.default_url_param', $this->default_url_param, true);
        $criteria->compare('t.default_page_title', $this->default_page_title, true);
        $criteria->compare('t.layout', $this->layout, true);
        $criteria->compare('t.view', $this->view, true);
        $criteria->compare('t.url_json', $this->url_json, true);
        $criteria->compare('t.default_keywords', $this->default_keywords, true);
        $criteria->compare('t.default_description', $this->default_description, true);
        $criteria->compare('t.custom_data_json', $this->custom_data_json, true);
        $criteria->compare('t.access_owner', $this->access_owner, true);
        $criteria->compare('t.access_domain', $this->access_domain, true);
        $criteria->compare('t.access_read', $this->access_read, true);
        $criteria->compare('t.access_update', $this->access_update, true);
        $criteria->compare('t.access_delete', $this->access_delete, true);
        $criteria->compare('t.access_append', $this->access_append, true);
        $criteria->compare('t.copied_from_id', $this->copied_from_id);
        $criteria->compare('t.created_at', $this->created_at, true);
        $criteria->compare('t.updated_at', $this->updated_at, true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

}
