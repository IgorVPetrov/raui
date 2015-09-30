

	<?php if ($user):?>
    

    <div id="slider-best-agency" class="carousel slide">
                <div class="carousel-inner">
    
  <?php  $p = 1; ?>
		<?php foreach ($user as $item) : ?>
  
<?php   if ($p==7) continue?>
  
  
  
  
        
<?php if($p == 1) {	
echo '<div class="active item">';
}
else if ($p == 4 || $p == 8) {
	echo '<div class="item">';
}
?>
        
        
        <div class="item-block">
                            <a href="<?php echo $item->getUrl()?>"><?php
        $item->renderAva(true, '', true);
        $additionalInfo = 'additional_info_'.Yii::app()->language;
        if (isset($item->$additionalInfo) && !empty($item->$additionalInfo)){
            echo CHtml::encode(truncateText($data->$additionalInfo, 40));
        }
		?></a>
                            <div>
                                <span><?php echo $item->getTypeName();?>: <?php echo CHtml::link( ($item->type == User::TYPE_AGENCY ? $item->agency_name : $item->username ), $item->getUrl() );?></span>
                                <ul>
                                    <li>продажа квартир (<?php echo $item->getKvAd(); ?>)</li>
                                    <li>продажа домов (<?php echo $item->getDmAd(); ?>)</li>
                                    
                                </ul>
                            </div>
                            <?php //print_r($item)?>
                        </div>
        
        
        
        
<?php if($p == 3 || $p == 6|| $p == 11) {
	
echo '</div>';

}?>      
  
  
  
        
        
        <?php  $p++; ?>
        
        <?php endforeach; ?>

  </div>
  
  <ol class="carousel-indicators">
                        <li data-target="#slider-best-agency" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-best-agency" data-slide-to="1"></li>
                      
                    </ol>
  
  </div>
  
  
  <!--	!Вывод результатов поиска -->
        
        
		
	<?php endif; ?>



