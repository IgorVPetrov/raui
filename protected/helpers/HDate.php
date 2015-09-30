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


class HDate {
    public static function formatDateTime($dateTime, $format = 'default'){
        $dateFormat = param('dateFormat', 'd.m.Y H:i:s');

        if($format == 'default'){
            return date($dateFormat, strtotime($dateTime));
        } else {
            return Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('long'), CDateTimeParser::parse($dateTime, 'yyyy-MM-dd hh:mm:ss'));
        }
    }

    public static function formatForDatePicker($time){
        if(Yii::app()->language != 'ru'){
            return date('m/d/Y', $time);
        } else {
            return Yii::app()->dateFormatter->formatDateTime($time, 'medium', null);
        }
    }
}