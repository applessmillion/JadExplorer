<?php //Making this entire form should allow for the variables to be inserted in without issue.

/*
Current progress: displays the stuff in the textfields so it looks like it works.
Doesn't actually go through with any changes, and the updating page has not been implemented
at all yet. Will need to copy add.php, maybe make an update.php file in this directory.
It at least displays, so woo!
*/


//Has the mySQL connection info
include_once('../config.php');

//Connects to mySQL database
$con = new mysqli($ip,$user,$pw,$db);

$asset = $_GET["edit"];

//SQL statement to pull data from the ASSET table
$assetsql = "SELECT * from assets WHERE asset='$asset';";

$row=mysqli_fetch_array(mysqli_query($con, $assetsql), MYSQL_ASSOC);

$name = $row['aname'];
$stag = $row['service'];
$serial = $row['serial'];
$type = $row['type'];
$model = $row['model'];
$owner = $row['owner'];
$manufacturer = $row['manu'];

//SQL statement to pull data from the LOCATION table
$locsql = "SELECT * from asset_locations WHERE asset='$asset';";

$row=mysqli_fetch_array(mysqli_query($con, $locsql), MYSQL_ASSOC);

$camp = $row['campus'];
$build = $row['building'];
$room = $row['room'];

	echo '<table align="center" width="780" style="background:#efefef">';
	echo '<th style="background:#ddd" colspan="2"><h2>Editing '.$asset.'</h2></th>';
    echo '<tr>
		<td style="height:20px"></td>
	</tr>
    <tr>
		<th>
			<form action="?update" method="post">
			<table width="500" align="center" style="background:#f5f5f5">
				<tr>
					<th colspan="2">
						<h3>General Info</h3>
					</th>
				</tr>
				<tr style="text-align:left">
					<td>
						<strong>Device Name: </strong>
					</td>
					<td>';
						echo '<input type="text" name="aname" pattern=".{4,15}" value="'.$name.'"><br>';
					echo '</td>
				</tr>
				<tr style="text-align:left">
					<td>
						<strong>Asset Tag: </strong>
					</td>
					<td>';
						echo '<input type="text" name="assettag" pattern=".{5,5}" value="'.$asset.'"><br>';
					echo '</td>
				</tr style="text-align:left">
				<tr style="text-align:left">
					<td>
						<strong>Service Tag: </strong>
					</td>
					<td>';
						echo '<input type="text" name="servicetag" value="'.$stag.'"><br>';
					echo '</td>
				</tr>
				<tr style="text-align:left">
					<td>
						<strong>Serial Number: </strong>
					</td>
					<td>';
						echo '<input type="text" name="serial" value="'.$serial.'"><br>';
					echo '</td>
				</tr>
				<tr style="text-align:left">
					<td>
						<strong>Used By: </strong>
					</td>
					<td>
						<input type="text" name="user" pattern=".{3,}" value="'.$owner.'"><br>
					</td>
				</tr>
				<tr style="text-align:left">
					<td>						
						<strong>Device Type: </strong>
					</td>
					<td>
						<input type="text" name="type" pattern=".{3,}" value="'.$type.'"><br>
					</td>
				</tr>
				<tr style="text-align:left">
					<td>						
						<strong>Device Manufacturer: </strong>
					</td>
					<td>
						<input type="text" name="manu" pattern=".{3,}" value="'.$manufacturer.'"><br>
					</td>
				</tr>
				<tr style="text-align:left">
					<td>
						<strong>Device Model: </strong>
					</td>
					<td>
						<input type="text" name="model" pattern=".{3,}" value="'.$model.'"><br>
					</td>
				</tr>
				<tr>
					<th colspan="2">
						</br>
						<h3>Location Info</h3>
					</th>
				</tr>
				<tr style="text-align:left">
					<td>
						<strong>Campus: </strong>
					</td>
					<td>
						<input type="text" name="campus" value="'.$camp.'"><br>
					</td>
				</tr>
				<tr style="text-align:left">
					<td>
						<strong>Building: </strong>
					</td>
					<td>
						<input type="text" name="build" value="'.$build.'"><br>
					</td>
				</tr>
				<tr style="text-align:left">
					<td>
						<strong>Room/Office Number: </strong>
					</td>
					<td>
						<input type="text" name="room" value="'.$room.'"><br>
					</td></br>
				</tr>
				</table></br>
				<input type="submit" value="Edit Device">
				<tr ><td style="height:20px;" align="center" class="bolded"><a class="bolded-dred" href="../search.php?a='.$asset.'">Go Back Without Saving</a></td></tr>
			</form>
		</th>
	</tr>
</table>';
?>