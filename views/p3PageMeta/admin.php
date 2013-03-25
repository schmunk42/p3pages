<?php
$this->breadcrumbs[] = 'P3 Page Metas';


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

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('P3PagesModule.crud', 'P3 Page Metas'); ?>
    <small><?php echo Yii::t('P3PagesModule.crud', 'Manage'); ?></small>
</h1>

<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
<?php
$locale = CLocale::getInstance(Yii::app()->language);

$this->widget('TbGridView', array(
                                 'id'           => 'p3-page-meta-grid',
                                 'dataProvider' => $model->search(),
                                 'filter'       => $model,
                                 'pager'        => array(
                                     'class'               => 'TbPager',
                                     'displayFirstAndLast' => true,
                                 ),
                                 'columns'      => array(


                                     array(
                                         'header'   => 'Page',
                                         'value'  => 'CHtml::value($data,\'id0._label\')',
                                         'filter' => CHtml::listData(P3Page::model()->findAll(), 'id', '_label'),
                                     ),
                                     'status',
                                     'type',
                                     'language',
                                     array(
                                         'name'   => 'treeParent_id',
                                         'value'  => 'CHtml::value($data,\'p3PageMetas._label\')',
                                         'filter' => CHtml::listData(P3PageMeta::model()->findAll(), 'id', '_label'),
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
                                         'class'           => 'TbButtonColumn',
                                         'viewButtonUrl'   => "Yii::app()->controller->createUrl('view', array('id' => \$data->id))",
                                         'updateButtonUrl' => "Yii::app()->controller->createUrl('update', array('id' => \$data->id))",
                                         'deleteButtonUrl' => "Yii::app()->controller->createUrl('delete', array('id' => \$data->id))",

                                     ),
                                 ),
                            )); ?>
