<?php


$this->menu=array(
	array('label'=>tt('Manage cities'), 'url'=>array('/location/backend/city/admin')),
);
$this->adminTitle = tt('Add city');
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>