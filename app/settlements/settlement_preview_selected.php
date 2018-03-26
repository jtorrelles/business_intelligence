<?php
require '../db/database_conn.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_GET['selectedid'])){

	$selectedid = $_GET['selectedid'];

  	$sql = "SELECT 	sd.SettlementDETAIL_ID, sd.ShowID, sw.ShowNAME, ve.VenueNAME, se.SettlementOPENING_DATE,
					se.SettlementCLOSING_DATE, sd.NumberPerformances, FORMAT(sd.GrossPotential,2) as GrossPotential,
					FORMAT(sd.ActualGross,2) as ActualGross, FORMAT(sd.TicketsSold,2) as TicketsSold,
					FORMAT(sd.TicketsCompd,2) as TicketsCompd, FORMAT(sd.Subscriptions,2) as Subscriptions,
					FORMAT(sd.Tax,2) as Tax, FORMAT(sd.SubscriptionComm,2) as SubscriptionComm,
					FORMAT(sd.PhoneComm,2) as PhoneComm, FORMAT(sd.InternetComm,2) as InternetComm,
					FORMAT(sd.CreditCardComm,2) as CreditCardComm, FORMAT(sd.RemotesComm,2) as RemotesComm,
					FORMAT(sd.GroupSalesComm,2) as GroupSalesComm, FORMAT(sd.Overage, 2) as Overage,
					FORMAT(sd.Advertising, 2) as Advertising, FORMAT(sd.InsuranceTicket, 2) as InsuranceTicket,
					FORMAT(sd.TotalTicketInsurance, 2) as TotalTicketInsurance, FORMAT(sd.Catering,2) as Catering,
					FORMAT(sd.Catering2,2) as Catering2, FORMAT(sd.StageHands,2) as StageHands,
					FORMAT(sd.Musicians,2) as Musicians, FORMAT(sd.WardrobeHair,2) as WardrobeHair,
					FORMAT(sd.TicketPrint, 2) as TicketPrint, FORMAT(sd.TotalTicketPrint, 2) as TotalTicketPrint,
					FORMAT(sd.OtherDocumentedExpense, 2) as OtherDocumentedExpense, FORMAT(sd.TotalDocumentedExpense, 2) as TotalDocumentedExpense,
					FORMAT(sd.ADAExpense, 2) as ADAExpense, FORMAT(sd.BoxOffice,2) as BoxOffice,
					FORMAT(sd.Cleaning,2) as Cleaning, FORMAT(sd.DirectMail, 2) as DirectMail,
					FORMAT(sd.EquipmentRental, 2) as EquipmentRental, FORMAT(sd.GroupSales, 2) as GroupSales,
					FORMAT(sd.HousemanTD, 2) as HousemanTD, FORMAT(sd.HouseStaff, 2) as HouseStaff,
					FORMAT(sd.LeagueFees, 2) as LeagueFees, FORMAT(sd.LicensesPermits, 2) as LicensesPermits,
					FORMAT(sd.LimosAutos, 2) as LimosAutos, FORMAT(sd.Miscellaneous, 2) as Miscellaneous,
					FORMAT(sd.PresenterProfit, 2) as PresenterProfit, FORMAT(sd.PoliceSecurity, 2) as PoliceSecurity,
					FORMAT(sd.Programs, 2) as Programs, FORMAT(sd.PublicRelations, 2) as PublicRelations,
					FORMAT(sd.Rent, 2) as Rent, FORMAT(sd.Soundlights, 2) as Soundlights,
					FORMAT(sd.TicketPrinting, 2) as TicketPrinting, FORMAT(sd.Phones,2) as Phones,
					FORMAT(sd.OtherVariableExpenses,2) as OtherVariableExpenses,
					FORMAT(sd.LocalFixedExpenses,2) as LocalFixedExpenses, FORMAT(sd.TotalFixedExpenses,2) as TotalFixedExpenses,
					FORMAT(sd.TotalPresenterExpense, 2) as TotalPresenterExpense, FORMAT(sd.TotalRestorationCharge,2) as TotalRestorationCharge,
					FORMAT(sd.Breakeven,2) as Breakeven, 
					ci.`name` as city, 
					st.`name` as state, 
					co.sortname as country
			FROM settlements_details sd, settlements se, shows sw, venues ve, cities ci, states st, countries co 
			WHERE sd.SettlementID = $selectedid 
			AND sd.SettlementID = se.SettlementID 
			AND se.SettlementShowID = sw.ShowID 
			AND se.SettlementVENUEID = ve.VenueID 
			AND se.SettlementCITYID = ci.id 
			AND ci.state_id = st.id 
			AND st.country_id = co.id";

	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
	echo "<h1 align=center>SETTLEMENT DETAILS</h1>";
	echo "<h2 align=center>".$row['ShowNAME']."<br>".$row['VenueNAME']."<br>".$row['city'].", ".$row['state'].", ".$row['country']."</h2>";
	echo "<table>";
	echo "<tr><td>Opening Date:</td><td>".$row['SettlementOPENING_DATE']."</td></tr>
	<tr><td>Closing Date:</td><td>".$row['SettlementCLOSING_DATE']."</td></tr>
	<tr><td>Number of Performances:</td><td>".$row['NumberPerformances']."</td></tr>
	<tr><td>Gross Potential:</td><td>".$row['GrossPotential']."</td></tr>
	<tr><td>Actual Gross:</td><td>".$row['ActualGross']."</td></tr>
	<tr><td>Tickets Sold:</td><td>".$row['TicketsSold']."</td></tr>
	<tr><td>Tickets Compd:</td><td>".$row['TicketsCompd']."</td></tr>
	<tr><td>Subscription:</td><td>".$row['Subscriptions']."</td></tr>
	<tr><td>Tax:</td><td>".$row['Tax']."</td></tr>
	<tr><td>Subscription Commission:</td><td>".$row['SubscriptionComm']."</td></tr>
	<tr><td>Phone Commission:</td><td>".$row['PhoneComm']."</td></tr>
	<tr><td>Internet Commission:</td><td>".$row['InternetComm']."</td></tr>
	<tr><td>Credit Card Commission:</td><td>".$row['CreditCardComm']."</td></tr>
	<tr><td>Remotes Commission:</td><td>".$row['RemotesComm']."</td></tr>
	<tr><td>Group Sales Commission:</td><td>".$row['GroupSalesComm']."</td></tr>
	<tr><td>Overage:</td><td>".$row['Overage']."</td></tr>
	<tr><td>Advertising:</td><td>".$row['Advertising']."</td></tr>
	<tr><td>Ticket Insurance:</td><td>".$row['InsuranceTicket']."</td></tr>
	<tr><td>Total Ticket Insurance:</td><td>".$row['TotalTicketInsurance']."</td></tr>
	<tr><td>Catering:</td><td>".$row['Catering']."</td></tr>
	<tr><td>Catering (2):</td><td>".$row['Catering2']."</td></tr>
	<tr><td>Stage Hands:</td><td>".$row['StageHands']."</td></tr>
	<tr><td>Musicians:</td><td>".$row['Musicians']."</td></tr>
	<tr><td>Wardrobe / Hair:</td><td>".$row['WardrobeHair']."</td></tr>
	<tr><td>Ticket Printing:</td><td>".$row['TicketPrint']."</td></tr>
	<tr><td>Total Ticket Printing:</td><td>".$row['TotalTicketPrint']."</td></tr>
	<tr><td>Other Documented Expense:</td><td>".$row['OtherDocumentedExpense']."</td></tr>
	<tr><td>Total Documented Expense:</td><td>".$row['TotalDocumentedExpense']."</td></tr>
	<tr><td>ADA Expense:</td><td>".$row['ADAExpense']."</td></tr>
	<tr><td>Box Office:</td><td>".$row['BoxOffice']."</td></tr>
	<tr><td>Cleaning:</td><td>".$row['Cleaning']."</td></tr>
	<tr><td>Direct Mail:</td><td>".$row['DirectMail']."</td></tr>
	<tr><td>Equipment Rental:</td><td>".$row['EquipmentRental']."</td></tr>
	<tr><td>Group Sales:</td><td>".$row['GroupSales']."</td></tr>
	<tr><td>Houseman TD:</td><td>".$row['HousemanTD']."</td></tr>
	<tr><td>House Staff:</td><td>".$row['HouseStaff']."</td></tr>
	<tr><td>League Fees:</td><td>".$row['LeagueFees']."</td></tr>
	<tr><td>Licenses / Permits:</td><td>".$row['LicensesPermits']."</td></tr>
	<tr><td>Limos / Autos:</td><td>".$row['LimosAutos']."</td></tr>
	<tr><td>Miscellaneous:</td><td>".$row['Miscellaneous']."</td></tr>
	<tr><td>Presenter Profit:</td><td>".$row['PresenterProfit']."</td></tr>
	<tr><td>Police / Security:</td><td>".$row['PoliceSecurity']."</td></tr>
	<tr><td>Programs:</td><td>".$row['Programs']."</td></tr>
	<tr><td>Public Relations:</td><td>".$row['PublicRelations']."</td></tr>
	<tr><td>Rent:</td><td>".$row['Rent']."</td></tr>
	<tr><td>Sound / Lights:</td><td>".$row['Soundlights']."</td></tr>
	<tr><td>Ticket Printing:</td><td>".$row['TicketPrinting']."</td></tr>
	<tr><td>Phones:</td><td>".$row['Phones']."</td></tr>
	<tr><td>Other Variable Expenses:</td><td>".$row['OtherVariableExpenses']."</td></tr>
	<tr><td>Local Fixed Expenses:</td><td>".$row['LocalFixedExpenses']."</td></tr>
	<tr><td>Total Fixed Expenses:</td><td>".$row['TotalFixedExpenses']."</td></tr>
	<tr><td>Total Presenter Expense:</td><td>".$row['TotalPresenterExpense']."</td></tr>
	<tr><td>Total Restoration Charge:</td><td>".$row['TotalRestorationCharge']."</td></tr>
	<tr><td>Breakeven:</td><td>".$row['Breakeven']."</td></tr>
	";}
	echo "</table>";
}
else {
  echo "failed";
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