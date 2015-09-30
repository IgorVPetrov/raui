<!DOCTYPE html>
<?php
	$cs = Yii::app()->clientScript;
?>
<html lang="<?php echo Yii::app()->language;?>">
<head>
	<title><?php echo CHtml::encode($this->seoTitle ? $this->seoTitle : $this->pageTitle); ?></title>
	<meta name="description" content="<?php echo CHtml::encode($this->seoDescription ? $this->seoDescription : $this->pageDescription); ?>" />
	<meta name="keywords" content="<?php echo CHtml::encode($this->seoKeywords ? $this->seoKeywords : $this->pageKeywords); ?>" />

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    
  
    
     	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/temp/css/bootstrap.css"/>
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/temp/css/bootstrap-select.min.css"/>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/temp/css/jquery.jscrollpane.css" type="text/css">
        <!--<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/temp/css/grid.min.css"/>-->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/temp/css/main.css"/>
		 <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/temp/css/login/style.css"/>
	 <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/temp/css/registration/style.css"/>
        <link href='http://fonts.googleapis.com/css?family=Comfortaa:400,700&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/temp/js/modernizr.custom.min.js"></script>
        <!--[if lt IE 9]>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

        
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

        
<script>
$(document).ready(function() {
    $(".tabs-menu a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
});
</script>
    
    	<script type="text/javascript">
/*<![CDATA[*/

		var BASE_URL = '';
		var CHANGE_SEARCH_URL = '/quicksearch/main/mainsearch/countAjax/1/lang/ru';
		var params = {
			change_search_ajax: 1
		}
	
/*]]>*/
</script>


	<link rel="icon" href="<?php echo Yii::app()->baseUrl; ?>/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl; ?>/favicon.ico" type="image/x-icon" />


<style>
#googleMap, #ymap, #osmap {
    width: 1280px;
    height: 480px;
}
</style>



	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css">
	<![endif]-->
</head>

<body>


<!-- Header -->
        <header id="header-top">
            <div class="container-full">
            	<div class="header-top">
            		<a href="/" id="new-logo"></a>
            		<div class="user-app">
            			<ul>
            				<li><a class="place_app" href="#">Разместить объявление</a></li>
            				<li><a class="add_app" href="#">Разместить заявку</a></li>
            			</ul>
            		</div>          
            		<?php  if(Yii::app()->user->isGuest):?>
                        <div class="user-choise">
                            <ul>
                                <li><a class="enter-btn" href="/usercpanel">Вход</a></li>
                                <li><a class="reg-btn" href="/register">Регистрация</a></li>
                            </ul>
                        </div>
                     <?php else: ?>
                     	<?php $user = HUser::getModel(); ?>
                        <div class="user-register">
                            <ul class="pull-left info-block">
                                <li><span>ID: <?php echo $user->id; ?></span></li>
                                <li class="hr-vr"></li>
                                <li><a href="">Баланс:</a> <?php echo $user->balance; ?> <?php echo Currency::getDefaultCurrencyName(); ?></li>
                                <li class="hr-vr"></li>
                                <li><a href="">Избранное:</a> 3</li>
                                <li class="hr-vr"></li>
                                <li><a href="">Закладки:</a> 2</li>
                            </ul>
                            <ul class="pull-right account-block">
                                <li><a href="/usercpanel">Личный кабинет</a></li>
                                <li><a href="/logout">Выйти</a></li>
                            </ul>
                        </div>
                     <?php endif ?>

            	</div>
                <nav>
               
                    
            
          <!-- Меню -->
            <?php
					$this->widget('ResponsiveMainCMenu',array(
						'id' => 'sf-menu-id',
						'items' => $this->aData['topMenuItems'],
						'htmlOptions' => array('class' => 'main-menu clearfix'),
						'encodeLabel' => false,
						'activateParents' => true,
					));
            ?>
            <!--!Меню -->
                    

                    
                    
                    <div class="wrap-add-search">
                        <div class="add-search-housing-panel">
                            <a href="">Разместить <span>объявление</span></a>
                            <button class="search-housing-btn"><i></i></button>
                            <a href="">Добавить <span>заявку</span></a>
                        </div>
                        <div class="search-housing hide">



								<?php  Yii::app()->controller->renderPartial('//site/bt_index-search'); ?>





                        </div>
                    </div>
                </nav>
            </div>
        </header>

