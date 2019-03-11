<?php
### Webpage that displays mySQL data in a table. Has an embedded mode
# and a full mode. Webpage is embedded in search results on search.php?info*

include_once 'config.php';
include_once 'vars.php';

if(isset($_GET['assettag']) OR isset($_GET['assetname'])){
	### CONNECTION INFO FOR DATABASE
	$con = new mysqli($ip,$user,$pw,$db);
	
	### Figure out how we'll limit our db results
	if(isset($_GET['assettag'])){ $sqldiff = "tagno='".$_GET['assettag']."'";}
	else if(isset($_GET['assetname'])){ $sqldiff = "name='".$_GET['assetname']."'";}
	
	$sql_statement = "
		SELECT Entity_ID, tagno, name, serviceno, serialno, macaddress, winserial, assetcategory, status, createdate, purchasedate, manufacturer, model, model_number, model_price, friendly_name 
		FROM asset_information INNER JOIN device_information ON asset_information.device_ID = device_information.Device_ID
		WHERE $sqldiff LIMIT 1";
	$sql 	= mysqli_query($con, $sql_statement);
	$obj 	= mysqli_fetch_object($sql);
	$sql_e 	= mysqli_query($con, "SELECT * FROM edit_log WHERE asset_id='$obj->Entity_ID' && recent_user IS NOT NULL ORDER BY editdate DESC LIMIT 1");
	$obj_e 	= mysqli_fetch_object($sql_e);
	
	$dblisting 		= $obj->Entity_ID;
	$assetname 		= $obj->name;
	$assettag 		= $obj->tagno;
	$assetservice 	= $obj->serviceno;
	$assetserial 	= $obj->serialno;
	$assetmac 	 	= $obj->macaddress;
	$assetcat 		= $obj->assetcategory;
	$assetstatus 	= $obj->status;
	$assetip		= $obj_e->recent_ip;
	$assetuser		= $obj_e->recent_user;
	
	$devicemanu		= $obj->manufacturer;
	$devicemodel	= $obj->model;
	$devicemodelno	= $obj->model_number;
	$devicenicename	= $obj->friendly_name;
	$deviceprice	= $obj->model_price;
	
	### Doesn't need any timezone or DST checking. This is manually entered.
	$assetpurchase	= date('F j, Y', strtotime($obj->purchasedate));
	
	$assetedited	= date('F j, Y, g:ia', strtotime($obj_e->editdate)+$utility_timezone_offset);
	$assetcreate	= date('F j, Y, g:ia', strtotime($obj->createdate)+$utility_timezone_offset);
	
	### If the DST fix is on, here's how we do it.
	# I love PHP for that strtotime magic
	if($enable_daylight_savings_adjustments == TRUE){
		### FOR THE PRICE HISTORY
		if(strtotime($obj_e->editdate) >= date(strtotime("second Sunday of March ".date('Y', strtotime($obj_e->editdate)))) && 
		   strtotime($obj_e->editdate) <= date(strtotime("first Sunday of November ".date('Y', strtotime($obj_e->editdate))))){
			### Add an extra hour. This takes place during daylight savings.
			$assetedited = date('F j, Y, g:ia', strtotime($obj_e->editdate)+($utility_timezone_offset+3600));
		}
		else{ $assetedited = date('M j, Y, g:ia', strtotime($obj_e->editdate)+$utility_timezone_offset); }
		### FOR CREATEDATE
		if(strtotime($obj->createdate) >= date(strtotime("second Sunday of March ".date('Y', strtotime($obj->createdate)))) && 
		   strtotime($obj->createdate) <= date(strtotime("first Sunday of November ".date('Y', strtotime($obj->createdate))))){
			### Add an extra hour. This takes place during daylight savings.
			$assetcreate = date('F j, Y, g:ia', strtotime($obj->createdate)+($utility_timezone_offset+3600));
		}
		else{ $assetcreate = date('M j, Y, g:ia', strtotime($obj->createdate)+$utility_timezone_offset); }
	}	
	### We need the elses or it'll just print both dates. Best not do that.
	else{ echo date('M j, Y, g:ia', strtotime($objhis->editdate)+$utility_timezone_offset); }
														
	### Set null variables to N/A
		if($assettag == 0 OR NULL){ $assettag = "N/A";}
		if($assetserial == 0 OR NULL){ $assetserial = "N/A";}
	
	### Set status of the device
	if($assetcat == 0){ $astatus = "Unpublished Device";}
	elseif($assetstatus == 0){ $astatus = "<strong style='color:lightgreen' class='mx-1'>ACTIVE</strong>"; }
	elseif($assetstatus == 1){ $astatus = "<strong style='color:red' class='mx-1'>DECOMISSIONED</strong>"; }
	elseif($assetstatus == 2){ $astatus = "<strong style='color:orange' class='mx-1'>UNKNOWN</strong>"; }
	else{ $astatus = "Bad Data!";}
	
	### Set text category for the device
	if($assetcat == 0){ $acat = "Unpublished Device"; $img_deviceico = "http://www.junklands.com/web/img/logo.png"; }
	elseif($assetcat == 1){ $acat = "Windows Computer"; $img_deviceico = "http://www.junklands.com/web/img/computer.png";}
	elseif($assetcat == 2){ $acat = "SHU Server"; $img_deviceico = "http://www.junklands.com/web/img/server.png";}
	else{$acat = "Bad Category!";}
	
	### Visit the tracking URL for *published* devices only.
	if($assetcat != 0){
		$staturl = "http://junklands.com/web/tracker.php?visit=".$obj->Entity_ID;
		file("$staturl");
	}
	
	### Echo variable containing Bootstrap stuff.
	echo $tech_css_js_styleimports;
	
if(isset($_GET['embedded']) == false){ ?>
	<head>
		<title><?php echo $text_iteminfo_page_title; ?></title>
	</head>
	<?php echo $tech_html_head_start_body; ?>
		<div>
			<?php 
				echo file_get_contents("gtag.html");
				echo file_get_contents("header.html");
			?>
			</br>
		</div>
		<div class="card" style="margin: 0 auto;max-width:50%;min-width:600px">
<?php } ?>
<div class="card" style="max-width=80%;">
	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col"><img src="<?php echo $img_deviceico; ?>" style="max-width:30%;min-width:15%"></th>
				<th scope="col" style="text-align:center"><b style="font-size:21pt;"><?php echo $assetname;?></b></th>
				<th scope="col" style="text-align:right;"><?php echo $astatus;?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th colspan="3" class="table-active">
					<b style="font-size:12pt;"><?php echo $text_iteminfo_assetinfo_title; ?></b>
				</th>
			</tr>
			<?php if($assetpurchase != $utility_timezone_offset_origindate){ ?>
				<tr>
					<td colspan="3" style="font-size:14px"><b><?php echo $text_infobox_buydate.$assetpurchase;?></b></td>
				</tr>
			<?php } ?>
			<tr>
				<td style="font-size:10pt">
					<b style="color:<?php echo $webpage_table_text_labelcolor;?>">Asset ID: </b><?php echo  $assettag;?>
				</td>
				<td style="font-size:10pt">
					<b style="color:<?php echo $webpage_table_text_labelcolor;?>">Service Number: </b>
					<?php if($devicemanu == "Dell Inc."){ ?>
						<a href="https://www.dell.com/support/home/us/en/04/product-support/servicetag/<?php echo $assetservice; ?>/" target="_blank"><?php echo $assetservice; ?></a>
					<?php }else{ echo $assetservice; }?>
				</td>
				<td style="font-size:10pt">
					<b style="color:<?php echo $webpage_table_text_labelcolor;?>">Serial Number: </b><?php echo $assetserial; ?>
				</td>
			</tr>
			<tr>
				<?php if($assetip){ ?>
				<td style="font-size:10pt">
					<b style="color:<?php echo $webpage_table_text_labelcolor;?>">Recent IP: </b><?php echo  $assetip;?>
				</td>
				<?php } ?>
				<?php if($assetuser){ ?>
				<td style="font-size:10pt">
					<b style="color:<?php echo $webpage_table_text_labelcolor;?>">Recent User: </b><?php echo  $assetuser;?>
				</td>
				<?php } ?>
				<?php if($assetmac != ""){ ?>
				<td style="font-size:10pt">
					<b style="color:<?php echo $webpage_table_text_labelcolor;?>">Ethernet MAC: </b><?php echo  $assetmac;?>
				</td>
				<?php } ?>
			</tr>
			<tr>
				<th colspan="2" class="table-active">
					<b style="font-size:12pt"><?php echo $text_iteminfo_deviceinfo_title; ?></b>
				</th>
				<th colspan="1" class="table-active" style="text-align:right;">
					<b class="mx-1" style="font-size:10pt;"><?php echo  $acat ?>
				</th>
			</tr>
			<tr>
				<?php
					if($assetcat != 2){?>
						<td colspan="1" style="font-size:10pt">
							<b style="color:<?php echo $webpage_table_text_labelcolor;?>">Manufacturer: </b> <?php echo $devicemanu; ?> 
						</td>
						<td colspan="1" style="font-size:10pt">
							<b style="color:<?php echo $webpage_table_text_labelcolor;?>">Model: </b> <?php if($devicenicename != NULL){ echo $devicenicename; }else{ echo $devicemodel . " " . $devicemodelno; }?> 
						</td>
						<td style="font-size:10pt">
							<?php if($deviceprice > 0){ ?>
								<b style="<?php echo $webpage_table_text_labelcolor;?>">Cost: </b>$<?php echo $deviceprice;?>
							<?php } ?>
						</td>
				<?php }
					if($assetcat == 2){ ?>
					<td style="font-size:10pt">
						<b><?php echo $text_iteminfo_devicetype_server; ?></b>
					</td>
				<?php } ?>
			</tr>
			<tr class="border-bottom">
				<td colspan="2" style="font-size:12px"><?php echo $text_infobox_created.$assetcreate;?></td>
			<?php $search_nums = mysqli_num_rows($sql_e);								
				if($search_nums != 0){ ?>
					<td colspan="1" style="font-size:12px"><?php echo $text_infobox_lastedit.$assetedited;?></td>
				<?php } ?>
			</tr>
		</tbody>
	</table>
	<div class="m-1">
		<?php if(isset($_GET['embedded'])){ ?>
			<a href="iteminfo.php?<?php if($assettag == 0 OR "N/A"){echo "assetname=".$assetname;}else{echo "assettag=".$assettag;}?>" target="_blank">
				<button type="button" class="btn btn-secondary btn-sm"><b><?php echo $text_iteminfo_btn_newtab; ?></b></button>
			</a>
		<?php } ?>
		<a href="https://spiceworks.sienaheights.edu/search?query=<?php if($assettag == 0){echo $assetname;}else{echo $assettag;}?>" target="_blank">
			<button type="button" class="btn btn-secondary btn-sm"><b><?php echo $text_iteminfo_btn_spiceworks; ?></b></button>
		</a>
		<a href="edit?<?php if($assettag == 0){echo "name=".$assetname;}else{echo "tag=".$assettag;}?>" target="_blank">
			<button type="button" class="btn btn-success btn-sm"><b><?php echo $text_iteminfo_btn_edit; ?></b></button>
		</a>
	</div>
</div>
<?php
	}
	elseif(!isset($_GET['assettag']) OR !isset($_GET['assetname'])){ echo "Variables not set"; }
	else{ echo $error_record_unknown; }
?> 