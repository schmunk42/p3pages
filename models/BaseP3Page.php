<?php

/**
 * This is the model base class for the table "p3_page".
 *
 * Columns in table "p3_page" available as properties of the model:
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $controller
 * @property string $params
 *
 * There are no model relations.
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
			array('title', 'unique'),
			array('title', 'identificationColumnValidator'),
			array('title, description, keywords, controller, params', 'default', 'setOnEmpty' => true, 'value' => null),
			array('title, description, keywords, controller, params', 'length', 'max'=>45),
			array('id, title, description, keywords, controller, params', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Title'),
			'description' => Yii::t('app', 'Description'),
			'keywords' => Yii::t('app', 'Keywords'),
			'controller' => Yii::t('app', 'Controller'),
			'params' => Yii::t('app', 'Params'),
		);
	}


	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.title', $this->title, true);
		$criteria->compare('t.description', $this->description, true);
		$criteria->compare('t.keywords', $this->keywords, true);
		$criteria->compare('t.controller', $this->controller, true);
		$criteria->compare('t.params', $this->params, true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function get_label()
	{
		return '#'.$this->id;		
		
			}
	
}
