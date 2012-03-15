<?php

// auto-loading fix
Yii::setPathOfAlias('P3Page', dirname(__FILE__));
Yii::import('P3Page.*');

class P3Page extends BaseP3Page
{
    const PAGE_ID_KEY = 'pageId';
    const PAGE_NAME_KEY = 'pageName';

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
		return (string) $this->layout;

	}

	public function behaviors() {
		return array_merge(
				array(
				'MetaData' => array(
					'class' => 'ext.p3extensions.behaviors.P3MetaDataBehavior',
					'metaDataRelation' => 'p3PageMeta',
				),
				'Translation' => array(
					'class' => 'ext.p3extensions.behaviors.P3TranslationBehavior',
					'relation' => 'p3PageTranslations',
					'fallbackLanguage' => 'en',
					'fallbackValue' => null,
				//'attributesBlacklist' => array('loadfrom'),
				)
				), parent::behaviors()
		);
	}





	public function rules() 
	{
		return array_merge(
				/*array('column1, column2', 'rule'),*/
				parent::rules()
				);
	}

}
