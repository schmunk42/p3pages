<?php
$this->breadcrumbs = array(
    $this->module->id,
);
?>

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>


<h1>
	<?php echo Yii::t('P3PagesModule.crud', 'Pages'); ?>
    <small><?php echo Yii::t('P3PagesModule.crud', 'Sitemap'); ?></small>
</h1>

<p>
    <?php echo CHtml::link(Yii::t('P3PagesModule.crud', 'Manage'), array('/p3pages/p3Page/admin'), array('class' => 'btn')) ?></li>
    <?php echo CHtml::link(Yii::t('P3PagesModule.crud', 'Create'), array('/p3pages/p3Page/create'), array('class' => 'btn')) ?></li>
</p>

<div class="sitemap">
    <?php $this->widget('p3pages.components.pageTree.P3PagesTreeWidget'); ?>
</div>
