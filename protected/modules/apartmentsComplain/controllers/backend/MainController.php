<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class MainController extends ModuleAdminController{
	public $modelName = 'ApartmentsComplain';

	public function accessRules(){
		return array(
			array('allow',
				'expression'=> "Yii::app()->user->checkAccess('apartmentsComplain_admin')",
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionAdmin() {
		$sql = 'UPDATE {{apartment_complain}} SET active = 1';
		Yii::app()->db->createCommand($sql)->execute();

		parent::actionAdmin();
	}
}
