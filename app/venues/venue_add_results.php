<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header_nologout.html';
$description = "Added Venue: ".$_POST['name_venue'];
include '../security_log.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$name_venue = $_POST['name_venue'];
$active_venue = $_POST['active_venue'];
$address1_venue = $_POST['address1_venue'];
$address2_venue = $_POST['address2_venue'];
$city_venue = $_POST['city_venue'];
$state_venue = $_POST['state_venue'];
$country_venue = $_POST['country_venue'];
$phone_venue = $_POST['phone_venue'];
$zip_venue = $_POST['zip_venue'];
$fax_venue = $_POST['fax_venue'];
$email_venue = $_POST['email_venue'];
$notes_venue = $_POST['notes_venue'];

$sql = "INSERT INTO venues 
(venuename,venueaddress_1,venueaddress_2,venuecityid,venuezip,venuephone,venuefax,venueemail,venuenotes,venueactive)
VALUES
('$name_venue','$address1_venue','$address2_venue','$city_venue','$zip_venue','$phone_venue','$fax_venue','$email_venue','$notes_venue','$active_venue')";

if ($conn->query($sql) === TRUE) {
    echo "Record Created successfully";
} else {
    echo "Error Creating record: " . $conn->error;
}
echo "
	<script language=\"javascript\"
		type=\"text/javascript\">
		function windowClose() {
			window.open('','_parent','');
			window.opener.location.reload();
			window.close();
		}
	</script>
	<p align=center>
	<input type=\"button\" value=\"CLOSE THIS WINDOW\" onclick=\"windowClose();\">
	</p>
";
$conn->close();

include '../footer.html';
?>
