<?php $this->beginContent('//layouts/main'); ?>

    <div class="base-screen">
        <div id="select-conteiner">
            <div id="tabs-container">
                <ul class="tabs-menu">
                    <li class="current"><a href="#tab-1">Аренда</a></li>
                    <li><a href="#tab-2">Продажа</a></li>
                </ul>
                <div class="tab">
                    <div id="tab-1" class="tab-content">
                        <select class="main-select-option">
                            <option>Страна</option>
                        </select>
                        <select class="main-select-option">
                            <option>Регион</option>
                        </select>
                        <select class="main-select-option">
                            <option>Город</option>
                        </select>
                        <select class="main-select-option">
                            <option>Страна</option>
                        </select>
                        <select class="main-select-option">
                            <option>Объект</option>
                        </select>
                        <select class="main-select-option">
                            <option>Комнаты</option>
                        </select>
                        <div class="price-counter">
                            <div class="list-slider">
                                <div id="slider-range"></div>
                                <div class="slider-values">
                                    <input id="min" name="priceIn" readonly value="0">
                                    <input id="max" name="priceOut" readonly value="20000">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="view-detail-arenda">Детали</button>
                    <button class="view-search-btn-arenda">Поиск</button>
                    <div class="full-desc-arenda">
                        <div class="detail-content">
                            <div class="detail-row">
                                <div class="conf-name">Срок аренды</div>
                                <ul class="term-of-lease select-ul">
                                    <li><span>Посуточно</span></li>
                                    <li><span>Дополнительно</span></li>
                                </ul>
                            </div>
                            <div class="detail-row">
                                <div class="conf-name">Площадь, м&sup2;</div>
                                <span class="list-desc">Общая</span>
                                <ul class="term-of-lease select-ul">
                                    <li><input class="input_det" type="text" placeholder="От"></li>
                                    <li><input class="input_det" type="text" placeholder="До"></li>
                                </ul>
                                <span class="list-desc">Жилая</span>
                                <ul class="term-of-lease select-ul">
                                    <li><input class="input_det" type="text" placeholder="От"></li>
                                    <li><input class="input_det" type="text" placeholder="До"></li>
                                </ul>
                                <span class="list-desc">Кухня</span>
                                <ul class="term-of-lease select-ul">
                                    <li><input class="input_det" type="text" placeholder="От"></li>
                                    <li><input class="input_det" type="text" placeholder="До"></li>
                                </ul>
                            </div>
                            <div class="detail-row">
                                <div class="conf-name">Здание</div>
                                <ul class="term-of-lease select-ul">
                                    <li>
                                        <select>
                                            <option>Тип здания</option>
                                        </select>
                                    </li>
                                </ul>
                                <span class="list-desc">Этаж</span>
                                <ul class="term-of-lease select-ul">
                                    <li><input class="input_det" type="text" placeholder="От"></li>
                                    <li><input class="input_det" type="text" placeholder="До"></li>
                                </ul>
                                <span class="list-desc">Кроме</span>
                                <ul class="term-of-lease select-ul radio-btn">
                                    <li>
                                        <input type="radio" checked="checked" id="radio-1" name="Radio" />
                                        <label for="radio-1">первого</label>
                                    </li>
                                    <li>
                                        <input type="radio" checked="checked" id="radio-2" name="Radio" />
                                        <label for="radio-2">последнего</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="detail-row row-big">
                                <div class="conf-name">Дополнительно</div>
                                <ul class="term-of-lease select-ul radio-btn">
                                    <li>
                                        <input type="checkbox" checked="checked" id="checkbox-3" name="Checkbox" />
                                        <label for="checkbox-3">Мебель</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" checked="checked" id="checkbox-4" name="Checkbox" />
                                        <label for="checkbox-4">Холодильник</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" checked="checked" id="checkbox-5" name="Checkbox" />
                                        <label for="checkbox-5">Телевизор</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" checked="checked" id="checkbox-6" name="Checkbox" />
                                        <label for="checkbox-6">Стиральная машина</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" checked="checked" id="checkbox-7" name="Checkbox" />
                                        <label for="checkbox-7">Телефон</label>
                                    </li><br>
                                    <li>
                                        <input type="checkbox" checked="checked" id="checkbox-8" name="Checkbox" />
                                        <label for="checkbox-8">Можно с животными</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" checked="checked" id="checkbox-9" name="Checkbox" />
                                        <label for="checkbox-9">Можно с детьми</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="detail-row row-big">
                                <div class="conf-name">Искать</div>
                                <ul class="term-of-lease select-ul radio-btn">
                                    <li>
                                        <input type="checkbox" checked="checked" id="checkbox-10" name="Checkbox" />
                                        <label for="checkbox-10">Только с фото</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" checked="checked" id="checkbox-11" name="Checkbox" />
                                        <label for="checkbox-11">Без посредников</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" checked="checked" id="checkbox-12" name="Checkbox" />
                                        <label for="checkbox-12">От агенств</label>
                                    </li>
                                </ul>
                            </div>
                            <button class="use-to-serch">Применить</button>
                        </div>   
                    </div>
                    <div id="tab-2" class="tab-content">
                        Продажа                              
                    </div>
                </div>
             </div>
        </div>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('.view-detail-arenda').click(function(){
            if( $('.full-desc-arenda').hasClass('detail-check') ){
                $('.full-desc-arenda').removeClass('detail-check');
            } else {
                $('.full-desc-arenda').addClass('detail-check');
            }
        });

        $('.select-ul li span').click(function(){
            $('.select-ul li').removeClass('current');
            $(this).closest('.select-ul li').addClass('current');
        });

        $('.detail-row').click(function(){
            $('.detail-row').removeClass('active-color');
            $(this).addClass('active-color');
        });

        $(function() {
            $( "#slider-range" ).slider({
              range: true,
              min: 0,
              max: 20000,
              values: [ 0, 20000 ],
              slide: function( event, ui ) {

                $("#min").val(ui.values[ 0 ]);
                $("#max").val(ui.values[ 1 ]);
              }
            });

      });
        

    });
</script>

        <!-- Latest ads -->
        <section class="latest-ads container-full">
            <h2>ПОСЛЕДНИЕ ДОБАВЛЕННЫЕ ОБЪЯВЛЕНИЯ</h2>
            
              <div id="latest-ads" class="carousel slide">
                <div class="carousel-inner">
            		
                    
            <?php $this->widget('application.modules.apartments.components.ApartmentsWidgetHome', array('criteria' => $criteria,)); ?>
            <script type="text/javascript">

            </script>
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




<?php $this->endContent(); ?>