<!--                                    <li>
                                        <div class="user-location-or-city">
                                            <select name="" id="" class="selectpicker-search">
                                                <option value="">Ваше местоположение или город</option>
                                                <option value="">Ваше местоположение или город</option>
                                                <option value="">Ваше местоположение или город</option>
                                            </select>
                                        </div>
                                    </li>-->

<!--Все что ниже поиск по местоположению-->

<?php
if((issetModule('location') && param('useLocation', 1))){ ?>
<?php /*?>	<div class="<?php echo $divClass; ?>">
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
	</div><?php */?>

	<li class="<?php echo $divClass; ?>">
        <?php if($this->searchShowLabel){ ?>
		<div class="<?php echo $textClass; ?>"><?php echo tc('Region') ?>:</div>
        <?php } ?>
		<div class="<?php echo $controlClass; ?>">
			<?php
			echo CHtml::dropDownList(
				'region',
				isset($this->selectedRegion)?$this->selectedRegion:'',
			//	Region::getRegionsArray((isset($this->selectedCountry) ? $this->selectedCountry : 0), 2),
				Region::getRegionsArray((219), 2), // Только Россия
			
				array('class' => $fieldClass . ' searchField', 'id' => 'region',
					'ajax' => array(
						'type'=>'GET', //request type
						'url'=>$this->createUrl('/location/main/getCities'), //url to call.
						'data'=>'js:"region="+$("#region").val()+"&type=2"',
						'success'=>'function(result){
								changeSearch();
								
								$("#city").html(result); $("#city").selectpicker("refresh");'.(($this->defaultTheme != 'atlas') ? '$("#city").multiselect("refresh")' : '').
								
							'}'
					)
				)
			);
		?>
		</div>
	</li>
<?php
}
?>

<li class="<?php echo $divClass; ?>">
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
</li>
