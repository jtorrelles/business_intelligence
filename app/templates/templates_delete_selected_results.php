<?php
require '../db/database_conn.php';
include '../session.php';
//include 'access_control.php';
include '../header.html';
$description = "Deleted Template: ".$_POST['id_template'];
include '../security_log.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id_template = $_POST['id_template'];

$sql = "DELETE FROM templates,templates_fields USING templates INNER JOIN templates_fields ON templates.id = templates_fields.templateid WHERE templates.id = $id_template";

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
include '../footer.html';
?>