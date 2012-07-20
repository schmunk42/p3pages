<p>
    <?php echo CHtml::link('<i class="icon-circle-arrow-right icon-white"></i> ' . $model->t('menuName'), $model->createUrl(), array('class' => 'btn btn-primary')) ?>



    <?php
    echo CHtml::link(Yii::t('app', '<i class="icon-info-sign"></i> Meta Data'), array(
        '/p3pages/p3PageMeta/update',
        'id' => $model->id), array(
        'class' => 'btn'))
    ?>

    <?php
    echo CHtml::link(Yii::t('app', '<i class="icon-wrench"></i> Template'), array(
        '/p3pages/p3Page/update',
        'id' => $model->id), array('class' => 'btn'))
    ?>
    <?php
    echo CHtml::link(Yii::t('app', '<i class="icon-file"></i> Details '), array(
        '/p3pages/p3Page/view',
        'id' => $model->id), array('class' => 'btn'))
    ?>

    <?php
    echo CHtml::link(Yii::t('app', '<i class="icon-minus-sign icon-white"></i> Delete'), '#', array('class' => 'btn btn-danger', 'submit' => array($this->controller->createUrl('p3Page/delete'), 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?'))
    ?>

</p>
<p>
    <?php foreach ($model->p3PageTranslations AS $translation): ?>
        <?php
        echo CHtml::link('<i class="icon-pencil icon-white"></i> ' . $translation->language, array('/p3pages/p3PageTranslation/update', 'id' => $translation->id), array('class' => 'btn btn-info'))
        ?>
    <?php endforeach; ?>
    <?php
    echo CHtml::link('<i class="icon-plus"></i> Add Translation', array('/p3pages/p3PageTranslation/create', 'P3PageTranslation' => array('p3_page_id' => $model->id)), array('class' => 'btn'))
    ?>
</p>
<p>
<h5>Position</h5> <?php echo ($model->p3PageMeta !== null) ? $model->p3PageMeta->treePosition : 'Meta Data n/a' ?></b>
<h5>Layout</h5> <?php echo $model->layout ?> View: <?php echo $model->view ?> Route: <?php echo $model->route ?>
</p>