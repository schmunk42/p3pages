<h3><?php echo $model->t('menuName') ?><?php foreach ($model->p3PageTranslations AS $translation): ?>
	<?php echo CHtml::link($translation->language, array('/p3pages/p3PageTranslation/update', 'id' => $translation->id), array('class'=>'btn btn-small')) ?>
<?php endforeach; ?></h3>
<p>
	<?php echo CHtml::link(Yii::t('app','View '), array('/p3pages/p3Page/view', 'id' => $model->id), array('class'=>'btn')) ?> 
<?php echo CHtml::link(Yii::t('app','Update'), array('/p3pages/p3Page/update', 'id' => $model->id), array('class'=>'btn')) ?> 
<?php echo CHtml::link(Yii::t('app','Meta Data'), array('/p3pages/p3PageMeta/update', 'id' => $model->id), array('class'=>'btn')) ?>
</p>