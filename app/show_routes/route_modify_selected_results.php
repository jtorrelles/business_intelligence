<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';


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
		$description = "Modified Route for Show: ".$_POST['show_name']." using this query: ".str_replace("'"," ",$sql);
		include '../security_log.php';		
	} else {
		$error = "Error updating record: " .$conn->error;
		echo $error;
		$description = "Error Modifying Route for Show: ".$_POST['show_name'].". The database returned this error: ".str_replace("'"," ",$error)." using this query: ".str_replace("'"," ",$sql);
		include '../security_log.php';
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