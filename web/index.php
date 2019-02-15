<?php
require_once 'vars.php';
?>
<html>
	<head>
		<title>SHU-Explorer - Search</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="main">
		<?php
		echo    file_get_contents('header.html') . "</br>";
		
		if($alert_text != ""){
			echo $widget_webpage_alert;
		}
			
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
								echo $index_title;
								echo $index_desc; 
								echo "</br></br>";
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
		</div>
	</body>
</html> 