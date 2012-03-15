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
                <?php echo $form->label($model,'p3_page_id'); ?>
                <?php echo $form->dropDownList($model,'p3_page_id',CHtml::listData(P3Page::model()->findAll(), 'id', '_label'),array('prompt'=>Yii::t('app', 'All'))); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'language'); ?>
                <?php echo $form->textField($model,'language',array('size'=>8,'maxlength'=>8)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'seoUrl'); ?>
                <?php echo $form->textField($model,'seoUrl',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'pageTitle'); ?>
                <?php echo $form->textField($model,'pageTitle',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'menuName'); ?>
                <?php echo $form->textField($model,'menuName',array('size'=>60,'maxlength'=>128)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'keywords'); ?>
                <?php echo $form->textArea($model,'keywords',array('rows'=>6, 'cols'=>50)); ?>
        </div>
    
        <div class="row">
                <?php echo $form->label($model,'description'); ?>
                <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        </div>
    
        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
