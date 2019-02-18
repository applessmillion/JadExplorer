<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
require_once 'config.php';
require_once 'vars.php';
require_once 'setuser.php';

##################CONNECTION INFO FOR DATABASE###################
$data_connect;
########################STARTING CONTENT#########################

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
		<div class="container-fluid">
			<?php 
				if($alert_text != ""){ echo $widget_webpage_alert;}
				echo $webpage_topcontentbox;
			?>
<!-- End Init -->
				<?php
				//Finds the total number of logs. Lots more efficient, and formats!
				$statalllog = file_get_contents("stats.php?total-logs&format");

				//Finds the number of logs made by users. Much more efficient doing this on stats.php!
				$statuserlog = file_get_contents("stats.php?user-logs&format");

				//Find top 20 contributors.
				$sql_top20 = mysqli_query($con, "SELECT * FROM Userboard ORDER BY Submissions DESC LIMIT 20");
				$sql_top20_num = mysqli_num_rows($sql_top20);
				?>
				<tr>
					<th>
						<a href="users.php"><img src="img/contrib.gif"></a>
					</th>
				</tr>
				<tr>
					<th>
						<h2>Statistical Stats</h2>
					</th>
				</tr>
				<?php 
				echo '<tr><th>'. $var_users .'</br></th></tr>';
				echo '<tr><th>There are currently <strong>',$statalllog,'</strong> prices logged by SHU-Explorer!</br>';
				echo 'Of those, <strong>',$statuserlog,'</strong> have been made by contributors!</th></tr>';
				?>
				<tr>
					<th>
						<hr style="border-color:#46C61F; width:45%;">
					</th>
				</tr>
				<?php
				
				$rank = 1;
				while ($obj = mysqli_fetch_object($sql_top20)) {
					echo "<tr align='left' width='350'><th >". $rank . ". <strong>" . $obj->Username . "</strong>, with  <strong>" . $obj->Submissions ."</strong> Prices<br /></th></tr>";
					$rank = $rank+1; 
				}
					//If the user is signed in, show them the username they have entered previously.
					if(isset($_COOKIE[$cookiename])){
						echo "<tr><th></br></br>Currently browsing as <strong>" , $_COOKIE['ml_user'] , "</strong>.</tr></th>";
					}
        
					//If they are not signed in, allow them to. 
					elseif(!isset($_COOKIE[$cookiename])){  ?>
					<tr>
						<th>
							<br><br>
							<form action="users.php" method="get">
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
