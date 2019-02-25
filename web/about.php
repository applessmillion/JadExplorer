<?php
//Include pages for variables for texts
include_once 'vars.php';
?>
<html>
	<head>
		<title>Maralook - Contributors</title>
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
						<img src="img/about-image.png" alt="About_Image" <?php echo $webpage_head_image_css; ?>>
						<h1><?php echo $text_about_body_title; ?></h1>
						<?php echo $widget_webpage_border; ?>
					</div>
					<p class="mx-5">
						<?php echo $text_about_body_desc; ?>
					</p>
				</td>
			</tr>
			<tr class="text-center">
				<td style="font-size: 65%;"><?php echo $widget_aboutinfo ?></td>
			</tr>  
			<?php echo $webpage_bottomcontentbox; ?>
		</div>
	</body>
</html>
