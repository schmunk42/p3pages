<?php
    $this->setPageTitle(
        Yii::t('P3PagesModule.model', 'P3 Page')
        . ' - '
        . Yii::t('P3PagesModule.crud', 'View')
        . ': '   
        . $model->getItemLabel()            
);    
$this->breadcrumbs[Yii::t('P3PagesModule.model','P3 Pages')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('P3PagesModule.crud', 'View');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
    <h1>
        <?php echo Yii::t('P3PagesModule.model','P3 Page')?>
        <small>
            <?php echo $model->itemLabel ?>

        </small>

        </h1>



<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>


<div class="row">
    <div class="span7">
        <h2>
            <?php echo Yii::t('P3PagesModule.crud','Data')?>            <small>
                #<?php echo $model->id ?>            </small>
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
                            'TbEditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'id',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'default_menu_name',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'TbEditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'default_menu_name',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'status',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'TbEditableField',
                            array(
                                'model'=>$model,
                                'emptytext' => 'Click to select',
                                'type' => 'select',
                                'source' => P3Page::optsstatus(),
                                'attribute'=>'status',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                                'select2' => array(
                                    'placeholder' => 'Select...',
                                    'allowClear' => true
                                )
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'name_id',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'TbEditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'name_id',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'tree_parent_id',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'TbEditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'tree_parent_id',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'tree_position',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'TbEditableField',
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
                            'TbEditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'default_page_title',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'layout',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'TbEditableField',
                            array(
                                'model'=>$model,
                                'emptytext' => 'Click to select',
                                'type' => 'select',
                                'source' => P3Page::optslayout(),
                                'attribute'=>'layout',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                                'select2' => array(
                                    'placeholder' => 'Select...',
                                    'allowClear' => true
                                )
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'view',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'TbEditableField',
                            array(
                                'model'=>$model,
                                'emptytext' => 'Click to select',
                                'type' => 'select',
                                'source' => P3Page::optsview(),
                                'attribute'=>'view',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                                'select2' => array(
                                    'placeholder' => 'Select...',
                                    'allowClear' => true
                                )
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'url_json',
                        'type' => 'raw',
                        'value' => $model->url_json
                    ),
array(
                        'name' => 'default_url_param',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'TbEditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'default_url_param',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'default_keywords',
                        'type' => 'raw',
                        'value' => $model->default_keywords
                    ),
array(
                        'name' => 'default_description',
                        'type' => 'raw',
                        'value' => $model->default_description
                    ),
array(
                        'name' => 'custom_data_json',
                        'type' => 'raw',
                        'value' => $model->custom_data_json
                    ),
array(
                        'name' => 'access_owner',
                        'type' => 'raw',
                        'value' => $model->access_owner
                    ),
array(
                        'name'=>'access_domain',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'TbEditableField',
                            array(
                                'model'=>$model,
                                'emptytext' => 'Click to select',
                                'type' => 'select',
                                'source' => P3Page::optsaccessdomain(),
                                'attribute'=>'access_domain',
                                'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                                'select2' => array(
                                    'placeholder' => 'Select...',
                                    'allowClear' => true
                                )
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'access_read',
                        'type' => 'raw',
                        'value' => $model->access_read
                    ),
array(
                        'name' => 'access_update',
                        'type' => 'raw',
                        'value' => $model->access_update
                    ),
array(
                        'name' => 'access_delete',
                        'type' => 'raw',
                        'value' => $model->access_delete
                    ),
array(
                        'name' => 'access_append',
                        'type' => 'raw',
                        'value' => $model->access_append
                    ),
array(
                        'name' => 'copied_from_id',
                        'type' => 'raw',
                        'value' => $model->copied_from_id
                    ),
array(
                        'name' => 'created_at',
                        'type' => 'raw',
                        'value' => $model->created_at
                    ),
array(
                        'name' => 'updated_at',
                        'type' => 'raw',
                        'value' => $model->updated_at
                    ),
           ),
        )); ?>
    </div>


    <div class="span5">
        <div class="well">
            <?php $this->renderPartial('_view-relations',array('model' => $model)); ?>        </div>
    </div>
</div>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>