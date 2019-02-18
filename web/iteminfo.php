<?php
/*
Nice page that gets embedded to show content.
*/

#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
include_once 'config.php';
include_once 'vars.php';

##########CONNECTION INFO FOR DATABASE###########
$con = new mysqli($ip,$user,$pw,$db);

if(isset($_GET['assettag'])){
	$id 	= $_GET['assettag'];
	$sql 	= mysqli_query($con, "SELECT * FROM asset_information INNER JOIN device_information ON asset_information.device_ID = device_information.Device_ID");
	$obj 	= mysqli_fetch_object($sql);
	/////////////////////////////////////////
	
	$dblisting 		= $obj->Entity_ID;
	$dbdevice 		= $obj->Device_ID;
	
	$assetname 		= $obj->name;
	$assettag 		= $obj->tagno;
	$assetservice 	= $obj->serviceno;
	$assetserial 	= $obj->serialno;
	$assetcat 		= $obj->assetcategory;
	$assetstatus 	= $obj->status;
	
	$devicemanu		= $obj->manufacturer;
	$devicemodel	= $obj->model;
	$devicemodelno	= $obj->model_number;
	$deviceprice	= $obj->model_price;
	
	if($assetstatus == 0){
		$astatus = "<strong style='color:darkgreen'>ACTIVE</strong>";
	}
	elseif($assetstatus == 1){
		$astatus = "D<strong style='color:darkred'>DECOMISSIONED</strong>";
	}
	elseif($assetstatus == 2){
		$astatus = "<strong style='color:orange'>UNKNOWN</strong>";
	}
	else{
		$astatus = "Bad Data!";
	}
	
	/* Finally, echo it all into HTML. Not worrying about formatting as
	it is handled by the page it is inserted into. */
	echo '<table align="center" width="500">';
	echo '<tr><th><img src="http://www.junklands.com/web/img/logo.png" align="center"></th></tr>';
	echo '<tr><td><b style="font-size:12pt;"><u>ASSET INFORMATION</u></b></td></tr>';
	echo '<tr><td><b style="line-height:1.15; font-size:10pt">' . $assetname . '</b></td><td style="font-size:10pt">Status: '. $astatus .'</td></br>';
	echo '<tr><td><b style="color:darkorange;font-size:10pt">Asset # ' . $assettag . ' </b></td>';
	echo '<td><b style="color:darkgreen;font-size:10pt">Service # ' . $assetservice . ' </b></td>';
	echo '<td><b style="color:darkblue;font-size:10pt">Serial # ' . $assetserial . ' </b>';
	echo '</td></tr>';
	echo '<tr><td><b style="font-size:12pt;height:28px;"><u>DEVICE INFORMATION</u></b></td></tr>';
	echo '<tr><td><b style="font-size:11pt">' . $devicemanu . $devicemodel . $devicemodelno . ' </b></td>';
	echo '<td><b style="font-size:10pt">Cost: $' . $deviceprice . ' </b>';		 
	echo '</td></tr></table>';
}

//If for some reason ID is not set, handle it here.
else{
	echo "ERROR DISPLAYING ITEM CONTENT";
}
?> 