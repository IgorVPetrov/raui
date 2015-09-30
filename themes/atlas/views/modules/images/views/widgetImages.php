<?php
	$count = 0;
	if($this->images) : ?>
	<!--<ul style="left: 0px; top: 0px;" id="jcarousel">-->
		<?php foreach($this->images as $image) :?>
			<div class="<?php echo ($count==0)?'active':''?> item" data-slide-number="<?php echo $count?>">
				<?php
					/*$imgTag = CHtml::image(Images::getThumbUrl($image, 640, 400), Images::getAlt($image));

					echo CHtml::link($imgTag, Images::getThumbUrl($image, 640, 400),
						array(
							'title' => Images::getAlt($image),
						)
					);*/
					
					//$imgTag = CHtml::image(Images::getThumbUrl($image, 69, 66), Images::getAlt($image), array(
//						'onclick' => 'setImgGalleryIndex("'.$count.'");',
//					));
//					echo CHtml::link($imgTag, Images::getFullSizeUrl($image), array(
//						'rel' => 'prettyPhoto[img-gallery]',
//						'title' => Images::getAlt($image),
//					));
					$count++;
				?>
                <img width="1280px" src="<?php echo Images::getFullSizeUrl($image) ?>">
                
			</div>
		<?php endforeach;?>
	<!--</ul>-->
<?php endif;?>