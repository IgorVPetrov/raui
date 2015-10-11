<?php
$this->pageTitle .= ' - '. $model->getStrByLang('title');
$page = (isset($_GET) && isset($_GET['page'])) ? ($_GET['page']) : '';

if (isset($model->menuPageOne) && isset($model->menuPageOne->parent) && $model->menuPageOne->parent && $model->menuPageOne->parent->type == Menu::LINK_NEW_INFO) {
	$this->breadcrumbs = array(
		truncateText($model->menuPageOne->parent->getStrByLang('title'), 10) => $model->menuPageOne->parent->getUrl(),
		truncateText($model->getStrByLang('title'), 10),
	);
}
else {
	$this->breadcrumbs=array(
		truncateText($model->getStrByLang('title'), 10),
	);
}
?>


<!--Убираем заголовок
<h1 class="title highlight-left-right">
	<span><?php echo $model->getStrByLang('title');?></span>
</h1>
<div class="clear"></div><br />
!Убираем заголовок-->

<!--Выводи банер-->

<section class="slider  container-full">
<div class="carousel slide carousel-fade" id="slider-main">
<div class="carousel-inner">
<div class="active item">
<?php if($model->getStrByLang('title')=='Тарифы'):?>
<img src="/themes/atlas/temp/images/slides/rates.png" />
<?php elseif($model->getStrByLang('title')=='Контакты'): ?>
<img src="/themes/atlas/temp/images/slides/slide-contacts.png" />
<?php elseif($model->getStrByLang('title')=='Новости'): ?>
<img src="/themes/atlas/temp/images/slides/slide-10.png" />
<?php elseif($model->getStrByLang('title')=='Вакансии'): ?>
<img src="/themes/atlas/temp/images/slides/slide-vacancies.png" />
<?php elseif($model->getStrByLang('title')=='Журнал'): ?>
<img src="/themes/atlas/temp/images/slides/slide-1.png" />
<?php elseif($model->getStrByLang('title')=='О нас'): ?>
<img src="/themes/atlas/temp/images/slides/slide-about-us.png" />
<div class="slider-text"><h2>РАУИ</h2><h3>мегапортал недвижимости</h3></div>
<?php elseif($model->getStrByLang('title')=='Элитное жилье'): ?>
<img src="/themes/atlas/temp/images/slides/slide-9.png" />
<?php elseif($model->getStrByLang('title')=='Новостройки'): ?>
<img src="/themes/atlas/temp/images/slides/slide-8.png" />
<?php endif;?>
</div>
</div>
</div>

<?php if($model->getStrByLang('title')=='Элитное жилье'): ?>
<h2 class="title-luxury-housing">ЭЛИТНОЕ  ЖИЛЬЁ</h2>
<?php elseif($model->getStrByLang('title')=='Новостройки'): ?>
<h2 class="title-full-new-building">ПОИСК  НОВОСТРОЕК  ПО  РЕГИОНУ  МОСКВА И МОСКОВСКЯ ОБЛАСТЬ</h2>
<?php endif;?>

</section>

<!--!Выводим банер-->


<?php if($model->getStrByLang('title')=='Новостройки' || $model->getStrByLang('title')=='Элитное жилье'): ?>

<?php $this->renderPartial('_view_widget_map', array('model' => $model)); ?>

<?php endif;?>




<?php if(!($model->getStrByLang('title')=='Новостройки' || $model->getStrByLang('title')=='Элитное жилье')): ?>
<?php if ($model->widget && $model->widget_position == InfoPages::POSITION_TOP){
    $this->renderPartial('_view_widget', array('model' => $model));
    echo '<div class="clear"></div>';
}
?>
<?php endif;?>

<?php if(!$page):?>
	<?php echo $model->body; ?>
<?php endif;?>


<?php if($model->getStrByLang('title')=='Тарифы'):?>
        <!-- Latest ads -->
        <section class="latest-ads container-full">
            <h2>ПОСЛЕДНИЕ ДОБАВЛЕННЫЕ ОБЪЯВЛЕНИЯ</h2>
            
              <div id="latest-ads" class="carousel slide">
                <div class="carousel-inner">
            		
                    
            <?php $this->widget('application.modules.apartments.components.ApartmentsWidgetHome', array(
    'criteria' => $criteria,
));
?>
<ol class="carousel-indicators">
                        <li data-target="#latest-ads" data-slide-to="0" class="active"></li>
                        <li data-target="#latest-ads" data-slide-to="1"></li>
                        <li data-target="#latest-ads" data-slide-to="2"></li>
</ol>
					
                  </div>
                </div>
            
        </section>
<?php endif;?>


<?php
	/*if (isset($model->menuPage) && $model->menuPage) {
		foreach ($model->menuPage as $menuPage) {
			$levelItem = $menuPage->getItemLevel();

			if ($levelItem == 2 && isset($menuPage->activeChilds) && $menuPage->activeChilds) {
				echo '<div class="block-childs-links">';
					echo '<ul>';
						foreach($menuPage->activeChilds as $childs) {
							if ($childs->getTitle()) {
								echo '<li>'.CHtml::link($childs->getTitle(), $childs->getUrl()).'</li>';
							}
						}
						echo '</ul>';
					echo '</div>';
				echo '<div class="clear">&nbsp;</div>';
			}
		}
	}*/
?>

<?php

if ($model->widget && $model->widget_position == InfoPages::POSITION_BOTTOM){
    $this->renderPartial('_view_widget', array('model' => $model));
}

if(param('enableCommentsForPages', 1)){ ?>
<div id="comments">
	<?php
		$this->widget('application.modules.comments.components.commentListWidget', array(
			'model' => $model,
			'url' => $model->getUrl(),
			'showRating' => false,
		));
	?>
</div>
<?php } ?>