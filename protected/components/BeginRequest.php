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

class BeginRequest {
	const TIME_UPDATE = 86400;
	const TIME_UPDATE_TARIFF_PLANS = 43200;

	public static function updateStatusAd() {
		if (Yii::app()->request->getIsAjaxRequest())
			return false;

		if (!oreInstall::isInstalled())
			return false;

		$data = Yii::app()->statePersister->load();

		// Обновляем статусы 1 раз в сутки
		if (isset($data['next_check_status'])) {
			if ($data['next_check_status'] < time()) {
				$data['next_check_status'] = time() + self::TIME_UPDATE;
				Yii::app()->statePersister->save($data);

				if (issetModule('paidservices')) {
					self::checkStatusAd();
					// обновляем курсы валют
					Currency::model()->parseCbr();
				}
				self::clearDrafts();
				self::clearApartmentsStats();
				self::clearUsersSessions();
				self::checkDateEndActivity();
				self::deleteIPFromBlocklist();
			}
		}
		else {
			$data['next_check_status'] = time() + self::TIME_UPDATE;
			Yii::app()->statePersister->save($data);

			if (issetModule('paidservices')) {
				self::checkStatusAd();

				// обновляем курсы валют
				Currency::model()->parseCbr();
			}
			self::clearDrafts();
			self::clearApartmentsStats();
			self::clearUsersSessions();
			self::checkDateEndActivity();
			self::deleteIPFromBlocklist();
		}

		// Тарифные планы - 2 раза в сутки
		if (issetModule('tariffPlans') && issetModule('paidservices')) {
			if (isset($data['next_check_status_users_tariffs'])) {
				if ($data['next_check_status_users_tariffs'] < time()) {
					$data['next_check_status_users_tariffs'] = time() + self::TIME_UPDATE_TARIFF_PLANS;
					Yii::app()->statePersister->save($data);

					self::checkTariffPlansUsers();
				}
			}
			else {
				$data['next_check_status_users_tariffs'] = time() + self::TIME_UPDATE_TARIFF_PLANS;
				Yii::app()->statePersister->save($data);

				self::checkTariffPlansUsers();
			}
		}

		Yii::app()->cache->flush();
	}

	public static function checkStatusAd() {
		$activePaids = ApartmentPaid::model()->findAll('date_end <= NOW() AND status=' . ApartmentPaid::STATUS_ACTIVE);

		foreach ($activePaids as $paid) {
			$paid->status = ApartmentPaid::STATUS_NO_ACTIVE;

			if ($paid->paid_id == PaidServices::ID_SPECIAL_OFFER || $paid->paid_id == PaidServices::ID_UP_IN_SEARCH) {
				$apartment = Apartment::model()->findByPk($paid->apartment_id);

				if ($apartment) {
					$apartment->scenario = 'update_status';

					if ($paid->paid_id == PaidServices::ID_SPECIAL_OFFER) {
						$apartment->is_special_offer = 0;
						$apartment->update(array('is_special_offer'));
					}

					if ($paid->paid_id == PaidServices::ID_UP_IN_SEARCH) {
						$apartment->date_up_search = new CDbExpression('NULL');
						$apartment->update(array('date_up_search'));
					}
				}
			}

			if (!$paid->update(array('status'))) {
				//deb($paid->getErrors());
			}
		}
	}

	public static function clearApartmentsStats(){
		$sql = 'DELETE FROM {{apartment_statistics}} WHERE date_created < (NOW() - INTERVAL 2 DAY)';
		Yii::app()->db->createCommand($sql)->execute();
	}

	public static function clearUsersSessions(){
		//$time = time();
		//$sql = 'DELETE FROM {{users_sessions}} WHERE expire < '.$time;

		$sql = 'DELETE FROM {{users_sessions}} WHERE expire < (UNIX_TIMESTAMP(NOW() - INTERVAL 2 DAY))';
		Yii::app()->db->createCommand($sql)->execute();
	}

	public static function checkDateEndActivity () {
		$adEndActivity = Apartment::model()->with('user')->findAll('
			t.date_end_activity <= NOW() AND
			t.activity_always != 1 AND
			(t.active=:status OR t.owner_active=:status) AND
			t.active <> :draft', array(':status' => Apartment::STATUS_ACTIVE, ':draft' => Apartment::STATUS_DRAFT));
		foreach($adEndActivity as $ad){
			$ad->scenario = 'update_status';
			if(isset($ad->user) && $ad->user->role == User::ROLE_ADMIN){
				$ad->active = Apartment::STATUS_INACTIVE;
			} else {
				$ad->active = Apartment::STATUS_INACTIVE;
				$ad->owner_active = Apartment::STATUS_INACTIVE;
			}
			$ad->save(false);
		}
	}

	public static function checkTariffPlansUsers() {
		if (issetModule('tariffPlans') && issetModule('paidservices')) {
			TariffPlans::checkDeactivateTariffUsers();
		}
	}

	public static function deleteIPFromBlocklist() {
		$interval = intval(param('delete_ip_after_days', 5));

		$sql = 'DELETE FROM {{block_ip}} WHERE date_created < (NOW() - INTERVAL '.$interval.' DAY)';
		Yii::app()->db->createCommand($sql)->execute();
	}

	public static function clearDrafts(){
		$sql = 'DELETE FROM {{apartment}} WHERE active=:draft AND date_created<DATE_SUB(NOW(),INTERVAL 1 DAY)';
		Yii::app()->db->createCommand($sql)->execute(array(':draft' => Apartment::STATUS_DRAFT));
	}
}