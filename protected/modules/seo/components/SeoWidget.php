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

class SeoWidget extends CWidget{

	public $model;
	public $prefixUrl;
    public $canUseDirectUrl = false;

	public function getViewPath($checkTheme=true){
		if($checkTheme && ($theme=Yii::app()->getTheme())!==null){
			if (is_dir($theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'seo'.DIRECTORY_SEPARATOR.'views'))
				return $theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'seo'.DIRECTORY_SEPARATOR.'views';
		}
		return Yii::getPathOfAlias('application.modules.seo.views');
	}

	public function run(){
		if(!param('genFirendlyUrl')){
			return '';
		}

		if(!$this->model){
			return NULL;
		}

		$friendlyUrl = SeoFriendlyUrl::getAndCreateForModel($this->model);

		$this->render('seoWidget', array(
			'model' => $this->model,
			'friendlyUrl' => $friendlyUrl,
		));
	}
}
