<?php
include_once('vars_common.php');

//This will be the form to search for assets located in a certain area.
echo '<table align="center" width="', $cv_webpage_size_searchform_width ,'" style="background:', $cv_webpage_color_searchform_table_background ,'">';
echo '<tr style="background:', $cv_webpage_color_searchform_title_background ,'"><td><h2>', $sv_webpage_text_searchform_searchbyroomtitle ,'</h2></td></tr>';
?>
    <tr>
		<td style="height:20px"></td>
	</tr>
    <tr>
		<th>
			<form action="search.php" method="get">
				<strong>Building: </strong><input type="text" name="b" required>
				<br>
				<strong>Room: </strong><input type="text" name="r" required>
				<br>
				<input type="submit" value="Search for Devices">
			</form>
		</th>
	</tr>
</table>
