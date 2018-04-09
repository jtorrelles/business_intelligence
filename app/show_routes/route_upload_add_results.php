<?php
require '../db/database_conn.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	$showid = $_POST['showtorouteid'];
	$numberoftrucks = $_POST['numberoftrucks'];
	$weeklynut = $_POST['weeklynut'];;
	$date_route = $_POST['date_route'];

$sql = "INSERT INTO routes (SHOWID,TRUCKS,DATE_OF_ROUTE,WEEKLY_NUT)
				VALUES ($showid, $numberoftrucks, '$date_route', $weeklynut)";


if ($conn->query($sql) === TRUE) {

    $routeid = $conn->insert_id;

    for($i = 0; $i < 364; $i++){

    	$presentation_date = $_POST["presentation_date" . $i];
    	if (empty($_POST["holiday" . $i])){$holiday = 0;}else{$holiday = 1;} 	
    	$city = substr($_POST["city" . $i],0,strpos($_POST["city" . $i],"-"));
    	if (empty($city)){$city = "NULL";}else{$city = $city;} 
    	if (empty($_POST["repeat" . $i])){$repeat = 0;}else{$repeat = 1;} 
    	$mileage = $_POST["mileage" . $i];	
    	if (empty($mileage)){$mileage = "NULL";}else{$mileage = $mileage;} 
    	$mileage = $_POST["mileage" . $i];	
    	if (empty($mileage)){$mileage = "NULL";}else{$mileage = $mileage;}
    	$book_notes = $_POST["book_notes" . $i];
    	$prod_notes = $_POST["prod_notes" . $i];
    	$time_zone = $_POST["time_zone" . $i];
    	$show_times = $_POST["show_times" . $i];


    	$sql2 = "INSERT INTO routes_det (ROUTESID,PRESENTATION_DATE,HOLIDAY,CITYID,`REPEAT`,MILEAGE,BOOK_NOTES,PROD_NOTES,TIME_ZONE,SHOW_TIMES)
				VALUES ($routeid,'$presentation_date',$holiday,$city,$repeat,$mileage,'$book_notes','$prod_notes','$time_zone','$show_times')";

		if ($conn->query($sql2) === TRUE) {
			if(($i+1) ==364){
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