<?php
include '../header.html';
include '../session.php';
include 'access_control.php';
echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/show_routes_controller.js\"></script></td>";
echo "<script> onloadManagement(); </script>";
echo "<h1>Add a New Route:</h1>";
echo "<form action=\"route_add_results.php\" method=\"POST\">";
echo "<table>
		<tr>
			<td><b>Show:</b></td>
			<td>
				<select name=\"show_name\" class=\"shows\" id=\"showId\" required>
					<option value=\"\">Select Show</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan=2><h3>GENERAL DATA</h3></td>
		</tr>
		<tr>
			<td><b>Number of Trucks:</b></td>
			<td><input type='number' class=\"numberoftrucks\" value=0 name='numberoftrucks'></td>
		</tr>		
		<tr>
			<td><b>Weekly NUT:</b></td>
			<td><input type='number' class=\"weeklynut\" value=0.0 name='weeklynut' step=0.01></td>
		</tr>
		<tr>
			<td colspan=2><h3>DETAIL ROUTE</h3></td>
		</tr>
		<tr>
			<td><b>Beginning Date:</b></td>
			<td><input type=\"date\" class=\"beging_route\" name='beging_route'></td>
		</tr>
	</table>";
echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
echo "</form>";
echo "<br>";
echo "<br>";
include '../footer.html';
?>