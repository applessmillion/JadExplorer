<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
include_once 'config.php';
include_once 'vars.php';

##########CONNECTION INFO FOR DATABASE###########
$con = new mysqli($ip,$user,$pw,$db);
############STARTING CONTENT#############

?>
<html>
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
							<a href="advsearch.php">
								<img src="img/search-advanced.png" width="18%" style="min-width:156px;max-width:256px;">
							</a>
						</br>
							<img src="img/titles/advancedsearch.png">
							<p>
								<?php 
								echo $widget_webpage_border;
								echo $page_quicksearch; 
								?> 
							</p>
							<div class="mx-5">
						<form action="advsearch.php" method="get"></br>
							<strong>Note: This search does not currently work. Use the basic search for the time being.</strong></br>
							<strong>Asset Tag #: </strong>
							<input type="text" name="assettag" maxlength="5" size="6"></br></br>
							<strong>Device Name: </strong><input type="text" name="dname" maxlength="16" size="18"></br></br>
							<strong>Owner Username: </strong><input type="text" name="duser" maxlength="9" size="10"></br></br>
							<input type="submit" value="Search">
						</form>
					<?php echo '<tr><td style="height:10px"><br>'.$widget_updates.'</td></tr>'; ?> 
					</th>
				</tr>
			</table>
<?php echo $webpage_bottomcontentbox; ?>
</div>
</body>
</html>