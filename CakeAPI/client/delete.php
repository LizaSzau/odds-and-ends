<?php
require_once('config.php');
require_once('controllers/deleteCakeController.php');

$deleteCakeController = new deleteCakeController;
$deleteCakeController->deleteCake();

print('TÖRLÉS<p><br>');
print('Http kód: '.$deleteCakeController->getHttpCode());
print('<br>');
print($deleteCakeController->getResult());