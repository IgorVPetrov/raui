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

class RecoverForm extends CFormModel {
	public $email;
	public $verifyCode;

	public function rules() {
		return array(
			array('email, verifyCode', 'required'),
			array('email', 'email'),
			array('verifyCode', 'captcha'),
		);
	}

	public function attributeLabels() {
		return array(
			'recoverPass'=>tc('Forgot password?'),
			'email'=> tc('Email'),
			'verifyCode' => tc('Verify Code'),
		);
	}
}
