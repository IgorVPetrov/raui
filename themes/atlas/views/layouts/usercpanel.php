<!DOCTYPE html>
<!-- saved from url=(0054)file:///C:/_-=Work=-_/Denis/2_PrivCab/html/layout.html -->
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RAUI. Private cabinet</title>

    <!-- Bootstrap 
    <link rel="stylesheet" type="text/css" href="themes/atlas/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="themes/atlas/css/privCabinet.css">
    <link rel="stylesheet" type="text/css" href="themes/atlas/css/content-table.css">
    --> 
    <?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/bootstrap.css');
    Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/privCabinet.css');
    Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/content-table.css');
    ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
  </head>
  <body>
    <div class="container-fluid pCab_container"> 
      <!-- ################################# LEFT SIDE ################################################# -->
      <div class="row"> <!-- left zone row -->
        <div class="col-sm-2 pCab_leftZone"> <!-- left zone DIV --> 
          <!-- ################################# CLIENT CARD ################################################# -->
          <div class="row line-bottom">
            <div class="col-sm-12 "> <!-- clientCard div -->
              <div class="row pcab_clientCard">
                <div class="account-left center-block clientText vcenter"> <!-- clientInfo div -->
                  <div>
                    <div class="pcab_clientName"> <?php echo $this->model->username; ?></div>
                    <div class="pcab_clientInfo"> 

