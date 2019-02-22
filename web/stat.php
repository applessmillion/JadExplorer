<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
require_once 'config.php';
require_once 'vars.php';

##################CONNECTION INFO FOR DATABASE###################
$con = new mysqli($ip,$user,$pw,$db);
########################STARTING CONTENT#########################
$sql 	= mysqli_query($con, "SELECT * FROM asset_information ORDER BY Entity_ID DESC LIMIT 1");
$obj 	= mysqli_fetch_object($sql);

$sql2 	= mysqli_query($con, "SELECT * FROM asset_information ORDER BY tagno DESC LIMIT 1");
$obj2 	= mysqli_fetch_object($sql2);

$sql3 	= mysqli_query($con, "SELECT * FROM asset_information ORDER BY createdate DESC LIMIT 1");
$obj3 	= mysqli_fetch_object($sql3);

?>    
<html>
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
				$highesttagN = $obj2->name;
				$highesttagA = $obj2->tagno;
				$recentaddN = $obj3->name;
				$recentaddA = $obj3->tagno;
			?>
			<tr>
				<td>
					<div class="text-center">
						<img src="img/statistics.png" alt="About_Image" <?php echo $webpage_head_image_css; ?>>
						<h1><?php echo $text_stat_head_title; ?></h1>
						<?php echo $widget_webpage_border; ?>
					</div>
					<div class="table-responsive{-sm|-md|-lg|-xl}">
						<table class="table">
							<tbody>
								<tr class="text-center">
									<td><h1><b><?php echo $statalllog; ?></b></h1><b> devices on SHU-Explorer!</h4></b></td>
								<td><h2><b><?php echo $highesttagN; ?></b></h2><b>Device with the newest asset tag!</b></td>
								<td><h2><b><?php echo $recentaddN; ?></b></h2><b>Newest device to be added!</h4></b></td>
							</tbody>
						</table>
					</div>
				</td>
			</tr>
			<?php echo $webpage_bottomcontentbox; ?>
		</div>
	</body>
</html>
