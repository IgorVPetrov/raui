<?php
/* * ********************************************************************************************
 *								Raui ORE

 



 *

 *

 *


 *
 * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class PhpAuthManager extends CPhpAuthManager{
	public function init(){
		// Иерархию ролей расположим в файле auth.php в директории config приложения
		if($this->authFile===null){
			$this->authFile=Yii::getPathOfAlias('application.modules.rbac.config.auth').'.php';
		}

		parent::init();

		// Для гостей у нас и так роль по умолчанию guest.
		if(!Yii::app()->user->isGuest){
			// Связываем роль, заданную в БД с идентификатором пользователя,
			// возвращаемым UserIdentity.getId().
			if(!$this->isAssigned(Yii::app()->user->role, Yii::app()->user->id)) {
				if($this->assign(Yii::app()->user->role, Yii::app()->user->id)) {
					//Yii::app()->authManager->save();
				}
			}
			//$this->assign(Yii::app()->user->role, Yii::app()->user->id);
		}
	}
}