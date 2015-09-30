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
	public $modelName = 'PaidServices';

	public function accessRules(){
		return array(
			array('allow',
				'expression'=> "Yii::app()->user->checkAccess('paidservices_admin')",
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

    public function actionAdmin(){

		$dataProvider=new CActiveDataProvider(PaidServices::model()->with('options'));

		$this->render('admin', array(
			'dataProvider' => $dataProvider
		));
    }

    public function actionView($id){
        $this->redirect('admin');
    }

	public function actionCreate() {
		$model = new PaidOptions();

		$this->performAjaxValidation($model);

		if(isset($_POST['PaidOptions'])){
			$model->attributes=$_POST['PaidOptions'];
			if($model->save()){
				$this->redirect(array('admin'));
			}
		}

		$this->render('create_option', array('model' => $model));
	}

	public function actionUpdateOption($id) {
		$model = PaidOptions::model()->findByPk($id);
		if(!$model){
			throw404();
		}

		$this->performAjaxValidation($model);

		if(isset($_POST['PaidOptions'])){
			$model->attributes=$_POST['PaidOptions'];
			if($model->save()){
				$this->redirect(array('admin'));
			}
		}

		$this->render('update_option', array('model' => $model));
	}

	public function actionDeleteOption($id) {
		$model = PaidOptions::model()->findByPk($id);
		if(!$model){
			throw404();
		}
		$model->delete();

		$this->redirect(array('admin'));
	}


	public function actionAddPaid($id = 0, $withDate = 0){
		$model = new AddToAdForm();

		$paidServices = PaidServices::model()->findAll('id != '.PaidServices::ID_ADD_FUNDS);
		$paidServicesArray = CHtml::listData($paidServices, 'id', 'name');

		$request = Yii::app()->request;
		$data = $request->getPost('AddToAdForm');

		if($data){
			$apartmentId = $request->getPost('ad_id');
			$withDate = $request->getPost('withDate');

			$model->attributes = $data;
			if($model->validate()){
				$apartment = Apartment::model()->findByPk($apartmentId);
				$paidService = PaidServices::model()->findByPk($model->paid_id);

				if(!$paidService || !$apartment){
					throw new CException('Not valid data');
				}
				if(PaidServices::applyToApartment($apartmentId, $paidService->id, $model->date_end)){
					echo CJSON::encode(array(
						'status' => 'ok',
						'apartmentId' => $apartmentId,
						'html' => $apartment->getPaidHtml($withDate, true)
					));
					Yii::app()->end();
				}
			} else {
				echo CJSON::encode(array(
					'status' => 'err',
					'html' => $this->renderPartial('_add_to_form', array(
						'id' => $apartmentId,
						'model' => $model,
						'withDate' => $withDate,
						'paidServicesArray' => $paidServicesArray
					), true)
				));
				Yii::app()->end();
			}
		}

		$renderData = array(
			'id' => $id,
			'model' => $model,
			'withDate' => $withDate,
			'paidServicesArray' => $paidServicesArray
		);

		if(Yii::app()->request->isAjaxRequest){
			$this->renderPartial('_add_to_ad', $renderData);
		}else{
			$this->render('_add_to_ad', $renderData);
		}
	}

}
