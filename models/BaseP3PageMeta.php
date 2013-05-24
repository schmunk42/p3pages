<?php

/**
 * This is the model base class for the table "p3_page_meta".
 * Columns in table "p3_page_meta" available as properties of the model:
 * @property integer      $id
 * @property integer      $status
 * @property string       $type
 * @property string       $language
 * @property integer      $treeParent_id
 * @property integer      $treePosition
 * @property string       $begin
 * @property string       $end
 * @property string       $keywords
 * @property string       $customData
 * @property integer      $label
 * @property string       $owner
 * @property string       $checkAccessCreate
 * @property string       $checkAccessRead
 * @property string       $checkAccessUpdate
 * @property string       $checkAccessDelete
 * @property string       $createdAt
 * @property string       $createdBy
 * @property string       $modifiedAt
 * @property string       $modifiedBy
 * @property string       $guid
 * @property string       $ancestor_guid
 * @property string       $model
 *           Relations of table "p3_page_meta" available as properties of the model:
 * @property P3PageMeta   $treeParent
 * @property P3PageMeta[] $p3PageMetas
 * @property P3Page       $id0
 * @package  p3pages.models
 * @category db.ar
 */
abstract class BaseP3PageMeta extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'p3_page_meta';
    }

    public function rules()
    {
        return array(
            array('type', 'unique'),
            array('type', 'identificationColumnValidator'),
            array('id, createdAt', 'required'),
            array(
                'status, type, language, treeParent_id, treePosition, begin, end, keywords, customData, label, owner, checkAccessCreate, checkAccessRead, checkAccessUpdate, checkAccessDelete, createdBy, modifiedAt, modifiedBy, guid, ancestor_guid, model',
                'default',
                'setOnEmpty' => true,
                'value'      => null
            ),
            array('id, status, treeParent_id, treePosition, label', 'numerical', 'integerOnly' => true),
            array('type, owner, createdBy, modifiedBy, guid, ancestor_guid', 'length', 'max' => 64),
            array('language', 'length', 'max' => 8),
            array('checkAccessCreate, checkAccessRead, checkAccessUpdate, checkAccessDelete', 'length', 'max' => 256),
            array('model', 'length', 'max' => 128),
            array('begin, end, keywords, customData, modifiedAt', 'safe'),
            array(
                'id, status, type, language, treeParent_id, treePosition, begin, end, keywords, customData, label, owner, checkAccessCreate, checkAccessRead, checkAccessUpdate, checkAccessDelete, createdAt, createdBy, modifiedAt, modifiedBy, guid, ancestor_guid, model',
                'safe',
                'on' => 'search'
            ),
        );
    }

    public function relations()
    {
        return array(
            'treeParent'  => array(self::BELONGS_TO, 'P3PageMeta', 'treeParent_id'),
            'p3PageMetas' => array(self::HAS_MANY, 'P3PageMeta', 'treeParent_id', 'order' => 'treePosition'),
            'id0'         => array(self::BELONGS_TO, 'P3Page', 'id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id'                => Yii::t('P3PagesModule.crud', 'ID'),
            'status'            => Yii::t('P3PagesModule.crud', 'Status'),
            'type'              => Yii::t('P3PagesModule.crud', 'Type'),
            'language'          => Yii::t('P3PagesModule.crud', 'Language'),
            'treeParent_id'     => Yii::t('P3PagesModule.crud', 'Tree Parent'),
            'treePosition'      => Yii::t('P3PagesModule.crud', 'Tree Position'),
            'begin'             => Yii::t('P3PagesModule.crud', 'Begin'),
            'end'               => Yii::t('P3PagesModule.crud', 'End'),
            'keywords'          => Yii::t('P3PagesModule.crud', 'Keywords'),
            'customData'        => Yii::t('P3PagesModule.crud', 'Custom Data'),
            'label'             => Yii::t('P3PagesModule.crud', 'Label'),
            'owner'             => Yii::t('P3PagesModule.crud', 'Owner'),
            'checkAccessCreate' => Yii::t('P3PagesModule.crud', 'Check Access Create'),
            'checkAccessRead'   => Yii::t('P3PagesModule.crud', 'Check Access Read'),
            'checkAccessUpdate' => Yii::t('P3PagesModule.crud', 'Check Access Update'),
            'checkAccessDelete' => Yii::t('P3PagesModule.crud', 'Check Access Delete'),
            'createdAt'         => Yii::t('P3PagesModule.crud', 'Created At'),
            'createdBy'         => Yii::t('P3PagesModule.crud', 'Created By'),
            'modifiedAt'        => Yii::t('P3PagesModule.crud', 'Modified At'),
            'modifiedBy'        => Yii::t('P3PagesModule.crud', 'Modified By'),
            'guid'              => Yii::t('P3PagesModule.crud', 'GUID'),
            'ancestor_guid'     => Yii::t('P3PagesModule.crud', 'Ancestor GUID'),
            'model'             => Yii::t('P3PagesModule.crud', 'Model'),
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('status', $this->status);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('language', $this->language, true);
        $criteria->compare('treeParent_id', $this->treeParent_id);
        $criteria->compare('treePosition', $this->treePosition);
        $criteria->compare('begin', $this->begin, true);
        $criteria->compare('end', $this->end, true);
        $criteria->compare('keywords', $this->keywords, true);
        $criteria->compare('customData', $this->customData, true);
        $criteria->compare('label', $this->label);
        $criteria->compare('owner', $this->owner, true);
        $criteria->compare('checkAccessCreate', $this->checkAccessCreate, true);
        $criteria->compare('checkAccessRead', $this->checkAccessRead, true);
        $criteria->compare('checkAccessUpdate', $this->checkAccessUpdate, true);
        $criteria->compare('checkAccessDelete', $this->checkAccessDelete, true);
        $criteria->compare('createdAt', $this->createdAt, true);
        $criteria->compare('createdBy', $this->createdBy, true);
        $criteria->compare('modifiedAt', $this->modifiedAt, true);
        $criteria->compare('modifiedBy', $this->modifiedBy, true);
        $criteria->compare('guid', $this->guid, true);
        $criteria->compare('ancestor_guid', $this->ancestor_guid, true);
        $criteria->compare('model', $this->model, true);

        return new CActiveDataProvider(get_class($this), array(
                                                              'criteria' => $criteria,
                                                         ));
    }

    public function get_label()
    {
        return '#' . $this->id;
    }

}
