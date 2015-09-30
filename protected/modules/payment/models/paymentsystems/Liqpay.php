<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class Liqpay extends PaymentSystem {
    public $merchant_id;
    public $merchant_sig;

    public static function workWithCurrency() {
        return array('UAH','RUR','USD');
    }

    public function rules() {
        return array(
            array('merchant_id, merchant_sig', 'required'),
        );
    }

    public function attributeLabels() {
        return array(
            'merchant_id' => tt('Номер мерчанта merchant_id', 'payment'),
            'merchant_sig' => tt('Подпись{пароль} мерчанта merchant_sig', 'payment'),
            'mode' => tt('Mode', 'payment'),
        );
    }

    public function processRequest() {
        $result = array(
            'id' => 0,
            'result' => 'fail'
        );

        if(isset($_POST['operation_xml'])){
            $xml_decoded = base64_decode($_POST['operation_xml']);

            $xml = @simplexml_load_string($xml_decoded);

            if($xml && $xml->status == 'success' && $xml->order_id){
                $result['id'] = (int) $xml->order_id;
                $result['result'] = 'success';
            }
        }

        return $result;
    }

    public function echoSuccess() {

    }


    public function processPayment(Payments $payment) {

        $workWithCurrency = self::workWithCurrency();
        if (!in_array($payment->currency_charcode, $workWithCurrency)) {
            $currency = $workWithCurrency[0];
            $amount = round(Currency::convert($payment->amount, $payment->currency_charcode, $currency), 0);
        } else {
            $amount = $payment->amount;
            $currency = $payment->currency_charcode;
        }

        $description = Yii::t('module_payment', 'Paid service #{id} ({name}) with the price {price}',
            array('{id}' => $payment->id, '{name}' => $payment->paidservice->name, '{price}' => $payment->amount . ' ' . $payment->currency_charcode));

        $xml="<request>
              <version>1.2</version>
              <merchant_id>".$this->merchant_id."</merchant_id>
              <result_url>".Yii::app()->controller->createAbsoluteUrl('/payment/main/income', array('only_return' => 1))."</result_url>
              <server_url>".Yii::app()->controller->createAbsoluteUrl('/payment/main/income', array('sys' => 'liqpay'))."</server_url>
              <order_id>".$payment->id."</order_id>
              <amount>{$amount}</amount>
              <currency>{$currency}</currency>
              <description>{$description}</description>
              <default_phone></default_phone>
              <pay_way>card</pay_way>
              <goods_id>".$payment->id."</goods_id>
        </request>";

        $sign = base64_encode(sha1($this->merchant_sig.$xml.$this->merchant_sig, 1));
        $xml_encoded=base64_encode($xml);

        // Формирование HTML-кода платежной формы
		$form = '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.js"></script>';
        $form .= '<h3>' . $payment->paidservice->name . '</h3>
        <p><strong>' . tc('Cost of service') . ': ' . $payment->amount . ' ' . $payment->currency_charcode . '</strong></p>
        <p><strong id="notice_mess"></strong></p>
		';
        $form .= '<form id="payment_form" action="https://www.liqpay.com/?do=clickNbuy" method="POST">';
        $form .= '<input type="hidden" name="operation_xml" value="'.$xml_encoded.'" />
                  <input type="hidden" name="signature" value="'.$sign.'" />';
        $form .= '<input id="submit_payment_form" type="submit" value="' . tt('Pay Now', 'payment') . '"/></form>';

        $form .= '
		<script type="text/javascript">
        $(document).ready(function(){
            $("#notice_mess").html("' . tt('Please_wait_payment_Liqpay', 'payment') . '");
            $("#submit_payment_form").attr("disabled", "disabled");
            $("#payment_form").submit();
        });
        </script>
		';

        echo $form;
		exit;
    }

    public function printInfo(){

    }

}