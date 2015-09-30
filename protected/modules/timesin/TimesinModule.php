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

class TimesinModule extends Module{
	function init(){
		Yii::import('application.modules.booking.models.TimesIn');
		parent::init();
	}
}
