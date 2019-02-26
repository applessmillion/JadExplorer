<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
include_once 'config.php';
include_once 'vars.php';

##########CONNECTION INFO FOR DATABASE###########
$con = new mysqli($ip,$user,$pw,$db);
############STARTING CONTENT#############

?>
<html>
	<head>
		<title>SHU-Explorer - Search</title>
	</head>
	<?php echo $tech_html_head_start_body; ?>
		<div>
			<?php echo file_get_contents("gtag.html");
			echo file_get_contents("header.html") ?>
			</br>
		</div>
		<div class="container-fluid" style="<?php echo $webpage_maincontent_css; ?>">
			<?php 
				if($alert_text != ""){ echo $widget_webpage_alert;}
				echo $webpage_topcontentbox;
			?>
<!-- End Init -->
					<tr class="text-center">
						<td>
							<a href="advsearch.php">
								<img src="img/search-advanced.png" width="18%" style="min-width:156px;max-width:256px;">
							</a>
						</br>
							<img src="img/titles/advancedsearch.png">
							<p>
								<?php 
								echo $widget_webpage_border;
								echo $page_quicksearch; 
								?> 
							</p>
							<div class="mx-5">
						<table style="max-width:400px" align="center" class="border">
							<thead class="thead-dark">
								<tr>
									<th>
										<div style="font-size:22"><?php echo $text_search_form_assetsearch_title; ?></div>
									</th>
								</tr>
							</thead>
							<tbody>
								<td>
									<form action="search.php" method="get" class="m-2">
										<label><b><?php echo $text_search_form_assetsearch_label; ?></b></label>
										<div class="form-row align-items-center">
											<div class="col-auto">
												<div class="input-group mb-2">
													<div class="input-group-prepend">
													  <div class="input-group-text">#</div>
													</div>
													<input type="text" class="form-control" id="Asset" placeholder="15746" name="assettag">
												</div>
											</div>
											<div class="col-auto">
												<button type="submit" class="btn btn-primary mb-2">Submit</button>
											</div>
										</div>
									</form>
								</td>
							</tbody>
						</table>
					<?php echo '<tr><td style="height:10px"><br>'.$widget_updates.'</td></tr>'; ?> 
					</th>
				</tr>
			</table>
<?php echo $webpage_bottomcontentbox; ?>
</div>
</body>
</html>