<form id="search-form" class="forma" action="<?php echo Yii::app()->controller->createUrl('/quicksearch/main/mainsearch');?>" method="get">

<ul>

	  <li><a href="/page/poisk" class="filter-search-btn"></a></li>

				<?php $this->renderPartial('//site/_bt_search_form', array('isInner' => 0)); ?>
          
     <!-- <li><span id="btnleft" class="index-btnsrch link_blue"></span></li>  -->        
	  <li><input type="submit" class="search-housing-btn" value=""></li>
          
</ul>

</form>

<?php
$content = $this->renderPartial('//site/_search_js', array(
	'isInner' => 0
	),
	true,
	false
);
//Yii::app()->clientScript->registerScript('search-params-index-search', $content, CClientScript::POS_HEAD, array(), true);
Yii::app()->clientScript->registerScript('search-params-index-search', $content, CClientScript::POS_END);
?>



