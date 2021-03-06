<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class TimesIn extends ParentModel {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{apartment_times_in}}';
	}

	public function rules() {
		return array(
			array('title', 'i18nLength', 'max' => 255),
			array('title', 'i18nRequired'),
			array('id', 'safe', 'on' => 'search'),
			array($this->getI18nFieldSafe(), 'safe'),
		);
	}

    public function i18nFields(){
        return array(
            'title' => 'varchar(255) not null',
        );
    }

	public function relations() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'title' => tc('Name'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('title_'.Yii::app()->language, $this->{'title_'.Yii::app()->language}, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => param('adminPaginationPageSize', 20),
			),
		));
	}

}