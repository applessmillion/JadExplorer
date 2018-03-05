<?php //Page for editing asset pages.

//Has the mySQL connection info
include_once('config.php');

//Connects to mySQL database
$con = new mysqli($ip,$user,$pw,$db);

//Pull and convert the GET variable into a php var.
$asset = $_GET["a"];

//SQL statement to pull data from the ASSET table
$assetsql = "SELECT * from shutest.assets WHERE asset='$asset';";

//SQL statement to pull data from the LOCATION table
$locsql = "SELECT * from shutest.locations WHERE asset='$asset';";

if(ISSET($_GET['a'])){
?>
<html>
	<!-- Initalize Page -->
	<head>
		<?php echo '<title>SHU DoIT | Editing Asset# ', $_GET['a'] ,'</title>'; ?>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<div id="main">
			<?php echo file_get_contents('header.html') ?>
			<br><br></br>
			<?php 
			//Copy and paste the file here, so php vars can be filled in.
			include('asset-display-form.php'); ?>
		</div>
	</body>
</html>
<?php
//Need to connect to mysql. Search DB like SELECT * FROM assets WHERE asset like %$_GET['a']%
}
//n = name. Used mostly for username searches. Maybe that would be more convenient...
elseif(ISSET($_GET['n'])){
	echo 'LATER THAN SOON';
	//Need to connect to mysql. Search DB like SELECT * FROM assets WHERE asset like %$_GET['a']%
}
else{
?>
<html>
	<!-- Initalize Page -->
	<head>
		<title>SHU DoIT | Error</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<div id="main">
			<?php echo file_get_contents('header.html') ?>
			<br><br></br>
			There was an error editing the asset (No Asset Found).
		</div>
	</body>
</html>
<?php 
} ?>