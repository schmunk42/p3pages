<p>
    <?php if ($model->getChildren()): ?>
        <button type="button" class="btn btn-inverse" data-toggle="collapse"
                data-target="#page-<?php echo $model->id ?>">
            <i class="icon-folder-close icon-white"></i>
        </button>
    <?php endif; ?>

    <?php echo CHtml::link('<i class="icon-circle-arrow-right icon-white"></i> ' . ' <b>' . $model->nameId . '</b> ' .
                               $model->t('menuName') . ' #' . $model->id,
                           $model->createUrl(), array('class' => 'btn btn-inverse')) ?>
    <?php foreach ($model->p3PageTranslations AS $translation): ?>
        <?php
        echo CHtml::link('<i class="icon-pencil icon-white"></i> ' . $translation->language,
                         array('/p3pages/p3PageTranslation/update',
                               'id'        => $translation->id,
                               'returnUrl' => Yii::app()->controller->createUrl(null)),
                         array('class' => 'btn ' . (($translation->language == Yii::app()->language) ?
                             'btn-primary' : 'btn-info')))
        ?>
    <?php endforeach; ?>
    <?php
    echo CHtml::link('<i class="icon-plus icon-white"></i>', //  Add Translation
                     array('/p3pages/p3PageTranslation/create',
                           'returnUrl'         => Yii::app()->controller->createUrl(null),
                           'P3PageTranslation' => array('p3_page_id' => $model->id,
                                                        'language'   => Yii::app()->language)),
                     array('class' => 'btn btn-primary'))
    ?>

    <?php
    echo CHtml::link('<i class="icon-minus-sign icon-white"></i> ' . Yii::t('P3PagesModule.crud', 'Delete'), '#',
                     array('class'   => 'btn btn-danger pull-right',
                           'submit'  => array('p3Page/delete',
                                              'id'        => $model->id,
                                              'returnUrl' => Yii::app()->controller->createUrl(null)),
                           'confirm' => Yii::t('P3PagesModule.crud', 'Do you want to delete this item?')))
    ?>
    <?php
    echo CHtml::link('<i class="icon-wrench"></i> ', //Yii::t('P3PagesModule.crud', 'Template'),
                     array(
                          '/p3pages/p3Page/update',
                          'id'        => $model->id,
                          'returnUrl' => Yii::app()->controller->createUrl(null)),
                     array('class' => 'btn',
                           'rel'   => 'tooltip',
                           'title' => 'first tooltip'
                     ))
    ?>
    <?php
    echo CHtml::link('<i class="icon-info-sign"></i> ', //Yii::t('P3PagesModule.crud', 'Meta Data'),
                     array(
                          '/p3pages/p3PageMeta/update',
                          'id'        => $model->id,
                          'returnUrl' => Yii::app()->controller->createUrl(null)),
                     array(
                          'class' => 'btn'))
    ?>
    <?php
    echo CHtml::link('<i class="icon-plus-sign"></i>', // Append Child Page
                     array('/p3pages/p3Page/createChild',
                           'P3PageMeta' => array('treeParent_id' => $model->id,),
                           'returnUrl'  => Yii::app()->controller->createUrl(null)),
                     array('class' => 'btn'))
    ?>
    <span class="label label-important"><?php echo ($model->route != '{}') ? $model->route : '' ?></span>
    <span class="label"><?php echo $model->layout ?></span>
    <span class="label"><?php echo $model->view ?></span>


            <span class="label label-info">Position</span> <?php
if (isset($model->p3PageMeta)) {            
$this->widget('EditableField',
                          array(
                               'type'      => 'text',
                               'model'     => $model->p3PageMeta,
                               'attribute' => 'treePosition',
                               'url'       => Yii::app()->controller->createUrl('/p3pages/p3PageMeta/editableSaver'),
                          ));
}

    ?>

</p>
