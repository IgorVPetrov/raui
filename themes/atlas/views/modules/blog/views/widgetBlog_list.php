 <div  id="grid" class="list-articles pull-left">
	<?php if(!$blog):?>
		<div class="empty"><?php echo tt('Blog list is empty.', 'blog');?></div>
	<?php else:?>
    
    
  <!--Новость-->  
<?php $i=0; ?>

			<?php foreach ($blog as $item) : ?>
            
            <?php echo $i ?>
            
            <?php if($item->cat==0) {$cat="market-property";$cat_name="analytics";}else if($item->cat==1){$cat="architecture";$cat_name="news";}else if($item->cat==2){$cat="investment";$cat_name="best";}else if($item->cat==3){$cat="questions";$cat_name="company";}?>
           
           
            <?php 
								$date = $item->dateCreated;
								$date = strtotime($date);
								$date2 = date("d.m.Y", $date); // День
								$date3 = date("H:i", $date); // Время
								?>
           <?php 
								$title = CHtml::encode($item->getStrByLang('title'));
								if (utf8_strlen($title) > 15)
								$title = utf8_substr($title, 0, 37) . '...'; // Обрезаем, если больше 37 
								
								if ($i==2) {$bt_class = 'bg-article';} else if($i==3 || $i==4){$bt_class = 'md-article';} else {$bt_class = 'sm-article';}
								
								
								?>
           
           
                           <div class="<?php echo $bt_class ?> picture-item" data-groups='["<?php echo $cat_name?>"]' data-date-created="<?php echo $date2; ?>" data-popularity="1">
                    <div class="date"><?php echo $date2;?></div>
                   
                   
                    <a href="<?php echo $item->getUrl()?>">
                        
                        
               <?php $src = false;?>
                 
                <?php if($item->image):?>
                
                	<?php	if($i==2) {
					
					 $src = $item->image->getThumb(622, 415); 
					}
					else if($i==3 || $i==4) {
						
					 $src = $item->image->getThumb(300, 420); 	
						
					}
					else {
						
					$src = $item->image->getThumb(300, 195); 	
						
					}
					 
					 
					 ?>
                    
                    
				<?php endif; ?>
                <?php if($src) : ?>
						<?php echo CHtml::image(Yii::app()->getBaseUrl().'/uploads/blog/'.$src, $item->getStrByLang('title'));?>
                 <?php else: ?>
                   <img src="/themes/atlas/temp/images/demo/news-1.png">     
				<?php endif; ?> 
   
                        
                    </a>
                    
                    
                    <div class="description-article">
                    	<?php echo CHtml::link(CHtml::encode($title), $item->getUrl(), array('class'=>'title-articles')); ?>

                        <ul>
                            <li>23</li>
                            <li>8</li>
                            <li>1</li>
                        </ul>
                        <i class="icon"></i>
                    </div>
                </div>
           
               <?php  $i++;?>
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