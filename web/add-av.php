<?php //So this page could be pure HTML, but if I'm going to do 90% of this site as php, I ain't gunna have an odd .htm file. ?>
<html>
	<!-- Initalize Page -->
	<head>
		<title>SHU DoIT | Add Asset</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="main">
		<?php echo file_get_contents('header.html') ?>
	<!-- End Init -->
		<table align="center" width="800" style="background:#eee">
        <tr><td style="height:10px" ></td></tr>
        <tr>
			<th>
				<form action="add.php?" method="post">
					<strong>Asset Tag: </strong><input type="text" name="assettag"><br>
					<strong>Service Tag: </strong><input type="text" name="servicetag"><br>
					<strong>Asset Type: </strong><select name="type">
						<option value="desktop" selected>Desktop Computer</option>
						<option value="laptop">Laptop</option>
						<option value="imac">iMac</option>
						<option value="macbook">Macbook</option>
						<option value="projector">Projector</option>
						<option value="monitor">Monitor</option>
						<option value="accesspoint">Wireless Access Point</option>
						<option value="tablet">Tablet</option>
						<option value="other">Other</option>
					</select><br>
					<strong>Model/Type: </strong><input type="text" name="model"><br>
					<strong>Campus: </strong><select name="campus">
						<option value="adrian" selected>Adrian</option>
						<option value="southfield">Southfield</option>
						<option value="deerborn">Deerborn</option>
					</select><br>
					<strong>Location: </strong><input type="text" name="location"><br>
					<strong>Used By: </strong><input type="text" name="user"><br>
					<br><br>
					<input type="submit" value="Add to Database">
				</form>
		<tr>
			<td style="height:10px"></td>
		</tr>
		</table>
		</div>
	</body>
</html>