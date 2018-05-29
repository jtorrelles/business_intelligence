 <?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$user_name = $_POST['user_name'];
$user_password = $_POST['user_password'];
$user_profile = $_POST['user_profile'];

$sql = "INSERT INTO security 
(username,userpassword,userfirst_name,userlast_name,userprofile)
VALUES
('$user_name','$user_password','$first_name','$last_name','$user_profile')";

if ($conn->query($sql) === TRUE) {
    echo "<p>User Created successfully</p>";
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