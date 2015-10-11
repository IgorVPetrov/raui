<?php
if(empty($apartments)){
	$apartments = Apartment::findAllWithCache($criteria);
}

$findIds = $countImagesArr = array();
foreach($apartments as $item) {
	$findIds[] = $item->id;
}
if (count($findIds) > 0)
	$countImagesArr = Images::getApartmentsCountImages($findIds);

$p = 1;
?>

<?php foreach ($apartments as $item):?>

<?php // print_r($item)?>
								<?php 
								$date = $item->date_updated;
								$date = strtotime($date);
								$date2 = date("d.m.Y", $date); // День
								?>
 <tr>
                    <td><?php echo $date2 ?></td>
                    <td><?php echo Apartment::getNameByType($item->type); ?></td>
                    <td><?php echo $item->locRegion->getStrByLang('name');?></td>
                    <td><?php echo utf8_ucfirst($item->objType->name);?><?php if ($item->num_of_rooms){
					echo ',&nbsp;';
					echo Yii::t('module_apartments',
						'{n} bedroom|{n} bedrooms|{n} bedrooms', array($item->num_of_rooms));
				} ?></td>  <!--Что-->
                    <td><?php echo $item->bt_getPriceMod();?></td>
                    <td><a><?php echo $item->user->getNameForType();?></a></td>
                </tr>





    
	<?php $p++;?>
<?php endforeach;?>