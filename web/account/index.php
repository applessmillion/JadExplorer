<?php
require_once '../config.php';
require_once '../vars/main.php';
?>
<html>
	<head>
		<title><?php echo $text_account_page_title; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<?php echo $tech_html_head_start_body_account; ?>
		<div>
			<?php echo file_get_contents("../gtag.html");
				include_once("header.php");
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
							<img src="../img/login.png" alt="Login_image" <?php echo $webpage_head_image_css; ?>>
							</br>
							<b style="text-transform:uppercase;">Current User</b>
							<h1 style="text-transform:uppercase;"><?php echo $_COOKIE['shux_user']; ?></h1>
						</div>
						<?php echo $widget_webpage_border; ?>
						<p class="mx-3">
							You are currently logged in. This page is a work in progress.
						</p>
					</td>
				</tr>
			<?php echo $webpage_bottomcontentbox; ?>
		</div>
	</body>
	<?php echo $widget_footer; ?>
</html> 