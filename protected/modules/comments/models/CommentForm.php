<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class CommentForm extends CFormModel {
	public $body;
	public $url;
	public $verifyCode;

	public $enableRating = false;

	public $rating;
	public $user_name;
	public $user_email;

	public $rel;

	public $modelName;
	public $modelId;

	public function attributeLabels(){
		return array(
			'body' => Yii::t('module_comments', 'Comment'),
			'rating' => Yii::t('module_comments', 'Rate'),
			'user_name' => Yii::t('module_comments', 'Name'),
			'user_email' => Yii::t('module_comments', 'Email'),
			'verifyCode' => tt('Verification Code', 'contactform'),
		);
	}

	public function rules()	{
		$return = array(
			array('body', 'required'),

			array('verifyCode', (Yii::app()->user->isGuest || param('useCaptchaCommentsForRegistered', 1)) ? 'required' : 'safe'),
			array('verifyCode', 'captcha', 'allowEmpty'=> !(Yii::app()->user->isGuest || param('useCaptchaCommentsForRegistered', 1))),

			array('user_name, user_email', 'length', 'max' => 64),
			array('user_email', 'email'),
			array('rating, url, modelName, modelId, rel', 'safe'),
		);

		if(Yii::app()->user->isGuest){
			$return[] = array('user_name, user_email', 'required');
		}

		return $return;
	}

	public function defineShowRating(){
		if($this->modelName == 'Apartment'){
			$this->enableRating = true;
		}
	}

}
