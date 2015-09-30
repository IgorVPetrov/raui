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

class jQuerySimpleCCaptchaAction extends CCaptchaAction {
	public function run() {

		Yii::app()->end();
	}

	public function validate($input,$caseSensitive) {
		$valid = false;

		if (isset($_POST) && isset($_POST['captchaSelection'])) {
			if (Yii::app()->user->hasState("simpleCaptchaAnswer") && $_POST['captchaSelection'] == Yii::app()->user->getState('simpleCaptchaAnswer')) {
				$valid = true;
			}
		}

		return $valid;
	}
}