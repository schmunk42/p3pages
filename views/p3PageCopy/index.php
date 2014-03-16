<?php
    $this->setPageTitle(
        Yii::t('P3PagesModule.model', 'P3 Pages')
        . ' - '
        . Yii::t('P3PagesModule.crud', 'Copy')
    );
    $this->breadcrumbs[] = Yii::t('P3PagesModule.crud', 'Copy');
    $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs));

    Yii::app()->bootstrap->registerPackage('select2');
    Yii::app()->clientScript->registerScript('p3pages/p3PageCopy/index', '$("#copyPage select").select2();');
?>
    <h1>

        <?php echo Yii::t('P3PagesModule.crud', 'Copy Page'); ?>
        <small><?php echo Yii::t('P3PagesModule.crud', 'Manage'); ?></small>
        <?php
            echo CHtml::link(
                '<i class="icon icon-info-sign"></i>', array(
                    '#',
                ), array(
                    'data-toggle'    => 'tooltip',
                    'data-html'      => true,
                    'data-placement' => 'bottom',
                    'title'          =>
                        '<strong>' . Yii::t('P3PagesModule.crud', 'Step 1 :') . '</strong><br>' .
                        Yii::t('P3PagesModule.crud', 'Select a language from which you want to copy a page') . '<br><br>' .

                        '<strong>' . Yii::t('P3PagesModule.crud', 'Step 2 :') . '</strong><br>' .
                        Yii::t('P3PagesModule.crud', 'Select the source page you want to copy') . '<br><br>' .

                        '<strong>' . Yii::t('P3PagesModule.crud', 'Step 3 :') . '</strong><br>' .
                        Yii::t('P3PagesModule.crud', 'Select a P3 parent page to put the copied page below this P3Page ID') . '<br><br>' .

                        '<strong>' . Yii::t('P3PagesModule.crud', 'Step 4 :') . '</strong><br>' .
                        Yii::t('P3PagesModule.crud', 'Set the page and widget status') . '<br><br>' .

                        '<strong>' . Yii::t('P3PagesModule.crud', 'Step 5 :') . '</strong><br>' .
                        Yii::t('P3PagesModule.crud', 'Select the access roles') . '<br><br>' .

                        '<strong>' . Yii::t('P3PagesModule.crud', 'Step 6 :') . '</strong><br>' .
                        Yii::t('P3PagesModule.crud', 'Start copy process') . '<br><br>' .

                        '<strong>' . Yii::t('P3PagesModule.crud', 'Step 7 :') . '</strong><br>' .
                        Yii::t('P3PagesModule.crud', 'Edit the new page') . '<br><br>'
                )
            );
        ?>

    </h1>
<?php
    $form = $this->beginWidget('CActiveForm', array(
            'id'                     => 'copyPage',
            'enableClientValidation' => true,
            'clientOptions'          => array(
                'validateOnSubmit' => true
            ),
            'htmlOptions'            => array(
                'enctype' => 'multipart/form-data'
            ),
        )
    );
?>
    <hr/>

