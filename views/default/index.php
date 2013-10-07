<?php
$this->breadcrumbs = array(
    $this->module->id,
);
?>

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>


<h1>
    <?php echo Yii::t('P3PagesModule.module', 'Pages'); ?>
    <small><?php echo Yii::t('P3PagesModule.module', 'Sitemap'); ?></small>
</h1>


<p>
    <?php echo CHtml::link(
        Yii::t('crud', 'Create'),
        array('/p3pages/p3Page/create'),
        array('class' => 'btn btn-large btn-success')
    ) ?>
    <?php echo CHtml::link(
        Yii::t('crud', 'Manage'),
        array('/p3pages/p3Page/admin'),
        array('class' => 'btn btn-large')
    ) ?>
</p>

<div class="sitemap">
    <?php $this->widget('p3pages.components.pageTree.P3PagesTreeWidget'); ?>
</div>
