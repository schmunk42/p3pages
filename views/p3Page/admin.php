<?php
$this->setPageTitle(
    Yii::t('P3PagesModule.crud', 'P3 Pages')
    . ' - '
    . Yii::t('crud_static', 'Manage')
);

$this->breadcrumbs[] = Yii::t('P3PagesModule.crud', 'P3 Pages');
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update(
            'p3-page-grid',
            {data: $(this).serialize()}
        );
        return false;
    });
    ");
?>

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
    <h1>

        <?php echo Yii::t('P3PagesModule.crud', 'P3 Pages'); ?>
        <small><?php echo Yii::t('crud_static', 'Manage'); ?></small>

    </h1>

<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>



<?php
$this->widget('TbGridView',
    array(
        'id' => 'p3-page-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'template' => '{pager}{summary}{items}{pager}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns' => array(
            array(
                'class' => 'CLinkColumn',
                'header' => '',
                'labelExpression' => '$data->itemLabel',
                'urlExpression' => 'Yii::app()->controller->createUrl("view", array("id" => $data["id"]))'
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'id',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'default_menu_name',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'status',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'name' => 'tree_parent_id',
                'value' => 'CHtml::value($data, \'p3Pages.itemLabel\')',
                'filter' => CHtml::listData(P3Page::model()->findAll(array('limit' => 1000)), 'id', 'itemLabel'),
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tree_position',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'name_id',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'default_url_param',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'default_page_title',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            /*
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'layout',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'view',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'url_json',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            #'default_keywords',
            #'default_description',
            #'custom_data_json',
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'access_owner',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'access_domain',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'access_read',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'access_update',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'access_delete',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'access_append',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'copied_from_id',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'created_at',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'updated_at',
                'editable' => array(
                    'url' => $this->createUrl('/p3pages/p3Page/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            */

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("P3pages.P3Page.View")'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("P3pages.P3Page.Update")'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("P3pages.P3Page.Delete")'),
                ),
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("id" => $data->id))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("id" => $data->id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("id" => $data->id))',
            ),
        )
    )
);
?>