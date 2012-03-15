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
<?php echo $form->labelEx($model,'layout'); ?>
<?php echo $form->textField($model,'layout',array('size'=>60,'maxlength'=>128)); ?>
<?php echo $form->error($model,'layout'); ?>
<div class='hint'><?php if('hint.P3Page.layout' != $hint = Yii::t('app', 'layout')) echo $hint; ?></div>
</div>

<div class="row">
<?php echo $form->labelEx($model,'view'); ?>
<?php echo $form->textField($model,'view',array('size'=>60,'maxlength'=>128)); ?>
<?php echo $form->error($model,'view'); ?>
<div class='hint'><?php if('hint.P3Page.view' != $hint = Yii::t('app', 'view')) echo $hint; ?></div>
</div>

<div class="row">
<?php echo $form->labelEx($model,'route'); ?>
<?php echo $form->textField($model,'route',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'route'); ?>
<div class='hint'><?php if('hint.P3Page.route' != $hint = Yii::t('app', 'route')) echo $hint; ?></div>
</div>

<div class="row">
<label for="p3PageMeta"><?php echo Yii::t('app', 'P3PageMeta'); ?></label>
<?php if ($model->p3PageMeta !== null) echo $model->p3PageMeta->_label;; ?><br />
</div>


<?php
echo CHtml::Button(Yii::t('app', 'Cancel'), array(
			'submit' => array('p3page/admin'))); 
echo CHtml::submitButton(Yii::t('app', 'Save')); 
$this->endWidget(); ?>
</div> <!-- form -->