<?php switch ($this->model->type): ?>
<?php case User::TYPE_PRIVATE_PERSON: ?>
                              Клиент
                              <?php break; ?>
                          <?php case User::TYPE_AGENT: ?>
                              Агент
                              <?php break; ?>
                          <?php case User::TYPE_AGENCY: ?>
                              Агентство
                              <?php break; ?>
                          <?php case User::TYPE_ADMIN: ?>
                              Администратор
                              <?php break; ?>
                      <?php endswitch ?>
                      <br>


                      Баланс: <?php echo $this->model->balance; ?> руб.<br>
                      ID: <?php echo $this->model->id; ?><br>
                    </div>
                  </div>
                </div>
                <!-- eof clientInfo div -->
                <div class="account-right pcab_clientPhoto"> <!-- clientPhoto div --> 
                  <img src="<?php echo $this->model->getAvaSrc(); ?>" class="img-circle img-responsive center-block" alt="client_photo"> </div>
              </div>
            </div>
            <!-- eof clientCard div -->
            <div class="col-sm-1"> <!-- leftMenu <=> right zone razdelitel vert poloska --> 
            </div>
          </div>
          <!-- ################################# LEFT MENU ################################################# -->
          <div class="row pCab_leftMenuDiv"> <!-- left menu row -->
            <ul class="pCab_leftMenuItems">
              <li id="lm1"><a href="#">Объявления</a>
                <ul class="sub-menu">
                  <li><a href="#">Аренда</a><span>2</span></li>
                  <li><a href="#">Продажа</a><span>0</span></li>
                  <li><a href="#">Избранные</a><span>3</span></li>
                  <li><a href="#">Разместить</a></li>
                </ul>
              </li>
              <li id="lm2"><a href="#">Заявки</a>
                <ul class="sub-menu">
                  <li><a href="#">Аренда</a><span>2</span></li>
                  <li><a href="#">Продажа</a><span>0</span></li>
                  <li><a href="#">Разместить</a></li>
                </ul>
              </li>
              <li id="lm5"><a href="#">Клиенты</a>
                <ul class="sub-menu">
                  <li><a href="#">Мои клиенты</a><span>2</span></li>
                  <li><a href="#">Поиск клиентов</a></li>
                  <li><a href="#">Комментарии</a><span>0</span></li>
                  <li><a href="#">Жалобы</a></li>
                </ul>
              </li>
              <li id="lm6"><a href="#">Архив</a></li>
              <li id="lm3"><a href="#">Сообщения</a>
                <ul class="sub-menu">
                  <li><a href="#">Входящие</a><span>2</span></li>
                  <li><a href="#">Отправленные</a><span>0</span></li>
                  <li><a href="#">Администрация</a><span>0</span></li>
                </ul>
              </li>
              <li id="lm4"><a href="#">Добавить новость</a></li>
              <li id="lm7"><a href="#">Документы</a></li>
            </ul>
            <!-- eof leftMenu DIV --> 
          </div>
          <!-- eof leftMenu row --> 
        </div>
        <!-- eof leftZone div --> 
        <!-- ################################# RIGHT SIDE ################################################# -->
        <div class="col-sm-10 pCab_rightZone" id="rightZone">
          <div class="row"> <!--  topMenu row --> 
            <!--<div class="col-sm-2">  "Home" & "Refresh" buttons zone  </div> -->
            <div class="col-sm-12" id="topMenu"> <!-- topMenu zone -->
              <nav class="navbar navbar-default pCab_topMenu">
                <div class="container-fluid"> 
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    <div class="pCab_topMenuButs"> <a class="btn btn-default homeBut" href="/" role="button">На главную</a> <a class="refreshBut" href="/usercpanel"></a> </div>
                    <!--  <a class="btn btn-default" href="#" role="button">Home</a>--> 
                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="defaultNavbar1">
                    <ul class="nav navbar-nav navbar-right">
                      <li id="m1"><a href="#">Поиск обьявлений</a></li>
                      <li id="m2"><a href="#">Пополнить баланс</a></li>
                      <li id="m3"><a href="#">Настройки профиля</a></li>
                      <li id="m4"><a href="/logout">Выход</a></li>
                    </ul>
                  </div>
                  <!-- eof navbar collapse --> 
                </div>
                <!-- eof container fluid --> 
              </nav>
            </div>
            <!-- eof topMenu zone --> 
          </div>
          <!-- eof topMenu row --> 
          <!-- ################################# CONTENT ################################################# -->
          <div class="row content"> <!-- content zone row  -->

            <!-- eof content zone DIV --> 
          </div>
          <!-- eof content zone row  --> 
          <!-- ################################# Footer ################################################# -->
          <div class="row pCab_footer">
            <div class="col-md-12 col-xs-12 text-left">
              <h6 class="text-center"> RAUI  ©  2015 </h6>
              <p>Все права защищены. Перепечатка и использование материалов сайта разрешена только с согласия администрации сайта.
                По вопросам размещения рекламы обращайтесь: raui@raui.ru</p>
            </div>
          </div>
        </div>
        <!-- eof right zone DIV --> 
      </div>
      <!-- eof Container 2 columns row --> 

    </div>
    <!-- eof Container --> 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins)--> 
    <script src="themes/atlas/js/jquery-1.11.2.min.js"></script> 

    <!-- Include all compiled plugins (below), or include individual files as needed --> 
    <script src="themes/atlas/js/bootstrap.js"></script>

    <!-- Open sub-menu -->

    <script>
        //меню
        $('.pCab_leftMenuItems li:has(ul.sub-menu)').addClass('has_sub');

        $(function () {

          var Accordion = function (el, multiple) {
            this.el = el || {};
            this.multiple = multiple || false;

            // Variables privadas
            var links = this.el.find('.has_sub a');
            // Evento
            links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
          }

          Accordion.prototype.dropdown = function (e) {
            var $el = e.data.el;
            $this = $(this),
                    $next = $this.next();

            $next.slideToggle();
            $this.parent().toggleClass('open');
            $('.open > a').addClass('select');
            $('.open a ul a').removeClass('select');

            if (!e.data.multiple) {
              $el.find('.pCab_leftMenuItems .sub-menu').not($next).slideUp().parent().removeClass('open');
            }
            ;
          }

          var accordion = new Accordion($('.pCab_leftMenuItems'), false);
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
          //селекты
          $('.select-col-1, .block-3 .box-1-bottom-logic-right .check-el, .checked-content ').click(function () {
            $('.select-col-1, .block-3 .box-1-bottom-logic-right .check-el, .checked-content').removeClass('check');
            $(this).closest('.select-col-1, .block-3 .box-1-bottom-logic-right .check-el, .checked-content').addClass('check');
          });
          //селекты
          $('.block-3 .box-1-bottom-logic-right .select-text-s .check-el-s').click(function () {
            $('.block-3 .box-1-bottom-logic-right .select-text-s .check-el-s').removeClass('check');
            $(this).closest('.block-3 .box-1-bottom-logic-right .select-text-s .check-el-s').addClass('check');
          });
          //селекты
          $('.select-text, #select-all, #nes-all, .list-options .list-select-btn, .list-options .list-nes-btn').click(function () {
            if ($(this).hasClass('check')) {
              $(this).closest('.select-text, #select-all, #nes-all, .list-options .list-select-btn, .list-options .list-nes-btn').removeClass('check');
            } else {
              $(this).closest('.select-text, #select-all, #nes-all, .list-options .list-select-btn, .list-options .list-nes-btn').addClass('check');
            }
          });

          // селекты списка сообщений

          $('#mess-list-content ul li').click(function () {
            $('#mess-list-content ul li').removeClass('active');
            $(this).closest('#mess-list-content ul li').addClass('active');
          });

          //подсказки
          $('.input-text').each(function () {
            if ($(this).val() != '')
              $(this).prev().addClass('hide');
          });

          $('.input-text').blur(function () {
            if ($(this).val() == '')
              $(this).prev().removeClass('hide');
          });

          $('.input-text').focus(function () {
            $(this).prev().addClass('hide');
          });

          $('.input-text').mouseover(function () {
            if ($(this).val() != '')
              $(this).prev().addClass('hide');
          });

          //выделение всего списка сообщений как прочитаные
          $('#select-all').click(function () {

            if ($('#select-all').hasClass('check')) {

              $('.list-options .list-select-btn').addClass('check');

            } else {

              $('.list-options .list-select-btn').removeClass('check');
            }
          });

          // Выделить все с пометкой важно

          $('#nes-all').click(function () {

            if ($('#nes-all').hasClass('check')) {

              $('.list-options .list-nes-btn').addClass('check');

            } else {

              $('.list-options .list-nes-btn').removeClass('check');
            }
          });

          // переключатели #prev-message and #next-message
          var messageList = $('#mess-list-content ul li'),
                  indexLi = 0,
                  indexMax = messageList.length;

          function change() {
            messageList.removeClass('active');
            messageList.filter(':nth-child(' + indexLi + ')').addClass('active');

            if ($('#mess-list-content ul .active').length >= 1) {
              $('#delete-check').addClass('check');
            } else {
              $('#delete-check').removeClass('check');
            }
          }

          $('#next-message').click(function () {
            indexLi++;
            if (indexLi > indexMax) {
              indexLi = 1;
            }
            change();
          });
          $('#prev-message').click(function () {
            indexLi--;
            if (indexLi < 1) {
              indexLi = indexMax;
            }
            change();
          });

          $('#mess-list-content ul li').click(function () {
            if ($('#mess-list-content ul .active').length >= 1) {
              $('#delete-check').addClass('check');
            } else {
              $('#delete-check').removeClass('check');
            }
          });

        });

    </script>

    <script type="text/javascript">
        $('#mess-list-content').jScrollPane();
    </script>
  </body>
</html>	