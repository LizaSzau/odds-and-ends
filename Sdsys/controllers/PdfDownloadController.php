<?php

class PdfDownloadController { 	
	private $config;
	private $fileLink;
	private $fileID;
	private $ok;
	
	public function getOk() { return $this->ok; }
	public function getFileName() { return $this->fileName; }
	public function getFileID() { return $this->fileID; }
	
    public function download() {
		$client = new SoapClient(Config::$SOAP_URL);
		$sessionID = $_SESSION['user']['sessionID'];
		$documentID = $_POST['document_id'];
		
		$result = $client->GetDocument($sessionID, $documentID);
		
		if (isset($result->Document->Image->ImageBase64)) {
			$pdf = base64_decode($result->Document->Image->ImageBase64, true);
			$this->fileName = Config::$DOWNLOAD_DIR.$documentID.'.pdf';
			$this->fileID = $documentID;
			file_put_contents($this->fileName, $pdf);
			$this->ok = true;
			
			return 'A kért PDF fájl letöltésre került: ';
		}
		
		if (isset($result->Error->ErrorMessage)) {
			$this->ok = false;
			return $result->Error->ErrorMessage;
		}
		
		$this->ok = false;
		return 'A letöltés nem sikerült';
    }
}
