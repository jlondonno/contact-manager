<?php

require 'Slim/Slim.php';
require 'contact.php';
require 'OperationFile.php';

$app = new Slim();

$app->post('/contacts', 'addContact');
$app->put('/contacts/:id', 'updateContact');
$app->get('/contacts/:id', 'getContactById');
$app->get('/contacts', 'getContacts');

$app->run();

function addContact() {
	
	$request = Slim::getInstance()->request();
	$contact = json_decode($request->getBody());
	$operation = new OperationFile();
	$operation->addToFile($contact);
}

function updateContact($id) {
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	$contact = json_decode($body);
	$operation = new OperationFile();
	$operation->updateFile($contact, $id);
}

function getContactById($id){
	$operation = new OperationFile();
	$theContacts = $operation->getAllContacts();
	
	// Search in the Contact´s array
	foreach ($theContacts as $c) {
		if($c->getId() == $id){
			$json = json_encode($c);
		}
	}	
	echo $json;
}

function getContacts(){
	$operation = new OperationFile();
	$theContacts = $operation->getAllContactsArray();
	$json = json_encode($theContacts);
	echo $json;
}	
	

?>



