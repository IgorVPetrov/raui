<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class Region extends ParentModel{
	public $minSorter = 0;
	public $maxSorter = 0;

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return '{{location_region}}';
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
			array('country_id', 'required'),
			array('country_id', 'numerical', 'integerOnly'=>true),
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
			'cities' => array(self::HAS_MANY, 'City', 'region_id'),
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
		$criteria->compare('t.'.$tmp, $this->$tmp, true);
		$criteria->compare('t.active', $this->active);
		$criteria->compare('t.country_id', $this->country_id);
		$criteria->with = array('country');
		$criteria->order = 'country.sorter ASC, t.sorter ASC';

		if ($this->country_id) {
			$this->minSorter = Yii::app()->db->createCommand()
				->select('MIN(sorter) as minSorter')
				->from($this->tableName())
				->where('country_id=:id', array(':id'=>$this->country_id))
				->queryScalar();
			$this->maxSorter = Yii::app()->db->createCommand()
				->select('MAX(sorter) as maxSorter')
				->from($this->tableName())
				->where('country_id=:id', array(':id'=>$this->country_id))
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
		$sql = 'DELETE FROM {{location_city}} WHERE region_id="'.$this->id.'";';
		Yii::app()->db->createCommand($sql)->execute();

		$sql = 'UPDATE {{apartment}} SET loc_region=0, loc_city=0 WHERE loc_region="'.$this->id.'"';
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

	public static function getRegionsArray($country, $type=0, $all=0){

		$active_str = ($all) ? '' : 'AND active = 1 ';

		if ($type != 4) {
			$sql = 'SELECT id, name_'.Yii::app()->language.' AS name FROM {{location_region}} WHERE country_id = :country '.$active_str.'ORDER BY sorter ASC';
			$res = Yii::app()->db->createCommand($sql)->queryAll(true, array(':country' => $country));
		} else {
			$sql = 'SELECT id, name_'.Yii::app()->language.' AS name FROM {{location_region}} '.$active_str.'ORDER BY sorter ASC';
			$res = Yii::app()->db->createCommand($sql)->queryAll();
		}

		$res = CHtml::listData($res, 'id', 'name');

		switch ($type) {
			case 1:
			case 4:
				$regions = CArray::merge(array(0 => ''), $res);
				break;
			case 2:
				$regions = CArray::merge(array(0 => tc('select region')), $res);
				break;
			case 3:
				$regions = CArray::merge(array(0 => tc('Not specified_m')), $res);
				break;
			default :
				$regions = $res;
		}


        return $regions;
    }


}