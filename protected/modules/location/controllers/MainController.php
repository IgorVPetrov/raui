<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class MainController extends ModuleUserController{

	public function actionGetCities() {
		$region = Yii::app()->request->getQuery('region', 0);
		$type = Yii::app()->request->getQuery('type', 0);


		$cities = City::getCitiesArray($region, $type);
		foreach($cities as $value=>$name) {
			echo CHtml::tag('option',
					array('value'=>$value),CHtml::encode($name),true);
		}

	}

	public function actionGetRegions() {
		$country = Yii::app()->request->getQuery('country', 0);
		$type = Yii::app()->request->getQuery('type', 0);
		$all = Yii::app()->request->getQuery('all', 0);

		$regions=Region::getRegionsArray($country, $type, $all);
		foreach($regions as $value=>$name)
		{
			echo CHtml::tag('option',
				array('value'=>$value),CHtml::encode($name),true);
		}

	}
}