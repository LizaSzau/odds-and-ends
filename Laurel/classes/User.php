<?php

class User { 	
	private $database;
	private $id;
	private $email;
	private $userGroupID;
	private $userGroupName;
	
    public function __construct() {
        $this->database = new Database();
		$this->database->init();
    }
	
	public function getId() { 
		return $this->id; 
	}
	
	public function getEmail() { 
		return $this->email; 
	}
	
	public function getUserGroupID() { 
		return $this->userGroupID; 
	}
	
	public function getUserGroupName() { 
		return $this->userGroupName; 
	}
	
	public function setPassword($password) { 
		$this->password = $password; 
	}
	
	public function login($email, $password) {
		$sql = 'SELECT * FROM users WHERE email = ?';
		$mysqli = $this->database->getMysqli();
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$result = $stmt->get_result(); 
		$user = $result->fetch_assoc();
		if (!$user) return false;
		if (!password_verify($password, $user['password'])) return false; 
		$this->id = $user['id'];
		$this->userGroupID = $user['id_user_group'];
		$this->email = $email;
		$this->getGroupDetails();
		return true;
	}
	
	private function getGroupDetails() {
		$sql = 'SELECT * FROM user_groups WHERE id = '.$this->userGroupID;
		$this->database->sqlRaw($sql);	
		$userGroup = $this->database->getSelectResult();
		$this->userGroupName = $userGroup[0]['name'];
	}
}