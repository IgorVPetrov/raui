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

class MainController extends ModuleAdminController {
	public $modelName = 'SocialpostingModel';
	public $defaultAction='admin';

	public function accessRules(){
		return array(
			array('allow',
				'expression'=> "Yii::app()->user->checkAccess('all_modules_admin')",
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
        $model = new SocialpostingModel('search');

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
		if(demo()){
			echo 'ok';
			Yii::app()->end();
		}

        $id = Yii::app()->request->getPost('id');
        $val = Yii::app()->request->getPost('val', '');

        if(!$id){
			Yii::app()->user->setFlash('error', tt('Enter the required value'));
            echo 'error_save';
            Yii::app()->end();
        }

        $model = SocialpostingModel::model()->findByPk($id);

		/*if(!$val && !in_array($model->name, SocialpostingModel::model()->allowEmpty)) {
			Yii::app()->user->setFlash('error', tt('Enter the required value'));
			echo 'error_save';
			Yii::app()->end();
		}*/

        $model->value = $val;
        if($model->save()){
            echo 'ok';
        } else {
			Yii::app()->user->setFlash('error', tt('Enter the required value'));
            echo 'error_save';
        }
    }

    public function actionActivate(){
		if(demo()){
			echo 'ok';
			Yii::app()->end();
		}

        $id = intval(Yii::app()->request->getQuery('id', 0));

        if($id){
            $action = Yii::app()->request->getQuery('action');
            $model = $this->loadModel($id);

            if($model){
                $model->value = ($action == 'activate' ? 1 : 0);
                $model->update(array('value'));
            }
        }
        if(!Yii::app()->request->isAjaxRequest){
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    public function getSections($withAll = 1){
        $sql = 'SELECT section FROM {{socialposting}} GROUP BY section';
        $categories = Yii::app()->db->createCommand($sql)->queryAll();

        if($withAll)
            $return['all'] = tc('All');
        foreach($categories as $category){
            $return[$category['section']] = tt($category['section']);
        }
        return $return;
    }

}
