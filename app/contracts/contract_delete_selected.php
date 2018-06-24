<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header_nologout.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<h1 align=center style=\"color: red;\">WARNING: YOU ARE ABOUT TO DELETE THIS CONTRACT</h1>";
if(isset($_GET['selectedid'])){
  $selectedid = $_GET['selectedid'];

  	$sql = "SELECT 	ContractID,
           			sw.ShowID,
           			p.PresenterNAME as ContractPRESENTER,
           			v.VenueNAME as ContractVENUE,
				   	ci.`name` as ContractCITY,
					s.`name` as ContractSTATE,
					co.`name` as ContractCOUNTRY,
				   	DATE_FORMAT(ContractOPENING_DATE,'%m/%d/%Y') as ContractOPENING_DATE,
				   	DATE_FORMAT(ContractCLOSING_DATE,'%m/%d/%Y') as ContractCLOSING_DATE,
				   	ContractNUMBER_OF_PERFORMANCES,
				   	FORMAT(ContractGROSS_POTENTIAL,2) as GROSS,
				   	FORMAT(ContractTAX,2) as TAX,
				   	FORMAT(ContractGUARANTEE,2) as GUARANTEE,
					FORMAT(ContractVARIABLE_GUARANTEE,2) as VARIABLE_GUARANTEE,
					FORMAT(ContractPRODUCER_OVERAGES,2) as PRODUCER_OVERAGES,
					FORMAT(ContractSALES_TAX_1,2) as SALES_TAX_1,
					FORMAT(ContractSALES_TAX_2,2) as SALES_TAX_2,
					FORMAT(ContractFACILITY_FEES_1,2) as FACILITY_FEES_1,
					FORMAT(ContractFACILITY_FEES_2,2) as FACILITY_FEES_2,
				   	FORMAT(ContractGROUP_COMISSION,2) as ContractGROUP_COMISSION,
				   	FORMAT(ContractSUBSCRIPTION_COMISSION, 2) as ContractSUBSCRIPTION_COMISSION,  
				   	FORMAT(ContractPHONE_COMISSION,2) as ContractPHONE_COMISSION,
				   	FORMAT(ContractINTERNET_COMISSION, 2) as ContractINTERNET_COMISSION,
				   	FORMAT(ContractCREDIT_CARD_COMISSION,2) as ContractCREDIT_CARD_COMISSION,
				   	FORMAT(ContractREMOTES_COMISSION, 2) as ContractREMOTES_COMISSION,
				   	FORMAT(ContractTOTAL_FIXED_EXPENSE, 2) as ContractTOTAL_FIXED_EXPENSE,
				   	FORMAT(ContractTOTAL_DOCUMENTED_EXPENSE,2) as ContractTOTAL_DOCUMENTED_EXPENSE, 
				   	FORMAT(ContractTOTAL_PRESENTER_EXPENSES,2) as ContractTOTAL_PRESENTER_EXPENSES,
					ContractNOTES
			FROM contracts c, shows sw, venues v, presenters p, cities ci, states s, countries co 
			WHERE ContractID = $selectedid 
			AND c.ContractVENUEID = v.VenueID 
			AND c.ContractPRESENTERID = p.PresenterID 
			AND c.ShowID = sw.ShowID 
			AND c.ContractCITYID = ci.id 
			AND ci.state_id = s.id 
			AND s.country_id = co.id";

	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
	echo "<form action=\"contract_delete_selected_results.php\" method=\"POST\">";
		echo "<table>
				<tr>
					<td><b>Contract ID:</b></td>
					<td><input style=\"background-color: lightgrey;\" readonly type='text' name='id_contract' value='".$row['ContractID']."'></td>
				</tr>	
				<tr>
					<td colspan=2><h3>PERFORMANCE DETAIL</h3></td>
					<td></td>
				</tr>
				<tr>
					<td>Opening Date:</td>
					<td>".$row['ContractOPENING_DATE']."</td></tr>
					<td>Closing Date:</td>
					<td>".$row['ContractCLOSING_DATE']."</td></tr>
					<td>Number of Performances:</td>
					<td>".$row['ContractNUMBER_OF_PERFORMANCES']."</td></tr>
					<td>Gross Potential:</td>
					<td>".$row['GROSS']."</td></tr>
					<td>Withholding Tax:</td>
					<td>".$row['TAX']."</td></tr>
					<td>Guarantee:</td>
					<td>".$row['GUARANTEE']."</td></tr>
					<td>Variable Guarantee:</td>
					<td>".$row['VARIABLE_GUARANTEE']."</td></tr>
					<td>Producer Overages:</td>
					<td>".$row['PRODUCER_OVERAGES']."</td></tr>
					<td>Sales Tax 1:</td>
					<td>".$row['SALES_TAX_1']."</td></tr>
					<td>Sales Tax 2:</td>
					<td>".$row['SALES_TAX_2']."</td></tr>
					<td>Facility Fees 1:</td>
					<td>".$row['FACILITY_FEES_1']."</td></tr>
					<td>Facility Fees 2:</td>
					<td>".$row['FACILITY_FEES_2']."</td></tr>					
				</tr>
				<tr>
					<td colspan=2><h3>COMMISSIONS (%)</h3></td>
					<td></td>
				</tr>
				<tr>
					<td>Group:</td>
					<td>".$row['ContractGROUP_COMISSION']."</td></tr>
					<td>Subscription:</td>
					<td>".$row['ContractSUBSCRIPTION_COMISSION']."</td></tr>
					<td>Phone:</td>
					<td>".$row['ContractPHONE_COMISSION']."</td></tr>
					<td>Internet:</td>
					<td>".$row['ContractINTERNET_COMISSION']."</td></tr>
					<td>Credit Card:</td>
					<td>".$row['ContractCREDIT_CARD_COMISSION']."</td></tr>
					<td>Remotes:</td>
					<td>".$row['ContractREMOTES_COMISSION']."</td></tr>
				</tr>
				<tr>
					<td colspan=2><h3>EXPENSES</h3></td>
					<td></td>
				</tr>
				<tr>
					<td>Total Fixed Expense:</td>
					<td>".$row['ContractTOTAL_FIXED_EXPENSE']."</td></tr>
					<td>Total Documented Expense:</td>
					<td>".$row['ContractTOTAL_DOCUMENTED_EXPENSE']."</td></tr>
					<td>Total Presenter Expenses:</td>
					<td>".$row['ContractTOTAL_PRESENTER_EXPENSES']."</td></tr>
				</tr>
				<tr>
					<td colspan=2><h3>ADDITIONAL INFO</h3></td>
					<td></td>
				</tr>
				<tr>
					<td>Notes:</td>
					<td>".$row['ContractNOTES']."</td></tr>					
			</table>";

	echo "<p style=\"text-align:center\"><input type=\"submit\" name=\"modify\" value=\"DELETE\"></p>";
	echo "</form>";
	} 
}
else {
  echo "failed";
}
$conn->close();
include '../footer.html';
?>
