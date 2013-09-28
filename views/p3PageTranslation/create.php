<?php
$this->setPageTitle(
    Yii::t('P3PagesModule.crud', 'P3 Page Translation')
    . ' - '
    . Yii::t('crud_static', 'Create')
);

$this->breadcrumbs[Yii::t('P3PagesModule.crud', 'P3 Page Translations')] = array('admin');
$this->breadcrumbs[] = Yii::t('crud_static', 'Create');
?>
<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
    <h1>
        <?php echo Yii::t('P3PagesModule.crud', 'P3 Page Translation'); ?>
        <small><?php echo Yii::t('crud_static', 'Create'); ?></small>

    </h1>

<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
<?php $this->renderPartial('_form', array('model' => $model, 'buttons' => 'create')); ?>