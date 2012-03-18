<?php
$this->breadcrumbs['P3 Page Metas'] = array('index');$this->breadcrumbs[] = $model->_label;
if(!isset($this->menu) || $this->menu === array()) {
$this->menu=array(
	array('label'=>Yii::t('app', 'Update') , 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app', 'Delete') , 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') , 'url'=>array('admin')),
	/*array('label'=>Yii::t('app', 'List') , 'url'=>array('index')),*/
);
}
?>

<h1><?php echo Yii::t('app', 'View');?> P3PageMeta #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
'data'=>$model,
	'attributes'=>array(
					array(
			'name'=>'id',
			'value'=>($model->id0 !== null)?CHtml::link($model->id0->_label, array('/p3pages/p3Page/view','id'=>$model->id0->id)).' '.CHtml::link(Yii::t('app','Update'), array('/p3pages/p3Page/update','id'=>$model->id0->id), array('class'=>'edit')):'n/a',
			'type'=>'html',
		),
		'status',
		'type',
		'language',
		array(
			'name'=>'treeParent_id',
			'value'=>($model->treeParent !== null)?CHtml::link($model->treeParent->_label, array('/p3pages/p3PageMeta/view','id'=>$model->treeParent->id)).' '.CHtml::link(Yii::t('app','Update'), array('/p3pages/p3PageMeta/update','id'=>$model->treeParent->id), array('class'=>'edit')):'n/a',
			'type'=>'html',
		),
		'treePosition',
		'begin',
		'end',
		'keywords',
		'customData',
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
),
	)); ?>


	<h2><?php echo CHtml::link(Yii::t('app','P3PageMetas'), array('/p3pages/p3PageMeta/admin'));?></h2>
<ul>
			<?php if (is_array($model->p3PageMetas)) foreach($model->p3PageMetas as $foreignobj) { 

					echo '<li>';
					echo CHtml::link($foreignobj->_label, array('/p3pages/p3PageMeta/view','id'=>$foreignobj->id));
							
					echo ' '.CHtml::link(Yii::t('app','Update'), array('/p3pages/p3PageMeta/update','id'=>$foreignobj->id), array('class'=>'edit'));

					}
						?></ul><p><?php echo CHtml::link(
				Yii::t('app','Create'),
				array('/p3pages/p3PageMeta/create', 'P3PageMeta' => array('treeParent_id'=>$model->{$model->tableSchema->primaryKey}))
				);  ?></p>