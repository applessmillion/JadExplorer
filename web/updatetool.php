<?php
### Get database info and connect
	include_once 'config.php';
	$con = new mysqli($ip,$p_user,$p_pw,$db);

### Check to see if the 	
if(isset($_GET['method'])){
	
	$search = $_GET['method'];
	
	### For updates, we should expect data to change a lot. This means we need to have multiple methods to find the device.
	
	### Method #1 - Service Tag. These are fairly unique, and if it has one, that's great. They never change.
	# Prefer this method as human error is next to none since it's added automatically.
		if($_GET['method'] == "service"){
			$sql_checkfordevice = "SELECT * FROM asset_information WHERE serviceno="" ORDER BY creation_date LIMIT 1";
			echo "Submitting update information based on <B>SERVICE TAG</B></br>";
		}
	### Method #2 - Asset tag. These should never change, but devices may change.
	# In case we run into multiple entries, the SQL statement will fetch the most recently added asset.
		elseif($_GET['method'] == "tag"){
			$sql_checkfordevice = "SELECT * FROM asset_information WHERE tagno="" ORDER BY creation_date LIMIT 1";
			echo "Submitting update information based on <B>ASSET NUMBER</B></br>";
		}
	### Method #3 - Undefined
	# Doesn't do anything. 
		else{
			echo "<B>ERROR</B> - Method '$search' undefined.";
		}
	
}
else{
	echo "<B>ERROR</B> - Method not defined.";
}
?> 