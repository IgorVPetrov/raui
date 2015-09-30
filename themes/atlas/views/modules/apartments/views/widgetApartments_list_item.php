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



<!--Вывод результата-->
<tr class="<?php echo $addClass; ?>">
                        <td class="text-center">
                            <ul>
                            
                            	<?php 
								$title = CHtml::encode($item->getStrByLang('title'));
								if (utf8_strlen($title) > 15)
								$title = utf8_substr($title, 0, 20) . '...'; // Обрезаем, если больше 20 ?>
                                
                                <li><strong><?php echo $title;?></strong></li>
                                <li><a href="<?php echo $item->getUrl() ?>">ID <?php echo $item->id ?></a></li>
                                <li><?php
				$res = Images::getMainThumb(100,100, $item->images);
				$img = CHtml::image($res['thumbUrl'], $item->getStrByLang('title'), array(
					'title' => $item->getStrByLang('title'),
					'class' => 'apartment_type_img'
				));
				echo CHtml::link($img, $item->getUrl(), array('title' =>  $item->getStrByLang('title'), 'alt' => $item->getStrByLang('title')));
				?></li>
                                <li><a href="<?php echo $item->getUrl() ?>"><?php echo $item->count_img; ?> фото</a></li>
                            </ul>
                        </td>
                        <td>
                            <ul>
                                <li><strong>г. <?php echo $item->locCity->getStrByLang('name'); ?></strong></li>
                                <li><strong>м. Серпухова</strong></li>
                                <li><strong><i>(5 мин. пешком)</i></strong></li>
                                <li><strong><?php echo $item->getStrByLang('address');?></strong></li>
                            </ul>
                        </td>
                        <td>
                            <ul>
                                <li><strong>Общая: <?php echo $item->square;?> м<sup>2</sup></strong></li>
                               <?php if($item->ci_square!=='0') {
                                echo '<li><strong>Кухня: '.$item->ci_square.' м<sup>2</sup></strong></li>';
                                }?>
                            </ul>
                        </td>
                        <td>
                            <ul>
                                <li class="price"><strong>
								<?php
					if ($item->is_price_poa)
						echo tt('is_price_poa', 'apartments'); // Цена по требованию
					else
						echo $item->bt_getPrettyPrice();
					?>
                    </strong></li>
                                <li>Предоплата 1 мес.</li>
                                <li>Аренда от года</li>
                            </ul>
                        </td>
                        <td class="text-center">
                            Агенту 100%
                        </td>
                        <td class="text-center"><?php echo $item->floor;?> / <?php echo $item->floor_total;?></td>
                        <td>
                            <button class="tel-search-res">
                                <img src="/themes/atlas/temp/images/icon-telephone.png"/>
                                <span>показать</span>
                            </button>
                            <span class="hide"><?php echo $item->phone ;?></span>
                        </td>
                        <td>
                        
      <?php                   
        $additionFields = HFormEditor::getExtendedFields();
		$existValue = HFormEditor::existValueInRows($additionFields, $item);
		$item->references = $item->getFullInformation($item->id, $item->type, $category->id);
		
		

			$firstTabsItems = array(
				'content' => Yii::app()->controller->renderPartial('//modules/apartments/views/_bt_tab_addition', array(
						'data'=>$item,
						'additionFields' =>$additionFields
					), true)
			);
              ?>          
               <?php 
			   echo $firstTabsItems['content'];
			   ?>         
                        

                        </td>
                        <td>
                        <?php 
								$date = $item->date_created;
								$date = strtotime($date);
								$date2 = date("d.m.Y", $date); // День
								?>
                            <ul>
                                <li>Активно с <?php echo $date2; ?></li>
                                <li>Разместил <a href="/users/main/view/id/<?php echo $item->owner_id; ?>"><?php $owner = $item->user; echo $owner->getNameForType(); ?></a></li>
                            </ul>
                            <!--<ul>
                                <li>Хозяева рассмотрят:</li>
                                <li>- семейную пару</li>
                                <li>- можно с детьми</li>
                                <li>- можно с животными</li>
                            </ul>-->
                            <div class="pull-right text-right show-on-map">
                                <a>
                                    <img src="/themes/atlas/temp/images/show-on-map.png" alt=""/>
                                </a>
                                <a>смотреть на карте</a>
                            </div>
                        </td>
                    </tr>



<!--!Вывод результата-->


    
	<?php $p++;?>
<?php endforeach;?>