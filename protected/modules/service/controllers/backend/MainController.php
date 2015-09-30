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

class MainController extends ModuleAdminController{
	public $modelName = 'Service';

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

	public function actionUpdate($id) {
		$this->redirect('admin');
	}

	public function actionDelete($id) {
		$this->redirect('admin');
	}

	public function actionCreate() {
		$this->redirect('admin');
	}

    public function actionAdmin(){
		$model = $this->loadModel(Service::SERVICE_ID);
		$this->performAjaxValidation($model);

		if(isset($_POST[$this->modelName])){
			$model->attributes=$_POST[$this->modelName];
			if($model->save()){
				Yii::app()->user->setFlash('success', tt('success_saved', 'service'));
			}
			else
				Yii::app()->user->setFlash('error', tt('failed_save_try_later', 'service'));
		}

		$this->render('update', array('model' => $model));
    }
}