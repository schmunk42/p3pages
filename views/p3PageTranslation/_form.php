<div class="form">
    <p class="note">
        <?php echo Yii::t('P3PagesModule.crud', 'Fields with');?> <span
            class="required">*</span> <?php echo Yii::t('P3PagesModule.crud', 'are required');?>        .
    </p>

    <?php
    $form = $this->beginWidget('CActiveForm', array(
                                                   'id' => 'p3-page-translation-form',
                                                   'enableAjaxValidation' => true,
                                                   'enableClientValidation' => true,
                                              ));

    echo $form->errorSummary($model);
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'language'); ?>

        <?php echo $form->textField($model, 'language', array('size' => 8, 'maxlength' => 8)); ?>
        <?php echo $form->error($model, 'language'); ?>
        <?php if ('help.language' != $help = Yii::t('P3PagesModule.crud', 'help.language')) {
        echo "<span class='help-block'>$help</span>";
    } ?></div>

    <div class="row">
        <?php echo $form->labelEx($model, 'menuName'); ?>
        <?php echo $form->textField($model, 'menuName', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'menuName'); ?>
        <?php if ('help.menuName' != $help = Yii::t('P3PagesModule.crud', 'help.menuName')) {
        echo "<span class='help-block'>$help</span>";
    } ?></div>

    <div class="row">
        <?php echo $form->labelEx($model, 'seoUrl'); ?>
        <?php echo $form->textField($model, 'seoUrl', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'seoUrl'); ?>
        <?php if ('help.seoUrl' != $help = Yii::t('P3PagesModule.crud', 'help.seoUrl')) {
        echo "<span class='help-block'>$help</span>";
    } ?></div>

    <div class="row">
        <?php echo $form->labelEx($model, 'pageTitle'); ?>
        <?php echo $form->textField($model, 'pageTitle', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'pageTitle'); ?>
        <?php if ('help.pageTitle' != $help = Yii::t('P3PagesModule.crud', 'help.pageTitle')) {
        echo "<span class='help-block'>$help</span>";
    } ?></div>

    <div class="row">
        <?php echo $form->labelEx($model, 'keywords'); ?>
        <?php echo $form->textArea($model, 'keywords', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'keywords'); ?>
        <?php if ('help.keywords' != $help = Yii::t('P3PagesModule.crud', 'help.keywords')) {
        echo "<span class='help-block'>$help</span>";
    } ?></div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'description'); ?>
        <?php if ('help.description' != $help = Yii::t('P3PagesModule.crud', 'help.description')) {
        echo "<span class='help-block'>$help</span>";
    } ?></div>

    <div class="row">
        <label for="p3Page"><?php echo Yii::t('P3PagesModule.crud', 'P3Page'); ?></label>
        <?php $this->widget(
        'Relation',
        array(
             'model' => $model,
             'relation' => 'p3Page',
             'fields' => 'layout',
             'allowEmpty' => false,
             'style' => 'dropdownlist',
             'htmlOptions' => array(
                 'checkAll' => 'all'),
        )
    ); ?><br/>
    </div>


</div> <!-- form -->
<div class="form-actions">

    <?php
    echo CHtml::Button(Yii::t('P3PagesModule.crud', 'Cancel'), array(
                                                                    'submit' => array('p3pagetranslation/admin'),
                                                                    'class' => 'btn'
                                                               ));
    echo ' ' . CHtml::submitButton(Yii::t('P3PagesModule.crud', 'Save'), array(
                                                                              'class' => 'btn btn-primary'
                                                                         ));
    $this->endWidget(); ?>
</div>
