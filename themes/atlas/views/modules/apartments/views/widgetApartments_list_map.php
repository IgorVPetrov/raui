<?php
if(empty($apartments)){
	$apartments = Apartment::findAllWithCache($criteria);
}

$ids = array();
foreach($apartments as $apartment){
	$ids[] = $apartment->id;
}
$criteriaForMap = new CDbCriteria();
$criteriaForMap->addInCondition('t.id', $ids);

?>

<?php $this->widget('application.modules.viewallonmap.components.ViewallonmapWidget', array('criteria' => $criteriaForMap, 'filterOn' => false, 'withCluster' => true)); ?>