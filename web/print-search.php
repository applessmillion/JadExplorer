<?php
include_once 'config.php';
require_once 'vars/main.php';
$con = new mysqli($ip,$user,$pw,$db);
	
#CODE FOR RETRIEVING DATA OF ITEM AND PRINTING RESULTS#
if(isset($_GET["infotag"]) OR isset($_GET["infoname"])) {
    if(isset($_GET["infotag"])){
		$info = urldecode($_GET["infotag"]);
		$search = mysqli_escape_string($con, $info);
		$query = mysqli_query($con, "SELECT * FROM asset_information WHERE tagno='$info'");
		$obj = mysqli_fetch_object($query);
		$iid = $obj->tagno;
		$idtype = 0;
	}
	else if(isset($_GET["infoname"])){
		$info = urldecode($_GET["infoname"]);
		$search = mysqli_escape_string($con, $info);
		$query = mysqli_query($con, "SELECT * FROM asset_information WHERE name='$info'");
		$obj = mysqli_fetch_object($query);
		$iid = $obj->name;
		$idtype = 1;
	}
	$eid = $obj->Entity_ID;
	$sqlhistory = mysqli_query($con, "SELECT * FROM edit_log WHERE asset_id='$eid' ORDER BY editdate DESC LIMIT 25");
	
	$obj_24h = mysqli_fetch_object(mysqli_query($con, "SELECT COUNT(edit_id) CNT FROM edit_log WHERE asset_id='$eid' AND editdate >= (NOW() - INTERVAL 1 DAY) AND recent_user IS NOT NULL"));
	$obj_7d = mysqli_fetch_object(mysqli_query($con, "SELECT COUNT(edit_id) CNT FROM edit_log WHERE asset_id='$eid' AND editdate >= (NOW() - INTERVAL 7 DAY) AND recent_user IS NOT NULL"));
	$obj_30d = mysqli_fetch_object(mysqli_query($con, "SELECT COUNT(edit_id) CNT FROM edit_log WHERE asset_id='$eid' AND editdate >= (NOW() - INTERVAL 30 DAY) AND recent_user IS NOT NULL"));

	
	$sql_statement 		= "SELECT Entity_ID, tagno, name, serviceno, serialno, macaddress, OS, OSV, assetcategory, status, createdate, 
						purchasedate, manufacturer, model, model_number, model_price, friendly_name FROM asset_information INNER JOIN device_information 
						ON asset_information.device_ID = device_information.Device_ID WHERE Entity_ID='$eid' LIMIT 1";
	$sql 				= mysqli_query($con, $sql_statement);
	$obj 				= mysqli_fetch_object($sql);
	$sql_e 				= mysqli_query($con, "SELECT * FROM edit_log WHERE asset_id='$obj->Entity_ID' && recent_user IS NOT NULL ORDER BY editdate DESC LIMIT 1");
	$obj_e 				= mysqli_fetch_object($sql_e);
	$dblisting 			= $obj->Entity_ID;
### Gather location information regarding the asset if it exists.
	$sql_locinfo		= "SELECT * FROM location_information WHERE Asset_ID='$obj->Entity_ID' LIMIT 1";
	$sqlcon_loc	 		= mysqli_query($con, $sql_l);
	$obj_l 				= mysqli_fetch_object($sql_l);
### Variables that pertain to the ASSET
	$assetname 			= $obj->name;
	$assettag 			= $obj->tagno;
	$assetservice 		= $obj->serviceno;
	$assetos			= $obj->OS;
	$assetosv			= $obj->OSV;
	$assetmac 	 		= $obj->macaddress;
	$assetcat 			= $obj->assetcategory;
	$assetstatus 		= $obj->status;
	$assetip			= $obj_e->recent_ip;
	$assetuser			= $obj_e->recent_user;
### Variables that pertain to the asset's DEVICE
	$devicemanu			= $obj->manufacturer;
	$devicemodel		= $obj->model;
	$devicemodelno		= $obj->model_number;
	$devicenicename		= $obj->friendly_name;
	$deviceprice		= $obj->model_price;
### Variables that pertain to the asset's LOCATION
	$loccampus			= $obj_l->campus;
	$locbuilding		= $obj_l->building;
	$locroom			= $obj_l->room;
### If one of these is NULL, set to "N/A"
	if($loccampus == NULL){ $loccampus = "N/A";}
	if($locroom == NULL){ 	$locroom = "N/A";}
	if($locbuilding == NULL){ $locbuilding = "N/A";}
### Doesn't need any timezone or DST checking. This is manually entered.
	$assetpurchase		= date('F j, Y', strtotime($obj->purchasedate));
	$assetedited		= date('F j, Y, g:ia', strtotime($obj_e->editdate)+$utility_timezone_offset);
	$assetcreate		= date('F j, Y, g:ia', strtotime($obj->createdate)+$utility_timezone_offset);
### If the DST fix is on, here's how we do it.
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
	}else{}
