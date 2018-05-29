 <?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
$description = "Deleted Show: ".$_POST['id_show'];
include '../security_log.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id_show = $_POST['id_show'];

$sql = "DELETE FROM shows WHERE showid = $id_show";

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