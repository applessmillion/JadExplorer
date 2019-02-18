<?php
//Include pages for variables for texts
include_once 'vars.php';


?>

<html>
<!-- Initalize Page -->
	<head>
		<title>Maralook - Contributors</title>
		<?php echo $tech_css_js_styleimports; ?>
	</head>
	<body style="background:url(img/bg.png) no-repeat;background-size:cover;line-height:1;background-attachment:fixed;text-align:center;height:100%">
		<div>
			<?php echo file_get_contents("gtag.html");
			echo file_get_contents("header.html") . "</br>"; ?>
		</div>
		<div class="container-fluid">
			<?php 
				if($alert_text != ""){ echo $widget_webpage_alert;}
				echo $webpage_topcontentbox;
			?>
				<tr>
					<th>
						<img src="img/about_image.png">
						<h2>About SHU-Explorer</h2>
					</th>
				</tr>
				<tr>
					<th>
						<p>
							<?php echo $about_desc; ?>
						</p>
					</th>
				</tr>
				<?php echo '<tr><th style="font-size: 85%;">'.$widget_aboutinfo.'</th></tr>'; 
				echo $webpage_bottomcontentbox; ?>
		</div>
	</body>
</html>
