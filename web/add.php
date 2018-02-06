<?php

//Let's process a request if we have one first. If not, the else statement will give the landing page.
//Take all the POSTS from the form and try to create an entry in our database.
if(ISSET($_GET['create'])){
	
	//Let's convert all of our posts into php vars.
	$name = $_POST['aname'];
	$atag = $_POST['assettag'];
	$stag = $_POST['servicetag'];
	$type = $_POST['type'];
	$model = $_POST['model'];
	$camp = $_POST['campus'];
	$loc = $_POST['location'];
	$owner = $_POST['user'];
	
	//Connects to mySQL database
	include_once('config.php');
	$con = new mysqli($ip,$user,$pw,$db);
	
	
	####NOTICE. THIS IS FOR ME TO KNOW WHAT IM DOING LATER... READ BELOW####
	/*
	I will not be creating an error catching system right now. It will take a bit of time to make.
	However, in case you forget how to do it in the future, if it is even needed, here's how:
	Make a seperate sqlquery to check for any conflicts in the system. Check if there are multiple
	computers named the same, if there's an asset tag in the system (v important), and then create
	an else statement with the sucessful addition, along with a nice confirmation message. If any of
	the ifs are met, show an error message with the error. If it errors, DO NOT INSERT CRAP.
	*/
	
	//Now for the fun part... Adding it to the db
	
	//The sql to use for inserting into the db
	$sql = "INSERT INTO shutest.assets (aname, asset, service, type, model, campus, location, owner)
		    VALUES ('$name', '$atag', '$stag', '$type', '$model', '$camp', '$loc', '$owner')";		
			
	//Connect and insert
	$con->query($sql);
	
?>
<html>
	<!-- Initalize Page -->
	<head>
		<title>SHU DoIT | Asset Added</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<?php echo '<meta http-equiv="refresh" content="2; url=search.php?a=',$atag,'" />'; ?>
	</head>
	
	<body>
		<div id="main">
			<?php echo file_get_contents('header.html');?>
			<br></br>
			Redirecting you to the page for <?php echo $name; ?>
		</div>
	</body>
</html>
<?php 
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