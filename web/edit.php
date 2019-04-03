<?php
require_once 'vars/main.php';
require_once 'config.php';
$con = new mysqli($ip,$user,$pw,$db);

if(isset($_GET["tag"])){
	$info = urldecode($_GET["tag"]);
	$search = mysqli_escape_string($con, $info);
	$query = mysqli_query($con, "SELECT * FROM asset_information WHERE tagno='$info'");
	$obj = mysqli_fetch_object($query);
}
else if(isset($_GET["name"])){
	$info = urldecode($_GET["name"]);
	$search = mysqli_escape_string($con, $info);
	$query = mysqli_query($con, "SELECT * FROM asset_information WHERE name='$info'");
	$obj = mysqli_fetch_object($query);
}

### Variables from mySQL to PHP
	$dblisting 		= $obj->Entity_ID;
	$assetname 		= $obj->name;
	$assettag 		= $obj->tagno;
	$aservice 		= $obj->serviceno;
	$assetserial 	= $obj->serialno;
	$assetmac 	 	= $obj->macaddress;
	$assetstatus 	= $obj->status;
	
### Location variables from dblisting lookup
	$query_loc = mysqli_query($con, "SELECT * FROM location_information WHERE Asset_ID='$dblisting'");
	$objl = mysqli_fetch_object($query_loc);
	$loccampus		= $objl->campus;
	$locbuilding	= $objl->building;
	$locroom		= $objl->room;
	
	### Make variables human friendly
	$assetpurchase 	= date('Y-m-d', strtotime($obj->purchasedate)+$utility_timezone_offset);
	if(date('Y', strtotime($obj->purchasedate)) <= 2005){$assetpurchase = "";}
	if($assetstatus == 0){$assetstatus = "Active";}
	elseif($assetstatus == 1){$assetstatus = "Decommissioned";}
	elseif($assetstatus == 2){$assetstatus = "Unknown";}
	
if($WEBSITE_DEMO_MODE == FALSE){
?>
<html>
	<head>
		<title><?php echo $text_edit_page_title; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<?php echo $tech_html_head_start_body; ?>
		<div>
			<?php echo file_get_contents("gtag.html"); include_once 'header.php'; ?>
		</div>
		<div class="container-fluid" style="<?php echo $webpage_maincontent_css; ?>">
			<?php echo $webpage_topcontentbox; ?>
			<tr>
				<td>
					<div class="text-center">
						<img src="img/search.png" alt="Edit_image" <?php echo $webpage_head_image_css; ?>>
						<h1><?php echo "Editing ".$info; ?></h1>
						<?php echo $widget_webpage_border; ?>
					</div>
					<form>
						<div class="form-group m-3">
							<h3>Asset-Specific Information</h3>
							<div class="form-row my-2">
								<div class="col">
									<label>Asset Name</label>
									<div class="input-group mb-2">
										<div class="input-group-prepend">
											<div class="input-group-text">Name</div>
										</div>
										<input class="form-control" value="<?php echo $assetname; ?>" type="text" placeholder="COMPUTER-#####">
									</div>
								</div>
								<div class="col">
									<label>Asset Tag</label>
									<input class="form-control" value="<?php echo $assettag; ?>" type="text" placeholder="#####">
								</div>
								<div class="col">
									<label>Status</label>
									<select class="form-control">
										<option id="<?php echo $assetstatus;?>" selected="selected">Current: <?php echo $assetstatus;?></option>
										<option id="Active">Active</option>
										<option id="Decommissioned">Decommissioned</option>
										<option id="Unknown">Unknown</option>
									</select>
								</div>
							</div>
							<div class="form-row my-2">
								<div class="col">
									<label>Service Tag</label>
									<div class="input-group mb-2">
										<div class="input-group-prepend">
										  <div class="input-group-text">#</div>
										</div>
										<input class="form-control" value="<?php echo $aservice; ?>" type="text" placeholder="########" <?php if($aservice != NULL){echo "readonly";} ?>>
									</div>
								</div>
								<div class="col">
								<label>Serial Number</label>
									<div class="input-group mb-2">
										<div class="input-group-prepend">
										  <div class="input-group-text">#</div>
										</div>
										<input type="text" class="form-control" id="cost" placeholder="#####-#####-#####" name="serial">
									</div>
								</div>
								<div class="col">
									<label>Purchase Date</label>
									<input class="form-control" value="<?php echo $assetpurchase; ?>" type="date" id="pdate">
								</div>
							</div>
						<div class="form-group m-2">
							<h3>Location Information</h3>
							<div class="form-row">
								<div class="col">
									<label>Campus</label>
									<select class="form-control">
										<option id="<?php echo $loccampus;?>" selected="selected">Current: <?php echo $loccampus;?></option>
										<option id="Adrian">Adrian</option>
										<option id="Battle Creek">Battle Creek</option>
										<option id="Benton Harbor">Benton Harbor</option>
										<option id="Dearborn">Dearborn</option>
										<option id="Kalamazoo">Kalamazoo</option>
										<option id="Lansing">Lansing</option>
										<option id="Monroe">Monroe</option>
										<option id="Southfield">Southfield</option>
										<option id="Unknown">Unknown</option>
									</select>
								</div>
								<div class="col">
									<label>Building</label>
									<select class="form-control">
										<option id="<?php echo $locbuilding;?>" selected="selected">Current: <?php echo $locbuilding;?></option>
										<option id="Campus Village">Campus Village</option>
										<option id="Dominican Hall">Dominican Hall</option>
										<option id="FieldHouse">FieldHouse</option>
										<option id="Library">Library</option>
										<option id="Nursing">Nursing Building</option>
										<option id="Performing Arts Center">Performing Arts Center</option>
										<option id="Sacred Heart Hall">Sacred Heart Hall</option>
										<option id="Science Building">Science Building</option>
										<option id="Spencer Athletic Complex">Spencer Athletic Complex</option>
										<option id="St. Catherine">St. Catherine</option>
										<option id="St. Joseph Hall">St. Joseph Hall</option>
										<option id="Studio Angelico">Studio Angelico</option>
										<option id="University Center">University Center</option>
										<option id="N/A">Unspecified</option>
									</select>
								</div>
								<div class="col">
									<label>Room</label>
									<input class="form-control" value="<?php echo $locroom; ?>" type="text" placeholder="123A">
								</div>
							</div>
						</div>
					</form>
					<div class="text-right mt-4 mx-3">
						<a href="edit.php?<?php echo "assettag=".$assettag; ?>">
							<button type="button" class="btn btn-primary btn-sm"><b>Submit Changes</b></button>
						</a>
						<a href="edit.php?<?php echo "assettag=".$assettag; ?>">
							<button type="button" class="btn btn-secondary btn-sm"><b>Cancel</b></button>
						</a>
					</div>
				</td>
			</tr>
			<?php echo $webpage_bottomcontentbox; ?>
		</div>
	</body>
	<?php echo $widget_footer; ?>
</html>
<?php } ?>