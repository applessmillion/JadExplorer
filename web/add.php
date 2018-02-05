<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
include_once 'config.php';

$con = new mysqli($ip,$user,$pw,$db);

#STARTING HTML BEGIN#
?>    
			<html>
			<!-- Initalize Page -->
				<head>
					<title>SHU DoIT | Add Asset</title>
					<link rel="stylesheet" type="text/css" href="style.css">
				</head>
				<body>
					<div id="main">
					<?php echo file_get_contents('header.html') . "</br>"; ?>
					<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">
					<table align="center" width="710">
			<!-- End Init -->


        <tr><th><a href="item.php"><img src="img/search-item.png"></img></a></th></tr>
        <tr><th><img src="img/titles/item-search.png"></img></th></tr>
        <tr><td style="height:8px" ></td></tr>
        <tr><th>
        <p> <?php include_once 'vars.php'; 
			echo $item_desc; ?> 
		</p>
        </th></tr>
        <tr><td style="height:10px" ></td></tr>
        <tr><th>
        <form action="item.php" method="get">
        <strong>Search a Name:</strong> <input type="text" name="search">
        <input type="submit" value="Search">
        </form>
        
        <?php
        if(isset($_COOKIE['ml_user'])){
            $username = $_COOKIE['ml_user'];
            echo '<tr><th>You are searching as <strong>'. $username .'</strong>.</th></tr>';
        }
        echo '<tr><td style="height:26px" ></td></tr>';
        $pido = pcntl_fork();
    if ($pido == 0) {
        #echo "<tr><th><strong>NEW! <a class='reg' href='item.php?random'> Rando-matic Search!</a></strong><br><br></th></tr>";
        echo '<tr><th><h2>Recently Updated Items...</h2></th></tr>';
        
        $search_query = mysqli_query($con, "SELECT Names.ItemID, Names.ItemName iName, Pricelog.LogID FROM Names INNER JOIN Pricelog ON Names.ItemID = Pricelog.ItemID ORDER BY Pricelog.LogID DESC LIMIT 3");
        $search_nums = mysqli_num_rows($search_query);
        
        ?> 
        
        <tr><th><table align="center"><tr> 
        
        <?php
        while ($obj = mysqli_fetch_object($search_query)) {
            $iid = $obj->ItemID;
            echo "<td><a class='reg' href='item.php?info=" . urlencode($obj->iName) . "'>" . file_get_html("http://maralook.com/simplelisting.php?id=$iid") . "</a></td>";
        }

    } else {
    // this is the parent process, and we know the child process id is in $pid
    sleep(3); // wait 3 seconds
	echo '<tr><th><table align="center"><tr>'; 
    posix_kill($pido, SIGKILL); // then kill the child
    }
    
    echo '</tr></table></th></tr>';

    ##    
echo '<tr><td style="height:10px"><br>'.$var_item_updatetxt.'</td></tr>';    
}    
?>
<tr><td style="height:10px"></td></tr>
</table>
<img src="img/corner3.png" width="9" ><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner4.png" width="9"></div>
</body></html>

<?php
mysqli_close($con);
?>