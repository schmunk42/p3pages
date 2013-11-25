<p>
<h4>
    <span
        class="label label-<?php echo $model->statusCssClass ?>"><i class="icon-pencil icon-white"></i></span>
    <span
        class="label label-<?php echo $model->translationModel->statusCssClass ?>"><i class="icon-flag icon-white"></i></span>

    <?php echo $model->menu_name ?>

    <?php
    echo CHtml::link(
              '<i class="icon-circle-arrow-right"></i> ',
                  $model->createUrl(),
                  array(
                       'class'       => '',
                       'data-toggle' => 'tooltip',
                       'data-placement' => 'right',
                       'title'       => 'Go to Frontend-Page'
                  )
    )
    ?>
</h4>
<?php if ($model->getChildren()): ?>
    <button type="button" class="btn" data-toggle="collapse"
            data-target="#page-<?php echo $model->id ?>">
        <i class="icon-folder-open"></i>
    </button>
<?php endif; ?>

<?php
echo CHtml::link(
          '<i class="icon-pencil"></i> ' . ' <b>' . $model->name_id . '</b> ' . ' #' . $model->id,
              array(
                   '/p3pages/p3Page/update',
                   'id'        => $model->id,
                   'returnUrl' => Yii::app()->controller->createUrl(null)
              ),
              array(
                   'class'       => 'btn',
                   'data-toggle' => 'tooltip',
                   'title'       => 'Update Page'
              )
) ?>

<?php foreach ($model->p3PageTranslations AS $translation): ?>
    <?php
    echo CHtml::link(
              '<i class="icon-flag"></i> ' . $translation->language,
                  array(
                       '/p3pages/p3PageTranslation/update',
                       'id'        => $translation->id,
                       'returnUrl' => Yii::app()->controller->createUrl(null)
                  ),
                  array(
                       'class'       => 'btn',
                       'data-toggle' => 'tooltip',
                       'title'       => 'Update Translation'
                  )
    )
    ?>
<?php endforeach; ?>

<?php
echo CHtml::link(
          '<i class="icon-plus"></i>', //  Add Translation
              array(
                   '/p3pages/p3PageTranslation/create',
                   'returnUrl'         => Yii::app()->controller->createUrl(null),
                   'P3PageTranslation' => array(
                       'p3_page_id' => $model->id,
                       'language'   => Yii::app()->language
                   )
              ),
              array(
                   'class'       => 'btn',
                   'data-toggle' => 'tooltip',
                   'title'       => 'Create Translation'
              )
)
?>


<?php
echo CHtml::link(
          '<i class="icon-plus-sign icon-white"></i>', // Append Child Page
              array(
                   '/p3pages/p3Page/create',
                   'P3Page'    => array('tree_parent_id' => $model->id,),
                   'returnUrl' => Yii::app()->controller->createUrl(null)
              ),
              array(
                   'class'       => 'btn btn-success pull-right',
                   'data-toggle' => 'tooltip',
                   'title'       => 'Append Child Page'
              )
)
?>

<?php
echo CHtml::link(
          '<i class="icon-minus-sign icon-white"></i> ' . Yii::t('crud', 'Delete'),
              '#',
              array(
                   'class'   => 'btn btn-danger pull-right',
                   'submit'  => array(
                       'p3Page/delete',
                       'id'        => $model->id,
                       'returnUrl' => Yii::app()->controller->createUrl(null)
                   ),
                   'confirm' => Yii::t('crud', 'Do you want to delete this item?')
              )
)
?>
</p>
<p>
    <span class="label label-info"><?php echo ($model->url_json != '{}') ? $model->url_json : '' ?></span>
    <span class="label"><?php echo Yii::t('crud', 'Layout & View') ?></span>
    <?php echo $model->layout ?>
    <?php echo $model->view ?>
    <?php #TODO: add tree_parent_id editable ?>
    <span class="label">Position</span>
    <?php
    $this->widget(
         'TbEditableField',
             array(
                  'type'      => 'text',
                  'model'     => $model,
                  'attribute' => 'tree_position',
                  'url'       => Yii::app()->controller->createUrl('/p3pages/p3Page/editableSaver'),
                  'emptytext' => '0'
             )
    );
    ?>

</p>
<hr/>
