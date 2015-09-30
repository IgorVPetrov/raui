<?php
/* @var $this Controller */
/* @var $model Currency */
/* @var $form CustomForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CustomForm', array(
        'id'=>'currency-form-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <p class="note"><?php echo Yii::t('common', 'Fields with <span class="required">*</span> are required.');?></p>

    <?php echo $form->errorSummary(array($model, $translate)); ?>

    <div class="rowold">
        <?php echo $form->labelEx($model,'char_code'); ?>
        <div class="form_tip"><?php echo Yii::t('common', 'The field should correspond {link}', array('{link}' => CHtml::link('ISO 4217', 'http://en.wikipedia.org/wiki/ISO_4217'))); ?></div>
        <?php echo $form->textField($model,'char_code'); ?>
        <?php echo $form->error($model,'char_code'); ?>
    </div>

    <div class="rowold">
        <?php echo $form->labelEx($model,'nominal'); ?>
        <?php echo $form->textField($model,'nominal'); ?>
        <?php echo $form->error($model,'nominal'); ?>
    </div>

    <div class="rowold">
        <?php echo $form->labelEx($model,'value'); ?>
        <?php echo $form->textField($model,'value'); ?>
        <?php echo $form->error($model,'value'); ?>
    </div>

    <?php
    $this->widget('application.modules.lang.components.langFieldWidget', array(
        'model' => $translate,
        'field' => 'translation',
        'type' => 'string',
    ));
    ?>
    <br/>

    <?php echo $form->checkBoxRow($model,'not_parse'); ?>

    <div class="rowold buttons">
        <?php $this->widget('bootstrap.widgets.TbButton',
            array('buttonType'=>'submit',
                'type'=>'primary',
                'icon'=>'ok white',
                'label'=> $model->isNewRecord ? tc('Add') : tc('Save'),
            )); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form --> 