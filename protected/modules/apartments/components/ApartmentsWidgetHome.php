<?php
	/* * ********************************************************************************************
	 *								Raui ORE
	
	 
	
	
	
	 *
	
	 *
	
	 *
	
	
	 *
	 * This file is part of Raui ORE
	 *
	 * ********************************************************************************************* */

class ApartmentsWidgetHome extends CWidget {
	public $usePagination = 1;
	public $criteria = null;
	public $count = null;
	public $showWidgetTitle = true;
	public $widgetTitle = null;
	public $breadcrumbs = null;

	public function getViewPath($checkTheme=true){
		if($checkTheme && ($theme=Yii::app()->getTheme())!==null){
			if (is_dir($theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'apartments'.DIRECTORY_SEPARATOR.'views'))
				return $theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'apartments'.DIRECTORY_SEPARATOR.'views';
		}
		return Yii::getPathOfAlias('application.modules.apartments.views');
	}

	public function run() {
		Yii::import('application.modules.apartments.helpers.apartmentsHelper');
		$result = apartmentsHelper::getApartments(12, 0, 0, $this->criteria);

		if (!$this->breadcrumbs) {
			$this->breadcrumbs=array(
				Yii::t('common', 'Apartment search'),
			);
		}

		if($this->count){
			$result['count'] = $this->count;
		}
		else {
			$result['count'] = $result['apCount'];
		}

		$this->render('widgetApartments_list_home', $result);
	}
}