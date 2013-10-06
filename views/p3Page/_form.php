<div class="crud-form">

    
    <?php
        Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
        Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
        Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

        $form=$this->beginWidget('TbActiveForm', array(
            'id' => 'p3-page-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
        ));

        echo $form->errorSummary($model);
    ?>
    
    <div class="row">
        <div class="span7"> <!-- main inputs -->
            <h2>
                <?php echo Yii::t('crud','Data')?>                <small>
                    <?php echo $model->itemLabel ?>
                </small>

            </h2>


            <div class="form-horizontal">

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php  ?>
                        </div>
                        <div class='controls'>
                            <?php
                            ;
                            echo $form->error($model,'id')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.id')) != 'help.id')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'default_menu_name') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model, 'default_menu_name', array('size' => 60, 'maxlength' => 128));
                            echo $form->error($model,'default_menu_name')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.default_menu_name')) != 'help.default_menu_name')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'status') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->dropDownList($model,'status',P3Page::optsstatus(),array('empty'=>'undefined'));;
                            echo $form->error($model,'status')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.status')) != 'help.status')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'name_id') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model, 'name_id', array('size' => 60, 'maxlength' => 64));
                            echo $form->error($model,'name_id')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.name_id')) != 'help.name_id')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'tree_parent_id') ?>
                        </div>
                        <div class='controls'>
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
                )
                );
                            echo $form->error($model,'tree_parent_id')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.tree_parent_id')) != 'help.tree_parent_id')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'tree_position') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model, 'tree_position');
                            echo $form->error($model,'tree_position')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.tree_position')) != 'help.tree_position')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'default_page_title') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model, 'default_page_title', array('size' => 60, 'maxlength' => 255));
                            echo $form->error($model,'default_page_title')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.default_page_title')) != 'help.default_page_title')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'default_url_param') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model, 'default_url_param', array('size' => 60, 'maxlength' => 255));
                            echo $form->error($model,'default_url_param')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.default_url_param')) != 'help.default_url_param')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'layout') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->dropDownList($model,'layout',P3Page::optslayout(),array('empty'=>'undefined'));;
                            echo $form->error($model,'layout')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.layout')) != 'help.layout')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'view') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->dropDownList($model,'view',P3Page::optsview(),array('empty'=>'undefined'));;
                            echo $form->error($model,'view')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.view')) != 'help.view')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'url_json') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            $this->widget(
                'jsonEditorView.JuiJSONEditorInput',
                array(
                     'model'     => $model,
                     'attribute' => 'url_json'
                )
            );;
                            echo $form->error($model,'url_json')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.url_json')) != 'help.url_json')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'default_keywords') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textArea($model, 'default_keywords', array('rows' => 6, 'cols' => 50));
                            echo $form->error($model,'default_keywords')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.default_keywords')) != 'help.default_keywords')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'default_description') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textArea($model, 'default_description', array('rows' => 6, 'cols' => 50));
                            echo $form->error($model,'default_description')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.default_description')) != 'help.default_description')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'custom_data_json') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            $this->widget(
                'jsonEditorView.JuiJSONEditorInput',
                array(
                     'model'     => $model,
                     'attribute' => 'custom_data_json'
                )
            );;
                            echo $form->error($model,'custom_data_json')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.custom_data_json')) != 'help.custom_data_json')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'access_owner') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'access_owner',array('disabled'=>'disabled'));
                            echo $form->error($model,'access_owner')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.access_owner')) != 'help.access_owner')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'access_domain') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->dropDownList($model,'access_domain',P3Page::optsaccessdomain(),array('empty'=>'undefined'));;
                            echo $form->error($model,'access_domain')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.access_domain')) != 'help.access_domain')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'access_read') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->dropDownList($model,'access_read',P3Page::optsaccessread(),array('empty'=>'undefined'));;
                            echo $form->error($model,'access_read')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.access_read')) != 'help.access_read')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'access_update') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->dropDownList($model,'access_update',P3Page::optsaccessupdate(),array('empty'=>'undefined'));;
                            echo $form->error($model,'access_update')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.access_update')) != 'help.access_update')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'access_delete') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->dropDownList($model,'access_delete',P3Page::optsaccessdelete(),array('empty'=>'undefined'));;
                            echo $form->error($model,'access_delete')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.access_delete')) != 'help.access_delete')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'access_append') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->dropDownList($model,'access_append',P3Page::optsaccessappend(),array('empty'=>'undefined'));;
                            echo $form->error($model,'access_append')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.access_append')) != 'help.access_append')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'copied_from_id') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'copied_from_id',array('disabled'=>'disabled'));
                            echo $form->error($model,'copied_from_id')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.copied_from_id')) != 'help.copied_from_id')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'created_at') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'created_at',array('disabled'=>'disabled'));
                            echo $form->error($model,'created_at')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.created_at')) != 'help.created_at')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'updated_at') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'updated_at',array('disabled'=>'disabled'));
                            echo $form->error($model,'updated_at')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.updated_at')) != 'help.updated_at')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
            </div>
        </div>
        <!-- main inputs -->

        <div class="span5"> <!-- sub inputs -->
            <h2>
                <?php echo Yii::t('crud','Relations')?>
            </h2>
                                                            
                <h3>
                    <?php echo Yii::t('P3PagesModule.model', 'P3Pages'); ?>
                </h3>
                <?php echo '<i>'.Yii::t('crud','Switch to view mode to edit related records.').'</i>' ?>
                                                            
                <h3>
                    <?php echo Yii::t('P3PagesModule.model', 'P3PageTranslations'); ?>
                </h3>
                <?php echo '<i>'.Yii::t('crud','Switch to view mode to edit related records.').'</i>' ?>
                            
        </div>
        <!-- sub inputs -->
    </div>

    <p class="alert">
        <?php echo Yii::t('crud','Fields with <span class="required">*</span> are required.');?>
    </p>

    <?php $this->endWidget() ?>
</div> <!-- form -->