<?php
$this->breadcrumbs[] = 'P3 Pages';


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

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('P3PagesModule.crud', 'P3 Pages'); ?>
    <small><?php echo Yii::t('P3PagesModule.crud', 'Manage'); ?></small>
</h1>

<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
<?php
$locale = CLocale::getInstance(Yii::app()->language);

$this->widget('TbGridView', array(
                                 'id'           => 'p3-page-grid',
                                 'dataProvider' => $model->search(),
                                 'filter'       => $model,
                                 'pager'        => array(
                                     'class'               => 'TbPager',
                                     'displayFirstAndLast' => true,
                                 ),
                                 'columns'      => array(
                                     'id',
                                     'nameId',
                                     '_label:text:Menu Name',
                                     'layout',
                                     'view',
                                     'route',
                                     array(
                                         'type' => 'raw',
                                         'header' => 'Parent',
                                         'value' => '(($data->p3PageMeta->treeParent !== null)?$data->p3PageMeta->treeParent->_label:(($data->p3PageMeta->treeParent_id === null)?"null":"missing"))',
                                     ),
                                     array(
                                         'class'           => 'TbButtonColumn',
                                         'viewButtonUrl'   => "Yii::app()->controller->createUrl('view', array('id' => \$data->id))",
                                         'updateButtonUrl' => "Yii::app()->controller->createUrl('update', array('id' => \$data->id))",
                                         'deleteButtonUrl' => "Yii::app()->controller->createUrl('delete', array('id' => \$data->id))",
                                     ),
                                 ),
                            )); ?>
