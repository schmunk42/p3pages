<div class="wide form">

    <?php
    $form = $this->beginWidget('TbActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>
    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php ; ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'p3_page_id'); ?>
        <?php echo $form->textField($model, 'p3_page_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'language'); ?>
        <?php echo $form->dropDownList($model,'language',P3PageTranslation::optslanguage(),array('empty'=>'undefined'));; ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'menu_name'); ?>
        <?php echo $form->textField($model, 'menu_name', array('size' => 60, 'maxlength' => 128)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'status'); ?>
        <?php echo $form->dropDownList($model,'status',P3PageTranslation::optsstatus(),array('empty'=>'undefined'));; ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'page_title'); ?>
        <?php echo $form->textField($model, 'page_title', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'url_param'); ?>
        <?php echo $form->textField($model, 'url_param', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'keywords'); ?>
        <?php echo $form->textArea($model, 'keywords', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'access_owner'); ?>
        <?php echo $form->textField($model, 'access_owner', array('size' => 60, 'maxlength' => 64)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'access_read'); ?>
        <?php echo $form->dropDownList($model,'access_read',P3PageTranslation::optsaccessread(),array('empty'=>'undefined'));; ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'access_update'); ?>
        <?php echo $form->dropDownList($model,'access_update',P3PageTranslation::optsaccessupdate(),array('empty'=>'undefined'));; ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'access_delete'); ?>
        <?php echo $form->dropDownList($model,'access_delete',P3PageTranslation::optsaccessdelete(),array('empty'=>'undefined'));; ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'copied_from_id'); ?>
        <?php echo $form->textField($model, 'copied_from_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'created_at'); ?>
        <?php echo $form->textField($model, 'created_at'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'updated_at'); ?>
        <?php echo $form->textField($model, 'updated_at'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('P3PagesModule.crud', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
