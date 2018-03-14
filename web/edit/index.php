<?php //Page for editing asset pages.

//Pull and convert the GET variable into a php var.
$asset = $_GET["edit"];


if(ISSET($_GET['edit'])){
?>
<html>
	<!-- Initalize Page -->
	<head>
		<?php echo '<title>SHU DoIT | Editing Asset# ', $_GET['a'] ,'</title>'; ?>
		<link rel="stylesheet" type="text/css" href="../style.css">
	</head>
	<body>
		<?php
			include('header.html') . "</br>";
		?>
		<div id="main">
			<?php include('../header.html') ?>
			<br><br></br>
			<?php include('asset-edit.php') ?>
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