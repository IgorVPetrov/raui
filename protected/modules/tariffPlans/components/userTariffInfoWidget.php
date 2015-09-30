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

class userTariffInfoWidget extends CWidget {
	public $userId;
	public $showChangeTariffLnk = true;

	public function getViewPath($checkTheme=true){
		if($checkTheme && ($theme=Yii::app()->getTheme())!==null){
			if (is_dir($theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'tariffPlans'.DIRECTORY_SEPARATOR.'views'))
				return $theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'tariffPlans'.DIRECTORY_SEPARATOR.'views';
		}
		return Yii::getPathOfAlias('application.modules.tariffPlans.views');
	}

	public function run() {
		if (!$this->userId)
			$this->userId = Yii::app()->user->id;

		$info = TariffPlans::getTariffInfoByUserId($this->userId);

		$this->render('userTariffInfoViewWidget', array(
				'id' => $info['id'],
				'name' => $info['name'],
				'description' => $info['description'],
				'limitObjects' => $info['limitObjects'],
				'limitPhotos' => $info['limitPhotos'],
				'price' => $info['price'],
				'duration' => $info['duration'],
				'showAddress' => $info['showAddress'],
				'showPhones' => $info['showPhones'],
				'currency' => Currency::getDefaultCurrencyModel()->name,
				'userCountObjects' => TariffPlans::getCountUserObjects($this->userId),
				'tariffDateStart' => $info['tariffDateStart'],
				'tariffDateEnd' => $info['tariffDateEnd'],
				'tariffStatus' => $info['tariffStatus'],
				'tariffDateStartFormat' => $info['tariffDateStartFormat'],
				'tariffDateEndFormat' => $info['tariffDateEndFormat'],
				'isDefaultTariffPlan' => ($info['id'] == TariffPlans::DEFAULT_TARIFF_PLAN_ID) ? true : false,
			)
		);
	}
}
?>