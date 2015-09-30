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

class AddToUserForm extends CFormModel {
	public $tariff_id;
	public $date_end;

	public function rules(){
		return array(
			array('tariff_id, date_end', 'required'),
			array('tariff_id', 'numerical', 'integerOnly' => true),
		);
	}

	public function attributeLabels() {
		return array(
			'date_end' => tc('is valid till'),
			'tariff_id' => tt('Tariff_id', 'tariffPlans'),
		);
	}
}
