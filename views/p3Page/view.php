<?php
$this->breadcrumbs['P3 Pages'] = array('index');$this->breadcrumbs[] = $model->_label;
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

<h1><?php echo Yii::t('app', 'View');?> P3Page #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
'data'=>$model,
	'attributes'=>array(
					'id',
		'layout',
		'view',
		'route',
),
	)); ?>


	<h2><?php echo CHtml::link(Yii::t('app','P3PageMeta'), array('/p3pages/p3PageMeta/admin'));?></h2>
<ul><?php $foreignobj = $model->p3PageMeta; 

					if ($foreignobj !== null) {
					echo '<li>';
					echo '#'.$model->p3PageMeta->id.' ';
					echo CHtml::link($model->p3PageMeta->_label, array('/p3pages/p3PageMeta/view','id'=>$model->p3PageMeta->id));
							
					echo ' '.CHtml::link(Yii::t('app','Update'), array('/p3pages/p3PageMeta/update','id'=>$model->p3PageMeta->id), array('class'=>'edit'));

					
					
					}
					?></ul><p><?php if($model->p3PageMeta === null) echo CHtml::link(
				Yii::t('app','Create'),
				array('/p3pages/p3PageMeta/create', 'P3PageMeta' => array('id'=>$model->{$model->tableSchema->primaryKey}))
				);  ?></p><h2><?php echo CHtml::link(Yii::t('app','P3PageTranslations'), array('/p3pages/p3PageTranslation/admin'));?></h2>
<ul>
			<?php if (is_array($model->p3PageTranslations)) foreach($model->p3PageTranslations as $foreignobj) { 

					echo '<li>';
					echo CHtml::link($foreignobj->_label, array('/p3pages/p3PageTranslation/view','id'=>$foreignobj->id));
							
					echo ' '.CHtml::link(Yii::t('app','Update'), array('/p3pages/p3PageTranslation/update','id'=>$foreignobj->id), array('class'=>'edit'));

					}
						?></ul><p><?php echo CHtml::link(
				Yii::t('app','Create'),
				array('/p3pages/p3PageTranslation/create', 'P3PageTranslation' => array('p3_page_id'=>$model->{$model->tableSchema->primaryKey}))
				);  ?></p>