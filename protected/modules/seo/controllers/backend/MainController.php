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
	public $modelName = 'Seo';

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
        $model = new $this->modelName('search');
        $model->resetScope();
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET[$this->modelName])){
            $model->attributes = $_GET[$this->modelName];
        }

        $this->render('admin', array('model'=>$model));
    }

	public function actionUpdate($id) {
		$this->redirectTo = array('admin');
		parent::actionUpdate($id);
	}

    public function actionRegenSeo(){

        $modelsAll = SeoFriendlyUrl::model()->findAll();
        $activeLangs = Lang::getActiveLangs();

        foreach($modelsAll as $model){
            foreach($activeLangs as $lang){
                $field = 'url_' . $lang;
                $model->$field = translit($model->$field);
            }

            $model->save();
        }

        echo 'end';
    }
}