<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
require_once 'config.php';
require_once 'vars.php';

##################CONNECTION INFO FOR DATABASE###################
$con = new mysqli($ip,$user,$pw,$db);
########################STARTING CONTENT#########################
###SQL query that will find the device with the highest Entity ID. Based on auto-incremental value.
# Provides overall assets, most recent name and tag.
$sql 	= mysqli_query($con, "SELECT * FROM asset_information ORDER BY Entity_ID DESC LIMIT 1");
$obj 	= mysqli_fetch_object($sql);

#SQL query that finds the total number of page visits for the asset pages.
$sql2 	= mysqli_query($con, "SELECT * FROM page_visits ORDER BY Log_ID DESC LIMIT 1");
$obj2 	= mysqli_fetch_object($sql2);

###SQL query finding the number of devices added. Based on auto-incremental value.
$sql4 	= mysqli_query($con, "SELECT * FROM device_information ORDER BY Device_ID DESC LIMIT 1");
$obj4 	= mysqli_fetch_object($sql4);

###SQL query that finds the top-visited page based on page visits.
# Rather complex query statement where a count column is created.
$obj5sql = "SELECT page_visits.page_id, asset_information.name, asset_information.tagno, COUNT(page_visits.page_id) CNT
			FROM page_visits INNER JOIN asset_information ON page_visits.page_id = asset_information.Entity_ID 
			GROUP BY page_id ORDER BY COUNT(page_id) DESC LIMIT 1";
$sql5 	= mysqli_query($con, $obj5sql);
$obj5 	= mysqli_fetch_object($sql5);

###SQL query finding the highest asset tag, and which device it belongs to. 
$sql6 	= mysqli_query($con, "SELECT * FROM asset_information ORDER BY tagno DESC LIMIT 1");
$obj6 	= mysqli_fetch_object($sql6);

###SQL query finding the most recently edited device, where the user column is not blank. Finds logins and the device edited/logged into.
$sql7 	= mysqli_query($con, "SELECT * FROM edit_log INNER JOIN asset_information ON edit_log.asset_id = asset_information.Entity_ID 
			WHERE recent_user IS NOT NULL ORDER BY edit_id DESC LIMIT 1");
$obj7 	= mysqli_fetch_object($sql7);

###SQL query finding the most recently edited device. Pulls 5 recents to show on the bottom of the stats page.
$sql3 	= mysqli_query($con, "SELECT * FROM edit_log INNER JOIN asset_information ON edit_log.asset_id = asset_information.Entity_ID 
			ORDER BY edit_id DESC LIMIT 5");


?>    
<!DOCTYPE html>
	<head>
		<title><?php echo $text_stats_page_title; ?></title>
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
				
				$statalllog = $obj->Entity_ID;
				$highesttagN = $obj6->name;
				$highesttagA = $obj6->tagno;
				$statpageviews = $obj2->Log_ID;
				$recentaddN = $obj->name;
				$recentaddA = $obj->tagno;
				$statdevicetypes = $obj4->Device_ID;
				$mostviewedA = $obj5->tagno;
				$mostviewedN = $obj5->name;
				$mostviewedV = $obj5->CNT;
				$recentuser = $obj7->recent_user;
				$recentdevice = $obj7->name;
			?>
			<tr>
				<td>
					<div class="text-center">
						<img src="img/statistics.png" alt="About_Image" <?php echo $webpage_head_image_css; ?>>
						<h1><?php echo $text_stat_head_title; ?></h1>
						<?php echo $widget_webpage_border; ?>
					</div>
					<div class="mx-4 text-left">
						<p>
							<?php echo $text_stat_body_desc; ?>
						</p>
					</div>
					<div class="table-responsive{-sm|-md|-lg|-xl} text-center table-borderless">
						<table class="table">
							<tbody class="text-center">
								<tr>
									<td>
										<b style="font-size:36pt"><?php echo $statpageviews; ?></b>
										</br>
										<b>Total asset pages views!</b>
									</td>
									<td>
										<b style="font-size:36pt"><?php echo $statalllog; ?></b>
										</br>
										<b>Unique assets added!</b>
									</td>
									<td>
										<b style="font-size:36pt"><?php echo $statdevicetypes; ?></b>
										</br>
										<b>Unique device types!</b>
									</td>
								</tr>
								<tr>
									<td><a href="search.php?infoname=<?php echo $recentaddN; ?>"><h2><b><?php echo $recentaddN; ?></h2></a>Newest asset to be added!</b></td>
									<td>
										<a href="search.php?
											<?php if($mostviewedN == "Unknown" OR NULL){ echo "infotag=".$mostviewedA; }else{ echo "infoname=".$mostviewedN; } ?>
										">
										<h2><b>
											<?php echo $mostviewedN; ?>
										</h2></a>Most viewed asset! (<?php echo $mostviewedV; ?> views!)</b>
									</td>
									<td><a href="search.php?infotag=<?php echo $highesttagA; ?>"><h2><b>Asset #<?php echo $highesttagA; ?></h2></a>Newest asset tag!</b></td>
								</tr>
								<tr>
									<td>
										<h2><b><?php echo $recentuser; ?></b></h2>
										<b>Most recent user to log in!</b>
									</td>
									<td>
										<a href="search.php?infoname=<?php echo $recentdevice; ?>"><h2><b><?php echo $recentdevice; ?></b></h2></a>
										<b>Most recent device logged into!</b>
									</td>
								</tr>
							</tbody>
						</table>
						Here's a list of recently edited items!
						<table width="60%" align="center" class="table-bordered text-left">
							<thead class="thead-dark">
								<tr class="text-left border">
									<th class="mx-2">
										<b style="font-size:"<?php echo $table_tagcol_text_size;?>>Device Name</b>
									</th>
									<th>
										<b style="font-size:"<?php echo $table_tagcol_text_size;?>>Username</b>
									</th>
									<th>
										<b style="font-size:"<?php echo $table_tagcol_text_size;?>>Edit</b>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php while ($objlist = mysqli_fetch_object($sql3)) { ?>
									<tr class="border">
										<td>
											<a class="reg"
											<?php if($objlist->tagno == 0){ echo "href='search.php?infoname=" . urlencode($objlist->name) . "' style='font-size:18'>N/A</a>"; }
											else{ echo "href='search.php?infotag=" . urlencode($objlist->tagno) . "' style='font-size:18'><b>". $objlist->name . "</b></a>"; } 
											?> 
										</td>
										<td style="font-size:16px">
											<?php echo $objlist->recent_user; ?>
										</td>
										<td style="font-size:16px">
											<?php echo $objlist->descpt; ?>
										</td>
									</tr> 
								<?php } ?>
							</tbody>
						</table>
					</div>
				</td>
			</tr>
			<?php echo $webpage_bottomcontentbox; ?>
		</div>
	</body>
</html>
