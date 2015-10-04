<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('common', 'Login');
$this->breadcrumbs = array(
    Yii::t('common', 'Login')
);
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

//$cs->registerCssFile($baseUrl.'/themes/atlas/temp/css/login/style.css');
?>





<div class="wrapper">
  <div id="modal-auth" class="form-for-auth-reg">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => false,
            /* 'clientOptions'=>array(
              'validateOnSubmit'=>true,
              ), */
    ));
    ?>
    <div class="title">
      <h1>Войти</h1>
      <a href="/" class="close"></a>
    </div>
    <div class="title-info">
      <span>Заполните <a href="#">форму регистрации</a>, если Вы ещё не зарегистрированы на нашем сайте</span>
    </div>
    <div class="form-content">
      <div class="for-label first-child row">
        <?php echo $form->textField($model, 'username', ['required'=>'true', 'id'=>"login_auth", 'class'=>"input_style",  'placeholder'=>"Адрес электроной почты*"]); ?>
        <?php echo $form->error($model, 'username'); ?>
      </div>
      <div class="for-label last-child row">
        <?php echo $form->passwordField($model, 'password',['required'=>'true', 'id'=>"pass_auth", 'class'=>"input_style",'placeholder'=>"Пароль*"]); ?>
        <?php echo $form->error($model, 'password'); ?>
      </div>
      <div class="note">
        <span><span class="nesesary_line">*</span> - поля обязательные для заполнения</span>
      </div>
      <div class="check-box row">
        <input type="checkbox" name="LoginForm[rememberMe]" value="1" class="checkbox" id="checkbox-auth" />
        <label for="checkbox-auth">
          <span class="check_name">Запомнить меня</span>
        </label>
      </div>
      <div class="submit-btn">
        <input type="submit" value="Войти">
      </div>
    </div>
    <div class="bottom-conteiner">
      <div class="content-bottom">
        <span>Или войдите через социальные сети</span>
      </div>
      <div class="soccial-conteiner">
        <a class="social-net social-m" href="#"></a>
        <a class="social-net social-f" href="#"></a>
        <a class="social-net social-in" href="#"></a>
        <a class="social-net social-inst" href="#"></a>
        <a class="social-net social-g" href="#"></a>
        <a class="social-net social-t" href="#"></a>
      </div>
    </div>
    <?php $this->endWidget(); ?>
  </div>
</div>



<?php
if (demo()) {
    Yii::app()->clientScript->registerScript('login-js', '
		function demoLogin(){
			login("demore@sait.dp.ua", "demo");
		}

		function adminLogin(){
			login("adminre@sait.dp.ua", "admin");
		}

		function moderatorLogin(){
			login("moderatorre@sait.dp.ua", "moderator");
		}

		function login(username, password){
			$("#LoginForm_username").val(username);
			$("#LoginForm_password").val(password);
			$("#login-form").submit();
		}
	', CClientScript::POS_END);
}