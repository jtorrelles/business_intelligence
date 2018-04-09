 <?php
require '../db/database_conn.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = $_POST['id'];
$opening = $_POST['opening_date'];
$closing = $_POST['closing_date'];
$performances = $_POST['number_of_performances'];
$gross_potential = $_POST['gross_potential'];
$tax = $_POST['tax'];
$guarantee = $_POST['guarantee'];
$group_com = $_POST['group_commission'];
$subsc_com = $_POST['subscription_commission'];
$phone_com = $_POST['phone_commission'];
$int_com = $_POST['internet_commission'];
$cc_com = $_POST['credit_card_commission'];
$rem_com = $_POST['remotes_commission'];
$fx_com = $_POST['fixed_expense'];
$doc_com = $_POST['documented_expense'];
$pre_com = $_POST['total_presenter_expense'];
$showid = $_POST['show_name'];
$venueid = $_POST['venue_name'];
$presenterid = $_POST['presenter_name'];
$cityid = $_POST['cityid'];

$sql = "UPDATE contracts SET 
		ShowID = $showid, 
		ContractPRESENTERID = $presenterid, 
		ContractVENUEID = $venueid, 
		ContractCITYID = $cityid, 
		ContractOPENING_DATE = '$opening',
		ContractCLOSING_DATE = '$closing',
		ContractNUMBER_OF_PERFORMANCES = '$performances',
		ContractGROSS_POTENTIAL = '$gross_potential',
		ContractTAX = '$tax',
		ContractGUARANTEE = '$guarantee',
		ContractGROUP_COMISSION = '$group_com',
		ContractSUBSCRIPTION_COMISSION = '$subsc_com',
		ContractPHONE_COMISSION = '$phone_com', 
		ContractINTERNET_COMISSION = '$int_com',
		ContractCREDIT_CARD_COMISSION = '$cc_com',
		ContractREMOTES_COMISSION = '$rem_com',
		ContractTOTAL_FIXED_EXPENSE = '$fx_com',
		ContractTOTAL_DOCUMENTED_EXPENSE = '$doc_com', 
		ContractTOTAL_PRESENTER_EXPENSES = '$pre_com' 
		WHERE contractid = $id";

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