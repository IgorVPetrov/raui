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
	public $modelName = 'Currency';

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

	public function actionAdmin(){
		Yii::app()->user->setFlash('warning', Yii::t('module_currency','moduleAdminHelp',
				array('{link}'=>CHtml::link(tc('Languages'), array('/lang/backend/main/admin'))))
		);

		parent::actionAdmin();
	}

    public function actionIndex(){
        Currency::model()->parseCbr();

        deb('ok');
    }

    public function actionSetDefault(){
        $id = (int) Yii::app()->request->getPost('id');

        $model = Currency::model()->findByPk($id);
        $model->convert_data = (int) Yii::app()->request->getPost('convert_data');
		$model->parseCbr();
        $model->setDefault();
		$model->parseCbr();
        Yii::app()->end();
    }

    public function actionActivate(){
        $id = (int) $_GET['id'];
        $action = $_GET['action'];
        if($id){
            $model = Currency::model()->findByPk($id);
            if($model->is_default == 1 && $action != 'activate'){
                Yii::app()->end();
            }
        }
        parent::actionActivate();
    }

    public function actionCreate(){
        $model = new Currency();
        $translate = new TranslateMessage();

        if(isset($_POST['Currency'])){
            $model->attributes = $_POST['Currency'];

            if($model->validate()){
                $translate->attributes = $_POST['TranslateMessage'];
                $translate->category = 'module_currency';
                $translate->message = $model->char_code."_translate";
                if($translate->save()){
                    $model->save();
                    Yii::app()->cache->flush();
                    Yii::app()->user->setFlash('success', tc('Success'));
                    $this->redirect(Yii::app()->createUrl('/currency/backend/main/admin'));
                }
            }
        }

        $this->render('create', array('model' => $model, 'translate' => $translate));
    }


    public function actionUpdate($id){
        $model = $this->loadModel($id);

        //$model->scenario = 'advanced';
        $this->performAjaxValidation($model);
        $translate = $model->getTranslateModel();

        if(isset($_POST[$this->modelName])){
            $model->attributes=$_POST[$this->modelName];
            if($model->validate()){
                $translate->attributes = $_POST['TranslateMessage'];
                if($translate->save()){
                    if($model->save(false)){
                        Yii::app()->user->setFlash('success', tc('Success'));
                        $this->redirect(Yii::app()->createUrl('/currency/backend/main/admin'));
                    }
                }
            }
        }

        $this->render('update', array(
            'model'=>$model,
            'translate' => $translate,
        ));
    }

    public function actionDelete($id){
        if(Yii::app()->request->isPostRequest){
            $model = $this->loadModel($id);

            if($model->active || $model->is_default){
                throw new CHttpException(400,tt('You can not delete an active currency!'));
            }

            // we only allow deletion via POST request
            $model->delete();
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    public function actionView($id){
        $this->redirect(array('admin'));
    }
}
