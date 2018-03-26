<?php
require '../db/database_conn.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$showid = $_POST['show_name'];
$presenterid = $_POST['presenter_name'];
$venueid = $_POST['venue_name'];
$cityid = $_POST['cityid'];

$openingdate = $_POST['opening_date'];
$closingdate = $_POST['closing_date'];
$numberofperfomance = $_POST['number_of_performances'];
$gross = $_POST['gross_potential'];
$tax = $_POST['tax'];
$guarantee = $_POST['guarantee'];

$group = $_POST['group_commission'];
$subscription = $_POST['subscription_commission'];
$phone = $_POST['phone_commission'];
$internet = $_POST['internet_commission'];
$creditcard = $_POST['credit_card_commission'];
$remotes = $_POST['remotes_commission'];

$totalfixed = $_POST['fixed_expense'];
$totaldocumented = $_POST['documented_expense'];
$totalpresenter = $_POST['total_presenter_expense'];

$sql = "INSERT INTO contracts (showid, contractpresenterid, contractvenueid, contractcityid, contractopening_date, contractclosing_date, contractnumber_of_performances, contractgross_potential, contracttax,
	contractguarantee,contractgroup_comission, contractsubscription_comission, contractphone_comission, 
	contractinternet_comission, contractcredit_card_comission, contractremotes_comission, 
	ContractTOTAL_FIXED_EXPENSE, ContractTOTAL_DOCUMENTED_EXPENSE, ContractTOTAL_PRESENTER_EXPENSES)
		VALUES 
	($showid,$presenterid,$venueid,$cityid,'$openingdate','$closingdate','$numberofperfomance','$gross',
	 '$tax','$guarantee','$group','$subscription','$phone','$internet','$creditcard','$remotes','$totalfixed',
	 '$totaldocumented','$totalpresenter')";

if ($conn->query($sql) === TRUE) {
    echo "Record Created successfully";
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