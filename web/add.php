<?php

//Let's process a request if we have one first. If not, the else statement will give the landing page.
//Take all the POSTS from the form and try to create an entry in our database.
if(ISSET($_GET['create'])){
	echo 'SOON';
	//Need to connect to mysql. Need to process all POSTS. Need to find a way to see if an entry already exists.
}


else{
?>
<html>
	<!-- Initalize Page -->
	<head>
		<title>SHU DoIT | Add An Asset</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<div id="main">
			<?php echo file_get_contents('header.html') ?>
			<br><br></br>
			<?php include('asset-form.htm'); ?>
		</div>
	</body>
</html>
<?php 
} ?>