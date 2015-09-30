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

class TimesoutModule extends Module{
	function init(){
		Yii::import('application.modules.booking.models.TimesOut');
		parent::init();
	}
}
