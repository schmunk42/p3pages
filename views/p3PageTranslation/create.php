<?php
$this->breadcrumbs['P3 Page Translations'] = array('admin');
$this->breadcrumbs[] = Yii::t('app', 'Create');
?>
<h1>
    Create P3 Page Translation</h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>
<?php
$this->renderPartial('_form', array(
'model' => $model,
'buttons' => 'create'));

?>

