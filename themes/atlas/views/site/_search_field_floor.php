<div class="<?php echo $divClass; ?>">
	<?php if (issetModule('selecttoslider') && param('useFloorSlider') == 1) { ?>
		<div class="<?php echo $textClass; ?>"><?php echo Yii::t('common', 'Floor range'); ?>:</div>
		<div class="<?php echo $controlClass; ?>">
			<?php
			$floorItems = array_merge(
				range(0, param('moduleApartments_maxFloor', 30))
			);
			$floorMin = isset($this->floorCountMin) ? CHtml::encode($this->floorCountMin) : 0;
			$floorMax = isset($this->floorCountMax) ? CHtml::encode($this->floorCountMax) : max($floorItems);

			SearchForm::renderSliderRange(array(
				'field' => 'floor',
				'min' => 0,
				'max' => param('moduleApartments_maxFloor', 30),
				'min_sel' => $floorMin,
				'max_sel' => $floorMax,
				'step' => 1,
				'class' => 'floor-search-select',
			));
		?>
		</div>
	<?php } else { ?>
        <?php if($this->searchShowLabel){ ?>
		    <div class="<?php echo $textClass; ?>"><?php echo tc('Flat on floor'); ?>:</div>
        <?php } ?>
		<div class="<?php echo $controlClass; ?>">
			<?php
					$floorItems = array_merge(
						array(0 => tc('Flat on floor')),
						range(1, param('moduleApartments_maxFloor', 30))
					);
					echo CHtml::dropDownList('floor', isset($this->floorCount) ? CHtml::encode($this->floorCount) : 0, $floorItems, array('class' => $fieldClass . ' searchField'));
					Yii::app()->clientScript->registerScript('floor', '
						focusSubmit($("select#floor"));
					', CClientScript::POS_READY);
			?>
		</div>
		<?php }
	?>
</div>
