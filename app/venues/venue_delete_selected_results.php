<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header_nologout.html';
$description = "Deleted Venue: ".$_POST['id_venue'];
include '../security_log.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = $_POST['id_venue'];

$sql = "DELETE FROM venues WHERE venueid = $id";

if ($conn->query($sql) === TRUE) {
    echo "Record Deleted Successfully";
} else {
    echo "Error Deleting Record: " . $conn->error;
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
