<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header_nologout.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	echo "<h1>Add a New Venue:</h1>";
		echo "<form action=\"venue_add_results.php\" method=\"POST\">";
		echo "<table>";
		echo "<tr><td>Venue Name:</td><td><input type=text name='name_venue'></td></tr>";
		echo "<tr><td>Address 1:</td><td><input type=text name='address1_venue'></td></tr>";
		echo "<tr><td>Address 2:</td><td><input type=text name='address2_venue'></td></tr>";
		echo "<tr><td>Country:</td>";
		echo "<td><select name=\"country_venue\" class=\"countries\" id=\"countryId\">";
		echo "<option value=\"\">Select Country</option>
			  </select></td>";
		echo "</tr>";
		echo "<tr><td>State:</td>";
		echo "<td><select name=\"state_venue\" class=\"states\" id=\"stateId\">";
		echo "<option value=\"\">Select State</option>
			 </select></td>";
		echo "</tr>";
		echo "<tr><td>City:</td>";
		echo "<td><select name=\"city_venue\" class=\"cities\" id=\"cityId\">";
		echo "<option value=\"\">Select City</option>
			  </select>
			  <script src=\"../js/jquery.min.js\"></script>
			  <script src=\"../js/venues_controller.js\"></script>
			  <script src=\"../js/jquery.are-you-sure.js\"></script></td>";
		echo "</tr>";
		echo "<tr><td>ZIP Code:</td><td><input type=text name='zip_venue'></td></tr>";
		echo "<tr><td>Phone:</td><td><input type=text name='phone_venue'></td></tr>";
		echo "<tr><td>Fax:</td><td><input type=text name='fax_venue'></td></tr>";
		echo "<tr><td>Contact Info:</td><td><input type=text name='email_venue'></td></tr>";
		echo "<tr><td>Notes:</td><td><textarea name='notes_venue' rows=4 cols=40></textarea></td></tr>";
		echo "<tr><td>Is the Venue Active?:</td>";
    	echo "<td><select name='active_venue'>
				<option value='Y'>YES</option>
				<option value='N'>NO</option>
			  </select></td>";
		echo "</tr>";
		echo "</table>";
		echo "<p><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
		echo "</form>";
echo "
<script>
  $(function() {
	  $('form').areYouSure( {message:\"Data will be lost if you close this window!\"} );
  });
</script>
";
$conn->close();		
include '../footer.html';
?> 
