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
if (!empty($_POST['name'])) { $cake->name = htmlspecialchars(strip_tags($_POST['name'])); };
if (!empty($_POST['price'])) { $cake->price = htmlspecialchars(strip_tags($_POST['price'])); };
if (!empty($_POST['confectioner'])) { $cake->confectioner = htmlspecialchars(strip_tags($_POST['confectioner'])); };
if (!empty($_POST['vegan'])) { $cake->vegan = htmlspecialchars(strip_tags($_POST['vegan'])); };
if (!empty($_POST['lactose_free'])) { $cake->lactose_free = htmlspecialchars(strip_tags($_POST['lactose_free'])); };
if (!empty($_POST['description'])) { $cake->description = htmlspecialchars(strip_tags($_POST['description'])); };
$cake->created_at = date('Y-m-d H:i:s');

$error = array();

if (strlen($cake->name) == 0) {
	$error[] = 'A torta nevét kötelező megadni.';
}

if (!(is_numeric($cake->price) && $cake->price > 0)) {
	$error[] = 'Az árat kötelező megadni és csak szám lehet.';
}

if ($cake->vegan != 1) $cake->vegan = 0;
if ($cake->lactose_free != 1) $cake->lactose_free = 0;

if (count($error) > 0) {
    http_response_code(422);
    echo json_encode(array('message' => $error));	
} else {
	if ($cake->id > 0) {
		
		if ($cake->isEntityExist()) {
			$ok = $cake->update();
			
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
	} else {
		$ok = $cake->create();
		
		if ($ok) {
			http_response_code(200);
			echo json_encode(array('message' => $cake->getMessage()));		
		} else {
			http_response_code(503);
			echo json_encode(array('message' => $cake->getMessage()));					
		}
	}
}

?>