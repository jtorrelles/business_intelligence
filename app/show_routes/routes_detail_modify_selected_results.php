<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$detid = $_POST['detid'];

	if (empty($_POST['holiday'])){$holiday = 0;}else{$holiday = 1;}
	$cityid = $_POST['city_detail'];
	if (empty($_POST['repeat'])){$repeat = 0;}else{$repeat = 1;}
	$mileage = $_POST['mileage'];
	$book_notes = $_POST['book_notes'];
	$prod_notes = $_POST['prod_notes'];
	$time_zone = $_POST['time_zone'];
	$show_times = $_POST['show_times'];	
	$perf = $_POST['perf'];
	$venue = $_POST['venue_name'];
	$presenter = $_POST['presenter_name'];
	$capacity = $_POST['capacity'];
	$fixed_gntee = $_POST['fixed_gntee'];
	$royalty = $_POST['royalty'];
	$backend = $_POST['backend'];
	$breakeven = $_POST['breakeven'];
	$deal_notes = $_POST['deal_notes'];
	$est_royalty = $_POST['est_royalty'];
	if (empty($_POST['onsub'])){$on_sub = 0;}else{$on_sub = 1;}
	if (empty($_POST['dateconf'])){$date_conf = 0;}else{$date_conf = 1;}
	if (empty($_POST['offer'])){$offer = 0;}else{$offer = 1;}
	if (empty($_POST['price_scales'])){$price_scales = 0;}else{$price_scales = 1;}
	if (empty($_POST['expenses'])){$expenses = 0;}else{$expenses = 1;}
	if (empty($_POST['deal_memo'])){$deal_memo = 0;}else{$deal_memo = 1;}
	if (empty($_POST['contract'])){$contract = 0;}else{$contract = 1;}

$sql = "UPDATE routes_det  
        SET HOLIDAY = $holiday,
        	CITYID = $cityid, 
        	`REPEAT` = $repeat, 
            MILEAGE = $mileage,
            BOOK_NOTES = '$book_notes',
            PROD_NOTES = '$prod_notes',
            TIME_ZONE = '$time_zone',
            SHOW_TIMES = '$show_times',
            PERF = $perf,
            VENUEID = $venue,
            PRESENTERID = $presenter,
            CAPACITY = $capacity,
            FIXED_GNTEE = $fixed_gntee,
            ROYALTY = $royalty,
            BACKEND = $backend,
            BREAKEVEN = $breakeven,
            DEAL_NOTES = '$deal_notes',
            EST_ROYALTY = $est_royalty,
            ON_SUB = $on_sub,
            DATE_CONF = $date_conf,
            OFFER = $offer,
            PRICE_SCALES = $price_scales,
            EXPENSES = $expenses,
            DEAL_MEMO = $deal_memo,
            CONTRACT = $contract         
	   	WHERE ROUTES_DETID = $detid";

	if ($conn->query($sql) === TRUE) {
	    echo "<p>Route Modified Successfully!</p>";
		$securityid = $_POST['detid'];
		$security_sql = "SELECT shows.showname 
						FROM routes_det 
						INNER JOIN routes on routes.routesid = routes_det.routesid 
						INNER JOIN shows on routes.showid = shows.showid
						WHERE routes_det.routes_detid = '$securityid';";
		$security_result = $conn->query($security_sql);
		$security_row = $security_result->fetch_assoc();
		$description = "Modified Route Detail for Show: ".$security_row['showname']." on Date: ".$_POST['presentation_date']." using query: ".str_replace("'"," ",$sql);
		include '../security_log.php';
	} else {
		$error = "Error updating record: " .$conn->error;
		echo $error;
		$description = "Error Modifying Route Detail for Show: ".$securityrow['showname'].". The database returned this error: ".str_replace("'"," ",$error)." using this query: ".str_replace("'"," ",$sql);
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