<?php

/**
 * This is the P3PageCopyController.
 *
 * @author Christopher Stebe <cstebe@iserv4u.com>
 * @package p3pages.controllers
 * @version 0.1.0
 * 
 */
class P3PageCopyController extends Controller
{

    public $defaultAction = "index";
    public $scenario      = "crud";
    public $scope         = "crud";

    /**
     * Global P3PageCopy model
     */
    private $model;

    /**
     * Global @vars for copy process 
     */
    private $transaction;
    private $newPage;
    private $newPageTranslation;
    private $newWidget;
    //private $newWidgetTranslation;

    /**
     * Global @vars for user inputs
     */
    private $sourceLanguage;
    private $targetLanguage;
    private $sourcePageId;
    private $targetParentPageId;
    private $sourceLanguageChecked;

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
                       'accessControl', // perform access control
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
                       array('allow', // allow authenticated user to view the index page
                                      'actions' => array('index'),
                                      'roles'   => array('admin', 'P3pages.Default.CopyPage'),
                       ),
                       array('deny', // deny all users
                                      'users' => array('*'),
                       ),
        );
    }

    public function beforeAction($action)
    {
        parent::beforeAction($action);
        self::checkPageParents();

        if ($this->module !== null) {
            $this->breadcrumbs[$this->module->Id] = array('/' . $this->module->Id);
        }
        return true;
    }

    /**
     * Renders the view '/p3pages/p3PageCopy/index' and starts the copy process
     */
    public function actionIndex()
    {
        $this->model = new P3PageCopy();

        // Start Copy Process only if all requiered fields are set
        if (isset($_POST['P3PageCopy']) && !empty($_POST['P3PageCopy']['sourcePageId']) && !empty($_POST['P3PageCopy']['targetParentPageId'])) {

            $this->sourceLanguage     = $_POST['P3PageCopy']['sourceLanguage'];
            $this->sourcePageId       = $_POST['P3PageCopy']['sourcePageId'];
            $this->targetLanguage     = $_POST['P3PageCopy']['targetLanguage'];
            $this->targetParentPageId = $_POST['P3PageCopy']['targetParentPageId'];

            // switch between new record
            if ($this->model->getIsNewRecord()) {

                // Start the copy process
                $this->doCopy($this->model);
            } else {
                // Kill the $_POST['P3PageCopy']
                unset($_POST['P3PageCopy']);

                // set new record to true
                $this->model->setIsNewRecord(true);

                // reload page
                $this->refresh();
            }
        } else {
            // Set Flash Messages on missing attributes
            if (isset($_POST['P3PageCopy']) && empty($_POST['P3PageCopy']['sourcePageId'])) {
                Yii::app()->user->setFlash('sourcePageId', Yii::t('P3PagesModule.crud', 'Required'));
            }
            if (isset($_POST['P3PageCopy']) && empty($_POST['P3PageCopy']['targetParentPageId'])) {
                Yii::app()->user->setFlash('targetParentPageId', Yii::t('P3PagesModule.crud', 'Required'));
            }

            // load new record
            $this->newRecord();
        }
    }

    /**
     * render view for new record
     * @param type $model
     */
    private function newRecord()
    {
        $this->sourceLanguage        = Yii::app()->language;
        $this->sourcePageId          = false;
        $this->targetParentPageId    = false;
        $this->sourceLanguageChecked = false;

        // set isNewRecord to true
        $this->model->setIsNewRecord(true);

        // Check selected values
        if (isset($_POST['P3PageCopy']['sourceLanguage']) && $_POST['P3PageCopy']['sourceLanguage'] !== NULL) {
            $this->sourceLanguage        = $_POST['P3PageCopy']['sourceLanguage'];
            $this->sourceLanguageChecked = true;
        }
        if (isset($_POST['P3PageCopy']['sourcePageId']) && $_POST['P3PageCopy']['sourcePageId'] !== NULL) {
            $this->sourcePageId = $_POST['P3PageCopy']['sourcePageId'];
        }
        if (isset($_POST['P3PageCopy']['targetParentPageId']) && $_POST['P3PageCopy']['targetParentPageId'] !== NULL) {
            $this->targetParentPageId = $_POST['P3PageCopy']['targetParentPageId'];
        }

        // Unset the $_POST
        unset($_POST['P3PageCopy']);

        $this->render('index', array(
                       'model'              => $this->model,
                       'sourceLanguage'     => $this->sourceLanguage,
                       'sourcePageId'       => $this->sourcePageId,
                       'targetParentPageId' => $this->targetParentPageId,
                       'checked'            => $this->sourceLanguageChecked
        ));
    }

    /**
     * start copy process
     * @param type $model
     */
    private function doCopy($model)
    {
        // Get P3Page source model
        $sourcePage = P3Page::model()->findByPk($this->sourcePageId);

        // Start transaction
        $this->transaction = $sourcePage->dbConnection->beginTransaction();

        if ($sourcePage !== NULL) {

            // Make new Page from source page
            $this->newPage = $this->makeNewPage($sourcePage);

            if ($this->newPage->save()) {
                /**
                 * set the $model->isNewRecord() to false 
                 * for page reload protection
                 */
                $model->setIsNewRecord(false);

                $sourcePageTranslation = P3PageTranslation::model()->findByAttributes(array('p3_page_id' => $sourcePage->id, 'language' => $this->sourceLanguage));

                if ($sourcePageTranslation !== NULL) {
                    // Make new page translation from source page translation
                    $this->newPageTranslation = $this->makeNewPageTranslation($sourcePageTranslation);

                    if ($this->newPageTranslation->save() && Yii::app()->getModule('p3widgets')) {
                        $sourceWidgets = P3Widget::model()->findAllByAttributes(array('request_param' => $sourcePage->id, 'access_domain' => $this->sourceLanguage));

                        if ($sourceWidgets !== NULL) {
                            foreach ($sourceWidgets as $sourceWidget)
                            {
                                // Make new widget from source widget
                                $this->newWidget = $this->makeNewWidget($sourceWidget);

                                if ($this->newWidget->save()) {
                                    continue;
//                                    $sourceWidgetTranslation    = P3WidgetTranslation::model()->findByAttributes(array('p3_widget_id' => $sourceWidget->id, 'language' => $this->sourceLanguage));
//                                    
//                                    if($sourceWidgetTranslation !== NULL) {
//                                        // Make new widget translation from source widget translation
//                                        $this->newWidgetTranslation = $this->makeNewWidgetTranslation($sourceWidgetTranslation, $sourceWidget);
//                                        
//                                        if (!$this->newWidgetTranslation->save()) {
//                                            $this->errorHandler($this->newWidgetTranslation);
//                                        }
//                                    }
                                } else {
                                    $this->errorHandler($this->newWidget);
                                }
                            }
                        }
                    } else {
                        $this->errorHandler($this->newPageTranslation);
                    }

                    if (!$this->model->getIsNewRecord()) {
                        // Commit all transactions
                        $this->transaction->commit();
                    }
                    // Unset the $_POST
                    unset($_POST['P3PageCopy']);

                    // Set flash copySuccess
                    Yii::app()->user->setFlash('copySuccess', '<strong>' . Yii::t('P3PagesModule.crud', 'The complete page was copied successfuly. You can now edit the page.') . '</strong>');

                    $this->render('index', array(
                                   'model'              => $model,
                                   'sourceLanguage'     => $this->sourceLanguage,
                                   'sourcePageId'       => $this->sourcePageId,
                                   'targetParentPageId' => $this->targetParentPageId,
                                   'newPage'            => $this->newPage,
                                   'newPageTranslation' => $this->newPageTranslation
                    ));
                }
            } else {
                $this->errorHandler($this->newPage);
            }
        } else {
            $this->errorHandler($sourcePage);
        }
    }

    /**
     * 
     * @param type $sourcePage
     * @return \P3Page
     */
    private function makeNewPage($sourcePage)
    {
        $newPage                      = new P3Page;
        $newPage->default_menu_name   = $sourcePage->default_menu_name;
        $newPage->status              = 'draft';
        $newPage->name_id             = NULL;
        $newPage->tree_parent_id      = $this->targetParentPageId;
        $newPage->tree_position       = NULL;
        $newPage->default_page_title  = $sourcePage->default_page_title;
        $newPage->layout              = $sourcePage->layout;
        $newPage->view                = $sourcePage->view;
        $newPage->url_json            = $sourcePage->url_json;
        $newPage->default_url_param   = $sourcePage->default_url_param;
        $newPage->default_keywords    = $sourcePage->default_keywords;
        $newPage->default_description = $sourcePage->default_description;
        $newPage->custom_data_json    = $sourcePage->custom_data_json;
        $newPage->copied_from_id      = $sourcePage->id;

        return $newPage;
    }

    /**
     * 
     * @param type $sourcePageTranslation
     * @return \P3PageTranslation
     */
    private function makeNewPageTranslation($sourcePageTranslation)
    {
        $newPageTranslation                 = new P3PageTranslation;
        $newPageTranslation->p3_page_id     = $this->newPage->id;
        $newPageTranslation->language       = $this->targetLanguage;
        $newPageTranslation->menu_name      = $sourcePageTranslation->menu_name;
        $newPageTranslation->status         = 'draft';
        $newPageTranslation->page_title     = $sourcePageTranslation->page_title;
        $newPageTranslation->url_param      = $sourcePageTranslation->url_param;
        $newPageTranslation->keywords       = $sourcePageTranslation->keywords;
        $newPageTranslation->description    = $sourcePageTranslation->description;
        $newPageTranslation->copied_from_id = $sourcePageTranslation->id;

        return $newPageTranslation;
    }

    /**
     * 
     * @param type $sourceWidget
     * @return \P3Widget
     */
    private function makeNewWidget($sourceWidget)
    {
        $newWidget                          = new P3Widget;
        $newWidget->status                  = 'draft';
        $newWidget->alias                   = $sourceWidget->alias;
        $newWidget->default_properties_json = $sourceWidget->default_properties_json;
        $newWidget->default_content_html    = $sourceWidget->default_content_html;
        $newWidget->name_id                 = $sourceWidget->name_id;
        $newWidget->container_id            = $sourceWidget->container_id;
        $newWidget->rank                    = $sourceWidget->rank;
        $newWidget->request_param           = $this->newPage->id;
        $newWidget->action_name             = $sourceWidget->action_name;
        $newWidget->controller_id           = $sourceWidget->controller_id;
        $newWidget->module_id               = $sourceWidget->module_id;
        $newWidget->copied_from_id          = $sourceWidget->id;

        return $newWidget;
    }

    /**
     * 
     * @param type $sourceWidgetTranslation
     * @return \P3WidgetTranslation
     */
