<?php
require_once 'config.php';

### This is how we'll track a visit to a page. This assumes that we code this in correctly.
if(isset($_GET["visit"])){
	### Let's be safe here. Only start a connection for a valid GET property.
		$con = new mysqli($ip,$p_user,$p_pw,$db);
	
	### Convert GET to php var.
		$visitid = $_GET["visit"];
		$visitip = $_SERVER['REMOTE_ADDR'];
	
	### SQL statement.
		if(mysqli_query($con, "INSERT INTO page_visits (page_id, visitor_ip) VALUES ('$visitid', '$visitip')")){ echo 1; }
		else{ echo 0; }
		
	### Short, sweet, and to the point. ###
}
else{
	echo "Nothing to track.</br>";
	echo "Tracking page visits to: ".$_SERVER['REMOTE_ADDR'];
}
?>