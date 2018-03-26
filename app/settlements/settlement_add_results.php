<?php
require '../db/database_conn.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	$showid = $_POST['show_name'];
	$venueid = $_POST['venue_name'];
	$cityid = $_POST['cityid'];

	$openingdate = $_POST['opening_date'];
	$closingdate = $_POST['closing_date'];
	$numberperformances = $_POST['number_performances'];
	$grosspotential = $_POST['gross_potential'];
	$actualgross = $_POST['actual_gross'];
	$ticketssold = $_POST['tickets_sold'];
	$ticketscompd = $_POST['tickets_compd'];
	$subscriptions = $_POST['subsc'];
	$subscriptions_sales = $_POST['subsc_sales'];	
	$nagbor = $_POST['nagbor'];
	$tax = $_POST['tax'];
	$subscriptioncomm = $_POST['subsc_com'];
	$phonecomm = $_POST['phone_com'];
	$internetcomm = $_POST['int_com'];
	$creditcardcomm = $_POST['cc_com'];
	$remotescomm = $_POST['remotes_com'];
	$groupsalescomm = $_POST['group_sales_com'];
	$overage = $_POST['overage'];
	$royality = $_POST['royality'];
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
	$guarantee = $_POST['guarantee'];

$sql = "INSERT INTO settlements (SettlementShowID,SettlementVENUEID,SettlementCITYID,SettlementOPENING_DATE,
  								 SettlementCLOSING_DATE,SettlementNUMBER_OF_PERFORMANCES,SettlementGROSS_POTENTIAL,
  								 SettlementACTUAL_GROSS,SettlementGROUP_SALES,SettlementSUBSCRIPTION_SALES,
  								 SettlementNAGBOR,SettlementTOTAL_FIXED_EXPENSE,SettlementTOTAL_DOCUMENTED_EXPENSE,
  								 SettlementTOTAL_PRESENTER_EXPENSE,SettlementGUARANTEE,SettlementROYALTY,SettlementOVERAGE)
				VALUES ($showid, $venueid, $cityid,'$openingdate','$closingdate',$numberperformances,
						$grosspotential, $actualgross, $groupsales, $subscriptions_sales, $nagbor,
						$totalfixedexpenses, $totaldocumentedexpense, $totalpresenterexpense, $guarantee, 
						$royality, $overage)";

if ($conn->query($sql) === TRUE) {

    $settlementid = $conn->insert_id;

    $sql2 = "INSERT INTO settlements_details (SettlementID, ShowID, OpeningDate, ClosingDate, NumberPerformances, 
    								 GrossPotential, ActualGross, TicketsSold, TicketsCompd, Subscriptions,
    								 Tax, SubscriptionComm, PhoneComm, InternetComm, CreditCardComm, RemotesComm, 
    								 GroupSalesComm, Overage, Advertising, InsuranceTicket, TotalTicketInsurance, 
    								 Catering, Catering2, StageHands, Musicians, WardrobeHair, TicketPrint, 
    								 TotalTicketPrint, OtherDocumentedExpense, TotalDocumentedExpense, ADAExpense, 
    								 BoxOffice, Cleaning, DirectMail, EquipmentRental, GroupSales, HousemanTD, 
    								 HouseStaff, LeagueFees, LicensesPermits, LimosAutos, Miscellaneous, 
    								 PresenterProfit, PoliceSecurity, Programs, PublicRelations, Rent, 
    								 Soundlights, TicketPrinting, Phones, OtherVariableExpenses, LocalFixedExpenses, 
    								 TotalFixedExpenses,TotalPresenterExpense,TotalRestorationCharge,Breakeven)
				VALUES ($settlementid, $showid, '$openingdate','$closingdate', $numberperformances, 
						$grosspotential, $actualgross, $ticketssold, $ticketscompd, 
						$subscriptions, $tax, $subscriptioncomm, $phonecomm, $internetcomm, $creditcardcomm, 
						$remotescomm, $groupsalescomm, $overage, $advertising, $insuranceticket, 
						$totalticketinsurance, $catering, $catering2, $stagehands, $musicians, $wardrobehair, 
						$ticketprint, $totalticketprint, $otherdocumentedexpense, $totaldocumentedexpense, 
						$adaexpense, $boxoffice, $cleaning, $directmail, $equipmentrental, $groupsales, 
						$housemantd, $housestaff, $leaguefees, $licensespermits, $limosautos, $miscellaneous, 
						$presenterprofit, $policesecurity, $programs, $publicrelations, $rent, $soundlights, 
						$ticketprinting, $phones, $othervariableexpenses, $localfixedexpenses, $totalfixedexpenses, 
						$totalpresenterexpense, $totalrestorationcharge, $breakeven)";
	if ($conn->query($sql2) === TRUE) {
		echo "Record Created successfully";
	}else{
		echo "Error Creating Detail: " . $conn->error;
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