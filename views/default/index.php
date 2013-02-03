<?php
$this->breadcrumbs=array(
	$this->module->id,
);
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>


<h1>Pages <small>Overview</small></h1>

<p>
<?php echo CHtml::link('Create Root Node',array('/p3pages/p3Page/create'), array('class'=>'btn')) ?></li>
<?php echo CHtml::link('Manage Pages',array('/p3pages/p3Page/admin'), array('class'=>'btn')) ?></li>
</p>

<h2>Sitemap</h2>
<p>
	<?php $this->widget('p3pages.components.pageTree.P3PagesTreeWidget'); ?>
</p>
