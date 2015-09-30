<?php
class VKAutoPosting {
	private $access_token;
	private $url = "https://api.vk.com/method/";

	public function __construct($access_token) {
		$this->access_token = $access_token;
	}

	public function method($method, $params = null) {

		$p = "";
		if( $params && is_array($params) ) {
			foreach($params as $key => $param) {
				$p .= ($p == "" ? "" : "&") . $key . "=" . urlencode($param);
			}
		}
		$response = file_get_contents($this->url . $method . "?" . ($p ? $p . "&" : "") . "access_token=" . $this->access_token);

		if (!$response) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->url . $method . "?" . ($p ? $p . "&" : "") . "access_token=" . $this->access_token);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$response = curl_exec($ch);
			curl_close($ch);
		}

		if( $response ) {
			return json_decode($response);
		}
		return false;
	}
}