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
    $fday = $_POST['presentation_date0'];

$sql1 = "SELECT det.PRESENTATION_DATE as FIRST_DATE
         FROM routes ro, routes_det det 
         WHERE ro.ROUTESID = det.ROUTESID
         AND ro.SHOWID = $showid
         ORDER BY det.PRESENTATION_DATE
         LIMIT 1";  

$result = $conn->query($sql1);
while ($row = $result->fetch_assoc()){
    $fday_orig = $row['FIRST_DATE'];
}   

if(isset($fday_orig)){
    if($fday==$fday_orig){
        echo "The route is already loaded for this show on this date";
        exit();
    }
}   

$sql2 = "INSERT INTO routes (SHOWID,TRUCKS,DATE_OF_ROUTE,WEEKLY_NUT)
				VALUES ($showid, $numberoftrucks, '$date_route', $weeklynut)";

if($conn->query($sql2) === TRUE) {

    $routeid = $conn->insert_id;

    for($i = 0; $i < 364; $i++){

    	$presentation_date = $_POST["presentation_date" . $i];
    	if(empty($_POST["holiday" . $i])){$holiday = 0;}else{$holiday = 1;} 	
    	$city = substr($_POST["city" . $i],strpos($_POST["city" . $i],"//")+2);
    	if(empty($city)){$city = "NULL";}else{$city = $city;} 
    	if(empty($_POST["repeat" . $i])){$repeat = 0;}else{$repeat = 1;} 
    	$mileage = $_POST["mileage" . $i];	
    	if(empty($mileage)){$mileage = 0.00;}else{$mileage = $mileage;} 
    	$book_notes = $_POST["book_notes" . $i];
    	$prod_notes = $_POST["prod_notes" . $i];
    	$time_zone = $_POST["time_zone" . $i];
    	$show_times = $_POST["show_times" . $i];
    	$perf = $_POST["perf" . $i];	
    	if(empty($perf)){$perf = 0;}else{$perf = $perf;}
    	$venue = substr($_POST["venue" . $i],strpos($_POST["venue" . $i],"//")+2);
    	if(empty($venue)){$venue = "NULL";}else{$venue = $venue;} 
    	$presenter = substr($_POST["presenter" . $i],strpos($_POST["presenter" . $i],"//")+2);
    	if(empty($presenter)){$presenter = "NULL";}else{$presenter = $presenter;} 
    	$capacity = $_POST["capacity" . $i];	
    	if(empty($capacity)){$capacity = 0;}else{$capacity = $capacity;}
    	$fixed_gntee = str_replace(",",".",$_POST["fixed_gntee" . $i]);	
    	if(empty($fixed_gntee)){$fixed_gntee = 0.00;}else{$fixed_gntee = $fixed_gntee;}
    	$royalty = str_replace(",",".",$_POST["royalty" . $i]);	
    	if(empty($royalty)){$royalty = 0.00;}else{$royalty = $royalty;}    	
    	$backend = str_replace("%","",$_POST["backend" . $i]);	
    	if(strpos($backend,'.')==true){$backend = $backend * 100;}else{$backend = str_replace(",",".",$backend);}
    	if(empty($backend)){$backend = 0.00;}else{$backend = $backend;}
    	$breakeven = str_replace("%","",$_POST["breakeven" . $i]);	
    	if(strpos($breakeven,'.')==true){$breakeven = $breakeven * 100;}else{$breakeven = str_replace(",",".",$breakeven);}
    	if(empty($breakeven)){$breakeven = 0.00;}else{$breakeven = $breakeven;}
    	$deal_notes = $_POST["deal_notes" . $i];
    	$est_royalty = str_replace(",",".",$_POST["est_royalty" . $i]);	
    	if(empty($est_royalty)){$est_royalty = 0.00;}else{$est_royalty = $est_royalty;}
    	if(empty($_POST["on_sub" . $i])){$on_sub = 0;}else{$on_sub = 1;} 
    	if(empty($_POST["date_conf" . $i])){$date_conf = 0;}else{$date_conf = 1;} 
    	if(empty($_POST["offer" . $i])){$offer = 0;}else{$offer = 1;} 
    	if(empty($_POST["price_scales" . $i])){$price_scales = 0;}else{$price_scales = 1;} 
    	if(empty($_POST["expenses" . $i])){$expenses = 0;}else{$expenses = 1;} 
    	if(empty($_POST["deal_memo" . $i])){$deal_memo = 0;}else{$deal_memo = 1;} 
    	if(empty($_POST["contract" . $i])){$contract = 0;}else{$contract = 1;}     	

    	$sql3 = "INSERT INTO routes_det (ROUTESID,PRESENTATION_DATE,HOLIDAY,CITYID,`REPEAT`,MILEAGE,BOOK_NOTES,PROD_NOTES,TIME_ZONE,SHOW_TIMES,PERF,VENUEID,PRESENTERID,CAPACITY,FIXED_GNTEE,ROYALTY,BACKEND,BREAKEVEN,DEAL_NOTES,EST_ROYALTY,ON_SUB,DATE_CONF,OFFER,PRICE_SCALES,EXPENSES,DEAL_MEMO,CONTRACT)
				VALUES ($routeid,'$presentation_date',$holiday,$city,$repeat,$mileage,'$book_notes','$prod_notes','$time_zone','$show_times',$perf,$venue,$presenter,$capacity,$fixed_gntee,$royalty,$backend,$breakeven,'$deal_notes',$est_royalty,$on_sub,$date_conf,$offer,$price_scales,$expenses,$deal_memo,$contract)";

		if ($conn->query($sql3) === TRUE) {
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