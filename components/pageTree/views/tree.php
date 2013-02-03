<div class="row thumbnail">
    <div class="span7">
        <p>
            <?php echo CHtml::link('<i class="icon-circle-arrow-right icon-white"></i> ' . $model->t('menuName') . ' #' . $model->id,
                                   $model->createUrl(), array('class' => 'btn btn-info')) ?>
            <?php foreach ($model->p3PageTranslations AS $translation): ?>
            <?php
            echo CHtml::link('<i class="icon-pencil icon-white"></i> ' . $translation->language,
                             array('/p3pages/p3PageTranslation/update',
                                   'id' => $translation->id),
                             array('class' => 'btn btn-primary'))
            ?>
            <?php endforeach; ?>
            <?php
            echo CHtml::link('<i class="icon-plus"></i> Add Translation',
                             array('/p3pages/p3PageTranslation/create',
                                   'P3PageTranslation' => array('p3_page_id' => $model->id)), array('class' => 'btn'))
            ?>


        </p>

        <p>
            <?php
            echo CHtml::link('<i class="icon-wrench"></i> ' . Yii::t('P3PagesModule.crud', 'Template'),
                             array(
                                  '/p3pages/p3Page/update',
                                  'id' => $model->id,
                                  'returnUrl' => Yii::app()->controller->createUrl(null)),
                             array('class' => 'btn'))
            ?>
            <?php
            echo CHtml::link('<i class="icon-info-sign"></i> ' . Yii::t('P3PagesModule.crud', 'Meta Data'),
                             array(
                                  '/p3pages/p3PageMeta/update',
                                  'id' => $model->id,
                                  'returnUrl' => Yii::app()->controller->createUrl(null)),
                             array(
                                  'class' => 'btn'))
            ?>

            <?php
            echo CHtml::link('<i class="icon-plus"></i> Append Child Page',
                             array('/p3pages/p3Page/createChild',
                                   'P3PageMeta' => array('treeParent_id' => $model->id,),
                                   'returnUrl' => Yii::app()->controller->createUrl(null)),
                             array('class' => 'btn'))
            ?>
            <?php
            echo CHtml::link('<i class="icon-minus-sign icon-white"></i> ' . Yii::t('P3PagesModule.crud', 'Delete'), '#',
                             array('class' => 'btn btn-danger',
                                   'submit' => array('p3Page/delete',
                                                     'id' => $model->id,
                                                     'returnUrl' => Yii::app()->controller->createUrl(null)),
                                   'confirm' => 'Are you sure you want to delete this item?'))
            ?>
        </p>
    </div>

    <div class="span3">
        <b>Position</b> <?php echo ($model->p3PageMeta !== null) ? $model->p3PageMeta->treePosition :
        'Meta Data n/a' ?></b><br/>
        <b>Layout</b> <?php echo $model->layout ?><br/>
        <b>View</b> <?php echo $model->view ?> Route: <?php echo $model->route ?>
    </div>

</div>