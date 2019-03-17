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
	$sqlhistory = mysqli_query($con, "SELECT * FROM edit_log WHERE asset_id='$eid' ORDER BY editdate DESC LIMIT 15");
?>    
<html>
	<head>
		<title>Asset <?php echo $info . $text_unspecified_title ?> </title>
	</head>
	<?php echo $tech_html_head_start_body; ?>
		<div>
			<?php 
				echo file_get_contents("gtag.html");
				echo file_get_contents("header.html"); 
			?>
			</br>
		</div>
		<div class="container-fluid" style="<?php echo $webpage_maincontent_css; ?>">
			<?php 
				if($alert_text != ""){ echo $widget_webpage_alert;}
				echo $webpage_topcontentbox;
		
		##What happens when our $id is null? Bad URL? Bad copy&paste? Doesn't matter! We're going to give an error page!
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
						<b>
							<?php ######## Bad practice. Need to look into giving a legit URL to go back on. What happens when someone shares the link and it does this? ?>
							<a href="javascript:history.go(-1)"><?php echo $text_goback; ?></a>
						</b>
					</div>
				</td>
			</tr>
		
        <?php }
		
		##What happens when everything goes right? We'll show them the results!
        else { ?>
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
					<div class="text-center">
						<table class="table table-bordered" align="center" style="max-width:75%;min-width:35%;">
							<thead class="thead-dark">
								<tr>
									<th scope="col"><b>Log Date</b></th>
									<th scope="col"><b>Description</b></th>
								</tr>
							</thead>
							<tbody>
								<?php
									$search_nums = mysqli_num_rows($sqlhistory);								
									if($search_nums != 0){
										while ($objhis = mysqli_fetch_object($sqlhistory)) { ?>
											<tr class="border">
												<td style="font-size:9pt;">
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
												<td style="font-size:9pt;"><?php echo $objhis->descpt; ?></td>
											</tr> 
								<?php 
										} 
									}
									else{ 
								?>
									<tr class="border">
										<td colspan="2" style="font-size:12pt;"><?php echo $text_search_display_nohistory; ?></td>
									</tr>
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
	</head>
	<?php echo $tech_html_head_start_body; ?>
		<div>
			<?php echo file_get_contents("gtag.html");
			echo file_get_contents("header.html") ?>
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
					<div class="mx-3">
						<h3><?php echo $text_search_body_title; ?></h3>
						<?php echo $text_search_body_desc; ?>
						
						<!-- Init table -->
						</br>
						<table class="table">
							<tr>
								<td>
									<table align="center" class="border">
										<thead class="thead-dark">
											<tr>
												<th>
													<div style="font-size:22px"><?php echo $text_search_form_assetsearch_title; ?></div>
												</th>
											</tr>
										</thead>
										<tbody>
											<td>
												<form action="results.php" method="get" class="m-2">
													<label class="text-left"><b><?php echo $text_search_form_assetsearch_label; ?></b></label>
													<div class="form-row align-items-center">
														<div class="col-auto">
															<div class="input-group mb-2">
																<div class="input-group-prepend">
																  <div class="input-group-text">Tag #</div>
																</div>
																<input type="text" class="form-control" id="Asset" placeholder="12345" name="assettag">
															</div>
														</div>
														<div class="col-auto">
															<button type="submit" class="btn btn-primary mb-2">Search</button>
														</div>
													</div>
												</form>
											</td>
										</tbody>
									</table>
								</td>
								<td>
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
												<form action="results.php" method="get" class="m-2">
													<label class="text-left"><b><?php echo $text_search_form_namesearch_label; ?></b></label>
													<div class="form-row align-items-center">
														<div class="col-auto">
															<div class="input-group mb-2">
																<div class="input-group-prepend">
																  <div class="input-group-text">Name</div>
																</div>
																<input type="text" class="form-control" id="Name" placeholder="COMPUTER-12345" name="assetname">
															</div>
														</div>
														<div class="col-auto">
															<button type="submit" class="btn btn-primary mb-2">Search</button>
														</div>
													</div>
												</form>
											</td>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<table style="max-width:450px" align="center" class="border">
										<thead class="thead-dark">
											<tr>
												<th>
													<div style="font-size:22px"><?php echo $text_search_form_unamesearch_title; ?></div>
												</th>
											</tr>
										</thead>
										<tbody>
											<td>
												<form action="results.php" method="get" class="m-2">
													<label class="text-left"><b><?php echo $text_search_form_unamesearch_label; ?></b></label>
													<div class="form-row align-items-center">
														<div class="col-auto">
															<div class="input-group mb-2">
																<div class="input-group-prepend">
																  <div class="input-group-text">Name</div>
																</div>
																<input type="text" class="form-control" id="Name" placeholder="USERNME" name="username">
															</div>
														</div>
														<div class="col-auto">
															<button type="submit" class="btn btn-primary mb-2">Search</button>
														</div>
													</div>
												</form>
											</td>
										</tbody>
									</table>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>

<?php	}    
	echo $webpage_bottomcontentbox; ?>
		</div></div>
	</body>
</html>

<?php
mysqli_close($con);
?>
