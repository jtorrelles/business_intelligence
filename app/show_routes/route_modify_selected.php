<?php
require '../db/database_conn.php';
include '../header.html';
echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/show_routes_controller.js\"></script>";

if(isset($_GET['selectedid'])){
	echo "<script>findData(".$_GET['selectedid'].");</script>";

	echo "<div style=\"display:none\" id=\"dataroute\">";
	echo "<form action=\"route_modify_selected_results.php\" method=\"POST\">";
	echo "<table>";
	echo "<tr><td colspan=2><h3>GENERAL DATA</h3></td></tr>";
	echo "<tr>
			<td><b>Route ID:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='text' name='id' class=\"id\">This field cannot be modified</td>
		</tr>";	
	echo "<tr>
			<td><b>Show Name:</b></td>
			<td><input type='text' style=\"background-color: lightgrey;\" readonly class=\"show_name\" name='show_name'></td>
		</tr>";	
	echo "<tr>
			<td><b>Number of Trucks:</b></td>
			<td><input type='number' class=\"numberoftruck\" name='numberoftruck'></td>
		</tr>";	
	echo "<tr>
			<td><b>Weekly NUT:</b></td>
			<td><input type='number' class=\"weeklynut\" name='weeklynut' step=0.01></td>
		</tr>";
	echo "</table>";
	echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
	echo "</form>";
	echo "</div>";		
}
else {
  echo "failed";
}

$conn->close();
include '../footer.html';
?>