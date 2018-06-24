<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header_nologout.html';

include '../security_log.php';

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$detid = $_POST['detid'];
	$gross_pot = $_POST['gross_pot'];
	$spo_gross_pot = $_POST['spo_gross_pot'];
	$subs_tsales = $_POST['subs_tsales'];
	$group_tsales = $_POST['group_tsales'];
	$single_tsales = $_POST['single_tsales'];
	$gross_sales = $_POST['gross_sales'];
	$ott_expenses = $_POST['ott_expenses'];
	$nagbor = $_POST['nagbor'];
	$pl_expenses = $_POST['pl_expenses'];
	$te_expenses = $_POST['te_expenses'];
	$ep_loss = $_POST['ep_loss'];
	$guarantee = $_POST['guarantee'];
	$royalty_per = $_POST['royalty_per'];
	$mroyalty = $_POST['mroyalty'];
	$overage_per = $_POST['overage_per'];
	$overage = $_POST['overage'];
	$ind = $_POST['ind'];

$sql = "UPDATE routes_det
		SET GROSS_POT = $gross_pot,
			SPO_GROSS_POT = $spo_gross_pot,
			SUBS_TSALES = $subs_tsales,
			GROUP_TSALES = $group_tsales,
			SINGLE_TSALES = $single_tsales,
			GROSS_SALES = $gross_sales,
			OTT_EXPENSES = $ott_expenses,
			NAGBOR = $nagbor,
			PL_EXPENSES = $pl_expenses,
			TE_EXPENSES = $te_expenses,
			EP_LOSS = $ep_loss,
			GUARANTEE = $guarantee,
			ROYALTY_PER = $royalty_per,
			MROYALTY = $mroyalty,
			OVERAGE_PER = $overage_per,
			OVERAGE = $overage,
			IND = $ind
			WHERE ROUTES_DETID = $detid";

	if ($conn->query($sql) === TRUE) {
	    echo "Record updated successfully";
		$securityid = $_POST['detid'];
		$security_sql = "SELECT shows.showname 
				 FROM routes_det 
				 INNER JOIN routes on routes.routesid = routes_det.routesid 
				 INNER JOIN shows on routes.showid = shows.showid
				 WHERE routes_det.routes_detid = '$securityid';";
		$security_result = $conn->query($security_sql);
		$security_row = $security_result->fetch_assoc();
		$description = "Modified Market Analysis on Route Detail for Show: ".$security_row['showname']." on Date: ".$_POST['presentation_date']." with query: ".str_replace("'"," ",$sql);
	} else {
    $error = "Error updating record: " .$conn->error;
	echo $error;
	$description = "Error Modifying Route Detail ID: ".$_POST['detid'].". The database returned this error: ".str_replace("'"," ",$error)." using this query: ".str_replace("'"," ",$sql);
	include '../security_log.php';
	}
	echo "
		<script language=\"javascript\"type=\"text/javascript\">
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
