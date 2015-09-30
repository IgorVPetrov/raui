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
class CustomEventHandler {
    static function handleMissingTranslation($event) {
        if( in_array($event->category, array('YiiDebug.yii-debug-toolbar', 'yii-debug-toolbar')) ){
            return false;
        }
        TranslateMessage::missingTranslation($event->category, $event->message);
    }
}