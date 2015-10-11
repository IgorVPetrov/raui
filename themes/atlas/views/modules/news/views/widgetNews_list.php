<div id="grid" class="pull-left">
	<?php if(!$news):?>
		<div class="empty"><?php echo tt('News list is empty.', 'news');?></div>
	<?php else:?>
    
    
  <!--Новость-->  

			<?php foreach ($news as $item) : ?>
            <?php if($item->cat==0) {$cat="market-property";$cat_name="Рынок недвижимости";}else if($item->cat==1){$cat="around-world";$cat_name="Вокруг света";}else if($item->cat==2){$cat="moscow-region";$cat_name="Москва и область";}else if($item->cat==3){$cat="questions";$cat_name="Вопросы права";}?>
            <div class="picture-item" data-groups='["<?php echo $cat?>","all"]'>
                 <div class="filter-news-list">
            			<h4><?php echo CHtml::link(CHtml::encode($item->getStrByLang('title')), $item->getUrl()); ?></h4>
                          
                 <div class="image pull-left">
                 <?php $src = false;?>
                 
                <?php if($item->image):?>
					<?php $src = $item->image->getThumb(428, 144); ?>
				<?php endif; ?>
                <?php if($src) : ?>
						<?php echo CHtml::image(Yii::app()->getBaseUrl().'/uploads/news/'.$src, $item->getStrByLang('title'));?>
                 <?php else: ?>
                   <img src="/themes/atlas/temp/images/demo/news-1.png">     
				<?php endif; ?>     
                                <?php 
								$date = $item->dateCreated;
								$date = strtotime($date);
								$date2 = date("d.m.Y", $date); // День
								$date3 = date("H:i", $date); // Время
								?>

                                <div>
                                    <span><?php echo $cat_name; ?></span>
                                    <span class="data-time"><?php echo $date2; ?></span>
                                    <span class="data-time text-right"><?php echo $date3; ?></span>
                                </div>
                            </div>
                            <div class="filter-news-text">
                               <?php echo $item->getAnnounce(); ?>
                            </div>
                            <?php echo CHtml::link('Подробнее', $item->getUrl(), array('class' => 'readmore')); ?>
                
                
                </div>
                </div>
                
			<?php endforeach; ?>




   
   <!--!Новость -->    
        
	<?php endif;?>
</div>



<?php if($pages && $pages->pageCount > 1):?>
	<div class="pagination">
	<?php
		$this->widget('itemPaginatorAtlas',
			array(
				'pages' => $pages,
				'header' => '',
				'selectedPageCssClass' => 'current',
				'htmlOptions' => array(
					'class' => ''
				)
			)
		);
	?>
	</div>
	<div class="clear"></div>
<?php endif; ?>