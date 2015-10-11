<?php
if((issetModule('location') && param('useLocation', 1))){ ?>
	<div class="<?php echo $divClass; ?>">
        <?php if($this->searchShowLabel){ ?>
		<div class="<?php echo $textClass; ?>"><?php echo tc('Country') ?>:</div>
        <?php } ?>
		<div class="<?php echo $controlClass; ?>">
			<?php
			echo CHtml::dropDownList(
				'country',
				isset($this->selectedCountry)?$this->selectedCountry:'',
				Country::getCountriesArray(2),
				array('class' => $fieldClass . ' searchField', 'id' => 'country',
					'ajax' => array(
						'type'=>'GET', //request type
						'url'=>$this->createUrl('/location/main/getRegions'), //url to call.
						'data'=>'js:"country="+$("#country").val()+"&type=2"',
						'success'=>'function(result){
								$("#region").html(result);
								$("#region").change();
							}'
					)
				)
			);
			?>
		</div>
	</div>

	<div class="<?php echo $divClass; ?>">
        <?php if($this->searchShowLabel){ ?>
		<div class="<?php echo $textClass; ?>"><?php echo tc('Region') ?>:</div>
        <?php } ?>
		<div class="<?php echo $controlClass; ?>">
			<?php
			echo CHtml::dropDownList(
				'region',
				isset($this->selectedRegion)?$this->selectedRegion:'',
				Region::getRegionsArray((isset($this->selectedCountry) ? $this->selectedCountry : 0), 2),
				array('class' => $fieldClass . ' searchField', 'id' => 'region',
					'ajax' => array(
						'type'=>'GET', //request type
						'url'=>$this->createUrl('/location/main/getCities'), //url to call.
						'data'=>'js:"region="+$("#region").val()+"&type=2"',
						'success'=>'function(result){
								changeSearch();
								$("#city").html(result);'.(($this->defaultTheme != 'atlas') ? '$("#city").multiselect("refresh")' : '').
							'}'
					)
				)
			);
		?>
		</div>
	</div>
<?php
}
?>

<div class="<?php echo $divClass; ?>">
    <?php if($this->searchShowLabel){ ?>
	<div class="<?php echo $textClass; ?>"><?php echo Yii::t('common', 'City') ?>:</div>
    <?php } ?>
	<div class="<?php echo $controlClass; ?>">
		<?php
        $cityArray = (issetModule('location') && param('useLocation', 1)) ?
            (City::getCitiesArray((isset($this->selectedRegion) ? $this->selectedRegion : 0), 0)) :
            $this->cityActive;

        if($this->defaultTheme == 'atlas'){
            $cityArray = CArray::merge(array(0 => tc('select city')), $cityArray);
        }

		echo CHtml::dropDownList(
			'city[]',
			isset($this->selectedCity)?$this->selectedCity:'',
			$cityArray,
			array('class' => $fieldClass.' width289 searchField')
		);
		//SearchForm::setJsParam('cityField', array('minWidth' => $minWidth)); //
		?>
	</div>
</div>
