<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/jcarousel.ajax.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jcarousel.ajax.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.jcarousel.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/easyResponsiveTabs.js', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('generate-phone', '
	function generatePhone(){
		$("span#owner-phone").html(\'<img src="'.Yii::app()->controller->createUrl('/apartments/main/generatephone', array('id' => $model->id)).'" />\');
		$(".phone-show-alert").show();
	}
', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('initizlize-easy-responsive-tabs', "
	$('.resptabscont').easyResponsiveTabs();
", CClientScript::POS_READY);

Yii::app()->clientScript->registerScript('reInitMap', '
	var useYandexMap = '.param('useYandexMap', 1).';
	var useGoogleMap = '.param('useGoogleMap', 1).';
	var useOSMap = '.param('useOSMMap', 1).';

	function reInitMap(elem) {
		// place code to end of queue
		if(useGoogleMap){
			setTimeout(function(){
				var tmpGmapCenter = mapGMap.getCenter();

				google.maps.event.trigger($("#googleMap")[0], "resize");
				mapGMap.setCenter(tmpGmapCenter);

				if (($("#gmap-panorama").length > 0)) {
					initializeGmapPanorama();
				}
			}, 0);
		}

		if(useYandexMap){
			setTimeout(function(){
				ymaps.ready(function () {
					globalYMap.container.fitToViewport();
					globalYMap.setCenter(globalYMap.getCenter());
				});
			}, 0);
		}

		if(useOSMap){
			setTimeout(function(){
				L.Util.requestAnimFrame(mapOSMap.invalidateSize,mapOSMap,!1,mapOSMap._container);
			}, 0);
		}
	}
', CClientScript::POS_END);

$model->references = $model->getFullInformation($model->id, $model->type);
?>





</div>
<?php $owner = $model->user; ?>
<section class="container-full">
        <!-- Modal object -->
        
        
        
        
        <!--Карточка объекта-->
        <div class="card-object">
        
        
        	<div class="modal-header">
            <?php

			if($searchUrl){
				echo CHtml::link(tc('Go back to search results'), $searchUrl).' или ';
			} elseif (stripos(Yii::app()->request->urlReferrer, Yii::app()->getBaseUrl(true)) !== false)
				echo CHtml::link(tc('Go back to search results'), '#', array('onclick'=>'window.history.back(); return false;')).' или ';

		?>
                <a href="">Начать новый поиск</a>
                <ul class="pull-right">
                    <li><a href=""></a></li>
                    <li><a href=""></a></li>
                    
                </ul>
            </div>
            
            
            <div class="carousel slide" id="slider-object">
                    <div class="carousel-inner">
                    
             
             
			 
			 <?php if (isset($model->images) && count($model->images)):?>
			
					<?php
						if ($model->images) {
							$this->widget('application.modules.images.components.ImagesWidget', array(
								'images' => $model->images,
								'objectId' => $model->id,
							));
						}
					?>
				
		<?php else: ?>
			<img src="http://raui.sait.dp.ua/uploads/no_photo_img_text.jpg" alt="">
		<?php endif;?>
                    
                    
                        
                        
                    </div>
                </div>
                
                
                
                
                <div class="rows">
                
      <!--Левый блок -->          
  <div class="col-md-8">
 
                         <div class="hidden-phone clearfix" id="slider-thumbs">
                  <?php if (isset($model->images) && count($model->images)):?>
			
					<?php
						if ($model->images) {
							$this->widget('application.modules.images.components.ImagesWidgetTumb', array(
								'images' => $model->images,
								'objectId' => $model->id,
							));
						}
					?>
				
					<?php endif;?>
                        </div>
                        
                        
                        <div class="description-text">
                           
                           
                           <div class="b_item_aux">
	<div class="b_item_aux__tabs">
		<?php
		$firstTabsItems = array();

		$generalContent = $this->renderPartial('//modules/apartments/views/_tab_general', array(
			'data' => $model,
		), true);

		if($generalContent){
			$firstTabsItems[tc('General')] = array(
				'content' => $generalContent,
				'id' => 'tabs1_1',
				'active' => false,
			);
		}

		if(!param('useBootstrap')){
			Yii::app()->clientScript->scriptMap=array(
				'jquery-ui.css' => false,
			);
		}

		if(issetModule('bookingcalendar') && $model->type == Apartment::TYPE_RENT){
			Bookingcalendar::publishAssets();

			$firstTabsItems[tt('The periods of booking apartment', 'bookingcalendar')] = array(
				'content' => $this->renderPartial('//modules/bookingcalendar/views/calendar', array('apartment'=>$model), true),
				'id' => 'tabs1_2',
				'active' => false,
			);
		}

		$additionFields = HFormEditor::getExtendedFields();
		$existValue = HFormEditor::existValueInRows($additionFields, $model);

		if($existValue){
			$firstTabsItems[tc('Additional info')] = array(
				'content' => $this->renderPartial('//modules/apartments/views/_tab_addition', array(
						'data'=>$model,
						'additionFields' =>$additionFields
					), true),
				'id' => 'tab_3',
				'active' => false,
			);
		}

		if(param('enableCommentsForApartments', 1)){
			if(!isset($comment)){
				$comment = null;
			}

			$firstTabsItems[Yii::t('module_comments','Comments').' ('.Comment::countForModel('Apartment', $model->id).')'] = array(
				'content' => $this->renderPartial('//modules/apartments/views/_tab_comments', array(
						'model' => $model,
					), true),
				'id' => 'tabs1_4',
				'active' => false,
			);
		}
		?>

		<?php if (count($firstTabsItems) > 0):?>
			<?php
				// выставляем открытым первый таб
				$total = count($firstTabsItems);
				if ($firstTabsItems > 1) {
					$counter = 0;
					foreach($firstTabsItems as $key => $tab) {
						$counter++;
						if ($counter == 1)
							$firstTabsItems[$key]['active'] = true;
					}
				}
				else {
					$firstTabsItems[0]['active'] = true;
				}
			?>



			<div class="tabs_1 resptabscont" id="firsttabs">
				<ul class="nav nav-tabs">
					<?php foreach($firstTabsItems as $title => $vals):?>
						<li role="presentation" <?php echo ($vals['active']) ? 'class="active"' : '';?>>
							
                            <a href="#<?php echo $vals['id'];?>" aria-controls="<?php echo $vals['id'];?>" data-toggle="tab"><?php echo $title;?></a>
						</li>
					<?php endforeach;?>
				</ul>
				
                

				<div class="tab-content">
					<?php foreach($firstTabsItems as $title => $vals):?>
						<div role="tabpanel" id="<?php echo $vals['id'];?>" class="tab-pane <?php echo ($vals['active']) ? 'active' : '';?>" >
							<?php echo $vals['content'];?>
						</div>
					<?php endforeach;?>
				</div>
                
                
			</div>
		<?php endif;?>

		<?php
		$secondTabsItems = array();

		if ($model->type != Apartment::TYPE_BUY && $model->type != Apartment::TYPE_RENTING) {
			if($model->lat && $model->lng){
				if(param('useGoogleMap', 1) || param('useYandexMap', 1) || param('useOSMMap', 1)){
					$secondTabsItems[tc('Map')] = array(
						'content' => $this->renderPartial('//modules/apartments/views/_tab_map', array('data' => $model), true),
					//	'content' => ' <div class="description-map"><img src="/themes/atlas/temp/images/demo/map-obj.png" alt=""/></div>',
						'id' => 'tab2_1',
						'active' => false,
						'onClick' => 'reInitMap();',
					);
				}
			}
		}

		if ($model->panorama){
			$secondTabsItems[tc('Panorama')] = array(
				'content' => $this->renderPartial('//modules/apartments/views/_tab_panorama', array( 'data'=>$model), true),
				'id' => 'tab2_2',
				'active' => false,
			);
		}

		if (isset($model->video) && $model->video){
			$secondTabsItems[tc('Videos for listing')] = array(
				'content' => $this->renderPartial('//modules/apartments/views/_tab_video', array( 'data'=>$model), true),
				'id' => 'tab2_3',
				'active' => false,
			);
		}


		?>

		<?php if (count($secondTabsItems) > 0):?>
			<?php
			// выставляем открытым первый таб
			$total = count($secondTabsItems);
			if ($secondTabsItems > 1) {
				$counter = 0;
				foreach($secondTabsItems as $key => $tab) {
					$counter++;
					if ($counter == 1)
						$secondTabsItems[$key]['active'] = true;
				}
			}
			else {
				$secondTabsItems[0]['active'] = true;
			}
			?>

			<div class="tabs_2 resptabscont" id="secondtabs">
				<ul class="nav nav-tabs" role="tablist">
					<?php foreach($secondTabsItems as $title => $vals):?>
						<li role="presentation" class="<?php echo ($vals['active']) ? 'active' : '';?>">
                       <a href="#<?php echo $vals['id'];?>" aria-controls="<?php echo $vals['id'];?>" data-toggle="tab"><?php echo $title;?></a>     
						</li>
					<?php endforeach;?>
				</ul>
				

				<div class="tab-content">
					<?php foreach($secondTabsItems as $title => $vals):?>
						<div id="<?php echo $vals['id'];?>" class="tab-pane <?php echo ($vals['active']) ? 'active' : '';?>">
							<?php echo $vals['content'];?>
						</div>
					<?php endforeach;?>
				</div>
			</div>
		<?php endif;?>
	</div>
                           
                            
                        </div>
                       
                    </div>
  
  
  
  
  
  
  </div>
   <!--!Левый блок-->
  
  <div class="col-md-4 infoblock">
  
  
  	<div class="priceblock">
  	<div class="price">
			<?php if ($model->is_price_poa){

				echo tt('is_price_poa', 'apartments');}
			else {

				echo $model->ObjgetPrettyPrice(); }
			?>
	</div>
    
    <div class="name">
			<?php
				echo Apartment::getNameByType($model->type).',&nbsp;';
				echo utf8_ucfirst($model->objType->name);
				if ($model->num_of_rooms){
					echo ',&nbsp;';
					echo Yii::t('module_apartments',
						'{n} bedroom|{n} bedrooms|{n} bedrooms', array($model->num_of_rooms));
				}
				if (issetModule('location') && param('useLocation', 1)) {
					echo ' ';
					if($model->locCountry || $model->locRegion || $model->locCity)
						echo " ";

					if($model->locCountry){
						echo $model->locCountry->getStrByLang('name');
					}
					if($model->locRegion){
						if($model->locCountry)
							echo ',&nbsp;';
						echo $model->locRegion->getStrByLang('name');
					}
					if($model->locCity){
						if($model->locCountry || $model->locRegion)
							echo ',&nbsp;';
						echo $model->locCity->getStrByLang('name');
					}
				} else {
					if(isset($model->city) && isset($model->city->name)){
						echo ',&nbsp;';
						echo $model->city->name;
					}
				}
			?>
	</div>
    
    </div>
    <div class="infob">
    
    <div class="statistik">
    <?php if (isset($statistics) && is_array($statistics)) : ?>
			<?php echo tt('views_all') . ': ' . $statistics['all'] ?><br/><?php echo tt('views_today') . ': ' . $statistics['today'];?><br/>
			<?php echo tc('Date created') . ': <nobr>' . $model->getDateTimeInFormat('date_created').'</nobr>'; ?>
	<?php endif; ?>
    </div>
    
    <div class="useradblock clearfix">
    
    
    <div class="intext">Опубликовал: </div><div class="ininfo"><?php echo $owner->getNameForType();?> <?php echo $owner->getLinkToAllListings(); ?></div>
    <div class="intext">Телефон: </div><div class="ininfo"><?php
						if($model->canShowInView('phone')) {
							if (issetModule('tariffPlans') && issetModule('paidservices') && ($model->owner_id != Yii::app()->user->id)) {
								if (Yii::app()->user->isGuest) {
									$defaultTariffInfo = TariffPlans::getFullTariffInfoById(TariffPlans::DEFAULT_TARIFF_PLAN_ID);

									if (!$defaultTariffInfo['showPhones']) {
										echo ''.Yii::t('module_tariffPlans', 'Please <a href="{n}">login</a> to view', Yii::app()->controller->createUrl('/site/login')).'';
									}
									else {
										echo '<span id="owner-phone">' . CHtml::link(tc('Show phone'), 'javascript: void(0);', array('onclick' => 'generatePhone();')) . '</span>' . '';
									}
								}
								else {
									if (TariffPlans::checkAllowShowPhone())
										echo '<span id="owner-phone">' . CHtml::link(tc('Show phone'), 'javascript: void(0);', array('onclick' => 'generatePhone();')) . '</span>' . '';
									else
										echo ''.Yii::t('module_tariffPlans', 'Please <a href="{n}">change the tariff plan</a> to view', Yii::app()->controller->createUrl('/tariffPlans/main/index')).'';
								}
							}
							else {
								echo '<span id="owner-phone">' . CHtml::link(tc('Show phone'), 'javascript: void(0);', array('onclick' => 'generatePhone();')) . '</span>' . '';
							}
						}
					?></div>
    
    
    
    </div>
    
    <div class="sendmess">
    
    					<?php
						if (issetModule('messages') && $model->owner_id != Yii::app()->user->id && !Yii::app()->user->isGuest){
							echo '' . CHtml::link(tt('Send message', 'messages'), Yii::app()->createUrl('/messages/main/read', array('id' => $owner->id, 'apId' => $model->id))) . '';
						}
						elseif (param('use_module_request_property') && $model->owner_id != Yii::app()->user->id){
							echo '' . CHtml::link(tt('request_for_property'), $model->getUrlSendEmail(), array('class'=>'fancy')) . '';
						}
					?>
    
    
    </div>
    <div class="chaloba">
    
    
    
    <?php if(issetModule('apartmentsComplain')):?>
					<?php if(($model->owner_id != Yii::app()->user->getId())):?>
						<?php echo CHtml::link(tt('do_complain', 'apartmentsComplain'), $this->createUrl('/apartmentsComplain/main/complain', array('id' => $model->id)), array('class' => 'fancy')); ?>
					<?php endif; ?>
				<?php endif; ?>
    
    
    
    </div>
    </div>
    
    
    <div class="yadirect clearfix">

                    <?php if(issetModule('advertising')) :?>
						<?php $this->renderPartial('//modules/advertising/views/advert-top', array());?>
					<?php endif; ?>

    </div>
    
    <div class="similar clearfix">
    
    <?php
	if (issetModule('similarads') && param('useSliderSimilarAds') == 1) {
		Yii::import('application.modules.similarads.components.SimilarAdsWidget');
		$ads = new SimilarAdsWidget;
		$ads->viewSimilarAds($model);
	}
?>
    
    </div>
  
  
  
  
  
  </div>
  
  
				</div>
                
                
                
                
                
                <div class="text-center clearfix">
                    <?php if(issetModule('advertising')) :?>
						<?php $this->renderPartial('//modules/advertising/views/advert-bottom', array());?>
					<?php endif; ?>
                </div>
        
        
        
        </div>
        <!--!Карточка объекта-->
        
        
        
        
        </section>