<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class MainController extends ModuleAdminController{
	public $modelName = 'ReferenceValues';
	public $maxSorters = array();
	public $minSorters = array();

	public function accessRules(){
		return array(
			array('allow',
				'expression'=> "Yii::app()->user->checkAccess('all_reference_admin')",
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id){
		$this->redirect(array('admin'));
	}
	public function actionIndex(){
		$this->redirect(array('admin'));
	}

	public function actionAdmin(){
		$sql = 'SELECT reference_category_id, MAX(sorter) as sorter FROM {{apartment_reference_values}} GROUP BY reference_category_id';
		$sorters = Yii::app()->db->createCommand($sql)->queryAll();
		foreach($sorters as $sorter){
			$this->maxSorters[$sorter['reference_category_id']] = $sorter['sorter'];
		}

		$sql = 'SELECT reference_category_id, MIN(sorter) as sorter FROM {{apartment_reference_values}} GROUP BY reference_category_id';
		$sorters = Yii::app()->db->createCommand($sql)->queryAll();
		foreach($sorters as $sorter){
			$this->minSorters[$sorter['reference_category_id']] = $sorter['sorter'];
		}

		if(isset($_GET['ReferenceValues']['category_filter'])){
			$this->params['currentCategory'] = intval($_GET['ReferenceValues']['category_filter']);
		}
		else{
			$this->params['currentCategory'] = 0;
		}

		parent::actionAdmin();

	}

	public function getCategories($withoutEmpty = 0){
		$sql = 'SELECT id, title_'.Yii::app()->language.' as lang FROM {{apartment_reference_categories}} ORDER BY sorter ASC';
		$categories = Yii::app()->db->createCommand($sql)->queryAll();

		if(!$withoutEmpty)
			$return[0] = '';
		foreach($categories as $category){
			$return[$category['id']] = $category['lang'];
		}
		return $return;
	}

}
