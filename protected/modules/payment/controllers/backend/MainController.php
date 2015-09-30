<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class MainController extends ModuleAdminController {
	public $modelName = 'Payments';
	public $defaultAction='admin';

	public function accessRules(){
		return array(
			array('allow',
				'expression'=> "Yii::app()->user->checkAccess('payment_admin')",
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id){
		$this->redirect(array('admin'));
	}

    public function actionTest(){
        echo serialize(array('email'=>'', 'mode'=>Paysystem::MODE_REAL));
    }

    public function actionConfirm($id){
        $payment = Payments::model()->findByPk($id);

        if($payment){
			$payment->complete();
        }

		if(!Yii::app()->request->isAjaxRequest){
			$this->redirect(array('admin'));
		}
		Yii::app()->end();
    }
}
