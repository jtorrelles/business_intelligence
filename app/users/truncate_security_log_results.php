 <?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "TRUNCATE TABLE security_log";

if ($conn->query($sql) === TRUE) {
    echo "<p align=center>Security Log Succesfully Emptied!</p>";
} else {
    echo "<p align=center>Error while trying to empty the security log. The Database error returned: " . $conn->error ."</p>";
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