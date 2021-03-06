<?php

class MainController extends ModuleAdminController {
	public $modelName = 'ConfigurationModel';
	public $defaultAction='admin';

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

	public function actionView($id){
		$this->redirect(array('admin'));
	}

	public function actionAdmin(){
		$model = new ConfigurationModel('search');

		if(isset($_GET[$this->modelName])){
			$model->attributes=$_GET[$this->modelName];
		}

		$this->render('admin',array(
				'model'=>$model,
				'currentSection' => Yii::app()->request->getQuery('section_filter', 'main'),
		));
	}

	public function actionUpdate($id, $ajax = 0){
		$model = $this->loadModel($id);

		if($ajax){
			$this->excludeJs();

			$this->renderPartial('update', array(
				'model' => $model,
				'ajax' => $ajax,
			), false, true);
		}else{
			$this->render('update', array(
				'model' => $model,
				'ajax' => $ajax,
			));
		}
	}

	public function actionUpdateAjax(){
		$id = Yii::app()->request->getPost('id');
		$val = Yii::app()->request->getPost('val', '');

		if(!$id){
			Yii::app()->user->setFlash('error', tt('Enter the required value'));
			echo 'error_save';
			Yii::app()->end();
		}

		$model = ConfigurationModel::model()->findByPk($id);

		if(!$val && $val!=='0' && !$model->allowEmpty) {
			Yii::app()->user->setFlash('error', tt('Enter the required value'));
			echo 'error_save';
			Yii::app()->end();
		}

		$model->value = $val;

		if($model->save()){
			// delete assets js cache
			ConfigurationModel::clearGenerateJSAssets();

			echo 'ok';
		} else {
			Yii::app()->user->setFlash('error', tt('Enter the required value'));
			echo 'error_save';
		}
	}

	public function actionActivate(){
		$id = intval(Yii::app()->request->getQuery('id', 0));

		if($id){
			$action = Yii::app()->request->getQuery('action');
			$model = $this->loadModel($id);

			if($model){
				if (
					$model->name == 'useTypeRentHour' || $model->name== 'useTypeRentDay' || $model->name== 'useTypeRentWeek' || $model->name== 'useTypeRentMonth' ||
					$model->name == 'useTypeSale' || $model->name == 'useTypeRenting' || $model->name == 'useTypeBuy' || $model->name == 'useTypeChange'
				) {
					if (count(Apartment::availableApTypesIds()) == 1 && $action == 'deactivate') {
						if(!Yii::app()->request->isAjaxRequest){
							$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
						}
						Yii::app()->end;
					}
				}

				// delete assets js cache
				ConfigurationModel::clearGenerateJSAssets();

				$model->value = ($action == 'activate' ? 1 : 0);
				$model->update(array('value'));

				if($model->name == 'useGoogleMap' && $model->value == 1){
					$modelToggle = ConfigurationModel::model()->findAllByAttributes(array('name' => array('useYandexMap', 'useOSMMap')));
					if ($modelToggle) {
						foreach($modelToggle as $mToggle) {
							$mToggle->value = 0;
							$mToggle->update(array('value'));
						}
					}
				}
				if($model->name == 'useYandexMap' && $model->value == 1){
					$modelToggle = ConfigurationModel::model()->findAllByAttributes(array('name' => array('useGoogleMap', 'useOSMMap')));
					if ($modelToggle) {
						foreach($modelToggle as $mToggle) {
							$mToggle->value = 0;
							$mToggle->update(array('value'));
						}
					}
				}
				if($model->name == 'useOSMMap' && $model->value == 1){
					$modelToggle = ConfigurationModel::model()->findAllByAttributes(array('name' => array('useYandexMap', 'useGoogleMap')));
					if ($modelToggle) {
						foreach($modelToggle as $mToggle) {
							$mToggle->value = 0;
							$mToggle->update(array('value'));
						}
					}
				}

				if ($model->name == 'useLocation') {
					echo 'reload';
				}
			}
		}

		if(!Yii::app()->request->isAjaxRequest){
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
	}

	public function getSections($withAll = 1){
		$sql = 'SELECT section FROM {{configuration}} WHERE type <> "hidden" GROUP BY section';
		$categories = Yii::app()->db->createCommand($sql)->queryAll();

		if($withAll)
			$return['all'] = tc('All');
		foreach($categories as $category){
			$return[$category['section']] = tt($category['section']);
		}
		return $return;
	}
}