<?php
//Include pages for variables for texts
require_once 'vars/main.php';
?>
<html>
	<head>
		<title><?php echo $text_about_page_title; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<?php echo $tech_html_head_start_body; ?>
		<div>
			<?php echo file_get_contents("gtag.html"); include_once 'header.php'; ?>
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
					<p class="mx-4 text-left">
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
	<?php echo $widget_footer; ?>
</html>
