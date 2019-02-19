<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
require_once 'config.php';
require_once 'vars.php';
require_once 'setuser.php';

##################CONNECTION INFO FOR DATABASE###################
$data_connect;
########################STARTING CONTENT#########################
$sql 	= mysqli_query($con, "SELECT * FROM asset_information ORDER BY Entity_ID DESC LIMIT 1");
$obj 	= mysqli_fetch_object($sql);

$sql2 	= mysqli_query($con, "SELECT * FROM asset_information ORDER BY tagno DESC LIMIT 1");
$obj2 	= mysqli_fetch_object($sql2);

$sql3 	= mysqli_query($con, "SELECT * FROM asset_information ORDER BY createdate DESC LIMIT 1");
$obj3 	= mysqli_fetch_object($sql3);

?>    
<html>
<!-- Initalize Page -->
	<head>
		<title>SHU-Explorer - Stats</title>
		<?php echo $tech_css_js_styleimports; ?>
	</head>
	<body style="background:url(img/bg.png) no-repeat;background-size:cover;line-height:1;background-attachment:fixed;text-align:center;height:100%">
		<div>
			<?php echo file_get_contents("gtag.html");
			echo file_get_contents("header.html") . "</br>"; ?>
		</div>
		<div class="container-fluid" style="max-width:1200px">
			<?php 
				if($alert_text != ""){ echo $widget_webpage_alert;}
				echo $webpage_topcontentbox;
			?>
		</div>
		<div class="container-fluid" style="max-width:1000px">
<!-- End Init -->
				<?php
				$statalllog = $obj->Entity_ID;
				$highesttag = $obj2->tagno;
				$recentaddN = $obj3->name;
				$recentaddA = $obj3->tagno;

				?>
				<tr class="text-center">
					<th>
						<a href="stat.php"><img src="img/statistics.png" width="18%" style="min-width:156px;max-width:256px;"></a>
						<h1>Statistical Stats</h1>
						<?php echo $widget_webpage_border; ?>
					</th>
				</tr>
				<?php 
				echo '
				<tr>
					<td>
						<p>
							There are currently <strong>',$statalllog,'</strong> devices logged by SHU-Explorer!</br>
							The highest asset tag is <strong>',$highesttag,'</strong> </br>
							The most recent device to be added to SHU-Explorer was <strong>',$recentaddN,'</strong> (Tag No. '.$recentaddA.')</br>
						</p>
					</th>
				</tr>';
				?>
				<?php
				
				$rank = 1;
				while ($obj = mysqli_fetch_object($sql_top20)) {
					echo "<tr align='left' width='350'><th >". $rank . ". <strong>" . $obj->Username . "</strong>, with  <strong>" . $obj->Submissions ."</strong> Prices<br /></th></tr>";
					$rank = $rank+1; 
				}
					//If the user is signed in, show them the username they have entered previously.
					if(isset($_COOKIE[$cookiename])){
						echo "<tr>
								<td>
									<p>Currently browsing as <strong>" , $_COOKIE['ml_user'] , "</strong>.</p>
								</td>
							</tr>";
					}
        
					//If they are not signed in, allow them to. 
					elseif(!isset($_COOKIE[$cookiename])){  ?>
					<tr>
						<th>
							<br><br>
							<form action="stat.php" method="get">
								Set Username: <input type="text" name="username" maxlength="20">
								<input type="submit" value="Submit">
							</form>
						</th>
					</tr>
		<?php } 
		echo $webpage_bottomcontentbox; ?>
		</div>
	</body>
</html>
