 <?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_id = $_POST['user_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$user_name = $_POST['user_name'];
$user_password = $_POST['user_password'];
$user_profile = $_POST['user_profile'];

$sql = "UPDATE security SET
username = '$user_name',
userpassword = '$user_password',
userfirst_name = '$first_name',
userlast_name = '$last_name',
userprofile = '$user_profile'
WHERE userid = $user_id";

if ($conn->query($sql) === TRUE) {
    echo "<p align=center>User Modified Successfully!</p>";
} else {
    echo "Error modifying record: " . $conn->error;
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