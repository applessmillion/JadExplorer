<?php
include_once('vars_common.php');

//This will be the form to search for individual assets based on user, name, or tag number.
echo '<table align="center" width="', $cv_webpage_size_searchform_width ,'" style="background:', $cv_webpage_color_searchform_table_background ,'">';
echo '<tr style="background:', $cv_webpage_color_searchform_title_background ,'"><td><h2>', $sv_webpage_text_searchform_searchassetstitle ,'</h2></td></tr>';
?>
    <tr>
		<td style="height:20px"></td>
	</tr>
    <tr>
		<th>
			<form action="search.php" method="get">
				<strong>Search by Asset Tag: </strong><input type="text" name="a" required>
				<br><br>
				<input type="submit" value="Search by Tag">
			</form>
			<br><br>
			<form action="search.php" method="get">
				<strong>Search by Name: </strong><input type="text" name="n" required>
				<br><br>
				<input type="submit" value="Search by Name">
			</form>
			<br><br>
			<form action="search.php" method="get">
				<strong>Search by Username: </strong><input type="text" name="u" required>
				<br><br>
				<input type="submit" value="Search by Username">
			</form>
		</th>
	</tr>
</table>
