<?php
Yii::import('zii.widgets.jui.CJuiInputWidget');
class Calendar extends CJuiInputWidget
{
	public $language;
	public $i18nScriptFile = 'jquery-ui-i18n.min.js';
	public $defaultOptions;
	public $flat = false;

	public function run() {
		list($name,$id)=$this->resolveNameID();

		if(isset($this->htmlOptions['id']))
			$id=$this->htmlOptions['id'];
		else
			$this->htmlOptions['id']=$id;
		if(isset($this->htmlOptions['name']))
			$name=$this->htmlOptions['name'];

		if ($this->flat===false)
		{
			if($this->hasModel())
				echo CHtml::activeTextField($this->model,$this->attribute,$this->htmlOptions);
			else
				echo CHtml::textField($name,$this->value,$this->htmlOptions);
		}
		else
		{
			if($this->hasModel())
			{
				echo CHtml::activeHiddenField($this->model,$this->attribute,$this->htmlOptions);
				$attribute = $this->attribute;
				$this->options['defaultDate'] = $this->model->$attribute;
			}
			else
			{
				echo CHtml::hiddenField($name,$this->value,$this->htmlOptions);
				$this->options['defaultDate'] = $this->value;
			}

			if (!isset($this->options['onSelect']))
				$this->options['onSelect']="js:function( selectedDate ) { jQuery('#{$id}').val(selectedDate);}";

			$id = $this->htmlOptions['id'] = $id.'_container';
			$this->htmlOptions['name'] = $name.'_container';

			echo CHtml::tag('div', $this->htmlOptions, '');
		}

		$this->options['beforeShowDay'] = <<<EOD
js:function(date){
	if (typeof reservedDays !== 'undefined') {
		for (i = 0; i < reservedDays.length; i++) {
			if (date.getFullYear() == reservedDays[i][0] && date.getMonth() == reservedDays[i][1] - 1 && date.getDate() == reservedDays[i][2])
			{
				return [false, "datepicker-calendarDescriptionReserved"];
			}
		}
		return [true,""];
	}
}
EOD;

		$options=CJavaScript::encode($this->options);
		$js = "jQuery('#{$id}').datepicker($options);";

		if ($this->language!='' && $this->language!='en')
		{
			$this->registerScriptFile($this->i18nScriptFile);
			$js = "jQuery('#{$id}').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['{$this->language}'], {$options}));";
		}

		$cs = Yii::app()->getClientScript();

		if (isset($this->defaultOptions))
		{
			$this->registerScriptFile($this->i18nScriptFile);
			$cs->registerScript(__CLASS__, 	$this->defaultOptions!==null?'jQuery.datepicker.setDefaults('.CJavaScript::encode($this->defaultOptions).');':'');
		}
		$cs->registerScript(__CLASS__.'#'.$id, $js);

	}

	protected function registerCoreScripts() {
		$cs=Yii::app()->getClientScript();
		$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/ui/jquery-ui.multiselect.css');

		$cs->registerCoreScript('jquery');
		if(is_string($this->scriptFile))
			$this->registerScriptFile($this->scriptFile);
		else if(is_array($this->scriptFile))
		{
			foreach($this->scriptFile as $scriptFile)
				$this->registerScriptFile($scriptFile);
		}
	}
}