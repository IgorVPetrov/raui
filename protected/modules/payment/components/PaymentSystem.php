<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

abstract class PaymentSystem extends CFormModel {

    public $name;

	public function processRequest(){

    }

	public function echoSuccess(){

    }

	public function echoDeclined(){

    }

	public function echoError(){

    }

	public function processPayment(Payments $payment){

    }

	public function printInfo(){

    }
}