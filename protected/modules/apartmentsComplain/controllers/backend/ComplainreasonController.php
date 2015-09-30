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

class ComplainreasonController extends ModuleAdminController{
	public $modelName = 'ApartmentsComplainReason';
	public $redirectTo = array('admin');

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

	public function getViewPath($checkTheme=true){
		if($checkTheme && ($theme=Yii::app()->getTheme())!==null){
			if (is_dir($theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.$this->getModule($this->id)->getName().DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'backend'.DIRECTORY_SEPARATOR.'reason'))
				return $theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.$this->getModule($this->id)->getName().DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'backend'.DIRECTORY_SEPARATOR.'reason';
		}
		return Yii::getPathOfAlias('application.modules.'.$this->getModule($this->id)->getName().'.views.backend.reason');
	}

	public function actionAdmin() {
		$this->getMaxSorter();
		$this->getMinSorter();

		parent::actionAdmin();
	}

	public function actionView($id) {
		$this->redirect($this->redirectTo);
	}
}
