<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model,'id'); ?>
                <?php echo $form->textField($model,'id'); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'title'); ?>
                <?php echo $form->textField($model,'title',array('size'=>45,'maxlength'=>45)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'description'); ?>
                <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'keywords'); ?>
                <?php echo $form->textArea($model,'keywords',array('rows'=>6, 'cols'=>50)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'moduleId'); ?>
                <?php echo $form->textField($model,'moduleId',array('size'=>45,'maxlength'=>45)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'controllerId'); ?>
                <?php echo $form->textField($model,'controllerId',array('size'=>45,'maxlength'=>45)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'actionName'); ?>
                <?php echo $form->textField($model,'actionName',array('size'=>45,'maxlength'=>45)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'requestParam'); ?>
                <?php echo $form->textField($model,'requestParam',array('size'=>45,'maxlength'=>45)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'layout'); ?>
                <?php echo $form->textField($model,'layout',array('size'=>60,'maxlength'=>128)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'view'); ?>
                <?php echo $form->textField($model,'view',array('size'=>60,'maxlength'=>128)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'url'); ?>
                <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    
        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
