<?php
$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<div class="flash-notice">
	Phundament 3 Pages module not available yet.	
</div>

<p>
<ul>	
	<li><?php echo CHtml::link('Manage Pages',array('/p3pages/p3Page/admin')) ?></li>
</ul>
</p>