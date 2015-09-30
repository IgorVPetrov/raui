
    <?php if($this->searchShowLabel){ ?>
	<div class="bt1 <?php echo $textClass; ?>"><?php echo tt('Search in section', 'common'); ?>:</div>
    <?php } ?>
	<li>
		<?php
		$data = SearchForm::apTypes();

		echo CHtml::dropDownList(
			'apType',
			isset($this->apType) ? CHtml::encode($this->apType) : '',
			$data['propertyType'],
			array('class' => $fieldClass . ' searchField')
		);

		
		?>
	</li>

