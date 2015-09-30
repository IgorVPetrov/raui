<?php


class MainController extends ModuleAdminController {
	public $defaultAction='admin';

	public function accessRules(){
		return array(
			array('allow',
				'expression'=> "Yii::app()->user->checkAccess('all_settings_admin')",
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionAdmin(){
		$this->render('modules');
	}

	public function actionManipulate($type, $module){
		if($type == 'enable'){
			ConfigurationModel::updateValue('module_enabled_'.$module, 1);
		} else {
			ConfigurationModel::updateValue('module_enabled_'.$module, 0);
		}
		$this->redirect(array('admin'));
	}

}
