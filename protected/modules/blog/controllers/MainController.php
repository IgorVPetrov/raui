<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class MainController extends ModuleUserController{
	public $modelName = 'Blog';
	public $showSearchForm = false;

	public function actionIndex(){
		$blogPage = Menu::model()->findByPk(Menu::NEWS_ID);
		if ($blogPage) {
			if ($blogPage->active == 0) {
				throw404();
			}
		}

		$model = new $this->modelName;
		$result = $model->getAllWithPagination();

		$this->render('index', array(
			'items' => $result['items'],
			'pages' => $result['pages'],
		));
	}
}