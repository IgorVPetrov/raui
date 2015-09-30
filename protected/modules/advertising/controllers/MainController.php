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

class MainController extends CController {

	/*public function init(){
		if (!Yii::app()->request->isAjaxRequest)
			return false;

		setLang();
		parent::init();
	}*/

	public function actionBannerActivate() {
		if (!Yii::app()->request->isAjaxRequest)
			return false;

		$id = (int) Yii::app()->request->getParam('id');

		if ($id) {
			Advert::model()->updateCounters(
				array('clicks'=>1),
				"id = :id",
				array(':id' => $id)
			);
		}
	}
}