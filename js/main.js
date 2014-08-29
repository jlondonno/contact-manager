var rootURL = "http://localhost/mycontact-manager/api/contacts";


findAll();

function findAll() {
	$.ajax({
		type: 'GET',
		url: 'api/index.php/contacts',
		dataType: "json",
		success: renderList
	});
}

function renderList(data) {

	var list = data == null ? [] : data;
	
	$('#contactList li').remove();
	
	$.each(list, function(index, object) {
		$('#contactList').append('<li><a href="#" data-identity="' + data[index].id + '">'+data[index].name+'</a></li>');
	});
}

$('#btnAdd').click(function() {
	$('#name').val(null);
	$('#email_address').val(null);
	$('#id').val(null);
	return false;
});

$('#btnSave').click(function() {
	if ($('#id').val() == '')
		addContact();
	else
		updateContact();
	return false;
});

$('#contactList a').live('click', function() {
	getContactById($(this).data('identity'));
});

function getContactById(id) {
	$.ajax({
		type: 'GET',
		contentType: 'application/json',
		url: 'api/index.php/contacts' + '/' + id,
		dataType: "json",
		success: renderContact,
      	error: function(jqXHR, textStatus, errorThrown){
			alert('search contact error: ' + textStatus);
		}
	});
}

function renderContact(contact) {
	$('#name').val(contact.name);
	$('#email_address').val(contact.emailAddress);
	$('#id').val(contact.id);
}

function addContact() {

	if(!validateForm()){
		return false;
	}
	
	$.ajax({
		type: "POST",
		contentType: 'application/json',
		url: 'api/index.php' + '/contacts', //Aqui funciona
		dataType: "json",
		data: formToJSON(),
		success: function(data, textStatus, jqXHR){
			findAll();
			alert('Contact created successfully');			
			$('#id').val(data.id);			
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('addContact error: ' + textStatus);
		}
	});
}

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if( !emailReg.test( $email ) ) {
    return false;
  } else {
    return true;
  }
}

function validateForm(){

	if($('#name').val() == ''){
		alert('the name is required!!!');
		return false;
	}
	
	if($('#email_address').val() == ''){
		alert('the email address is required!!!');
		return false;
	}

	if(!validateEmail($('#email_address').val())){
		alert('the email address is invalid!!!');
		return false;
	}
	
	return true;
}

function updateContact() {

	if(!validateForm()){
		return false;
	}

	$.ajax({
		type: 'PUT',
		contentType: 'application/json',
		url: 'api/index.php/contacts' + '/' + $('#id').val(),
		dataType: "json",
		data: formToJSON(),
		success: function(data, textStatus, jqXHR){
			findAll();
			alert('Contact updated successfully');			
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('updateContact error: ' + textStatus);
		}
	});
}

// Helper function to serialize all the form fields into a JSON string
function formToJSON() {
	return JSON.stringify({
		"id": $('#id').val(), 
		"name": $('#name').val(), 
		"emailAddress": $('#email_address').val()
		});
}



