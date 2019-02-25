<?php
require_once 'vars.php';
?>
<html>
	<head>
		<title>SHU-Explorer - Search</title>
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
			?>
			<tr>
				<td>
					<div class="text-center">
						<img src="img/search.png" alt="Index_image" <?php echo $webpage_head_image_css; ?>>
						<h1><?php echo $text_index_body_title; ?></h1>
						<?php echo $widget_webpage_border; ?>
					</div>
					<p class="mx-5">
						<?php echo $text_index_body_desc; 
							echo "</br></br>";
							echo $widget_webpage_border;
							echo $widget_updates;
						?>
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