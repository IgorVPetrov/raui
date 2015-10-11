<?php $this->beginContent('//layouts/main'); ?>

    <div class="base-screen">
        <div class="new-nav-wrap">
            <ul>
                <li>
                    <a href="/page/o-nas">
                        <div class="nav-title">О Нас</div>
                        <div class="nav-icon about-icon"></div>
                    </a>
                </li>
                <li>
                    <a href="/news">
                        <div class="nav-title">Новости</div>
                        <div class="nav-icon news-icon"></div>
                    </a>
                </li>
                <li>
                    <a href="/page/tarify">
                        <div class="nav-title">Тарифы</div>
                        <div class="nav-icon tarif-icon"></div>
                    </a>
                </li>
                <li>
                    <a href="/page/elitnoe-zhile">
                        <div class="nav-title">Элитное жильё</div>
                        <div class="nav-icon viphouse-icon"></div>
                    </a>
                </li>
                <li>
                    <a href="/page/novostrojki">
                        <div class="nav-title">Новостройки</div>
                        <div class="nav-icon newbuild-icon"></div>
                    </a>
                </li>
                <li>
                    <a href="/blog">
                        <div class="nav-title">Журнал</div>
                        <div class="nav-icon jurnal-icon"></div>
                    </a>
                </li>
                <li>
                    <a href="/vacancy">
                        <div class="nav-title">Вакансии</div>
                        <div class="nav-icon vacancies-icon"></div>
                    </a>
                </li>
                <li>
                    <a href="/page/kontakty">
                        <div class="nav-title">Контакты</div>
                        <div class="nav-icon contacts-icon"></div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="new-map-container">

        <div class="map" style="width: 1260px; margin:0 0 0 20px;">
            <?php $this->widget('application.modules.viewallonmap.components.ViewallonmapWidget', array('criteria' => $criteriaForMap, 'filterOn' => false, 'withCluster' => true)); ?>
        </div>

    </div>

        <!-- Latest ads -->
        <section class="latest-ads container-full">
            <h2>ПОСЛЕДНИЕ ДОБАВЛЕННЫЕ ОБЪЯВЛЕНИЯ</h2>
            
              <div id="latest-ads" class="carousel slide">
                <div class="carousel-inner">
            		
                    
            <?php $this->widget('application.modules.apartments.components.ApartmentsWidgetHome', array('criteria' => $criteria,)); ?>

<ol class="carousel-indicators">
                        <li data-target="#latest-ads" data-slide-to="0" class="active"></li>
                        <li data-target="#latest-ads" data-slide-to="1"></li>
                        <li data-target="#latest-ads" data-slide-to="2"></li>
</ol>
					
                  </div>
                </div>
            
        </section>

        <!-- Latest application -->
        <section class="latest-application container-full">
            <h2 class="text-center">ПОСЛЕДНИЕ РАЗМЕЩЁННЫЕ ЗАЯВКИ</h2>           
           <?php  $this->widget('application.modules.apartments.components.ApartmentsWidgetTable', array('criteria' => $criteria,'bt_param'=>'latest-app-tb-right')); ?>
        </section>

        <!-- Slider partnership -->
        <section class="slider-partnership container-full">
            <div id="slider-partnership" class="carousel slide">
                <div class="carousel-inner">
                    <div class="active item">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/temp/images/slides/slide-prtn-1.png">
                        <div class="carousel-caption">
                            <div class="pull-left">
                                <a href="/page/kontakty">
                                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/temp/images/silk-slider-partners.png">
                                </a>
                            </div>
                            <div class="pull-right text-right">
                                <h3>ПАРТНЁРСТВО ДЛЯ ПРОФЕССИОНАЛОВ</h3>
                                <p>
                                    Если Вы - профессиональный риелтор, агент или агентство по недвижимости,<br>
                                    мы предлагаем Вам расширить рамки взаимоотношений и расти вместе.<br>
                                    Станьте нашим партнёром и переходите на новый уровень ведения бизнеса!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/temp/images/slides/slide-prtn-2.png">
                        <div class="carousel-caption">
                            <div class="pull-left text-left">
                                <h3>НЕДВИЖИМОСТЬ  ЗА  РУБЕЖОМ</h3>
                                <p>
                                    Информация об аренде и продаже недвижимости вне России<br>
                                    теперь доступна для всех пользователей нашего портала:<br>
                                    просто задайте инетересующую Вас страну в параметрах поиска!
                                </p>
                            </div>
                            <div class="pull-right">
                                <a href="search_results.html">
                                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/temp/images/silk-slider-abroad.png">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Best agency and agents -->
        <section class="best-agency-agents container-full">
            <h2>ЛУЧШИЕ АГЕНТЫ И АГЕНТСТВА ВАШЕГО РЕГИОНА</h2>
            
            <?php $this->widget('application.modules.users.components.userWidget', array('criteria' => $criteria,'type'=>array(1,2,3), 'viev'=>'slider')); ?>
            
            <a href="catalog_agents.html" class="all-catalog-agents"><i></i>ПОЛНЫЙ КАТАЛОГ РИЕЛТОРОВ</a>
        </section>

        <!-- Slider menu -->
        <section class="slider-partnership container-full">
            <div id="slider-menu" class="carousel slide">
                <div class="carousel-inner">
                    <div class="active item">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/temp/images/slides/slide-menu.png">
                        <div class="carousel-caption">
                            <div class="pull-left">
                                <a href="/blog">
                                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/temp/images/silk-slider-design.png">
                                </a>
                            </div>
                            <div class="pull-right design-text">
                                <h3>ДИЗАЙН И СТИЛЬ</h3>
                                <p>
                                    Дом давно перестал быть местом, где человек может укрыться от опасностей окружающего мира.<br>
                                    Дом перестал быть лишь местом ночлега, приёма пищи и хранения личных вещей.<br>
                                    Каким должен быть Дом? Смотрите разделе о дизайне и стиле современного жилья
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/temp/images/slides/slide-menu-2.png">
                        <div class="carousel-caption">
                            <div class="pull-left news-text">
                                <h3 class="text-right">НОВОСТИ МИРА НЕДВИЖИМОСТИ</h3>
                                <p class="text-right">
                                    Самые интересные сообщения о новых проектах в Росии и за рубежом,<br>
                                    о тенденциях рынка недвижимости и его подробный анализ - мы отбираем<br>
                                    для Вас ключевые и просто любопытные факты!
                                </p>
                            </div>
                            <div class="pull-right">
                                <a href="/news">
                                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/temp/images/silk-slider-news.png">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


<script type="text/javascript">
    $(document).ready(function(){
        $('#search-view').addClass('active');
        $('#select-conteiner').css('display', 'block');
    });
</script>

<?php $this->endContent(); ?>
