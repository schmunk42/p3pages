<?php

class DefaultController extends Controller {

	public function actionIndex() {
		$this->render('index');
	}

	/**
	 * Shows a view from database.
	 */
	public function actionPage() {

		$model = null;
		$id = (isset($_GET[P3Page::PAGE_ID_KEY]) && is_numeric($_GET[P3Page::PAGE_ID_KEY])) ? $_GET[P3Page::PAGE_ID_KEY] : null;
		$name = isset($_GET[P3Page::PAGE_NAME_KEY]) ? $_GET[P3Page::PAGE_NAME_KEY] : null;

		if ($id) {
			$model = P3Page::model()->default()->findByPk($id);
		} elseif ($name) {
			$model = P3Page::model()->default()->findByAttributes(array('name' => $name));
			// redirect for consistency reasons
			if ($model !== null) {
				Yii::app()->request->redirect($this->createUrl('/p2/p2Page/view', array_merge($_GET, array(P3Page::PAGE_ID_KEY => $model->id, P3Page::PAGE_NAME_KEY => $model->name))));
			}
		} else {
			throw new CHttpException(404, 'Id/name not found!');
		}

		if ($model == null && $id) {
			// look for the reason ...
			// is active and localized, but access is not granted
			$model = P3Page::model()->active()->localized()->findByPk($id);
			if ($model !== null && Yii::app()->user->isGuest) {
				Yii::app()->user->loginRequired();
			} elseif ($model !== null && !Yii::app()->user->isGuest) {
				throw new CHttpException(404, 'You are not authorized to view this page!');
			}
			// is active and accessable, but not localized
			$model = P3Page::model()->active()->checkAccess()->findByPk($id);
			if ($model !== null) {
				throw new CHttpException(404, 'Page not available in this language!');
			}
		} elseif ($model instanceof P3Page) {
			// record found in db
			#if (!is_array($model->route)) {
			#	Yii::app()->controller->redirect($model->getUrlString());
			#}
			if (!$model->view || !$model->layout) {
				throw new CHttpException(500, 'No view file in database!');
			}
			$this->pageTitle = $model->t('pageTitle');			
			$this->layout = $model->layout;
			$this->render($model->view, array('model' => $model));
			return;
		}
		throw new CHttpException(404, 'Id/name not found in database!');
	}

}