<?php if (Yii::app()->user->hasFlash('copySuccess')): ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="alert alert-success">
                <?php echo Yii::app()->user->getFlash('copySuccess'); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if (Yii::app()->user->hasFlash('copyError')): ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="alert alert-error">
                <?php echo Yii::app()->user->getFlash('copyError'); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if (Yii::app()->user->hasFlash('errorP3widget')): ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="alert alert-info">
                <?php echo Yii::app()->user->getFlash('errorP3widget'); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (!isset($newPage)) { ?>
    <div class="row-fluid">
        <div class="span6">
            <h4><?php echo Yii::t('P3PagesModule.crud', 'Step 1'); ?></h4>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span6">
            <?php echo $form->labelEx($model, 'sourceLanguage'); ?>
            <?php
                echo $form->dropDownList($model, 'sourceLanguage', $model->getSourceLanguages(), array(
                        'options'     => array(
                            $sourceLanguage => array(
                                'selected' => true
                            )
                        ),
                        'placeholder' => Yii::t('P3PagesModule.crud', 'Select language'),
                        'onChange'    => 'this.form.submit();')
                );
            ?>
            <?php echo $form->error($model, 'sourceLanguage'); ?>
        </div>
        <div class="span3">
            <?php echo $form->labelEx($model, 'targetLanguage'); ?>
            <?php echo $form->hiddenField($model, 'targetLanguage', array('value' => Yii::app()->language)); ?>
            <?php echo '<strong>[ ' . Yii::app()->language . ' ] </strong> ' . Yii::app()->params->languages[Yii::app()->language]; ?>
            <?php echo $form->error($model, 'targetLanguage'); ?>
        </div>
    </div>
    <hr/>
    <?php if (isset($checked) && $checked == true) { ?>

        <div class="row-fluid">
            <div class="span6">
                <h4><?php echo Yii::t('P3PagesModule.crud', 'Step 2'); ?></h4>
                <?php echo $form->labelEx($model, 'sourcePageId'); ?>
                <?php
                    echo $form->dropDownList($model, 'sourcePageId', $model->getAllP3Pages($sourceLanguage), array(
                            'options'     => array(
                                $sourcePageId => array(
                                    'selected' => true
                                )
                            ),
                            'placeholder' => Yii::t('P3PagesModule.crud', 'Select source page'))
                    );
                ?>
                <?php echo $form->error($model, 'sourcePageId'); ?>
                <?php if (Yii::app()->user->hasFlash('sourcePageId')): ?>
                    <div class="errorMessage">
                        <?php echo Yii::app()->user->getFlash('sourcePageId'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="span6">
                <h4><?php echo Yii::t('P3PagesModule.crud', 'Step 3'); ?></h4>
                <?php echo $form->labelEx($model, 'targetParentPageId'); ?>
                <?php
                    echo $form->dropDownList($model, 'targetParentPageId', $model->getAllP3PageParents(Yii::app()->language), array(
                            'options'     => array(
                                $targetParentPageId => array(
                                    'selected' => true
                                )
                            ),
                            'placeholder' => Yii::t('P3PagesModule.crud', 'Select target parent'))
                    );
                ?>
                <?php echo $form->error($model, 'targetParentPageId'); ?>
                <?php if (Yii::app()->user->hasFlash('targetParentPageId')): ?>
                    <div class="errorMessage">
                        <?php echo Yii::app()->user->getFlash('targetParentPageId'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <hr/>
        <div class="row-fluid">
            <div class="span12">
                <h4><?php echo Yii::t('P3PagesModule.crud', 'Step 4 - Status'); ?>
                    <span style="padding-right: 30px;"></span>
                    <span id="statusPublished" class="label label-success">
                        <i class="icon-flag icon-white"></i> <?php echo Yii::t('P3PagesModule.crud', 'All Published'); ?></span>
                    <span id="statusDraft" class="label label-warning">
                        <i class="icon-flag icon-white"></i> <?php echo Yii::t('P3PagesModule.crud', 'All Draft'); ?></span>
                    <span id="statusArchived" class="label label-info">
                        <i class="icon-flag icon-white"></i> <?php echo Yii::t('P3PagesModule.crud', 'All Archived'); ?></span>
                </h4>
            </div>
        </div>
        <br/>
        <div id="p3statusRow" class="row-fluid">
            <div class="span3">
                <?php echo $form->labelEx($model, 'p3pageStatus'); ?>
                <?php
                    echo $form->dropDownList($model, 'p3pageStatus', $model->P3StatusList, array(
                            'id'          => 'p3pageStatus',
                            'options'     => array(
                                $p3pageStatus => array(
                                    'selected' => true
                                )
                            ),
                            'placeholder' => Yii::t('P3PagesModule.crud', 'Select status')
                        )
                    );
                ?>
                <?php echo $form->error($model, 'p3pageStatus'); ?>
            </div>
            <div class="span3">
                <?php echo $form->labelEx($model, 'p3pageTranslationStatus'); ?>
                <?php
                    echo $form->dropDownList($model, 'p3pageTranslationStatus', $model->P3StatusList, array(
                            'id'          => 'p3pageTranslationStatus',
                            'options'     => array(
                                $p3pageTranslationStatus => array(
                                    'selected' => true
                                )
                            ),
                            'placeholder' => Yii::t('P3PagesModule.crud', 'Select status')
                        )
                    );
                ?>
                <?php echo $form->error($model, 'p3pageTranslationStatus'); ?>
            </div>
            <div class="span3">
                <?php echo $form->labelEx($model, 'p3widgetStatus'); ?>
                <?php
                    echo $form->dropDownList($model, 'p3widgetStatus', $model->P3StatusList, array(
                            'id'          => 'p3widgetStatus',
                            'options'     => array(
                                $p3widgetStatus => array(
                                    'selected' => true
                                )
                            ),
                            'placeholder' => Yii::t('P3PagesModule.crud', 'Select status')
                        )
                    );
                ?>
                <?php echo $form->error($model, 'p3widgetStatus'); ?>
            </div>
            <div class="span3">
                <?php echo $form->labelEx($model, 'p3widgetTranslationStatus'); ?>
                <?php
                    echo $form->dropDownList($model, 'p3widgetTranslationStatus', $model->P3StatusList, array(
                            'id'          => 'p3widgetTranslationStatus',
                            'options'     => array(
                                $p3widgetTranslationStatus => array(
                                    'selected' => true
                                )
                            ),
                            'placeholder' => Yii::t('P3PagesModule.crud', 'Select status')
                        )
                    );
                ?>
                <?php echo $form->error($model, 'p3widgetTranslationStatus'); ?>
            </div>
        </div>
        <hr/>
        <h4><?php echo Yii::t('P3PagesModule.crud', 'Step 5 - Rights'); ?></h4>
        <div class="row-fluid">
            <div class="span6">
                <?php echo $form->labelEx($model, 'p3pageRole'); ?>
                <?php
                    echo $form->dropDownList($model, 'p3pageRole', $model->userRoles, array(
                            'placeholder' => Yii::t('P3PagesModule.crud', 'Select Role')
                        )
                    );
                ?>
                <?php echo $form->error($model, 'p3pageRole'); ?>
            </div>
            <div class="span6">
                <?php echo $form->labelEx($model, 'p3widgetRole'); ?>
                <?php
                    echo $form->dropDownList($model, 'p3widgetRole', $model->userRoles, array(
                            'placeholder' => Yii::t('P3PagesModule.crud', 'Select Role')
                        )
                    );
                ?>
                <?php echo $form->error($model, 'p3widgetRole'); ?>
            </div>
        </div>
        <hr/>
        <div class="row-fluid">
            <div class="span6">
                <h4><?php echo Yii::t('P3PagesModule.crud', 'Step 6'); ?></h4>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <?php
                    $this->widget("bootstrap.widgets.TbButton", array(
                            "label"       => Yii::t('app', 'Copy Now'),
                            "buttonType"  => "submit",
                            "htmlOptions" => array(
                                "class" => "btn btn-large btn-info",
                            ),
                            "icon"        => "icon-plus icon-white icon-2x",
                        )
                    );
                ?>
            </div>
        </div>
    <?php
    }
}
?>
<?php $this->endWidget(); ?>
<?php
    if (isset($newPage)) {

        $formDelete = $this->beginWidget('TbActiveForm', array(
                'id'                     => 'p3-page-form',
                'enableAjaxValidation'   => true,
                'enableClientValidation' => true,
                'htmlOptions'            => array(
                    'enctype' => ''
                )
            )
        );
        ?>
        <div class="row-fluid">
            <div class="span6">
                <h4><?php echo Yii::t('P3PagesModule.crud', 'Step 7'); ?></h4>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <div class="breadcrumb">
                    <h4>
                    <span
                        class="label label-default"><i class="icon-pencil icon-white"></i></span>
                    <span><?php
                            echo CHtml::link(
                                '<i class="icon-flag icon-white"></i> ', null, array(
                                    'class'       => 'label label-default',
                                    'data-toggle' => 'tooltip',
                                    'title'       => $newPage->status
                                )
                            );
                        ?>
                    </span>
                        <?php
                            echo $newPage->default_menu_name;
                            echo '&nbsp;&nbsp;';
                            echo CHtml::link(
                                '<i class="icon-circle-arrow-right"></i> ', $newPage->createUrl(), array(
                                    'class'          => '',
                                    'data-toggle'    => 'tooltip',
                                    'data-placement' => 'right',
                                    'title'          => 'Go to Frontend-Page'
                                )
                            )
                        ?>
                    </h4>
                    <?php
                        echo CHtml::link(
                            '<i class="icon-pencil"></i> ' . ' <b>' . $newPage->name_id . '</b> ' . ' #' . $newPage->id, array(
                                '/p3pages/p3Page/update',
                                'id'        => $newPage->id,
                                'returnUrl' => Yii::app()->controller->createUrl('/p3pages/default/index')
                            ), array(
                                'target'      => '_blank',
                                'class'       => 'btn',
                                'data-toggle' => 'tooltip',
                                'title'       => Yii::t('P3PagesModule.crud', 'Update Page')
                            )
                        );
                        if (isset($newPageTranslation) && $newPageTranslation->id !== null) {
                            echo CHtml::link(
                                '<i class="icon-flag"></i> ' . $newPageTranslation->language, array(
                                    '/p3pages/p3PageTranslation/update',
                                    'id'        => $newPageTranslation->id,
                                    'returnUrl' => Yii::app()->controller->createUrl('/p3pages/default/index')
                                ), array(
                                    'target'      => '_blank',
                                    'class'       => 'btn',
                                    'data-toggle' => 'tooltip',
                                    'title'       => Yii::t('P3PagesModule.crud', 'Update Translation')
                                )
                            );
                        }
                        echo CHtml::link(
                            '<i class="icon-plus-sign icon-white"></i> ', array(
                                '/p3pages/p3PageCopy/index',
                            ), array(
                                'class'       => 'btn btn-success pull-right',
                                'data-toggle' => 'tooltip',
                                'title'       => Yii::t('P3PagesModule.crud', 'New Copy Page')
                            )
                        );
                    ?>
                    <br/>
                    <br/>

                    <p>
                    <span
                        class="label label-info"><?php echo ($newPage->url_json != '{}') ? $newPage->url_json : '' ?></span>
                        <span class="label"><?php echo Yii::t('P3PagesModule.crud', 'Layout & View') ?></span>
                        <?php echo $newPage->layout ?>
                        <?php echo $newPage->view ?>
                    </p>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    <?php
    }

