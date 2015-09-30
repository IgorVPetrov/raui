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

class PaymentModule extends Module{
	public function init(){
		$this->setImport(array(
			'application.modules.'.$this->getName() . '.models.paymentsystems.*',
		));
		parent::init();
	}
}