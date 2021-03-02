<?php
require_once('controllers/UserController.php');
require_once('controllers/PdfUploadController.php');
require_once('controllers/PdfDownloadController.php');

$act = '';

if (isset($_GET['act'])) {
	$act = $_GET['act'];
}

if (isset($_SESSION['user'])) {
	switch($act) {
		case 'upload':
			$view = 'home';	
			$PdfUploadController = new PdfUploadController;		
			$uploadResult = $PdfUploadController->upload();		

			if ($PdfUploadController->getOk() === true) {
				$successMessageUpload = $uploadResult;	
			} else {
				$errorMessageUpload = $uploadResult;	
			}
			
			break;
		case 'download':
			$view = 'home';	
			$pdfDownloadController = new PdfDownloadController;		
			$downloadResult = $pdfDownloadController->download();		
			
			if ($pdfDownloadController->getOk() === true) {
				$successMessageDownload = $downloadResult;	
				$downloadedFileName = $pdfDownloadController->getFileName();	
				$downloadedFileID = $pdfDownloadController->getFileID();	
			} else {
				$errorMessageDownload = $downloadResult;	
			}
			
			break;
		case 'logout':
			$userController = new UserController;		
			$loginResult = $userController->logout();	
			header('Location:index.php');
			break;
		default:
			$view = 'home';
	}
} else { 
	switch($act) {
		case 'login':
			$userController = new UserController;		
			$loginResult = $userController->login();
		
			if ($loginResult === true) {
				header('Location:index.php');
			} else {
				$view = 'login';
				$errorMessageLogin = $loginResult;	
			}
			
			break;
		default:
			$view = 'login';
	}
}