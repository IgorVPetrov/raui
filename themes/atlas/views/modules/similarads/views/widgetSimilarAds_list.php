
<?php
if (is_array($ads) && count($ads) > 0) {


 $i=0;
			foreach ($ads as $item) {
				if ($i==4) return;
				echo '<div class="similarhr-ads-adv">';
					echo '<a href="#card-object" role="button" data-toggle="modal" class="image">';
						$res = Images::getMainThumb(297, 198, $item->images);
						echo CHtml::image($res['thumbUrl'], '', array(
							'title' => $item->{'title_'.Yii::app()->language},
							'width' => 297,
							'height' => 198,
						));
					echo '<span>'.Apartment::getNameByType($item->type).' '.$item->bt_getPriceMod().'</span></a>';
					
					
					echo '<div class="similarhr-ads-desc">
                   		 <a href="#card-object" role="button" data-toggle="modal">'.truncateText(CHtml::encode($item->getStrByLang('title')), 6).'</a>
                   			 <ul>
                        		<li>м. Савёловская</li>
                        		<li>ул. Раздельная, д.12</li>
                   			 </ul>
                	</div>
           ';
					
					
					
				echo '</div>';
				$i++;
			}






	
}
?>

