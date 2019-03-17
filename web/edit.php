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
							<h3>Asset-Specific Information</h3>
							<div class="form-row my-2">
								<div class="col">
									<label>Asset Name</label>
									<div class="input-group mb-2">
										<div class="input-group-prepend">
											<div class="input-group-text">Name</div>
										</div>
										<input class="form-control" value="<?php echo $assetname; ?>" type="text" placeholder="COMPUTER-15555">
									</div>
								</div>
								<div class="col">
									<label>Asset Tag</label>
									<input class="form-control" value="<?php echo $assettag; ?>" type="text" placeholder="15555">
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
							<div class="form-row my-2">
								<div class="col">
									<label>Purchase Date</label>
									<input class="form-control" value="<?php echo date('Y-m-d', strtotime($obj->purchasedate)+$utility_timezone_offset); ?>" type="date" id="pdate" value="pdate">
								</div>
								<div class="col">
									<label>Serial Number</label>
									<input class="form-control" type="text" placeholder="textbox">
								</div>
								<div class="col">
								<label>Device Cost</label>
									<div class="input-group mb-2">
										<div class="input-group-prepend">
										  <div class="input-group-text">$</div>
										</div>
										<input type="text" class="form-control" id="cost" placeholder="499.99" name="cost">
									</div>
								</div>
							</div>
						<div class="form-group m-2">
							<h3>Location Information</h3>
							<div class="form-row">
								<div class="col">
									<label>Campus</label>
									<input class="form-control" value="<?php echo NULL; ?>" type="text" placeholder="Adrian">
								</div>
								<div class="col">
									<label>Building</label>
									<select class="form-control">
										<option id="">Unspecified</option>
										<option id="Science Building">Science Building</option>
										<option id="Dominican Hall">Dominican Hall</option>
										<option id="Library">Library</option>
										<option id="Sacred Heart Hall">Sacred Heart Hall</option>
										<option id="St. Joseph Hall">St. Joseph Hall</option>
										<option id="">Other Options Here</option>
										<option id="">Other Options Here</option>
										<option id="">Other Options Here</option>
									</select>
								</div>
								<div class="col">
									<label>Room Number</label>
									<input class="form-control" value="<?php echo NULL ?>" type="text" placeholder="300A" <?php if($aservice != NULL){echo "readonly";} ?>>
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