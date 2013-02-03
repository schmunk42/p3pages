<div class="form">
    <p class="note">
        <?php echo Yii::t('P3PagesModule.crud', 'Fields with');?> <span
            class="required">*</span> <?php echo Yii::t('P3PagesModule.crud', 'are required');?>        .
    </p>

    <?php
    $form = $this->beginWidget('CActiveForm', array(
                                                   'id' => 'p3-page-form',
                                                   'enableAjaxValidation' => true,
                                                   'enableClientValidation' => true,
                                              ));

    echo $form->errorSummary($model);
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'layout'); ?>

        <?php echo $form->dropDownList($model, 'layout', $this->module->params['availableLayouts'], array('empty'=>'none')); ?>
        <?php echo $form->error($model, 'layout'); ?>
        <?php if ('help.layout' != $help = Yii::t('P3PagesModule.crud', 'help.layout')) {
        echo "<span class='help-block'>$help</span>";
    } ?></div>

    <div class="row">
        <?php echo $form->labelEx($model, 'view'); ?>
        <?php echo $form->dropDownList($model, 'view', $this->module->params['availableViews'], array('empty'=>'none')); ?>
        <?php echo $form->error($model, 'view'); ?>
        <?php if ('help.view' != $help = Yii::t('P3PagesModule.crud', 'help.view')) {
        echo "<span class='help-block'>$help</span>";
    } ?></div>

    <div class="row">
        <?php echo $form->labelEx($model, 'route'); ?>
        <?php
        $this->widget('jsonEditorView.JuiJSONEditorInput', array(
                                                                'model' => $model,
                                                                // ActiveRecord, or any CModel child class
                                                                'attribute' => 'route'
                                                                // Model attribute holding initial JSON data string
                                                           ));
        ?>
        <div class="notice">Do not use double quotes (") for keys and/or values!</div>
        <?php echo $form->error($model, 'route'); ?>
        <?php if ('help.route' != $help = Yii::t('P3PagesModule.crud', 'help.route')) {
        echo "<span class='help-block'>$help</span>";
    } ?></div>

    <div class="row">
        <label for="p3PageMeta"><?php echo Yii::t('P3PagesModule.crud', 'P3PageMeta'); ?></label>
        <?php if ($model->p3PageMeta !== null) {
        echo $model->p3PageMeta->status;
    }; ?><br/>
    </div>


</div> <!-- form -->
<div class="form-actions">

    <?php
    echo CHtml::Button(Yii::t('P3PagesModule.crud', 'Cancel'), array(
                                                                    'submit' => array('p3page/admin'),
                                                                    'class' => 'btn'
                                                               ));
    echo ' ' . CHtml::submitButton(Yii::t('P3PagesModule.crud', 'Save'), array(
                                                                              'class' => 'btn btn-primary'
                                                                         ));
    $this->endWidget(); ?>
</div>
