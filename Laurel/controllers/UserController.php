<?php

class UserController { 	
	private $database;
	private $user;
	
    public function __construct() {
        $this->database = new Database;
		$this->database->init();
		$this->user = new User;
    }
	
    public function getAllUser() {
		$sql = 'SELECT email, name FROM users JOIN user_groups ON user_groups.id = users.id_user_group';
		$this->database->sqlRaw($sql);	
		return $this->database->getSelectResult();
    }
	
    public function login() {
		$user = new User;
		if (!$user->login($_POST['email'], $_POST['password'])) {
			return false;
		} else {
			$_SESSION['user']['id'] = $user->getId();
			$_SESSION['user']['email'] = $user->getEmail();
			$_SESSION['user']['userGroupID'] = $user->getUserGroupID();
			$_SESSION['user']['userGroupName'] = $user->getUserGroupName();
			return true;
		}
    }
}