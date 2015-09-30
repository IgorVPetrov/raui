<!--<h2 class="title highlight-left-right">
	<span><?php echo tt('Contact Us', 'contactform'); ?></span>
</h2>-->

<?php

// Ниже комментируем, вывод телефонов и контактов из админки

//	Yii::app()->clientScript->registerScriptFile('http://download.skype.com/share/skypebuttons/js/skypeCheck.js', CClientScript::POS_END);
//
//	if(!Yii::app()->user->isGuest){
//		if(!$model->name)
//			$model->name = Yii::app()->user->username;
//		if(!$model->phone)
//			$model->phone = Yii::app()->user->phone;
//		if(!$model->email)
//			$model->email = Yii::app()->user->email;
//	}

//	if(param('adminPhone')){
//		echo '<p>'.tt('Phone', 'contactform').': '.param('adminPhone').'</p>';
//	}
//	if(param('adminEmail')){
//		if (IdnaConvert::check(param('adminEmail')))
//			echo '<p>'.tt('Email', 'contactform').': '.IdnaConvert::checkDecode(param('adminEmail')).'</p>';
//		else
//			echo '<p>'.tt('Email', 'contactform').': '.Yii::app()->controller->protectEmail(param('adminEmail')).'</p>';
//	}
//	if(param('adminSkype')){
//		echo '<p>'.tt('Skype', 'contactform').': '.param('adminSkype').'</p>';
//	}
//	if(param('adminICQ')){
//		echo '<p>'.tt('ICQ', 'contactform').': '.param('adminICQ').'</p>';
//	}
//	if(param('adminAddress')){
//		echo '<p>'.tt('Address', 'contactform').': '.param('adminAddress').'</p>';
//	}
?>
        <!-- Contacts -->
        <section class="container-full">
            <div class="contacts">
 <h3>Контактная информация и форма для обращений к администрации сайта</h3>
                <div class="pull-left">
                    <p>Данные для официальных обращений:</p>
                    <ul>
                        <li>ООО «РАУИ»</li>
                        <li>ИНН/КПП 5008060441/500801001</li>
                        <li>ОГРН 1125047019833</li>
                        <li>Юридический адрес: 141707, Московская область,</li>
                        <li>г. Долгопрудный, ул. Проспект Пацаева, д. 7, к. 1, оф. №2</li>
                    </ul>
                    <p>Тел. 8(495) 211-04-05, 8(985) 211-04-05</p>
                    <p>
                        По всем вопросам, по вопросам рекламы: <a href="mailto:raui@raui.ru">raui@raui.ru</a>
                        По техническим вопросам: <a href="mailto:webmaster@raui.ru"></a>
                    </p>
                    <hr>
                    <p class="indent-line">
                        Каждый партнёр имеет право размещать свои объявления на нашем
                        портале БЕСПЛАТНО всё время сотрудничества и в любом количестве!
                        Настроив выгрузку объявлений с помощью XML, вы получите мощный
                        инструментарий для бурного роста вашего агенства - весь русурс
                        нашего портала!
                    </p>
                    <p>
                        Стать партнёром портала raui.ru также просто, как и выгодно:
                    </p>
                    <ul>
                        <li>Зарегистрируйтесь на нашем сайте</li>
                        <li>1. Скачайте и разместите на своём сайте блок-ссылку</li>
                        <li>2. Заполните форму обращения, указав в теме письма “ПАРТНЁРСТВО”</li>
                        <li>3. В тексте обращения укажите реквизиты Вашей компании и ссылку
                        на Ваш интернет-сайт с указанием места размещения ссылки на raui.ru</li>
                        <li>4. Получите в ответном письме статус ПАРТНЁР и все возможности!</li>
                    </ul>
                </div>

<!--Ниже пошла форма-->
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>false,
	'htmlOptions'=>array(
        'class'=>'pull-right',
    ),
));
?>
 <div class="contacts-form">
	<p style="display:none">
		<?php echo tt('You can fill out the form below to contact us.', 'contactform'); ?>
	</p>

	<p class="note" style="display:none"><?php echo Yii::t('common', 'Fields with <span class="required">*</span> are required.'); ?></p>
    <p>
                            Комментарии, пожелания и отзывы о работе портала, а также все вопросы и
                            предложения от незарегистрированных пользователей принимаются через
                            форму обратной связи. Ваше сообщение обязательно будет прочитано!
    </p>
	<ul>
	<?php echo $form->errorSummary($model); ?>

	<li>
		<?php //echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name', array('size'=>60,'maxlength'=>128, 'class' => 'width240', 'placeholder'=>'Имя *')); ?>
		<?php echo $form->error($model,'name'); ?>
	</li>

	<li>
		<?php //echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email', array('size'=>60,'maxlength'=>128, 'class' => 'width240', 'placeholder'=>'E-mail *')); ?>
		<?php echo $form->error($model,'email'); ?>
	</li>

	<li>
		<?php //echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone', array('size'=>60,'maxlength'=>128, 'class' => 'width240', 'placeholder'=>'Телефон')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</li>
    	<li>
		<?php //echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'theme', array('size'=>60,'maxlength'=>128, 'class' => 'width240', 'placeholder'=>'Тема обращения*')); ?>
		<?php echo $form->error($model,'theme'); ?>
	</li>

	<li>
		<?php //echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>3, 'cols'=>50, 'class' => 'contact-textarea', 'placeholder'=>'Сообщение (до 200 знаков)')); ?>
		<?php echo $form->error($model,'body'); ?>
	</li>
	</ul>
    
    </div>  <!--End  contacts-form-->
    
	<?php
	if (Yii::app()->user->isGuest){
	?>
		<div class="row">
			<?php echo $form->labelEx($model, 'verifyCode');?>
			<?php
			$cAction = '/infopages/main/captcha';
			if($this->page == 'index'){
				$cAction = '/site/captcha';
			} elseif ($this->page == 'contactForm'){
				$cAction = '/contactform/main/captcha';
			}
			$this->widget('CustomCCaptcha',
				array(
					'captchaAction' => $cAction,
					'buttonOptions' => array('class' => 'get-new-ver-code'),
					'clickableImage' => true,
				)
			);?>
			<br/>
			<?php echo $form->textField($model, 'verifyCode', array('autocomplete' => 'off'));?><br/>
			<?php echo $form->error($model, 'verifyCode');?>
		</div>
	<?php
	}
	?>
	<div class="btn-submit">
    <?php // echo CHtml::submitButton('Отправить', array('class' => 'button-blue')); ?>
                        <button><i></i></button>
                        <span class="pull-right">* - поля, обязательные для заполнения</span>
     </div>


</div>
</section>


<?php $this->endWidget(); ?>


