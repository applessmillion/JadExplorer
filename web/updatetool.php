<?php
### Get database info and connect
	include_once 'config.php';
	$con = new mysqli($ip,$p_user,$p_pw,$db);

### Check to see if the 	
if(isset($_GET['method'])){
	
	$searchmethod = $_GET['method'];
	$assetserial	= $_GET['cserial'];
	$assettag 		= $_GET['cname'];
		$assettag = substr($assettag, -5, strpos($assettag, '-')); //Grabs the last 5 chars in the string. Hope people aren't dumb and input the name correctly.
	$assetIP = $_GET['cip'];
	$assetuser = $_GET['cuser'];
	
	### For updates, we should expect data to change a lot. This means we need to have multiple methods to find the device.
	
	### Method #1 - Service Tag. These are fairly unique, and if it has one, that's great. They never change.
	# Prefer this method as human error is next to none since it's added automatically.
		if($searchmethod == "service"){
			$sql_checkfordevice = "SELECT * FROM asset_information WHERE serviceno='$assetserial' ORDER BY creation_date LIMIT 1";
			echo "Submitting update information based on <B>SERVICE TAG</B></br>";
		}
	### Method #2 - Asset tag. These should never change, but devices may change.
	# In case we run into multiple entries, the SQL statement will fetch the most recently added asset.
		elseif($searchmethod == "tag"){
			$sql_checkfordevice = "SELECT * FROM asset_information WHERE tagno='$assettag' ORDER BY creation_date LIMIT 1";
			echo "Submitting update information based on <B>ASSET NUMBER</B></br>";
		}
	### Method #3 - Undefined
	# Doesn't do anything. 
		else{
			echo "<B>ERROR</B> - Method '$search' undefined.";
		}
	
	/*
		General outline:
		
		Create array for UPDATE statement.
		Create if's for if a value is NOT NULL
		ex. if($_GET['serviceno'] != "" OR NULL){ $assetarray = $assetarray.push("serviceno")};
		
		Then make an SQL statement like:
			UPDATE blah blah ($assetarray) VALUES ($_GET['serviceno'])
}
else{
	echo "<B>ERROR</B> - Method not defined.";
}
?> 