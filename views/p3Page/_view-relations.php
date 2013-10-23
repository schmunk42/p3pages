
<!--
<h2>
    <?php echo Yii::t('P3PagesModule.crud', 'Relations') ?></h2>
-->


<?php 
        echo '<h3>';
            echo Yii::t('P3PagesModule.model','relation.P3Pages').' ';
            $this->widget(
                'bootstrap.widgets.TbButtonGroup',
                array(
                    'type' => '', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => 'mini',
                    'buttons' => array(
                        array(
                            'icon' => 'icon-list-alt',
                            'url' =>  array('//p3pages/p3Page/admin','P3Page' => array('tree_parent_id' => $model->{$model->tableSchema->primaryKey}))
                        ),
                        array(
                'icon' => 'icon-plus',
                'url' => array(
                    '//p3pages/p3Page/create',
                    'P3Page' => array('tree_parent_id' => $model->{$model->tableSchema->primaryKey})
                )
            ),
            
                    )
                )
            );
        echo '</h3>' ?>
<ul>

    <?php
    $records = $model->p3Pages(array('limit' => 250, 'scopes' => ''));
    if (is_array($records)) {
        foreach ($records as $i => $relatedModel) {
            echo '<li>';
            echo CHtml::link(
                '<i class="icon icon-arrow-right"></i> ' . $relatedModel->itemLabel,
                array('/p3pages/p3Page/view', 'id' => $relatedModel->id)
            );
            echo CHtml::link(
                ' <i class="icon icon-pencil"></i>',
                array('/p3pages/p3Page/update', 'id' => $relatedModel->id)
            );
            echo '</li>';
        }
    }
    ?>
</ul>


<?php 
        echo '<h3>';
            echo Yii::t('P3PagesModule.model','relation.P3PageTranslations').' ';
            $this->widget(
                'bootstrap.widgets.TbButtonGroup',
                array(
                    'type' => '', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => 'mini',
                    'buttons' => array(
                        array(
                            'icon' => 'icon-list-alt',
                            'url' =>  array('//p3pages/p3PageTranslation/admin','P3PageTranslation' => array('p3_page_id' => $model->{$model->tableSchema->primaryKey}))
                        ),
                        array(
                'icon' => 'icon-plus',
                'url' => array(
                    '//p3pages/p3PageTranslation/create',
                    'P3PageTranslation' => array('p3_page_id' => $model->{$model->tableSchema->primaryKey})
                )
            ),
            
                    )
                )
            );
        echo '</h3>' ?>
<ul>

    <?php
    $records = $model->p3PageTranslations(array('limit' => 250, 'scopes' => ''));
    if (is_array($records)) {
        foreach ($records as $i => $relatedModel) {
            echo '<li>';
            echo CHtml::link(
                '<i class="icon icon-arrow-right"></i> ' . $relatedModel->itemLabel,
                array('/p3pages/p3PageTranslation/view', 'id' => $relatedModel->id)
            );
            echo CHtml::link(
                ' <i class="icon icon-pencil"></i>',
                array('/p3pages/p3PageTranslation/update', 'id' => $relatedModel->id)
            );
            echo '</li>';
        }
    }
    ?>
</ul>

