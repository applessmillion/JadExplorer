<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
include_once 'config.php';
include_once 'vars.php';

//Start connection to the database.
$con = new mysqli($ip,$user,$pw,$db);

########################STARTING CONTENT#########################

#CODE FOR SEARCHING DATABASE AND PRINTING RESULTS#
if(isset($_GET["assettag"])) {
?>    
<!DOCTYPE html>
<!-- Initalize Page -->
	<head>
		<title>SHU-Explorer - Search</title>
	</head>
	<?php echo $tech_html_head_start_body; ?>
		<div>
			<?php echo file_get_contents("gtag.html");
			echo file_get_contents("header.html") . "</br>"; ?>
		</div>
		<div class="container-fluid" style="<?php echo $webpage_maincontent_css; ?>">
			<?php 
				if($alert_text != ""){ echo $widget_webpage_alert;}
				echo $webpage_topcontentbox;
			?>
		</div>

<!-- End Init -->
<?php
    $id = $_GET["assettag"];
    #GET NAME FROM SEARCH TERMS#
	$search_query = mysqli_query($con, "SELECT * FROM asset_information INNER JOIN device_information ON asset_information.device_ID = device_information.Device_ID WHERE tagno like '%$id%' ORDER BY tagno DESC LIMIT 30");
	
	$search_nums = mysqli_num_rows($search_query);
	if($search_nums == NULL){$search_nums = 0;}
?>
			<tr class="text-center">
				<th>
					<a href="search.php"><img src="img/search-item.png" width="18%" style="min-width:156px;max-width:256px;"></a>
<?php				
	## This is what happens when we have no results.
	if($search_nums == 0){ ?>
		
		<h1><?php echo $text_search_noresults_title; ?></h1>
		<?php echo $text_search_noresults_desc; ?>
	<?php }			
	## This is what happens when we have results.
	else{ ?>
			<?php
				## Doing a null search? We got special text for that!
				if($id != "" OR $id != NULL){ ?>
					<h1>Showing <?php echo $search_nums; ?> results for <i><?php echo $id ?></i></h1>
				<?php }
				else{ ?>
					<h1><?php echo $text_search_results_null_title; ?></h1>
					<div class="m-4" style="max-width=50%"><p><?php echo $text_search_results_null_desc; ?></p></div>
			<?php	} ?>
			<?php echo $widget_webpage_border; ?>
					<table width="85%" align="center" class="table-bordered">
						<thead class="thead-dark">
							<tr class="text-center border">
								<th>
									<b style="font-size:<?php echo $table_tagcol_text_size . '">' . $text_search_results_head1; ?></b>
								</th>
								<th>
									<b style="font-size:<?php echo $table_tagcol_text_size . '">' . $text_search_results_head2; ?></b>
								</th>
								<th>
									<b style="font-size:<?php echo $table_tagcol_text_size . '">' . $text_search_results_head3; ?></b>
								</th>
							</tr>
						</thead>
<?php
		while ($obj = mysqli_fetch_object($search_query)) { ?>
			<tr class="border">
				<td>
					<a class='reg' 
					<?php if($obj->tagno == 0){
							echo "href='?infoname=" . urlencode($obj->name) . "' style='font-size:18'>N/A</a>";
						}
						else{
							echo "href='?infotag=" . urlencode($obj->tagno) . "' style='font-size:18'><b>". $obj->tagno . "</b></a>";
						} ?> 
				</td>
				<td>
					<?php if($obj->name != "Unknown"){
							echo "<a class='reg' href='?infoname=" . urlencode($obj->name) . "' style='font-size:16'><b>" . $obj->name . "</b></a>";
						} 
						else {
							echo "<i>".$obj->name."</i>";
						}?>
				</td>
				<td style="font-size:16">
					<?php echo $obj->model ." ". $obj->model_number;?>
				</td>
			</tr> 
		<?php } ?>
		</table>
		</td>
<?php	}
    echo $widget_webpage_border.'<a href="javascript:history.go(-1)">'.$text_goback.'</a></tr>';
}

#CODE FOR RETRIEVING DATA OF ITEM AND PRINTING RESULTS#
elseif(isset($_GET["infotag"]) OR isset($_GET["infoname"])) {
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
?>    
	<!DOCTYPE html>
	<!-- Initalize Page -->
	<head>
		<title>SHU-Explorer - Asset <?php echo $info; ?></title>
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
				<td style="height:<?php echo $webpage_device_iframe_height; ?>">
					<!-- Load iFrame -->
					<div class="text-center">
						<?php 
							if($idtype == 0){ ?>
								<iframe src="iteminfo.php?assettag=<?php echo $iid; ?>&embedded" style="border:none;height:<?php echo $webpage_device_iframe_height; ?>;width:80%;overflow:hidden"></iframe>
						<?php
							}
							else if($idtype == 1){ ?>
								<iframe src="iteminfo.php?assetname=<?php echo $iid; ?>&embedded" style="border:none;height:<?php echo $webpage_device_iframe_height; ?>;width:80%;overflow:hidden"></iframe>
						<?php } ?>
					</div>
					<div class="mx-3">
						<h4><?php echo $text_search_display_body_title; ?></h4>
						<p>
							<?php echo $text_search_display_body_desc; ?>
						<p/>
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
<!DOCTYPE html>
<!-- Initalize Page -->
	<head>
		<title>SHU-Explorer - Search</title>
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
					<div class="mx-5">
						<h3><?php echo $text_search_body_title; ?></h3>
						<?php echo $text_search_body_desc; ?>
						
						<!-- Init table -->
						</br>
						<table style="max-width:400px" align="center" class="border">
							<thead class="thead-dark">
								<tr>
									<th>
										<div style="font-size:22"><?php echo $text_search_form_assetsearch_title; ?></div>
									</th>
								</tr>
							</thead>
							<tbody>
								<td>
									<form action="search.php" method="get" class="m-2">
										<label><b><?php echo $text_search_form_assetsearch_label; ?></b></label>
										<div class="form-row align-items-center">
											<div class="col-auto">
												<div class="input-group mb-2">
													<div class="input-group-prepend">
													  <div class="input-group-text">#</div>
													</div>
													<input type="text" class="form-control" id="Asset" placeholder="15746" name="assettag">
												</div>
											</div>
											<div class="col-auto">
												<button type="submit" class="btn btn-primary mb-2">Submit</button>
											</div>
										</div>
									</form>
								</td>
							</tbody>
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
