<?php
$this->breadcrumbs['P3 Pages'] = array('admin');
$this->breadcrumbs[] = $model->id;
?>
<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    P3 Page <small>View #<?php echo $model->id ?></small></h1>



<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>

<h2>
    Data
</h2>

<p>
    <?php
    $this->widget('TbDetailView', array(
    'data'=>$model,
    'attributes'=>array(
            'id',
        'layout',
        'view',
        'route',
),
        )); ?></p>


<h2>
    Relations
</h2>

<div class='row'>
<div class='span3'><?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
        'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'buttons'=>array(
            array('label'=>'p3PageMeta', 'icon'=>'icon-list-alt', 'url'=> array('p3PageMeta/admin')),
                array('icon'=>'icon-plus', 'url'=>array('p3PageMeta/create', 'P3PageMeta' => array('id'=>$model->{$model->tableSchema->primaryKey}))),
        ),
    )); ?></div><div class='span8'>
<?php
    echo '<span class=label>CHasOneRelation</span>';
    $relatedModel = $model->p3PageMeta; 

    if ($relatedModel !== null) {
        echo CHtml::openTag('ul');
        echo '<li>';
        echo CHtml::link(
            $model->p3PageMeta->id0->_label,
            array('p3PageMeta/view','id'=>$model->p3PageMeta->id),
            array('class'=>''));

        echo '</li>';

        echo CHtml::closeTag('ul');
    }
?></div></div>
<div class='row'>
<div class='span3'><?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
        'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'buttons'=>array(
            array('label'=>'p3PageTranslations', 'icon'=>'icon-list-alt', 'url'=> array('p3PageTranslation/admin')),
                array('icon'=>'icon-plus', 'url'=>array('p3PageTranslation/create', 'P3PageTranslation' => array('p3_page_id'=>$model->{$model->tableSchema->primaryKey}))),
        ),
    )); ?></div><div class='span8'>
<?php
    echo '<span class=label>CHasManyRelation</span>';
    if (is_array($model->p3PageTranslations)) {

        echo CHtml::openTag('ul');
            foreach($model->p3PageTranslations as $relatedModel) {

                echo '<li>';
                echo CHtml::link($relatedModel->language.": ".$relatedModel->menuName, array('p3PageTranslation/view','id'=>$relatedModel->id), array('class'=>''));

                echo '</li>';
            }
        echo CHtml::closeTag('ul');
    }
?></div>
</div>
