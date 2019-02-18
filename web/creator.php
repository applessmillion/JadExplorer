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
	$sql 	= mysqli_query($con, "SELECT * FROM asset_information INNER JOIN device_information ON asset_information.device_ID = device_information.Device_ID WHERE tagno='$id'");
	$obj 	= mysqli_fetch_object($sql);
	/////////////////////////////////////////

	$assetname 		= $_GET['cname'];
	$assettag 		= $obj->tagno;
	
	$assetservice 	= $obj->serviceno;
	$assetserial 	= $obj->serialno;
	$assetcat 		= $obj->assetcategory;
	//$assetstatus 	= $obj->status;
	//$assetcreate	= $obj->createdate;
	
	$devicemanu		= $obj->manufacturer;
	$devicemodel	= $obj->model;
	$devicemodelno	= $obj->model_number;
	$deviceprice	= $obj->model_price;








	
	//$dblisting 		= $obj->Entity_ID;
	//$dbdevice 		= $obj->Device_ID;
	
	$assetname 		= $obj->name;
	$assettag 		= $obj->tagno;
	$assetservice 	= $obj->serviceno;
	$assetserial 	= $obj->serialno;
	$assetcat 		= $obj->assetcategory;
	//$assetstatus 	= $obj->status;
	//$assetcreate	= $obj->createdate;
	
	$devicemanu		= $obj->manufacturer;
	$devicemodel	= $obj->model;
	$devicemodelno	= $obj->model_number;
	$deviceprice	= $obj->model_price;
	
	if($assetstatus == 0){
		$astatus = "<strong style='color:darkgreen'>ACTIVE</strong>";
	}
	elseif($assetstatus == 1){
		$astatus = "<strong style='color:darkred'>DECOMISSIONED</strong>";
	}
	elseif($assetstatus == 2){
		$astatus = "<strong style='color:orange'>UNKNOWN</strong>";
	}
	else{
		$astatus = "Bad Data!";
	}
	
	/* Finally, echo it all into HTML. Not worrying about formatting as
	it is handled by the page it is inserted into. */
	echo '<link rel="stylesheet" type="text/css" href="iframestyle.css">';
	
	
	echo '<table align="center" width="675">';
	echo '<tr><th><img src="http://www.junklands.com/web/img/logo.png" align="center"></th>';
	echo '<td><b style="line-height:1.15; font-size:12pt">' . $assetname . '</b></td><td style="font-size:11pt">'. $astatus .'</td>';
	echo '<tr><td colspan="3">Entry Created at '. $assetcreate .'</td></tr>';
	echo '<tr><td colspan="3">'.$widget_webpage_border_large .'</td></tr>';
	echo '<tr><th colspan="3"></br><b style="font-size:13pt;"><u>ASSET INFORMATION</u></b></th></tr>';
	echo '<tr><td><b style="color:darkorange;font-size:11pt">Asset #' . $assettag . ' </b></td>';
	echo '<td><b style="color:darkgreen;font-size:11pt">Service #' . $assetservice . ' </b></td>';
	echo '<td><b style="color:darkblue;font-size:11pt">Serial #' . $assetserial . ' </b></td></tr>';
	echo '<tr style="height:28px"><th colspan="3"></br><b style="font-size:13pt"><u>DEVICE INFORMATION</u></b></th></tr>';
	echo '<tr><td><b style="font-size:10pt">' . $devicemanu . " " . $devicemodel . " " . $devicemodelno . ' </b></td>';
	echo '<td><b style="font-size:10pt">Cost: $' . $deviceprice . ' </b></td></tr>';
	echo '</table>';
}

//If for some reason ID is not set, handle it here.
else{
	echo "ERROR DISPLAYING ITEM CONTENT";
}
?> 