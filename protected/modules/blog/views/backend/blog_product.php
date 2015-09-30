<?php
$this->pageTitle .= ' - '.BlogModule::t('Blog product');
$this->breadcrumbs=array(
	BlogModule::t('Blog product'),
);
$this->menu = array(
	array(),
);
$this->adminTitle = BlogModule::t('Blog product');

if ($items) {
	if($pages){
		echo '<div class="clear">&nbsp;</div>';
			echo '<div class="pagination">';
			$this->widget('itemPaginator',array('pages' => $pages, 'header' => '', 'showHidden' => true));
			echo '</div>';
		echo '<div class="clear">&nbsp;</div>';
	}

	foreach ($items as $item){
		echo '<div class="blog-items">';
			echo '<p><font class="date">'.$item->pubDate.'</font></p>';
			//echo CHtml::link($item->title, $item->getUrl(), array('class'=>'title'));
			echo '<p><font class="title">'.$item->title.'</font></p>';
			echo '<p class="desc">';
			echo $item->description;
			echo '</p>';
			echo '<p>';
			echo CHtml::link(BlogModule::t('Read more &raquo;'), $item->link);
			echo '</p>';
		echo '</div>';

		if($item->is_show == 0){
			$item->is_show = 1;
			$item->update('is_show');
		}
	}
}

if(!$items){
	echo BlogModule::t('Blog list is empty.');
}

if($pages){
	echo '<div class="clear">&nbsp;</div>';
		echo '<div class="pagination">';
			$this->widget('itemPaginator',array('pages' => $pages, 'header' => '', 'showHidden' => true));
		echo '</div>';
	echo '<div class="clear">&nbsp;</div>';
}
?>