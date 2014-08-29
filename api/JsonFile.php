<?php
	
class JSonFile{

	private $fileJson = "../jsonContacts.json"; 
	
	public function getJsonDecode(){
		$json = file_get_contents($this->fileJson);
		return json_decode($json);
	}
	
	public function getJsonDecodeAsociativeArray(){
		$json = file_get_contents($this->fileJson);
		return json_decode($json, true);
	}
	
	public function getFileJson() {
	  return $this->fileJson;
	}
	
	public function setFileJson( $newFileJson ){
		$this->fileJson = $newFileJson;
	}		
}
?>