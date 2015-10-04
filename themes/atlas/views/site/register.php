<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/chosen/chosen.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/chosen/chosen.jquery.js', CClientScript::POS_END);

$this->pageTitle = Yii::app()->name . ' - ' . tc('Join now');
$this->breadcrumbs = array(
    tc('Join now'),
);
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
?>
<div class="wrapper">
  <div id="modal-auth" class="reg-form">
      <?php
      $form = $this->beginWidget('CActiveForm', array(
          'action' => Yii::app()->controller->createUrl('/site/register'),
          'id' => 'user-register-form',
          'enableAjaxValidation' => false,
      ));
      ?>
    <div class="title">
      <h1>Регистрация</h1>
      <a href="/" class="close"></a>
    </div>
    <div class="title-info" style="text-align:left !important; padding:0 0 0 75px;">
      <span>
        <a href="#">Уже есть регистрация?</a>
      </span>
    </div>
    <div class="addAvatar">
      <input type="file" name="User[photo]" multiple accept="image/*,image/jpeg">
      <span class="un_ava_info">Pазместите Ваше фото или логотип Вашей компании</span>
    </div>
    <div class="radio-select">
      <span class="reg-info">Зарегистрироваться как <span class="nesesary_line">*</span>...</span>
      <ul>
        <li>
          <input type="radio"  id="radio-1" value="1" name="User[type]" />
          <label for="radio-1">
            <span class="check_card_name">Частное лицо</span>
          </label>		
        </li>
        <li>
          <input type="radio"  id="radio-2" value="3" name="User[type]" />
          <label for="radio-2">
            <span class="check_card_name">Риелтор</span>
          </label>
        </li>
        <li>
          <input type="radio" checked="checked" value="2" id="radio-3" name="User[type]" />
          <label for="radio-3">
            <span class="check_card_name">Юридическое лицо</span>
          </label>
        </li>
      </ul>
    </div>
    <div class="form-content">
      <div class="for-label first-reg-child row">
          <?php echo $form->textField($model, 'username', array('required' => 'true', 'id' => "login_reg", 'class' => "input_style", 'placeholder' => "Имя*")); ?>
          <?php echo $form->error($model, 'username'); ?>
      </div>
      <div class="for-label row">
          <?php echo $form->textField($model, 'phone', array('id' => "phone_reg", 'class' => "input_style", 'placeholder' => "Телефон")); ?>
          <?php echo $form->error($model, 'phone'); ?>
      </div>
      <div class="for-label row">
          <?php echo $form->textField($model, 'email', array('required' => 'true', 'id' => "email_reg", 'class' => "input_style", 'placeholder' => "Email*")); ?>
          <?php echo $form->error($model, 'email'); ?>
      </div>
      <div class="for-label row">
          <?php echo $form->passwordField($model, 'password', array('required' => 'true', 'id' => "create_password_reg", 'class' => "input_style", 'placeholder' => "Создать пароль*")); ?>
          <?php echo $form->error($model, 'password'); ?>
      </div>
      <div class="for-label last-child row">
          <?php echo $form->passwordField($model, 'password_repeat', array('required' => 'true', 'id' => "pass_reg", 'class' => "input_style", 'placeholder' => "Подтвердить пароль*")); ?>
          <?php echo $form->error($model, 'password_repeat'); ?>
      </div>
      <div class="check-box reg-check row">
          <?php echo $form->checkBox($model, 'agree', ['value' => '1', 'class' => "checkbox", 'id' => "checkbox-auth"]); ?>
          <?php echo $form->error($model, 'agree'); ?>
        <label for="checkbox-auth">
          <span class="check_name reg_check_name">Я подтверждаю свое согласие с Правилами пользования сайтом raui.ru и даю согласие на обработку своих персональных данных в соответствии с Лицензионным соглашением <span class="nesesary_line">*</span></span>
        </label>
      </div>
      <div class="note">
        <span><span class="nesesary_line">*</span> - поля обязательные для заполнения</span>
      </div>
      <div class="submit-btn reg-buttons-form">
          <?php echo CHtml::submitButton("Зарегистрироваться"); ?>
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
<script type="text/javascript">
    $(function () {
      $("#agency_user_id").chosen({no_results_text: " "});

      regCheckUserType();

      $('#User_type').change(function () {
        regCheckUserType();
      });
    });

    function regCheckUserType() {
      var type = $('#User_type').val();
      if (type == <?php echo CJavaScript::encode(User::TYPE_AGENCY); ?>) {
        $('#row_agency_name').show();
      } else {
        $('#row_agency_name').hide();
      }

      if (type == <?php echo CJavaScript::encode(User::TYPE_AGENT); ?>) {
        $('#row_agency_user_id').show();
      } else {
        $('#row_agency_user_id').hide();
      }
    }
</script>