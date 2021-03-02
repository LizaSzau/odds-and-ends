<?php
require_once('config.php');
require_once('controllers/viewCakeController.php');

$viewCakeController = new viewCakeController;
if (!empty($_GET['order'])) $viewCakeController->viewCake();

print('TORTA<p><br>');
print('Http kód: '.$viewCakeController->getHttpCode());
print('<br>');
print($viewCakeController->getResult());

print('
<p><br>
<hr>
<a href="?order=name">Megnevezés növekvő</a> | 
<a href="?order=name&desc=DESC">Megnevezés csökkenő</a> | 
<a href="?order=price">Ár növekvő</a> | 
<a href="?order=price&desc=DESC">Ár csökkenő</a> | 
<a href="?order=updated_at">Dátum</a> | 
<a href="?order=updated_at&desc=DESC">Dátum csökkenő</a>
<hr>');

$data = $viewCakeController->getJsonResult();

if ($data) {
	print('<br>ID: '.$data->id);
	print('<br>Megnevezés: '.$data->name);
	print('<br>Ár: '.$data->price);
	print('<br>Cukrász: '.$data->confectioner);
	print('<br>Vegán: '.$data->vegan);
	print('<br>Laktózmentes: '.$data->lactose_free);
	print('<br>Leírás: '.$data->description);
	print('<br>Dátum: '.$data->updated_at);

}

$prev_id = $viewCakeController->getPrevID();
$next_id = $viewCakeController->getNextID();

print('<p><br>');

if ($prev_id) {
	
	print('<a href="?id='.$prev_id.'&order='.$viewCakeController->getOrder().'&desc='.$viewCakeController->getDesc().'">Előző</a> ');
}

if ($next_id) {
	print('<a href="?id='.$next_id.'&order='.$viewCakeController->getOrder().'&desc='.$viewCakeController->getDesc().'">Következő</a> ');
}

