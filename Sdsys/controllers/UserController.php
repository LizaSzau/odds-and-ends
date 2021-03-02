<?php

class UserController { 	
	private $config;
	
    public function login() {
		$client = new SoapClient(Config::$SOAP_URL);
		$userName = $_POST['username'];
		$password = $_POST['password'];
		
		$result = $client->Login($userName, $password);

		if (isset($result->SessionID)) { 
			$_SESSION['user']['sessionID'] = $result->SessionID;
			$_SESSION['user']['fullName'] = $result->FullName;
			$_SESSION['user']['partnerName'] = $result->Owner->PartnerName;
			$_SESSION['user']['vatNumber'] = $result->Owner->VatNumber;
			
			return true;
		}
		
		return $result->Error->ErrorMessage;
    }
	
    public function logout() {
		$client = new SoapClient(Config::$SOAP_URL);
		$result = $client->Logout($_SESSION['user']['sessionID'] );
		session_destroy();
		return true;
    }
}