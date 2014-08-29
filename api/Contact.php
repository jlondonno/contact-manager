<?php
	
class Contact implements JsonSerializable
{
	private $id;
	private $name;
	private $emailAddress;
	
	public function __construct($data) {
		$this->id = $data->id;
		$this->name = $data->name;
		$this->emailAddress = $data->emailAddress;
	}
	
	public function JsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }
	
	public function getId() {
	  return $this->id;
	}
	
	public function setId( $newId )
	{
		$this->id = $newId;
	}
	
	public function getName() {
	  return $this->name;
	}
	
	public function setName( $newName )
	{
		$this->name = $newName;
	}
	
	public function getEmailAddress() {
	  return $this->emailAddress;
	}
	
	public function setEmailAddress( $newEmailAddress )
	{
		$this->emailAddress = $newEmailAddress;
	}   		
}
?>