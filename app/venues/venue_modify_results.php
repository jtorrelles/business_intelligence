 <?php
require '../db/database_conn.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = $_POST['id_venue'];
$name_venue = $_POST['name_venue'];
$active_venue = $_POST['active_venue'];
$address1_venue = $_POST['address1_venue'];
$address2_venue = $_POST['address2_venue'];
$zip_venue = $_POST['zip_venue'];
$phone_venue = $_POST['phone_venue'];
$fax_venue = $_POST['fax_venue'];
$email_venue = $_POST['email_venue'];
$notes_venue = $_POST['notes_venue'];

$sql = "UPDATE venues SET 
		venuename = '$name_venue',
		venueactive = '$active_venue',
		venueaddress_1 = '$address1_venue',
		venueaddress_2 = '$address2_venue',
		venuezip = '$zip_venue',
		venuephone = '$phone_venue',
		venuefax = '$fax_venue',
		venueemail = '$email_venue',
		venuenotes = '$notes_venue' 
		WHERE venueid = $id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
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