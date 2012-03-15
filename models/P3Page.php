<?php

// auto-loading fix
Yii::setPathOfAlias('P3Page', dirname(__FILE__));
Yii::import('P3Page.*');

class P3Page extends BaseP3Page {

	const PAGE_ID_KEY = 'pageId';
	const PAGE_NAME_KEY = 'pageName';

	// Add your model-specific methods here. This file will not be overriden by gtc except you force it.
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function init() {
		return parent::init();
	}

	public function __toString() {
		return (string) $this->layout;
	}

	public function behaviors() {
		return array_merge(
				array(
				#'JSON' => array(
				#'class' => 'ext.p3extensions.behaviors.P3JSONBehavior',
				#),
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

	public function rules() {
		return array_merge(
				/* array('column1, column2', 'rule'), */
				parent::rules()
		);
	}

	public function createUrl($additionalParams = array(), $absolute = false) {

		if ($this->id == 1) {
			return Yii::app()->homeUrl;
		} elseif (is_array(CJSON::decode($this->route))) {
			$link = CJSON::decode($this->route);
		} elseif ($this->route) {
			return $this->route;
		} else {
			$link['route'] = '/p3pages/default/page';
			$link['params'] = CMap::mergeArray($additionalParams, array(P3Page::PAGE_ID_KEY => $this->id, P3Page::PAGE_NAME_KEY => $this->t('seoUrl')));
		}

		if (isset($link['route'])) {
			$params = (isset($link['params'])) ? $link['params'] : array();
			if ($absolute === true)
				return Yii::app()->controller->createAbsoluteUrl($link['route'], $params);
			else
				return Yii::app()->controller->createUrl($link['route'], $params);
		} else {
			throw new Exception('Could not determine URL string.');
		}
	}

}
