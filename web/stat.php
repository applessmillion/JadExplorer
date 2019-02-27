<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
require_once 'config.php';
require_once 'vars.php';

##################CONNECTION INFO FOR DATABASE###################
$con = new mysqli($ip,$user,$pw,$db);
########################STARTING CONTENT#########################
$sql 	= mysqli_query($con, "SELECT * FROM asset_information ORDER BY Entity_ID DESC LIMIT 1");
$obj 	= mysqli_fetch_object($sql);

$sql2 	= mysqli_query($con, "SELECT * FROM page_visits ORDER BY Log_ID DESC LIMIT 1");
$obj2 	= mysqli_fetch_object($sql2);

$sql3 	= mysqli_query($con, "SELECT * FROM asset_information ORDER BY createdate DESC LIMIT 1");
$obj3 	= mysqli_fetch_object($sql3);

$sql4 	= mysqli_query($con, "SELECT * FROM device_information ORDER BY Device_ID DESC LIMIT 1");
$obj4 	= mysqli_fetch_object($sql4);

$obj5sql = "SELECT page_visits.page_id, asset_information.name, asset_information.tagno, COUNT(page_visits.page_id) CNT
			FROM page_visits INNER JOIN asset_information ON page_visits.page_id = asset_information.Entity_ID 
			GROUP BY page_id ORDER BY COUNT(page_id) DESC LIMIT 1";
$sql5 	= mysqli_query($con, $obj5sql);
$obj5 	= mysqli_fetch_object($sql5);

$sql6 	= mysqli_query($con, "SELECT * FROM asset_information ORDER BY tagno DESC LIMIT 1");
$obj6 	= mysqli_fetch_object($sql6);


?>    
<!DOCTYPE html>
<!-- Initalize Page -->
	<head>
		<title>SHU-Explorer - Stats</title>
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
				$recentaddN = $obj3->name;
				$recentaddA = $obj3->tagno;
				$statdevicetypes = $obj4->Device_ID;
				$mostviewedA = $obj5->tagno;
				$mostviewedN = $obj5->name;
				$mostviewedV = $obj5->CNT;
			?>
			<tr>
				<td>
					<div class="text-center">
						<img src="img/statistics.png" alt="About_Image" <?php echo $webpage_head_image_css; ?>>
						<h1><?php echo $text_stat_head_title; ?></h1>
						<?php echo $widget_webpage_border; ?>
					</div>
					<div class="text-center table-borderless">
						<p>
							Stats are fun, so here's a few below!
						</p>
					<div class="table-responsive{-sm|-md|-lg|-xl}">
						<table class="table">
							<tbody class="text-center">
								<tr>
									<td>
										<b style="font-size:36pt"><?php echo $statpageviews; ?></b>
										</br>
										<b>total device pages views!</b>
									</td>
									<td>
										<b style="font-size:36pt"><?php echo $statalllog; ?></b>
										</br>
										<b>unique assets added!</b>
									</td>
									<td>
										<b style="font-size:36pt"><?php echo $statdevicetypes; ?></b>
										</br>
										<b>unique device types!</b>
									</td>
								</tr>
								<tr>
									<td><a href="search.php?infotag=<?php echo $recentaddN; ?>"><h2><b><?php echo $recentaddN; ?></h2></a>Newest device to be added!</b></td>
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
							</tbody>
						</table>
					</div>
				</td>
			</tr>
			<?php echo $webpage_bottomcontentbox; ?>
		</div>
	</body>
</html>
