<h3><?php echo CHtml::link($model->t('menuName'), $model->createUrl()) ?> <?php echo CHtml::link(Yii::t('app', 'Update'), array('/p3pages/p3PageMeta/update', 'id' => $model->id), array('class' => 'btn')) ?> </h3>
<p>

	<?php foreach ($model->p3PageTranslations AS $translation): ?>
		<?php echo CHtml::link($translation->language, array('/p3pages/p3PageTranslation/update', 'id' => $translation->id), array('class' => 'btn btn-small')) ?>
	<?php endforeach; ?>

</p>
<p>
	<b>Position: <?php echo $model->p3PageMeta->treePosition ?></b>
	Layout: <?php echo $model->layout ?> Vew: <?php echo $model->view ?> Route: <?php echo $model->route ?>

	<?php echo CHtml::link(Yii::t('app', 'Update'), array('/p3pages/p3Page/update', 'id' => $model->id), array('class' => 'btn')) ?> 
	<?php echo CHtml::link(Yii::t('app', 'Details '), array('/p3pages/p3Page/view', 'id' => $model->id), array('class' => 'btn')) ?></p>
