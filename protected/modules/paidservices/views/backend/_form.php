<div class="form">

<?php $form=$this->beginWidget('CustomForm', array(
	'id'=>$this->modelName.'-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php Yii::t('common', 'Fields with <span class="required">*</span> are required.');?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->labelEx($model,'active'); ?>
	<?php echo $form->dropDownList($model, 'active', array(
	'1' => tt('Active', 'apartments'),
	'0' => tt('Inactive', 'apartments'),
), array('class' => 'width150')); ?>
	<?php echo $form->error($model,'active'); ?>

    <?php
    $this->widget('application.modules.lang.components.langFieldWidget', array(
    		'model' => $model,
    		'field' => 'name',
            'type' => 'string',
    	));
    ?>

    <?php
    $this->widget('application.modules.lang.components.langFieldWidget', array(
    		'model' => $model,
    		'field' => 'description',
            'type' => 'text-editor',
    	));
    ?>

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