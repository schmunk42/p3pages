<?php
$this->breadcrumbs = array(
    $this->module->id,
);
?>

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>


<h1>Pages
    <small>Sitemap</small>
</h1>

<p>
    <?php echo CHtml::link('Manage', array('/p3pages/p3Page/admin'), array('class' => 'btn')) ?></li>
    <?php echo CHtml::link('Create', array('/p3pages/p3Page/create'), array('class' => 'btn')) ?></li>
</p>

<div class="sitemap">
    <?php $this->widget('p3pages.components.pageTree.P3PagesTreeWidget'); ?>
</div>
