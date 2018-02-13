<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
include_once 'config.php';

$con = new mysqli($ip,$user,$pw,$db);
$names = $_GET["n"];
?>

<!-- This will be the form to search for an asset tag number. Maybe even the username later? -->
<html>
<table align="center" width="780" style="background:#efefef">
	<tr style="background:#ddd"><th colspan="3"><h2>Search For Assets</h2></th></tr>
    <tr>
		<td style="height:20px"></td>
	</tr
	<?php

    $name = $_GET["n"];
    #GET NAME FROM SEARCH TERMS#
    $search_query = mysqli_query($con, "SELECT * FROM assets WHERE aname LIKE '%$name%' ORDER BY asset ASC LIMIT 25");
    $search_nums = mysqli_num_rows($search_query);	

	echo '<tr><th colspan="3"><h2>Found '. $search_nums .' results for "'. $names . '"...</h2></th></tr>';
    echo "<tr><td><b>Asset Name</b></td><td><b>Asset Tag</b></td><td><b>Asset Owner</b></td></th></tr>";
    echo '<tr><th colspan="3"><hr style="border-color:#6D7ACE; width:85%;"></th></tr>';
	
	//List search variables in table rows.
    while ($obj = mysqli_fetch_object($search_query)) {
		
        echo "<tr><td><a class='reg' href='search.php?a=" . urlencode($obj->asset) . "'><b>" . $obj->aname ."</b></a></td>";
		echo "<td>". $obj->asset ."</td>";
		echo "<td>". $obj->owner ."</td></th></tr>";
		
    }   
    echo '<tr><td style="height:20px;"></br><a href="javascript:history.go(-1)">Back to Search...</a></td></tr>';

	?>
</table>
</html>
