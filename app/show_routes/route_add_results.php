<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
$description = "Added Route for Show: ".$_POST['show_name'];
include '../security_log.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	$showid = $_POST['show_name'];

	$numberoftrucks = $_POST['numberoftrucks'];
	$weeklynut = $_POST['weeklynut'];

	$dateofbeging = $_POST['beging_route'];


$sql = "INSERT INTO routes (SHOWID,TRUCKS,DATE_OF_ROUTE,WEEKLY_NUT)
				VALUES ($showid, $numberoftrucks, now(), $weeklynut)";

if ($conn->query($sql) === TRUE) {

    $routeid = $conn->insert_id;

    for($i = 0; $i < 365; $i++){

    	if($i > 0){

    		$UTC = new DateTimeZone("UTC");
    		$nextdate = new DateTime($dateofbeging, $UTC);
    		$nextdate->add(new DateInterval('P1D'));
    		$dateofbeging = $nextdate->format('Y-m-d');

    	}

    	$sql2 = "INSERT INTO routes_det (ROUTESID,PRESENTATION_DATE)
				VALUES ($routeid, '$dateofbeging')";

		if ($conn->query($sql2) === TRUE) {
			if(($i+1) ==365){
				echo "Record Created successfully";
			}
		}else{
			echo "Error Creating Detail: " . $conn->error;
		}

    }

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