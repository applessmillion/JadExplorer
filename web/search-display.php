<?php
//File is used to search for assets by name from search.php 

//config.php file needed for MySQL connection
include_once 'config.php';

//Create instance for MySQL connection
$con = new mysqli($ip,$user,$pw,$db);
?>

<html>
<table align="center" width="780" style="background:#efefef">
	<tr style="background:#ddd"><th colspan="3"><h2>Search For Assets</h2></th></tr>
    <tr>
		<td style="height:20px"></td>
	</tr
	<?php
	//If asset name is set, do this
	if(ISSET($_GET['n'])){
		$name = $_GET["n"];
		#GET NAME FROM SEARCH TERMS#
		$search_query = mysqli_query($con, "SELECT * FROM assets WHERE aname LIKE '%$name%' ORDER BY asset ASC LIMIT 25");
		$search_nums = mysqli_num_rows($search_query);	

		echo '<tr><th colspan="3"><h2>Found '. $search_nums .' results for "'. $name . '"...</h2></th></tr>';
		echo "<tr><td><b>Asset Name</b></td><td><b>Asset Tag</b></td><td><b>Asset Owner</b></td></th></tr>";
		echo '<tr><th colspan="3"><hr style="border-color:#6D7ACE; width:85%;"></th></tr>';
	
		//List search variables in table rows.
		while ($obj = mysqli_fetch_object($search_query)) {
		
			echo "<tr><td><a class='reg' href='search.php?a=" . urlencode($obj->asset) . "'><b>" . $obj->aname ."</b></a></td>";
			echo "<td>". $obj->asset ."</td>";
			echo "<td>". $obj->owner ."</td></th></tr>";
		
		}   
		echo '<tr><td style="height:20px;"></br><a href="javascript:history.go(-1)">Back to Search...</a></td></tr>';
	}
	//If username is set, do this
	elseif(ISSET($_GET['u'])){
		$name = $_GET["u"];
		#GET NAME FROM SEARCH TERMS#
		$search_query = mysqli_query($con, "SELECT * FROM assets WHERE owner LIKE '%$name%' ORDER BY asset ASC LIMIT 25");
		$search_nums = mysqli_num_rows($search_query);	

		echo '<tr><th colspan="3"><h2>Found '. $search_nums .' results for '. $name . '</h2></th></tr>';
		echo "<tr><td><b>Asset Name</b></td><td><b>Asset Tag</b></td><td><b>Asset Owner</b></td></th></tr>";
		echo '<tr><th colspan="3"><hr style="border-color:#6D7ACE; width:85%;"></th></tr>';
	
		//List search variables in table rows.
		while ($obj = mysqli_fetch_object($search_query)) {
		
			echo "<tr><td><a class='reg' href='search.php?a=" . urlencode($obj->asset) . "'><b>" . $obj->aname ."</b></a></td>";
			echo "<td>". $obj->asset ."</td>";
			echo "<td>". $obj->owner ."</td></th></tr>";
		
		}   
		echo '<tr><td style="height:20px;"></br><a href="javascript:history.go(-1)">Back to Search...</a></td></tr>';
	}
	else{
		echo "Error. Username and Asset Name not defined. Go back and try again?";
	}
	?>
</table>
</html>
