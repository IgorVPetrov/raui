<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class City extends ParentModel{
	public $minSorter = 0;
	public $maxSorter = 0;

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return '{{location_city}}';
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
			array('country_id, region_id', 'required'),
			array('country_id, region_id', 'numerical', 'integerOnly'=>true),
			array('name', 'i18nRequired'),
			array('name', 'i18nLength', 'max'=>255),
			array($this->getI18nFieldSafe(), 'safe'),
			array('active', 'safe', 'on'=>'search'),
			array('sorter', 'numerical', 'integerOnly'=>true)
		);
	}

	public function relations(){
		//Yii::app()->getModule('city');
		return array(
			'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
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
			'country_id' => tc('Country'),
			'country' => tc('Country'),
			'region_id' => tc('Region'),
			'region' => tc('Region'),
			'name' => tc('Name'),
			'date_updated' => 'Date Updated',
		);
	}

	public function getName(){
		return $this->getStrByLang('name');
	}

	public function search(){
		if (!$this->country_id || !in_array($this->region_id, array_keys(Region::getRegionsArray($this->country_id, 0, 1))))
			$this->region_id = "";

		$criteria=new CDbCriteria;

		$tmp = 'name_'.Yii::app()->language;
		$criteria->compare('t.'.$tmp, $this->$tmp, true);
		$criteria->compare('t.active', $this->active);
		$criteria->compare('t.country_id', $this->country_id);
		$criteria->compare('t.region_id', $this->region_id);
		$criteria->with = array('country', 'region');
		$criteria->order = 'country.sorter ASC, region.sorter ASC, t.sorter ASC';


		if ($this->region_id) {
			$this->minSorter = Yii::app()->db->createCommand()
				->select('MIN(sorter) as minSorter')
				->from($this->tableName())
				->where('region_id=:id', array(':id'=>$this->region_id))
				->queryScalar();
			$this->maxSorter = Yii::app()->db->createCommand()
				->select('MAX(sorter) as maxSorter')
				->from($this->tableName())
				->where('region_id=:id', array(':id'=>$this->region_id))
				->queryScalar();
		}


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>param('adminPaginationPageSize', 20),
			),
		));
	}

	public function afterDelete(){

		$sql = 'UPDATE {{apartment}} SET loc_city=0 WHERE loc_city="'.$this->id.'"';
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

	public static function getCitiesArray($region, $type=0, $all=0){
		// 0 - без первой строки, 1 - пустая первая строка, 2 - любой, 3 - не указан

		$active_str = ($all) ? '' : 'AND active = 1 ';
		$sql = 'SELECT id, name_'.Yii::app()->language.' AS name FROM {{location_city}} WHERE region_id = :region '.$active_str.'ORDER BY sorter ASC';
		$res = Yii::app()->db->createCommand($sql)->queryAll(true, array(':region' => $region));

		$res = CHtml::listData($res, 'id', 'name');

		switch ($type) {
			case 1:
				$cities = CArray::merge(array(0 => ''), $res);
				break;
			case 2:
				$cities = CArray::merge(array(0 => tc('select city')), $res);
				break;
			case 3:
				$cities = CArray::merge(array(0 =>  tc('Not specified_m')), $res);
				break;
			default :
				$cities = $res;
		}


        return $cities;
    }

}