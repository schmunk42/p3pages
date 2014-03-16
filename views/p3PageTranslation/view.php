<?php
    $this->setPageTitle(
        Yii::t('P3PagesModule.model', 'P3 Page Translation')
        . ' - '
        . Yii::t('P3PagesModule.crud', 'View')
        . ': '   
        . $model->getItemLabel()            
);    
$this->breadcrumbs[Yii::t('P3PagesModule.model','P3 Page Translations')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('P3PagesModule.crud', 'View');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
    <h1>
        <?php echo Yii::t('P3PagesModule.model','P3 Page Translation')?>
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
                                'url' => $this->createUrl('/p3pages/p3PageTranslation/editableSaver'),
                            ),
                            true
                        )
                    ),
                    array(
                        'name' => 'p3_page_id',
                        'value' => ($model->p3Page !== null)?CHtml::link(
                                    '<i class="icon icon-circle-arrow-left"></i> '.$model->p3Page->itemLabel,
                                    array('/p3pages/p3Page/view','id' => $model->p3Page->id),
                                    array('class' => '')).' '.CHtml::link(
                                    '<i class="icon icon-pencil"></i> ',
                                    array('/p3pages/p3Page/update','id' => $model->p3Page->id),
                                    array('class' => '')):'n/a',
                        'type' => 'html',
                    ),
array(
                        'name'=>'language',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'TbEditableField',
                            array(
                                'model'=>$model,
                                'emptytext' => 'Click to select',
                                'type' => 'select',
                                'source' => P3PageTranslation::optslanguage(),
                                'attribute'=>'language',
                                'url' => $this->createUrl('/p3pages/p3PageTranslation/editableSaver'),
                                'select2' => array(
                                    'placeholder' => 'Select...',
                                    'allowClear' => true
                                )
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'menu_name',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'TbEditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'menu_name',
                                'url' => $this->createUrl('/p3pages/p3PageTranslation/editableSaver'),
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
                                'source' => P3PageTranslation::optsstatus(),
                                'attribute'=>'status',
                                'url' => $this->createUrl('/p3pages/p3PageTranslation/editableSaver'),
                                'select2' => array(
                                    'placeholder' => 'Select...',
                                    'allowClear' => true
                                )
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'page_title',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'TbEditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'page_title',
                                'url' => $this->createUrl('/p3pages/p3PageTranslation/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'url_param',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'TbEditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'url_param',
                                'url' => $this->createUrl('/p3pages/p3PageTranslation/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'keywords',
                        'type' => 'raw',
                        'value' => $model->keywords
                    ),
array(
                        'name' => 'description',
                        'type' => 'raw',
                        'value' => $model->description
                    ),
array(
                        'name' => 'access_owner',
                        'type' => 'raw',
                        'value' => $model->access_owner
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