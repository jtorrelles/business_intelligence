<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	echo "<h1>Add a New Presenter:</h1>";
		echo "<form action=\"presenter_add_results.php\" method=\"POST\">";
		echo "<table>";
		echo "<tr><td>Presenter Name:</td><td><input type=text name='name_presenter'></td></tr>";
		echo "<tr><td>Parent Company:</td><td><input type=text name='parent_presenter'></td></tr>";
		echo "<tr><td>Address 1:</td><td><input type=text name='address1_presenter'></td></tr>";
		echo "<tr><td>Address 2:</td><td><input type=text name='address2_presenter'></td></tr>";
		echo "<tr><td>Country:</td>";
		echo "<td><select name=\"country_presenter\" class=\"countries\" id=\"countryId\">";
		echo "<option value=\"\">Select Country</option>
			  </select></td>";
		echo "</tr>";
		echo "<tr><td>State:</td>";
		echo "<td><select name=\"state_presenter\" class=\"states\" id=\"stateId\">";
		echo "<option value=\"\">Select State</option>
			 </select></td>";
		echo "</tr>";
		echo "<tr><td>City:</td>";
		echo "<td><select name=\"city_presenter\" class=\"cities\" id=\"cityId\">";
		echo "<option value=\"\">Select City</option>
			  </select>
			  <script src=\"../js/jquery.min.js\"></script>
			  <script src=\"../js/presenters_controller.js\"></script></td>";
		echo "</tr>";
		echo "<tr><td>ZIP Code:</td><td><input type=text name='zip_presenter'></td></tr>";
		echo "<tr><td>Phone:</td><td><input type=text name='phone_presenter'></td></tr>";
		echo "<tr><td>Phone Ext:</td><td><input type=text name='extphone_presenter'></td></tr>";
		echo "<tr><td>Fax:</td><td><input type=text name='fax_presenter'></td></tr>";
		echo "<tr><td>Email:</td><td><input type=text name='email_presenter'></td></tr>";
		echo "<tr><td>Contact Name:</td><td><input type=text name='contact_presenter'></td></tr>";
		echo "<tr><td>Notes:</td><td><textarea name='notes_presenter' rows=4 cols=40></textarea></td></tr>";
		echo "<tr><td>Is the Presenter Active?:</td>";
    	echo "<td><select name='active_presenter'>
				<option value='Y'>YES</option>
				<option value='N'>NO</option>
			  </select></td>";
		echo "</tr>";
		echo "</table>";
		echo "<p><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
		echo "</form>";
include '../footer.html';
?> 