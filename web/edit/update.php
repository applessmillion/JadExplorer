<?php
require_once '../config.php';
require_once '../vars.php';

### Only process request if verification is correct.
if($_POST["verify"] == date('z')){
	### Let's be safe here. Only start a connection for a valid POST property.
		$con = new mysqli($ip,$p_user,$p_pw,$db);
	
	### Convert POST variables to php variables.
		$verification = $_POST["verify"];
		
		$assetname 		= $_POST["aname"]; //This should be static, as devices will set this themselves.
		$assettag 		= $_POST["atag"]; //This may not have been set via the name, so we can let this be changable.
		$assetservice 	= $_POST["service"]; //If this is already set, let's not let it be editable.
		$assetcat 		= $_POST[" "];	//Mostly a private variable, maybe not let it be edited
		$assetstatus 	= $_POST[" "];	//UNKNOWN/DECOMISSIONED/ACTIVE
		$assetpurchase	= $_POST[" "];	//When was the device purchased?
		
		$devicemanu		= $_POST[" "];	//READ-ONLY
		$devicemodel	= $_POST[" "];	//READ-ONLY
		$devicemodelno	= $_POST[" "];	//READ-ONLY
		$devicenicename	= $_POST[" "];	//Nice name for the device.
		$deviceprice	= $_POST[" "];	//Cost of the device. What we paid for the device.
		
		### editdescription will be modified quite a bit below.
		$editdescription = $_POST[""];
	
	### Edit log SQL statement.
		if(mysqli_query($con, "INSERT INTO edit_log(asset_id, descpt) VALUES ('$Entity_ID', '$editdescription')")){ return 1; }
		else{ return 0; }
		
	### Short, sweet, and to the point. ###
}
else{
	### Return 0, which will be our failure number.
	return 0;
}
?>