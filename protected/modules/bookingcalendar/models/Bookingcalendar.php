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

class Bookingcalendar extends ParentModel {
	const STATUS_BUSY = 1;
	const STATUS_FREE = 0;

	private static $_statuses_arr;

	public $dateStart = array();
	public $dateEnd = array();
	public $status = array();

	public $dateStartDb = array();
	public $dateEndDb = array();
	public $statusDb = array();

	/*public function init() {
		$this->publishAssets();
	}*/

	public static function publishAssets() {
		$assetsPath = Yii::getPathOfAlias('webroot.themes.'.Yii::app()->theme->name . '.views.modules.bookingcalendar.assets');
		if (is_dir($assetsPath)) {
			$baseUrl = Yii::app()->assetManager->publish($assetsPath);
			Yii::app()->clientScript->registerCssFile($baseUrl . '/css/booking-calendar.css');
		}
	}

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{booking_calendar}}';
	}

	public function rules() {
		return array(
			array('date_start, date_end', 'required'),
			array('apartment_id', 'required', 'on'=>'insert'),
			array('status', 'numerical', 'min' => 1),
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
			'date_start' => tt('From', 'bookingcalendar'),
			'date_end' => tt('To', 'bookingcalendar'),
			'status' => tt('Status', 'bookingcalendar'),
			'dateStart' => tt('from', 'bookingcalendar'),
			'dateEnd' => tt('to', 'bookingcalendar'),
		);
	}

	public static function getAllStatuses(){
		return array(
			self::STATUS_BUSY => tt('Reserved', 'bookingcalendar'),
		);
    }

	public static function getStatus($status){
        if(!isset(self::$_statuses_arr)){
            self::$_statuses_arr = self::getAllStatuses(NULL, true);
        }
        return self::$_statuses_arr[$status];
    }

	public function search(){
		$criteria = new CDbCriteria;
		$criteria->order = 'id DESC';

		$criteria->compare('apartment_id', $this->apartment_id, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>param('adminPaginationPageSize', 20),
			),
		));
	}

	public static function isUserAd($apartmentId = null, $ownerId = null) {
		if ($apartmentId && $ownerId) {
			if (Apartment::model()->findByAttributes(array('id' => $apartmentId, 'owner_id' => $ownerId)))
				return true;
			return false;

		}
		return false;
	}

	public static function getReservedDays($id) {
		$reservedDays = '[]';

		if ($id) {
			$resultTempArr = $resultArr = array();

			$result = Yii::app()->db->createCommand()
					->select('date_start, date_end')
					->from('{{booking_calendar}}')
					->where('apartment_id = "'.$id.'" AND status = "'.self::STATUS_BUSY.'"')
					->queryAll();

			if ($result && count($result) > 0) {
				foreach ($result as $item) {
					$resultTempArr[] = self::dateRange($item['date_start'], $item['date_end']);
				}

				foreach ($resultTempArr as $key => $item) {
					if (is_array($item) && $item) {
						foreach ($item as $value) {
							$resultArr[] = str_replace('-', ', ',$value);
						}
					}
				}
				$resultArr = array_unique($resultArr);

				$total = count($resultArr);
				if ($total > 0) {
					$counter = 0;
					foreach ($resultArr as $value) {
						$counter++;
						if ($counter == 1) {
							// first element
							$reservedDays = '[';
						}
						if($counter == $total){
							// last element
							$reservedDays .= "[{$value}]]";
						}
						else{
							$reservedDays .= "[{$value}],";
						}
					}
				}
			}
		}

		return $reservedDays;
	}

	public static function dateRange($first, $last, $step = '+1 day', $format = 'Y-n-d' ) {
		$dates = array();
		$current = strtotime( $first );
		$last = strtotime( $last );

		while( $current <= $last ) {

			$dates[] = date( $format, $current );
			$current = strtotime( $step, $current );
		}

		return $dates;
	}

    public static function getFirstFreeDay($apartmentId, $currentTime = NULL){
        $currentTime = $currentTime ? $currentTime : time();

        $sql = "SELECT UNIX_TIMESTAMP(date_end) AS time_date_end
                FROM {{booking_calendar}}
                WHERE apartment_id=:id AND date_end >= :date AND date_start <= :date AND status=:status ORDER BY date_start ASC";
        $time = Yii::app()->db->createCommand($sql)->queryScalar(array(
            ':id' => $apartmentId,
            ':date' => date('Y-m-d', $currentTime),
            ':status' => self::STATUS_BUSY
        ));
        if(!$time){
            return $currentTime;
        }
        $time += 86400;
        return self::getFirstFreeDay($apartmentId, $time);
    }
}
