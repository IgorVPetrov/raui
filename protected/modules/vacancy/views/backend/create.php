<?php
$this->pageTitle=Yii::app()->name . ' - ' . VacancyModule::t('Add_feedback');

$this->menu = array(
	array('label' => tt('Vacancy_management'), 'url' => array('admin')),
);

$this->adminTitle = VacancyModule::t('Add_feedback');
?>

<?php echo $this->renderPartial('/backend/_form', array('model'=>$model)); ?>