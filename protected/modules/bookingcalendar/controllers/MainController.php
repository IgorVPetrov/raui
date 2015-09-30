<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class MainController extends ModuleUserController{
	public $modelName = 'Bookingcalendar';

	public function actionAddFieldBooking($element) {
		if (Yii::app()->request->isAjaxRequest && !Yii::app()->user->isGuest) {
			$apartment = new Apartment;
			$model = new $this->modelName;

			$this->excludeJs();

			$this->renderPartial('_booking_period', array(
				'apartment' => $apartment,
				'model' => $model,
				'element' => $element,
			), false, true);
		}
		return false;
	}

	public function actionSaveBooking($dateStart, $dateEnd, $dateStatus, $apId) {
		$msg = 'access_error';
		if (Yii::app()->request->isAjaxRequest && !Yii::app()->user->isGuest) {
			if (($apId && Bookingcalendar::isUserAd($apId, Yii::app()->user->id)) ||
				($apId && Yii::app()->user->checkAccess('backend_access'))) {

				$model = new $this->modelName;

				$model->date_start = $dateStart;
				$model->date_end = $dateEnd;
				$model->status = $dateStatus;
				$model->apartment_id = $apId;

				if ($model->validate()) {
					if ($model->save(false)) {
						$msg = 'ok';
						/*if (Yii::app()->user->checkAccess('backend_access')){
							//$msg = Yii::app()->controller->createUrl("/apartments/backend/main/update", array("id" => $apId));
						} else {
							//$msg = Yii::app()->controller->createUrl("/userads/main/update", array("id" => $apId));
						}*/
					}
					else {
						$msg = 'error_save';
					}
				}
				else {
					$msg = 'error_filling';
				}
			}
			else {
				$msg = 'access_error';
			}
		}
		echo $msg;
	}

	public function actionEditBooking($dateStart, $dateEnd, $dateStatus, $apId, $idDb) {
		$msg = 'access_error';
		if (Yii::app()->request->isAjaxRequest && !Yii::app()->user->isGuest) {
			if ($idDb && $apId) {
				if (($apId && Bookingcalendar::isUserAd($apId, Yii::app()->user->id)) ||
				($apId && Yii::app()->user->checkAccess('backend_access'))) {

					$model = Bookingcalendar::model()->findByPk($idDb);
					if ($model) {
						$model->date_start = $dateStart;
						$model->date_end = $dateEnd;
						$model->status = $dateStatus;

						if ($model->save()) {
								$msg = 'ok';
						}
						else {
							$msg = 'error_filling';
						}
					} else
						$msg = 'error_save';
				}
			}
		}
		echo $msg;
	}

	public function actionDeleteBooking($idDb, $apId) {
		$msg = 'access_error';
		if (Yii::app()->request->isAjaxRequest && !Yii::app()->user->isGuest) {
			if ($idDb && $apId) {
				if (($apId && Bookingcalendar::isUserAd($apId, Yii::app()->user->id)) ||
				($apId && Yii::app()->user->checkAccess('backend_access'))) {
					$sql = 'DELETE FROM {{booking_calendar}} WHERE apartment_id="'.$apId.'" AND id = "'.$idDb.'"';
					if (Yii::app()->db->createCommand($sql)->execute())
						$msg = 'ok';
					else
						$msg = 'error';
				}
				else {
					$msg = 'access_error';
				}
			}
			else {
				$msg = 'access_error';
			}
		}
		echo $msg;
	}
}