### Set status of the device
	if($assetcat == 0){ $astatus = "Unpublished Device";}
	elseif($assetstatus == 0){ $astatus = "<strong style='color:lightgreen' class='mx-1'>ACTIVE</strong>"; }
	elseif($assetstatus == 1){ $astatus = "<strong style='color:red' class='mx-1'>DECOMISSIONED</strong>"; }
	elseif($assetstatus == 2){ $astatus = "<strong style='color:orange' class='mx-1'>UNKNOWN</strong>"; }
	else{ $astatus = "Bad Data!";}
### Set text category for the device
	if($assetcat == 0){ $acat = "Unpublished Device"; $img_deviceico = "img/logo-dark.png"; }
	elseif($assetcat == 1){ $acat = "Windows Computer"; $img_deviceico = "img/devices/windows-computer.png";}
	elseif($assetcat == 2){ $acat = "MacOS Computer"; $img_deviceico = "img/devices/apple-computer.png";}
	elseif($assetcat == 3){ $acat = "Windows Server"; $img_deviceico = "img/devices/windows-server.png";}
	elseif($assetcat == 4){ $acat = "Linux Server"; $img_deviceico = "img/devices/linux-server.png";}
	else{$acat = "Bad Category!";}
### Visit the tracking URL.
	if($assettag != 0 || $assetservice != NULL){
	### Let's be safe here. Only start a connection for a valid GET property.
		$con_trak = new mysqli($ip,$p_user,$p_pw,$db);
		$visitid = $dblisting;
		$visitip = $_SERVER['REMOTE_ADDR'];
		mysqli_query($con_trak, "INSERT INTO page_visits (page_id, visitor_ip) VALUES ('$visitid', '$visitip')");
	}

	
