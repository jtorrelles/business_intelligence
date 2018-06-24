<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header_nologout.html';
echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/show_routes_controller.js\"></script>";

if(isset($_GET['routedetid']) && isset($_GET['routeid'])){

	echo "<script>getRouteDataChange(".$_GET['routedetid'].",".$_GET['routeid'].");</script>";
	echo "<script>findDetailData(".$_GET['routedetid'].");</script>";

	echo "<div style=\"display:none\" id=\"dataroutechange\">";
	echo "<form action=\"route_detail_change_data_results.php\" method=\"POST\">";
	echo "<table>";
	echo "<tr><td colspan=2><h3>GENERAL DATA</h3></td></tr>";
	echo "<tr>
        <td><b>Presentation Date:</b></td>
        <td><input style=\"background-color: lightgrey;\" readonly type='text' class=\"presentation_date\" name='presentation_date'>
        	<input type='hidden' class=\"detid\" name='detid'></td>
      </tr>"; 
    echo "<tr>
        <td><b>Holiday:</b></td>
        <td><input type='checkbox' class=\"holiday\" name='holiday' disabled></td>
      </tr>";
    echo "<tr>
        <td><b>Milleage:</b></td>
        <td><input type='number' name='mileage' class=\"mileage\" value=0.0 step=0.01></td>
      </tr>";
    echo "<tr>
        <td><b>Team Drive Cost Estimate:</b></td>
        <td><input style=\"background-color: lightgrey;\" readonly type='number' name='team_drive' class='team_drive' step=0.01></td>
      </tr>";
    echo "<tr>
        <td><b>Country:</b></td>
        <td><input type='text' class=\"countryname\" name='countryname' readonly></td>
      </tr>";
    echo "<tr>
        <td><b>State:</b></td>
        <td><input type='text' class=\"statename\" name='statename' readonly></td>
      </tr>";
    echo "<tr>
        <td><b>City:</b></td>
        <td><input type='text' class=\"cityname\" name='cityname' readonly></td>
      </tr>";
    echo "<tr>
        <td><b>Venue:</b></td>
        <td><input type='text' class=\"venuename\" name='venuename' readonly></td>
      </tr>";
    echo "<tr>
        <td><b>Presenter:</b></td>
        <td><input type='text' class=\"presentername\" name='presentername' readonly></td>
      </tr>";
    echo "<br>";
	echo "<tr><td colspan=2><h3>ACTION</h3></td></tr>";      
	echo "<tr>
			<td>Date to Change:</td>
    		<td><select name=\"date_change\" class=\"date_change\" id=\"routeDetChangeId\">
    			<option value=\"\">Select Date</option>
        		</select></td>
    		</tr>";
    echo "<tr>
    		<td> </td>
        	<td><input type='checkbox' class=\"resetdate\" name='resetdate'> Would you like to reset the initial date? </td>
      	</tr>";
	echo "</table>";
	echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"Change\"></p>";
	echo "</form>";
	echo "</div>";		
}
else {
  echo "failed";
}

$conn->close();
include '../footer.html';
?>
