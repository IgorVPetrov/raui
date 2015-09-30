<?php

/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class ChangeOwner extends CFormModel {
	public $futureOwner;
	public $futureApartments;

	public function rules() {
		return array(
			array('futureOwner, futureApartments', 'required'),
			array('futureOwner', 'numerical', 'integerOnly' => true),
			array('futureApartments', 'type', 'type'=>'array', 'allowEmpty'=>false),
		);
	}

	public function attributeLabels() {
		return array(
			'futureOwner' => tt('futureOwner', 'apartments'),
			'futureApartments' => tt('futureApartments', 'apartments'),
		);
	}
}