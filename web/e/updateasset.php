<?php
### Get database info and connect
	require_once '../config.php';
	include_once '../vars/main.php';
	$con = new mysqli($ip,$p_user,$p_pw,$db);
	
$ASSET_TAG_LENGTH_MAX = 5;
$ASSET_TAG_LENGTH_MIN = 5;
$ASSET_SERIAL_MAX 	  = 23; //Settings for the DB field
### Check to see if the method is defined. This is how we'll pull info on the device.
if(isset($_POST['method'])){
	### Get variables from POST
		$ischeckup		= $_POST['checkup'];
		$searchmethod 	= $_POST['method'];
		$assetserial	= $_POST['ctag'];
		$assetname 		= $_POST['cname'];
		$assetIP 		= $_POST['cip'];
		$assetuser 		= strtolower($_POST['curuser']);
		$mac_ethernet	= $_POST['ethernet'];
		$opsystem 		= $_POST['os'];
		$opsystemver 	= $_POST['osv'];
		$opsystemrel 	= $_POST['osr'];
		$logdesc 		= $assetuser." logged in."; //Default description
	### Check if the verification matches. By default, the script's verification is "1"
		$verification	= $_POST['v'];
		$phpverify 		= ((date('z')+1)*4);
	### Let's get a bit advanced with the asset tag 
	# If we detect a dash, we'll explode the string and get the 2nd half.
	# If not, we'll remove the characters from the tag and take the last 5 numbers.
	# If it does not contain x numbers, we'll just set it to nothing.
		if(stripos($assetname, '-') !== false){
			$assettagsplit = explode("-", $assetname); // Divide the asset name at the -
			$assettag = $assettagsplit[count($assettagsplit)-1]; // Grab the 2nd half of the asset name.
			$assettag = preg_replace('/[^0-9.]+/', '', $assettag); //Remove all characters except for numbers.
		}
		else{
			$assettag = preg_replace('/[^0-9.]+/', '', $assetname); //Remove all characters except for numbers.
			if(strlen($assettag) >= $ASSET_TAG_LENGTH_MAX){ $assettag = substr($assettag, -$ASSET_TAG_LENGTH_MAX);}
			else{n$assettag = ""; }
		}
		
	### Data verification
		if(strlen($assettag) >= $ASSET_TAG_LENGTH_MAX || strlen($assettag) >= $ASSET_TAG_LENGTH_MIN){$assettag = 0;}
		if($assetIP == "System.Object[]"){$assetIP = '0.0.0.0';}
		if(strlen($assetserial) >= $ASSET_SERIAL_MAX){ $assetserial = "0";}
		
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
	### Method #3 - Undefined
	# Doesn't do anything. 
		else{ echo "<B>ERROR</B> - Method '$searchmethod' undefined."; }
	
	$objsql = mysqli_fetch_object($sql_checkfordevice);	
	
	### If asset is not found, create it.
	if(mysqli_num_rows($sql_checkfordevice) == 0){
			$computer_model = $_POST['cmodel'];
			$computer_man 	= $_POST['cmanu'];
			$computer_mno = preg_replace('/[^0-9.]+/', '', $computer_model); //Strip away everything but numbers
			$computer_model = preg_replace('/[0-9]+/', '', $computer_model); //Strip away all numbers
		
			### SQL statements:
				$sql_checkdevices 	= "SELECT * FROM device_information WHERE model_number='$computer_mno' AND model='$computer_model' LIMIT 1";
				$sql_checkassets 	= "SELECT * FROM asset_information WHERE tagno='$assettag' AND serviceno='$assetserial' LIMIT 1";
				$sql_nodevices 		= "INSERT INTO device_information (manufacturer, model, model_number) VALUES ('$computer_man', '$computer_model', '$computer_mno')";
			### Are there results? If so, we don't have to add a new device!
				$numresults = mysqli_num_rows(mysqli_query($con,$sql_checkdevices));
				echo "Number of results: <b>" . $numresults . "</b></br>";
				if($numresults == 0){
					echo "</br>CONNECTED TO DATABASE SUCCESSFULLY</br>ADDING DEVICE TYPE TO device_information...";
					if(mysqli_query($con, $sql_nodevices)){
						$relook = $con->query($sql_checkdevices);
						$obj = mysqli_fetch_assoc($relook);
						$deviceID = $obj["Device_ID"];
						echo "<br>Success.<br>New device ID: <b>" . $deviceID . "</b><br>";
					}
					else{ echo "<br>Error adding new device."; }
				}
				else{
					$obj = mysqli_fetch_assoc(mysqli_query($con,$sql_checkdevices));
					$deviceID = $obj["Device_ID"];
					echo "</br>Connected.</br>Existing Device ID: <b>" . $deviceID . "</b></br>";
				}
				$sql_addasset = "INSERT INTO asset_information (name, tagno, serviceno, assetcategory, macaddress, device_ID, OS, OSV, OSR) 
								VALUES ('$assetname', '$assettag', '$assetserial', '1', '$mac_ethernet', '$deviceID', '$opsystem', '$opsystemver', '$opsystemrel')";
				$assetresults = mysqli_num_rows(mysqli_query($con,$sql_checkassets));
				if($assetresults == 0){
					if(mysqli_query($con,$sql_addasset)){ $logdesc = "Asset has been added to the database.";}
					else{ echo "</br>Error adding asset."; }
				}
	}
	else{
		### Add a new log entry for the device.
		$entID = $objsql->Entity_ID;
		if($ischeckup == 0){			
			### Let's check to see if anything has changed.
			if($objsql->name != $assetname){	//Check to see if the name of the asset has changed.
				mysqli_query($con, "UPDATE asset_information SET name = '$assetname' WHERE Entity_ID='$entID'");
				$logdesc = $logdesc." Asset name changed to <b>$assetname</b>.";
				echo "Updating Computer Name</br>";
			}
			if($objsql->macaddress != $mac_ethernet){	//Check to see if the ethernet has changed.
				mysqli_query($con, "UPDATE asset_information SET macaddress='$mac_ethernet' WHERE Entity_ID='$entID'");
				$logdesc = $logdesc." MAC has been updated to <b>$mac_ethernet</b>.";
				echo "Updating MAC Address</br>";
			}
			if($objsql->OS != $opsystem || $objsql->OS != $opsystem ){	//Check to see if the OS has changed. Very unlikely.
				mysqli_query($con, "UPDATE asset_information SET OS='$opsystem', OSV='$opsystemver', OSR='$opsystemrel' WHERE Entity_ID='$entID'");
				$logdesc = $logdesc." Operating System has been updated to <b>$opsystem $opsystemver</b>";
				echo "Updating OS</br>";
			}
			$sqledit = "INSERT INTO edit_log (asset_id, descpt, recent_user, recent_ip) VALUES ('$entID', '$logdesc', '$assetuser', '$assetIP')";
			mysqli_query($con, $sqledit);
		}
		else if($ischeckup == 1){
			$logdesc = "The device turned on and is checking up.";
			echo "DEVICE IS CHECKING UP FOR $entID.";
			### Let's check to see if the name has changed.
			if($objsql->name != $assetname){
				$tmpname = $objsql->name;
				mysqli_query($con, "UPDATE asset_information SET name = '$assetname' WHERE Entity_ID = '$entID'");
				$logdesc = $logdesc." Asset name changed from <b>$tmpname</b> to <b>$assetname</b>.";
				echo "DEVICE IS CHECKING UP AND CHANGING NAME.";
			}
			$sqledit = "INSERT INTO edit_log (asset_id, descpt) VALUES ('$entID', '$logdesc')";
			mysqli_query($con, $sqledit);
		}
	}
}
else{
	echo "<B>ERROR</B> - Method not defined.";
}
?> 