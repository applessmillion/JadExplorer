<?php
//Include pages for variables for texts
include_once 'vars.php';
?>
<html>
	<head>
		<title>Maralook - Contributors</title>
		<?php echo $tech_css_js_styleimports; ?>
	</head>
	<body style="background:url(img/bg.png) no-repeat;background-size:cover;line-height:1;background-attachment:fixed;text-align:center;height:100%">
		<div>
			<?php echo file_get_contents("gtag.html");
			echo file_get_contents("header.html") . "</br>"; ?>
		</div>
		<div class="container-fluid" style="max-width:1200px">
			<?php 
				if($alert_text != ""){ echo $widget_webpage_alert;}
				echo $webpage_topcontentbox;
			?>
		</div>
		<div class="container-fluid" style="max-width:1000px">
			<tr class="text-center">
				<th>
					<img src="img/about-image.png" class="rounded" alt="About_Image" width="18%" style="min-width:156px;max-width:256px;">
					<h2>About SHU-Explorer</h2>
					<?php echo $widget_webpage_border; ?>
				</th>
			</tr>
			<tr>
				<td>
					<p>
						<?php echo $about_desc; ?>
					</p>
				</td>
			</tr>
			<?php echo '
			<tr class="text-center">
				<td style="font-size: 65%;">'.$widget_aboutinfo.'</td>
			</tr>' .  
			$webpage_bottomcontentbox; ?>
		</div>
	</body>
</html>
