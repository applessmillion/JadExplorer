<?php
### Get database info and connect
	include_once 'config.php';
	$con = new mysqli($ip,$p_user,$p_pw,$db);

if(isset($_GET['cname'])){
	### First, we want to convert our URL vars to php vars. This makes it easier to fix their problems.
		$assetname 		= $_GET['cname'];
		$assettag 		= $_GET['cname'];
		
		$assetservice 	= $_GET['cservice'];
		$assetcategory	= $_GET['cat'];
		$assetserial	= $_GET['cserial'];

		$devicemanu		= $_GET['cmanu'];
		$devicemodel	= $_GET['cmodel'];
		$devicemodelno	= $_GET['cmodel'];
		
		$deviceID		= NULL;
	
	### Next, we need to get spaces and weird characters out of the way.
	# This includes needing to seperate the asset tag# from the name in $assettag
		$assetname; 	//Nothing needs to change
		
		$assettag = preg_replace('/[^0-9.]+/', '', $assettag); //Remove all characters except for numbers. This prevents some oopsies.
		$assettag = substr($assettag, -5, strpos($assettag, '-')); //Grabs the last 5 chars in the string. Hope people aren't dumb and input the name correctly.
		$devicemodelno = preg_replace('/[^0-9.]+/', '', $devicemodelno); //Strip away everything but numbers
		$devicemodel = preg_replace('/[0-9]+/', '', $devicemodel); //Strip away all numbers
		
		# Good to go variables:
		$assetservice;
		$assetserial;
		$devicemanu;

	### Let's print this beauty.
		echo "<b>COLLECTED DATA</b>:
			</br>assettag:" . $assettag . 
			"</br>assetname:" . $assetname . 
			"</br>assetservice:" . $assetservice . 
			"</br>assetserial: xxxxx-xxxxx-xxxxx-" . substr($assetserial, -5, strpos($assetserial, '-')) . 
			"</br>devicemodel:" . $devicemodel . 
			"</br>devicemodelno:" . $devicemodelno . 
			"</br>devicemanu:" . $devicemanu . 
			"</br></br><b>STATUS</b>:</br>";
			
	### SQL statements:
		$sql_checkdevices = "SELECT * FROM device_information WHERE model_number='$devicemodelno' AND model='$devicemodel' LIMIT 1";
		$sql_checkassets = "SELECT * FROM asset_information WHERE tagno='$assettag' AND serviceno='$assetservice' LIMIT 1";
		$sql_nodevices = "INSERT INTO device_information (manufacturer, model, model_number) VALUES ('$devicemanu', '$devicemodel', '$devicemodelno')";
	
	### Are there results? If so, we don't have to add a new device!
		$numresults = mysqli_num_rows(mysqli_query($con,$sql_checkdevices));
		echo "Number of results: " . $numresults;
		if($numresults == 0){
			echo "</br>CONNECTED TO DB SUCCESSFULLY</br>ADDING DEVICE TYPE TO device_information...";
			if(mysqli_query($con, $sql_nodevices)){
				$relook = $con->query($sql_checkdevices);
				$obj = mysqli_fetch_assoc($relook);
				$deviceID = $obj["Device_ID"];
				echo "</br>Success.</br>New device ID: " . $deviceID;
			}
		}
		else{
			$obj = mysqli_fetch_assoc(mysqli_query($con,$sql_checkdevices));
			$deviceID = $obj["Device_ID"];
			echo "</br>Connected.</br>Device ID: " . $deviceID;
		}
		
	### Get the device ID for the asset
		$sql_addasset = "INSERT INTO asset_information (name, tagno, serviceno, winserial, assetcategory, device_ID) 
						VALUES ('$assetname', '$assettag', '$assetservice', '$assetserial', '$assetcategory', '$deviceID')";
		$assetresults = mysqli_num_rows(mysqli_query($con,$sql_checkassets));
		if($assetresults == 0){
			if(mysqli_query($con,$sql_addasset)){
				echo "Added asset!";
			}
		}
		else{
				echo "</br><b>Asset has already been added.</b>";
		}
}
else{
	echo "ERROR problem inserting object";
}
?> 