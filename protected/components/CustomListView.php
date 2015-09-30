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

Yii::import('bootstrap.widgets.TbListView');

class CustomListView extends TbListView {
	//public $pager=array('class'=>'itemPaginator');
	public $template="{pager}\n{sorter}\n{items}";

	public $type = 'striped bordered condensed';
}
