<?php 
include "vars.php"; 

<html>
	</br>
	<div class="head">
		<img src="img/corner.png" width="9"><img src="img/border.png" width="922" height="9" border="0"><img src="img/corner2.png" width="9"><br>
		
		<table width="940" align="center" height="38">
			<tr>
				<th><a href="/"><img src="img/logo.png" align="left"></a></th>
				<th align="left" class="bolded"><a class="head" href="https://spiceworks.sienaheights.edu/" target="_blank">Spiceworks</a></th>
				<th align="left" class="bolded"><a class="head" href="item.php">Search</a></th>
				<th align="left" class="bolded"><a class="head" href="price.php">Option 2</a></th>
				<th align="left" class="bolded-green"><a class="bolded-green" href="users.php">Option 3</a></th>
				<th align="left" class="bolded"><a class="bolded-dred" href="about.php">About</a></th>
			</tr>
		</table>
		<img src="img/corner3.png" width="9" ><img src="img/border.png" width="922" height="9" border="0"><img src="img/corner4.png" width="9">

	</div>
	</br>
	
	if($alert_text != ""){
			<table width="940" align="center" height="50"><tr><th align="left" class="bolded">$alert_text</th></tr></table>
		}
</html>

?>