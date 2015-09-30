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
	public $modelName = 'TranslateMessage';

	public function accessRules(){
		return array(
			array('allow',
				'expression'=> "Yii::app()->user->checkAccess('all_lang_and_currency_admin')",
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex(){
		$this->redirect(array('admin'));
	}

	public function actionView($id){
		$this->redirect(array('admin'));
	}

    public function actionAdmin(){

        $this->rememberPage();

        $model = new TranslateMessage('search');

        $model->setRememberScenario('translate_remember');

        $this->render('admin',array(
                'model'=>$model,
        ));
    }
}