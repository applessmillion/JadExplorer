<?php

//a = asset tag number. If not set, let the user search for one
if(ISSET($_GET['a'])){
?>
<html>
	<!-- Initalize Page -->
	<head>
		<?php echo '<title>SHU DoIT | Asset# ', $_GET['a'] ,'</title>'; ?>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<div id="main">
			<?php echo file_get_contents('header.html') ?>
			<br><br></br>
			<?php include('asset-display-form.php'); ?>
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
		<title>SHU DoIT | Search Assets</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<div id="main">
			<?php echo file_get_contents('header.html') ?>
			<br><br></br>
			<?php include('search-form.htm'); ?>
		</div>
	</body>
</html>
<?php 
} ?>