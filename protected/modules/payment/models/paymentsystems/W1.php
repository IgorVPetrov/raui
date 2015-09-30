<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class W1 extends PaymentSystem {
	public $merchant_id;
	public $secret_key;
	public $mode;

	private $result;
	private $description;

	public static function workWithCurrency() {
		return array('RUR');
	}

	public function rules() {
		return array(
			array('merchant_id, secret_key, mode', 'required'),
		);
	}

	public function attributeLabels() {
		return array(
			'merchant_id' => tt('MERCHANT_ID', 'payment'),
			'secret_key' => tt('Secret key', 'payment'),
			'mode' => tt('Mode', 'payment'),
		);
	}

	private function setEchoField($result, $description) {
		$this->result = $result;
		$this->description = $description;
	}

	public function processRequest() {
		$resultFail = array(
			'id' => 0,
			'result' => 'fail'
		);
		// Секретный ключ интернет-магазина (настраивается в кабинете)
		$skey = $this->secret_key;

		// Проверка наличия необходимых параметров в POST-запросе
		if (!isset($_POST["WMI_SIGNATURE"])) {
			$this->setEchoField("Retry", "Отсутствует параметр WMI_SIGNATURE");
			return $resultFail;
		}

		if (!isset($_POST["WMI_PAYMENT_NO"])) {
			$this->setEchoField("Retry", "Отсутствует параметр WMI_PAYMENT_NO");
			return $resultFail;
		}

		if (!isset($_POST["WMI_ORDER_STATE"])) {
			$this->setEchoField("Retry", "Отсутствует параметр WMI_ORDER_STATE");
			return $resultFail;
		}

		// Извлечение всех параметров POST-запроса, кроме WMI_SIGNATURE
		foreach ($_POST as $name => $value) {
			if ($name !== "WMI_SIGNATURE") {
				$params[$name] = $value;
			}
		}

		// Сортировка массива по именам ключей в порядке возрастания
		// и формирование сообщения, путем объединения значений формы
		uksort($params, "strcasecmp");
		$values = "";

		foreach ($params as $name => $value) {
			$value = iconv("utf-8", "windows-1251", $value);
			$values .= $value;
		}

		// Формирование подписи для сравнения ее с параметром WMI_SIGNATURE
		$signature = base64_encode(pack("H*", md5($values . $skey)));

		//Сравнение полученной подписи с подписью W1
		if ($signature == $_POST["WMI_SIGNATURE"]) {
			if (strtoupper($_POST["WMI_ORDER_STATE"]) == "ACCEPTED") {
				$resultSuccess = array(
					'id' => $_POST["WMI_PAYMENT_NO"],
					'result' => 'success'
				);

				$this->setEchoField("Ok", "Заказ #" . $_POST["WMI_PAYMENT_NO"] . " оплачен!");
				return $resultSuccess;
			} else {
				// Случилось что-то странное, пришло неизвестное состояние заказа

				$this->setEchoField("Retry", "Неверное состояние " . $_POST["WMI_ORDER_STATE"]);
			}
		} else {
			// Подпись не совпадает, возможно вы поменяли настройки интернет-магазина

			$this->setEchoField("Retry", "Неверная подпись " . $_POST["WMI_SIGNATURE"]);
		}

		return $resultFail;
	}

	public function echoSuccess() {
		print "WMI_RESULT=" . strtoupper($this->result) . "&";
		print "WMI_DESCRIPTION=" . urlencode($this->description);
		exit();
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

		//Секретный ключ интернет-магазина
		$key = $this->secret_key;

		$description = Yii::t('module_payment', 'Paid service #{id} ({name}) with the price {price}',
			array('{id}' => $payment->id, '{name}' => $payment->paidservice->name, '{price}' => $payment->amount . ' ' . $payment->currency_charcode));

		$fields = array();

		// Добавление полей формы в ассоциативный массив
		$fields["WMI_MERCHANT_ID"] = $this->merchant_id;
		$fields["WMI_PAYMENT_AMOUNT"] = $amount;
		$fields["WMI_CURRENCY_ID"] = "643"; // RUR
		$fields["WMI_PAYMENT_NO"] = $payment->id;
		//$fields["WMI_DESCRIPTION"] = "BASE64:" . base64_encode($description);
		$fields["WMI_DESCRIPTION"] = "BASE64:" . base64_encode($this->transliterate($description));
		//$fields["WMI_DESCRIPTION"] = $this->transliterate($description);
		//$fields["WMI_EXPIRED_DATE"] = "2019-12-31T23:59:59";
		$fields["WMI_SUCCESS_URL"] = Yii::app()->controller->createAbsoluteUrl('/payment/main/income', array(
			'sys' => 'w1',
			'payment' => 'success',
		));
		$fields["WMI_FAIL_URL"] = Yii::app()->controller->createAbsoluteUrl('/payment/main/income', array(
			'sys' => 'w1',
			'payment' => 'fail',
		));
		;
		//Если требуется задать только определенные способы оплаты, раскоментируйте данную строку и перечислите требуемые способы оплаты.
		//$fields["WMI_PTENABLED"] = array("ContactRUB", "UnistreamRUB", "SberbankRUB", "RussianPostRUB");

		//Сортировка значений внутри полей
		foreach ($fields as $name => $val) {
			if (is_array($val)) {
				usort($val, "strcasecmp");
				$fields[$name] = $val;
			}
		}

		// Формирование сообщения, путем объединения значений формы,
		// отсортированных по именам ключей в порядке возрастания.
		uksort($fields, "strcasecmp");
		$fieldValues = "";

		foreach ($fields as $value) {
			if (is_array($value)) {
				foreach ($value as $v) {
					//Конвертация из текущей кодировки (UTF-8)
					//необходима только если кодировка магазина отлична от Windows-1251
					$v = iconv("utf-8", "windows-1251", $v);
					$fieldValues .= $v;
				}
			} else {
				//Конвертация из текущей кодировки (UTF-8)
				//необходима только если кодировка магазина отлична от Windows-1251
				$value = iconv("utf-8", "windows-1251", $value);
				$fieldValues .= $value;
			}
		}

		// Формирование значения параметра WMI_SIGNATURE, путем
		// вычисления отпечатка, сформированного выше сообщения,
		// по алгоритму MD5 и представление его в Base64
		$signature = base64_encode(pack("H*", md5($fieldValues . $key)));

		//Добавление параметра WMI_SIGNATURE в словарь параметров формы

		$fields["WMI_SIGNATURE"] = $signature;

		// Формирование HTML-кода платежной формы
		$form = '<html>';
		$form .= '<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">';
		$form .= '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.js"></script>';
		$form .= '<body>';
		$form .= '<h3>' . $payment->paidservice->name . '</h3>
        <p><strong>' . tc('Cost of service') . ': ' . $payment->amount . ' ' . $payment->currency_charcode . '</strong></p>
        <p><strong id="notice_mess"></strong></p>
		';
		$form .= '<form id="w1_form" method="post" action="https://www.walletone.com/checkout/default.aspx" accept-charset="UTF-8">';

		foreach ($fields as $key => $val) {
			if (is_array($val)) {
				foreach ($val as $value) {
					$form .= "<input type=\"hidden\" name=\"$key\" value=\"$value\"/>\n";
				}
			} else {
				$form .= "<input type=\"hidden\" name=\"$key\" value=\"$val\"/>\n";
			}
		}

		$form .= '<input id="submit_w1_form" type="submit" value="' . tt('Pay Now', 'payment') . '"/></form>';

		$form .= '
		<script type="text/javascript">
        $(document).ready(function(){
            $("#notice_mess").html("' . tt('Please_wait_payment_W1', 'payment') . '");
            $("#submit_w1_form").attr("disabled", "disabled");
            $("#w1_form").submit();
        });
        </script>
		';
		$form .= '</body>';
		$form .= '</html>';

		echo $form;
		exit;
	}

	public function transliterate($str) {
		$str = strip_tags($str);

		$foreign_characters = array(
			'/ä|æ|ǽ/' => 'ae',
			'/ö|œ/' => 'oe',
			'/ü/' => 'ue',
			'/Ä/' => 'Ae',
			'/Ü/' => 'Ue',
			'/Ö/' => 'Oe',
			'/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ|А/' => 'A',
			'/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª|а/' => 'a',
			'/Б/' => 'B',
			'/б/' => 'b',
			'/Ç|Ć|Ĉ|Ċ|Č|Ц/' => 'C',
			'/ç|ć|ĉ|ċ|č|ц/' => 'c',
			'/Ð|Ď|Đ|Д/' => 'D',
			'/ð|ď|đ|д/' => 'd',
			'/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě|Е|Ё|Э/' => 'E',
			'/è|é|ê|ë|ē|ĕ|ė|ę|ě|е|ё|э/' => 'e',
			'/Ф/' => 'F',
			'/ф/' => 'f',
			'/Ĝ|Ğ|Ġ|Ģ|Г/' => 'G',
			'/ĝ|ğ|ġ|ģ|г/' => 'g',
			'/Ĥ|Ħ|Х/' => 'H',
			'/ĥ|ħ|х/' => 'h',
			'/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ|И/' => 'I',
			'/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı|и/' => 'i',
			'/Ĵ|Й/' => 'J',
			'/ĵ|й/' => 'j',
			'/Ķ|К/' => 'K',
			'/ķ|к/' => 'k',
			'/Ĺ|Ļ|Ľ|Ŀ|Ł|Л/' => 'L',
			'/ĺ|ļ|ľ|ŀ|ł|л/' => 'l',
			'/М/' => 'M',
			'/м/' => 'm',
			'/Ñ|Ń|Ņ|Ň|Н/' => 'N',
			'/ñ|ń|ņ|ň|ŉ|н/' => 'n',
			'/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ|О/' => 'O',
			'/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º|о/' => 'o',
			'/П/' => 'P',
			'/п/' => 'p',
			'/Ŕ|Ŗ|Ř|Р/' => 'R',
			'/ŕ|ŗ|ř|р/' => 'r',
			'/Ś|Ŝ|Ş|Š|С/' => 'S',
			'/ś|ŝ|ş|š|ſ|с/' => 's',
			'/Ţ|Ť|Ŧ|Т/' => 'T',
			'/ţ|ť|ŧ|т/' => 't',
			'/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ|У/' => 'U',
			'/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ|у/' => 'u',
			'/В/' => 'V',
			'/в/' => 'v',
			'/Ý|Ÿ|Ŷ|Ы/' => 'Y',
			'/ý|ÿ|ŷ|ы/' => 'y',
			'/Ŵ/' => 'W',
			'/ŵ/' => 'w',
			'/Ź|Ż|Ž|З/' => 'Z',
			'/ź|ż|ž|з/' => 'z',
			'/Æ|Ǽ/' => 'AE',
			'/ß/'=> 'ss',
			'/Ĳ/' => 'IJ',
			'/ĳ/' => 'ij',
			'/Œ/' => 'OE',
			'/ƒ/' => 'f',
			'/Ч/' => 'Ch',
			'/ч/' => 'ch',
			'/Ю/' => 'Ju',
			'/ю/' => 'ju',
			'/Я/' => 'Ja',
			'/я/' => 'ja',
			'/Ш/' => 'Sh',
			'/ш/' => 'sh',
			'/Щ/' => 'Shch',
			'/щ/' => 'shch',
			'/Ж/' => 'Zh',
			'/ж/' => 'zh',
			'/ь/' => '',
			'/№/' => 'N ',
			'/#/' => 'N ',
		);

		$str = preg_replace(array_keys($foreign_characters), array_values($foreign_characters), $str);

		return $str;
	}

	public function printInfo(){
		?>
		<br />
		<ul>
			<li><?php
				echo Yii::t('module_payment','Result URL: ').
					(Yii::app()->controller->createAbsoluteUrl('/payment/main/income',
						array(
							'sys' => 'w1',
							'payment' => 'result',
						))
					);
				?>
			</li>
		</ul>
	<?php
	}
}