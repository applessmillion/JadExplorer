<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
include_once 'config.php';
include_once 'vars.php';

//Start connection to the database.
$con = new mysqli($ip,$user,$pw,$db);

########################STARTING CONTENT#########################

#CODE FOR SEARCHING DATABASE AND PRINTING RESULTS#
if(isset($_GET["asstag"])) {
?>    
<html>
<!-- Initalize Page -->
	<head>
		<title>SHU-Explorer - Search</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="main">
					<?php echo file_get_contents('header.html') . "</br>"; 
			if($alert_text != ""){
				echo $widget_webpage_alert;
			}
			?>
			<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">
		<table align="center" width="710">
<!-- End Init -->
<?php
    $name = $_GET["asstag"];
    #GET NAME FROM SEARCH TERMS#
    $search_query = mysqli_query($con, "SELECT * FROM Names WHERE ItemName like '%$name%' OR SecondaryName like '%$name%' ORDER BY ItemName ASC LIMIT 50");
    $search_nums = mysqli_num_rows($search_query);
	
    echo '<tr><th><a href="search.php"><img src="img/search-item.png"></a></th></tr>';
	
	if($search_nums == NULL){$search_nums = 0;}
	
	if($search_nums == 0){
		
		echo '<tr><th><h2>'.$text_search_noresults_title.'</h2></th></tr>';
		echo '<tr><th>'.$text_search_noresults_desc.'</th></tr>';
	}
	else{
		
		echo '<tr><th><h2>Found '. $search_nums .' results for "'. $name . '"...</h2></th></tr>';
		echo '<tr><th>'.$widget_webpage_border.'</th></tr>';
		while ($obj = mysqli_fetch_object($search_query)) {
			echo "<tr><th><a class='reg' href='?info=" . urlencode($obj->ItemName) . "'> " . $obj->ItemName;  
		} 
	}
	
  
    echo '<tr><td style="height:20px;">'.$widget_webpage_border.'<a href="javascript:history.go(-1)">'.$text_goback.'</a></td></tr>';
}

