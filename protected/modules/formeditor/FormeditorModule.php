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

class FormeditorModule extends Module {
    public function init(){
        Yii::import('application.modules.formdesigner.models.*');

        parent::init();
    }
}