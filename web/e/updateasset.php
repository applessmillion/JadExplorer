<?php
### Get database info and connect
	include_once 'config.php';
	$con = new mysqli($ip,$p_user,$p_pw,$db);

### Check to see if the 	
if(isset($_POST['method'])){
	
	$searchmethod 	= $_POST['method'];
	$assetserial	= $_POST['ctag'];
	$assetname 		= $_POST['cname'];
	$assetIP = $_POST['cip'];
	$assetuser = $_POST['curuser'];
	$mac_ethernet	= $_POST['ethernet'];
	$logdesc = "User ".$assetuser." has logged in."; //Default description

	### Let's get a bit advanced with the asset tag 
	# If we detect a dash, we'll explode the string and get the 2nd half.
	# If not, we'll remove the characters from the tag and take the last 5 numbers.
	# If it does not contain 5 numbers, we'll just set it to nothing.
		if(stripos($assetname, '-') !== false){
			$assettagsplit = explode("-", $assetname); // Divide the asset name at the -
			$assettag = $assettagsplit[1]; // Grab the 2nd half of the asset name.
			$assettag = preg_replace('/[^0-9.]+/', '', $assettag); //Remove all characters except for numbers.
		}
		else{
			$assettag = preg_replace('/[^0-9.]+/', '', $assetname); //Remove all characters except for numbers.
			if(strlen($assettag >= 5)){
				$assettag = substr($assettag, -5); //In case it is like SCI3015555
			}
			else{
				### Just set assettag to nothing.
				$assettag = "";
			}
		}
	
	### Devices can have multiple IPs. We will fix this by EXPLODING the string.
		$assetIPsplit = explode(" ", $assetIP);
		$assetIP = $assetIPsplit[0]; //Sets the IP to the first one in the list. We don't really care about which one is selected.
	
	### For updates, we should expect data to change a lot. This means we need to have multiple methods to find the device.
	
	### Method #1 - Service Tag. These are fairly unique, and if it has one, that's great. They never change.
	# Prefer this method as human error is next to none since it's added automatically.
		if($searchmethod == "service"){
			$sql_checkfordevice = mysqli_query($con, "SELECT * FROM asset_information WHERE serviceno='$assetserial' ORDER BY createdate LIMIT 1");
			echo "Submitting update information based on <B>SERVICE TAG</B></br>";
		}
	### Method #2 - Asset tag. These should never change, but devices may change.
	# In case we run into multiple entries, the SQL statement will fetch the most recently added asset.
		elseif($searchmethod == "tag"){
			$sql_checkfordevice = mysqli_query($con, "SELECT * FROM asset_information WHERE tagno='$assettag' ORDER BY createdate LIMIT 1");
			echo "Submitting update information based on <B>ASSET NUMBER</B></br>";
		}
	### Method #3 - Checking up
		elseif($searchmethod == "checkup"){
			echo "Checking up!";
		}
	### Method #4 - Undefined
	# Doesn't do anything. 
		else{ echo "<B>ERROR</B> - Method '$search' undefined."; }
	
	$objsql = mysqli_fetch_object($sql_checkfordevice);
		
	### Add a new log entry for the device.
		$entID = $objsql->Entity_ID;
		
		if(!isset($_POST['nosubmit'])){
			### Let's check to see if anything has changed.
			if($objsql->name != $assetname){	//Check to see if the name of the asset has changed.
				mysqli_query($con, "UPDATE asset_information SET name = '$assetname' WHERE Entity_ID = '$entID'");
				$logdesc = $logdesc." Asset name changed to $assetname";
			}
			$sqledit = "INSERT INTO edit_log (asset_id, descpt, recent_user, recent_ip) VALUES ('$entID', '$logdesc', '$assetuser', '$assetIP')";
			mysqli_query($con, $sqledit);
		}
		elseif($searchmethod == "checkup"){
			$logdesc = "The device has checked up.";
			### Let's check to see if the name has changed.
			if($objsql->name != $assetname || $objsql->macaddress != $mac_ethernet){
				mysqli_query($con, "UPDATE asset_information SET name = '$assetname', macaddress = '$mac_ethernet' WHERE Entity_ID = '$entID'");
				$logdesc = $logdesc." Asset name changed to $assetname";
			}
			$sqledit = "INSERT INTO edit_log (asset_id, descpt, recent_ip) VALUES ('$entID', '$logdesc', '$assetIP')";
			mysqli_query($con, $sqledit);
		}
}
else{
	echo "<B>ERROR</B> - Method not defined.";
}
?> 