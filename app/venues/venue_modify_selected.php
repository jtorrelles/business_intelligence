<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header_nologout.html';
echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/venues_controller.js\"></script>";

echo "<h1>Modify An Existing Venue:</h1>";

if(isset($_GET['selectedid'])){

	echo "<script>findData(".$_GET['selectedid'].");</script>";

	echo "<form action=\"venue_modify_results.php\" method=\"POST\">";
	echo "<table>";
	echo "<tr><td><b>Venue ID:</b></td><td><input style=\"background-color: lightgrey;\" readonly type='text' name='id_venue' class='id'>This field cannot be modified</td></tr>";	
    echo "<tr><td><b>Venue Name:</b></td><td><input autofocus='autofocus' type='text' name='name' class='name'></td></tr>";
	
	echo "<tr><td><b>Address 1:</b></td><td><input type='text' name='address1' class='address1'></td></tr>";
	echo "<tr><td><b>Address 2:</b></td><td><input type='text' name='address2' class='address2'></td></tr>";
	echo "<tr><td><b>Country:</b></td>";
    echo "<td><select name=\"country_venue_det\" class=\"countries_det\" id=\"countryId_det\">";
    echo "<option value=\"\">Select Country</option>
        </select></td>";
    echo "</tr>";
    echo "<tr><td><b>State:</b></td>";
    echo "<td><select name=\"state_venue_det\" class=\"states_det\" id=\"stateId_det\">";
    echo "<option value=\"\">Select State</option>
       </select></td>";
    echo "</tr>";
    echo "<tr><td><b>City:</b></td>";
    echo "<td><select name=\"city_venue_det\" class=\"cities_det\" id=\"cityId_det\">";
    echo "<option value=\"\">Select City</option>
        </select></td>";
    echo "</tr>";	
	echo "<tr><td><b>ZIP Code:</b></td><td><input type='text' name='zip' class='zip'></td></tr>";
	echo "<tr><td><b>Phone:</b></td><td><input type='text' name='phone' class='phone'></td></tr>";
	echo "<tr><td><b>Fax:</b></td><td><input type='text' name='fax' class='fax'></td></tr>";
	echo "<tr><td><b>Contact Info:</b></td><td><input type='text' name='email' class='email'></td></tr>";
	echo "<tr><td><b>Notes:</b></td><td><textarea name='notes' class='notes' rows=4 cols=40></textarea></td></tr>";
	echo "<tr>
			<td><b>Is the Venue Active?:</b></td>
	      	<td>
	      		<select name='active_venue' class=\"active\"><br><br>
					<option value='Y'>YES</option>
					<option value='N' selected='selected'>NO</option>
				</select>
			</td>
		</tr>";

	echo "</table>";
	echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
	echo "</form>";
}
include '../footer.html';
?> 
