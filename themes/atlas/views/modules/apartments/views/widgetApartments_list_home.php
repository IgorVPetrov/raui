

	<?php if ($apCount):?>
    
  
        
    
    
    
		<?php $this->render('widgetApartments_list_item_block', array('criteria' => $criteria)); ?>
        
        

  
        
        

	<?php endif; ?>


<?php if (!$apCount):?>
	<div class="empty"><?php echo Yii::t('module_apartments', 'Apartments list is empty.');?></div>
<?php endif;?>

