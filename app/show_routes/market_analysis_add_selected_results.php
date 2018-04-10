<?php
require '../db/database_conn.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$mid = $_POST['maid'];
$mgrosspotential = $_POST['grosspotential'];
$msalespercentageofgrosspotential = $_POST['salespercentageofgrosspotential'];
$msubscriptionticketsales = $_POST['subscriptionticketsales'];
$mgroupticketsales = $_POST['groupticketsales'];
$msingleticketsales = $_POST['singleticketsales'];
$mgrosssales = $_POST['grosssales'];
$moffthetopexpenses = $_POST['offthetopexpenses'];
$mnagbor = $_POST['nagbor'];
$mpromoterslocalexpenses = $_POST['promoterslocalexpenses'];
$mtotalengagementexpenses = $_POST['totalengagementexpenses'];
$mengagementprofitloss = $_POST['engagementprofitloss'];
$mguarantee = $_POST['guarantee'];
$mroyaltypercentage = $_POST['royaltypercentage'];
$mroyalty = $_POST['royalty'];
$moveragepercentage = $_POST['overagepercentage'];
$moverage = $_POST['overage'];

$sql = "INSERT INTO proforma (id,gross_potential,sales_percentage_of_gross_potential,subscription_ticket_sales,group_ticket_sales,single_ticket_sales,gross_sales,
	    off_the_top_expenses,nagbor,promoters_local_expenses,total_engagement_expenses,engagement_profit_loss,guarantee,royalty_percentage,royalty,overage_percentage,overage)
		VALUES ($mid,$mgrosspotential,$msalespercentageofgrosspotential,$msubscriptionticketsales,$mgroupticketsales,$msingleticketsales,$mgrosssales,
		$moffthetopexpenses,$mnagbor,$mpromoterslocalexpenses,$mtotalengagementexpenses,$mengagementprofitloss,$mguarantee,$mroyaltypercentage,$mroyalty,$moveragepercentage,$moverage)";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
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