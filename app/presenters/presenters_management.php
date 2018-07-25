<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header_nologout.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/presenters_controller.js\"></script>";
echo "<script src=\"../js/jquery.are-you-sure.js\"></script>";

echo "<h1>Modify An Existing Presenter:</h1>";

echo "<table>";
echo "<tr><td>Country:</td>";
echo "<td><select name=\"country\" class=\"countries\" id=\"countryId\">";
echo "<option value=\"\">Select Country</option>
	  </select></td>";
echo "</tr>";
echo "<tr><td>State:</td>";
echo "<td><select name=\"state\" class=\"states\" id=\"stateMngId\">";
echo "<option value=\"\">Select State</option>
	 </select></td>";
echo "</tr>";
echo "<tr><td>Presenter:</td>";
echo "<td><select name=\"presenter\" class=\"presenter\" id=\"presenterMngId\">";
echo "<option value=\"\">Select Presenter</option>
	 </select></td><tr>";
echo "</table>";
echo "<input type=\"button\" name=\"search\" value=\"Find\" onclick=\"findData(0)\">";
echo "<br>";

echo "<div style=\"display:none\" id=\"datapresenter\">";
echo "<form action=\"presenter_modify_results.php\" method=\"POST\">";
echo "<table>";
echo "<tr><td colspan=2><h3>GENERAL DATA</h3></td></tr>";
echo "<tr>
		<td><b>Presenter ID:</b></td>
		<td><input style=\"background-color: lightgrey;\" readonly type='text' class=\"id\" name='id_presenter'>This field cannot be modified</td>
	</tr>";	
echo "<tr>
		<td><b>Presenter Name:</b></td>
		<td><input autofocus='autofocus' type='text' class=\"name\" name='name'></td>
	</tr>";
echo "<tr>
		<td><b>Parent Company:</b></td>
		<td><input type='text' name='parentcompany' class=\"parentcompany\"></td>
	</tr>";	
echo "<tr>
		<td><b>Address 1:</b></td>
		<td><input type='text' name='address1' class=\"address1\"></td>
	</tr>";
echo "<tr>
		<td><b>Address 2:</b></td>
		<td><input type='text' name='address2' class=\"address2\"></td>
	</tr>";
echo "<tr>
		<td><b>Country:</b></td>
    	<td><select name=\"country_presenter_det\" class=\"countries_det\" id=\"countryId_det\">
    		<option value=\"\">Select Country</option>
        	</select></td>
    </tr>";
echo "<tr>
		<td><b>State:</b></td>
    	<td><select name=\"state_presenter_det\" class=\"states_det\" id=\"stateId_det\">
    		<option value=\"\">Select State</option>
       		</select></td>
    </tr>";
echo "<tr>
		<td><b>City:</b></td>
    	<td><select name=\"city_presenter_det\" class=\"cities_det\" id=\"cityId_det\">
    		<option value=\"\">Select City</option>
        	</select></td>
    </tr>";	
echo "<tr>
		<td><b>ZIP Code:</b></td>
		<td><input type='text' name='zip' class=\"zip\"></td>
	</tr>";
echo "<tr>
		<td><b>Phone:</b></td>
		<td><input type='text' name='phone' class=\"phone\"></td>
	</tr>";
echo "<tr>
		<td><b>Ext Phone:</b></td>
		<td><input type='text' name='extphone' class=\"extphone\"></td>
	</tr>";
echo "<tr>
		<td><b>Fax:</b></td>
		<td><input type='text' name='fax' class=\"fax\"></td>
	</tr>";
echo "<tr>
		<td><b>Email:</b></td>
		<td><input type='text' name='email' class=\"email\"></td>
	</tr>";
echo "<tr>
		<td><b>Contact:</b></td>
		<td><input type='text' name='contact' class=\"contact\"></td>
	</tr>";
echo "<tr>
		<td><b>Notes:</b></td>
		<td><textarea name='notes' rows=4 cols=40 class=\"notes\"></textarea></td>
	</tr>";
echo "<tr>
		<td><b>Is the Presenter Active?:</b></td>
      	<td><select name='active_presenter' class=\"active\"><br><br>
			<option value='Y'>YES</option>
			<option value='N' selected='selected'>NO</option>
		</select>
		</td>
	</tr>";
echo "</table>";
echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
echo "</form>";
echo "</div>";
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
