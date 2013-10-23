<div class="crud-form">

    
    <?php
        Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
        Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
        Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

        $form=$this->beginWidget('TbActiveForm', array(
            'id' => 'p3-page-translation-form',
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
                            <?php echo $form->labelEx($model, 'p3_page_id') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.p3_page_id')) != 'tooltip.p3_page_id')?$t:'' ?>'>
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
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'language') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.language')) != 'tooltip.language')?$t:'' ?>'>
                                <?php
                            echo $form->dropDownList($model,'language',P3PageTranslation::optslanguage(),array('empty'=>'undefined'));;
                            echo $form->error($model,'language')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'menu_name') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.menu_name')) != 'tooltip.menu_name')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'menu_name', array('size' => 60, 'maxlength' => 128));
                            echo $form->error($model,'menu_name')
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
                            echo $form->dropDownList($model,'status',P3PageTranslation::optsstatus(),array('empty'=>'undefined'));;
                            echo $form->error($model,'status')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'page_title') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.page_title')) != 'tooltip.page_title')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'page_title', array('size' => 60, 'maxlength' => 255));
                            echo $form->error($model,'page_title')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'url_param') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.url_param')) != 'tooltip.url_param')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'url_param', array('size' => 60, 'maxlength' => 255));
                            echo $form->error($model,'url_param')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'keywords') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.keywords')) != 'tooltip.keywords')?$t:'' ?>'>
                                <?php
                            echo $form->textArea($model, 'keywords', array('rows' => 6, 'cols' => 50));
                            echo $form->error($model,'keywords')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'description') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.description')) != 'tooltip.description')?$t:'' ?>'>
                                <?php
                            echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50));
                            echo $form->error($model,'description')
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
                            <?php echo $form->labelEx($model, 'access_read') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('P3PagesModule.model', 'tooltip.access_read')) != 'tooltip.access_read')?$t:'' ?>'>
                                <?php
                            echo $form->dropDownList($model,'access_read',P3PageTranslation::optsaccessread(),array('empty'=>'undefined'));;
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
                            echo $form->dropDownList($model,'access_update',P3PageTranslation::optsaccessupdate(),array('empty'=>'undefined'));;
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
                            echo $form->dropDownList($model,'access_delete',P3PageTranslation::optsaccessdelete(),array('empty'=>'undefined'));;
                            echo $form->error($model,'access_delete')
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
                'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('p3PageTranslation/admin'),
                'class' => 'btn'
            ));
            echo ' '.CHtml::submitButton(Yii::t('P3PagesModule.crud', 'Save'), array(
                'class' => 'btn btn-primary'
            ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->