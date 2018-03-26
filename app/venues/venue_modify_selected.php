<?php
require '../db/database_conn.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	echo "<h1>Modify An Existing Venue:</h1>";
if(isset($_GET['selectedid'])){
  $selectedid = $_GET['selectedid'];
  	$sql = "SELECT venueid,
                   venuename,
                   venueaddress_1,
                   venueaddress_2,
                   venueactive,
                   venuezip,
				   venuephone,
				   venuefax,
				   venueemail,
				   venuenotes
				   FROM venues WHERE venueid = $selectedid";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
	echo "<form action=\"venue_modify_results.php\" method=\"POST\">";
	echo "<table>";
	echo "<tr><td><b>Venue ID:</b></td><td><input style=\"background-color: lightgrey;\" readonly type='text' name='id_venue' value='".$row['venueid']."'>This field cannot be modified</td></tr>";	
    echo "<tr><td><b>Venue Name:</b></td><td><input autofocus='autofocus' type='text' name='name_venue' value='".$row['venuename']."'></td></tr>";
	
	echo "<tr><td><b>Address 1:</b></td><td><input type='text' name='address1_venue' value='".$row['venueaddress_1']."'></td></tr>";
	echo "<tr><td><b>Address 2:</b></td><td><input type='text' name='address2_venue' value='".$row['venueaddress_2']."'></td></tr>";
	echo "<tr><td><b>ZIP Code:</b></td><td><input type='text' name='zip_venue' value='".$row['venuezip']."'></td></tr>";
	echo "<tr><td><b>Phone:</b></td><td><input type='text' name='phone_venue' value='".$row['venuephone']."'></td></tr>";
	echo "<tr><td><b>Fax:</b></td><td><input type='text' name='fax_venue' value='".$row['venuefax']."'></td></tr>";
	echo "<tr><td><b>Email:</b></td><td><input type='text' name='email_venue' value='".$row['venueemail']."'></td></tr>";
	echo "<tr><td><b>Notes:</b></td><td><textarea name='notes_venue' rows=4 cols=40>".$row['venuenotes']."</textarea></td></tr>";

	$active = $row['venueactive'];
	echo "<tr><td><b>Is the Venue Active?:</b></td>
	      <td><select name='active_venue'><br><br>";
			if ($active == 'N') {
				echo "<option value='Y'>YES</option>
			  		<option value='N' selected='selected'>NO</option>";
			}else{
				echo "<option value='Y' selected='selected'>YES</option>
		  			<option value='N'>NO</option>";
			}
	echo "</select></td></tr>";

	echo "</table>";
	echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
	echo "</form>";
	} 
}
include '../footer.html';
?> 