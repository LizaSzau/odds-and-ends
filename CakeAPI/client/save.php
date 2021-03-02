<?php
require_once('config.php');
require_once('controllers/saveCakeController.php');

$saveCakeController = new saveCakeController;
$saveCakeController->saveCake();

print('FELVITEL / MÓDOSÍTÁS<p><br>');
print('Http kód: '.$saveCakeController->getHttpCode());
print('<br>');
print($saveCakeController->getResult());