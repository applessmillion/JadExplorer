<?php 
include_once 'config.php';
require_once 'vars/main.php';
$con = new mysqli($ip,$user,$pw,$db);

$search_sql_limit = 30;

	$pageno = $_GET['page'];
	$search_sql_pos = $search_sql_limit*$pageno;
	if($pageno != 0){ $search_sql_pos = $search_sql_pos+1;}
	$search_sql_findpage = $search_sql_limit*($pageno+1)+1;
	$search_term = $_GET['search'];

if(isset($_GET['search'])){
	$sqlquery = "SELECT * FROM asset_information LEFT JOIN edit_log ON edit_log.asset_id = asset_information.Entity_ID
			WHERE device_ID='$search_term' GROUP BY Entity_ID ORDER BY editdate DESC LIMIT $search_sql_pos, $search_sql_limit";
	$sql_getname = "SELECT Device_ID, model, model_number, friendly_name FROM device_information WHERE Device_ID='$search_term'";
		$search_query = mysqli_query($con, $sqlquery);
		$search_name = mysqli_query($con, $sql_getname);
		$search_nums = mysqli_num_rows($search_query);
		$nam_obj = mysqli_fetch_object($search_name);
		
		$devicemodel	= $nam_obj->model;
		$devicemodelno	= $nam_obj->model_number;
		$devicenicename = $nam_obj->friendly_name;
		if($devicenicename != NULL){ $text_searchresult_heading = "<h1>Showing Assets for ".$devicenicename; }else{ $text_searchresult_heading = "<h1>Showing Assets for ".$devicemodel . " " . $devicemodelno; }		
}
else{
	$sqlquery = "SELECT device_information.Device_ID, device_information.manufacturer, device_information.friendly_name, device_information.model,
			device_information.model_number, device_information.model_price, COUNT(asset_information.device_ID) CNT
			FROM device_information INNER JOIN asset_information ON device_information.Device_ID = asset_information.device_ID 
			GROUP BY Device_ID ORDER BY CNT DESC, Device_ID DESC LIMIT $search_sql_pos, $search_sql_limit";
		$search_query = mysqli_query($con, $sqlquery);
		$search_nums = mysqli_num_rows($search_query);
	$text_searchresult_heading = "<h1>".$text_devices_device_list_title."</h1>";
}
?>    
<html>
	<head>
		<title><?php echo $text_results_page_title; ?></title>
		<meta charset="utf-8">
	</head>
	<?php echo $tech_html_head_start_body; ?>
	<div>
		<?php echo file_get_contents("gtag.html");
			include_once 'header.php'; 
		?>
		</br>
	</div>
	<div class="container-fluid" style="<?php echo $webpage_maincontent_css; ?>">
		<?php
			if($alert_text != ""){ echo $widget_webpage_alert;}
			echo $webpage_topcontentbox; 
		?>
	</div>
	<tr class="text-center">
		<th>
			<a href="search.php"><img src="img/logo-dark.png" width="18%" alt="dark_logo" style="min-width:156px;max-width:256px;"></a>
				<?php
				if($local_error_code == 1){ ?>
					<h1><?php echo $error_results_badurl_title; ?></h1>
					<?php echo $error_results_badurl_desc; ?>
				<?php }	
				elseif($search_nums == 0){ ?>
					<h1><?php echo $text_search_noresults_title; ?></h1>
					<?php echo $text_search_noresults_desc; ?>
				<?php }
				else{ ?>
					<h1><?php echo $text_searchresult_heading; ?></h1>
					<div class="mx-5">
						<p><?php echo $text_devices_device_list_desc; ?></p>
					</div>
				<?php echo $widget_webpage_border; ?>
					<table width="80%" align="center" class="table-bordered table-sm">
						<thead class="thead-dark">
							<tr class="text-left border">
							<?php if(isset($_GET['search'])){ ?>
								<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>">Asset Name</b></th>
								<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>">Recent User</b></th>
								<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>">Last Edit</b></th>
							<?php }else{ ?>
								<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>">Model</b></th>
								<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>">Manufacturer</b></th>
								<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>">Price (USD)</b></th>
								<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>">Total Devices</b></th>
							<?php } ?>
							</tr>
						</thead>
						<tbody>
						<?php if(isset($_GET['search'])){ ?>
							<?php while ($obj = mysqli_fetch_object($search_query)) { 
								if($obj->status == 2){$tr_class = 'class="border table-warning"';}
								elseif($obj->status == 1){$tr_class = 'class="border table-danger"';}
								elseif($obj->status == 0){$tr_class = 'class="border"';}
							?>
								<tr <?php echo $tr_class; ?>>
									<td style="font-size:16px"><b><a href="search.php?infoname=<?php echo $obj->name;?>"><?php echo $obj->name;?></a></b></td>
									<td style="font-size:16px"><?php echo $obj->recent_user;?></td>
									<td style="font-size:16px"><?php echo date('F j, Y', strtotime($obj->editdate));?></td>
								</tr> 
							<?php } ?>
						<?php } else{ 
							while ($obj = mysqli_fetch_object($search_query)) { ?>
								<tr class="border">
									<td style="font-size:16px">
										<b><a href="devices.php?search=<?php echo $obj->Device_ID; ?>"><?php if($obj->friendly_name != NULL){ echo $obj->friendly_name; }else{ echo $obj->model ." ". $obj->model_number; }?></a></b>
									</td>
									<td style="font-size:16px"><?php echo $obj->manufacturer;?></td>
									<td style="font-size:16px">$<?php if($obj->model_price == NULL){ echo "0.00";}else{ echo $obj->model_price;} ?>
									</td>
									<td style="font-size:16px"><b><?php if($obj->CNT == NULL){ echo 0;}else{ echo $obj->CNT;} ?> logged.</b></td>
								</tr> 
							<?php }
							} ?>
						</tbody>
					</table>
				</td>
			<?php	} echo $widget_webpage_border; ?>
			<?php if(isset($_GET['search'])){ ?>
				<?php if($pageno != 0){ ?> <a href="devices.php?search=<?php echo $search_term; ?>&page=<?php $pageno-1; ?>"><?php echo $button_previous_page; ?></a> <?php } ?>
				<?php if($search_nums >= $search_sql_limit){ ?><a href="devices.php?search=<?php echo $search_term;?>&page=<?php echo $pageno+1; ?>"><?php echo $button_next_page; ?></a><?php } ?>
			<?php }else{ ?>
				<?php if($pageno != 0){ ?> <a href="devices.php?page=<?php echo $pageno-1; ?>"><?php echo $button_previous_page; ?></a> <?php } ?>
				<?php if($search_nums >= $search_sql_limit){ ?><a href="devices.php?page=<?php echo $pageno+1; ?>"><?php echo $button_next_page; ?></a><?php } ?>
			<?php } ?>
		</tr>
		<?php echo $webpage_bottomcontentbox; ?>
		</div></div>
	</body>
</html>
<?php 
	mysqli_close($con);
?>