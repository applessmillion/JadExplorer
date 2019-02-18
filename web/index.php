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
		<div class="container-fluid">
			<?php 
				if($alert_text != ""){ echo $widget_webpage_alert;}
				echo $webpage_topcontentbox;
			?>
			<tr>
				<th>
					<img src="img/search.png">
				</th>
			</tr>
					<tr>
						<th>
							<img src="img/titles/welcome.png">
						</th>
					</tr>
					<tr>
						<td style="height:8px"></td>
					</tr>
					<tr>
						<th>
							<p>
								<?php 
								echo $widget_webpage_border_large;
								echo $page_index;
								echo $widget_webpage_border;
								?> 
							</p>
							<?php
							echo    $widget_updates;
							echo	$copyright_notice;
							?>
						</th>
					</tr>
		<?php echo $webpage_bottomcontentbox; ?>
		</div></div>
	</body>
</html> 