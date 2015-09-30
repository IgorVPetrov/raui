<div class="form">

	<?php $form=$this->beginWidget('CustomForm', array(
	'id'=>$this->modelName.'-form',
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note"><?php Yii::t('common', 'Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model); ?>

    <div class="rowold">
		<?php echo $form->labelEx($model,'paid_service_id'); ?>
		<?php echo $form->dropDownList($model, 'paid_service_id', PaidServices::getListForEdit()); ?>
		<?php echo $form->error($model,'paid_service_id'); ?>
    </div>

    <div class="rowold">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model, 'price'); ?>
		<span><?php echo Currency::getDefaultCurrencyModel()->name; ?></span>
		<?php echo $form->error($model,'price'); ?>
    </div>

    <div class="rowold">
		<?php echo $form->labelEx($model, 'duration_days'); ?>
		<?php echo $form->textField($model, 'duration_days'); ?>
		<?php echo $form->error($model, 'duration_days'); ?>
    </div>

    <div class="clear"></div>
    <br>

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