<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
include_once 'database.php';
include_once 'cake.php';
  
$database = new Database();
$db = $database->getConnection();
$cake = new Cake($db);

if (!empty($_POST['id'])) { $cake->id = htmlspecialchars(strip_tags($_POST['id'])); };

if (empty($cake->id)) {
	http_response_code(422);
	echo json_encode(array('message' => 'A torta azonosítóját meg kell adni.'));		
} else {
	if ($cake->isEntityExist()) {
		$ok = $cake->delete();
		
		if ($ok) {
			http_response_code(200);
			echo json_encode(array('message' => $cake->getMessage()));		
		} else {
			http_response_code(503);
			echo json_encode(array('message' => $cake->getMessage()));					
		}	
	} else {
		http_response_code(422);
		echo json_encode(array('message' => $cake->getMessage()));		
	}
}

?>