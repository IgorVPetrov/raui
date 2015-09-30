<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class MainController extends ModuleUserController {
    public $layout='//layouts/usercpanel';

	public $modelName = 'Bookingtable';
	public $scenario = null;

	public function init() {
		// если админ - делаем редирект на просмотр в админку
		if(Yii::app()->user->checkAccess('backend_access')){
			$this->redirect($this->createAbsoluteUrl('/bookingtable/backend/main/admin'));
		}
		/*if (!param('useUserads')) {
			throw404();
		}*/
		parent::init();
	}

	public function accessRules(){
		return array(
			array(
				'allow',
				//'expression' => 'param("useUserads") && !Yii::app()->user->isGuest',
				'expression' => '!Yii::app()->user->isGuest',
			),
			array(
				'deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex() {
        $this->setActiveMenu('booking_applications');

		/*$sql = 'SELECT id FROM {{apartment}} WHERE owner_id = "'.Yii::app()->user->id.'" ';
		$apIds = Yii::app()->db->createCommand($sql)->queryColumn();

		$sql = 'UPDATE {{booking_table}} SET active = "'.Bookingtable::STATUS_VIEWED.'" WHERE active = "'.Bookingtable::STATUS_NEW.'" AND apartment_id IN ('.implode(',', $apIds).')';
		Yii::app()->db->createCommand($sql)->execute();
*/
		$model = new $this->modelName('search');

		Yii::app()->user->setState('searchUrl', NULL);

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET[$this->modelName])){
			$model->attributes = $_GET[$this->modelName];
		}

		if(Yii::app()->request->isAjaxRequest){
			$this->renderPartial('index',array(
				'model'=>$model,
			), false, true);
		} else {
			$this->render('index',array(
				'model'=>$model,
			));
		}
	}
}