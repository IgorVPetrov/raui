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

class MainController extends Controller {
    public $canUseDirectUrl = false;

	public function actionAjaxSave() {
		if(isset($_POST['SeoFriendlyUrl'])){
            $this->canUseDirectUrl = (int) Yii::app()->request->getPost('canUseDirectUrl');

			$friendlyUrl = SeoFriendlyUrl::model()->findByPk($_POST['SeoFriendlyUrl']['id']);

			if(!$friendlyUrl){
				$friendlyUrl = new SeoFriendlyUrl();
			}

			$friendlyUrl->attributes = $_POST['SeoFriendlyUrl'];

			if($friendlyUrl->save()){
				echo CJSON::encode(array(
					'status' => 'ok',
					'html' => $this->renderPartial('//modules/seo/views/_form', array('friendlyUrl' => $friendlyUrl), true)
				));
				Yii::app()->end();
			}else{
				echo CJSON::encode(array(
					'status' => 'err',
					'html' => $this->renderPartial('//modules/seo/views/_form', array('friendlyUrl' => $friendlyUrl), true)
				));
				Yii::app()->end();
			}
		}
		throw404();
	}
}
