<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
</p>

<?php
$form=$this->beginWidget('CActiveForm', array(
'id'=>'p3-page-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	)); 

echo $form->errorSummary($model);
?>

	<div class="row">
<?php echo $form->labelEx($model,'title'); ?>
<?php echo $form->textField($model,'title',array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->error($model,'title'); ?>
<div class='hint'><?php if('hint.P3Page.title' != $hint = Yii::t('app', 'title')) echo $hint; ?></div>
</div>

<div class="row">
<?php echo $form->labelEx($model,'description'); ?>
<?php echo $form->textField($model,'description',array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->error($model,'description'); ?>
<div class='hint'><?php if('hint.P3Page.description' != $hint = Yii::t('app', 'description')) echo $hint; ?></div>
</div>

<div class="row">
<?php echo $form->labelEx($model,'keywords'); ?>
<?php echo $form->textField($model,'keywords',array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->error($model,'keywords'); ?>
<div class='hint'><?php if('hint.P3Page.keywords' != $hint = Yii::t('app', 'keywords')) echo $hint; ?></div>
</div>

<div class="row">
<?php echo $form->labelEx($model,'controller'); ?>
<?php echo $form->textField($model,'controller',array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->error($model,'controller'); ?>
<div class='hint'><?php if('hint.P3Page.controller' != $hint = Yii::t('app', 'controller')) echo $hint; ?></div>
</div>

<div class="row">
<?php echo $form->labelEx($model,'params'); ?>
<?php echo $form->textField($model,'params',array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->error($model,'params'); ?>
<div class='hint'><?php if('hint.P3Page.params' != $hint = Yii::t('app', 'params')) echo $hint; ?></div>
</div>


<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			'submit' => array('p3page/admin'))); 
echo CHtml::submitButton(Yii::t('app', 'Save')); 
$this->endWidget(); ?>
</div> <!-- form -->
