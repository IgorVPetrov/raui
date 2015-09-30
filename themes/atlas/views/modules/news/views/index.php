<?php
$this->pageTitle .= ' - '.NewsModule::t('News');
$this->breadcrumbs=array(
    NewsModule::t('News'),
);
?>


        <!-- Slider main -->
        <section class="slider  container-full">
            <div id="slider-main" class="carousel slide carousel-fade">
                <div class="carousel-inner">
                    <div class="active item">
                        <img src="/themes/atlas/temp/images/slides/slide-10.png">
                    </div>
                    <div class="item">
                        <img src="/themes/atlas/temp/images/slides/slide-4.png">
                    </div>
                </div>
            </div>
        </section>


<!--<h1 class="title highlight-left-right">
	<span>
		<?php echo NewsModule::t('News'); ?>
	</span>
</h1>-->


 <!-- News -->
        <section class="container-full">
            <div id="news">
                <div id="filter-nav" class="filter-options">
                    <button class="btn btn-filter active" data-group="all">Все новости</button>
                    <button class="btn btn-filter" data-group="market-property">Рынок недвижимости</button>
                    <button class="btn btn-filter" data-group="around-world">Вокруг света</button>
                    <button class="btn btn-filter" data-group="moscow-region">Москва и область</button>
                    <button class="btn btn-filter" data-group="questions">Вопросы права</button>
                </div>
                

<?php
$this->renderPartial('widgetNews_list', array(
	'news' => $items,
	'pages' => $pages,
));
?>
				
                
                <div class="pull-right right-sidebar">
                    <?php if(issetModule('advertising')) :?>
						<?php $this->renderPartial('//modules/advertising/views/advert-top', array());?>
					<?php endif; ?>
                    <div class="best-agents">
                        <h2>НАШИ ЛУЧШИЕ АГЕНТЫ</h2>

			  <?php $this->widget('application.modules.users.components.userWidget', array('criteria' => $criteria,'type'=>array(1,2,3),'limit'=>3, 'viev'=>'block')); ?>

	
                    </div>
                </div>
                <div class="load-more"><i></i></div>
            </div>
        </section>

