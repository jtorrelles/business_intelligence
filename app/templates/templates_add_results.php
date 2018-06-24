<?php
require '../db/database_conn.php';
include '../session.php';
//include 'access_control.php';
include '../header.html';
$description = "Added new Report Template: ";
include '../security_log.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$current_user = $_SESSION['login_user'];
$template_name = $_POST['template_name'];
$sql = "INSERT INTO templates(moduleid,name,user) VALUES ('1',\"$template_name\",'$current_user');";
$result = $conn->query($sql);

$sql = "SELECT id FROM templates WHERE name = \"$template_name\";";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$template_id = $row['id'];
$sql = "SELECT field_name FROM modules_fields WHERE moduleid = '1'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$name = $row['field_name'];
	if ($_POST[$name] <> '0') {
		$valor = $_POST[$name];
		$sql2 = "INSERT INTO templates_fields(templateid,modulefieldid) VALUES('$template_id','$valor')";
		$result2 = $conn->query($sql2);
	}
}
echo "<p align=center>Record Created successfully</p>";
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
