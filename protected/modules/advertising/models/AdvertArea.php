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

class AdvertArea extends ParentModel {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{advertising_area}}';
	}

	public function behaviors(){
		return array(
			'AutoTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'date_updated',
                'updateAttribute' => 'date_updated',
			),
		);
	}

    public static function getDependency(){
        return new CDbCacheDependency('SELECT MAX(date_updated) FROM {{advertising_area}}');
    }
}