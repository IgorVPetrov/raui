<div class="form">

<?php $form=$this->beginWidget('CustomForm', array(
	'id'=>$this->modelName.'-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('common', 'Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="rowold">
		<?php echo $form->labelEx($model,'country_id'); ?>
		<?php echo $form->dropDownList($model,'country_id',Country::getCountriesArray(0,1),
				array('id'=>'ap_country',
					'ajax' => array(
						'type'=>'GET', //request type
						'url'=>$this->createUrl('/location/main/getRegions'), //url to call.
						//Style: CController::createUrl('currentController/methodToCall')
						'update'=>'#ap_region', //selector to update
						'data'=>'js:"country="+$("#ap_country").val()+"&all=1"'
						//leave out the data key to pass all form values through
					)
				)
			); ?>
		<?php echo $form->error($model,'country_id'); ?>
	</div>

	<?php
		//при создании города узнаём id первой в дропдауне страны
		if ($model->country_id) {
			$country = $model->country_id;
		} else {
			$country_keys = array_keys(Country::getCountriesArray(0,1));
			$country = isset($country_keys[0]) ? $country_keys[0] : 0;
		}
	?>
	<div class="rowold">
		<?php echo $form->labelEx($model,'region_id'); ?>
		<?php echo $form->dropDownList($model,'region_id', Region::getRegionsArray($country,0,1), array('id'=>'ap_region')); ?>
		<?php echo $form->error($model,'region_id'); ?>
	</div>


	<?php
	$this->widget('application.modules.lang.components.langFieldWidget', array(
		'model' => $model,
		'field' => 'name',
		'type' => 'string'
	));
	?>
	<div class="clear"></div>

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