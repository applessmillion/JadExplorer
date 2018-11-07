<?php
require_once "vars.php";
require_once "vars_common.php";
//for future use
?>
<html>
	<head>
		<title><?php $cv_webpage_title_index ?></title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?php
			include 'header.html';
		?>
		<div class="main">
		<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">
		<table align="center" width="710">
			<tr>
				<td style="background:#eee"></br>
					<h2><?php $page_index_heading; ?></h2>
					<p>
						<?php $page_index_desc; ?>
					</p>
					</br>
				</td>
			</tr>
			</p></th></tr>
		</table>
		<img src="img/corner3.png" width="9" ><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner4.png" width="9">
		</div>
	</body>
</html> 