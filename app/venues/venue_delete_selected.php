<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header_nologout.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<h1 align=center style=\"color: red;\">WARNING: YOU ARE ABOUT TO DELETE THIS VENUE</h1>";
if(isset($_GET['selectedid'])){
  $selectedid = $_GET['selectedid'];
  
  	$sql = "SELECT venueid,
           			venuename,
           			venueactive,
           			venueaddress_1,
				   	venueaddress_2,
				   	ci.`name` as venuecity,
				   	st.`name` as venuestate,
				   	co.`name` as venuecountry,
				   	venuephone,
				   	venuefax,
				   	venueemail,
				   	venuenotes,
				   	venueactive
			FROM venues, cities ci, states st, countries co 
			WHERE venueid = $selectedid 
			AND VenueCITYID = ci.id 
			AND ci.state_id = st.id 
			AND st.country_id = co.id";

	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
	echo "<form action=\"venue_delete_selected_results.php\" method=\"POST\">";
	echo "<table align=center>";
	echo "<tr><td><b>Venue ID:</b></td><td><input style=\"background-color: lightgrey;\" readonly type='text' name='id_venue' value='".$row['venueid']."'></td></tr>";	
    echo "<tr><td><b>Venue Name:</b></td><td>".$row['venuename']."</td></tr>";
    echo "<tr><td><b>Is the Venue Active?:</b></td><td>".$row['venueactive']."</td></tr>";
	
	echo "<tr><td><b>Address 1:</b></td><td>".$row['venueaddress_1']."</td></tr>";
	echo "<tr><td><b>Address 2:</b></td><td>".$row['venueaddress_2']."</td></tr>";
	echo "<tr><td><b>Country:</b></td><td>".$row['venuecountry']."</td></tr>";
	echo "<tr><td><b>State:</b></td><td>".$row['venuestate']."</td></tr>";
	echo "<tr><td><b>City:</b></td><td>".$row['venuecity']."</td></tr>";
	echo "<tr><td><b>Phone:</b></td><td>".$row['venuephone']."</td></tr>";
	echo "<tr><td><b>Fax:</b></td><td>".$row['venuefax']."</td></tr>";
	echo "<tr><td><b>Email:</b></td><td>".$row['venueemail']."</td></tr>";
	echo "<tr><td><b>Notes:</b></td><td>".$row['venuenotes']."</td></tr>";
	echo "<tr><td colspan=2></td></tr>";
	echo "<tr><td colspan=2></td></tr>";
	echo "<tr><td colspan=2 align=center><input type=\"submit\" name=\"modify\" value=\"DELETE\"></td></tr>";
	echo "</table>";
	echo "</form>";
} 
}
else {
  echo "failed";
}
$conn->close();
include '../footer.html';
?>
