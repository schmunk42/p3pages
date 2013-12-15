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
    public $scenario = "crud";
    public $scope = "crud";

    /**
     * Global P3PageCopy model
     */
    private $model;

    /**
     * Global @vars for copy process
     */
    private $transaction;
    private $sourcePage;
    private $newPage;
    private $newPageTranslation;
    private $newWidget;
    private $newWidgetTranslation;

    /**
     * Global @vars for user inputs
     */
    private $sourceLanguage;
    private $targetLanguage;
    private $sourcePageId;
    private $targetParentPageId;
    private $sourceLanguageChecked;
    private $p3pageStatus;
    private $p3pageTranslationStatus;
    private $p3widgetStatus;
    private $p3widgetTranslationStatus;

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

        if ($this->module !== NULL) {
            $this->breadcrumbs[$this->module->Id] = array('/' . $this->module->Id);
        }
        return TRUE;
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
            self::unsetPost();
        }
    }

    /**
     * Renders the view '/p3pages/p3PageCopy/index' and starts the copy process
     */
    public function actionIndex()
    {
        $this->model = new P3PageCopy();

        // Start Copy Process only if all requiered fields are set
        if (isset($_POST['P3PageCopy']) && !empty($_POST['P3PageCopy']['sourcePageId']) && !empty($_POST['P3PageCopy']['targetParentPageId'])) {

            // Set user inputs from $_POST
            $this->setUserInputs();

            // Start copy process if all requiered fields are given
            if ($this->model->readyToCopy) {

                // Kill the $_POST
                self::unsetPost();

                // Start the copy process
                $this->doCopy();
            } else {
                // Kill the $_POST
                self::unsetPost();

                // reload page
                $this->refresh();
            }
        } else {
            // Set Flash Messages on missing attributes
            self::setFlashes();

            // load new record
            $this->newRecord();
        }
    }

    /**
     * start copy process
     */
    private function doCopy()
    {
        // Get P3Page source model
        $this->sourcePage = P3Page::model()->findByPk($this->sourcePageId);

        if ($this->sourcePage !== NULL) {

            // Start transaction
            $this->transaction = $this->sourcePage->dbConnection->beginTransaction();

            // Make new Page from source page
            $this->newPage = $this->makeNewPage($this->sourcePage);

            if ($this->newPage->save()) {

                // re-attach Translateable behavior
                $p3pageBehaviors = $this->newPage->behaviors();
                $this->newPage->attachBehavior('Translatable', $p3pageBehaviors['Translatable']);

                // handle the copy process for the page translation
                $this->copyPageTranslation();

                // handle the copy process for widgets and their translations
                $this->copyWidgets();

                // render copy result
                $this->renderCopyResult();
            } else {
                $this->errorHandler($this->newPage);
            }
        } else {
            // No source page found
            $this->errorHandler($this->sourcePage);
        }
    }

    /**
     * Handles the copy process for the page translation
     */
    private function copyPageTranslation()
    {
        $sourcePageTranslation = P3PageTranslation::model()->findByAttributes(array(
            'p3_page_id' => $this->sourcePage->id,
            'language'   => $this->sourceLanguage,
        ));

        if ($sourcePageTranslation !== NULL) {
            // Make new page translation from source page translation
            $this->newPageTranslation = $this->makeNewPageTranslation($sourcePageTranslation);
            if (!$this->newPageTranslation->save()) {
                $this->errorHandler($this->newPageTranslation);
            }
        }
    }

    /**
     * Handles the copy process of the widgets and their translations
     */
    private function copyWidgets()
    {
        // If phundament/P3Widgets module is installed/availible then try to copy widgets
        if (Yii::app()->getModule('p3widgets') !== NULL) {
            $sourceWidgets = P3Widget::model()->findAllByAttributes(array(
                'request_param' => $this->sourcePage->id,
                'access_domain' => array($this->sourceLanguage, '*', 'NULL'),
            ));

            if ($sourceWidgets !== NULL) {
                foreach ($sourceWidgets as $sourceWidget) {
                    // Make new widget from source widget
                    $this->newWidget = $this->makeNewWidget($sourceWidget);

                    if ($this->newWidget->save()) {

                        // re-attach Translateable behavior
                        $p3widgetBehaviors = $this->newWidget->behaviors();
                        $this->newWidget->attachBehavior('Translatable', $p3widgetBehaviors['Translatable']);

                        $sourceWidgetTranslation = P3WidgetTranslation::model()->findByAttributes(array('p3_widget_id' => $sourceWidget->id, 'language' => $this->sourceLanguage));

                        if ($sourceWidgetTranslation !== NULL) {
                            // Make new widget translation from source widget translation
                            $this->newWidgetTranslation = $this->makeNewWidgetTranslation($sourceWidgetTranslation);

                            if (!$this->newWidgetTranslation->save()) {
                                $this->errorHandler($this->newWidgetTranslation);
                            }
                        }
                    } else {
                        $this->errorHandler($this->newWidget);
                    }
                }
            }
        }
    }

    /**
     *
     * @param type $sourcePage
     * @return \P3Page
     */
    private function makeNewPage($sourcePage)
    {
        $newPage = new P3Page;
        $newPage->detachBehavior('Translatable');

        $newPage->default_menu_name   = $sourcePage->default_menu_name;
        $newPage->status              = $this->p3pageStatus;
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
        $newPage->access_domain       = $this->targetLanguage;
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
        $newPageTranslation->status         = $this->p3pageTranslationStatus;
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
        $newWidget = new P3Widget;
        $newWidget->detachBehavior('Translatable');

        $newWidget->status                  = $this->p3widgetStatus;
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
        $newWidget->access_domain           = $this->targetLanguage;
        $newWidget->copied_from_id          = $sourceWidget->id;

        return $newWidget;
    }

    /**
     *
     * @param type $sourceWidgetTranslation
     * @return \P3WidgetTranslation
     */
    private function makeNewWidgetTranslation($sourceWidgetTranslation)
    {
        $newWidgetTranslation                  = new P3WidgetTranslation;
        $newWidgetTranslation->p3_widget_id    = $this->newWidget->id;
        $newWidgetTranslation->status          = $this->p3widgetTranslationStatus;
        $newWidgetTranslation->language        = $this->targetLanguage;
        $newWidgetTranslation->properties_json = $sourceWidgetTranslation->properties_json;
        $newWidgetTranslation->content_html    = $sourceWidgetTranslation->content_html;
        $newWidgetTranslation->copied_from_id  = $sourceWidgetTranslation->id;

        return $newWidgetTranslation;
    }

    /**
     * render view for new record
     * @param type $model
     */
    private function newRecord()
    {
        $this->sourcePageId          = FALSE;
        $this->targetParentPageId    = FALSE;
        $this->sourceLanguageChecked = FALSE;

        // Check selected values
        if (isset($_POST['P3PageCopy']['sourceLanguage']) && $_POST['P3PageCopy']['sourceLanguage'] !== NULL) {
            $this->sourceLanguage        = $_POST['P3PageCopy']['sourceLanguage'];
            $this->sourceLanguageChecked = TRUE;
        }
        if (isset($_POST['P3PageCopy']['sourcePageId']) && $_POST['P3PageCopy']['sourcePageId'] !== NULL) {
            $this->sourcePageId = $_POST['P3PageCopy']['sourcePageId'];
        }
        if (isset($_POST['P3PageCopy']['targetParentPageId']) && $_POST['P3PageCopy']['targetParentPageId'] !== NULL) {
            $this->targetParentPageId = $_POST['P3PageCopy']['targetParentPageId'];
        }
        if (isset($_POST['P3PageCopy']['p3pageStatus']) && $_POST['P3PageCopy']['p3pageStatus'] !== NULL) {
            $this->p3pageStatus = $_POST['P3PageCopy']['p3pageStatus'];
        }
        if (isset($_POST['P3PageCopy']['p3pageTranslationStatus']) && $_POST['P3PageCopy']['p3pageTranslationStatus'] !== NULL) {
            $this->p3pageTranslationStatus = $_POST['P3PageCopy']['p3pageTranslationStatus'];
        }
        if (isset($_POST['P3PageCopy']['p3widgetStatus']) && $_POST['P3PageCopy']['p3widgetStatus'] !== NULL) {
            $this->p3widgetStatus = $_POST['P3PageCopy']['p3widgetStatus'];
        }
        if (isset($_POST['P3PageCopy']['p3widgetTranslationStatus']) && $_POST['P3PageCopy']['p3widgetTranslationStatus'] !== NULL) {
            $this->p3widgetTranslationStatus = $_POST['P3PageCopy']['p3widgetTranslationStatus'];
        }

        // Unset the $_POST
        self::unsetPost();

        $this->render('index', array(
            'model'                     => $this->model,
            'sourceLanguage'            => $this->sourceLanguage,
            'sourcePageId'              => $this->sourcePageId,
            'targetParentPageId'        => $this->targetParentPageId,
            'p3pageStatus'              => $this->p3pageStatus,
            'p3pageTranslationStatus'   => $this->p3pageTranslationStatus,
            'p3widgetStatus'            => $this->p3widgetStatus,
            'p3widgetTranslationStatus' => $this->p3widgetTranslationStatus,
            'checked'                   => $this->sourceLanguageChecked
        ));
    }

    /**
     * if at least the p3page was copied
     * this will render der results
     */
    private function renderCopyResult()
    {
        // Commit all transactions
        $this->transaction->commit();

        // Unset the $_POST
        self::unsetPost();

        // Set flash copySuccess
        Yii::app()->user->setFlash('copySuccess', '<strong>' . Yii::t('P3PagesModule.crud', 'The complete page was copied successfuly. You can now edit the page.') . '</strong>');

        $this->render('index', array(
            'model'              => $this->model,
            'sourceLanguage'     => $this->sourceLanguage,
            'sourcePageId'       => $this->sourcePageId,
            'targetParentPageId' => $this->targetParentPageId,
            'newPage'            => $this->newPage,
            'newPageTranslation' => $this->newPageTranslation
        ));
    }

    /**
     *
     * @param type $model
     */
    private function errorHandler($model)
    {
        // Rollback all transactions
        $this->transaction->rollback();

        // Errors to string
        if (isset($model) && $model !== NULL) {
            $errors = '';
            foreach ($model->errors AS $error) {
                foreach ($error AS $value) {
                    $errors .= ' - ' . $value . '<br />';
                }
            }
            // Set flash copyError
            Yii::app()->user->setFlash('copyError', '<strong>' . Yii::t('P3PagesModule.crud', 'Something went wrong...') . '</strong><br /><br />'
                . get_class($model) . '<br /><i>' . $errors . '</i>');
        }

        // no sourcePage entry found
        if ($this->sourcePage === NULL) {
            // Set flash copyError
            Yii::app()->user->setFlash('copyError', '<strong>' . Yii::t('P3PagesModule.crud', 'Something went wrong...') . '</strong><br /><br />'
                . '<i>' . Yii::t('P3PagesModule.crud', 'Source page could not be found!') . '</i>');
        }

        // if p3widget module is not install or unavailible
        if (Yii::app()->getModule('p3widgets') === NULL) {
            // Set flash copyError
            Yii::app()->user->setFlash('errorP3widget', '<i>' . Yii::t('P3PagesModule.crud', 'P3Widgets module not availible!') . '</i>');
        }

        // Unset the $_POST var
        self::unsetPost();

        // Reload current view index
        $this->refresh();
    }

    private static function unsetPost()
    {
        // Unset the $_POST
        if (isset($_POST['P3PageCopy'])) {
            unset($_POST['P3PageCopy']);
        }
    }

    /**
     * set flashes for missing attributes
     */
    private static function setFlashes()
    {
        if (isset($_POST['P3PageCopy']) && empty($_POST['P3PageCopy']['sourcePageId'])) {
            Yii::app()->user->setFlash('sourcePageId', Yii::t('P3PagesModule.crud', 'Required'));
        }
        if (isset($_POST['P3PageCopy']) && empty($_POST['P3PageCopy']['targetParentPageId'])) {
            Yii::app()->user->setFlash('targetParentPageId', Yii::t('P3PagesModule.crud', 'Required'));
        }
    }

    private function setUserInputs()
    {

        if (isset($_POST['P3PageCopy']) && $_POST['P3PageCopy'] !== NULL) {
            $this->sourceLanguage            = $_POST['P3PageCopy']['sourceLanguage'];
            $this->sourcePageId              = $_POST['P3PageCopy']['sourcePageId'];
            $this->targetLanguage            = $_POST['P3PageCopy']['targetLanguage'];
            $this->targetParentPageId        = $_POST['P3PageCopy']['targetParentPageId'];
            $this->p3pageStatus              = $_POST['P3PageCopy']['p3pageStatus'];
            $this->p3pageTranslationStatus   = $_POST['P3PageCopy']['p3pageTranslationStatus'];
            $this->p3widgetStatus            = $_POST['P3PageCopy']['p3widgetStatus'];
            $this->p3widgetTranslationStatus = $_POST['P3PageCopy']['p3widgetTranslationStatus'];
        } else {
            throw new CHttpException(500);
        }
    }
}
