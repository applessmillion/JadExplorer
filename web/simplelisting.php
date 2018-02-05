<?php

	include_once 'config.php';
	##################CONNECTION INFO FOR DATABASE###################
    
	$con = new mysqli($ip,$user,$pw,$db);
	$info = $_GET["id"];
    $query = mysqli_query($con, "SELECT * FROM Names WHERE ItemID='$info'");
    $obj = mysqli_fetch_object($query);
    $iin = $obj->ItemName;
	
	#Finally, display it all in HTML
	echo '<table align="center" width="100">';
	echo '<tr><td width="84"><img src="http://www.maralook.com/img/buffer.png"></td></tr>';
	echo '<tr><td><b style="font-size:8pt;color:darkblue">'.$iin.'</b></br>';
	echo '</td>';
	echo '</tr></table>';
?>