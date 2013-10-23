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
    public function actionPage() {

        $model = null;
        $id = (isset($_GET[P3Page::PAGE_ID_KEY]) && is_numeric($_GET[P3Page::PAGE_ID_KEY])) ?
                $_GET[P3Page::PAGE_ID_KEY] : null;
        $name = isset($_GET[P3Page::PAGE_NAME_KEY]) ? $_GET[P3Page::PAGE_NAME_KEY] : null;
        
        // Step 1 - load model
        
        if ($id) {
            // load model by id
            Yii::trace('Loading page model', 'p3pages.controllers.default');
            $model = P3Page::model()->findByPk($id);
        } elseif ($name) {
            $model = P3Page::model()->findByAttributes(array('name_id' => $name));
            // redirect for consistency reasons
            if ($model !== null) {
                Yii::app()->request->redirect(
                        $this->createUrl(
                                '/p3/p3Page/view', array_merge(
                                        $_GET, array(P3Page::PAGE_ID_KEY => $model->id, P3Page::PAGE_NAME_KEY => $model->name)
                                )
                        )
                );
            }
        } else {
            // no params given
            throw new CHttpException(404, Yii::t('P3PagesModule.module', 'Invalid identifier'));
        }
        
        // Step 2 - checks
        if ($model == null) {
            // no page found
            throw new CHttpException(404, Yii::t('P3PagesModule.module', 'Page not found'));
        } else {
            // additional access checks
            Yii::trace('Performing addtional page checks...', 'p3pages.controllers.default');
            // has page checkAccess restrictiions
            if (!$model->isReadable) {
                if (Yii::app()->user->isGuest) {
                    Yii::app()->user->loginRequired();
                    return;
                }
                throw new CHttpException(403, 'You are not authorized to view this page');
            }

            // Show unpublished pages only to 'Editor'
            if (!$model->hasStatus(array('published')) && !Yii::app()->user->checkAccess('Editor')) {
                throw new CHttpException(404, 'Page not available');
            }

            // is page localized
            $model = P3Page::model()->localized()->findByPk($id);
            if ($model === null) {
                throw new CHttpException(404, 'Page not available in this language');
            }
                        
        }
        

        // everything above passed, output the page
        $data = CJSON::decode($model->url_json);
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
            throw new CHttpException(500, Yii::t('P3PagesModule.module', 'No view file in database'));
        }
        $this->pageTitle = $model->page_title;
        $this->layout = $model->layout;
        $this->render($model->view, array('model' => $model));
        #return;
    }

}