//    private function makeNewWidgetTranslation($sourceWidgetTranslation) {
//        $newWidgetTranslation                   = new P3WidgetTranslation;
//        $newWidgetTranslation->p3_widget_id     = $this->newWidget->id;
//        $newWidgetTranslation->status           = 'draft';
//        $newWidgetTranslation->language         = $this->targetLanguage;
//        $newWidgetTranslation->properties_json  = $sourceWidgetTranslation->properties_json;
//        $newWidgetTranslation->content_html     = $sourceWidgetTranslation->content_html;
//        $newWidgetTranslation->copied_from_id   = $sourceWidgetTranslation->id;
//                
//        return $newWidgetTranslation;
//    }

    /**
     * 
     * @param type $model
     */
    private function errorHandler($model)
    {

        if (!$this->model->getIsNewRecord()) {
            // Rollback all transactions
            $this->transaction->rollback();
        }
        // Unset the $_POST var
        if (isset($_POST['P3PageCopy'])) {
            unset($_POST['P3PageCopy']);
        }

        // Errors to string
        $errors = '';
        foreach ($model->errors AS $error)
        {
            foreach ($error AS $key => $value)
            {
                $errors .= ' - ' . $value . '<br />';
            }
        }
        // Set flash copyError
        Yii::app()->user->setFlash('copyError', '<strong>' . Yii::t('P3PagesModule.crud', 'Something went wrong...') . '</strong><br /><br />'
                . get_class($model) . '<br /><i>' . $errors . '</i>');

        // Reload current view index
        $this->refresh();
    }

    /**
     * show error if there are no parent pages availible
     * to append a copy of a page
     */
    private static function checkPageParents()
    {

        $model = new P3PageCopy();

        if (sizeof($model->getAllP3PageParents(Yii::app()->language)) == NULL) {
            // Set flash copyError
            Yii::app()->user->setFlash('copyError', '<strong>' . Yii::t('P3PagesModule.crud', 'No parent pages availible to append a copy.') . '</strong><br /><br />'
                    . Yii::t('P3PagesModule.crud', 'Please choose another target language!'));

            // Unset the $_POST var
            if (isset($_POST['P3PageCopy'])) {
                unset($_POST['P3PageCopy']);
            }
        }
    }

}
