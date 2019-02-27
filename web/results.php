<?php
include_once 'config.php';
include_once 'vars.php';
$con = new mysqli($ip,$user,$pw,$db);


if(isset($_GET['assettag'])){ 
	$id = $_GET['assettag'];
	$sqlquery = "SELECT * FROM asset_information INNER JOIN device_information ON asset_information.device_ID = device_information.Device_ID WHERE tagno like '%$id%' ORDER BY tagno DESC LIMIT 30"; 
}
elseif(isset($_GET['assetname'])){ 
	$id = $_GET['assetname'];
	$sqlquery = "SELECT * FROM asset_information INNER JOIN device_information ON asset_information.device_ID = device_information.Device_ID WHERE name like '%$id%' ORDER BY tagno DESC LIMIT 30";
}
else{
	$local_error_code = 1; # Sets a variable we can check later.
}
?>    
<html>
	<head><title><?php echo $text_results_page_title; ?></title></head>
	<?php echo $tech_html_head_start_body; ?>
	<div>
		<?php echo file_get_contents("gtag.html");
			echo file_get_contents("header.html"); 
		?>
		</br>
	</div>
	<div class="container-fluid" style="<?php echo $webpage_maincontent_css; ?>">
		<?php ### Webpage alert widget.
			if($alert_text != ""){ echo $widget_webpage_alert;}
			echo $webpage_topcontentbox;
		?>
	</div>
	<?php
		### Run the search query and find the number of rows.
		$search_query = mysqli_query($con, $sqlquery);
		$search_nums = mysqli_num_rows($search_query);
		if($search_nums == NULL){$search_nums = 0;}
	?>
	<tr class="text-center">
		<th>
			<a href="search.php"><img src="img/search-item.png" width="18%" alt="Search_Image" style="min-width:156px;max-width:256px;"></a>
			<?php ## This is what happens when we error out.
			if($local_error_code == 1){ ?>
				<h1><?php echo $error_results_badurl_title; ?></h1>
				<?php echo $error_results_badurl_desc; ?>
			<?php }	## This is what happens when we have no results.
			elseif($search_nums == 0){ ?>
				<h1><?php echo $text_search_noresults_title; ?></h1>
				<?php echo $text_search_noresults_desc; ?>
			<?php }	## This is what happens when we have results.
			else{
				## Doing a null search? We got special text for that!
				if($id){ ?>
					<h1>Showing <?php echo $search_nums; ?> results for <i><?php echo $id ?></i></h1>
				<?php }
				else{ ?>
					<h1><?php echo $text_search_results_null_title; ?></h1>
					<div class="m-4" style="max-width=50%">
						<p><?php echo $text_search_results_null_desc; ?></p>
					</div>
				<?php	}
					echo $widget_webpage_border; 
				?>
					<table width="85%" align="center" class="table-bordered">
						<thead class="thead-dark">
							<tr class="text-center border">
								<th>
									<b style="font-size:<?php echo $table_tagcol_text_size . '">' . $text_search_results_head1; ?></b>
								</th>
								<th>
									<b style="font-size:<?php echo $table_tagcol_text_size . '">' . $text_search_results_head2; ?></b>
								</th>
								<th>
									<b style="font-size:<?php echo $table_tagcol_text_size . '">' . $text_search_results_head3; ?></b>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php while ($obj = mysqli_fetch_object($search_query)) { ?>
								<tr class="border">
									<td>
										<a class='reg' 
										<?php if($obj->tagno == 0){ echo "href='search.php?infoname=" . urlencode($obj->name) . "' style='font-size:18'>N/A</a>"; }
										else{ echo "href='search.php?infotag=" . urlencode($obj->tagno) . "' style='font-size:18'><b>". $obj->tagno . "</b></a>"; } 
										?> 
									</td>
									<td>
										<?php if($obj->name != "Unknown"){echo "<a class='reg' href='search.php?infoname=" . urlencode($obj->name) . "' style='font-size:16'><b>" . $obj->name . "</b></a>";} 
										else {echo "<i>".$obj->name."</i>";}?>
									</td>
									<td style="font-size:16px">
										<?php echo $obj->model ." ". $obj->model_number;?>
									</td>
								</tr> 
							<?php } ?>
						</tbody>
					</table>
				</td>
			<?php	}
			echo $widget_webpage_border.'<a href="javascript:history.go(-1)">'.$text_goback.'</a></tr>';

	echo $webpage_bottomcontentbox; ?>
		</div></div>
	</body>
</html>

<?php
mysqli_close($con);
?>
