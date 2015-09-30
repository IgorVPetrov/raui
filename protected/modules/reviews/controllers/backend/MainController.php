<?php


class MainController extends ModuleAdminController{
	public $modelName = 'Reviews';
	public $redirectTo = array('admin');

	public function accessRules(){
		return array(
			array('allow',
				'expression'=> "Yii::app()->user->checkAccess('reviews_admin')",
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id){
		$this->render('view',array(
			'model'=>$this->loadModel($id)
		));
	}

	public function actionAdmin(){
		$this->getMaxSorter();
		$this->getMinSorter();
		parent::actionAdmin();
	}

	public function actionCreate(){
		Yii::app()->user->setState('menu_active', 'reviews.create');
		parent::actionCreate();
	}
}