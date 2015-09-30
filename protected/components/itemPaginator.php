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

class itemPaginator extends CLinkPager {
	public $htmlOption = array();
	public $showHidden = false;

	public function init(){
		$this->cssFile = Yii::app()->theme->baseUrl.'/css/pager.css';
		parent::init();
	}

	protected function createPageButton($label,$page,$class,$hidden,$selected)
	{
		if($hidden || $selected) {
			if ($this->showHidden) {
				$class.=' '.self::CSS_SELECTED_PAGE;
			}
			else {
				$class.=' '.($hidden ? self::CSS_HIDDEN_PAGE : self::CSS_SELECTED_PAGE);
			}
		}
		if ($hidden) {
			return '<li class="'.$class.'">'.CHtml::link($label, 'javascript: void(0);'/*, $this->htmlOption*/).'</li>';
		}
		else
			return '<li class="'.$class.'">'.CHtml::link($label,$this->createPageUrl($page), $this->htmlOption).'</li>';
	}
}