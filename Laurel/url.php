<?php
require_once('classes/Database.php');
require_once('classes/User.php');
require_once('controllers/userController.php');
require_once('controllers/contentController.php');

$act = '';
//$view = 'empty';

if (isset($_GET['act'])) {
	$act = $_GET['act'];
}

if (isset($_SESSION['user'])) {
	switch($act) {
		case 'read':
			$view = 'home';
			$contentController = new ContentController;
			$groupContents = $contentController->getGroupContents($_SESSION['user']['userGroupID']);
			$contentMain = $contentController->getArticle($_GET['content'], $_SESSION['user']['userGroupID']);
			break;
		case 'logout':
			session_destroy();
			header('Location:index.php');
			break;
		default:
			$view = 'home';
			$contentController = new ContentController;
			$groupContents = $contentController->getGroupContents($_SESSION['user']['userGroupID']);
			$contentMain = 'home_'.$_SESSION['user']['userGroupID'];
	}
} else { 
	switch($act) {
		case 'login':
			$userController = new UserController;		
			if (!$userController->login()) {
				$view = 'login';
				$users = $userController->getAllUser();
				$errorMessageLogin = 'Login is failed.<br>The e-mail or password is incorrect.';			
			} else {
				header('Location:index.php');
			}
			break;
		default:
			$view = 'login';
			$userController = new UserController;
			$users = $userController->getAllUser();
	}
}