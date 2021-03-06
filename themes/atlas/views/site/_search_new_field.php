<?php if($search->formdesigner){ ?>
	<div class="<?php echo $divClass; ?>">

		<?php if($this->searchShowLabel){ ?>
			<div class="<?php echo $textClass; ?>"><?php echo $search->getLabel(); ?>:</div>
		<?php } ?>

		<?php
			if($search->formdesigner->type == FormDesigner::TYPE_INT){
				$width = 'search-input-new width120';
			} elseif($search->formdesigner->type == FormDesigner::TYPE_REFERENCE){
				$width = 'search-input-new width290';
			} else {
				$width = 'search-input-new width285';
			}

			$value = isset($this->newFields[$search->field]) ? CHtml::encode($this->newFields[$search->field]) : '';
		?>
		<div class="<?php echo $controlClass; ?>">
		<?php
			if($search->formdesigner->type == FormDesigner::TYPE_REFERENCE){
				echo CHtml::dropDownList($search->field, $value, CMap::mergeArray(array(0 => $search->getLabel()), FormDesigner::getListByCategoryID($search->formdesigner->reference_id)),
					array('class' => 'searchField ' . $fieldClass)
				);
			}else{
				if (!$this->searchShowLabel) {
					echo CHtml::textField($search->field, $value, array(
						'class' => $width,
						'onChange' => 'changeSearch();',
						'placeholder' => $search->getLabel()
					));
				}
				else {
					echo CHtml::textField($search->field, $value, array(
						'class' => $width,
						'onChange' => 'changeSearch();',
					));
				}

				if($search->formdesigner->type == FormDesigner::TYPE_INT && $search->formdesigner->measure_unit){
					echo '&nbsp;<span class="measurement">' . $search->formdesigner->measure_unit.'</span>';
				}
			}
		echo '</div>';
		?>
	</div>
<?php } ?>
