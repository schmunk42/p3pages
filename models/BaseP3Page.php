<?php

/**
 * This is the model base class for the table "p3_page".
 *
 * Columns in table "p3_page" available as properties of the model:
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $moduleId
 * @property string $controllerId
 * @property string $actionName
 * @property string $requestParam
 * @property string $layout
 * @property string $view
 * @property string $url
 *
 * Relations of table "p3_page" available as properties of the model:
 * @property P3PageMeta $p3PageMeta
 * @property P3PageTranslation[] $p3PageTranslations
 */
abstract class BaseP3Page extends CActiveRecord{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'p3_page';
	}

	public function rules()
	{
		return array(
			array('title, description, keywords, moduleId, controllerId, actionName, requestParam, layout, view, url', 'default', 'setOnEmpty' => true, 'value' => null),
			array('title, moduleId, controllerId, actionName, requestParam', 'length', 'max'=>45),
			array('layout, view', 'length', 'max'=>128),
			array('url', 'length', 'max'=>255),
			array('description, keywords', 'safe'),
			array('id, title, description, keywords, moduleId, controllerId, actionName, requestParam, layout, view, url', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'p3PageMeta' => array(self::HAS_ONE, 'P3PageMeta', 'id'),
			'p3PageTranslations' => array(self::HAS_MANY, 'P3PageTranslation', 'p3_widget_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Title'),
			'description' => Yii::t('app', 'Description'),
			'keywords' => Yii::t('app', 'Keywords'),
			'moduleId' => Yii::t('app', 'Module'),
			'controllerId' => Yii::t('app', 'Controller'),
			'actionName' => Yii::t('app', 'Action Name'),
			'requestParam' => Yii::t('app', 'Request Param'),
			'layout' => Yii::t('app', 'Layout'),
			'view' => Yii::t('app', 'View'),
			'url' => Yii::t('app', 'Url'),
		);
	}


	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('keywords', $this->keywords, true);
		$criteria->compare('moduleId', $this->moduleId, true);
		$criteria->compare('controllerId', $this->controllerId, true);
		$criteria->compare('actionName', $this->actionName, true);
		$criteria->compare('requestParam', $this->requestParam, true);
		$criteria->compare('layout', $this->layout, true);
		$criteria->compare('view', $this->view, true);
		$criteria->compare('url', $this->url, true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function get_label()
	{
		return '#'.$this->id;		
		
			}
	
}
