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

class SimilarAds extends CActiveRecord {

	public $similarAdsModulePath;
	public $assetsPath;

	public function init() {
		$this->preparePaths();
		//$this->publishAssets();
	}

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{apartment}}';
	}

	public function preparePaths() {
		$this->similarAdsModulePath = dirname(__FILE__) . '/../';
		$this->assetsPath = $this->similarAdsModulePath . '/assets';
	}

	public function publishAssets() {
		$this->assetsPath = Yii::getPathOfAlias('webroot.themes.'.Yii::app()->theme->name . '.views.modules.similarads.assets');

		if (is_dir($this->assetsPath)) {
			$baseUrl = Yii::app()->assetManager->publish($this->assetsPath);

			if (Yii::app()->theme->name == 'atlas') {
				Yii::app()->clientScript->registerCssFile($baseUrl . '/similarads.css');

				Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/owl-carousel/owl.carousel.js');
				Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/owl-carousel/owl.carousel.css');
				Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/owl-carousel/owl.theme.css');
			}
			else {
				Yii::app()->clientScript->registerCssFile($baseUrl . '/similarads.css');

				Yii::app()->clientScript->registerCssFile($baseUrl . '/jcarousel/skins/tango/skin.css');
				Yii::app()->clientScript->registerScriptFile($baseUrl . '/jcarousel/lib/jquery.jcarousel.min.js', CClientScript::POS_END);
			}
		}
	}

	public function getSimilarAds($inCriteria = null){
		if($inCriteria === null){
			$criteria = new CDbCriteria;
			$criteria->addCondition('active = '.Apartment::STATUS_ACTIVE);
			if (param('useUserads'))
				$criteria->addCondition('owner_active = '.Apartment::STATUS_ACTIVE);
			$criteria->order = $this->getTableAlias().'.id ASC';
		} else {
			$criteria = $inCriteria;
		}

		Yii::import('application.modules.apartments.helpers.apartmentsHelper');

		$similarAds = array();
		$similarAds['apartments'] = Apartment::model()
			->cache(param('cachingTime', 1209600), Apartment::getImagesDependency())
			->with(array('images'))
			->findAll($criteria);

		return (is_array($similarAds['apartments']) && count($similarAds['apartments'])) ? $similarAds['apartments'] : '';
	}
}