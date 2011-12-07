<?php
$this->breadcrumbs['P3 Pages'] = array('index');
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
$.fn.yiiGridView.update('p3-page-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1> <?php echo Yii::t('app', 'Manage'); ?> <?php echo Yii::t('app', 'P3 Pages'); ?> </h1>


<ul></ul>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?><div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>
<?php
$locale = CLocale::getInstance(Yii::app()->language);

 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'p3-page-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(

	
		'id',
		'title',
		'description',
		'keywords',
		'controller',
		'params',
		array(
			'class'=>'CButtonColumn',
			'viewButtonUrl' => "Yii::app()->controller->createUrl('view', array('id' => \$data->id))",
			'updateButtonUrl' => "Yii::app()->controller->createUrl('update', array('id' => \$data->id))",
			'deleteButtonUrl' => "Yii::app()->controller->createUrl('delete', array('id' => \$data->id))",

		),
	),
)); ?>


<?php echo CHtml::link('Create new P3Page', array('create')); ?>