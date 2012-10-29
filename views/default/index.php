<?php
$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<p>
<ul>
	<li><?php echo CHtml::link('Create Page',array('/p3pages/p3Page/create')) ?></li>
	<li><?php echo CHtml::link('Manage Pages',array('/p3pages/p3Page/admin')) ?></li>
</ul>
</p>

<h2>Sitemap</h2>
<p>
	<?php $this->widget('p3pages.components.pageTree.P3PagesTreeWidget'); ?>
</p>
