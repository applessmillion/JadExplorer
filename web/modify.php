<?php
### RECIEVE AND HANDLE CHANGE REQUESTS.
require_once 'config.php';
$con = new mysqli($ip,$p_user,$p_pw,$db);

if(isset($_GET["tag"])){
	$info = urldecode($_GET["tag"]);
	$search = mysqli_escape_string($con, $info);
	$query = mysqli_query($con, "SELECT * FROM asset_information WHERE tagno='$info'");
	$obj = mysqli_fetch_object($query);
}
else if(isset($_GET["name"])){
	$info = urldecode($_GET["name"]);
	$search = mysqli_escape_string($con, $info);
	$query = mysqli_query($con, "SELECT * FROM asset_information WHERE name='$info'");
	$obj = mysqli_fetch_object($query);
}

### Variables from mySQL to PHP
		$assetname 		= $_POST['cname'];
		$assetservice 	= $_POST['cservice'];
		$assetcategory	= $_POST['cat'];
		$assetserial	= $_POST['cserial'];
		$mac_ethernet	= $_POST['ethernet'];
		$devicemanu		= $_POST['cmanu'];
		$devicemodel	= $_POST['cmodel'];
		$devicemodelno	= $_POST['cmodel'];
		$deviceID		= NULL;
		
		$location_building = NULL;
		$location_room = NULL;
		$location_campus = NULL;
		
	### Check if the verification matches. By default, the script's verification is "1"
		$verification	= $_POST['v'];
		$phpverify 		= 1;
?>