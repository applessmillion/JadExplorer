<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
include_once 'config.php';
include_once 'vars.php';

//Start connection to the database.
$con = new mysqli($ip,$user,$pw,$db);

########################STARTING CONTENT#########################

#CODE FOR SEARCHING DATABASE AND PRINTING RESULTS#
if(isset($_GET["assettag"])) {
?>    
<html>
<!-- Initalize Page -->
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
<!-- End Init -->
<?php
    $id = $_GET["assettag"];
    #GET NAME FROM SEARCH TERMS#
	$search_query = mysqli_query($con, "SELECT * FROM asset_information INNER JOIN device_information ON asset_information.device_ID = device_information.Device_ID WHERE tagno like '%$id%' ORDER BY tagno DESC LIMIT 30");
	
	$search_nums = mysqli_num_rows($search_query);
    echo '<tr><th><a href="search.php"><img src="img/search-item.png"></a></th></tr>';
	
	if($search_nums == NULL){$search_nums = 0;}
	
	if($search_nums == 0){
		
		echo '<tr><th><h2>'.$text_search_noresults_title.'</h2></th></tr>';
		echo '<tr><th>'.$text_search_noresults_desc.'</th></tr>';
	}
	else{
		echo '<tr><td><h2>Found '. $search_nums .' results for "'. $id . '"...</h2></td></tr>';
		echo '<tr><td>'.$widget_webpage_border.'</td></tr>';
		echo '<tr><td><table width="500" align="center">';
		echo '<tr><th><b style="font-size:13">Asset Tag#</b></th><th><b style="font-size:13">Device Name</b></th><th><b style="font-size:13">Device Type</b></th></tr>';
		while ($obj = mysqli_fetch_object($search_query)) {
			echo "<tr><td colspan='3'><hr></td></tr>";
			echo "<tr><td>";
			echo "<a class='reg' href='?info=" . urlencode($obj->tagno) . "' style='font-size:12'>". $obj->tagno . "</a></td><td>". $obj->name ."</td><td>". $obj->model ." ". $obj->model_number ."</td></tr>"; 
		} 
		echo '</table></td></tr>';
	}
    echo '<tr><td colspan="2" style="height:20px;">'.$widget_webpage_border.'<a href="javascript:history.go(-1)">'.$text_goback.'</a></td></tr>';
}

#CODE FOR RETRIEVING DATA OF ITEM AND PRINTING RESULTS#
elseif(isset($_GET["info"])) {
        
        $info = urldecode($_GET["info"]);
        $search = mysqli_escape_string($con, $info);
        $query = mysqli_query($con, "SELECT * FROM asset_information WHERE tagno='$info'");
        $obj = mysqli_fetch_object($query);
        $iid = $obj->tagno;
        
?>    
<html>
<!-- Initalize Page -->
	<head>
		<?php echo '<title>SHU-Explorer - Asset #' . $info . '</title>' . $tech_css_js_styleimports; ?>
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

        if($iid == NULL) {
        $errorpage = $error_record_nullid;
                #BACK BUTTON TEXT - BACK TO RESULTS#
        echo "<th>" . $errorpage . "</br></br></th>"; 
        echo '<tr><td style="height:20px;">'.$widget_webpage_border.'<a href="javascript:history.go(-1)">'.$text_goback.'</a></td></tr>';
        }
        else {
            echo "<tr><th><h2>". $text_search_displayinfo_title . $info.".</h2></th></tr>"; 
			echo '<tr><th style="height:'.$webpage_device_iframe_height.'"><iframe src="iteminfo.php?assettag='.$iid.'" style="border:none;height:'.$webpage_device_iframe_height.';width:100%;overflow:hidden"></iframe></br></th></tr>';
			echo "<tr><th><h2>History</h2></th></tr>";

            echo '<tr><th style="color: #E01200">Error: No Logs</th></tr>';
            echo "<tr><th style='font-size: 100%;'>:(</th></tr>";

        echo '<tr><td style="height:30px"></td></tr>';
		
        #BACK BUTTON TEXT - BACK TO RESULTS#
        echo '<tr><td style="height:20px;">'.$widget_webpage_border.'<a href="javascript:history.go(-1)">'.$text_goback.'</a></td></tr>';
        }  
}
else {
?>    
<html>
<!-- Initalize Page -->
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
<!-- End Init -->
					<tr>
						<th>
							<a href="search.php">
								<img src="img/search-item.png">
							</a>
						</th>
					</tr>
					<tr>
						<th>
							<img src="img/titles/basicsearch.png">
						</th>
					</tr>
					<tr>
						<td style="height:8px"></td>
					</tr>
					<tr>
						<th>
							<p>
								<?php 
								echo $widget_webpage_border;
								echo $page_quicksearch; 
								?> 
							</p>
						</th>
					</tr>
					<tr>
						<td style="height:10px" ></td>
					</tr>
					<tr>
						<th>
							<form action="search.php" method="get">
								<strong>Search by Asset Tag #:</strong> <input type="text" name="assettag" maxlength="5" size="6"></br></br>
								<input type="submit" value="Search">
							</form>
        
        <?php
		echo '</th></tr>';  
		echo '<tr><td style="height:10px"><br>'.$widget_updates.'</td></tr>';    
}    
		echo $webpage_bottomcontentbox; ?>
		</div>
	</body>
</html>

<?php
mysqli_close($con);
?>