#CODE FOR RETRIEVING DATA OF ITEM AND PRINTING RESULTS#
elseif(isset($_GET["info"])) {
        
        $info = urldecode($_GET["info"]);
        $search = mysqli_escape_string($con, $info);
        $query = mysqli_query($con, "SELECT * FROM Names WHERE ItemName='$info'");
        $obj = mysqli_fetch_object($query);
        $iid = $obj->ItemID;
        
        $pricehistory = mysqli_query($con, "SELECT * FROM Pricelog WHERE ItemID='$iid' ORDER BY Timestamp DESC LIMIT 16");
        $pricehistory2 = mysqli_query($con, "SELECT * FROM Pricelog WHERE ItemID='$iid' ORDER BY Timestamp DESC LIMIT 500");
        $price_nums = mysqli_num_rows($pricehistory);		
?>    
<html>
<!-- Initalize Page -->
	<head>
		<?php echo '<title>SHU-Explorer Info - ' . urldecode($_GET["info"]) . '</title>'; ?>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="main">
			<?php echo file_get_contents('header.html') . "</br>"; 
			if($alert_text != ""){
				echo $widget_webpage_alert;
			}
			?>
		<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">
		<table align="center" width="710">
<!-- End Init -->
<?php
        if($iid == NULL) {
        $marapage = $error_record_nullid;
                #BACK BUTTON TEXT - BACK TO RESULTS#
        echo "<th>" . $marapage . "</br></br></th>"; 
        echo '<tr><td style="height:20px;">'.$widget_webpage_border.'<a href="javascript:history.go(-1)">'.$text_goback.'</a></td></tr>';
        }
        else {
            echo "<tr><th><h2>Displaying info for ". $info.".</h2></th></tr>"; 
            
            $pid = pcntl_fork();
            if ($pid == 0) {
                try {
                $marapage = file_get_html('pricecopier.php?id=' . $iid);
                echo '<tr><th>' . file_get_html("pricecopier.php?id=$iid") . '</th></tr>';
                }
                catch(Exception $e3){
                echo $error_record_page;
                }
                try{
                    foreach($marapage->find('a font[color="#5F148D"]') as $pprice); 
                    $pprice = preg_replace("/[^0-9.]/", "", $pprice->plaintext);
                
                    $sql = "INSERT INTO Pricelog (ItemID, PlayerPrice) VALUES ('$iid', '$pprice');";
                    $sql2 = "UPDATE Names SET LastPrice='$pprice' WHERE ItemID=$iid";
                    $sqlcheck = "SELECT * FROM Pricelog WHERE ItemID='$iid' ORDER BY Timestamp DESC LIMIT 1;";

                    $row=mysqli_fetch_array(mysqli_query($con, $sqlcheck), MYSQL_ASSOC);
                    $timest = $row['Timestamp'];
                    $time = strtotime($timest);
                    $curprice = $row['PlayerPrice'];
                    $curtime = time();
                    if($pprice == 0){
                        echo '<tr><th style="font-size: 90%; color:red">'.$error_record_notfound.'</th></tr>';
                    }
                    elseif(($curtime-$time) >= 29251 AND $pprice != $curprice) {
                        $con->query($sql);
                        $con->query($sql2);
                        echo '<tr><th style="font-size: 95%; color: #009900">'.$error_record_updated.'</th></tr>';
                    
                        if(isset($_COOKIE['ml_user'])){
                            $username = $_COOKIE['ml_user'];
                            $sql3 = "UPDATE Userboard SET Submissions=Submissions+1 WHERE Username='$username'";
                            $con->query($sql3);
                        }
                        else{
                            $username = "Anonymous";
                            $sql3 = "UPDATE Userboard SET Submissions=Submissions+1 WHERE Username='$username'";
                            $con->query($sql3);
                        }
                    }
                } catch (Exception $e) {
                    $marapage = $error_record_timeout;
                    echo "<th>" . $marapage . "</br></br></th>"; 
                }
            
            } else {
                // this is the parent process, and we know the child process id is in $pid
                sleep(5); // wait 4 seconds
                posix_kill($pid, SIGKILL); // then kill the child
                $marapage = $error_record_timeout;
                echo "<th>" . $marapage . "</br></br></th>"; 
            }
			
			//SQL statement for all-time average.
            $avgsql = "SELECT AVG(PlayerPrice) from Pricelog WHERE ItemID='$iid';"; 
			
			//SQL statement for recent average. Averages recent 15 prices.
			$avg2sql = "SELECT AVG(PlayerPrice) from ( SELECT PlayerPrice FROM Pricelog WHERE ItemID='$iid' ORDER BY Timestamp DESC LIMIT 15) AS QRY;"; 
			
			//SQL statement for all-time highest price.
			$hisql = "SELECT * from Pricelog WHERE ItemID='$iid' ORDER BY PlayerPrice DESC LIMIT 1;"; 
			
			//SQL statement for all-time lowest price.
			$losql = "SELECT * from Pricelog WHERE ItemID='$iid' ORDER BY PlayerPrice ASC LIMIT 1;"; 
            
			//Connect and execute recent average SQL, save result as $avg2p
			$recentavg= mysqli_fetch_array(mysqli_query($con, $avg2sql), MYSQL_ASSOC);             
            
			//Connect and execute all-time average SQL, save result as $avgp
			$allavg= mysqli_fetch_array(mysqli_query($con, $avgsql), MYSQL_ASSOC);             
            
			//Connect and execute all-time highest price SQL, save result as $hisql
			$highs= mysqli_fetch_array(mysqli_query($con, $hisql), MYSQL_ASSOC);

			//Connect and execute all-time lowest price SQL, save result as $losql
			$lows= mysqli_fetch_array(mysqli_query($con, $losql), MYSQL_ASSOC);        
			
			//This stuff is a bit buggy. Needs testing later on.
			#$datehi = $highs['Timestamp'];
			#$datelo = $highs['Timestamp'];
			
			
			//Saving the results of the above SQL queries.
			$highp = $highs['PlayerPrice'];
			$lowp = $lows['PlayerPrice'];
			$avgp = $allavg['AVG(PlayerPrice)'];
			$avg2p = $recentavg['AVG(PlayerPrice)'];

			
            echo '<tr><th>'.$widget_webpage_border.'</th></tr>';
            echo "Deprecated statistics block";
            echo '<tr><th>'.$widget_webpage_border.'</th></tr>';
            echo "<tr><th><h2>History</h2></th></tr>";
            if(mysqli_num_rows($pricehistory)==0) {
            echo '<tr><th style="color: #E01200">deprecated error_nologs</th></tr>';
            }
            
            #PRINT PRICE HISTORY#
            while ($objph = mysqli_fetch_object($pricehistory)) {
                $dt = new DateTime($objph->Timestamp);
                echo "<tr><th style='font-size: 100%;'>Priced at <strong>" . number_format($objph->PlayerPrice) . "MP</strong> on " . $dt->format('M j Y H:i') . "</th></tr>";
            }
        echo '<tr><td style="height:30px"></td></tr>';
        #BACK BUTTON TEXT - BACK TO RESULTS#
        echo '<tr><td style="height:20px;">'.$widget_webpage_border.'<a href="javascript:history.go(-1)">'.$text_goback.'</a></td></tr>';
        }
        if(isset($_GET["id"])) {
        echo '<tr><td style="height:20px;"></br><h3>Item ID:'. $iid  .'</h3></td></tr>';
        }
        
}
elseif(isset($_GET["random"])) {
        
        $iid = mt_rand(1, 47400);
        
        $pricehistory = mysqli_query($con, "SELECT * FROM Pricelog WHERE ItemID like $iid ORDER BY Timestamp DESC LIMIT 15");
        $pricehistory2 = mysqli_query($con, "SELECT * FROM Pricelog WHERE ItemID like $iid ORDER BY Timestamp DESC LIMIT 500");
        $price_nums = mysqli_num_rows($pricehistory);

?>    
<html>
<!-- Initalize Page -->
	<head>
		<title>SHU-Explorer - Search</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="main">
			<?php echo file_get_contents('header.html') . "</br>"; 
			if($alert_text != ""){
				echo $widget_webpage_alert;
			}
			?>
		<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">
		<table align="center" width="710">
<!-- End Init -->

<?php
        
        if($iid == NULL) {
        $marapage = $error_record_nullid ;
                #BACK BUTTON TEXT - BACK TO RESULTS#
        echo "<th>" . $marapage . "</br></br></th>"; 
        echo '<tr><td style="height:20px;">'.$widget_webpage_border.'<a href="javascript:history.go(-1)">'.$text_goback.'</a></td></tr>';
        }
        else {
            echo "<tr><th><h2>Displaying information for ". $info.".</h2></th></tr>"; 
            
            $pid = pcntl_fork();
            if ($pid == 0) {
                try {
                $marapage = file_get_html('pricecopier.php?id=' . $iid);
                echo '<tr><th>' . file_get_html("pricecopier.php?id=$iid") . '</th></tr>';
                }
                catch(Exception $e3){
                echo 'Error: Could not fetch item info. Refresh and try again';
                }
                try{
                    foreach($marapage->find('a font[color="#5F148D"]') as $pprice); 
                    $pprice = preg_replace("/[^0-9.]/", "", $pprice->plaintext);
                
                    $sql = "INSERT INTO Pricelog (ItemID, PlayerPrice) VALUES ('$iid', '$pprice');";
                    $sql2 = "UPDATE Names SET LastPrice='$pprice' WHERE ItemID=$iid";
                    $sqlcheck = "SELECT * FROM Pricelog WHERE ItemID='$iid' ORDER BY Timestamp DESC LIMIT 1;";

                    $row=mysqli_fetch_array(mysqli_query($con, $sqlcheck), MYSQL_ASSOC);
                    $timest = $row['Timestamp'];
                    $time = strtotime($timest);
                    $curprice = $row['PlayerPrice'];
                    $curtime = time();
                    if($pprice == 0)
                    {
                        echo '<tr><th style="font-size: 90%; color:red">'.$error_record_notfound.'</th></tr>';

                    }
                    elseif(($curtime-$time) >= 29251 AND $pprice != $curprice) {
                        $con->query($sql);
                        $con->query($sql2);
                        echo '<tr><th style="font-size: 95%; color: #009900">'.$error_record_updated.'</th></tr>';
                    
                        if(isset($_COOKIE['ml_user'])){
                            $username = $_COOKIE['ml_user'];
                            $sql3 = "UPDATE Userboard SET Submissions=Submissions+1 WHERE Username='$username'";
                            $con->query($sql3);
                        }
                        else{
                            $username = "Anonymous";
                            $sql3 = "UPDATE Userboard SET Submissions=Submissions+1 WHERE Username='$username'";
                            $con->query($sql3);
                        }
                    }
                } catch (Exception $e) {
                    $marapage = $error_record_timeout;
                    echo "<th>" . $marapage . "</br></br></th>"; 
                }
            
            } else {
                // this is the parent process, and we know the child process id is in $pid
                sleep(6); // wait 4 seconds
                posix_kill($pid, SIGKILL); // then kill the child
                $marapage = $error_record_timeout;
                echo "<th>" . $marapage . "</br></br></th>"; 
            }
            try{
            $avgsql = "SELECT AVG(PlayerPrice) from Pricelog WHERE ItemID='$iid' LIMIT 500;"; 
            $row=mysqli_fetch_array(mysqli_query($con, $avgsql), MYSQL_ASSOC);             
            $avgp = $row['AVG(PlayerPrice)'];
            }
            catch(Exception $e){
                echo 'Error loading average. Please refresh the page to try again.';
                echo $e;
            }

            echo '<tr><th>'.$widget_webpage_border.'</th></tr>';
            echo "<tr><th><h3>Deprecated average price</h3>";
            echo '<tr><th>'.$widget_webpage_border.'</th></tr>';
            echo "<tr><th><h2>Price History</h2></th></tr>";

			echo '<tr><td style="height:30px"></td></tr>';
			
			#BACK BUTTON TEXT - BACK TO RESULTS#
			echo '<tr><td style="height:20px;">'.$widget_webpage_border.'<a href="javascript:history.go(-1)">'.$text_goback.'</a></td></tr>';
			}
        if(isset($_GET["id"])) {
        echo '<tr><td style="height:20px;"></br><h3>Asset #'. $iid  .'</h3></td></tr>';
        }
        
}
else {
    
        #STARTING HTML BEGIN#
?>    
<html>
<!-- Initalize Page -->
	<head>
		<title>SHU-Explorer - Search</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="main">
			<?php echo file_get_contents('header.html') . "</br>"; 
			if($alert_text != ""){
				echo $widget_webpage_alert;
			}
			?>
				<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">
				<table align="center" width="710">
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
								echo $quicksearch_desc; 
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
								<strong>Search by Asset Tag #:</strong> <input type="text" name="asstag">
								<input type="submit" value="Search">
							</form>
        
        <?php
        echo '<tr><td style="height:26px" ></td></tr>';

		echo '<tr><th><table align="center"><tr>'; 
    
    echo '</tr></table></th></tr>';

    ##    
echo '<tr><td style="height:10px"><br>'.$widget_updates.'</td></tr>';    
}    
?>
<tr><td style="height:10px"></td></tr>
			</table>
		<img src="img/corner3.png" width="9" ><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner4.png" width="9"></div>
	</body>
</html>

<?php
mysqli_close($con);
?>