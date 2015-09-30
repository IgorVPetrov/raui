<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

Yii::import('bootstrap.widgets.TbGridView');

class CustomGridView extends TbGridView {
	//public $pager = array('class'=>'itemPaginator');
	public $template = "{summary}\n{pager}\n{items}\n{pager}";

    public $type = 'striped bordered condensed';

	public $pager = array('class'=>'bootstrap.widgets.TbPager', 'displayFirstAndLast' => true);

}