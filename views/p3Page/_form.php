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
<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'description'); ?>
<div class='hint'><?php if('hint.P3Page.description' != $hint = Yii::t('app', 'description')) echo $hint; ?></div>
</div>

<div class="row">
<?php echo $form->labelEx($model,'keywords'); ?>
<?php echo $form->textArea($model,'keywords',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'keywords'); ?>
<div class='hint'><?php if('hint.P3Page.keywords' != $hint = Yii::t('app', 'keywords')) echo $hint; ?></div>
</div>

<div class="row">
<?php echo $form->labelEx($model,'moduleId'); ?>
<?php echo $form->textField($model,'moduleId',array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->error($model,'moduleId'); ?>
<div class='hint'><?php if('hint.P3Page.moduleId' != $hint = Yii::t('app', 'moduleId')) echo $hint; ?></div>
</div>

<div class="row">
<?php echo $form->labelEx($model,'controllerId'); ?>
<?php echo $form->textField($model,'controllerId',array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->error($model,'controllerId'); ?>
<div class='hint'><?php if('hint.P3Page.controllerId' != $hint = Yii::t('app', 'controllerId')) echo $hint; ?></div>
</div>

<div class="row">
<?php echo $form->labelEx($model,'actionName'); ?>
<?php echo $form->textField($model,'actionName',array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->error($model,'actionName'); ?>
<div class='hint'><?php if('hint.P3Page.actionName' != $hint = Yii::t('app', 'actionName')) echo $hint; ?></div>
</div>

<div class="row">
<?php echo $form->labelEx($model,'requestParam'); ?>
<?php echo $form->textField($model,'requestParam',array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->error($model,'requestParam'); ?>
<div class='hint'><?php if('hint.P3Page.requestParam' != $hint = Yii::t('app', 'requestParam')) echo $hint; ?></div>
</div>

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
<?php echo $form->labelEx($model,'url'); ?>
<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'url'); ?>
<div class='hint'><?php if('hint.P3Page.url' != $hint = Yii::t('app', 'url')) echo $hint; ?></div>
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
