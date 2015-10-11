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
<style>
#googleMap, #ymap, #osmap {
    width: 958px;
    height: 701px;
    float: right;
}
</style>

<div class="sidebar-left pull-left">
<?php $this->render('widgetApartments_list_item_new_map', array('apartments' => $apartments)); ?>
</div>

<div class="map" style="width: 961px;float: left;">

<?php $this->widget('application.modules.viewallonmap.components.ViewallonmapWidget', array('criteria' => $criteriaForMap, 'filterOn' => false, 'withCluster' => true)); ?>

</div>
