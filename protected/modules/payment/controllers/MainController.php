<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class MainController extends ModuleUserController{

	/*
	 * Принимаем ответ от платежки, создаем нужную модель и обрабатываем платеж
	 */
	public function actionIncome(){
		$paysystem = $this->_createPaymentSystemModel();
		if($paysystem === null){
			return;
		}

		$result = $paysystem->payModel->processRequest();

		if (!$_POST && Yii::app()->request->getParam('payment') == 'success') {
			Yii::app()->user->setFlash('success', tt('Payment successfully held', 'payment'));
			$this->redirect(array('/usercpanel/main/payments'));
			exit;
		}

		if (!$_POST && Yii::app()->request->getParam('payment') == 'fail') {
			Yii::app()->user->setFlash('error', tt('Payment is canceled', 'payment'));
			$this->redirect(array('/usercpanel/main/payments'));
			exit;
		}

		// Обрабатываем успешный платеж
		if($result['result'] == 'success'){
			$payment = Payments::model()->findByPk($result['id']);
			if($payment){
				if($payment->status != Payments::STATUS_PAYMENTCOMPLETE){
					$payment->complete();
                }

				$paysystem->payModel->echoSuccess();

				Yii::app()->user->setFlash('success', tt('Payment successfully held', 'payment'));
				$this->redirect(array('/usercpanel/main/payments'));
			}
		}

        // Обрабатываем pending платеж
        if($result['result'] == 'pending'){
            $payment = Payments::model()->findByPk($result['id']);
            if($payment){
                if($payment->status != Payments::STATUS_PENDING){
                    $payment->status = Payments::STATUS_PENDING;
                    $payment->update('status');
                }
            }
        }

		// Обрабатываем неудачный платеж
		if($result['result'] == 'fail'){
			// Если в ответе от платежки есть id платежа - ставим ему статус "Отменен"
			if($result['id']){
				$payment = Payments::model()->findByPk($result['id']);
				if($payment){

					if($payment->status == Payments::STATUS_WAITPAYMENT){

						$payment->status = Payments::STATUS_DECLINED;
						$payment->update(array('status'));

						$paysystem->payModel->echoDeclined();
						Yii::app()->user->setFlash('error', tt('Payment is canceled', 'payment'));
					}

					$this->redirect(array('/usercpanel/main/payments'));
				}
			}

			Yii::app()->user->setFlash('error', tt('Payment is canceled', 'payment'));
			$this->redirect(array('/site/index'));

			/*$paysystem->payModel->echoError();

			$this->render('message', array(
				'message' => '',
			));*/
		}

        $this->redirect(array('/usercpanel/main/payments'));
	}

	private function _createPaymentSystemModel($name = null){
		if($name === null){
			$name = $_REQUEST['sys'];
		}
		$paysystem = Paysystem::model()->findByAttributes(
			array('model_name' => $name)
		);

		if($paysystem === null){
			return null;
		}

		$paysystem->createPayModel();

		if($paysystem->payModel === null){
			return null;
		}
		return $paysystem;
	}

}
