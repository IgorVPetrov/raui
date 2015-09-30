<?php


$this->menu=array(
	array('label'=>tt('Manage cities'), 'url'=>array('/location/backend/city/admin')),
	array('label'=>tt('Add city'), 'url'=>array('/location/backend/city/create')),
);

$this->adminTitle = tt('Edit city').': <i>'.$model->getStrByLang('name').'</i>';
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>