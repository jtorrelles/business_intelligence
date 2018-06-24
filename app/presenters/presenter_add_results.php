<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header_nologout.html';
$description = "Added Presenter: ".$_POST['name_presenter'];
include '../security_log.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$name = $_POST['name_presenter'];
$parentcompany = $_POST['parent_presenter'];
$active = $_POST['active_presenter'];
$address1 = $_POST['address1_presenter'];
$address2 = $_POST['address2_presenter'];
$city = $_POST['city_presenter'];
$state = $_POST['state_presenter'];
$country = $_POST['country_presenter'];
$phone = $_POST['phone_presenter'];
$extphone = $_POST['extphone_presenter'];
$zip = $_POST['zip_presenter'];
$fax = $_POST['fax_presenter'];
$email = $_POST['email_presenter'];
$contact = $_POST['contact_presenter'];
$notes = $_POST['notes_presenter'];

$sql = "INSERT INTO presenters (presentername,presenterparent_company,presenteraddress_1,presenteraddress_2,presentercityid,presenterzip,presenterphone,presenterphone_ext, presenterfax,presenteremail,presenternotes,presenteractive, presentercontact_name)
VALUES
('$name','$parentcompany','$address1','$address2','$city','$zip','$phone','$extphone','$fax','$email','$notes','$active','$pace','$contact')";

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
