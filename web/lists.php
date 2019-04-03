<?php 
include_once 'config.php';
require_once 'vars/main.php';
$con = new mysqli($ip,$user,$pw,$db);
$search_sql_limit = 25;

	$pageno = $_GET['page'];
	$search_sql_pos = $search_sql_limit*$pageno;
	$search_sql_findpage = $search_sql_limit*($pageno+1);
	$search_term = $_GET['search'];

if(isset($_GET['search'])){
	$sqlquery = "SELECT * FROM asset_information LEFT JOIN (SELECT * FROM edit_log ORDER BY edit_id DESC) 
				AS eid ON eid.asset_id = asset_information.Entity_ID WHERE device_id='$search_term'
				GROUP BY Entity_ID ORDER BY editdate DESC LIMIT $search_sql_pos, $search_sql_limit";
	$sql_getname = "SELECT Device_ID, model, model_number, friendly_name FROM device_information WHERE Device_ID='$search_term'";
	$search_name = mysqli_query($con, $sql_getname);
	$nam_obj = mysqli_fetch_object($search_name);
	$devicemodel	= $nam_obj->model;
	$devicemodelno	= $nam_obj->model_number;
	$devicenicename = $nam_obj->friendly_name;
	if($devicenicename != NULL){ $text_searchresult_heading = "<h1>Showing Assets for ".$devicenicename; }else{ $text_searchresult_heading = "<h1>Showing Assets for ".$devicemodel . " " . $devicemodelno; }
	$listpage = "";
}
elseif(isset($_GET['os'])){
	$sqlquery = "SELECT OS, OSV, COUNT(Entity_ID) CNT, CONCAT(COALESCE(OS,''),COALESCE(OSV,'')) OSF  FROM asset_information GROUP BY OSF ORDER BY CNT DESC LIMIT $search_sql_pos, $search_sql_limit";
	$text_searchresult_heading = "<h1>".$text_lists_os_list_title."</h1>";
	$text_searchresult_desc 	= $text_lists_os_list_desc;
	$listpage = "os=";
}
elseif(isset($_GET['login'])){
	$linkmod = $_GET['login'];
	if($linkmod == NULL){ $linkmod = "1 Day";}
	$sqlquery = "SELECT *,COUNT(EDT.edit_id) CNT FROM (SELECT * FROM edit_log ORDER BY edit_id DESC) EDT LEFT JOIN asset_information ON asset_information.Entity_ID = EDT.asset_id 
				WHERE editdate >= (NOW() - INTERVAL $linkmod) AND recent_user IS NOT NULL GROUP BY asset_id ORDER BY CNT DESC, editdate DESC LIMIT $search_sql_pos, $search_sql_limit";
	$text_searchresult_heading = "<h1>".$text_lists_login_list_title . $linkmod."</h1>";
	$text_searchresult_desc 	= $text_lists_login_list_desc;
	$listpage = "login=";
}
else{
	$sqlquery = "SELECT device_information.Device_ID, device_information.manufacturer, device_information.friendly_name, device_information.model, device_information.model_number, device_information.model_price, COUNT(asset_information.device_ID) CNT
			FROM device_information INNER JOIN asset_information ON device_information.Device_ID = asset_information.device_ID GROUP BY Device_ID ORDER BY CNT DESC, Device_ID DESC LIMIT $search_sql_pos, $search_sql_limit";
	$text_searchresult_heading = "<h1>".$text_lists_device_list_title."</h1>";
	$text_searchresult_desc 	= $text_lists_device_list_desc;
	$listpage = "";
}
### These are common for the above.
	$search_query = mysqli_query($con, $sqlquery);
	$search_nums = mysqli_num_rows($search_query);
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
		<?php
			if($alert_text != ""){ echo $widget_webpage_alert;}
			echo $webpage_topcontentbox; 
		?>
	</div>
	<tr class="text-center">
		<th>
			<div class="mx-5 my-1">
				<a onclick="doLoading()" href="lists.php"><img src="img/logo-dark.png" width="18%" alt="dark_logo" class="mt-1 mb-2" style="min-width:156px;max-width:256px;"></a></br>
				<h1><?php echo $text_searchresult_heading; ?></h1>
				<p class="text-left mx-5 px-3"><?php echo $text_searchresult_desc; ?>
			</div>
			<a onclick="doLoading()" href="lists.php?os"><?php echo $button_os_list;?></a>
			<a onclick="doLoading()" href="lists.php"><?php echo $button_device_list;?></a>
			<a onclick="doLoading()" href="lists.php?login"><?php echo $button_login_list;?></a>
			<?php if(isset($_GET['login'])){ ?>
			<div class="pt-2">
				<a onclick="doLoading()" href="lists.php?login=1 Day"><?php echo $button_login_d;?></a>
				<a onclick="doLoading()" href="lists.php?login=1 Week"><?php echo $button_login_w;?></a>
				<a onclick="doLoading()" href="lists.php?login=1 Month"><?php echo $button_login_m;?></a>
				<a onclick="doLoading()" href="lists.php?login=1 Year"><?php echo $button_login_y;?></a>
			</div>
			<?php } ?>
			<?php echo $widget_webpage_border; ?>
		</th>
	</tr>
	<tr>
		<td>
			<?php if($search_nums == 0){ ?>
				<div class="m-3">
					<h1 class="text-center"><?php echo $text_search_noresults_title; ?></h1>
					<p class="m-2"><?php echo $text_search_noresults_desc; ?></p>
				</div>
			<?php } ?>
				<table width="80%" align="center" class="table-striped table-sm">
					<thead class="thead-dark">
						<tr class="text-left border">
						<?php if(isset($_GET['search'])){ ?>
							<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>"><?php echo $text_lists_table_head_assetname; ?></b></th>
							<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>"><?php echo $text_lists_table_head_recentuser; ?></b></th>
							<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>"><?php echo $text_lists_table_head_lastlogin; ?></b></th>
						<?php }elseif(isset($_GET['os'])){ ?>
							<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>"><?php echo $text_lists_table_head_os; ?></b></th>
							<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>"><?php echo $text_lists_table_head_osversion; ?></b></th>
							<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>"><?php echo $text_lists_table_head_devicetotal; ?></b></th>
						<?php }elseif(isset($_GET['login'])){ ?>
							<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>"><?php echo $text_lists_table_head_assetname; ?></b></th>
							<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>"><?php echo $text_lists_table_head_recentuser; ?></b></th>
							<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>"><?php echo $text_lists_table_head_userlogins; ?></b></th>
							<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>"><?php echo $text_lists_table_head_lastlogin; ?></b></th>
						<?php }else{ ?>
							<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>"><?php echo $text_lists_table_head_devicemodel; ?></b></th>
							<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>"><?php echo $text_lists_table_head_devicemanu; ?></b></th>
							<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>"><?php echo $text_lists_table_head_deviceprice; ?></b></th>
							<th><b style="font-size:<?php echo $table_tagcol_text_size; ?>"><?php echo $text_lists_table_head_devicetotal; ?></b></th>
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
								<td style="font-size:16px"><b><a onclick="doLoading()" href="search.php?infoname=<?php echo $obj->name;?>"><?php echo $obj->name;?></a></b></td>
								<td style="font-size:16px"><?php echo $obj->recent_user;?></td>
								<td style="font-size:16px"><?php if($utility_noshow_devices_before < date('Y', strtotime($obj->editdate))){ echo date('F j, Y', strtotime($obj->editdate));}?></td>
							</tr> 
						<?php } ?>
					<?php }elseif(isset($_GET['os'])){ ?>
						<?php while ($obj = mysqli_fetch_object($search_query)) { ?>
						<?php 	
							if(strpos(strtolower($obj->OS), 'windows') !== false){ $osicon = "fab fa-windows";}
							elseif(strpos(strtolower($obj->OS), 'mac') !== false){ $osicon = "fab fa-apple";}
							elseif(strpos(strtolower($obj->OS), 'ubuntu') !== false){ $osicon = "fab fa-ubuntu";}
							elseif($obj->OS == NULL){ $osicon = "far fa-question-circle";}
							else{ $osicon = "fab fa-linux";}
						?>
							<tr class="border">
								<td style="font-size:16px"><i class="<?php echo $osicon; ?>" style="font-size:18px"></i><b> <?php if($obj->OS == NULL){ echo "<i>Unknown</i>";}else{ echo $obj->OS;} ?></b></td>
								<td style="font-size:16px"><?php echo $obj->OSV;?></td>
								<td style="font-size:16px"><b><?php if($obj->CNT == NULL){ echo 0;}else{ echo $obj->CNT;} ?> logged.</b></td>
							</tr> 
						<?php } ?>
					<?php }elseif(isset($_GET['login'])){ ?>
						<?php while ($obj = mysqli_fetch_object($search_query)) { 
							if($obj->status == 2){$tr_class = 'class="border table-warning"';}
							elseif($obj->status == 1){$tr_class = 'class="border table-danger"';}
							elseif($obj->status == 0){$tr_class = 'class="border"';}
						?>
							<tr <?php echo $tr_class; ?>>
								<td style="font-size:16px"><b><a onclick="doLoading()" href="search.php?infoname=<?php echo $obj->name;?>"><?php echo $obj->name;?></a></b></td>
								<td style="font-size:16px"><?php echo $obj->recent_user;?></td>
								<td style="font-size:16px"><b><?php if($obj->CNT == 1){ echo $obj->CNT." login"; }else{ echo $obj->CNT." logins"; } ?></b></td>
								<td style="font-size:16px"><?php if($utility_noshow_devices_before < date('Y', strtotime($obj->editdate))){ echo date('F j, Y', strtotime($obj->editdate));}?></td>
							</tr> 
						<?php } ?>
					<?php }else{ 
						while ($obj = mysqli_fetch_object($search_query)) { ?>
							<tr class="border">
								<td style="font-size:16px">
									<b><a onclick="doLoading()" href="lists.php?search=<?php echo $obj->Device_ID; ?>"><?php if($obj->friendly_name != NULL){ echo $obj->friendly_name; }else{ echo $obj->model ." ". $obj->model_number; }?></a></b>
								</td>
								<td style="font-size:16px"><?php echo $obj->manufacturer;?></td>
								<td style="font-size:16px">$<?php if($obj->model_price == NULL){ echo "0";}else{ echo $obj->model_price;} ?>
								</td>
								<td style="font-size:16px"><b><?php if($obj->CNT == NULL){ echo 0;}else{ echo $obj->CNT;} ?> assets</b></td>
							</tr> 
						<?php }
						} ?>
					</tbody>
				</table>
				<div class="text-center">
					<?php echo $widget_webpage_border; ?>
					<?php if(isset($_GET['search'])){ ?>
						<?php if($pageno != 0){ ?> <a onclick="doLoading()" href="lists.php?search=<?php echo $search_term; ?>&page=<?php $pageno-1; ?>"><?php echo $button_previous_page; ?></a> <?php } ?>
						<?php if($search_nums >= $search_sql_limit){ ?><a onclick="doLoading()" href="lists.php?search=<?php echo $search_term;?>&page=<?php echo $pageno+1; ?>"><?php echo $button_next_page; ?></a><?php } ?>
					<?php }else{ ?>
						<?php if($pageno != 0){ ?> <a onclick="doLoading()" href="lists.php?<?php echo $listpage.$linkmod; ?>&page=<?php echo ($pageno-1) ?>"><?php echo $button_previous_page; ?></a> <?php } ?>
						<?php if($search_nums >= $search_sql_limit){ ?><a onclick="doLoading()" href="lists.php?<?php echo $listpage.$linkmod; ?>&page=<?php echo ($pageno+1) ?>"><?php echo $button_next_page; ?></a><?php } ?>
					<?php } ?>
				</div>
			</td>
		</tr>
		<?php echo $webpage_bottomcontentbox; ?>
		</div></div>
	</body>
</html>
<?php 
	mysqli_close($con);
?>