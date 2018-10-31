<?php
require 'config.php';
require 'vars_common.php';

//Create instance for MySQL connection
$con = new mysqli($ip,$user,$pw,$db);


//a = asset tag number. If not set, let the user search for one
if(ISSET($_GET['a'])){
	
	$asse = $_GET['a'];
	$search_query = mysqli_query($con, "SELECT * FROM assets WHERE asset LIKE '%$asse%' ORDER BY asset ASC LIMIT 25");
	$search_nums = mysqli_num_rows($search_query);
	
	if($search_nums == 1){
		?>
		<html>
			<!-- Initalize Page -->
			<head>
				<?php echo '<title>' . $cv_webpage_title . ' | Asset# ' . $_GET['a'] . '</title>'; ?>
				<link rel="stylesheet" type="text/css" href="style.css">
			</head>
	
			<body>
				<div id="main">
					<?php include('header.html') ?>
					<br><br></br>
					<?php include('asset-display-form.php'); ?>
				</div>
			</body>
		</html>
		<?php
	}
	elseif($search_nums > 1){
		?>
		<html>
			<!-- Initalize Page -->
			<head>
				<?php echo '<title>' . $cv_webpage_title . ' | Search  #' . $_GET['a'] . '</title>'; ?>
				<link rel="stylesheet" type="text/css" href="style.css">
			</head>
	
			<body>
				<div id="main">
					<?php include('header.html') ?>
					<br><br></br>
					<?php include('search-display.php'); ?>
				</div>
			</body>
		</html>
		<?php
	}
	elseif($search_nums == 0){
		?>
		<html>
			<!-- Initalize Page -->
			<head>
				<?php echo '<title>' . $cv_webpage_title . ' | Search  #' . $_GET['a'] . '</title>'; ?>
				<link rel="stylesheet" type="text/css" href="style.css">
			</head>
	
			<body>
				<div id="main">
					<?php include('header.html') ?>
					<br><br></br>
					<?php include('asset-display-form.php'); ?>
				</div>
			</body>
		</html>
		<?php
	}

}
//Handle for asset name search
elseif(ISSET($_GET['n'])){
?>
<html>
	<!-- Initalize Page -->
	<head>
		<?php echo '<title>' . $cv_webpage_title . ' | Search ' . $_GET['n'] . '</title>'; ?>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<div id="main">
			<?php include('header.html') ?>
			<br><br></br>
			<?php include('search-display.php'); ?>
		</div>
	</body>
</html>
<?php
}
//Handle for username search
elseif(ISSET($_GET['u'])){
?>
<html>
	<!-- Initalize Page -->
	<head>
		<?php echo '<title>' . $cv_webpage_title . ' | Search ' . $_GET['u'] . '</title>'; ?>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<div id="main">
			<?php include('header.html') ?>
			<br><br></br>
			<?php include('search-display.php'); ?>
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
		<title><?php $cv_webpage_title ?></title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<div id="main">
			<?php include('header.html') ?>
			<br><br></br>
			<?php include('search-form.htm'); ?>
		</div>
	</body>
</html>
<?php 
} ?>