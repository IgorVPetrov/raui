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

Yii::import('ext.selgridview.BootSelGridView');

class CustomHistoryGridView extends BootSelGridView {
	//public $pager = array('class'=>'itemPaginator');
	public $template = "{summary}\n{pager}\n{items}\n{pager}";

	public $type = 'striped bordered condensed';
}