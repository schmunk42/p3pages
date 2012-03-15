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
                <?php echo $form->label($model,'layout'); ?>
                <?php echo $form->textField($model,'layout',array('size'=>60,'maxlength'=>128)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'view'); ?>
                <?php echo $form->textField($model,'view',array('size'=>60,'maxlength'=>128)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'route'); ?>
                <?php echo $form->textField($model,'route',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    
        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
