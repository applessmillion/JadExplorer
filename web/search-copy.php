<?php
include_once 'config.php';
include_once 'vars_common.php';

//Create instance for MySQL connection using info from config.php
$con = new mysqli($ip,$user,$pw,$db);

//Check if any data is in the URL.
if(ISSET($_GET['a']) || ISSET($_GET(['n'])) || ISSET($_GET(['u']))){
	
	$getassetnumber = $_GET['a'];
	$getassetname = $_GET['n'];
	$getassetuser = $_GET['u'];	
	$getsearchtype = 0;
	
	//If this is a number search, we will search for an asset number.
	if(ISSET($_GET['a'])){
		$SQL_search = mysqli_query($con, "SELECT * FROM assets WHERE assetnumber LIKE '%$getassetnumber%' ORDER BY asset ASC LIMIT 25");
		$SQL_searchrows = mysqli_num_rows($SQL_search);
		$getsearchtype = 1;
	}
	
	//If this is a name search, we will search the device name.
	elseif(ISSET($_GET['n'])){
		$SQL_search = mysqli_query($con, "SELECT * FROM assets WHERE assetname LIKE '%$getassetname%' ORDER BY asset ASC LIMIT 25");
		$SQL_searchrows = mysqli_num_rows($SQL_search);
		$getsearchtype = 2;
	}
	
	//If this is a username search, we will search for usernames related to devices.
	elseif(ISSET($_GET['u'])){
		$SQL_search = mysqli_query($con, "SELECT * FROM assets WHERE username LIKE '%$getassetuser%' ORDER BY asset ASC LIMIT 25");
		$SQL_searchrows = mysqli_num_rows($SQL_search);
		$getsearchtype = 3;
	}
	
	//Handle what content to show for the page and page title.
		//If the search returns only one result, skip the search result page and show the asset info.
		if($SQL_searchrows == 1 && $getsearchtype == 1){
			$title_display = $cv_webpage_title_asset_page,$getassetnumber;
			$page_displaytype = 1;
		}
		
		//Display asset page if the name of the computer matches with only one machine.
		if($SQL_searchrows == 1 && $getsearchtype == 2){
			$title_display = $cv_webpage_title_asset_page,$getassetnumber;
			$page_displaytype = 1;
		}
		
		//If there are multiple results, show a list of all the matching assets
		elseif($SQL_searchrows > 1 && $getsearchtype == 1){
			$title_display = $cv_webpage_title_asset_search,$getassetnumber;
			$page_displaytype = 2;
		}
		
		//If there are multiple results, show a list of all the matching assets for a name search
		elseif($SQL_searchrows > 1 && $getsearchtype == 2){
			$title_display = $cv_webpage_title_search_general,$getassetname;
			$page_displaytype = 2;
		}
		
		//For username searches, display a list no matter what.
		elseif($getsearchtype == 3){
			$title_display = $cv_webpage_title_user_search,$getassetuser;
			$page_displaytype = 2;
		}
		
		//If anything else happens, just plan to show an error.
		else{
			$title_display = $cv_webpage_title_default;
			$page_displaytype = 3;
		}
?>
	<html>
		<!-- Initalize Page -->
		<head>
			<?php echo '<title>', $title_display ,'</title>'; ?>
			<link rel="stylesheet" type="text/css" href="style.css">
		</head>
		<body>
			<div id="main">
				<?php include('header.html') ?>
				<br><br></br>
				<?php 
				//Returns the following when there is exactly one item matching the search
				if($page_displaytype == 1){
					include('asset-display-form.php');
				}
				
				//Returns the following when there are multiple items matching the search
				if($page_displaytype == 2){
					include('search-display.php');
				}
					
				//Returns the following when there are no items matching the search
				if($page_displaytype == 3){
					include('asset-display-form.php');
				}
				?>
			</div>
		</body>
	</html>
<?php
}

//Display landing page for searching.
else{
?>
	<html>
		<!-- Initalize Page -->
		<head>
			<title><?php $cv_webpage_title ?></title>
			<link rel="stylesheet" type="text/css" href="style.css">
		</head>
		
		<body>
			<div id="main">
				<?php include('header.html') ?>
				<br><br></br>
				<?php include('asset-search-form.php'); ?>
				<?php include('room-search-form.php'); ?>
			</div>
		</body>
	</html>
<?php 
} ?>