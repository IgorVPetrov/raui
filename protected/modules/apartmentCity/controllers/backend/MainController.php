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
	public $modelName = 'ApartmentCity';

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
		$this->getMaxSorter();
		$this->getMinSorter();

		parent::actionAdmin();
	}

    public function actionDelete($id){

        // Не дадим удалить последний город
        if(ApartmentCity::model()->count() <= 1){
            if(!isset($_GET['ajax'])){
                Yii::app()->user->setFlash('error', tt('You can not delete the last city'));
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }else{
                echo "<div class='flash-error'>".tt('You can not delete the last city')."</div>";
            }
            Yii::app()->end();
        }

        parent::actionDelete($id);
    }
}
