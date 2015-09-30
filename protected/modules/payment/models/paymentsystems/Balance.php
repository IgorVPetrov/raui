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

class Balance extends PaymentSystem {

	public function init(){
		$this->name = 'balance';
		return parent::init();
	}

	public function rules(){
		return array(
		);
	}

	public function attributeLabels(){
		return array(
		);
	}

	public function processPayment(Payments $payment){
		$user = User::model()->findByPk($payment->user_id);

		if(!$user || $user->balance < $payment->amount){
			return array(
				'status' => Paysystem::RESULT_ERROR,
				'message' => tt('Payment error', 'payment'),
			);

		}

		if($user->deductBalance($payment->amount) && $payment->complete()){
			return array(
				'status' => Paysystem::RESULT_OK,
				'message' => tt('The payment is successfully completed. The paid service has been activated.', 'payment'),
			);
		}

		return array(
			'status' => Paysystem::RESULT_ERROR,
			'message' => tt('Payment error', 'payment'),
		);
	}
}
