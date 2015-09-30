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

class MainController extends ModuleUserController{
	public function init() {
		parent::init();

		$specialOfferPage = Menu::model()->findByPk(Menu::SPECIALOFFERS_ID);
		if ($specialOfferPage) {
			if ($specialOfferPage->active == 0) {
				throw404();
			}
		}
	}

	public function actionIndex(){
        Yii::app()->user->setState('searchUrl', NULL);

		Yii::app()->getModule('apartments');

		$criteria = new CDbCriteria;
		$criteria->condition = 'is_special_offer = 1';

        if(Yii::app()->request->isAjaxRequest){
            $this->renderPartial('index', array(
                'criteria' => $criteria,
            ), false, true);
        }else{
            $this->render('index', array(
                'criteria' => $criteria,
            ));
        }
	}
}