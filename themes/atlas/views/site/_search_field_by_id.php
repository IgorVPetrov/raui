<div class="<?php echo $divClass; ?>">
    <?php if($this->searchShowLabel){ ?>
	<div class="<?php echo $textClass; ?>"><?php echo Yii::t('common', 'Apartment ID'); ?>:</div>
    <?php } ?>
	<div class="<?php echo $controlClass; ?>">
		<?php
		echo CHtml::textField('sApId', (isset($this->sApId) && $this->sApId) ? CHtml::encode($this->sApId) : '', array(
			'class' => 'width120 search-input-new',
			'onChange' => 'changeSearch();',
            'placeholder' => Yii::t('common', 'Apartment ID')
		));
		Yii::app()->clientScript->registerScript('sApId', '
			focusSubmit($("input#sApId"));
		', CClientScript::POS_READY);
		?>
	</div>
</div>
