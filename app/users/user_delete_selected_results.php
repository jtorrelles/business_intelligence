 <?php
require 'config/database_conn.php';
include 'header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_id = $_POST['user_id'];

$sql = "DELETE FROM security WHERE userid = $user_id";

if ($conn->query($sql) === TRUE) {
    echo "<p align=center>Record Deleted Successfully</p>";
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
include 'footer.html';
?> 