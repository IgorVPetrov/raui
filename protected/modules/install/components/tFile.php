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

class tFile {
    public static function getT($category,$message,$language=null) {
		return Yii::t($category, $message, array(), 'messagesInFile', $language);
    }
}