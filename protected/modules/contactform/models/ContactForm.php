<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class ContactForm extends CFormModel {
	public $name;
	public $email;
	public $body;
	public $verifyCode;
	public $phone;
	public $theme;
	public $useremail;
	public $username;

	public function rules()	{
		return array(
			array('name, email, theme, body', 'required'),
			array('email', 'email'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!Yii::app()->user->isGuest),
			array('phone', 'safe'),
			array('theme', 'safe'),
			array('name, email', 'length', 'max' => 128),
			array('phone', 'length', 'max' => 16, 'min' => 5),
			array('theme', 'length', 'max' => 16, 'min' => 5),
			array('body', 'length', 'max' => 1024),
		);
	}

	public function attributeLabels() {
		return array(
			'name' => tt('Name', 'contactform'),
			'email' => tt('Email', 'contactform'),
			'phone' => tt('Phone', 'contactform'),
			'theme' => tt('Theme', 'contactform'),
			'body' => tt('Body', 'contactform'),
			'verifyCode' => tt('Verification Code', 'contactform'),
		);
	}
}