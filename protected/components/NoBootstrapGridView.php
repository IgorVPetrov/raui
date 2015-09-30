<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */


Yii::import('zii.widgets.grid.CGridView');

class NoBootstrapGridView extends CGridView {
	public $template="{summary}\n{pager}\n{items}\n{pager}";

	public function init() {
		$this->pager = array(
			'class'=>'itemPaginator'
		);

		if(Yii::app()->theme->name == 'atlas'){
			$this->pager = array(
				'class'=>'itemPaginatorAtlas',
				'header' => '',
				'selectedPageCssClass' => 'current',
				'htmlOptions' => array(
					'class' => ''
				)
			);

			$this->pagerCssClass = 'pagination';
		}
		parent::init();
	}
}