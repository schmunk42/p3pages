<?php
    $this->setPageTitle(
        Yii::t('P3PagesModule.crud', 'P3 Page')
        . ' - '
        . Yii::t('crud_static', 'View')
        . ': '   
        . $model->getItemLabel()            
);    
$this->breadcrumbs[Yii::t('P3PagesModule.crud','P3 Pages')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('crud_static', 'View');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('P3PagesModule.crud','P3 Page')?>
    <small><?php echo Yii::t('crud_static','View')?> #<?php echo $model->id ?></small>
    </h1>



<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>


<div class="row">
    <div class="span7">
        <h2>
            <?php echo Yii::t('crud_static','Data')?>            <small>
                <?php echo $model->itemLabel?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data' => $model,
                'attributes' => array(
                array(
                        'name' => 'id',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'id',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'name_id',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'name_id',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'status',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'status',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'default_menu_name',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'default_menu_name',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
        array(
            'name' => 'tree_parent_id',
            'value' => ($model->treeParent !== null)?CHtml::link(
                            '<i class="icon icon-circle-arrow-left"></i> '.$model->treeParent->itemLabel,
                            array('/p3pages/p3Page/view','id' => $model->treeParent->id),
                            array('class' => '')).' '.CHtml::link(
                            '<i class="icon icon-pencil"></i> ',
                            array('/p3pages/p3Page/update','id' => $model->treeParent->id),
                            array('class' => '')):'n/a',
            'type' => 'html',
        ),
array(
                        'name' => 'tree_position',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'tree_position',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'default_page_title',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'default_page_title',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'default_url_param',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'default_url_param',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'layout',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'layout',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'view',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'view',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'url_json',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'url_json',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'default_keywords',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'default_keywords',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'default_description',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'default_description',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'custom_data_json',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'custom_data_json',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'access_owner',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'access_owner',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'access_domain',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'access_domain',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'access_read',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'access_read',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'access_update',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'access_update',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'access_delete',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'access_delete',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'access_append',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'access_append',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'created_at',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'created_at',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'updated_at',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'updated_at',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'copied_from_id',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'copied_from_id',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
           ),
        )); ?>
    </div>

    <div class="span5">
        <?php $this->renderPartial('_view-relations',array('model' => $model)); ?>    </div>
</div>