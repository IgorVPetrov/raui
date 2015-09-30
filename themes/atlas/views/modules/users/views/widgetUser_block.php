

	<?php if ($user):?>
    

    
		<?php foreach ($user as $item) : ?>
  
  
  
                          <div class="best-agents-list">
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
                        </div>
  
        
        
        <?php endforeach; ?>

 
  
  <!--	!Вывод результатов поиска -->
        
        
		
	<?php endif; ?>



