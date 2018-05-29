<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
$description = "Modified Route for Show: ".$_POST['show_name'];
include '../security_log.php';

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$routeid = $_POST['id'];
	$numberoftruck = $_POST['numberoftruck'];
	$nut = $_POST['weeklynut'];

$sql = "UPDATE routes SET 
			TRUCKS = $numberoftruck,
			DATE_OF_ROUTE = now(),
			WEEKLY_NUT = $nut 
	   	WHERE ROUTESID = $routeid";

	if ($conn->query($sql) === TRUE) {
	    echo "<p>Route Modified Successfully!</p>";
	} else {
	    echo "Error modifying record: " . $conn->error;
	}
echo "	<script language=\"javascript\" type=\"text/javascript\">
			function windowClose() {
				window.open('','_parent','');
				window.opener.location.reload();
				window.close();
			}
		</script>
		<p align=center>
			<input type=\"button\" value=\"CLOSE THIS WINDOW\" onclick=\"windowClose();\">
		</p>";

$conn->close();
include '../footer.html';
?>