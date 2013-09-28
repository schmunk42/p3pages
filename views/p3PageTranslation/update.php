<?php
$this->setPageTitle(
        Yii::t('P3PagesModule.crud', 'P3 Page Translation')
        . ' - '
        . Yii::t('crud_static', 'Update')
        . ': '   
        . $model->getItemLabel()
);    
$this->breadcrumbs[Yii::t('P3PagesModule.crud','P3 Page Translations')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('crud_static', 'Update');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
    <h1>
        
        <?php echo Yii::t('P3PagesModule.crud','P3 Page Translation'); ?>
        <small>
            <?php echo Yii::t('crud_static','Update')?> #<?php echo $model->id ?>
        </small>
        
    </h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>

<?php
    $this->renderPartial('_form', array('model' => $model));
?>
