<?php //Here we goo!
//Has the $con deets
include_once('config.php');

//Connects to mySQL database
$con = new mysqli($ip,$user,$pw,$db);

//Pull and convert the GET variable into a php var.
$asset = $_GET["a"];	

//SQL statement in the form of a PHP var (makes the below neater)
$assetsql = "SELECT * from shutest.assets WHERE asset='$asset';";

//This will be used to pull data from the SINGLE row that is fetched from the $assetsql statement
//Also connects to the database and is accessable under $row  
$row=mysqli_fetch_array(mysqli_query($con, $assetsql), MYSQL_ASSOC);

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
else{
?>
<table align="center" width="780" style="background:#efefef">
	<tr style="background:#ddd"><td><h1><?php echo $row['aname']; ?></h1></td></tr>
    <tr>
		<td style="height:5px"></td>
	</tr>
	<tr>
		<td>
		
		<?php
		//Let's check to see if this is still in use.
		if($row['inuse'] == '1'){
			//It's in use! Let's say so with some green text
			echo '<h3 style="color:267F00">CURRENTLY IN USE</h3>';
		}
		else{
			//Not in use! Let's say so with some dark red text. Also, let's show the last edit date.
			echo '<h3 style="color:7F0000">NO LONGER IN USE</h3></br>';
			echo '<strong>Last edit to this machine was on ', $row['edited'] ,'.</strong>';
		}
		?>
		</td>
	</tr>
	<tr><td>
		<table align="center" width="450" style="background:#fafafa">
			<?php
			//Let's do the main table here
			//Device Name
			echo "<tr style='text-align:left'><td>Device Name: </td><td>", $row['aname'] ,"</td></tr>";
			//Asset Tag
			echo "<tr style='text-align:left'><td>Asset Number: </td><td>", $row['assettag'] ,"</td></tr>";
			//Service Tag
			echo "<tr style='text-align:left'><td>Service Tag: </td><td>", $row['servicetag'] ,"</td></tr>";
			//Asset type
			echo "<tr style='text-align:left'><td>Device Type: </td><td>", $row['type'] ,"</td></tr>";
		
			?>
		</table>
	</td></tr>
	
	
<?php 
}
?>
</table>
