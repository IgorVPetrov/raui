<?php
$this->pageTitle=Yii::app()->name . ' - ' . VacancyModule::t('Edit_vacancy');

$this->menu = array(
	array('label' => tt('Vacancy_management'), 'url' => array('admin')),
	array('label' => VacancyModule::t('Add_feedback'), 'url' => array('create')),
	array('label' => tt('Delete_vacancy'),
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array('delete','id'=>$model->id),
			'confirm'=> tc('Are you sure you want to delete this item?')
		),
	)
);
$this->adminTitle = VacancyModule::t('Edit_vacancy');
?>

<?php echo $this->renderPartial('/backend/_form', array('model'=>$model)); ?>