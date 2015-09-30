<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class MainController extends ModuleAdminController{
	public $modelName = 'Blog';

	public function accessRules(){
		return array(
			array('allow',
				'expression'=> "Yii::app()->user->checkAccess('blog_admin')",
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionCreate(){
		$model = new $this->modelName;

		$this->performAjaxValidation($model);

		if(isset($_POST[$this->modelName])){
			$model->blogImage = CUploadedFile::getInstance($model,'blogImage');
			$model->attributes=$_POST[$this->modelName];
			if($model->save()){
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create', array('model'=>$model));
	}

	public function actionUpdate($id){
		$model = $this->loadModel($id);

		$this->performAjaxValidation($model);

		if(isset($_POST[$this->modelName])){
			$model->blogImage = CUploadedFile::getInstance($this->_model,'blogImage');
			$model->attributes=$_POST[$this->modelName];
			if($model->save()){
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update', array('model'=>$model));
	}

    public function actionProduct(){

        //BlogProduct::getProductBlog();
        Yii::app()->user->setState('menu_active', 'blog.product');

        $model = BlogProduct::model();
      		$result = $model->getAllWithPagination();

      		$this->render('blog_product', array(
      			'items' => $result['items'],
      			'pages' => $result['pages'],
      		));
    }

	public function actionDeleteImg() {
		$blogId = Yii::app()->request->getParam('id');
		$imageId = Yii::app()->request->getParam('imId');

		if ($blogId && $imageId) {
			$blogModel = Blog::model()->findByPk($blogId);
			if ($blogModel->image_id != $imageId)
				throw404();

			$blogModel->image_id = 0;
			$blogModel->update('image_id');

			$imageModel = BlogImage::model()->findByPk($imageId);
			$imageModel->delete();

			$this->redirect(array('/blog/backend/main/update', 'id' => $blogId));
		}
		throw404();
	}
}