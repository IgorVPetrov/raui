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

class Country extends ParentModel{

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return '{{location_country}}';
	}

	public function behaviors()
	{
		return array(
			'ERememberFiltersBehavior' => array(
				'class' => 'application.components.behaviors.ERememberFiltersBehavior',
				'defaults' => array(),
				'defaultStickOnClear' => false
			),
			/*'AutoTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'date_updated',
				'updateAttribute' => 'date_updated',
			),*/
		);
	}

	public function rules(){
		return array(
			array('name', 'i18nRequired'),
			array('name', 'i18nLength', 'max'=>255),
			array($this->getI18nFieldSafe(), 'safe'),
			array('active', 'safe', 'on'=>'search'),
			array('sorter', 'numerical', 'integerOnly'=>true)
		);
	}

	public function relations(){
		//Yii::app()->getModule('Region');
		return array(
			'regions' => array(self::HAS_MANY, 'Region', 'country_id'),
			'cities' => array(self::HAS_MANY, 'City', 'country_id'),
		);
	}

	public function i18nFields(){
		return array(
			'name' => 'varchar(255) not null',
		);
	}

	public function attributeLabels(){
		return array(
			'id' => 'ID',
			'name' => tc('Name'),
			'date_updated' => 'Date Updated',
		);
	}

	public function getName(){
		return $this->getStrByLang('name');
	}

	public function search(){
		$criteria=new CDbCriteria;

		$tmp = 'name_'.Yii::app()->language;

		$criteria->compare('t.active', $this->active);
		$criteria->compare($tmp, $this->$tmp, true);
		$criteria->order = 'sorter ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>param('adminPaginationPageSize', 20),
			),
		));
	}



	public function afterDelete(){
		$sql = 'DELETE FROM {{location_region}} WHERE country_id="'.$this->id.'";';
		Yii::app()->db->createCommand($sql)->execute();

		$sql = 'DELETE FROM {{location_city}} WHERE country_id="'.$this->id.'";';
		Yii::app()->db->createCommand($sql)->execute();

		$sql = 'UPDATE {{apartment}} SET loc_country=0, loc_region=0, loc_city=0 WHERE loc_country="'.$this->id.'"';
		Yii::app()->db->createCommand($sql)->execute();

		return parent::afterDelete();
	}

	public function beforeSave(){
		if($this->isNewRecord){
			$maxSorter = Yii::app()->db->createCommand()
				->select('MAX(sorter) as maxSorter')
				->from($this->tableName())
				->queryScalar();
			$this->sorter = $maxSorter+1;
		}

		return parent::beforeSave();
	}

	public static function getCountriesArray($type=0, $all=0){
		// 0 - без первой строки, 1 - пустая первая строка, 2 - любой, 3 - не указан

		$active_str = ($all) ? '' : 'WHERE active = 1 ';

		$sql = 'SELECT id, name_'.Yii::app()->language.' AS name FROM {{location_country}} '.$active_str.'ORDER BY sorter ASC';
		$res = Yii::app()->db->createCommand($sql)->queryAll();

		$res = CHtml::listData($res, 'id', 'name');

		switch ($type) {
			case 1:
				$countries = CArray::merge(array(0 => ''), $res);
				break;
			case 2:
				$countries = CArray::merge(array(0 => tc('select country')), $res);
				break;
			case 3:
				$countries = CArray::merge(array(0 => tc('Not specified_f')), $res);
				break;
			default :
				$countries = $res;
		}

		return $countries;
	}
}