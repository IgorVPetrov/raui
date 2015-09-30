<?php
$route = Controller::getCurrentRoute();

if(!Yii::app()->request->isAjaxRequest){
	Yii::app()->clientScript->registerScript('search-params', "
		var updateText = '" . Yii::t('common', 'Loading ...') . "';
		var resultBlock = 'appartment_box';
		var indicator = '" . Yii::app()->theme->baseUrl . "/images/pages/indicator.gif';
		var bg_img = '" . Yii::app()->theme->baseUrl . "/images/pages/opacity.png';

		var useGoogleMap = ".param('useGoogleMap', 0).";
		var useYandexMap = ".param('useYandexMap', 0).";
		var useOSMap = ".param('useOSMMap', 0).";

		$('div.appartment_item').live('mouseover mouseout', function(event){
			if (event.type == 'mouseover') {
			 $(this).find('div.apartment_item_edit').show();
			} else {
			 $(this).find('div.apartment_item_edit').hide();
			}
		});
	",
	CClientScript::POS_HEAD, array(), true);
}
?>

<?php if ($_GET['viem']=='map'): ?>


	<?php 
	
	if($_GET['objType']==6) {
		
		$views = 'elit';
		
	}
	else if($_GET['objType']==7) {
		
		$views = 'new_b';
		
	}
	
	?>


		<?php if ($apCount):?>
        
        
        <?php if ($views == 'elit'):?>
        
        
        <section class="container-full">
        
      		 <div class="result-search-luxury clearfix">
        
        	<div class="result-search-luxury-quantity">
                    <strong>Всего найдено:</strong>   <?php echo (isset($count) && $count ? ' ' . $count . '' : '');?>   предложений
                    
                   
                    <a href="/page/elitnoe-zhile">Изменить условия поиска</a>
                
                    
                </div>
        
        <?php $this->render('widgetApartments_list_item_map', array('criteria' => $criteria)); ?>
        
     		</div>
        
        </section>
        
        
        
         <?php elseif ($views == 'new_b'):?>
         
         
         
         <section class="container-full">
        
      		<div class="result-search-new clearfix">
        
        	<div class="result-search-new-quantity">
                    <strong>Всего найдено:</strong>   <?php echo (isset($count) && $count ? ' ' . $count . '' : '');?>   предложений
                    
                   
                    <a href="/page/novostrojki">Изменить условия поиска</a>
                
                    
                </div>
        
        <?php $this->render('widgetApartments_list_item_map', array('criteria' => $criteria)); ?>
        
     		</div>
        
        </section>
         
         
         
          <?php endif; ?>
        

        


		<?php endif; ?>


<?php elseif ($_GET['objType']==6): ?>




<?php if ($apCount):?>

	
        <!-- All luxury offers -->
        <section class="container-full" id="appartment_box">

            <div class="add-luxury-offers">
                <div class="add-luxury-offers-quantity">
                    <strong>Всего на рынке:</strong>   <?php echo (isset($count) && $count ? ' ' . $count . '' : '');?>   предложений
                    <a href="/page/elitnoe-zhile">Определить условия поиска</a>
                </div>
                <div class="add-luxury-offers-list clearfix">
                
                				<?php $this->render('widgetApartments_list_item_elit', array('criteria' => $criteria)); ?>
                
               			 </div>
                         
                                 <?php if($pages):?>
        <div class="pagination">
		<?php
		$this->widget('itemPaginatorAtlas',
			array(
				'pages' => $pages,
				'header' => '',
				'selectedPageCssClass' => 'current',
				'htmlOptions' => array(
					'class' => '',
				),
				'htmlOption' => array('onClick' => 'reloadApartmentList(this.href); return false;'),
			)
		);
		?>
		</div>
    							<?php endif; ?>
                         
               		 </div>
             </div>
          </section>           
    
    
    
    
    
		<?php endif; ?>







<?php elseif ($_GET['objType']==7): ?>



		<?php if ($apCount):?>

	
    		        <!-- New building -->
        <section class="container-full" id="appartment_box">

        <div class="new-building">
            <div class="new-building-search-quantity">
                <strong>Всего найдено:</strong>   <?php echo (isset($count) && $count ? ' ' . $count . '' : '');?>   предложений
                <a href="/page/novostrojki">Определить условия поиска</a>
            </div>
            		<div class="new-building-object">
                		<div class="new-building-object-container">
                
                				<?php $this->render('widgetApartments_list_item_new', array('criteria' => $criteria)); ?>
                
               			 </div>
                         
                                 <?php if($pages):?>
        <div class="pagination">
		<?php
		$this->widget('itemPaginatorAtlas',
			array(
				'pages' => $pages,
				'header' => '',
				'selectedPageCssClass' => 'current',
				'htmlOptions' => array(
					'class' => '',
				),
				'htmlOption' => array('onClick' => 'reloadApartmentList(this.href); return false;'),
			)
		);
		?>
		</div>
    							<?php endif; ?>
                         
               		 </div>
             </div>
          </section>           
    
    
    
    
    
		<?php endif; ?>


<?php else: ?><!--Простые оъявления-->




	<?php if ($apCount):?>
    
   <!-- Вывод результатов поиска-->
  
          <!-- Results search -->
        <section class="container-full" id="appartment_box">
            <div class="results-search">
                <div class="results-quantity">
                    <span class="pull-left">Всего найдено по запросу: <?php echo (isset($count) && $count ? ' ' . $count . '' : '');?></span>
                     
                    	<?php if ($sorterLinks && $apCount):?>
							<div class="results-quantity-filter">
                             <span>Сортировать по:</span>
							<?php foreach ($sorterLinks as $link):?>
								<?php echo $link;?>
							<?php endforeach;?>
							</div>
						<?php endif;?>
                    
                    
                </div>
  
  
  
    
    
                    <table>
                    <tr>
                        <th>Объект / ID / фото</th>
                        <th>Адрес</th>
                        <th>Площадь</th>
                        <th>Стоимость (руб.)<br> и условия</th>
                        <th>Комиссия</th>
                        <th>Этаж</th>
                        <th>Телефон</th>
                        <th>Доп. сведения</th>
                        <th>Подробно</th>
                    </tr>
    
    
    
		<?php $this->render('widgetApartments_list_item', array('criteria' => $criteria)); ?>
        
        
        
        			</table>
        <?php if($pages):?>
        <div class="pagination">
		<?php
		$this->widget('itemPaginatorAtlas',
			array(
				'pages' => $pages,
				'header' => '',
				'selectedPageCssClass' => 'current',
				'htmlOptions' => array(
					'class' => '',
				),
				'htmlOption' => array('onClick' => 'reloadApartmentList(this.href); return false;'),
			)
		);
		?>
	</div>
    <?php endif; ?>

            </div>
        </section>
  
  
   <section class="similarhr-ads container-full">
            <h2>ПОХОЖИЕ ОБЪЯВЛЕНИЯ</h2>
          
          
          <?php
	if (issetModule('similarads') && param('useSliderSimilarAds') == 1) {
		Yii::import('application.modules.similarads.components.SimilarAdsWidget');
		$ads = new SimilarAdsWidget;
		$ads->viewSimilarAds($model);
	}
?>
          
          
          
          
        </section>
  
  <!--	!Вывод результатов поиска -->
        
        
		
	<?php endif; ?>


<?php if (!$apCount):?>
	<div class="empty"><?php echo Yii::t('module_apartments', 'Apartments list is empty.');?></div>
	<div class="clear"></div>
<?php endif;?>







<?php endif; ?> <!--!Простые оъявления-->