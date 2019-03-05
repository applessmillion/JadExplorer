<?php
require_once 'vars.php';
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
	$assetpurchase	= $obj->purchasedate;
?>
<html>
	<head>
		<title><?php echo $text_edit_page_title; ?></title>
	</head>
	<?php echo $tech_html_head_start_body; ?>
		<div>
			<?php echo file_get_contents("gtag.html");
				echo file_get_contents("header.html");
			?>
			</br>
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
							<div class="form-row">
								<div class="col">
									<label>Asset Name</label>
									<input class="form-control" value="<?php echo $assetname; ?>" type="text" placeholder="Name">
								</div>
								<div class="col">
									<label>Asset Tag</label>
									<input class="form-control" value="<?php echo $assettag; ?>" type="text" placeholder="Tag #">
								</div>
								<div class="col">
									<label>Service Tag</label>
									<input class="form-control" value="<?php echo $aservice; ?>" type="text" placeholder="Service No." <?php if($aservice != NULL){echo "readonly";} ?>>
								</div>
								<div class="col">
									<label>Status</label>
									<select class="form-control">
										<option id="1">Active</option>
										<option id="0">Decommissioned</option>
										<option id="2">Unknown</option>
									</select>
								</div>
							</div>
							</br>
							<div class="form-row">
								<div class="col">
									<label>Purchase Date</label>
									<input class="form-control" value="<?php echo date('Y-m-d', strtotime($obj->purchasedate)+$utility_timezone_offset); ?>" type="date" id="pdate" value="pdate" min="2007-07-01">
								</div>
								<div class="col">
									<label>textbox</label>
									<input class="form-control" type="text" placeholder="textbox">
								</div>
								<div class="col">
									<label>textbox</label>
									<input class="form-control" type="text" placeholder="textbox">
								</div>
							</div>
							
						</div>
					</form>
				</td>
			</tr>
			<?php echo $webpage_bottomcontentbox; ?>
		</div>
	</body>
</html> 