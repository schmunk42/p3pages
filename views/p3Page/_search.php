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
        <?php echo $form->label($model, 'name_id'); ?>
        <?php echo $form->textField($model, 'name_id', array('size' => 60, 'maxlength' => 64)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'status'); ?>
        <?php echo $form->textField($model, 'status'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'default_menu_name'); ?>
        <?php echo $form->textField($model, 'default_menu_name', array('size' => 60, 'maxlength' => 128)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'tree_parent_id'); ?>
        <?php echo $form->textField($model, 'tree_parent_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'tree_position'); ?>
        <?php echo $form->textField($model, 'tree_position'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'default_page_title'); ?>
        <?php echo $form->textField($model, 'default_page_title', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'default_url_param'); ?>
        <?php echo $form->textField($model, 'default_url_param', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'layout'); ?>
        <?php echo $form->textField($model, 'layout', array('size' => 60, 'maxlength' => 128)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'view'); ?>
        <?php echo $form->textField($model, 'view', array('size' => 60, 'maxlength' => 128)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'url_json'); ?>
        <?php echo $form->textField($model, 'url_json', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'default_keywords'); ?>
        <?php echo $form->textArea($model, 'default_keywords', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'default_description'); ?>
        <?php echo $form->textArea($model, 'default_description', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'custom_data_json'); ?>
        <?php echo $form->textArea($model, 'custom_data_json', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'access_owner'); ?>
        <?php echo $form->textField($model, 'access_owner', array('size' => 60, 'maxlength' => 64)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'access_domain'); ?>
        <?php echo $form->textField($model, 'access_domain', array('size' => 8, 'maxlength' => 8)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'access_read'); ?>
        <?php echo $form->textField($model, 'access_read', array('size' => 60, 'maxlength' => 256)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'access_update'); ?>
        <?php echo $form->textField($model, 'access_update', array('size' => 60, 'maxlength' => 256)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'access_delete'); ?>
        <?php echo $form->textField($model, 'access_delete', array('size' => 60, 'maxlength' => 256)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'access_append'); ?>
        <?php echo $form->textField($model, 'access_append', array('size' => 60, 'maxlength' => 256)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'created_at'); ?>
        <?php echo $form->textField($model, 'created_at'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'updated_at'); ?>
        <?php echo $form->textField($model, 'updated_at'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'copied_from_id'); ?>
        <?php echo $form->textField($model, 'copied_from_id'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('crud_static', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
