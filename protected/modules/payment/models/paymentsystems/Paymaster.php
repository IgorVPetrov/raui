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

# docs:
// https://paymaster.ru/Partners/ru/docs/protocol
// https://paymaster.ru/Partners/ru/docs/widget
// http://info.paymaster.ru/%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D0%B8-cms/
// https://paymaster.ru/partners/ru/docs/migration

class Paymaster extends PaymentSystem {
	public $MERCHANT_ID;

	public static function workWithCurrencyCode(){
		//return array('RUB' => '643', 'USD' => '840', 'EUR' => '978');
	}

	public static function workWithCurrency(){
		//return array('RUB', 'USD', 'EUR');
		return array('RUB');
	}

	public function rules(){
		return array(
			array('MERCHANT_ID', 'required'),
		);
	}

	public function attributeLabels(){
		return array(
			'MERCHANT_ID' => tt('MERCHANT_ID', 'payment'),
		);
	}

	public function processRequest(){
		$return = array(
			'id' => 0,
		);

		$payment = $_REQUEST["payment"];
		$lmiPaymentNo = (isset($_REQUEST["LMI_PAYMENT_NO"])) ? $_REQUEST["LMI_PAYMENT_NO"] : null;
		$lmiSysPaymentId = (isset($_REQUEST["LMI_SYS_PAYMENT_ID"])) ? $_REQUEST["LMI_SYS_PAYMENT_ID"] : '';

		if ($payment == 'success') {
			$return['id'] = $lmiPaymentNo;
			$return['result'] = $payment;
			$return['lmiSysPaymentId'] = $lmiSysPaymentId;
		}
		else {
			$return['id'] = $lmiPaymentNo;
			$return['result'] = $payment;
		}

		return $return;
	}

	public function echoSuccess(){
		if($_REQUEST["payment"] == 'result'){
			echo("OK". $_REQUEST["InvId"]."\n");
			Yii::app()->end();
		}
	}

	public function processPayment(Payments $payment){
		$workWithCurrency = self::workWithCurrency();

		if(!in_array($payment->currency_charcode, $workWithCurrency)){
			$currency = $workWithCurrency[0];

			$currencyName = $currency;

			if ($currency == 'RUB')
				$currencyName = 'RUR';
			$amount = round(Currency::convert($payment->amount, $payment->currency_charcode, $currencyName), 0);
		} else {
			$amount = $payment->amount;
			$currency = $payment->currency_charcode;
		}

		/*$currencyCodeArr = self::workWithCurrencyCode();
		$currencyCode = $currencyCodeArr[$currency];*/

		$description = Yii::t('module_payment', 'Paid service #{id} ({name}) with the price {price}',
			array('{id}'=>$payment->id, '{name}'=>$payment->paidservice->name, '{price}'=>$payment->amount . ' ' . $payment->currency_charcode));

		$url  = 'https://paymaster.ru/Payment/Init?';

		$data = array(
			'LMI_MERCHANT_ID' => $this->MERCHANT_ID,
			'LMI_PAYMENT_AMOUNT' => $amount,
			'LMI_CURRENCY' => $currency,
			//'LMI_CURRENCY' => $currencyCode,
			'LMI_PAYMENT_NO' => $payment->id,
			'LMI_PAYMENT_DESC' => $description,
			//'LMI_SIM_MODE' => 1, # Режим тестирования
			//'LMI_PAYER_PHONE_NUMBER' => ($payment->user_id && isset($payment->user) && isset($payment->user->phone) && $payment->user->phone) ? Sms::preparePhone($payment->user->phone) : "",
			//'LMI_PAYER_EMAIL' => ($payment->user_id && isset($payment->user) && isset($payment->user->email) && $payment->user->email) ? $payment->user->email : "",
			'LMI_PAYER_EMAIL' => Yii::app()->user->email,

		);

		$url .= http_build_query($data);

		Yii::app()->controller->redirect($url);
	}

	public function printInfo(){
		?>
		<br />
		<ul>
			<li><?php
				echo Yii::t('module_payment','Result URL: ').
					(Yii::app()->controller->createAbsoluteUrl('/payment/main/income',
						array(
							'sys' => 'paymaster',
							'payment' => 'result',
						))
					);
				?>
			</li>
			<li><?php
				echo Yii::t('module_payment','Success URL: ').
					(Yii::app()->controller->createAbsoluteUrl('/payment/main/income',
						array(
							'sys' => 'paymaster',
							'payment' => 'success',
						))
					);
				?>
			</li>
			<li><?php
				echo Yii::t('module_payment','Fail URL: ').
					(Yii::app()->controller->createAbsoluteUrl('/payment/main/income',
						array(
							'sys' => 'paymaster',
							'payment' => 'fail',
						))
					);
				?>
			</li>
		</ul>
	<?php
	}
}