<?php //Here we goo!
//Has the $con deets
include_once('config.php');

//Connects to mySQL database
$con = new mysqli($ip,$user,$pw,$db);

//Pull and convert the GET variable into a php var.
$asset = $_GET["a"];	

//SQL statement to pull data from the ASSET table
$assetsql = "SELECT * from shutest.assets WHERE asset='$asset';";

//SQL statement to pull data from the LOCATION table
$locsql = "SELECT * from shutest.locations WHERE asset='$asset';";

//Connects to the ASSET table and makes data accessible under the row variable
$row=mysqli_fetch_array(mysqli_query($con, $assetsql), MYSQL_ASSOC);

//Connects to the LOCATION table and makes data accessible under the row2 variable
$row2=mysqli_fetch_array(mysqli_query($con, $locsql), MYSQL_ASSOC);


$dt1 = new DateTime($row['edited']);
$dt2 = new DateTime($row['created']);

//This will catch for searching for a nonexistant asset tag. Will handle accordingly
if($row['asset'] == NULL){
?>
<table align="center" width="780" style="background:#D8D4D4">
	<tr style="background:#D84B4B"><td><h1>Error</h1></td></tr>
    <tr>
		<td style="height:20px"></td>
	</tr>
	<?php
	//Display error message
	echo "<tr><th><br>
		  <h3>Error pulling data for the asset number ", $asset ,". Please use other search terms!</h3>
		  <br><br>
		  </th></tr>
		 ";
		 
	//Allows user to go back to search page (or last visited page)
	echo '<tr><td style="height:20px;"><a href="javascript:history.go(-1)">Back to Search</a></td></tr>';
	
}

//If the data returns a 1, the category is meant for CPUs.
elseif($row['category'] == '1'){
?>
<table align="center" width="780" style="background:#efefef">
	<tr style="background:#46B6F2">
		<td>
			<h1><?php echo $row['aname']; ?></h1>
			<?php echo '<b>', $row['manu'], " " , $row['model'] ,'.</b>'; ?>
		</td>
	</tr>
    <tr>
		<td style="height:5px"></td>
	</tr>
	<tr>
		<td>
		
		<?php
		//Let's check to see if this is still in use.
		if($row['active'] == '1'){
			//It's in use! Let's say so with some green text
			echo '<h4 style="color:267F00">CURRENTLY IN USE</h4>';
			echo '<b>Entry created ', $dt2->format('M j Y H:i') ,'.</b></br>';
			echo '<a class="bolded-orange" href="http://spiceworks.sienaheights.edu/search?query=', $row['aname'] ,'">Search for on Spiceworks</a></br>';
		}
		else{
			//Not in use! Let's say so with some dark red text.
			echo '<h3 style="color:7F0000">NO LONGER IN USE</h3></br>';
		}
		?>
		</td>
	</tr>
	<tr>
		<td>
			<table align="center" width="450" style="background:#fafafa">
				<?php
				//Let's do the main table here
				
				//Heading for General Info
				echo "<th colspan='2'><u><h2>General Info</h2></u></th>";
				
				//Asset owner and Asset number
				echo "<tr style='text-align:left'><td><b>Device Owner: </b>", $row['owner'] ,"</td><td><b>Asset Number: </b>", $row['asset'] ,"</td></tr>";
				
				//Service Tag and Serial Number
				echo "<tr style='text-align:left'><td><b>Service Tag: </b>", $row['service'] ,"</td><td><b>Serial Number: </b>", $row['serial'] ,"</td></tr>";
				
				//Break bebtween general and location information
				echo "<tr><th colspan='2'></br><hr></br></th></tr>";
				
				//Heading for Location Info
				echo "<th colspan='2'><u><h2>Location Info</h2></u></th>";
				
				//Asset campus location
				echo "<tr style='text-align:left'><td><b>Campus Location:</b> ", $row2['campus'] ,"</td></tr>";
				
				//Asset location
				echo "<tr style='text-align:left'><td><b>Location: </b>", $row2['building'] ," Rm. ", $row2['room'] ,"</td></tr>";
				
			echo '</table></br>';
			echo '<b>Last edit to this entry was on ', $dt1->format('M j Y H:i') ,'.</b></br>';
			echo '<br></br>';
			
			//This needs to be in the main PHP so it can pull the row data.
			echo '<p><a class="bolded-green" href="edit/?edit=', $row['asset'] , '">Edit Entry</p>';
			?>
		</td>
	</tr>
	
	
<?php 
}
//If the data returns a 2, the category is meant for AV assets.
elseif($row['category'] == '2'){
?>
<table align="center" width="780" style="background:#efefef">
	<tr style="background:#FFC023">
		<td>
			<h1><?php echo "Asset #" . $row['asset']; ?></h1>
			<?php echo '<b>', $row['manu'], " " , $row['model'] ,'.</b>'; ?>
		</td>
	</tr>
    <tr>
		<td style="height:5px"></td>
	</tr>
	<tr>
		<td>
		
		<?php
		//Let's check to see if this is still in use.
		if($row['active'] == '1'){
			//It's in use! Let's say so with some green text
			echo '<h4 style="color:267F00">CURRENTLY IN USE</h4>';
			echo '<b>Entry created ', $dt2->format('M j Y H:i') ,'.</b></br>';
		}
		else{
			//Not in use! Let's say so with some dark red text.
			echo '<h3 style="color:7F0000">NO LONGER IN USE</h3></br>';
		}
		?>
		</td>
	</tr>
	<tr>
		<td>
			<table align="center" width="450" style="background:#fafafa">
				<?php
				//Let's do the main table here
				
				//Heading for General Info
				echo "<th colspan='2'><u><h2>General Info</h2></u></th>";
				
				//Asset owner and Asset number
				echo "<tr style='text-align:left'><td><b>Device Owner: </b>", $row['owner'] ,"</td><td><b>Asset Name: </b>", $row['aname'] ,"</td></tr>";
				
				//Service Tag and Serial Number
				echo "<tr style='text-align:left'><td><b>Service Tag: </b>", $row['service'] ,"</td><td><b>Serial Number: </b>", $row['serial'] ,"</td></tr>";
				
				//Break bebtween general and location information
				echo "<tr><th colspan='2'></br><hr></br></th></tr>";
				
				//Heading for Location Info
				echo "<th colspan='2'><u><h2>Location Info</h2></u></th>";
				
				//Asset campus location
				echo "<tr style='text-align:left'><td><b>Campus Location:</b> ", $row2['campus'] ,"</td></tr>";
				
				//Asset location
				echo "<tr style='text-align:left'><td><b>Location: </b>", $row2['building'] ," Rm. ", $row2['room'] ,"</td></tr>";
				
			echo '</table></br>';
			echo '<b>Last edit to this entry was on ', $dt1->format('M j Y H:i') ,'.</b></br>';
			echo '<br></br>';
			
			//This needs to be in the main PHP so it can pull the row data.
			echo '<p><a class="bolded-green" href="edit/?edit=', $row['asset'] , '">Edit Entry</p>';
			?>
		</td>
	</tr>
	
	
<?php 
}
?>
</table>
