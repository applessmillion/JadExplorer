<?php
require_once '../config.php';
### If the username and password fields are set, we want to handle the request.
if(isset($_POST['u']) && isset($_POST['p'])){
	### Pull info on the USERNAME submitted.
	$con = new mysqli($ip,$user,$pw,$db);
	$usern 	= strtolower($_POST['u']);
	$sql 	= mysqli_query($con, "SELECT * FROM web_users WHERE username='$usern'");
	$obj 	= mysqli_fetch_object($sql);
	
	if(strtolower($obj->username) == $_POST['u'] && $obj->password == $_POST['p']){
		if(isset($_POST['extend'])){ $sesstimeout = (time()+1000000); }
		else{ $sesstimeout = 0; }
		
		$gensession = random_int(1600,2000)+time();
		
		###Need to program the check with the database.
		setcookie('shux_user', $_POST['u'], $sesstimeout, "/");
		setcookie("shux_sID", $gensession, $sesstimeout, "/");
?>
<html>
	<head> 
		<meta http-equiv="refresh" content="0; URL=../" />
	</head>
	<body>
		Processing login...
	</body>
</html>
<?php }else{ ?>
<html>
	<head> 
		<meta http-equiv="refresh" content="0; URL=login.php?bad" />
	</head>
	<body>
		BAD LOGIN...
	</body>
</html>
<?php }
}else{ ?>
<html>
	<head> 
		<meta http-equiv="refresh" content="0; URL=login.php?bad" />
	</head>
	<body>
		No information...
	</body>
</html>
<?php } ?>