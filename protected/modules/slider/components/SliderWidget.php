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

class SliderWidget extends CWidget {
	public $imgCount = 0;
	public $images;

	public function getViewPath($checkTheme=true){
		if($checkTheme && ($theme=Yii::app()->getTheme())!==null){
			if (is_dir($theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'slider'.DIRECTORY_SEPARATOR.'views'))
				return $theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'slider'.DIRECTORY_SEPARATOR.'views';
		}
		return Yii::getPathOfAlias('application.modules.slider.views');
	}

	public function run() {
		if (!$this->images) {
			$slider = new Slider;
			$this->images = $slider->getActiveImages();
		}

		$this->render('widgetSlider_list', array(
			'images' => $this->images,
			'imgCount' => $this->imgCount
		));
	}
}