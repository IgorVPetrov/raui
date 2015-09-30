<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class BlogWidget extends CWidget {

	public $usePagination = 1;

	public function getViewPath($checkTheme=true){
		if($checkTheme && ($theme=Yii::app()->getTheme())!==null){
			if (is_dir($theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'blog'.DIRECTORY_SEPARATOR.'views'))
				return $theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'blog'.DIRECTORY_SEPARATOR.'views';
		}
		return Yii::getPathOfAlias('application.modules.blog.views');
	}

	public function run() {
		$blog = new Blog;
		$result = $blog->getAllWithPagination();

		$this->render('widgetBlog_list', array(
			'blog' => $result['items'],
			'pages' => $result['pages'],
		));
	}
}