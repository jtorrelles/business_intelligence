<?php
require '../db/database_conn.php';
include '../session.php';
//include 'access_control.php';
include '../header.html';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id_template = $_POST['id_template'];
$name_template = $_POST['name_template'];
$user_template = $_POST['user_template'];

$sql = "INSERT INTO templates(moduleid,name,user) VALUES('1',\"$name_template\",'$user_template')";
$conn->query($sql);

$sql2 = "SELECT id FROM templates WHERE name = \"$name_template\" AND user = '$user_template'";
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();
$newid = $row2['id'];
$sql3 = "SELECT modulefieldid FROM templates_fields WHERE templateid = '$id_template'";
$result3 = $conn->query($sql3);
while ($row3 = $result3->fetch_assoc()) {
	$newmodulefieldid = $row3['modulefieldid'];
	$sql4 = "INSERT INTO templates_fields(templateid,modulefieldid) VALUES('$newid','$newmodulefieldid')";
	$conn->query($sql4);
}
echo "<p align=center>Report Template Shared Successfully</p>";
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
