<html>
<head>
<title>Contact Manager</title>
<link rel="stylesheet" href="css/styles.css" />

</head>

<body>

	<div class="header">
		<button id="btnAdd">New Contact</button>
	</div>


	<div class="leftArea">
		<ul id="contactList">
		</ul>
	</div>

	<form id="contactForm">
	
		<div class="mainArea">

			<label>Name:</label>
			<input id="name" name="name" type="text" required/>
			
			<label>E-mail Address:</label>
			<input type="text" id="email_address" name="email_address" required>
			
			<button id="btnSave">Save</button>
			
			<input id="id" name="id" type="hidden"/>

		</div>

	</form>

<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/main.js"></script>


</body>
</html>