?>    
<html>
	<head>
		<title>Asset <?php echo $info . $text_unspecified_title ?> - Printer Friendly</title>
		<meta charset="utf-8">
	</head>
	<?php echo $tech_css_js_styleimports; ?>
		<div class="text-center">
			<?php echo file_get_contents("gtag.html");?>
			<img src="img/logo.png" <?php echo $webpage_head_image_css; ?>>
			</br></br>
		</div>
		<div class="container-fluid" style="max-width:80%" align="center">
			<tr>
				<td align="center">
						<div class="card">
							<table class="table">
								<thead class="thead">
									<tr>
										<th scope="col"><img src="<?php echo $img_deviceico; ?>" style="max-height:50px;min-width:15%"></th>
										<th scope="col" style="text-align:center"><b style="font-size:21pt;"><?php echo $assetname;?></b></th>
										<th scope="col" style="text-align:right;"><?php echo $astatus;?></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th colspan="3" class="table-active"><b style="font-size:12pt;"><?php echo $text_iteminfo_assetinfo_title; ?></b></th>
									</tr>
									<?php if(date('Y', strtotime($obj->purchasedate)) >= $utility_noshow_devices_before){ ?>
										<tr><td colspan="3" style="font-size:14px"><b><?php echo $text_infobox_buydate.$assetpurchase;?></b></td></tr>
									<?php } ?>
									<tr class=" border-top border-bottom">
										<td style="font-size:10pt">
											<b style="color:<?php echo $webpage_table_text_labelcolor;?>">Asset ID: </b><?php if($assettag == 0 OR NULL){ echo "N/A";}else{echo $assettag;} ?>
										</td>
										<td style="font-size:10pt">
											<b style="color:<?php echo $webpage_table_text_labelcolor;?>">Service Number: </b>
											<?php if($devicemanu == "Dell Inc."){ ?>
												<a href="<?php echo $link_dell_servicetag_support.$assetservice; ?>/" target="_blank"><?php echo $assetservice; ?></a>
											<?php } elseif($devicemanu == "Acer"){ ?>
												<a href="<?php echo $link_acer_servicetag_support; ?>" target="_blank"><?php echo $assetservice; ?></a>
											<?php } elseif($devicemanu == "VMware, Inc."){ ?>
												N/A
											<?php } else{ echo $assetservice; }?>
										</td>
										<td style="font-size:10pt">
											<b style="color:<?php echo $webpage_table_text_labelcolor;?>">OS: </b><?php echo $assetos; ?><i style='font-size:9'> Ver. <?php echo $assetosv; ?></i>
										</td>
									</tr>
									<tr class=" border-top border-bottom">
										<?php if($assetip){ ?>
										<td style="font-size:10pt"><b style="color:<?php echo $webpage_table_text_labelcolor;?>">Recent IP: </b><?php echo $assetip;?></td>
										<?php } ?>
										<?php if($assetuser){ ?>
										<td style="font-size:10pt"><b style="color:<?php echo $webpage_table_text_labelcolor;?>">Recent User: </b><?php echo $assetuser;?></td>
										<?php } ?>
										<?php if($assetmac != ""){ ?>
										<td style="font-size:10pt"><b style="color:<?php echo $webpage_table_text_labelcolor;?>">MAC: </b><?php echo $assetmac;?></td>
										<?php } ?>
									</tr>
									<tr class="border-top border-bottom">
										<td colspan="3" style="font-size:10pt">
											<b style="color:<?php echo $webpage_table_text_labelcolor;?>">Location: </b>
											<?php ###If a location is set, show it. If not, echo N/A
											if($loccampus != "N/A" || $locbuilding != "N/A"){ ?>
												<?php echo $locbuilding." Rm.".$locroom." ";?>
												<?php if($loccampus != NULL){ echo "(".$loccampus." Campus)";} ?>
											<?php }else{ echo "N/A"; } ?>
										</td>
									</tr>
									<tr class="border-top border-bottom">
										<th colspan="2" class="table-active"><b style="font-size:12pt"><?php echo $text_iteminfo_deviceinfo_title; ?></b></th>
										<th colspan="1" class="table-active" style="text-align:right;"><b class="mx-1" style="font-size:10pt;"><?php echo $acat; ?></th>
									</tr>
									<tr class="border-top border-bottom">
										<?php if($assetcat != 2){?>
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
											<td style="font-size:10pt"><b><?php echo $text_iteminfo_devicetype_server; ?></b></td>
										<?php } ?>
									</tr>
									<tr class="border-top border-bottom">
										<td colspan="2" style="font-size:12px"><?php echo $text_infobox_created.$assetcreate;?></td>
									<?php $search_nums = mysqli_num_rows($sql_e);								
										if($search_nums != 0){ ?><td colspan="1" style="font-size:12px"><?php echo $text_infobox_lastedit.$assetedited;?></td><?php } ?>
									</tr>
								</tbody>
							</table>
						</div>
						<table class="table table-sm table-bordered text-center" align="center">
							<tbody>
								<tr>
									<th colspan=1><h1><b><?php echo $obj_24h->CNT; ?></b></h1></th>
									<th colspan=2><h1><b><?php echo $obj_7d->CNT; ?></b></h1></th>
									<th colspan=1><h1><b><?php echo $obj_30d->CNT; ?></b></h1></th>
								</tr>
								<tr>
									<th colspan=1>Logins in the past 24 hours.</th>
									<th colspan=2>Logins in the past week.</th>
									<th colspan=1>Logins within the past month.</th>
								</tr>
							</tbody>
						</table>
						</br>
						<table class="table table-striped table-sm" align="center">
							<thead class="thead">
								<tr>
								<th class="d-inline-block col-12">
									<h4><b>Recent Activity</b></h4>
								</th>
								</tr>
								<tr>
									<th class="d-inline-block col-3"><b><?php echo $text_search_activity_head_log; ?></b></th>
									<th class="d-inline-block col-9"><b><?php echo $text_search_activity_head_desc; ?></b></th>
								</tr>
							</thead>
							<tbody>
								<?php
									$search_nums = mysqli_num_rows($sqlhistory);								
									if($search_nums != 0){
										while ($objhis = mysqli_fetch_object($sqlhistory)) { ?>
											<tr class="border">
												<td style="font-size:10pt;" class="d-inline-block col-3">
													<b>
													<?php 
													### Let's figure out our DST problem here. This is for the edit history.
														### If the DST fix is on, here's how we do it.
														if($enable_daylight_savings_adjustments == TRUE){
															### FOR THE PRICE HISTORY - Check if date falls between DST (Mar 10 thru Nov 3)
															if(strtotime($objhis->editdate) >= date(strtotime("second Sunday of March ".date('Y', strtotime($objhis->editdate)))) && 
															  strtotime($objhis->editdate) <= date(strtotime("first Sunday of November ".date('Y', strtotime($objhis->editdate))))){
																### Add an extra hour. This takes place during daylight savings.
																echo date('F j, Y, g:ia', strtotime($objhis->editdate)+($utility_timezone_offset+3600));
															}
															else{ echo date('M j, Y, g:ia', strtotime($objhis->editdate)+$utility_timezone_offset); }
														}
														### We need the elses or it'll just print both dates. Best not do that.
														else{ echo date('M j, Y, g:ia', strtotime($objhis->editdate)+$utility_timezone_offset); }
													?>
													</b>
												</td>
												<td style="font-size:10pt;" class="d-inline-block col-9"><?php echo $objhis->descpt; ?></td>
											</tr> 
								<?php 
										} 
									}
									else{ ?>
									<tr class="border"><td colspan="2" style="font-size:12pt;"><?php echo $text_search_display_nohistory; ?></td></tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</td>
			</tr>
        <?php  } ?> 
		</div></div>
	</body>
</html>

<?php
mysqli_close($con);
?>
