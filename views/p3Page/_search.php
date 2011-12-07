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
                <?php echo $form->textField($model,'description',array('size'=>45,'maxlength'=>45)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'keywords'); ?>
                <?php echo $form->textField($model,'keywords',array('size'=>45,'maxlength'=>45)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'controller'); ?>
                <?php echo $form->textField($model,'controller',array('size'=>45,'maxlength'=>45)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'params'); ?>
                <?php echo $form->textField($model,'params',array('size'=>45,'maxlength'=>45)); ?>
        </div>
    
        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
