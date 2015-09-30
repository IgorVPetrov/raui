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

class MainController extends ModuleUserController{
    public $layout='//layouts/usercpanel';

    public $modelName = 'PaidService';

    public function actionIndex(){
		if (Yii::app()->user->isGuest){
			throw404();
		}
        $this->setActiveMenu('my_payments');

		$request = Yii::app()->request;
		$ad_id = $request->getParam('id', 0);
		$paid_id = $request->getParam('paid_id');
		$isFancy = $request->getParam('isFancy', 0);
		$paySubmit = $request->getParam('pay_submit');
		$tariffId = $request->getParam('tariffid', 0);


		if($paySubmit){

			$optionId = $request->getParam('option_id');
			$paySystemId = $request->getParam('pay_id');
			$amount = $request->getParam('amount', 0);

			$error = 0;

			// Если это поплнение баланса
			if($paid_id == PaidServices::ID_ADD_FUNDS && $amount <= 0){
				$this->setActiveMenu('my_balance');
				Yii::app()->user->setFlash('error', tc('Please specify the amount of the payment'));
				$error = 1;
			}

			Yii::app()->getModule('payment');
			$paysystem = Paysystem::model()->findByPk($paySystemId);

			if(!$paysystem){
				throw404();
			}

			# покупка тарифного плана
			if ($tariffId && issetModule('tariffPlans')) {
				$tariffPlanInfo = TariffPlans::getFullTariffInfoById($tariffId);
                $paidOption = new PaidOptions;
                $paidOption->id = 0;

				if (!$tariffPlanInfo || $tariffPlanInfo['active'] == TariffPlans::STATUS_INACTIVE)
					throw404();

				if ($tariffPlanInfo['price'] && $tariffPlanInfo['price'] > 0) {
					// Если оплата тарифа с баланса пользователя
					if($paySystemId == Paysystem::ID_BALANCE){
						$user = User::model()->findByPk(Yii::app()->user->id);

						if($user->balance < $tariffPlanInfo['price']){
							Yii::app()->user->setFlash('error', tc('Please refill the balance'));
							$error = 2;
							$this->redirect(array('/tariffPlans/main/index'));
						}
					}
				}
				else { # бесплатный тариф
					Yii::app()->user->setFlash('error', tt('Selected tariff plan is free. Please contact the site administrator for transit to this tariff.', 'tariffPlans'));
					$error = 2;
					$this->redirect(array('/tariffPlans/main/index'));
				}
			}
			else {
				if($paid_id != PaidServices::ID_ADD_FUNDS){
					$ad = Apartment::model()->findByPk($ad_id);
					$paidOption = PaidOptions::model()->findByPk($optionId);

					if(!$ad || !$paidOption || !isset($paidOption->paidService)){
						throw404();
					}

					// Если оплата платной услуги с баланса пользователя
					if($paySystemId == Paysystem::ID_BALANCE){
						$user = User::model()->findByPk(Yii::app()->user->id);

						if($user->id != $ad->owner_id || $ad->deleted){
							throw404();
						}

						if($user->balance < $paidOption->price){
							Yii::app()->user->setFlash('error', tc('Please refill the balance'));
							$error = 2;
						}
					}
				}
			}

			$paysystem->createPayModel();

			if($paysystem->payModel === null){
				throw404();
			}

			if($error == 0){

				// Создаем платеж и ставим ему статус "Ожидает оплаты"
				$payment = new Payments;
				$payment->user_id = Yii::app()->user->id;
				$payment->paid_id = $paid_id;
				if($paid_id != PaidServices::ID_ADD_FUNDS ){
					$payment->paid_option_id = $paidOption->id;
				}
				$payment->apartment_id = $ad_id;
				$payment->tariff_id = $tariffId;
				if ($tariffId && issetModule('tariffPlans')) {
					$payment->amount = $tariffPlanInfo['price'];
				}
				else {
					$payment->amount = $paid_id == PaidServices::ID_ADD_FUNDS ? $amount : $paidOption->price;
				}
				$payment->currency_charcode = Currency::getDefaultCurrencyModel()->char_code;
				$payment->status = Payments::STATUS_WAITPAYMENT;
				$payment->paysystem_id = $paysystem->id;

				$payment->save();

				/*echo '<pre>';
				print_r($payment->getErrors());
				echo '</pre>';
				exit;*/

				// Передаем платеж на обработку в модель платежки.
				// Приложение либо звершается (происходит редирект по нужному адресу),
				// либо выдает сообщение, которое будет отображено пользователю
				$return = $paysystem->payModel->processPayment($payment);

				switch ($return['status']){
					case Paysystem::RESULT_OK:
						Yii::app()->user->setFlash('success', $return['message']);
						$this->redirect(array('/usercpanel/main/payments'));
						break;

					case Paysystem::RESULT_NOTICE:
						Yii::app()->user->setFlash('notice', $return['message']);
						$this->redirect(array('/userads/main/update', 'id'=>$payment->apartment_id));
						break;

					case Paysystem::RESULT_ERROR:
						Yii::app()->user->setFlash('error', $return['message']);
						$this->redirect(array('/userads/main/update', 'id'=>$payment->apartment_id));
						break;

					default:
						$this->render('result', array(
							'payment' => $payment,
							'paysystem' => $paysystem,
							'message' => $return['message'],
						));
				}
				echo 'Loading ... ';
				exit;
			}
		}


		if($paid_id != PaidServices::ID_ADD_FUNDS){
			$apartment = Apartment::model()->findByPk($ad_id);

			if( $apartment->active != Apartment::STATUS_ACTIVE || $apartment->owner_active != 1 ){
				echo '<h2>'.tt('To apply a paid service for the listing, it should be active.', 'paidservices').'</h2>';
				exit;
			}
		}

		$paidService = PaidServices::model()->findByPk($paid_id);
		if(!$paidService || !$paidService->active){
			throw404();
		}

		if($paid_id == PaidServices::ID_ADD_IN_SLIDER){
			$img = Images::getMainImageData(null, $apartment->id);

			if(!$img){
				Yii::app()->user->setFlash('error', tt('Error! You must upload the image for the ad.', 'paidservices'));

				if(!$isFancy){
					$this->redirect(array('/userads/main/update', 'id'=>$ad_id));
				} else {
					echo tt('Error! You must upload the image for the ad.', 'paidservices');
				}
				Yii::app()->end();
			}
		}

		if(!isset($user)){
			$user = User::model()->findByPk(Yii::app()->user->id);
		}

		if($isFancy || Yii::app()->request->isAjaxRequest){
			$this->excludeJs();

			if ($tariffId && issetModule('tariffPlans')) {
				$this->redirect(array('/tariffPlans/main/index'));
			}
			else {
				$this->renderPartial('paidform', array(
					'paidService' => $paidService,
					'user' => $user,
					'ad_id' => $ad_id,
					'isFancy' => true,
				), false, true);
			}
		}
		else {
			if ($tariffId && issetModule('tariffPlans')) {
				$this->redirect(array('/tariffPlans/main/index'));
			}
			else {
				$this->render('paidform', array(
					'paidService' => $paidService,
					'user' => $user,
					'ad_id' => $ad_id,
					'isFancy' => false,
				));
			}
		}
	}
}