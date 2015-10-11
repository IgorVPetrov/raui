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



                    <div class="result-search-object-list">
                        <div class="image">
                            <?php
				$res = Images::getMainThumb(300,157, $item->images);
				$img = CHtml::image($res['thumbUrl'], $item->getStrByLang('title'), array(
					'title' => $item->getStrByLang('title'),
					'class' => 'apartment_type_img'
				));
				echo CHtml::link($img, $item->getUrl(), array('title' =>  $item->getStrByLang('title'), 'alt' => $item->getStrByLang('title')));
				?>
                            <div class="result-search-title">
                                <a href="<?php echo $item->getUrl() ?>" ><?php echo $title; ?></a>
                            </div>
                        </div>
                        <div class="address" style="min-height:66px">
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
					if (utf8_strlen($description) > 200)
						$description = utf8_substr($description, 0, 200) . '...';

					echo $description;

					?>
                        </div>
                    </div>





<!--!Вывод результата-->


    

<?php endforeach;?>