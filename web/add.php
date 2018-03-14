<?php

//Let's process a request if we have one first. If not, the else statement will give the landing page.
//Take all the POSTS from the form and try to create an entry in our database.
if(ISSET($_GET['create-cpu'])){
	
	//Let's convert all of our posts into php vars.
	$name = $_POST['aname'];
	$atag = $_POST['assettag'];
	$stag = $_POST['servicetag'];
	$serial = $_POST['serial'];
	$type = $_POST['type'];
	$model = $_POST['model'];
	$camp = $_POST['campus'];
	$build = $_POST['build'];
	$room = $_POST['room'];
	$owner = $_POST['user'];
	$manufacturer = $_POST['manu'];
	
	//Connects to mySQL database
	include_once('config.php');
	$con = new mysqli($ip,$user,$pw,$db);
	
	/*So we need to create a thing to figure out if the optional fields are left blank or
	  not. There is probably a more efficient way to do this, but for the time being, we're
	  just going to make a lot of if statements for each of the optional fields.
	*/
	
	//If's for the 5 optional fields for cpu form
	if($stag == '' OR $stag == NULL){
		$stag = 'N/A';
	}
	if($serial == '' OR $serial == NULL){
		$serial = 'N/A';
	}
	if($model == '' OR $model == NULL){
		$model = 'N/A';
	}
	if($build == '' OR $build == NULL){
		$build = 'N/A';
	}
	if($room == '' OR $room == NULL){
		$room = 'N/A';
	}
	
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
	
	//Insert asset information
	$sqlass = "INSERT INTO shutest.assets (category, aname, asset, service, serial, owner, type, model, manu)
		    VALUES (1, '$name', '$atag', '$stag', '$serial', '$owner', '$type', '$model', '$manufacturer')";	

	//Insert asset's location information
	$sqlloc = "INSERT INTO shutest.locations (asset, room, building, campus)
		    VALUES ('$atag', '$room', '$build', '$camp')";				
			
	//Connect and insert
	$con->query($sqlass);
	$con->query($sqlloc);
	
	echo $sqlass;
	echo '</br></br>';
	echo $sqlloc;
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
			<?php include('header.html');?>
			<br></br>
			<p>
				<h1>Redirecting you to the page for <?php echo $name; ?></h1>
			</p>
		</div>
	</body>
</html>

<?php
} 	
elseif(ISSET($_GET['create-av'])){
	
	//Let's convert all of our posts into php vars.
	$name = $_POST['aname'];
	$atag = $_POST['assettag'];
	$stag = $_POST['servicetag'];
	$serial = $_POST['serial'];
	$type = $_POST['type'];
	$model = $_POST['model'];
	$camp = $_POST['campus'];
	$build = $_POST['build'];
	$room = $_POST['room'];
	$manufacturer = $_POST['manu'];
	
	//Connects to mySQL database
	include_once('config.php');
	$con_av = new mysqli($ip,$user,$pw,$db);

	/*So we need to create a thing to figure out if the optional fields are left blank or
	  not. There is probably a more efficient way to do this, but for the time being, we're
	  just going to make a lot of if statements for each of the optional fields.
	*/
	
	//If's for the 3 optional fields for cpu form
	if($aname == '' OR $aname == NULL){
		$amname	= 'N/A';
	}
	if($serial == '' OR $serial == NULL){
		$serial = 'N/A';
	}
	if($model == '' OR $model == NULL){
		$model = 'N/A';
	}

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
	
	//Insert asset information
	$sqlass = "INSERT INTO shutest.assets (category, aname, asset, service, serial, owner, type, model, manu)
		    VALUES (2, '$name', '$atag', '$stag', '$serial', 'DoIT', '$type', '$model', '$manufacturer')";	
	echo $sqlass;

	//Insert asset's location information
	$sqlloc = "INSERT INTO shutest.locations (asset, room, building, campus)
		    VALUES ('$atag', '$room', '$build', '$camp')";				
			
	//Connect and insert
	$con_av->query($sqlass);
	$con_av->query($sqlloc);
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
			<?php include('header.html');?>
			<br></br>
			<p>
				<h1>Redirecting you to the page for <?php echo $name; ?></h1>
			</p>
		</div>
	</body>
</html>
<?php 
}

//Shows CPU form if cpu is set in URL
elseif(ISSET($_GET['cpu'])){
?>
<html>
	<!-- Initalize Page -->
	<head>
		<title>SHU DoIT | Add A CPU Asset</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<div id="main">
			<?php include('header.html') ?>
			<br><br></br>
			<?php include('cpu-asset-form.htm'); ?>
		</div>
	</body>
</html>
<?php 
}

//Shows AV form if av is set in URL
elseif(ISSET($_GET['av'])){
?>
<html>
	<!-- Initalize Page -->
	<head>
		<title>SHU DoIT | Add An AV Asset</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<div id="main">
			<?php include('header.html') ?>
			<br><br></br>
			<?php include('av-asset-form.htm'); ?>
		</div>
	</body>
</html>
<?php 
}

//Make CPU default landing page for add.php
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
			<?php include('header.html') ?>
			<br><br></br>
			<?php include('cpu-asset-form.htm'); ?>
		</div>
	</body>
</html>
<?php 
} ?>