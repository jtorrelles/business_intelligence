<?php
require '../db/database_conn.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<h1>Modify An Existing Contract:</h1>";
if(isset($_GET['selectedid'])){
  $selectedid = $_GET['selectedid'];

  	$sql = "SELECT co.ContractID as contractID, 
				sw.ShowID as contractSHOW_NAME,
				pr.PresenterID as contractPRESENTER_NAME,
				ve.VenueID as contractVENUE_NAME,
				ci.id as contractCITY, 
				st.id as contractSTATE, 
				contractOPENING_DATE as OPENING,
				contractCLOSING_DATE as CLOSING,
				ContractNUMBER_OF_PERFORMANCES as PERFORMANCE,
				ContractGROSS_POTENTIAL as GROSS,
				ContractTAX as TAX,
				ContractGUARANTEE as GUARANTEE,
				ContractGROUP_COMISSION as GROUP_COM,
				ContractSUBSCRIPTION_COMISSION as SUBSC_COM,
				ContractPHONE_COMISSION as PHONE_COM,
				ContractINTERNET_COMISSION as INT_COM,
				ContractCREDIT_CARD_COMISSION as CC_COM,
				ContractREMOTES_COMISSION as REM_COM,
				ContractTOTAL_FIXED_EXPENSE as FIX_COM,  
				ContractTOTAL_DOCUMENTED_EXPENSE as DOC_COM,  
				ContractTOTAL_PRESENTER_EXPENSES  as PRE_COM
		FROM contracts co, cities ci, states st, countries ct, shows sw, presenters pr, venues ve  
		WHERE co.ContractID = $selectedid  
		AND co.showid = sw.ShowID 
		AND co.ContractPRESENTERID = pr.PresenterID 
		AND co.ContractVENUEID = ve.VenueID 
		AND co.ContractCITYID = ci.id 
		AND ci.state_id = st.id 
		AND st.country_id = ct.id";

	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {

		echo "<form action=\"contract_modify_results.php\" method=\"POST\">";
		echo "<table>
				<tr>
					<td><b>Contract ID:</b></td>
					<td><input style=\"background-color: lightgrey;\" readonly type='text' name='id_contract' value='".$row['contractID']."'>This field cannot be modified</td>
				</tr>	
				<tr>
					<td colspan=2><h3>PERFORMANCE DETAIL</h3></td>
					<td></td>
				</tr>
				<tr>
					<td>Opening Date:</td>
					<td><input type=\"date\" name=\"opening_date\" value='".$row['OPENING']."'></td></tr>
					<td>Closing Date:</td>
					<td><input type=\"date\" name=\"closing_date\" value='".$row['CLOSING']."'></td></tr>
					<td>Number of Performances:</td>
					<td><input type=\"number\" name=\"number_of_performances\" value='".$row['PERFORMANCE']."' max=99 min=1 step=1></td></tr>
					<td>Gross Potential:</td>
					<td><input type=\"number\" name=\"gross_potential\" value='".$row['GROSS']."' step=0.01></td></tr>
					<td>Tax:</td>
					<td><input type=\"number\" name=\"tax\" value='".$row['TAX']."' step=0.01></td></tr>
					<td>Guarantee:</td>
					<td><input type=\"number\" name=\"guarantee\" value='".$row['GUARANTEE']."' step=0.01></td></tr>
				</tr>
				<tr>
					<td colspan=2><h3>COMMISSIONS (%)</h3></td>
					<td></td>
				</tr>
				<tr>
					<td>Group:</td>
					<td><input type=\"number\" name=\"group_commission\" value='".$row['GROUP_COM']."' max=99 min=1 step=1></td></tr>
					<td>Subscription:</td>
					<td><input type=\"number\" name=\"subscription_commission\" value='".$row['SUBSC_COM']."' max=99 min=1></td></tr>
					<td>Phone:</td>
					<td><input type=\"number\" name=\"phone_commission\" value='".$row['PHONE_COM']."' max=99 min=1 step=1></td></tr>
					<td>Internet:</td>
					<td><input type=\"number\" name=\"internet_commission\" value='".$row['INT_COM']."' max=99 min=1 step=1></td></tr>
					<td>Credit Card:</td>
					<td><input type=\"number\" name=\"credit_card_commission\" value='".$row['CC_COM']."' max=99 min=1 step=1></td></tr>
					<td>Remotes:</td>
					<td><input type=\"number\" name=\"remotes_commission\" value='".$row['REM_COM']."' max=99 min=1 step=1></td></tr>
				</tr>
				<tr>
					<td colspan=2><h3>EXPENSES</h3></td>
					<td></td>
				</tr>
				<tr>
					<td>Total Fixed Expense:</td>
					<td><input type=\"number\" name=\"fixed_expense\" value='".$row['FIX_COM']."' step=0.01></td></tr>
					<td>Total Documented Expense:</td>
					<td><input type=\"number\" name=\"documented_expense\" value='".$row['DOC_COM']."' step=0.01></td></tr>
					<td>Total Presenter Expenses:</td>
					<td><input type=\"number\" name=\"total_presenter_expense\" value='".$row['PRE_COM']."' step=0.01></td></tr>
				</tr>
			</table>";
		echo "<p><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
		echo "</form>";

	} 
}
else {
  echo "failed";
}
$conn->close();
include '../footer.html';
?>
