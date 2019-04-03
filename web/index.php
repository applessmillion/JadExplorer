<?php
require_once 'vars/main.php';
?>
<html>
	<head>
		<title><?php echo $text_index_page_title; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<?php echo $tech_html_head_start_body; ?>
		<div>
<?php echo file_get_contents("gtag.html"); include_once 'header.php'; ?>
			</br>
		</div>
		<div class="container-fluid" style="<?php echo $webpage_maincontent_css; ?>">
			<?php if($alert_text != ""){ echo $widget_webpage_alert;} echo $webpage_topcontentbox;?>
			<tr>
				<td>
					<div class="text-center">
						<img src="img/search.png" alt="Index_image" <?php echo $webpage_head_image_css; ?>>
						<h1><?php echo $text_index_body_title; ?></h1>
						<?php echo $widget_webpage_border; ?>
						<?php echo $text_index_body_desc; ?>
					</div>
					<div id="index_info_table" class="mx-auto p-4">
						<table class="table table-borderless">
							<tbody>
								<tr>
									<td>
										<h3><?php echo $text_index_body_info_head1; ?></h3>
										<p class="mx-2"><?php echo $text_index_body_info_desc1; ?></p>
									</td>
									<td>
										<h3><?php echo $text_index_body_info_head2; ?></h3>
										<p class="mx-2"><?php echo $text_index_body_info_desc2; ?></p>
									</td>
								</tr>
								<tr>
									<td>
										<h3><?php echo $text_index_body_info_head3; ?></h3>
										<p class="mx-2"><?php echo $text_index_body_info_desc3; ?></p>
									</td>
									<td>
										<h3><?php echo $text_index_body_info_head4; ?></h3>
										<p class="mx-2"><?php echo $text_index_body_info_desc4; ?></p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<p class="mx-5">
						<?php
							echo $widget_webpage_border;
							echo $widget_updates;
						?>
					</p>
				</td>
			</tr>
			<?php echo $webpage_bottomcontentbox; ?>
		</div>
	</body>
	<?php echo $widget_footer; ?>
</html> 