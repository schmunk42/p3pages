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


<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <?php
        $this->widget("bootstrap.widgets.TbButton", array(
            "label" => Yii::t('P3PagesModule.crud', 'Create'),
            "icon"  => "icon-plus icon-white",
            "size"  => "large",
            "type"  => "success",
            "url"   => array('/p3pages/p3Page/create'),
        ));
        $this->widget("bootstrap.widgets.TbButton", array(
            "label"   => Yii::t('P3PagesModule.crud', 'Copy'),
            "icon"    => "icon-file icon-white",
            "size"    => "large",
            "type"    => "info",
            "url"     => array('/p3pages/p3PageCopy/index'),
            "visible" => Yii::app()->user->checkAccess("P3pages.Default.CopyPage")
        ));
        ?>
    </div>
    <div class="btn-toolbar pull-right">
        <?php
        $this->widget("bootstrap.widgets.TbButton", array(
            "label" => Yii::t("P3PagesModule.crud", "Manage"),
            "icon"  => "icon-list-alt",
            "size"  => "large",
            "url"   => array('/p3pages/p3Page/admin'),
        ));
        ?>
    </div>
</div>
<hr>
<div class="sitemap">
    <?php $this->widget('p3pages.components.pageTree.P3PagesTreeWidget'); ?>
</div>
