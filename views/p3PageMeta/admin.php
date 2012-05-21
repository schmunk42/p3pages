<?php
$this->breadcrumbs['P3 Page Metas'] = array('index');
$this->breadcrumbs[] = Yii::t('app', 'Admin');

if(!isset($this->menu) || $this->menu === array())
$this->menu=array(
array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
array('label'=>Yii::t('app', 'List') , 'url'=>array('index')),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('p3-page-meta-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1> <?php echo Yii::t('app', 'Manage'); ?> <?php echo Yii::t('app', 'P3 Page Metas'); ?> </h1>


<ul>
    <li>BelongsTo <?php echo CHtml::link('p3PageMeta',array('/p3pages/p3PageMeta/admin')) ?> </li>
    <li>HasMany <?php echo CHtml::link('p3PageMeta',array('/p3pages/p3PageMeta/admin')) ?> </li>
    <li>BelongsTo <?php echo CHtml::link('p3Page',array('/p3pages/p3Page/admin')) ?> </li>
</ul>
<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?><div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
'id'=>'p3-page-meta-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(

		array(
					'name'=>'id',
					'value'=>'CHtml::value($data,\'id0._label\')',
							'filter'=>CHtml::listData(P3Page::model()->findAll(), 'id', '_label'),
							),
		'status',
		'type',
		'language',
		array(
					'name'=>'treeParent_id',
					'value'=>'CHtml::value($data,\'p3PageMetas._label\')',
							'filter'=>CHtml::listData(P3PageMeta::model()->findAll(), 'id', '_label'),
							),
		'treePosition',
		/*
		'begin',
		'end',
#		'keywords',
#		'customData',
		'label',
		'owner',
		'checkAccessCreate',
		'checkAccessRead',
		'checkAccessUpdate',
		'checkAccessDelete',
		'createdAt',
		'createdBy',
		'modifiedAt',
		'modifiedBy',
		'guid',
		'ancestor_guid',
		'model',
		*/

array(
'class'=>'CButtonColumn',
'viewButtonUrl' => "Yii::app()->controller->createUrl('view', array('id' => \$data->id))",
'updateButtonUrl' => "Yii::app()->controller->createUrl('update', array('id' => \$data->id))",
'deleteButtonUrl' => "Yii::app()->controller->createUrl('delete', array('id' => \$data->id))",
),
),
)); 

 ?>