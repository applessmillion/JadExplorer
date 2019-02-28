<?php
require_once 'vars.php';
?>
<!DOCTYPE html>
	<head>
		<title>Roadmap | SHU-Explorer</title>
	</head>
	<?php echo $tech_html_head_start_body; ?>
		<div>
			<?php echo file_get_contents("gtag.html");
				echo file_get_contents("header.html");
			?>
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
						<img src="img/search.png" alt="Index_image" <?php echo $webpage_head_image_css; ?>>
						<h1>Project Roadmap</h1>
						<?php echo $widget_webpage_border; ?>
					</div>
					<p class="mx-5">
						Deploy scripts via Group Policy to have devices check in. This
						will have them report via logs when they start up, and if anything
						has changed, such as their IP or name.
						Also include a user script when people log in.</br>
						Scripts are made, just need to be deployed.</br>
						</br>
						Gather more information, not sure what else, but more info.
						</br></br>
						<b>Finally implement editing.</b>
						</br></br>
						Add new search options: By User, IP, and by Devicetype(maybe)
					</p>
					<div class="text-center">
						<p style="font-size:75%;"><?php echo $copyright_notice; ?></p> 
					</div>
				</td>
			</tr>
			<?php echo $webpage_bottomcontentbox; ?>
		</div>
	</body>
</html> 