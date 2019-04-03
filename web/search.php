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
	$sqlhistory = mysqli_query($con, "SELECT * FROM edit_log WHERE asset_id='$eid' ORDER BY editdate DESC LIMIT 20");
	
	$obj_24h = mysqli_fetch_object(mysqli_query($con, "SELECT COUNT(edit_id) CNT FROM edit_log WHERE asset_id='$eid' AND editdate >= (NOW() - INTERVAL 1 DAY) AND recent_user IS NOT NULL"));
	$obj_7d = mysqli_fetch_object(mysqli_query($con, "SELECT COUNT(edit_id) CNT FROM edit_log WHERE asset_id='$eid' AND editdate >= (NOW() - INTERVAL 7 DAY) AND recent_user IS NOT NULL"));
	$obj_30d = mysqli_fetch_object(mysqli_query($con, "SELECT COUNT(edit_id) CNT FROM edit_log WHERE asset_id='$eid' AND editdate >= (NOW() - INTERVAL 30 DAY) AND recent_user IS NOT NULL"));

?>    
<html>
	<head>
		<title>Asset <?php echo $info . $text_unspecified_title ?> </title>
		<meta charset="utf-8">
	</head>
	<?php echo $tech_html_head_start_body; ?>
		<div>
			<?php echo file_get_contents("gtag.html"); include_once 'header.php'; ?>
			</br>
		</div>
		<div class="container-fluid" style="<?php echo $webpage_maincontent_css; ?>">
		<?php if($alert_text != ""){ echo $widget_webpage_alert;} echo $webpage_topcontentbox;
		##What happens when our $id is null? We're going to give an error page!
        if($iid == NULL) { ?>
            <tr class="table-warning">
				<th>
					<h1 style="text-align:center"><?php echo $error_record_nullid_title; ?></h1>
				</th>
			</tr>
			<tr>
				<td>
					<div class="text-center">
						<a href="search.php">
							<img src="img/error.png" alt="Error" <?php echo $webpage_head_image_css; ?>>
						</a>
						<h1><?php echo $error_generic_title; ?></h1>
					</div>
					<div class="mx-5 my-2">
						<p>
							<?php echo $error_record_nullid_desc; ?>
						</p>
					</div>
					</br></br></br>
					<div class="text-center">
						<?php echo $widget_webpage_border;?>
						<b><a href="javascript:history.go(-1)"><?php echo $text_goback; ?></a></b>
					</div>
				</td>
			</tr>
        <?php }else{ ?>
            <tr class="table-primary">
				<th>
					<?php
					## Display the correct title for the type of $info we are showing.
						## Displays the correct title for an asset-tag-type $info
						if(isset($_GET["infotag"])){ ?>
							<h2 style="text-align:center"><?php echo $text_search_displayasset_title . $info; ?></h2>
					<?php	}
						## Displays the correct title for a name-type $info
						else if(isset($_GET["infoname"])){ ?>
							<h2 style="text-align:center"><?php echo $text_search_displayname_title ."<b>". $info . "</b>"; ?></h2>
					<?php } ?>
				</th>
			</tr>
			<tr>
				<td style="height:<?php echo $webpage_device_iframe_height; ?>px">
					<!-- Load iFrame -->
					<div class="text-center">
						<?php 
							if($idtype == 0){ ?>
								<iframe src="iteminfo.php?assettag=<?php echo $iid; ?>&embedded" style="border:none;height:<?php echo $webpage_device_iframe_height; ?>px;width:80%;overflow:hidden"></iframe>
						<?php
							}
							else if($idtype == 1){ ?>
								<iframe src="iteminfo.php?assetname=<?php echo $iid; ?>&embedded" style="border:none;height:<?php echo $webpage_device_iframe_height; ?>px;width:80%;overflow:hidden"></iframe>
						<?php } ?>
					</div>
					<div class="mx-3">
						<h4><?php echo $text_search_display_body_title; ?></h4>
						<p><?php echo $text_search_display_body_desc;?></p>
					</div>
						<table class="table-sm table-borderless text-center" align="center" style="max-width:75%;">
							<tbody>
								<tr>
									<th><h3><?php echo $obj_24h->CNT; ?></h3></th>
									<th><h3><?php echo $obj_7d->CNT; ?></h3></th>
									<th><h3><?php echo $obj_30d->CNT; ?></h3></th>
								</tr>
								<tr>
									<td>Logins in the past 24 hours.</td>
									<td>Logins in the past week.</td>
									<td>Logins within the past month.</td>
								</tr>
							</tbody>
						</table>
						</br>
						<table class="table table-striped table-sm" align="center" style="max-width:75%;min-width:38%;">
							<thead class="thead-dark">
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
					<div class="text-center">
						<?php echo $widget_webpage_border;?>
						<b>
							<?php ######## Bad practice. Need to look into giving a legit URL to go back on. What happens when someone shares the link and it does this? ?>
							<a href="javascript:history.go(-1)"><?php echo $text_goback; ?></a>
						</b>
					</div>
				</td>
			</tr>
        <?php }  
}
else {
?>    
<html>
	<head>
		<title><?php echo $text_search_page_title; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<?php echo $tech_html_head_start_body; ?>
		<div>
			<?php 
				echo file_get_contents("gtag.html");
				include_once 'header.php';
			?>
			</br>
		</div>
		<div class="container-fluid" style="<?php echo $webpage_maincontent_css; ?>">
			<?php 
				if($alert_text != ""){ echo $widget_webpage_alert;}
				echo $webpage_topcontentbox;
			?>
			<tr>
				<td>
					<div class="text-center">
						<a href="search.php">
							<img src="img/search-item.png" alt="Quick_Search" <?php echo $webpage_head_image_css; ?>>
						</a>
						<h1><?php echo $text_search_head_title; ?></h1>
						<?php echo $widget_webpage_border; ?>
					</div>
					<div class="mx-2">
						<h3><?php echo $text_search_body_title; ?></h3>
						<?php echo $text_search_body_desc; ?>
						<div class="row justify-content-start mt-4">
							<div class="col-4">
								<table align="center" class="border" style="padding:0.6rem!important">
									<thead class="thead-dark">
										<tr>
											<th><div style="font-size:22px"><?php echo $text_search_form_assetsearch_title; ?></div></th>
										</tr>
									</thead>
									<tbody>
										<td>
											<form action="results.php" method="get" class="m-1 mt-2 mb-3">
												<label class="text-left"><b><?php echo $text_search_form_assetsearch_label; ?></b></label>
												<div class="form-row align-items-center">
													<div class="col-auto">
														<div class="input-group">
															<div class="input-group-prepend">
															  <div class="input-group-text"><i class="fas fa-tag"></i></div>
															</div>
															<input type="text" class="form-control" id="Asset" placeholder="12345" name="assettag">
															<div class="input-group-append">
																<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
															</div>
														</div>
													</div>
												</div>
											</form>
										</td>
									</tbody>
								</table>
							</div>
							<div class="col-4">
								<table style="max-width:415px" align="center" class="border">
									<thead class="thead-dark">
										<tr>
											<th><div style="font-size:22px"><?php echo $text_search_form_unamesearch_title; ?></div></th>
										</tr>
									</thead>
									<tbody>
										<td>
											<form action="results.php" method="get" class="m-1">
												<label class="text-left"><b><?php echo $text_search_form_unamesearch_label; ?></b></label>
												<div class="form-row align-items-center">
													<div class="col-auto">
														<div class="input-group ml-1">
															<div class="input-group-prepend">
																<div class="input-group-text"><i class="fas fa-user-friends"></i></div>
															</div>
															<input type="text" class="form-control" id="Name" placeholder="username1" name="username">
															<div class="input-group-append">
																<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
															</div>
														</div>
													</div>
													<div class="form-check mx-3">
														<input type="checkbox" class="form-check-input" id="Exact" name="s">
														<label class="form-check-label" for="Exact">Only show EXACT results.</label>
													</div>
												</div>
											</form>
										</td>
									</tbody>
								</table>
							</div>
							<div class="col-4">
								<table align="center" class="border">
									<thead class="thead-dark">
										<tr>
											<th>
												<div style="font-size:22px"><?php echo $text_search_form_namesearch_title; ?></div>
											</th>
										</tr>
									</thead>
									<tbody>
										<td>
											<form action="results.php" method="get" class="m-1 mt-2 mb-3">
												<label class="text-left"><b><?php echo $text_search_form_namesearch_label; ?></b></label>
												<div class="form-row align-items-center">
													<div class="col-auto">
														<div class="input-group">
															<div class="input-group-prepend">
															  <div class="input-group-text"><i class="fas fa-desktop"></i></div>
															</div>
															<input type="text" class="form-control" id="Name" placeholder="COMPUTER-12345" name="assetname">
															<div class="input-group-append">
																<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
															</div>
														</div>
													</div>
												</div>
											</form>
										</td>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</td>
			</tr>

<?php	}    
	echo $webpage_bottomcontentbox; ?>
		</div></div>
	</body>
	<?php echo $widget_footer; ?>
</html>

<?php
mysqli_close($con);
?>
