<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keywords')); ?>:</b>
	<?php echo CHtml::encode($data->keywords); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('controller')); ?>:</b>
	<?php echo CHtml::encode($data->controller); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('params')); ?>:</b>
	<?php echo CHtml::encode($data->params); ?>
	<br />


</div>
