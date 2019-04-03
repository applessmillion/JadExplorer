<?php
include_once 'config.php';
require_once 'vars/main.php';
$con = new mysqli($ip,$user,$pw,$db);

### Eventually move to special var file.
$search_sql_limit = 30;

if(isset($_GET['assettag'])){ 
	$id = $_GET['assettag'];
	$sqlquery = "SELECT * FROM asset_information INNER JOIN device_information ON asset_information.device_ID = device_information.Device_ID WHERE tagno like '%$id%' ORDER BY tagno DESC LIMIT $search_sql_limit"; 
	if($_GET['assettag'] == NULL){ $text_searchresult_heading = "<h1>Showing Results Organized by Asset Tag</h1>";}
	else{ $text_searchresult_heading = "<h1>Showing ".$search_nums." results for #<i>".$id."</i></h1>"; } //Define unique heading for ASSETTAG
}
elseif(isset($_GET['assetname'])){ 
	$id = $_GET['assetname'];
	$sqlquery = "SELECT * FROM asset_information INNER JOIN device_information ON asset_information.device_ID = device_information.Device_ID WHERE name like '%$id%' ORDER BY tagno DESC LIMIT $search_sql_limit";
	$text_searchresult_heading = "<h1>Showing ".$search_nums." results for <i>".$id."</i></h1>"; //Define unique heading for ASSETNAME
	if($_GET['assetname'] == NULL){ $text_searchresult_heading = "<h1>Showing Results Organized by Asset Tag</h1>";}
	else{ $text_searchresult_heading = "<h1>Showing ".$search_nums." results for #<i>".$id."</i></h1>"; } //Define unique heading for ASSETTAG
}
elseif(isset($_GET['username']) && isset($_GET['s'])){ 
	$id = $_GET['username'];
	$sqlquery = "SELECT * FROM asset_information INNER JOIN edit_log ON asset_information.Entity_ID = edit_log.asset_id WHERE recent_user='$id' ORDER BY editdate DESC LIMIT $search_sql_limit";
	$text_searchresult_heading = "<h1>Showing ".$search_nums." logins for <i>".$id."</i></h1>"; //Define unique heading for USERNAME-EXACT
}
elseif(isset($_GET['username'])){ 
	$id = $_GET['username'];
	$sqlquery = "SELECT * FROM asset_information INNER JOIN edit_log ON asset_information.Entity_ID = edit_log.asset_id WHERE recent_user like '%$id%' ORDER BY editdate DESC LIMIT $search_sql_limit";
	if($_GET['username'] == NULL){ $text_searchresult_heading = "<h1>Showing Results Organized by Asset Tag</h1>";}
	else{ $text_searchresult_heading = "<h1>Showing ".$search_nums." logins for names like <i>".$id."</i></h1>"; } //Define unique heading for ASSETTAG
}
else{ $local_error_code = 1; /* Sets a variable we can check later. */ }
?>    
<html>
	<head>
		<title><?php echo $text_results_page_title; ?></title>
		<meta charset="utf-8">
	</head>
	<?php echo $tech_html_head_start_body; ?>
	<div>
		<?php echo file_get_contents("gtag.html"); include_once 'header.php'; ?>
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
			else{ ?>
					<h1><?php echo $text_searchresult_heading; ?></h1>
					<div class="mx-5">
						<p>
							<?php 
							if($id && $_GET['username']){ echo $text_search_results_content_user_desc; }
							elseif($id){ echo $text_search_results_content_desc; }
							else{ echo $text_search_results_null_desc;?>
						</p>
					</div>
				<?php	} echo $widget_webpage_border; ?>
					<table align="center" class="table table-striped" style="max-width:88%">
						<thead class="thead-dark">
							<tr class="text-left border">
								<th class="col-auto">
									<b style="font-size:<?php echo $table_tagcol_text_size ?>"><?php echo $text_search_results_head1; ?></b>
								</th>
								<th class="col-auto">
									<b style="font-size:<?php echo $table_tagcol_text_size ?>"><?php echo $text_search_results_head2; ?></b>
								</th>
								<th class="col-auto">
									<b style="font-size:<?php echo $table_tagcol_text_size ?>"><?php echo $text_search_results_head5; ?></b>
								</th>
								<th class="col-auto">
									<b style="font-size:<?php echo $table_tagcol_text_size ?>">
										<?php if(isset($_GET['username'])){ echo $text_search_results_head4; }else{ echo $text_search_results_head3; } ?>
									</b>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php while ($obj = mysqli_fetch_object($search_query)) { ?>
								<tr class="border">
									<td>
										<a class="badge badge-dark" style="font-size:18px"
										<?php if($obj->tagno == 0){ echo "href='search.php?infoname=" . urlencode($obj->name) . "'>N/A"; }
										else{ echo "href='search.php?infotag=" . urlencode($obj->tagno) . "'><i class='fas fa-tag'></i> <b> ". $obj->tagno . "</b>"; } ?>
										</a>
									</td>
									<td>
										<?php if($obj->name != "Unknown"){echo "<a class='reg' href='search.php?infoname=" . urlencode($obj->name) . "' style='font-size:16;color:black'><b>" . $obj->name . "</b></a>";} 
										else {echo "<i>".$obj->name."</i>";} ?>
									</td>
									<td>
										<?php if($obj->OS == NULL){echo "N/A";} 
										else {echo "<b style='font-size:13px'>".$obj->OS."</b></br><i style='font-size:10px'>Ver. ".$obj->OSV."</i>";} ?>
									</td>
									<?php if(isset($_GET['username'])){ ?>
										<td style="font-size:16px;"><?php echo date('F j, Y', strtotime($obj->editdate));?></td>
									<?php }else{ ?>
										<td>
											<b><a href="devices.php?search=<?php echo $obj->device_ID ?>" style="font-size:16px;color:black"><?php if($obj->friendly_name != NULL){ echo $obj->friendly_name; }else{ echo $obj->model ." ". $obj->model_number; }?></b>
										</td>
									<?php } ?>
								</tr> 
							<?php } ?>
						</tbody>
					</table>
				</td>
			<?php	}
			echo $widget_webpage_border.'<a href="javascript:history.go(-1)">'.$text_goback.'</a></tr>';
			echo $webpage_bottomcontentbox; ?>
		</div>
		</div>
	</body>
	<?php echo $widget_footer; ?>
</html>
<?php mysqli_close($con); ?>