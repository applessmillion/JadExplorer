<?php
require_once 'vars.php';
?>
<html>
	<head>
		<title>SHU-Explorer - Search</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="main">
		<?php
		echo    file_get_contents('header.html') . "</br>";
		?>
		<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">
		<table align="center" width="710">
			<tr>
				<th>
					<h2>Welcome to SHU-Explorer</h2>
					</br>
				</th>
			</tr>
			<tr>
				<th>
					<img src="img/search.png">
				</th>
			</tr>
		<?php
		echo    '<tr><th></br><p>',$index_desc,'</br></p>';
		echo    $widget_updates . "</br>";
		echo	$widget_aboutinfo;
		?>
			</p></th></tr>
		</table>
		<img src="img/corner3.png" width="9" ><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner4.png" width="9">
		</div>
		</br></br>
	</body>
</html> 