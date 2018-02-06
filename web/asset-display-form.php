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
		<td style="height:20px"></td>
	</tr>
	<?php    
	
	
	echo "<tr><th><h3>Name ", $row['aname'] ,"</h3>";
	echo "<tr><th><h3>Asset# ", $row['asset'] ,"</h3>";
		
	?>
	
	
<?php 
}
?>
</table>
