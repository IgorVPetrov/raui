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

require_once dirname(dirname(__FILE__)) . '/services/MailruOAuthService.php';

class CustomMailruService extends MailruOAuthService {
	protected $jsArguments = array('popup' => array('width' => 750, 'height' => 450));
	protected $client_id = '';
	protected $client_secret = '';

	public function __construct() {
		$this->title = tt('mailru_label', 'socialauth');
	}

	protected function fetchAttributes() {
		$info = (array) $this->makeSignedRequest('http://www.appsmail.ru/platform/api', array(
				'query' => array(
					'uids' => $this->uid,
					'method' => 'users.getInfo',
					'app_id' => $this->client_id,
				),
			));

		$info = $info[0];

		$this->attributes['id'] = $info->uid;
		$this->attributes['firstName'] = $info->first_name;
		$this->attributes['email'] = $info->email;
		$this->attributes['mobilePhone'] = '';
		$this->attributes['homePhone'] = '';
		$this->attributes['url'] = $info->link;
		$this->attributes['photo'] = $info->pic_big;
	}

}