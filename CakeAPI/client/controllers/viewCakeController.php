<?php

class viewCakeController { 	

	private $result;
	private $http_code;
	private $json_result;
	private $prev_id;
	private $next_id;
	private $order;
	private $desc;
	
	public function getResult() { return $this->result; }
	public function getHttpCode() { return $this->http_code; }
	public function getJsonResult() { return $this->json_result; }
	public function getPrevID() { return $this->prev_id; }
	public function getNextID() { return $this->next_id; }
	public function getOrder() { return $this->order; }
	public function getDesc() { return $this->desc; }
	
    public function viewCake() {

		$api_url = Config::API_URL.'/view.php';
		$curl = curl_init($api_url);
		
		$curl_post_data = array(
				'id' => $_GET['id'] ?? '',
				'order' => $_GET['order'] ?? 'name',
				'desc' => $_GET['desc'] ?? 0
		);
		
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
		
		$curl_response = curl_exec($curl);
	
		// var_dump($curl_response);
		
		if ($curl_response === false) {
			$info = curl_getinfo($curl);
			curl_close($curl);
			die('Váratlan hiba történt: '.var_export($info));
		}
		
		$this->http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		
		if ($this->http_code == 200) {
			$r = json_decode($curl_response)->json_result;
			$this->json_result = json_decode($r);
			$this->prev_id = json_decode($curl_response)->prev_id;
			$this->next_id = json_decode($curl_response)->next_id;
			$this->order = json_decode($curl_response)->order;
			$this->desc = json_decode($curl_response)->desc;
		} 
		
		$this->result = json_decode($curl_response)->message;
		
		curl_close($curl);
	}
}