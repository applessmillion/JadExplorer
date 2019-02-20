<?php
/*
Nice page that gets embedded to show content.
*/

#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
include_once 'config.php';
include_once 'vars.php';

##########CONNECTION INFO FOR DATABASE###########
$con = new mysqli($ip,$user,$pw,$db);

if(isset($_GET['assettag']) OR isset($_GET['assetname'])){
	if(isset($_GET['assettag'])){
		$id 	= $_GET['assettag'];
		$sql 	= mysqli_query($con, "SELECT * FROM asset_information INNER JOIN device_information ON asset_information.device_ID = device_information.Device_ID WHERE tagno='$id'");
		$obj 	= mysqli_fetch_object($sql);
	}
	else if(isset($_GET['assetname'])){
		$id 	= $_GET['assetname'];
		$sql 	= mysqli_query($con, "SELECT * FROM asset_information INNER JOIN device_information ON asset_information.device_ID = device_information.Device_ID WHERE name='$id'");
		$obj 	= mysqli_fetch_object($sql);
	}
	
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
		$astatus = "<strong style='color:lightgreen'>ACTIVE</strong>";
	}
	elseif($assetstatus == 1){
		$astatus = "<strong style='color:lightred'>DECOMISSIONED</strong>";
	}
	elseif($assetstatus == 2){
		$astatus = "<strong style='color:lightorange'>UNKNOWN</strong>";
	}
	else{
		$astatus = "Bad Data!";
	}
	
	/* Finally, echo it all into HTML. Not worrying about formatting as
	it is handled by the page it is inserted into. */
	echo $tech_css_js_styleimports;
?>
	<table class="table" style="max-width=80%">
		<thead class="thead-dark">
			<tr>
				<th scope="col"><img src="http://www.junklands.com/web/img/logo.png" align="center"></th>
				<th scope="col" style="text-align:center"><b style="font-size:22pt;"><?php echo $assetname;?></b></th>
				<th scope="col" style="text-align:right;"><?php echo $astatus;?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th colspan="3" class="table-active">
					<b style="font-size:12pt;">ASSET INFORMATION</b>
				</th>
			</tr>
			<tr>
				<td style="font-size:10pt">
					<b style="color:<?php echo $webpage_table_text_labelcolor;?>">Asset ID: </b><?php echo  $assettag;?>
				</td>
				<td style="font-size:10pt">
					<b style="color:<?php echo $webpage_table_text_labelcolor;?>">Service Number: </b><?php echo $assetservice?>
				</td>
				<td style="font-size:10pt">
					<b style="color:<?php echo $webpage_table_text_labelcolor;?>">Serial Number: </b><?php echo $assetserial?>
				</td>
			</tr>
			<tr>
				<td colspan="3" style="font-size:11px">Entry Created at <?php echo $assetcreate;?></td>
			</tr>
			<tr>
				<th colspan="3" class="table-active">
					<b style="font-size:12pt">DEVICE INFORMATION</b>
				</th>
			</tr>
			<tr>
				<td style="font-size:10pt">
					<b style="color:'. $webpage_table_text_labelcolor .';">Model: </b> <?php echo $devicemanu . " " . $devicemodel . " " . $devicemodelno; ?> 
				</td>
				<td style="font-size:10pt">
					<?php if($deviceprice > 0){ ?>
						<b style="color:'. $webpage_table_text_labelcolor .';">Cost: </b>$<?php echo $deviceprice;?>
					<?php } ?>
				</td>
			</tr>
		</tbody>
	</table>
	<a href="https://spiceworks.sienaheights.edu/search?query=<?php if($assettag == 0){echo $assetname;}else{echo $assettag;}?>" target="_blank" style='color:black;font-size:12pt'>
		<button type="button" class="btn btn-secondary btn-sm"><b>Spiceworks Search</b></button>
		<button type="button" class="btn btn-success btn-sm"><b>Edit Entry</b></button>
	</a>
<?php
}
//If for some reason ID is not set, handle it here.
else{
	echo "ERROR DISPLAYING ITEM CONTENT";
}
?> 