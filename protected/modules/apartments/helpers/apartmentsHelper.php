<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class apartmentsHelper {
	public static function getApartments($limit = 10, $usePagination = 1, $all = 1, $criteria = null){
		$pages = array();

		Yii::app()->getModule('apartments');

		if($criteria === null){
			$criteria = new CDbCriteria;
		}
		if(!$all){
			$criteria->addCondition('t.deleted = 0');
			$criteria->addCondition('t.active = '.Apartment::STATUS_ACTIVE);
			if (param('useUserads'))
				$criteria->addCondition('owner_active = '.Apartment::STATUS_ACTIVE);
		}

		$sort = new CSort('Apartment');
		$sort->attributes = array(
			'price' => 'price',
			'date_created' => 'date_created',
		);
		if(!$criteria->order){
			$sort->defaultOrder = 't.date_up_search DESC, t.sorter DESC';
		}
		$sort->applyOrder($criteria);

		$sorterLinks = self::getSorterLinks($sort);
		$criteria->addCondition('t.owner_id = 1 OR t.owner_active = 1');

		$criteria->addInCondition('t.type', Apartment::availableApTypesIds());
		$criteria->addInCondition('t.price_type', array_keys(Apartment::getPriceArray(Apartment::PRICE_SALE, true)));

		// find count
		$apCount = Apartment::model()->count($criteria);

		if($usePagination){
			$pages = new CPagination($apCount);
			$pages->pageSize = $limit;
			$pages->applyLimit($criteria);
		}
		else{
			$criteria->limit = $limit;
		}

        if(issetModule('seo')){
            $criteria->with = array('seo');
        }

//		$apartments = Apartment::model()
//			->cache(param('cachingTime', 1209600), Apartment::getImagesDependency())
//			->with(array('images'))
//			->findAll($criteria);
		return array(
			'pages' => $pages,
			//'apartments' => $apartments,
			'sorterLinks' => $sorterLinks,
			'apCount' => $apCount,
			'criteria' => $criteria
		);
	}

	public static function getSorterLinks($sort){
        $HtmlOption = array('onClick'=>'reloadApartmentList(this.href); return false;');
		$return = array(
			$sort->link('date_created', 'Новизне', $HtmlOption),
			$sort->link('', '/', ''),
			$sort->link('price', 'Стоимости', $HtmlOption),
		);
		return $return;
	}
}
