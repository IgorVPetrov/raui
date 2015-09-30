<?php
	$count = 0;
	if($this->images) : ?>
	<ul class="thumbnails">
		<?php foreach($this->images as $image) :?>
			<li>
				<?php
					/*$imgTag = CHtml::image(Images::getThumbUrl($image, 640, 400), Images::getAlt($image));

					echo CHtml::link($imgTag, Images::getThumbUrl($image, 640, 400),
						array(
							'title' => Images::getAlt($image),
						)
					);*/
					
					$imgTag = CHtml::image(Images::getThumbUrl($image, 100, 100), Images::getAlt($image), array());
					
					echo CHtml::link($imgTag, '', array(
						'title' => Images::getAlt($image),
						'class' => 'thumbnail',
						'id'	=> 'carousel-selector-'.$count
					));
					$count++;
				?>
              
                
			</li>
		<?php endforeach;?>
	</ul>
<?php endif;?>