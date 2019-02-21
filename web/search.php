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
<html>
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
	##This is what happens when we have no results.
	if($search_nums == 0){
		
		echo '<tr><th><h2>'.$text_search_noresults_title.'</h2></th></tr>';
		echo '<tr><th>'.$text_search_noresults_desc.'</th></tr>';
	}
					
	##This is what happens when we have results.
	else{
			echo '<h2>Showing '. $search_nums .' results for "'. $id . '"...</h2>'.$widget_webpage_border; ?>
					<table width="85%" align="center">
						<tr class="text-center">
							<th>
								<b style="font-size:24">Asset Tag#</b>
							</th>
							<th>
								<b style="font-size:24">Device Name</b>
							</th>
							<th>
								<b style="font-size:24">Device Type</b>
							</th>
						</tr>
<?php
		while ($obj = mysqli_fetch_object($search_query)) { ?>
			<tr>
					<td>
						<a class='reg' 
						<?php if($obj->tagno == 0){
								echo "href='?infoname=" . urlencode($obj->name) . "' style='font-size:20'>N/A</a>";
							}
							else{
								echo "href='?infotag=" . urlencode($obj->tagno) . "' style='font-size:20'><b>". $obj->tagno . "</b></a>";
							} ?> 
					</td>
					<td>
						<a class='reg'
						<?php if($obj->name != "Unknown"){
								echo "href='?infoname=" . urlencode($obj->name) . "' style='font-size:16'>" . $obj->name . "</a>";
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
    echo ''.$widget_webpage_border.'<a href="javascript:history.go(-1)">'.$text_goback.'</a></tr>';
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
<html>
<!-- Initalize Page -->
	<head>
		<title>SHU-Explorer - Asset <?php echo $info; ?></title>
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
		
		##What happens when our $id is null? Bad URL? Bad copy&paste? Doesn't matter! We're going to give an error page!
        if($iid == NULL) { ?>
            <tr class="table-warning">
				<th>
					<h3 style="text-align:center"><?php echo $error_record_nullid_title ?></h3>
				</th>
			</tr>
			<tr>
				<td>
					</br></br></br></br></br>
					<div class="mx-3">
						<p>
							<?php echo $error_record_nullid_desc; ?>
						</p>
					</div>
					</br></br></br></br></br></br></br></br></br>
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
							<h3 style="text-align:center"><?php echo $text_search_displayasset_title . $info; ?></h3>
					<?php	}
						## Displays the correct title for a name-type $info
						else if(isset($_GET["infoname"])){ ?>
							<h3 style="text-align:center"><?php echo $text_search_displayasset_title . $info; ?></h3>
					<?php } ?>
				</th>
			</tr>
			<tr>
				<td style="height:<?php echo $webpage_device_iframe_height; ?>">
					<!-- Load iFrame -->
					<div class="text-center">
						<?php 
							if($idtype == 0){ ?>
								<iframe src="iteminfo.php?assettag=<?php echo $iid; ?>" style="border:none;height:<?php echo $webpage_device_iframe_height; ?>;width:80%;overflow:hidden"></iframe>
						<?php
							}
							else if($idtype == 1){ ?>
								<iframe src="iteminfo.php?assetname=<?php echo $iid; ?>" style="border:none;height:<?php echo $webpage_device_iframe_height; ?>;width:80%;overflow:hidden"></iframe>
						<?php } ?>
					</div>
					<div class="mx-3">
						<h4>Title Text for content below results</h4>
						<p>
							Not sure what to put here yet..
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
<html>
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
<!-- End Init -->
					<tr class="text-center">
						<td>
							<a href="search.php">
								<img src="img/search-item.png" width="18%" style="min-width:156px;max-width:256px;">
							</a>
						</br>
							<img src="img/titles/basicsearch.png">
							<p>
								<?php 
								echo $widget_webpage_border;
								echo $page_quicksearch; 
								?> 
							</p>
							<div class="mx-5">
								<form action="search.php" method="get">
									<strong>Search by Asset Tag #:</strong> <input type="text" name="assettag" maxlength="5" size="6"></br></br>
									<input type="submit" value="Search">
								</form>
							</div>';  
							<div class="mx-3">
								<?php echo $widget_updates; ?>
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