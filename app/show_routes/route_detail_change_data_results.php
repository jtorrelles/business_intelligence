<?php
require '../db/database_conn.php';
include '../header.html'; 

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$detid = $_POST['detid'];
	$detid_change = $_POST['date_change'];
	if (empty($_POST['resetdate'])){$resetdate = 0;}else{$resetdate = 1;}

	//get data of the initial date
	$sql = "SELECT HOLIDAY, CITYID, `REPEAT`, MILEAGE, IFNULL(BOOK_NOTES, ' ') AS BOOK_NOTES, 
					IFNULL(PROD_NOTES, ' ') AS PROD_NOTES, TIME_ZONE, 
					SHOW_TIMES, PERF, VENUEID, PRESENTERID, CAPACITY, FIXED_GNTEE, ROYALTY, 
					BACKEND, BREAKEVEN, DEAL_NOTES, EST_ROYALTY, ON_SUB, DATE_CONF, OFFER, 
					PRICE_SCALES, EXPENSES, DEAL_MEMO, CONTRACT, GROSS_POT, SPO_GROSS_POT, 
					SUBS_TSALES, GROUP_TSALES, SINGLE_TSALES, GROSS_SALES, OTT_EXPENSES, 
					NAGBOR, PL_EXPENSES, TE_EXPENSES, EP_LOSS, GUARANTEE, ROYALTY_PER, MROYALTY, 
					OVERAGE_PER, OVERAGE, IND 
					FROM routes_det 
					WHERE ROUTES_DETID = $detid";

	if ($result = $conn->query($sql)) {

		$row = $result->fetch_assoc();

		$holliday = $row['HOLIDAY'];
		$cityid = $row['CITYID'];
		if (empty($cityid)) { $cityid = "NULL";}
		$repeat = $row['REPEAT'];
		$mileage = $row['MILEAGE'];
		$booknotes = $row['BOOK_NOTES'];
		$prodnotes = $row['PROD_NOTES'];
		$timezone = $row['TIME_ZONE'];
		$showtime = $row['SHOW_TIMES'];
		$perf = $row['PERF'];
		$venueid = $row['VENUEID'];
		if (empty($venueid)) { $venueid = "NULL";}
		$presenterid = $row['PRESENTERID'];
		if (empty($presenterid)) { $presenterid = "NULL";}
		$capacity = $row['CAPACITY'];
		$fixedgntee = $row['FIXED_GNTEE'];
		$royalty = $row['ROYALTY'];
		$backend = $row['BACKEND'];
		$breakeven = $row['BREAKEVEN'];
		$dealnotes = $row['DEAL_NOTES'];
		$estroyalty = $row['EST_ROYALTY'];
		$onsub = $row['ON_SUB'];
		$dateconf = $row['DATE_CONF'];
		$offer = $row['OFFER'];
		$pricescales = $row['PRICE_SCALES'];
		$expenses = $row['EXPENSES'];
		$dealmemo = $row['DEAL_MEMO'];
		$contract = $row['CONTRACT'];
		$grosspot = $row['GROSS_POT'];
		$spogrosspot = $row['SPO_GROSS_POT'];
		$substsales = $row['SUBS_TSALES'];
		$grouptsales = $row['GROUP_TSALES'];
		$singletsales = $row['SINGLE_TSALES'];
		$grosssales = $row['GROSS_SALES'];
		$ottexpenses = $row['OTT_EXPENSES'];
		$nagbor = $row['NAGBOR'];
		$plexpenses = $row['PL_EXPENSES'];
		$teexpenses = $row['TE_EXPENSES'];
		$eploss = $row['EP_LOSS'];
		$guarantee = $row['GUARANTEE'];
		$royaltyper = $row['ROYALTY_PER'];
		$mroyalty = $row['MROYALTY'];
		$overageper = $row['OVERAGE_PER'];
		$overage = $row['OVERAGE'];
		$ind = $row['IND'];

		//change data in dates
		if($resetdate == 0){

			//get data of the final date
			$sqldatechange = "SELECT HOLIDAY, CITYID, `REPEAT`, MILEAGE, IFNULL(BOOK_NOTES, ' ') AS BOOK_NOTES, 
								IFNULL(PROD_NOTES, ' ') AS PROD_NOTES, TIME_ZONE, 
								SHOW_TIMES, PERF, VENUEID, PRESENTERID, CAPACITY, FIXED_GNTEE, ROYALTY, 
								BACKEND, BREAKEVEN, DEAL_NOTES, EST_ROYALTY, ON_SUB, DATE_CONF, OFFER, 
								PRICE_SCALES, EXPENSES, DEAL_MEMO, CONTRACT, GROSS_POT, SPO_GROSS_POT, 
								SUBS_TSALES, GROUP_TSALES, SINGLE_TSALES, GROSS_SALES, OTT_EXPENSES, 
								NAGBOR, PL_EXPENSES, TE_EXPENSES, EP_LOSS, GUARANTEE, ROYALTY_PER, MROYALTY, 
								OVERAGE_PER, OVERAGE, IND 
								FROM routes_det 
								WHERE ROUTES_DETID = $detid_change";

			if ($resultchange = $conn->query($sqldatechange)) {

				$row = $resultchange->fetch_assoc();

				$holliday_change = $row['HOLIDAY'];
				$cityid_change = $row['CITYID'];
				if (empty($cityid_change)) { $cityid_change = "NULL";}
				$repeat_change = $row['REPEAT'];
				$mileage_change = $row['MILEAGE'];
				$booknotes_change = $row['BOOK_NOTES'];
				$prodnotes_change = $row['PROD_NOTES'];
				$timezone_change = $row['TIME_ZONE'];
				$showtime_change = $row['SHOW_TIMES'];
				$perf_change = $row['PERF'];
				$venueid_change = $row['VENUEID'];
				if (empty($venueid_change)) { $venueid_change = "NULL";}
				$presenterid_change = $row['PRESENTERID'];
				if (empty($presenterid_change)) { $presenterid_change = "NULL";}
				$capacity_change = $row['CAPACITY'];
				$fixedgntee_change = $row['FIXED_GNTEE'];
				$royalty_change = $row['ROYALTY'];
				$backend_change = $row['BACKEND'];
				$breakeven_change = $row['BREAKEVEN'];
				$dealnotes_change = $row['DEAL_NOTES'];
				$estroyalty_change = $row['EST_ROYALTY'];
				$onsub_change = $row['ON_SUB'];
				$dateconf_change = $row['DATE_CONF'];
				$offer_change = $row['OFFER'];
				$pricescales_change = $row['PRICE_SCALES'];
				$expenses_change = $row['EXPENSES'];
				$dealmemo_change = $row['DEAL_MEMO'];
				$contract_change = $row['CONTRACT'];
				$grosspot_change = $row['GROSS_POT'];
				$spogrosspot_change = $row['SPO_GROSS_POT'];
				$substsales_change = $row['SUBS_TSALES'];
				$grouptsales_change = $row['GROUP_TSALES'];
				$singletsales_change = $row['SINGLE_TSALES'];
				$grosssales_change = $row['GROSS_SALES'];
				$ottexpenses_change = $row['OTT_EXPENSES'];
				$nagbor_change = $row['NAGBOR'];
				$plexpenses_change = $row['PL_EXPENSES'];
				$teexpenses_change = $row['TE_EXPENSES'];
				$eploss_change = $row['EP_LOSS'];
				$guarantee_change = $row['GUARANTEE'];
				$royaltyper_change = $row['ROYALTY_PER'];
				$mroyalty_change = $row['MROYALTY'];
				$overageper_change = $row['OVERAGE_PER'];
				$overage_change = $row['OVERAGE'];
				$ind_change = $row['IND'];

				//update the initial date with data of the final date
				$sqlUpdate = "UPDATE routes_det 
								SET HOLIDAY = $holliday_change, CITYID = $cityid_change, `REPEAT` = $repeat_change, 
									MILEAGE = $mileage_change, BOOK_NOTES = '$booknotes_change', 
									PROD_NOTES = '$prodnotes_change', TIME_ZONE = '$timezone_change', 
									SHOW_TIMES = '$showtime_change', PERF = $perf_change, VENUEID = $venueid_change, 
									PRESENTERID = $presenterid_change, CAPACITY = $capacity_change, 
									FIXED_GNTEE = $fixedgntee_change, ROYALTY = $royalty_change, 
									BACKEND = $backend_change, BREAKEVEN = $breakeven_change, 
									DEAL_NOTES = '$dealnotes_change', EST_ROYALTY = $estroyalty_change, 
									ON_SUB = $onsub_change, DATE_CONF = $dateconf_change, OFFER = $offer_change, 
									PRICE_SCALES = $pricescales_change, EXPENSES = $expenses_change, 
									DEAL_MEMO = $dealmemo_change, CONTRACT = $contract_change, 
									GROSS_POT = $grosspot_change, SPO_GROSS_POT = $spogrosspot_change, 
									SUBS_TSALES = $substsales_change, GROUP_TSALES = $grouptsales_change, 
									SINGLE_TSALES = $singletsales_change, GROSS_SALES = $grosssales_change, 
									OTT_EXPENSES = $ottexpenses_change, NAGBOR = $nagbor_change, 
									PL_EXPENSES = $plexpenses_change, TE_EXPENSES = $teexpenses_change, 
									EP_LOSS = $eploss_change, GUARANTEE = $guarantee_change, 
									ROYALTY_PER = $royaltyper_change, MROYALTY = $mroyalty_change, 
									OVERAGE_PER = $overageper_change, OVERAGE = $overage_change, 
									IND = $ind_change 
								WHERE ROUTES_DETID = $detid";

				if ($conn->query($sqlUpdate) === TRUE) {

					//update the final date with data of the initial date
					$sqlUpdate2 = "UPDATE routes_det 
							SET HOLIDAY = $holliday, CITYID = $cityid, `REPEAT` = $repeat, 
								MILEAGE = $mileage, BOOK_NOTES = '$booknotes', PROD_NOTES = '$prodnotes', 
								TIME_ZONE = '$timezone', SHOW_TIMES = '$showtime', PERF = $perf, VENUEID = $venueid, 
								PRESENTERID = $presenterid, CAPACITY = $capacity, FIXED_GNTEE = $fixedgntee, 
								ROYALTY = $royalty, BACKEND = $backend, BREAKEVEN = $breakeven, 
								DEAL_NOTES = '$dealnotes', 
								EST_ROYALTY = $estroyalty, ON_SUB = $onsub, DATE_CONF = $dateconf, OFFER = $offer, 
								PRICE_SCALES = $pricescales, EXPENSES = $expenses, DEAL_MEMO = $dealmemo, 
								CONTRACT = $contract, GROSS_POT = $grosspot, SPO_GROSS_POT = $spogrosspot, 
								SUBS_TSALES = $substsales, GROUP_TSALES = $grouptsales, 
								SINGLE_TSALES = $singletsales, 
								GROSS_SALES = $grosssales, OTT_EXPENSES = $ottexpenses, NAGBOR = $nagbor, 
								PL_EXPENSES = $plexpenses, TE_EXPENSES = $teexpenses, EP_LOSS = $eploss, 
								GUARANTEE = $guarantee, ROYALTY_PER = $royaltyper, MROYALTY = $mroyalty, 
								OVERAGE_PER = $overageper, OVERAGE = $overage, IND = $ind 
							WHERE ROUTES_DETID = $detid_change";

					if ($conn->query($sqlUpdate2) === TRUE) {

						echo "Record updated successfully";
					}else{

						echo "Error updating record: " . $conn->error;
					}
					
				}else{

					echo "Error updating record: " . $conn->error;
				}
			}
		}else{	//reset the initial date

			//update the final date with data of the initial date
			$sqlUpdate = "UPDATE routes_det 
							SET HOLIDAY = $holliday, CITYID = $cityid, `REPEAT` = $repeat, 
								MILEAGE = $mileage, BOOK_NOTES = '$booknotes', PROD_NOTES = '$prodnotes', 
								TIME_ZONE = '$timezone', SHOW_TIMES = '$showtime', PERF = $perf, VENUEID = $venueid, 
								PRESENTERID = $presenterid, CAPACITY = $capacity, FIXED_GNTEE = $fixedgntee, 
								ROYALTY = $royalty, BACKEND = $backend, BREAKEVEN = $breakeven, 
								DEAL_NOTES = '$dealnotes', 
								EST_ROYALTY = $estroyalty, ON_SUB = $onsub, DATE_CONF = $dateconf, OFFER = $offer, 
								PRICE_SCALES = $pricescales, EXPENSES = $expenses, DEAL_MEMO = $dealmemo, 
								CONTRACT = $contract, GROSS_POT = $grosspot, SPO_GROSS_POT = $spogrosspot, 
								SUBS_TSALES = $substsales, GROUP_TSALES = $grouptsales, 
								SINGLE_TSALES = $singletsales, 
								GROSS_SALES = $grosssales, OTT_EXPENSES = $ottexpenses, NAGBOR = $nagbor, 
								PL_EXPENSES = $plexpenses, TE_EXPENSES = $teexpenses, EP_LOSS = $eploss, 
								GUARANTEE = $guarantee, ROYALTY_PER = $royaltyper, MROYALTY = $mroyalty, 
								OVERAGE_PER = $overageper, OVERAGE = $overage, IND = $ind 
							WHERE ROUTES_DETID = $detid_change";

			if ($conn->query($sqlUpdate) === TRUE) {

				//reset initial date
				$sqlOrigin = "UPDATE routes_det 
								SET HOLIDAY = 0, CITYID = NULL, `REPEAT` = 0, 
									MILEAGE = 0.00, BOOK_NOTES = NULL, PROD_NOTES = NULL, 
									TIME_ZONE = NULL, SHOW_TIMES = NULL, PERF = 0, VENUEID = NULL, 
									PRESENTERID = NULL, CAPACITY = 0, FIXED_GNTEE = 0.00, 
									ROYALTY = 0.00, BACKEND = 0.00, BREAKEVEN = 0.00, 
									DEAL_NOTES = NULL, 
									EST_ROYALTY = 0.00, ON_SUB = 0, DATE_CONF = 0, OFFER = 0, 
									PRICE_SCALES = 0, EXPENSES = 0, DEAL_MEMO = 0, 
									CONTRACT = 0, GROSS_POT = 0.00, SPO_GROSS_POT = 0.00, 
									SUBS_TSALES = 0.00, GROUP_TSALES = 0.00, SINGLE_TSALES = 0.00, 
									GROSS_SALES = 0.00, OTT_EXPENSES = 0.00, NAGBOR = 0.00, 
									PL_EXPENSES = 0.00, TE_EXPENSES = 0.00, EP_LOSS = 0.00, 
									GUARANTEE = 0.00, ROYALTY_PER = 0.00, MROYALTY = 0.00, 
									OVERAGE_PER = 0.00, OVERAGE = 0.00, IND = 0  
								WHERE ROUTES_DETID = $detid";

				if ($conn->query($sqlOrigin) === TRUE) {

					echo "Record updated successfully";

				}else{

					echo "Error updating record: " . $conn->error;
				}

			}else{
				echo "Error updating record: " . $conn->error;
			}
		}

	} else {
	    echo "Error updating record: " . $conn->error;
	}

	echo "<script language=\"javascript\"type=\"text/javascript\">
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