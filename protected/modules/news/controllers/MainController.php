<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class MainController extends ModuleUserController{
	public $modelName = 'News';
	public $showSearchForm = false;

	public function actionIndex(){
		$newsPage = Menu::model()->findByPk(Menu::NEWS_ID);
		if ($newsPage) {
			if ($newsPage->active == 0) {
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