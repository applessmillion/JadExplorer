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
	
	$dblisting 		= $obj->Entity_ID;
	$dbdevice 		= $obj->Device_ID;
	
	$assetname 		= $obj->name;
	$assettag 		= $obj->tagno;
	$assetservice 	= $obj->serviceno;
	$assetserial 	= $obj->serialno;
	$assetcat 		= $obj->assetcategory;
	$assetstatus 	= $obj->status;
	$assetcreate	= $obj->createdate;
	
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
	echo $tech_css_js_styleimports;
	
	
	echo '
	<table class="table" width="655">
		<thead>
			<tr>
				<th scope="col"><img src="http://www.junklands.com/web/img/logo.png" align="center"></th>
				<th scope="col"><b style="line-height:1.15;font-size:14pt;text-align:left;">' . $assetname . '</b></th>
				<th scope="col" style="text-align: right;">'. $astatus .'</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th colspan="3">
					<b style="font-size:12pt;">ASSET INFORMATION</b>
				</th>
			</tr>
			<tr>
				<td style="font-size:10pt">
					<b style="color:'. $webpage_table_text_labelcolor .';">Asset ID: </b>' . $assettag . ' 
				</td>
				<td style="font-size:10pt">
					<b style="color:'. $webpage_table_text_labelcolor .';">Service Number: </b>' . $assetservice . ' 
				</td>
				<td style="font-size:10pt">
					<b style="color:'. $webpage_table_text_labelcolor .';">Serial Number: </b>' . $assetserial . '
				</td>
			</tr>
			<tr>
				<td colspan="3" style="font-size:11px">Entry Created at '. $assetcreate .'</td>
			</tr>
			<tr>
				<th colspan="3">
					<b style="font-size:12pt">DEVICE INFORMATION</b>
				</th>
			</tr>
			<tr>
				<td style="font-size:10pt">
					<b style="color:'. $webpage_table_text_labelcolor .';">Model: </b>' . $devicemanu . " " . $devicemodel . " " . $devicemodelno . ' 
				</td>
				<td style="font-size:10pt">
					<b style="color:'. $webpage_table_text_labelcolor .';">Cost: </b>$' . $deviceprice . ' 
				</td>
			</tr>
		</tbody>
	</table>
	<p style="text-align:center"><a href="https://spiceworks.sienaheights.edu/search?query=15746" target="_blank"><b>Spiceworks Search</b> (Must be logged into Spiceworks)</a></p>
	';
}

//If for some reason ID is not set, handle it here.
else{
	echo "ERROR DISPLAYING ITEM CONTENT";
}
?> 