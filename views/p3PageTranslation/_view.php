<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p3_page_id')); ?>:</b>
	<?php echo CHtml::encode($data->p3_page_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seoUrl')); ?>:</b>
	<?php echo CHtml::encode($data->seoUrl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pageTitle')); ?>:</b>
	<?php echo CHtml::encode($data->pageTitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('menuName')); ?>:</b>
	<?php echo CHtml::encode($data->menuName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keywords')); ?>:</b>
	<?php echo CHtml::encode($data->keywords); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	*/ ?>

</div>
