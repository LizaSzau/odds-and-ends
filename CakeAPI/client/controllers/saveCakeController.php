<?php

class saveCakeController { 	

	private $result;
	private $http_code;
	
	public function getResult() {
		 return $this->result;
	}
	 
	public function getHttpCode() {
		 return $this->http_code;
	}
	
    public function saveCake() {

		$api_url = Config::API_URL.'/save.php';
		$curl = curl_init($api_url);
		
		$curl_post_data = array(
				'id' => '',
				'name' => 'Mákom van',
				'price' => 10000,
				'confectioner' => 'Lucky Laci',
				'vegan' => '',
				'lactose_free' => true,
				'description' => ''
		);
		
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
		
		$curl_response = curl_exec($curl);
	
		//var_dump($curl_response);
		
		if ($curl_response === false) {
			$info = curl_getinfo($curl);
			curl_close($curl);
			die('Váratlan hiba történt: '.var_export($info));
		}
		
		$this->http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$result = json_decode($curl_response)->message;
		
		if (is_array($result)) {
			foreach($result as $r) {
				$this->result .= $r.'<br>';
			}
		} else {
			$this->result = $result;
		}
		
		curl_close($curl);
	}
}