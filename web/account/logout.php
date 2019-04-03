<?php
require_once '../config.php';

### If user is set, set cookies to expire nearly immediately.
if(isset($_COOKIE['shux_user'])){	
	setcookie("shux_user", "", time()-123, "/");
	setcookie("shux_sID", "", time()-123, "/");
}
else{}
?>
<html>
	<head> 
		<meta http-equiv="refresh" content="0; URL=../" />
	</head>
	<body>
		Processing logout...
	</body>
</html>