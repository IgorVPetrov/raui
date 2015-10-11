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



<?php if ($apCount):?>

	
                
                				<?php $this->render('widgetApartments_list_map', array('criteria' => $criteria)); ?>
                
               			
    
    
    
    
		<?php endif; ?>
