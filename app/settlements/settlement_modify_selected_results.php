<?php
require '../db/database_conn.php';
include '../header.html';

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$settlementid = $_POST['id'];
	$showid = $_POST['show_name'];
	$venueid = $_POST['venue_name'];
	$cityid = $_POST['city'];
	$openingdate = $_POST['opening_date'];
	$closingdate = $_POST['closing_date'];
	$numberperformances = $_POST['number_performances'];
	$grosspotential = $_POST['gross_potential'];
	$actualgross = $_POST['actual_gross'];
	$ticketssold = $_POST['tickets_sold'];
	$ticketscompd = $_POST['tickets_compd'];
	$subscriptions = $_POST['subsc'];
	$tax = $_POST['tax'];
	$subscriptioncomm = $_POST['subsc_com'];
	$phonecomm = $_POST['phone_com'];
	$internetcomm = $_POST['int_com'];
	$creditcardcomm = $_POST['cc_com'];
	$remotescomm = $_POST['remotes_com'];
	$groupsalescomm = $_POST['group_sales_com'];
	$overage = $_POST['overage'];
	$advertising = $_POST['advertising'];
	$insuranceticket = $_POST['ticket_insurance'];
	$totalticketinsurance = $_POST['total_ticket_insurance'];
	$catering = $_POST['catering'];
	$catering2 = $_POST['catering2'];
	$stagehands = $_POST['stage_hands'];
	$musicians = $_POST['musicians'];
	$wardrobehair = $_POST['wardrobe_hair'];
	$ticketprint = $_POST['ticket_print'];
	$totalticketprint = $_POST['total_ticket_print'];
	$otherdocumentedexpense = $_POST['other_doc'];
	$totaldocumentedexpense = $_POST['total_doc'];
	$adaexpense = $_POST['ada_expenses'];
	$boxoffice = $_POST['box_office'];
	$cleaning = $_POST['cleaning'];
	$directmail = $_POST['direct_mail'];
	$equipmentrental = $_POST['equipment_rental'];
	$groupsales = $_POST['group_sales'];
	$housemantd = $_POST['houseman_td'];
	$housestaff = $_POST['house_staff'];
	$leaguefees = $_POST['league_fees'];
	$licensespermits = $_POST['licenses_permits'];
	$limosautos = $_POST['limos_autos'];
	$miscellaneous = $_POST['miscellaneous'];
	$presenterprofit = $_POST['presenter_profit'];
	$policesecurity = $_POST['police_security'];
	$programs = $_POST['programs'];
	$publicrelations = $_POST['public_relations'];
	$rent = $_POST['rent'];
	$soundlights = $_POST['sound_lights'];
	$ticketprinting = $_POST['ticket_printing'];
	$phones = $_POST['phones'];
	$othervariableexpenses = $_POST['other_expenses'];
	$localfixedexpenses = $_POST['local_fixed_expenses'];
	$totalfixedexpenses = $_POST['total_fixed_expenses'];
	$totalpresenterexpense = $_POST['presenter_expenses'];
	$totalrestorationcharge = $_POST['restoration_charge'];
	$breakeven = $_POST['breakeven'];

$sql = "UPDATE settlements_details SET 
			OpeningDate = '$openingdate',
			ClosingDate = '$closingdate',
			NumberPerformances = '$numberperformances', GrossPotential = $grosspotential,
			ActualGross = $actualgross, TicketsSold = $ticketssold,
			TicketsCompd = $ticketscompd, Subscriptions = $subscriptions,
			Tax = $tax, SubscriptionComm = $subscriptioncomm,
			PhoneComm = $phonecomm, InternetComm = $internetcomm,
			CreditCardComm = $creditcardcomm, RemotesComm = $remotescomm,
			GroupSalesComm = $groupsalescomm, Overage = $overage,
			Advertising = $advertising, InsuranceTicket = $insuranceticket,
			TotalTicketInsurance = $totalticketinsurance, Catering = $catering,
			Catering2 = $catering2, StageHands = $stagehands,
			Musicians = $musicians, WardrobeHair = $wardrobehair,
			TicketPrint = $ticketprint, TotalTicketPrint = $totalticketprint,
			OtherDocumentedExpense = $otherdocumentedexpense, TotalDocumentedExpense = $totaldocumentedexpense,
			ADAExpense = $adaexpense, BoxOffice = $boxoffice, Cleaning = $cleaning,
			DirectMail = $directmail, EquipmentRental = $equipmentrental, GroupSales = $groupsales,
			HousemanTD = $housemantd, HouseStaff = $housestaff, LeagueFees = $leaguefees,
			LicensesPermits = $licensespermits, LimosAutos = $limosautos, Miscellaneous = $miscellaneous,
			PresenterProfit = $presenterprofit, PoliceSecurity = $policesecurity, Programs = $programs,
			PublicRelations = $publicrelations, Rent = $rent, Soundlights = $soundlights,
			TicketPrinting = $ticketprinting, Phones = $phones, OtherVariableExpenses = $othervariableexpenses,
			LocalFixedExpenses = $localfixedexpenses, TotalFixedExpenses = $totalfixedexpenses,
			TotalPresenterExpense = $totalpresenterexpense, TotalRestorationCharge = $totalrestorationcharge,
			Breakeven = $breakeven
	   	WHERE SettlementID = $settlementid";

	if ($conn->query($sql) === TRUE) {

		$sql2 = "UPDATE settlements SET 
					SettlementCITYID = $cityid, 
					SettlementShowID = $showid, 
					SettlementVENUEID = $venueid, 
					SettlementOPENING_DATE = '$openingdate',
  					SettlementCLOSING_DATE = '$closingdate',
  					SettlementNUMBER_OF_PERFORMANCES = '$numberperformances',
  					SettlementGROSS_POTENTIAL = $grosspotential,
  					SettlementACTUAL_GROSS = $actualgross,
  					SettlementGROUP_SALES = $groupsales,
  					SettlementTOTAL_FIXED_EXPENSE = $totalfixedexpenses,
  					SettlementTOTAL_DOCUMENTED_EXPENSE = $totaldocumentedexpense,
  					SettlementTOTAL_PRESENTER_EXPENSE = $totalpresenterexpense 
				WHERE SettlementID = $settlementid";

		if($conn->query($sql2) === TRUE){
			echo "<p>Settlement Modified Successfully!</p>";
		}else{
			echo "Error modifying record: " . $conn->error;
		}
	    
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