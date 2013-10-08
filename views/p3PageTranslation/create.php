<?php
$this->setPageTitle(
    Yii::t('P3PagesModule.model', 'P3 Page Translation')
    . ' - '
    . Yii::t('P3PagesModule.crud', 'Create')
);

$this->breadcrumbs[Yii::t('P3PagesModule.model', 'P3 Page Translations')] = array('admin');
$this->breadcrumbs[] = Yii::t('P3PagesModule.crud', 'Create');
?>
<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
    <h1>
        <?php echo Yii::t('P3PagesModule.model', 'P3 Page Translation'); ?>
        <small><?php echo Yii::t('P3PagesModule.crud', 'Create'); ?></small>

    </h1>

<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
<?php $this->renderPartial('_form', array('model' => $model, 'buttons' => 'create')); ?>
<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>