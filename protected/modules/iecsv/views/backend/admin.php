<?php
$this->pageTitle=Yii::app()->name . ' - ' . IecsvModule::t('Import / Export');

$this->breadcrumbs = array(
	tt('Import / Export'),
);

$this->adminTitle = tt('Import / Export');
?>

<?php
$info = "
<div>
	<p>
		<strong>".tt('Export')."</strong>
	</p>
	<p>
		<strong>".tt('You can export your listings into a .csv file. Exported fields are listed below.')."</strong>
	</p>
	<p>
		".tt('Fields_import_export')."
	</p>
	<p>
		".tt('2 variants of listings export are available.')."
	</p>
</div>
";
Yii::app()->user->setFlash(
	'info', $info
);
?>

<div>
	<p>
		<?php
			$link = '#';
			if (Yii::app()->language == 'ru')
				$link = '#';
		?>
		<?php echo CHtml::link(tt('Help / Documentation of use this option'),$link, array('target'=>'_blank')); ?>
	</p>
</div>

<div>
	<?php
		$this->widget('bootstrap.widgets.TbButton',
			array('buttonType' => 'button',
				'type' => 'primary',
				'icon' => 'ok white',
				'label' => tt('Export'),
				'htmlOptions' => array(
					'onclick' => 'location.href="' . Yii::app()->baseUrl . '/iecsv/backend/main/viewExport";',
				)
			));
	?>
	&nbsp;
	<?php
		$this->widget('bootstrap.widgets.TbButton',
			array('buttonType' => 'button',
				'type' => 'primary',
				'icon' => 'ok white',
				'label' => tt('Import'),
				'htmlOptions' => array(
					'onclick' => 'location.href="' . Yii::app()->baseUrl . '/iecsv/backend/main/viewImport";',
				)
			));
	?>
</div>