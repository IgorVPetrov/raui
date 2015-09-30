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

class AddToAdForm extends CFormModel {
	public $paid_id = PaidServices::ID_UP_IN_SEARCH;
	public $option_id;
	public $date_end;

	public function rules(){
		return array(
			array('paid_id, date_end', 'required'),
			array('paid_id, option_id', 'numerical', 'integerOnly' => true),
		);
	}

	public function attributeLabels() {
		return array(
			'date_end' => tc('is valid till')
		);
	}
}
