<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class ApartmentsComplain extends ParentModel {
	public $verifyCode;
	const STATUS_PENDING = 0;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{apartment_complain}}';
	}

	public function rules() {
		return array(
			array('verifyCode', (Yii::app()->user->isGuest) ? 'required' : 'safe', 'on' => 'insert'),
			array('verifyCode', 'captcha', 'on' => 'insert', 'allowEmpty'=>!Yii::app()->user->isGuest),
			array('apartment_id, complain_id, name, email, body', 'required'),
			array('name, email', 'length', 'max' => 255),
			array('body', 'length', 'max' => 1024),
			array('email', 'email'),
			array('apartment_id, complain_id, user_id', 'numerical', 'integerOnly' => true),
			array('session_id', 'length', 'max' => 32),
			array('user_ip, user_ip_ip2_long', 'length', 'max' => 60),
		);
	}

	public function relations() {
		Yii::import('application.modules.apartments.models.Apartment');
		return array(
			'apartment' => array(self::BELONGS_TO, 'Apartment', 'apartment_id'),
		);
	}

	public function behaviors(){
		return array(
			'AutoTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'date_created',
				'updateAttribute' => 'date_updated',
			),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'Id',
			'body' => tt('Body', 'apartmentsComplain'),
			'date_created' => tt('Creation date', 'apartmentsComplain'),
			'name' => tt('Name', 'apartmentsComplain'),
			'email' => tt('Email', 'apartmentsComplain'),
			'apartment_id' => tt('Apartment_id', 'apartmentsComplain'),
			'complain_id' => tt('Cause of complaint', 'apartmentsComplain'),
			'verifyCode' => tt('Verification Code', 'apartmentsComplain'),
			'user_id' => tc('User'),
			'user_ip' => tt('User IP', 'blockIp'),
		);
	}

	public function search(){
		$criteria = new CDbCriteria();

		$criteria->compare('name',$this->name, true);
		$criteria->compare('body',$this->body, true);
		$criteria->compare('complain_id',$this->complain_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>param('adminPaginationPageSize', 20),
			),
			'sort'=>array('defaultOrder'=>'id DESC'),
		));
	}

	public static function getCountPending(){
		$sql = "SELECT COUNT(id) FROM {{apartment_complain}} WHERE active=".self::STATUS_PENDING;
		return (int) Yii::app()->db->createCommand($sql)->queryScalar();
	}

	public static function getUserEmailLink($data) {
		return "<a href='mailto:".$data->email."'>".$data->name."</a>";
	}
}