<?php
$this->pageTitle .= ' - '.BlogModule::t('Blog');
$this->breadcrumbs=array(
    BlogModule::t('Blog'),
);
?>


        <!-- Slider main -->
        <section class="slider  container-full">
            <div id="slider-main" class="carousel slide carousel-fade">
                <div class="carousel-inner">
                    <div class="active item">
                        <img src="/themes/atlas/temp/images/slides/slide-1.png">
                    </div>
                    <div class="item">
                        <img src="/themes/atlas/temp/images/slides/slide-2.png">
                    </div>
                </div>
            </div>
        </section>


<!--<h1 class="title highlight-left-right">
	<span>
		<?php echo BlogModule::t('Blog'); ?>
	</span>
</h1>-->


 <!-- Blog -->
        <section class="blog container-full">
            <h2>ИНВЕСТИЦИИ В НЕДВИЖИМОСТЬ</h2>
            <div class="sort-articles sort-options">
                <span>Сортировать:</span>
                <button id="popularity" value="popularity">по популярности</button>
                <button id="date-created" value="date-created">по новизне</button>
            </div>
   
                

<?php
$this->renderPartial('widgetBlog_list', array(
	'blog' => $items,
	'pages' => $pages,
));
?>
				
                
                <div class="articles-sidebar pull-right">
                
                <div class="filter-options">
                    <button class="btn btn-filter" data-group="analytics">Аналитика и обзоры</button>
                    <hr/>
                    <button class="btn btn-filter" data-group="architecture">Архитектура и дизайн</button>
                    <hr/>
                    <button class="btn btn-filter" data-group="investment">Инвестиции</button>
                    <hr/>
                    <button class="btn btn-filter" data-group="company">Компании</button>
                    <hr/>
                    <button class="btn btn-filter" data-group="best">Лучшие предложения</button>
                    <hr/>
                    <button class="btn btn-filter" data-group="news">Новости рынка</button>
                </div>
                
                
                    <?php if(issetModule('advertising')) :?>
						<?php $this->renderPartial('//modules/advertising/views/advert-top', array());?>
					<?php endif; ?>
                    
                    
                    
                    <div class="latest-ads-vr">
                    <h5>Последние объявления</h5>

			  <?php $this->widget('application.modules.users.components.userWidget', array('criteria' => $criteria,'type'=>array(1,2,3),'limit'=>3, 'viev'=>'block')); ?>

	
                    </div>
                </div>
               
            
        </section>

