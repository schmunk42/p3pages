<?php

// auto-loading fix
Yii::setPathOfAlias('P3Page', dirname(__FILE__));
Yii::import('P3Page.*');

class P3Page extends BaseP3Page
{
	// Add your model-specific methods here. This file will not be overriden by gtc except you force it.
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function init()
	{
		return parent::init();
	}

	public function __toString() {
		return (string) $this->title;

	}

	public function behaviors() 
	{
		return array_merge(parent::behaviors(),array(
));
	}




	public function rules() 
	{
		return array_merge(
				/*array('column1, column2', 'rule'),*/
				parent::rules()
				);
	}

}
