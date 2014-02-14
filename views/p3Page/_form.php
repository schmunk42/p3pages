<div class="crud-form">

    
    <?php
        Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
        Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
        Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

        $form=$this->beginWidget('TbActiveForm', array(
            'id' => 'p3-page-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'htmlOptions' => array(
                'enctype' => ''
            )
        ));

        echo $form->errorSummary($model);
    ?>
    
    <div class="row">
        <div class="span7">
            <h2>
                <?php echo Yii::t('P3PagesModule.crud','Data')?>                <small>
                    #<?php echo $model->id ?>                </small>

            </h2>


            <div class="form-horizontal">

                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php  ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.id')) != 'tooltip.id')?$t:'' ?>'>
                                <?php
                            ;
                            echo $form->error($model,'id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'default_menu_name') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.default_menu_name')) != 'tooltip.default_menu_name')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'default_menu_name', array('size' => 60, 'maxlength' => 128));
                            echo $form->error($model,'default_menu_name')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'status') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.status')) != 'tooltip.status')?$t:'' ?>'>
                                <?php
                            echo $form->dropDownList($model,'status',P3Page::optsstatus(),array('empty'=>'undefined'));;
                            echo $form->error($model,'status')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'name_id') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.name_id')) != 'tooltip.name_id')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'name_id', array('size' => 60, 'maxlength' => 64));
                            echo $form->error($model,'name_id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php echo '<h3>Tree</h3>' ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'tree_parent_id') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.tree_parent_id')) != 'tooltip.tree_parent_id')?$t:'' ?>'>
                                <?php
                            $this->widget(
                    '\GtcRelation',
                    array(
                        'model' => $model,
                        'relation' => 'treeParent',
                        'fields' => 'itemLabel',
                        'allowEmpty' => true,
                        'style' => 'dropdownlist',
                        'htmlOptions' => array(
                            'checkAll' => 'all'
                        ),
                        'criteria' => array(
                            'condition' => 'access_domain=:lang',
                            'params'    => array(
                                ':lang' => Yii::app()->language,
                            )
                        )
                    )
                );
                            echo $form->error($model,'tree_parent_id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'tree_position') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.tree_position')) != 'tooltip.tree_position')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'tree_position');
                            echo $form->error($model,'tree_position')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php echo '<h3>A) Title, Layout & View</h3>' ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'default_page_title') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.default_page_title')) != 'tooltip.default_page_title')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'default_page_title', array('size' => 60, 'maxlength' => 255));
                            echo $form->error($model,'default_page_title')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'layout') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.layout')) != 'tooltip.layout')?$t:'' ?>'>
                                <?php
                            echo $form->dropDownList($model,'layout',P3Page::optslayout(),array('empty'=>'undefined'));;
                            echo $form->error($model,'layout')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'view') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.view')) != 'tooltip.view')?$t:'' ?>'>
                                <?php
                            echo $form->dropDownList($model,'view',P3Page::optsview(),array('empty'=>'undefined'));;
                            echo $form->error($model,'view')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php echo '<h3>B) Weiterleitung</h3>' ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'url_json') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.url_json')) != 'tooltip.url_json')?$t:'' ?>'>
                                <?php
                            $this->widget(
                'jsonEditorView.JuiJSONEditorInput',
                array(
                     'model'     => $model,
                     'attribute' => 'url_json'
                )
            );;
                            echo $form->error($model,'url_json')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php echo '<h3>SEO</h3>' ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'default_url_param') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.default_url_param')) != 'tooltip.default_url_param')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'default_url_param', array('size' => 60, 'maxlength' => 255));
                            echo $form->error($model,'default_url_param')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'default_keywords') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.default_keywords')) != 'tooltip.default_keywords')?$t:'' ?>'>
                                <?php
                            echo $form->textArea($model, 'default_keywords', array('rows' => 6, 'cols' => 50));
                            echo $form->error($model,'default_keywords')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'default_description') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.default_description')) != 'tooltip.default_description')?$t:'' ?>'>
                                <?php
                            echo $form->textArea($model, 'default_description', array('rows' => 6, 'cols' => 50));
                            echo $form->error($model,'default_description')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'custom_data_json') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.custom_data_json')) != 'tooltip.custom_data_json')?$t:'' ?>'>
                                <?php
                            $this->widget(
                'jsonEditorView.JuiJSONEditorInput',
                array(
                     'model'     => $model,
                     'attribute' => 'custom_data_json'
                )
            );;
                            echo $form->error($model,'custom_data_json')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php echo '<h3>Access</h3>' ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'access_owner') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.access_owner')) != 'tooltip.access_owner')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model,'access_owner',array('disabled'=>'disabled'));
                            echo $form->error($model,'access_owner')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'access_domain') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.access_domain')) != 'tooltip.access_domain')?$t:'' ?>'>
                                <?php
                            echo $form->dropDownList($model,'access_domain',P3Page::optsaccessdomain(),array('empty'=>'undefined'));;
                            echo $form->error($model,'access_domain')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'access_read') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.access_read')) != 'tooltip.access_read')?$t:'' ?>'>
                                <?php
                            echo $form->dropDownList($model,'access_read',P3Page::optsaccessread(),array('empty'=>'undefined'));;
                            echo $form->error($model,'access_read')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'access_update') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.access_update')) != 'tooltip.access_update')?$t:'' ?>'>
                                <?php
                            echo $form->dropDownList($model,'access_update',P3Page::optsaccessupdate(),array('empty'=>'undefined'));;
                            echo $form->error($model,'access_update')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'access_delete') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.access_delete')) != 'tooltip.access_delete')?$t:'' ?>'>
                                <?php
                            echo $form->dropDownList($model,'access_delete',P3Page::optsaccessdelete(),array('empty'=>'undefined'));;
                            echo $form->error($model,'access_delete')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'access_append') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.access_append')) != 'tooltip.access_append')?$t:'' ?>'>
                                <?php
                            echo $form->dropDownList($model,'access_append',P3Page::optsaccessappend(),array('empty'=>'undefined'));;
                            echo $form->error($model,'access_append')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'copied_from_id') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.copied_from_id')) != 'tooltip.copied_from_id')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model,'copied_from_id',array('disabled'=>'disabled'));
                            echo $form->error($model,'copied_from_id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'created_at') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.created_at')) != 'tooltip.created_at')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model,'created_at',array('disabled'=>'disabled'));
                            echo $form->error($model,'created_at')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'updated_at') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.updated_at')) != 'tooltip.updated_at')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model,'updated_at',array('disabled'=>'disabled'));
                            echo $form->error($model,'updated_at')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                
            </div>
        </div>
        <!-- main inputs -->

        
        <div class="span5"><!-- sub inputs -->
            <div class="well">
            <!--<h2>
                <?php echo Yii::t('P3PagesModule.crud','Relations')?>            </h2>-->
                                                            
                <h3>
                    <?php echo Yii::t('P3PagesModule.model', 'relation.P3Pages'); ?>
                </h3>
                <?php echo '<i>'.Yii::t('P3PagesModule.crud','Switch to view mode to edit related records.').'</i>' ?>
                                                            
                <h3>
                    <?php echo Yii::t('P3PagesModule.model', 'relation.P3PageTranslations'); ?>
                </h3>
                <?php echo '<i>'.Yii::t('P3PagesModule.crud','Switch to view mode to edit related records.').'</i>' ?>
                                        </div>
        </div>
        <!-- sub inputs -->
    </div>

    <p class="alert">
        <?php echo Yii::t('P3PagesModule.crud','Fields with <span class="required">*</span> are required.');?>
    </p>

    <!-- TODO: We need the buttons inside the form, when a user hits <enter> -->
    <div class="form-actions" style="visibility: hidden; height: 1px">
        
        <?php
            echo CHtml::Button(
            Yii::t('P3PagesModule.crud', 'Cancel'), array(
                'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('p3Page/admin'),
                'class' => 'btn'
            ));
            echo ' '.CHtml::submitButton(Yii::t('P3PagesModule.crud', 'Save'), array(
                'class' => 'btn btn-primary'
            ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->