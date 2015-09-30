<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class Offline extends PaymentSystem {

    public function init(){
        $this->name = 'offline';
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
		$payment->status = Payments::STATUS_WAITOFFLINE;
		$payment->update(array('status'));

		try {
			$notifier = new Notifier;
			$notifier->raiseEvent('onOfflinePayment', $payment);
		} catch(CHttpException $e){}

		return array(
			'status' => Paysystem::RESULT_OK,
			'message' => tt('Thank you! Notification of your payment sent to the administrator.', 'payment'),
		);
	}
}