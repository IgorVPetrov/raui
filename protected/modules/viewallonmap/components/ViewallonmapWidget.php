<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class ViewallonmapWidget extends CWidget {
	public $usePagination = 1;
	public $criteria = null;
	public $count = null;

	public $filterOn = true;

	public $withCluster = true;

	public $filterPriceType;
	public $filterObjType;
	
	public $roomsCount;

	public function run() {

		Yii::app()->getModule('apartments');

		$criteria = $this->criteria ? $this->criteria : new CDbCriteria;

		if($this->filterOn){
            Yii::app()->controller->aData['searchOnMap'] = true;
			$this->renderFilter($criteria);
		}

		if(param('useYandexMap', 1)) {
			echo $this->render('application.modules.apartments.views.backend._ymap', '', true);
			CustomYMap::init()->createMap();
		}
		elseif (param('useGoogleMap', 1)) {
			CustomGMap::createMap();
		}
		else {
			echo '<div id="osmap"></div>';
			CustomOSMap::createMap();
		}

		$lang = Yii::app()->language;
		$criteria->select = 'lat, lng, id, type, address_'.$lang.', title_'.$lang.', address_'.$lang;

		$ownerActiveCond = '';
		if (param('useUserads'))
			$ownerActiveCond = ' AND owner_active = '.Apartment::STATUS_ACTIVE.' ';
		$criteria->addCondition('lat <> "" AND lat <> "0" AND active='.Apartment::STATUS_ACTIVE.' AND deleted = 0 AND (owner_id=1 OR owner_id>1 '.$ownerActiveCond.')');
		$criteria->limit = '700';

		$apartments = Apartment::findAllWithCache($criteria);

		if(param('useYandexMap', 1)) {
			$lats = array();
			$lngs = array();
			foreach($apartments as $apartment){
				$lats[]	=	$apartment->lat;
				$lngs[]	=	$apartment->lng;
				CustomYMap::init()->addMarker(
					$apartment->lat, $apartment->lng,
					$this->render('application.modules.apartments.views.backend._marker', array('model' => $apartment), true),
					true, $apartment
				);
			}

			if($lats && $lngs){
				CustomYMap::init()->setBounds(min($lats),max($lats),min($lngs),max($lngs));
				if($this->withCluster){
					CustomYMap::init()->setClusterer();
				}else{
					CustomYMap::init()->withoutClusterer();
				}
			}
			else {
				$minLat = param('module_apartments_ymapsCenterX') - param('module_apartments_ymapsSpanX')/2;
				$maxLat = param('module_apartments_ymapsCenterX') + param('module_apartments_ymapsSpanX')/2;

				$minLng = param('module_apartments_ymapsCenterY') - param('module_apartments_ymapsSpanY')/2;
				$maxLng = param('module_apartments_ymapsCenterY') + param('module_apartments_ymapsSpanY')/2;

				CustomYMap::init()->setBounds($minLng,$maxLng,$minLat,$maxLat);
			}
			CustomYMap::init()->changeZoom(0, '+');
			CustomYMap::init()->processScripts(true);

		}
		elseif (param('useGoogleMap', 1)) {
		    foreach($apartments as $apartment){
				CustomGMap::addMarker($apartment,
					$this->render('application.modules.apartments.views.backend._marker', array('model' => $apartment), true)
				);
		    }
			if($this->withCluster){
				CustomGMap::clusterMarkers();
			}
			CustomGMap::setCenter();
			CustomGMap::render();
		}
		elseif (param('useOSMMap', 1)) {
			foreach($apartments as $apartment){
				CustomOSMap::init()->addMarker($apartment,
					$this->render('application.modules.apartments.views.backend._marker', array('model' => $apartment), true)
				);
			}
			if($this->withCluster){
				CustomOSMap::clusterMarkers();
			}
			CustomOSMap::setCenter();
			CustomOSMap::render();
		}
	}

	public function renderFilter(&$criteria){
		// start set filter
		$this->filterPriceType = Yii::app()->request->getParam('filterPriceType');
		if($this->filterPriceType){
			$criteria->addCondition('price_type = :filterPriceType');
			$criteria->params[':filterPriceType'] = $this->filterPriceType;
		}

		$this->filterObjType = Yii::app()->request->getParam('filterObjType');
		if ($this->filterObjType) {
			$criteria->addCondition('obj_type_id = :filterObjType');
			$criteria->params[':filterObjType'] = $this->filterObjType;
		}
		
		// Комнаты
		$this->roomsCount = $_GET['rooms'];
		if ($this->roomsCount) {
			$criteria->addCondition('num_of_rooms = :roomsCount');
			$criteria->params[':roomsCount'] = $this->roomsCount;
		}
		// !Комнаты
		
		
		
		// end set filter

		// echo filter form
		$data = SearchForm::apTypes();

		echo '<div class="block-filter-viewallonmap">';
			echo '<form method="GET" action="" id="form-filter-viewallonmap">';

			echo CHtml::dropDownList('filterPriceType',
				isset($this->filterPriceType) ? CHtml::encode($this->filterPriceType) : '',
				$data['propertyType']
			);

			echo CHtml::dropDownList('filterObjType',
				isset($this->filterObjType) ? CHtml::encode($this->filterObjType) : 0,
				CMap::mergeArray(array(0 => Yii::t('common', 'Please select')),
					Apartment::getObjTypesArray()
				)
			);
			
			// Комнаты
			$roomItems = array(
						'0' => Yii::t('common', 'Number of rooms'),
						'1' => 1,
						'2' => 2,
						'3' => 3,
						'4' => Yii::t('common', '4 and more'),
					);
			echo CHtml::dropDownList('rooms', isset($this->roomsCount) ? CHtml::encode($this->roomsCount) : 0, $roomItems, array('class' => $fieldClass . ' searchField'));
			// !Комнаты
			
			
			

			echo CHtml::button(tc('Filter'), array('onclick' => '$("#form-filter-viewallonmap").submit();',
				'id' => 'click-filter-viewallonmap',
				'class' => 'inline button-blue',
			));
			echo '</form>';
		echo '</div>';
	}
}