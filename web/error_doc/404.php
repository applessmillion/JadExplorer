<?php
require_once '../vars/main.php';
?>
<html>
	<head>
		<title><?php echo $error404_page_title; ?></title>
		<?php echo $tech_html_head_start_body; ?>
		<div>
			<?php echo file_get_contents("../gtag.html");
			include_once '../header.php'; ?>
		</div>
		<div class="container-fluid" style="<?php echo $webpage_maincontent_css; ?>">
			<?php echo $webpage_topcontentbox; ?>
			<tr>
				<td>
					<div class="text-center">
						<img src="../img/error.png" alt="Error!" <?php echo $webpage_head_image_css; ?>>
						<h1><?php echo $error404_page_headtext; ?></h1>
						<?php echo $widget_webpage_border; ?>
					</div>
					<p class="mx-5">
						<?php
							echo $error404_page_description;
							echo $widget_webpage_border;
						?>
					</p>
				</td>
			</tr>
			<?php echo $webpage_bottomcontentbox; ?>
		</div>
	</body>
</html> 