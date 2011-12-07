<p> The P3Page <?php echo $model; ?> has been successfully created </p>

<?php echo CHtml::Button(Yii::t('app', 'Back'), array('id' => $relation.'_done')); ?><?php echo CHtml::Button(Yii::t('app', 'Add another P3Page'), array('id' => $relation.'_create'));
