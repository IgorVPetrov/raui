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

class WebUser extends CWebUser {
	private $_model = null;
	private $_keyPrefix;
	private $_access=array();

	function getRole() {
		if($user = $this->getModel()){
			// в таблице User есть поле role
			return $user->role;
		}
	}

	private function getModel(){
		if (!$this->isGuest && $this->_model === null){
			$this->_model = User::model()->resetScope()->findByPk($this->id, array('select' => 'role'));
		}
		return $this->_model;
	}

	public function checkAccess($operation, $params=array(), $allowCaching=true) {
		if (issetModule('rbac')) {
			if($allowCaching && $params===array() && isset($this->_access[$operation]))
				return $this->_access[$operation];

			$access=Yii::app()->getAuthManager()->checkAccess($operation,$this->getId(),$params);
			if($allowCaching && $params===array())
				$this->_access[$operation]=$access;

			return $access;
		}
		else {
			if (Yii::app()->user->isGuest) { # гость
				if ($operation == 'guest')
					return true;
			}
			else {
				if (Yii::app()->user->getState('isAdmin')) #админ
					return true;
				else { # авторизированный пользователь
					if ($operation == 'registered' || $operation == 'guest')
						return true;
				}
			}

			return false;
		}
	}
}