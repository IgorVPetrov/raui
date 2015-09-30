
	<?php if ($apCount):?>
    
   <!-- Вывод результатов поиска-->
     
   <?php   if($this->bt_param == 'latest-app-tb-left') {
     	$link = '/search?apType=6';
     }
     else {
     	$link = '/search?apType=7';
     }
     ?>
        
    <table class="pull-left <?php echo $this->bt_param ?>">
                <caption align="top">
                    <a href="<?php echo $link ?>">Всего заявок по аренде: [<?php echo $apCount?>]</a>
                </caption>
                <tr>
                    <th>Дата</th>
                    <th>Тип сделки</th>
                    <th>Область</th>
                    <th>Объект</th>
                    <th>Бюджет</th>
                    <th>Контактные данные</th>
                </tr>
    
    
		<?php  $this->render('widgetApartments_list_item_Table', array('criteria' => $criteria)); ?>
        
        
    </table>

  
  <!--	!Вывод результатов поиска -->
        
        

	<?php endif; ?>


<?php if (!$apCount):?>
	<div class="empty"><?php echo Yii::t('module_apartments', 'Apartments list is empty.');?></div>
<?php endif;?>

