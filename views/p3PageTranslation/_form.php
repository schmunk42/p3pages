<div class="form">
    <p class="note">
        <?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>        .
    </p>

    <?php
    $form=$this->beginWidget('CActiveForm', array(
    'id'=>'p3-page-translation-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    ));

    echo $form->errorSummary($model);
    ?>

    <div class="row">
<?php echo $form->labelEx($model,'language'); ?>

<?php echo $form->textField($model,'language',array('size'=>8,'maxlength'=>8)); ?>
<?php echo $form->error($model,'language'); ?>
<div class='hint'><?php if('hint.language' != $hint = Yii::t('crud-P3PageTranslation', 'hint.language')) echo $hint; ?></div>
</div>

<div class="row">
<?php echo $form->labelEx($model,'seoUrl'); ?>
<?php echo $form->textField($model,'seoUrl',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'seoUrl'); ?>
<div class='hint'><?php if('hint.seoUrl' != $hint = Yii::t('crud-P3PageTranslation', 'hint.seoUrl')) echo $hint; ?></div>
</div>

<div class="row">
<?php echo $form->labelEx($model,'pageTitle'); ?>
<?php echo $form->textField($model,'pageTitle',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'pageTitle'); ?>
<div class='hint'><?php if('hint.pageTitle' != $hint = Yii::t('crud-P3PageTranslation', 'hint.pageTitle')) echo $hint; ?></div>
</div>

<div class="row">
<?php echo $form->labelEx($model,'menuName'); ?>
<?php echo $form->textField($model,'menuName',array('size'=>60,'maxlength'=>128)); ?>
<?php echo $form->error($model,'menuName'); ?>
<div class='hint'><?php if('hint.menuName' != $hint = Yii::t('crud-P3PageTranslation', 'hint.menuName')) echo $hint; ?></div>
</div>

<div class="row">
<?php echo $form->labelEx($model,'keywords'); ?>
<?php echo $form->textArea($model,'keywords',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'keywords'); ?>
<div class='hint'><?php if('hint.keywords' != $hint = Yii::t('crud-P3PageTranslation', 'hint.keywords')) echo $hint; ?></div>
</div>

<div class="row">
<?php echo $form->labelEx($model,'description'); ?>
<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'description'); ?>
<div class='hint'><?php if('hint.description' != $hint = Yii::t('crud-P3PageTranslation', 'hint.description')) echo $hint; ?></div>
</div>

<div class="row">
<label for="p3Page"><?php echo Yii::t('app', 'P3Page'); ?></label>
<?php $this->widget(
					'Relation',
					array(
							'model' => $model,
							'relation' => 'p3Page',
							'fields' => 'layout',
							'allowEmpty' => false,
							'style' => 'dropdownlist',
							'htmlOptions' => array(
								'checkAll' => Yii::t('app', 'Choose all'),
								),)
						); ?><br />
</div>


    
    <?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			'submit' => array('p3pagetranslation/admin')));
echo CHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
