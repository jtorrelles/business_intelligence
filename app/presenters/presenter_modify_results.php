 <?php
require '../db/database_conn.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = $_POST['id_presenter'];
$name_presenter = $_POST['name'];
$active_presenter = $_POST['active_presenter'];
$address1_presenter = $_POST['address1'];
$address2_presenter = $_POST['address2'];
$zip_presenter = $_POST['zip'];
$phone_presenter = $_POST['phone'];
$extphone_presenter = $_POST['extphone'];
$fax_presenter = $_POST['fax'];
$email_presenter = $_POST['email'];
$notes_presenter = $_POST['notes'];
$contact_presenter = $_POST['contact'];
$pace_presenter = $_POST['pace'];

$sql = "UPDATE presenters SET 
		presentername = '$name_presenter',
		presenteractive = '$active_presenter',
		presenteraddress_1 = '$address1_presenter',
		presenteraddress_2 = '$address2_presenter',
		presenterzip = '$zip_presenter',
		presenterphone = '$phone_presenter', 
		presenterphone_ext = '$extphone_presenter',
		presenterfax = '$fax_presenter',
		presenteremail = '$email_presenter',
		presenternotes = '$notes_presenter', 
		presentercontact_name = '$contact_presenter', 
		presenterpace = '$pace_presenter'
		WHERE presenterid = $id";

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