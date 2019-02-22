<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
require_once 'config.php';
require_once 'vars.php';

##################CONNECTION INFO FOR DATABASE###################
$data_connect;
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
					<p class="mx-5">
						Below are some statistics! It's an ever-growing list, so check back regularly!</br></br>
						There are currently <strong><?php echo $statalllog; ?></strong> devices logged by SHU-Explorer!</br>
						The device with the highest asset tag is <strong><?php echo $highesttagN; ?></strong> (Tag No. <?php echo $highesttagA; ?>).</br>
						The most recent device to be added to SHU-Explorer was <strong><?php echo $recentaddN; ?></strong> (Tag No. <?php echo $recentaddA; ?>).</br>
					</p>
				</td>
			</tr>
			<?php echo $webpage_bottomcontentbox; ?>
		</div>
	</body>
</html>
