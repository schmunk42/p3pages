<?php
/**
 * This is the model base class for the table "p3_page".
 *
 * Columns in table "p3_page" available as properties of the model:
 * @property integer $id
 * @property string $layout
 * @property string $view
 * @property string $route
 *
 * Relations of table "p3_page" available as properties of the model:
 * @property P3PageMeta $p3PageMeta
 * @property P3PageTranslation[] $p3PageTranslations
 *
 * @package p3pages.models
 * @category db.ar
 */
 
abstract class BaseP3Page extends P3ActiveRecord{
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
			array('layout, view, route', 'default', 'setOnEmpty' => true, 'value' => null),
			array('layout, view', 'length', 'max'=>128),
			array('route', 'length', 'max'=>255),
			array('id, layout, view, route', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'p3PageMeta' => array(self::HAS_ONE, 'P3PageMeta', 'id'),
			'p3PageTranslations' => array(self::HAS_MANY, 'P3PageTranslation', 'p3_page_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('P3PagesModule.crud', 'ID'),
			'layout' => Yii::t('P3PagesModule.crud', 'Layout'),
			'view' => Yii::t('P3PagesModule.crud', 'View'),
			'route' => Yii::t('P3PagesModule.crud', 'Route'),
		);
	}


	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('layout', $this->layout, true);
		$criteria->compare('view', $this->view, true);
		$criteria->compare('route', $this->route, true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public function get_label()
	{
		return '#'.$this->id;

			}

}
