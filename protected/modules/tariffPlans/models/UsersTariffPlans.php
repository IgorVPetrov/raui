<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class UsersTariffPlans extends CActiveRecord {
    const STATUS_ACTIVE = 1;
    const STATUS_NO_ACTIVE = 0;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}


	public function tableName() {
		return '{{users_tariff_plans}}';
	}


	public function rules() {
		return array(
			array('user_id, tariff_id, date_start, date_end', 'required'),
			array('user_id, tariff_id, status', 'numerical', 'integerOnly' => true),
			array('id, user_id, tariff_id, date_start, date_end', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'userInfo' => array(self::BELONGS_TO, 'User', 'user_id'),
			'tariffInfo' => array(self::BELONGS_TO, 'TariffPlans', 'tariff_id')
		);
	}

	public function scopes() {
		return array(
			'active' => array(
				'condition' => 'status='.self::STATUS_ACTIVE
			)
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'tariff_id' => 'Tariff',
			'date_start' => 'Date Start',
			'date_end' => 'Date End',
		);
	}

	public function search() {
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('tariff_id',$this->tariff_id);
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('date_end',$this->date_end,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}