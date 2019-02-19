<?php
require_once 'vars.php';
?>
<html>
	<head>
		<title>SHU-Explorer - Search</title>
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
					<img src="img/search.png" class="rounded" alt="Search" width="18%" style="min-width:156px;max-width:256px;"></br>
					<img src="img/titles/welcome.png" class="rounded" alt="Welcome">
				</th>
			</tr>
			<tr>
				<td>
					<p>
						<?php 
						echo $widget_webpage_border_large;
						echo $page_index;
						echo $widget_webpage_border;
						?> 
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $widget_updates; ?>
				</td>
			</tr>
			<tr class="text-center">
				<td>
					<?php echo $copyright_notice; ?>
				</td>
			</tr>
		<?php echo $webpage_bottomcontentbox; ?>
		</div></div>
	</body>
</html> 