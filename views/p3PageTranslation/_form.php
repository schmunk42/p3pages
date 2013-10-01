<div class="crud-form">

    
    <?php
        Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
        Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
        Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

        $form=$this->beginWidget('TbActiveForm', array(
            'id' => 'p3-page-translation-form',
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
                            <?php echo $form->labelEx($model, 'language') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->dropDownList($model,'language',P3PageTranslation::optslanguage(),array('empty'=>'undefined'));;
                            echo $form->error($model,'language')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.language')) != 'help.language')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'menu_name') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model, 'menu_name', array('size' => 60, 'maxlength' => 128));
                            echo $form->error($model,'menu_name')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.menu_name')) != 'help.menu_name')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'status') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->dropDownList($model,'status',P3PageTranslation::optsstatus(),array('empty'=>'undefined'));;
                            echo $form->error($model,'status')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.status')) != 'help.status')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'page_title') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model, 'page_title', array('size' => 60, 'maxlength' => 255));
                            echo $form->error($model,'page_title')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.page_title')) != 'help.page_title')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'url_param') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model, 'url_param', array('size' => 60, 'maxlength' => 255));
                            echo $form->error($model,'url_param')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.url_param')) != 'help.url_param')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'keywords') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textArea($model, 'keywords', array('rows' => 6, 'cols' => 50));
                            echo $form->error($model,'keywords')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.keywords')) != 'help.keywords')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'description') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50));
                            echo $form->error($model,'description')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.description')) != 'help.description')?$t:'' ?>
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
                            <?php echo $form->labelEx($model, 'access_read') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->dropDownList($model,'access_read',P3PageTranslation::optsaccessread(),array('empty'=>'undefined'));;
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
                            echo $form->dropDownList($model,'access_update',P3PageTranslation::optsaccessupdate(),array('empty'=>'undefined'));;
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
                            echo $form->dropDownList($model,'access_delete',P3PageTranslation::optsaccessdelete(),array('empty'=>'undefined'));;
                            echo $form->error($model,'access_delete')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.access_delete')) != 'help.access_delete')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'p3_page_id') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            $this->widget(
                '\GtcRelation',
                array(
                    'model' => $model,
                    'relation' => 'p3Page',
                    'fields' => 'itemLabel',
                    'allowEmpty' => true,
                    'style' => 'dropdownlist',
                    'htmlOptions' => array(
                        'checkAll' => 'all'
                    ),
                )
                );
                            echo $form->error($model,'p3_page_id')
                            ?>
                            <span class="help-block">
                                <?php echo (($t = Yii::t('P3PagesModule.model', 'help.p3_page_id')) != 'help.p3_page_id')?$t:'' ?>
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
                            
        </div>
        <!-- sub inputs -->
    </div>

    <p class="alert">
        <?php echo Yii::t('crud','Fields with <span class="required">*</span> are required.');?>
    </p>

    <div class="form-actions">
        
        <?php
            echo CHtml::Button(
            Yii::t('crud', 'Cancel'), array(
                'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('p3PageTranslation/admin'),
                'class' => 'btn'
            ));
            echo ' '.CHtml::submitButton(Yii::t('crud', 'Save'), array(
                'class' => 'btn btn-primary'
            ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->