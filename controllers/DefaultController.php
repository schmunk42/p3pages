<?php

class DefaultController extends Controller
{

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('page'),
                'users'   => array('*'),
            ),
            array(
                'allow',
                'actions' => array('index'),
                'expression' => 'Yii::app()->user->checkAccess("P3pages.Default.*")',
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * Shows a view from database.
     */
    public function actionPage()
    {

        $model = null;
        $id    = (isset($_GET[P3Page::PAGE_ID_KEY]) && is_numeric($_GET[P3Page::PAGE_ID_KEY])) ?
            $_GET[P3Page::PAGE_ID_KEY] : null;
        $name  = isset($_GET[P3Page::PAGE_NAME_KEY]) ? $_GET[P3Page::PAGE_NAME_KEY] : null;

        if ($id) {
            $model = P3Page::model()->localized()->findByPk($id);
        } elseif ($name) {
            $model = P3Page::model()->localized()->findByAttributes(array('nameId' => $name));
            // redirect for consistency reasons
            if ($model !== null) {
                Yii::app()->request->redirect(
                    $this->createUrl(
                        '/p3/p3Page/view',
                        array_merge(
                            $_GET,
                            array(P3Page::PAGE_ID_KEY => $model->id, P3Page::PAGE_NAME_KEY => $model->name)
                        )
                    )
                );
            }
        } else {
            throw new CHttpException(404, Yii::t('P3PagesModule.crud', 'ID/name not found!'));
        }

        if ($model == null && $id) {
            //throw new CHttpException(404, Yii::t('P3PagesModule.crud', 'Page not available!'));

            // look for the reason ...
			// Access is not granted --- TODO: Remove P3ActiveRecord or reimplement, reimplement 'active' and 'localized' (original code commented out below)
			$model = P3Page::model()->findByPk($id);
			if ($model !== null && Yii::app()->user->isGuest) {
				Yii::app()->user->loginRequired();
			} elseif ($model !== null && !Yii::app()->user->isGuest) {
				throw new CHttpException(404, 'You are not authorized to view this page!');
			}
            
            // TODO: reimplement checkAccess, ....
            /*
			// look for the reason ...
			// is active and localized, but access is not granted --- TODO: Remove P3ActiveRecord or reimplment
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
			}*/
        } elseif ($model instanceof P3Page) {
            // record found in db
            $data = CJSON::decode($model->route);
            if ($data) {
                if (!empty($data['route'])) {
                    $route = $data['route'];
                    unset($data['route']);
                    if (empty($data['params'])) {
                        $params = array();
                    } else {
                        $params = $data['params'];
                    }
                    $url = $this->createUrl($route, $params);
                    $this->redirect($url, true, 301);
                } else if (!empty($params['url'])) {
                    // permanent redirect
                    $this->redirect($params['url'], true, 301);
                }
            }
            if (!$model->view || !$model->layout) {
                throw new CHttpException(500, Yii::t('P3PagesModule.crud', 'No view file in database!'));
            }
            $this->pageTitle = $model->t('pageTitle');
            $this->layout    = $model->layout;
            $this->render($model->view, array('model' => $model));
            return;
        }
        throw new CHttpException(404, Yii::t('P3PagesModule.crud', 'ID/name not found in database!'));
    }

}