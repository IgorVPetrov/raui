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

Yii::import('ext.groupgridview.BootGroupGridView');

class CustomBootStrapGroupGridView extends BootGroupGridView {
	//public $pager = array('class'=>'objectPaginator');
	public $template = "{summary}\n{pager}\n{items}\n{pager}";

	//public $extraRowColumns = array('reference_category_id');
	public $mergeType = 'nested';

	public $type = 'striped bordered condensed';

	public $pager = array('class'=>'bootstrap.widgets.TbPager', 'displayFirstAndLast' => true);
}