<!-- !Header -->








		<?php echo $content; ?>

	
 
 
 
        <!-- Footer -->
        <footer class="container-full">
            <div class="footer-top">
                <a class="footer-a" href="#">Подать объявление</a>
                <ul>
                    <li><a href="/page/o-nas">О нас</a></li>
                    <li><a href="/news">Новости</a></li>
                    <li><a href="/page/tarify">Тарифы</a></li>
                    <li><a href="/page/elitnoe-zhile">Элитное жильё</a></li>
                    <li><a href="/page/novostrojki">Новостройки</a></li>
                    <li><a href="/blog">Журнал</a></li>
                    <li><a href="/vacancy">Вакансии</a></li>
                    <li><a href="/page/kontakty">Контакты</a></li>
                </ul>
                <a class="footer-a" href="#">Поиск недвижимости</a>
            </div>
            <p>
                Добро пожаловать на портал РАУИ - базу недвижимости для агентов, клиентов и собственников! На нашем портале вы можете разместить объявление об аренде квартир и комнат, а также домов, дач, участков и нежилых помещений.
                Желаете выставить квартиру на продажа? Разместите информацию на доске объявлений недвижимости, и ее увидят покупатели по всей России. Наша база недвижимости поможет Вам легко найти себе подходящее жилье!
            </p>
            <p>
                На портале можно найти объявления недвижимости по всей России. Размещение объявлений по аренде совершенно бесплатно, по продаже - в соответствии с тарифами, которые очень лояльны.
                Мы создаем базу недвижимости, доступную каждому!
            </p>
            <hr/>
            <h3>Присоединяйтесь к нам!</h3>
            <ul class="social-net-big clearfix">
                <li><a class="in" href=""></a></li>
                <li><a class="gp" href=""></a></li>
                <li><a class="fb" href=""></a></li>
                <li><a class="inst" href=""></a></li>
                <li><a class="tw" href=""></a></li>
                <li><a class="od" href=""></a></li>
                <li><a class="vk" href=""></a></li>
            </ul>
            <div class="footer-list">
                <ul>
                    <li><a href="/sitemap">Карта сайта</a></li>
                    <li><a href="/page/kontakty">Как стать партнёром</a></li>
                    <li><a href="#">Размещение рекламы</a></li>
                    <li><a href="#">Пользовательское соглашение</a></li>
                    <li><a href="#">Вопросы и ответы</a></li>
                    <li><a href="/page/kontakty">Контактная информация</a></li>
                </ul>
            </div>
            <div class="copyright clearfix text-center">RAUI &copy; 2015</div>
            <div class="protection-rights text-center">
                Все права защищены. Перепечатка и использование материалов сайта разрешена только с согласия администрации сайта.  По вопросам размещения рекламы обращайтесь: <a
                    href="mailto:raui@raui.ru">raui@raui.ru</a>
            </div> 
            <a href="#header-top" id="scroller"></a>

       </footer>
   <!-- !Footer -->
    
   <!-- Скрипты-->
    
      <script>
    $(document).ready(function(){
       $('footer a[href*=#]').bind("click", function(e){
          var anchor = $(this);
          $('html, body').stop().animate({
             scrollTop: $(anchor.attr('href')).offset().top
          }, 1000);
          e.preventDefault();
       });
       return false;
    });
    </script>  
    
     	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.cookie.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/temp/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/temp/js/jquery.shuffle.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/temp/js/jquery.mousewheel.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/temp/js/jquery.jscrollpane.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/temp/js/jquery.prettyPhoto.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/temp/js/common.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/common.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/scrollto.js"></script>
    	<script>
            /* Scroll panell */
            $('.result-search-new .sidebar-left').jScrollPane();
            $('.result-search-luxury .sidebar-left').jScrollPane();
        </script>
    
   <!--!Скрипты-->
    

    
    
</body>
</html>