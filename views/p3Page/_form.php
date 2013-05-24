<div class="">
    <p class="note">
        <?php echo Yii::t('P3PagesModule.crud', 'Fields with'); ?> <span
            class="required">*</span> <?php echo Yii::t('P3PagesModule.crud', 'are required'); ?>.
    </p>

    <?php
    $form = $this->beginWidget(
        'CActiveForm',
        array(
             'id'                     => 'p3-page-form',
             'enableAjaxValidation'   => true,
             'enableClientValidation' => true,
        )
    );

    echo $form->errorSummary($model);
    ?>



    <div class="row">
        <div class="span4">
            <h3><?php echo Yii::t('P3PagesModule.crud', 'Menu Name'); ?></h3>
            <?php echo $model->t('menuName'); ?>
        </div>
        <div class="span8">
            <h3><?php echo Yii::t('P3PagesModule.crud', 'Node Identifier'); ?></h3>
            <?php echo $form->labelEx($model, 'nameId'); ?>

            <?php echo $form->textField($model, 'nameId'); ?>
            <?php echo $form->error($model, 'nameId'); ?>
            <?php if ('help.nameId' != $help = Yii::t('P3PagesModule.crud', 'help.nameId')) {
                echo "<span class='help-block'>$help</span>";
            } ?>
        </div>
    </div>


    <div class="row">
        <div class="span4">
            <h3><?php echo Yii::t('P3PagesModule.crud', 'View and Layout'); ?></h3>


            <?php echo $form->labelEx($model, 'layout'); ?>

            <?php echo $form->dropDownList(
                $model,
                'layout',
                $this->module->params['availableLayouts'],
                array('empty' => 'none')
            ); ?>
            <?php echo $form->error($model, 'layout'); ?>
            <?php if ('help.layout' != $help = Yii::t('P3PagesModule.crud', 'help.layout')) {
                echo "<span class='help-block'>$help</span>";
            } ?>


            <?php echo $form->labelEx($model, 'view'); ?>
            <?php echo $form->dropDownList(
                $model,
                'view',
                $this->module->params['availableViews'],
                array('empty' => 'none')
            ); ?>
            <?php echo $form->error($model, 'view'); ?>
            <?php if ('help.view' != $help = Yii::t('P3PagesModule.crud', 'help.view')) {
                echo "<span class='help-block'>$help</span>";
            } ?>

        </div>
        <div class="span8">
            <h3><?php echo Yii::t('P3PagesModule.crud', 'Internal Route or Redirect'); ?></h3>

            <?php echo $form->labelEx($model, 'route'); ?>
            <?php
            $this->widget(
                'jsonEditorView.JuiJSONEditorInput',
                array(
                     'model'     => $model,
                     // ActiveRecord, or any CModel child class
                     'attribute' => 'route'
                     // Model attribute holding initial JSON data string
                )
            );
            ?>
            <div class="notice">Do not use double quotes (") for keys and/or values!</div>
            <?php echo $form->error($model, 'route'); ?>
            <?php if ('help.route' != $help = Yii::t('P3PagesModule.crud', 'help.route')) {
                echo "<span class='help-block'>$help</span>";
            } ?>
        </div>

    </div>


    <div class="form-actions">

        <?php
        echo CHtml::Button(
            Yii::t('P3PagesModule.crud', 'Cancel'),
            array(
                 'submit' => array('p3Page/admin'),
                 'class'  => 'btn'
            )
        );
        echo ' ';

        echo CHtml::submitButton(
            Yii::t('P3PagesModule.crud', 'Save'),
            array(
                 'class' => 'btn btn-primary'
            )
        ); ?>

    </div>

    <?php $this->endWidget(); ?>

</div>
<!-- form -->
