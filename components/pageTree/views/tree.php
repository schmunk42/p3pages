<h3><?php echo CHtml::link($model->t('menuName'),$model->createUrl()) ?>  <?php foreach ($model->p3PageTranslations AS $translation): ?>
		<?php echo CHtml::link($translation->language, array('/p3pages/p3PageTranslation/update', 'id' => $translation->id), array('class' => 'btn btn-small')) ?>
	<?php endforeach; ?></h3>
<p>
	<b><?php echo $model->p3PageMeta->treePosition ?></b>
	<?php echo CHtml::link(Yii::t('app', 'Meta Data'), array('/p3pages/p3PageMeta/update', 'id' => $model->id), array('class' => 'btn')) ?>
</p>
<p>
	<?php echo $model->layout ?>; <?php echo $model->view ?>; <?php echo $model->route ?>

	<?php echo CHtml::link(Yii::t('app', 'Update'), array('/p3pages/p3Page/update', 'id' => $model->id), array('class' => 'btn')) ?> 
<?php echo CHtml::link(Yii::t('app', 'View '), array('/p3pages/p3Page/view', 'id' => $model->id), array('class' => 'btn')) ?></p>
