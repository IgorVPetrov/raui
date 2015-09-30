<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/chosen/chosen.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/chosen/chosen.jquery.js', CClientScript::POS_END);

$this->pageTitle=Yii::app()->name . ' - '.tc('Join now');
$this->breadcrumbs=array(
	tc('Join now'),
);
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
?>
<div class="wrapper">
		<div id="modal-auth" class="reg-form">
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
				<input type="file" name="photo" multiple accept="image/*,image/jpeg">
				<span class="un_ava_info">Pазместите Ваше фото или логотип Вашей компании</span>
			</div>
			<div class="radio-select">
				<span class="reg-info">Зарегистрироваться как <span class="nesesary_line">*</span>...</span>
				<ul>
					<li>
						<input type="radio" checked="checked" id="radio-1" name="userSelect" />
						<label for="radio-1">
							<span class="check_card_name">Частное лицо</span>
						</label>		
					</li>
					<li>
						<input type="radio" checked="checked" id="radio-2" name="userSelect" />
						<label for="radio-2">
							<span class="check_card_name">Риелтор</span>
						</label>
					</li>
					<li>
						<input type="radio" checked="checked" id="radio-3" name="userSelect" />
						<label for="radio-3">
							<span class="check_card_name">Юридическое лицо</span>
						</label>
					</li>
				</ul>
			</div>
			<div class="form-content">
   				<div class="for-label first-reg-child">
	   				<input type="text" required id="login_reg" class="input_style" name="user" placeholder="Имя*"/>
   				</div>
   				<div class="for-label">
	   				<input type="text" id="phone_reg" class="input_style" name="user" placeholder="Телефон"/>
   				</div>
   				<div class="for-label">
	   				<input type="text" required id="email_reg" class="input_style" name="user" placeholder="Email*"/>
   				</div>
   				<div class="for-label">
	   				<input type="password" required id="create_password_reg" class="input_style" name="user" placeholder="Создать пароль*"/>
   				</div>
   				<div class="for-label last-child">
	   				<input type="password" required id="pass_reg" class="input_style" name="user" placeholder="Подтвердить пароль*"/>
   				</div>
   				<div class="check-box reg-check">
   					<input type="checkbox" name="agree" value="" class="checkbox" id="checkbox-auth" />
					<label for="checkbox-auth">
						<span class="check_name reg_check_name">Я подтверждаю свое согласие с Правилами пользования сайтом raui.ru и даю согласие на обработку своих персональных данных в соответствии с Лицензионным соглашением <span class="nesesary_line">*</span></span>
					</label>
   				</div>
   				<div class="note">
   					<span><span class="nesesary_line">*</span> - поля обязательные для заполнения</span>
   				</div>
   				<div class="submit-btn reg-buttons-form">
   					<input type="submit" value="Зарегистрироваться">
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
		</div>
	</div>
<script type="text/javascript">
	$(function(){
		$("#agency_user_id").chosen({no_results_text: " "});

		regCheckUserType();

		$('#User_type').change(function(){
			regCheckUserType();
		});
	});

	function regCheckUserType(){
		var type = $('#User_type').val();
		if(type == <?php echo CJavaScript::encode(User::TYPE_AGENCY);?>){
			$('#row_agency_name').show();
		} else {
			$('#row_agency_name').hide();
		}

		if(type == <?php echo CJavaScript::encode(User::TYPE_AGENT);?>){
			$('#row_agency_user_id').show();
		} else {
			$('#row_agency_user_id').hide();
		}
	}
</script>