<?php
$this->breadcrumbs[] = $model->id;
?>
<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('P3PagesModule.crud', 'Pages'); ?>
    <small> #<?php echo $model->id ?></small>
</h1>


<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>




<h2>
    <?php echo Yii::t('P3PagesModule.crud', 'Data'); ?>
</h2>

<p>
    <?php
    $this->widget('TbDetailView',
                  array(
                       'data'       => $model,
                       'attributes' => array(
                           'id',
                           'nameId',
                           'route',
                           'layout',
                           'view',
                       ),
                  )); ?></p>


<h2>
    <?php echo Yii::t('P3PagesModule.crud', 'Properties'); ?>
</h2>
<p>
    <?php $this->widget('TbDetailView',
                        array(
                             'data'       => $model,
                             'attributes' => array(
                                 array(
                                     'label' => Yii::t('P3PagesModule.crud', 'URL'),
                                     'value' => CHtml::link($model->createUrl(), $model->createUrl()),
                                     'type'  => 'raw'
                                 ),
                                 array(
                                     'label' => Yii::t('P3PagesModule.crud', 'Menu Name'),
                                     'value' => $model->t('menuName', null, true),
                                 ),
                                 array(
                                     'label' => Yii::t('P3PagesModule.crud', 'Page Title'),
                                     'value' => $model->t('pageTitle', null, true)
                                 ),
                                 array(
                                     'label' => Yii::t('P3PagesModule.crud', 'Parent'),
                                     'value' => ($model->p3PageMeta->treeParent)?$model->p3PageMeta->treeParent->id0->t('menuName', null, true):null
                                 )
                             )
                        )
    ) ?>
</p>

<h2>
    <?php echo Yii::t('P3PagesModule.crud', 'Relations'); ?>
</h2>

<div class='row'>
    <div class='span3'>
        <?php
        $this->widget('bootstrap.widgets.TbButtonGroup',
                      array(
                           'type'    => '',
                           // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                           'buttons' => array(
                               array('label' => Yii::t('P3PagesModule.crud', 'Metadata'),
                                     'icon'  => 'icon-list-alt',
                                     'url'   => array('p3PageMeta/admin')),
                               array('icon' => 'icon-plus',
                                     'url'  => array('p3PageMeta/create',
                                                     'P3PageMeta' => array('id' => $model->{$model->tableSchema->primaryKey}))),
                           ),
                      )); ?>

    </div>
    <div class='span8'>
        <?php
        echo '<span class=label>CHasOneRelation</span>';
        $relatedModel = $model->p3PageMeta;

        if ($relatedModel !== null) {
            echo CHtml::openTag('ul');
            echo '<li>';
            echo CHtml::link(
                $model->p3PageMeta->id0->_label,
                array('p3PageMeta/view', 'id' => $model->p3PageMeta->id),
                array('class' => ''));

            echo '</li>';

            echo CHtml::closeTag('ul');
        }
        ?></div>
</div>

<div class='row'>
    <div class='span3'><?php
        $this->widget('bootstrap.widgets.TbButtonGroup',
                      array(
                           'type'    => '',
                           // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                           'buttons' => array(
                               array('label' => Yii::t('P3PagesModule.crud', 'Translations'),
                                     'icon'  => 'icon-list-alt',
                                     'url'   => array('p3PageTranslation/admin')),
                               array('icon' => 'icon-plus',
                                     'url'  => array('p3PageTranslation/create',
                                                     'P3PageTranslation' => array('p3_page_id' => $model->{$model->tableSchema->primaryKey}))),
                           ),
                      ));
        ?>
    </div>
    <div class='span8'>
        <?php
        echo '<span class=label>CHasManyRelation</span>';
        if (is_array($model->p3PageTranslations)) {

            echo CHtml::openTag('ul');
            foreach ($model->p3PageTranslations as $relatedModel) {

                echo '<li>';
                echo CHtml::link($relatedModel->language . ": " . $relatedModel->menuName,
                                 array('p3PageTranslation/view',
                                       'id' => $relatedModel->id), array('class' => ''));

                echo '</li>';
            }
            echo CHtml::closeTag('ul');
        }
        ?>
    </div>
</div>
