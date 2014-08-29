<?php
require_once 'jsonFile.php';
require_once 'contact.php';

class OperationFile extends JSonFile{

	function addToFile($contact){	
		try {
			$myArray =  $this->getJsonDecodeAsociativeArray();
			$maxId = $myArray['info']['id'];
				
			//Add a new element
			$myArray['contacts'][$maxId] = array('id' => $maxId + 1, 'name' => $contact->name, 'emailAddress' =>  $contact->emailAddress);
			$myArray['info']['id'] = $maxId + 1;
				
			$this->writeJson($myArray);	
		} catch(Exception $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}'; 
		}			
	}
	
	public function updateFile($contact, $id){
		try {
		
			$myArray = $this->getJsonDecodeAsociativeArray();
					
			// Modify the value, and write the structure to a file
			$myArray['contacts'][$id-1]['name'] = $contact->name;
			$myArray['contacts'][$id-1]['emailAddress'] = $contact->emailAddress;
		
			$this->writeJson($myArray);		
		} catch(Exception $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}'; 
		}		
	}
	
	private function writeJson($json){
		$fh = fopen($this->getFileJson(), 'w') or die("Error opening output file");
		fwrite($fh, json_encode($json,JSON_UNESCAPED_UNICODE));
		fclose($fh);
	}
	
	public function getAllContacts(){
	
		$data = $this->getJsonDecode();
		
		// Get the collection of contacts
		$contactos = $data->contacts;	
		$myContacts = array();
	
		// Output the search results
		foreach ($contactos as $c) {
   			$myContacts[] = new Contact($c);
		}
		
		return $myContacts;
	}
	
	public function getAllContactsArray(){	
		$data = $this->getJsonDecodeAsociativeArray();		
		return $data['contacts'];
	}
		
}
?>