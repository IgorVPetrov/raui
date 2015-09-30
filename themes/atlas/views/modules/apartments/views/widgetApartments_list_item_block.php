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
	<?php
	$addClass = $lastClass = '';

	$isLast = ($p % 3) ? false : true;
	$lastClass = ($isLast) ? 'right_null' : '';

	if ($item->date_up_search != '0000-00-00 00:00:00')
		$addClass = 'vip-offer';
	?>


<?php if($p == 1) {	
echo '<div class="active item">';
}
else if ($p == 5 || $p == 9) {
	echo '<div class="item">';
}
?>


<div class="latest-ads-adv">
                            <a href="<?php echo $item->getUrl() ?>" class="image">
                                 <?php
					$res = Images::getMainThumb(297,198, $item->images);
					$img = CHtml::image($res['thumbUrl'], $item->getStrByLang('title'), array(
						'title' => $item->getStrByLang('title'),
                        'class' => 'apartment_type_img'
					));
					echo $img;
				?>
                                <span><?php echo Apartment::getNameByType($item->type); ?> <?php echo $item->bt_getPriceMod();?></span>
                            </a>
                            <div class="latest-ads-desc">
                            <?php 
								$title = CHtml::encode($item->getStrByLang('title'));
								if (utf8_strlen($title) > 35)
								$title = utf8_substr($title, 0, 35) . '...'; // Обрезаем, если больше 31 ?>
                                
                                <a href="<?php echo $item->getUrl() ?>"><?php echo $title ?></a>
                                <ul>
                                    <li>м. Савёловская</li>
                                    <li><?php echo $item->getStrByLang('address');?></li>
                                </ul>
                            </div>
                            <div class="clear silk-section">
                                <a href="/search?apType=<?php echo $item->type ?>"><?php echo Apartment::getNameByType($item->type); ?></a>
                            </div>
</div>


<?php if($p == 4 || $p == 8|| $p == 12) {
	
echo '</div>';

}?>

    
	<?php $p++;?>
<?php endforeach;?>