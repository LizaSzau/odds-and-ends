<?php

class deleteCakeController { 	

	private $result;
	private $http_code;
	
	public function getResult() {
		 return $this->result;
	}
	 
	public function getHttpCode() {
		 return $this->http_code;
	}
	
    public function deleteCake() {

		$api_url = Config::API_URL.'/delete.php';
		$curl = curl_init($api_url);
		
		$curl_post_data = array(
				'id' => 5,			
		);
		
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
		
		$curl_response = curl_exec($curl);
	
		var_dump($curl_response);
		
		if ($curl_response === false) {
			$info = curl_getinfo($curl);
			curl_close($curl);
			die('Váratlan hiba történt: '.var_export($info));
		}
		
		$this->http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$this->result = json_decode($curl_response)->message;
		
		curl_close($curl);
	}
}