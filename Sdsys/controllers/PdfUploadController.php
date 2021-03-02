<?php

class PdfUploadController { 	
	private $config;
	private $ok;
	
	public function getOk() {
		return $this->ok;
	}
	
    public function upload() {
		if ($_FILES['pdf_file']['type'] != 'application/pdf') {
			$this->ok = false;
			return 'A feltöltés nem sikerült. A fájl nem PDF formátumú.';
		}
		
		$client = new SoapClient(Config::$SOAP_URL);
		$sessionID = $_SESSION['user']['sessionID'];
		$vat = $_SESSION['user']['vatNumber'];
		$vatSubPartner = '13136062';
		$xml = $this->createXML();
		
		$result = $client->SetDocument($sessionID, $vat, $vatSubPartner, $xml);
		
		if ($result->ID == 0) {
			$this->ok = false;
			return 'A feltöltés nem sikerült.';
		} else {
			$this->ok = true;
			return 'A feltöltés sikerült.<br>A dokumentum ID-je: '.$result->ID;
		}
    }
	
    private function createXML() {
		$documentID = rand(10000000,99999999);
		$documentType = 1;
		$imageType = 'pdf';
				
		$xml=simplexml_load_file('xml/upload-pdf.xml') or die();
		
		$xml->MetaData->DocumentID = $documentID;
		$xml->MetaData->DocumentType = $documentType;
		$xml->Image->ImageType = $imageType;
		$xml->Image->ImageBase64 = chunk_split(base64_encode(file_get_contents($_FILES['pdf_file']['tmp_name'])));;
		return $xml;
    }
}
