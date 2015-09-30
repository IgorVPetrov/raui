<?php
if(empty($apartments)){
	$apartments = Apartment::findAllWithCache($criteria);
}

?>

<?php foreach ($apartments as $item):?>




<!--Вывод результата-->

<?php 
								$title = CHtml::encode($item->getStrByLang('title'));
								if (utf8_strlen($title) > 30)
								$title = utf8_substr($title, 0, 30) . '...'; // Обрезаем, если больше 20 
								
								$description = '';
								if ($item->canShowInView('description')) {
								$description = $item->getStrByLang('description');
								}
?>



                    <div class="add-luxury-offer">
                        <div class="image">
                            <?php
				$res = Images::getMainThumb(526,348, $item->images);
				$img = CHtml::image($res['thumbUrl'], $item->getStrByLang('title'), array(
					'title' => $item->getStrByLang('title'),
					'class' => 'apartment_type_img'
				));
				echo CHtml::link($img, $item->getUrl(), array('title' =>  $item->getStrByLang('title'), 'alt' => $item->getStrByLang('title')));
				?>
                            <div class="add-luxury-offer-title">
                                <div><a href="<?php echo $item->getUrl() ?>"><?php echo $title; ?> <?php echo $item->square;?> м<sup>2</sup></a></div>
                                <div><?php
					if ($item->is_price_poa)
						echo tt('is_price_poa', 'apartments'); // Цена по требованию
					else
						echo $item->getPrettyPrice();
					?></div>
                            </div>
                        </div>
                        <div class="info">
                            <div class="addres">
                                <?php                   if($item->locRegion){
						if($item->locCountry)
						echo $item->locRegion->getStrByLang('name');
					} 
?>
<?php if($item->locCity){
						if($item->locCountry || $item->locRegion)
							echo ',&nbsp; г.';
						echo $item->locCity->getStrByLang('name');
					}
?>
                            <?php echo ',&nbsp;'.$item->getStrByLang('address');?><br>
                                м. “Аэропорт”
                            </div>
                            <div class="description">
                                <?php
					if (utf8_strlen($description) > 300)
						$description = utf8_substr($description, 0, 300) . '...';

					echo $description;

					?>
                            </div>
                        </div>
                        <div class="map">
                            <img src="/themes/atlas/temp/images/demo/all-luxury-offers-map.png">
                        </div>
                    </div>






<!--!Вывод результата-->


    

<?php endforeach;?>