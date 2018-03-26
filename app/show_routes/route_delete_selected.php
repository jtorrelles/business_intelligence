<?php
require '../db/database_conn.php';
include '../header.html';
echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/show_routes_controller.js\"></script>";

echo "<h1 align=center style=\"color: red;\">WARNING: YOU ARE ABOUT TO DELETE THIS ROUTE</h1>";

if(isset($_GET['selectedid'])){
	echo "<script>findData(".$_GET['selectedid'].");</script>";

	echo "<div style=\"display:none\" id=\"dataroute\">";
	echo "<form action=\"route_delete_selected_results.php\" method=\"POST\">";
	echo "<table>";
	echo "<tr><td colspan=2><h3>GENERAL DATA</h3></td></tr>";
	echo "<tr>
			<td><b>Route ID:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='text' name='id' class=\"id\"></td>
		</tr>";	
	echo "<tr>
			<td><b>Show Name:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='text' class=\"show_name\" name='show_name'></td>
		</tr>";	
	echo "<tr>
			<td><b>Number Of trucks:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='text' class=\"numberoftruck\" name='numberoftruck'></td>
		</tr>";	
	echo "<tr>
			<td><b>Date of Created Route:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='text' class=\"created_date\" name='created_date'></td>
		</tr>";	
	echo "<tr>
			<td><b>Weekly NUT:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='text' class=\"weeklynut\" name='weeklynut'></td>
		</tr>";	
	echo "</table>";
	echo "<p style=\"text-align:center\"><input type=\"submit\" name=\"modify\" value=\"DELETE\"></p>";
	echo "</form>";
	echo "</div>";		
}
else {
  echo "failed";
}

$conn->close();
include '../footer.html';
?>