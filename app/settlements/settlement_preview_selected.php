<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header_nologout.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['selectedid'])){

	$selectedid = $_GET['selectedid'];

	$sql = "SELECT 	se.ID, se.SHOWID, sw.ShowNAME, se.PresenterID, pr.PresenterNAME, se.CITYID, se.VENUEID, ve.VenueNAME, 
					DATE_FORMAT(OPENINGDATE,'%m/%d/%Y') AS OPENINGDATE, 
					DATE_FORMAT(CLOSINGDATE,'%m/%d/%Y') AS CLOSINGDATE, 
					DROPCOUNT, PAIDATTENDANCE, COMPS, TOTALATTENDANCE, 
					CAPACITY, GROSSSUBSCRIPTIONSALES, GROSSPHONESALES, GROSSINTERNETSALES,
					GROSSCREDITCARDSALES, GROSSREMOTEOUTLETSALES, GROSSSINGLETIX, GROSSGROUPSALES1,
					GROSSGROUPSALES2, GROSSGOLDSTARPERCENTAGE, GROSSGROUPONPERCENTAGE,
					GROSSTRAVELOOPERCENTAGE, GROSSLIVINGSOCIALPERCENTAGE, GROSSOTHERPERCENTAGE,
					GROSSOTHERAMOUNT, TTLSUBDISCOUNT, TTLGROUPDISCOUNT1, TTLGROUPDISCOUNT2,
					TOTALDISCOUNTS, TTLCOMPTICKETCOST, DEMANDPRICING, NUMBEROFPERFORMANCES,
					TOPTICKETPRICE, USCANADIANEXCHANGERATE, GROSSBOXOFFICEPOTENTIAL,
					GROSSBOXOFFICERECEIPTS, GROSSBOXOFFICEPERCENTAGEOFPOTENTIAL,
					TAX1PERCENTAGE, TAX1AMOUNT, TAX2PERCENTAGE, TAX2AMOUNT, FACILITYPERCENTAGE,
					FACILITYAMOUNT, SUBSCRIPTIONSALESCOMMPERCENTAGE, SUBSCRIPTIONSALESCOMMAMOUNT,
					PHONESALESCOMMPERCENTAGE, PHONESALESCOMMAMOUNT,
					INTERNETSALESCOMMPERCENTAGE, INTERNETSALESCOMMAMOUNT,
					CREDITCARDSALESCOMMPERCENTAGE, CREDITCARDSALESCOMMAMOUNT,
					REMOTESALESCOMMPERCENTAGE, REMOTESALESCOMMAMOUNT,
					SINGLETIXPERCENTAGE, SINGLETIXAMOUNT,
					GROUPSALESCOMM1PERCENTAGE, GROUPSALESCOMM1AMOUNT,
					GROUPSALESCOMM2PERCENTAGE, GROUPSALESCOMM2AMOUNT,
					GOLDSTARPERCENTAGE, GOLDSTARAMOUNT,
					GROUPONPERCENTAGE, GROUPONAMOUNT,
					TRAVELZOOPERCENTAGE, TRAVELZOOAMOUNT,
					LIVINGSOCIALPERCENTAGE, LIVINGSOCIALAMOUNT,
					OTHERAPERCENTAGE, OTHERAAMOUNT,
					OTHERBPERCENTAGE, OTHERBAMOUNT,
					TOTALALLOWABLEBOEXPENSES, DEDUCTIONSOFGBOR, NAGBOR, NETCOMPANYROYALTY,
					TAXWITHHELDATSOURCE, TOTALCOMPANYROYALTY, TOTALCOMPANYGUARANTEE,
					LESSOTHERDEDUCTION, INSURANCEPERTICKET, TICKETPRINTING1PERTICKET,
					ADVERTISINGBUDGETED, ADVERTISINGACTUAL,
					STAGEHANDSLOAINBUDGETED, STAGEHANDSLOAINACTUAL, STAGEHANDSLOADOUTBUDGETED,
					STAGEHANDSLOADOUTACTUAL, STAGEHANDSRUNNINGBUDGETED, STAGEHANDSRUNNINGACTUAL,
					WARDROBELOADINBUDGETED, WARDROBELOADINACTUAL, WARDROBELOADOUTBUDGETED,
					WARDROBELOADOUTACTUAL, WARDROBERUNNINGBUDGETED, WARDROBERUNNINGACTUAL,
					LABORCATERINGBUDGETED, LABORCATERINGACTUAL,
					MUSICIANSBUDGETED, MUSICIANSACTUAL,
					INSURANCEBUDGETED, INSURANCEACTUAL,
					TICKETPRINTING1BUDGETED, TICKETPRINTING1ACTUAL,
					OTHERCBUDGETED, OTHERCACTUAL,
					SUBTOTALVARIABLEEXPENSEBUDGETED, SUBTOTALVARIABLEEXPENSEACTUAL,
					ADAEXPENSEBUDGETED, ADAEXPENSEACTUAL,
					BOXOFFICEBUDGETED, BOXOFFICEACTUAL,
					HOSPITALITYBUDGETED, HOSPITALITYACTUAL,
					THIRDPARTYBUDGETED, THIRDPARTYACTUAL,
					HOUSESTAFFBUDGETED, HOUSESTAFFACTUAL,
					LICENSESBUDGETED, LICENSESACTUAL,
					LIMOSAUTOBUDGETED, LIMOSAUTOACTUAL,
					ORCHESTRABUDGETED, ORCHESTRAACTUAL, 
					PRESENTERPROFITBUDGETED, PRESENTERPROFITACTUAL,
					SECURITYBUDGETED, SECURITYACTUAL,
					PROGRAMBUDGETED, PROGRAMACTUAL,
					RENTBUDGETED, RENTACTUAL,
					SOUNDBUDGETED, SOUNDACTUAL,
					TICKETPRINTING2BUDGETED, TICKETPRINTING2ACTUAL,
					TELEPHONESBUDGETED, TELEPHONESACTUAL,
					DRYICEBUDGETED, DRYICEACTUAL,
					PRESSAGENTFEEBUDGETED, PRESSAGENTFEEACTUAL,
					OTHERDBUDGETED, OTHERDACTUAL,
					OTHEREBUDGETED, OTHEREACTUAL,
					OTHERFBUDGETED, OTHERFACTUAL,
					OTHERGBUDGETED, OTHERGACTUAL,
					PIANOBUDGETED, PIANOACTUAL,
					LOCALFIXEDBUDGETED, LOCALFIXEDACTUAL,
					SUBTOTALLOCALEXPENSESBUDGETED, SUBTOTALLOCALEXPENSESACTUAL,
					TOTALLOCALEXPENSEBUDGETED, TOTALLOCALEXPENSEACTUAL,
					TOTALENGAGEMENTEXPENSES,
					MIDDLEMONIESTOCOMPANY, MIDDLEMONIESTOPRESENTER,
					MONEYREMAINING,
					COMPANYOVERAGEPERCENTAGE, TOTALCOMPANYOVERAGEAMOUNT,
					NETSTARPERFORMEROVERAGEPERCENTAGE, TOTALSTARPERFORMEROVERAGEAMOUNT,
					PRESENTEROVERAGETOCOMPANY, PRESENTEROVERAGEADJUSTED, PRESENTEROVERAGETOPRESENTER,
					TOTALCOMPANYSHARE, LESSDIRECTCOMPANYCHARGES, ADJUSTEDCOMPANYSHARE,
					TOTALPRESENTERSHARE, PRESENTERFACILITYFEE, ADJUSTEDPRESENTERSHARE,
					NOTES, ci.`name` as city, st.`name` as state, co.sortname as country
			FROM settlements se, shows sw, venues ve, presenters pr, cities ci, states st, countries co 
			WHERE se.ID = $selectedid  
			AND se.SHOWID = sw.ShowID 
			AND se.VENUEID = ve.VenueID
			AND se.PresenterID = pr.PresenterID
			AND se.CITYID = ci.id 
			AND ci.state_id = st.id 
			AND st.country_id = co.id";

	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	if(!$result) {
         echo "<h1 align=center>Settlement Not Found</h1>";
    }else{
		echo "<h1 align=center>SETTLEMENT DETAILS</h1>";
		echo "<h2 align=center>".$row['ShowNAME']."<br>".$row['VenueNAME']."<br>".$row['city'].", ".$row['state'].", ".$row['country']."</h2>";
		echo "<h2 align=center>Presented by: ".$row['PresenterNAME']."</h2>";
		echo "<table>
				<tr>
					<td colspan=3><h3>GENERAL DATA</h3></td>
				</tr>
				<tr>
					<td>Opening Date:</td>
					<td align='right'>".$row['OPENINGDATE']."</td>
				</tr>
				<tr>
					<td>Closing Date:</td>
					<td align='right'>".$row['CLOSINGDATE']."</td>
				</tr>
				<tr>
					<td>Drop Count</td>
					<td align='right'>".$row['DROPCOUNT']."</td>
				</tr>
				<tr>
					<td>Paid Attendance</td>
					<td align='right'>".number_format($row['PAIDATTENDANCE'],2)."</td>
				</tr>
				<tr>
					<td>Comps</td>
					<td align='right'>".number_format($row['COMPS'],2)."</td>
				</tr>
				<tr>
					<td>Total Attendance</td>
					<td align='right'>".number_format($row['TOTALATTENDANCE'],2)."</td>
				</tr>
				<tr>
					<td>Capacity</td>
					<td align='right'>".number_format($row['CAPACITY'],2)."</td>
				</tr>
				<tr>
					<td>Gross Subscription Sales</td>
					<td align='right'>".number_format($row['GROSSSUBSCRIPTIONSALES'],2)."</td>
				</tr>
				<tr>
					<td>Gross Phone Sales</td>
					<td align='right'>".number_format($row['GROSSPHONESALES'],2)."</td>
				</tr>
				<tr>
					<td>Gross Internet Sales</td>
					<td align='right'>".number_format($row['GROSSINTERNETSALES'],2)."</td>
				</tr>
				<tr>
					<td>Gross Cedit Card Sales</td>
					<td align='right'>".number_format($row['GROSSCREDITCARDSALES'],2)."</td>
				</tr>
				<tr>
					<td>Gross Remote Outlet Sales</td>
					<td align='right'>".number_format($row['GROSSREMOTEOUTLETSALES'],2)."</td>
				</tr>
				<tr>
					<td>Gross Single Tix</td>
					<td align='right'>".number_format($row['GROSSSINGLETIX'],2)."</td>
				</tr>
				<tr>
					<td>Gross Group Sales 1</td>
					<td align='right'>".number_format($row['GROSSGROUPSALES1'],2)."</td>
				</tr>
				<tr>
					<td>Gross Group Sales 2</td>
					<td align='right'>".number_format($row['GROSSGROUPSALES2'],2)."</td>
				</tr>
				<tr>
					<td>Gross Goldstar %</td>
					<td align='right'>".number_format($row['GROSSGOLDSTARPERCENTAGE'],2)."</td>
				</tr>
				<tr>
					<td>Gross Groupon %</td>
					<td align='right'>".number_format($row['GROSSGROUPONPERCENTAGE'],2)."</td>
				</tr>
				<tr>
					<td>Gross Traveloo %</td>
					<td align='right'>".number_format($row['GROSSTRAVELOOPERCENTAGE'],2)."</td>
				</tr>
				<tr>
					<td>Gross Living Social %</td>
					<td align='right'>".number_format($row['GROSSLIVINGSOCIALPERCENTAGE'],2)."</td>
				</tr>
				<tr>
					<td>Gross Other %</td>
					<td align='right'>".number_format($row['GROSSOTHERPERCENTAGE'],2)."</td>
				</tr>
				<tr>
					<td>Gross Other $</td>
					<td align='right'>".number_format($row['GROSSOTHERAMOUNT'],2)."</td>
				</tr>
				<tr>
					<td>TTL Sub Discount</td>
					<td align='right'>".number_format($row['TTLSUBDISCOUNT'],2)."</td>
				</tr>
				<tr>
					<td>TTL Group 1 Discount</td>
					<td align='right'>".number_format($row['TTLGROUPDISCOUNT1'],2)."</td>
				</tr>
				<tr>
					<td>TTL Group 2 Discount</td>
					<td align='right'>".number_format($row['TTLGROUPDISCOUNT2'],2)."</td>
				</tr>
				<tr>
					<td>Total Discounts</td>
					<td align='right'>".number_format($row['TOTALDISCOUNTS'],2)."</td>
				</tr>
				<tr>
					<td>TTL Comp Ticket Cost</td>
					<td align='right'>".number_format($row['TTLCOMPTICKETCOST'],2)."</td>
				</tr>
				<tr>
					<td>Demand Pricing $</td>
					<td align='right'>".number_format($row['DEMANDPRICING'],2)."</td>
				</tr>
				<tr>
					<td>Number Of Performance</td>
					<td align='right'>".number_format($row['NUMBEROFPERFORMANCES'],2)."</td>
				</tr>
				<tr>
					<td>Top Ticket Price</td>
					<td align='right'>".number_format($row['TOPTICKETPRICE'],2)."</td>
				</tr>
				<tr>
					<td>US/Canadian Exchange Rate</td>
					<td align='right'>".number_format($row['USCANADIANEXCHANGERATE'],2)."</td>
				</tr>
				<tr>
					<td>Gross Box Office Potential</td>
					<td align='right'>".number_format($row['GROSSBOXOFFICEPOTENTIAL'],2)."</td>
				</tr>
				<tr>
					<td>Gross Box Office Receipts</td>
					<td align='right'>".number_format($row['GROSSBOXOFFICERECEIPTS'],2)."</td>
				</tr>
				<tr>
					<td>Gross Box Office % of Potential</td>
					<td align='right'>".number_format($row['GROSSBOXOFFICEPERCENTAGEOFPOTENTIAL'],2)."</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td align='right'><b>Percentage</b></td>
					<td align='right'><b>Amount</b></td>
					<td align='right'><b>Total</b></td>
					<td align='right'><b>Deductions</b></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>			
				<tr>
					<td>Tax 1 %</td>
					<td align='right'>".number_format($row['TAX1PERCENTAGE'],2)."</td>
					<td align='right'>".number_format($row['TAX1AMOUNT'],2)."</td>
				</tr>
				<tr>
					<td>Tax 2 and/or Percent deduction</td>
					<td align='right'>".number_format($row['TAX2PERCENTAGE'],2)."</td>
					<td align='right'>".number_format($row['TAX2AMOUNT'],2)."</td>
				</tr>
				<tr>
					<td>Facility/Restoration Fee </td>
					<td align='right'>".number_format($row['FACILITYPERCENTAGE'],2)."</td>
					<td align='right'>".number_format($row['FACILITYAMOUNT'],2)."</td>
				</tr>
				<tr>
					<td>Subscription Sales Comm</td>
					<td align='right'>".number_format($row['SUBSCRIPTIONSALESCOMMPERCENTAGE'],2)."</td>
					<td align='right'>".number_format($row['SUBSCRIPTIONSALESCOMMAMOUNT'],2)."</td>
				</tr>
				<tr>
					<td>Phone Sales Commission</td>
					<td align='right'>".number_format($row['PHONESALESCOMMPERCENTAGE'],2)."</td>
					<td align='right'>".number_format($row['PHONESALESCOMMAMOUNT'],2)."</td>
				</tr>
				<tr>
					<td>Internet Sales Commisssion</td>
					<td align='right'>".number_format($row['INTERNETSALESCOMMPERCENTAGE'],2)."</td>
					<td align='right'>".number_format($row['INTERNETSALESCOMMAMOUNT'],2)."</td>
				</tr>
				<tr>
					<td>Credit Card Sales Comm</td>
					<td align='right'>".number_format($row['CREDITCARDSALESCOMMPERCENTAGE'],2)."</td>
					<td align='right'>".number_format($row['CREDITCARDSALESCOMMAMOUNT'],2)."</td>
				</tr>
				<tr>
					<td>Remote Sales Commission</td>
					<td align='right'>".number_format($row['REMOTESALESCOMMPERCENTAGE'],2)."</td>
					<td align='right'>".number_format($row['REMOTESALESCOMMAMOUNT'],2)."</td>
				</tr>
				<tr>
					<td>Single Tix (if applicable)</td>
					<td align='right'>".number_format($row['SINGLETIXPERCENTAGE'],2)."</td>
					<td align='right'>".number_format($row['SINGLETIXAMOUNT'],2)."</td>
				</tr>	
				<tr>
					<td>Group Sales Commission 1</td>
					<td align='right'>".number_format($row['GROUPSALESCOMM1PERCENTAGE'],2)."</td>
					<td align='right'>".number_format($row['GROUPSALESCOMM1AMOUNT'],2)."</td>
				</tr>
				<tr>
					<td>Group Sales Commission 2</td>
					<td align='right'>".number_format($row['GROUPSALESCOMM2PERCENTAGE'],2)."</td>
					<td align='right'>".number_format($row['GROUPSALESCOMM2AMOUNT'],2)."</td>
				</tr>
				<tr>
					<td>Goldstar</td>
					<td align='right'>".number_format($row['GOLDSTARPERCENTAGE'],2)."</td>
					<td align='right'>".number_format($row['GOLDSTARAMOUNT'],2)."</td>
				</tr>
				<tr>
					<td>Groupon</td>
					<td align='right'>".number_format($row['GROUPONPERCENTAGE'],2)."</td>
					<td align='right'>".number_format($row['GROUPONAMOUNT'],2)."</td>
				</tr>
				<tr>
					<td>Travelzoo</td>
					<td align='right'>".number_format($row['TRAVELZOOPERCENTAGE'],2)."</td>
					<td align='right'>".number_format($row['TRAVELZOOAMOUNT'],2)."</td>
				</tr>
				<tr>
					<td>Living Social</td>
					<td align='right'>".number_format($row['LIVINGSOCIALPERCENTAGE'],2)."</td>
					<td align='right'>".number_format($row['LIVINGSOCIALAMOUNT'],2)."</td>
				</tr>	
				<tr>
					<td>Other %</td>
					<td align='right'>".number_format($row['OTHERAPERCENTAGE'],2)."</td>
					<td align='right'>".number_format($row['OTHERAAMOUNT'],2)."</td>
				</tr>
				<tr>
					<td>Other $</td>
					<td align='right'>".number_format($row['OTHERBPERCENTAGE'],2)."</td>
					<td align='right'>".number_format($row['OTHERBAMOUNT'],2)."</td>
				</tr>
				<tr>
					<td>Total Allowable B.O. Expenses</td>
					<td></td>
					<td></td>
					<td align='right'>".number_format($row['TOTALALLOWABLEBOEXPENSES'],2)."</td>
				</tr>
				<tr>
					<td>Deductions % of GBOR</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".number_format($row['DEDUCTIONSOFGBOR'],2)."</td>
				</tr>
				<tr>
					<td>NAGBOR</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".number_format($row['NAGBOR'],2)."</td>
				</tr>
				<tr>
					<td>Net Company Royalty</td>
					<td align='right'>".number_format($row['NETCOMPANYROYALTY'],2)."</td>
				</tr>
				<tr>
					<td>Tax Withheld at Source</td>
					<td align='right'>".number_format($row['TAXWITHHELDATSOURCE'],2)."</td>
				</tr>
				<tr>
					<td>Total Company Royalty</td>
					<td></td>
					<td></td>
					<td align='right'>".number_format($row['TOTALCOMPANYROYALTY'],2)."</td>
				</tr>
				<tr>
					<td>Total Company Guarantee</td>
					<td></td>
					<td></td>
					<td align='right'>".number_format($row['TOTALCOMPANYGUARANTEE'],2)."</td>
				</tr>
				<tr>
					<td>Less Other Deduction To CO.</td>
					<td></td>
					<td></td>
					<td align='right'>".number_format($row['LESSOTHERDEDUCTION'],2)."</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td align='right'><b>Per Ticket</b></td>
					<td align='right'><b>Budgeted</b></td>
					<td align='right'><b>Actual</b></td>
					<td align='right'><b>Total</b></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>		
				<tr>
					<td>INSURANCE (ON DROP COUNT)</td>
					<td align='right'>".number_format($row['INSURANCEPERTICKET'],2)."</td>
					<td align='right'>".number_format($row['INSURANCEBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['INSURANCEACTUAL'],2)."</td>
				</tr>	
				<tr>
					<td>Ticket Printing</td>
					<td align='right'>".number_format($row['TICKETPRINTING1PERTICKET'],2)."</td>
					<td align='right'>".number_format($row['TICKETPRINTING1BUDGETED'],2)."</td>
					<td align='right'>".number_format($row['TICKETPRINTING1ACTUAL'],2)."</td>
				</tr>	
				<tr>
					<td>ADVERTISING (at gross)</td>
					<td></td>
					<td align='right'>".number_format($row['ADVERTISINGBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['ADVERTISINGACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>STAGEHANDS (Load-in)</td>
					<td></td>
					<td align='right'>".number_format($row['STAGEHANDSLOAINBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['STAGEHANDSLOAINACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>STAGEHANDS (Load-out)</td>
					<td></td>
					<td align='right'>".number_format($row['STAGEHANDSLOADOUTBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['STAGEHANDSLOADOUTACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>STAGEHANDS (Running)</td>
					<td></td>
					<td align='right'>".number_format($row['STAGEHANDSRUNNINGBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['STAGEHANDSRUNNINGACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>WARDROBE and HAIR (Load-in)</td>
					<td></td>
					<td align='right'>".number_format($row['WARDROBELOADINBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['WARDROBELOADINACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>WARDROBE and HAIR (Load-out)</td>
					<td></td>
					<td align='right'>".number_format($row['WARDROBELOADOUTBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['WARDROBELOADOUTACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>WARDROBE and HAIR (Running)</td>
					<td></td>
					<td align='right'>".number_format($row['WARDROBERUNNINGBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['WARDROBERUNNINGACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>LABOR CATERING</td>
					<td></td>
					<td align='right'>".number_format($row['LABORCATERINGBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['LABORCATERINGACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>MUSICIANS</td>
					<td></td>
					<td align='right'>".number_format($row['MUSICIANSBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['MUSICIANSACTUAL'],2)."</td>
				</tr>	
				<tr>
					<td>Other</td>
					<td></td>
					<td align='right'>".number_format($row['OTHERCBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['OTHERCACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>SUBTOTAL of VARIABLE EXPENSE</td>
					<td></td>
					<td align='right'>".number_format($row['SUBTOTALVARIABLEEXPENSEBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['SUBTOTALVARIABLEEXPENSEACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>ADA EXPENSE</td>
					<td></td>
					<td align='right'>".number_format($row['ADAEXPENSEBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['ADAEXPENSEACTUAL'],2)."</td>
				</tr>	
				<tr>
					<td>BOX OFFICE</td>
					<td></td>
					<td align='right'>".number_format($row['BOXOFFICEBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['BOXOFFICEACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>HOSPITALITY (WATER)</td>
					<td></td>
					<td align='right'>".number_format($row['HOSPITALITYBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['HOSPITALITYACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>3RD PARTY EQUIPMENT RENTAL</td>
					<td></td>
					<td align='right'>".number_format($row['THIRDPARTYBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['THIRDPARTYACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>HOUSE STAFF</td>
					<td></td>
					<td align='right'>".number_format($row['HOUSESTAFFBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['HOUSESTAFFACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>LICENSES/PERMITS</td>
					<td></td>
					<td align='right'>".number_format($row['LICENSESBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['LICENSESACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>LIMOS/AUTO</td>
					<td></td>
					<td align='right'>".number_format($row['LIMOSAUTOBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['LIMOSAUTOACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>ORCHESTRA SHELL REMOVAL</td>
					<td></td>
					<td align='right'>".number_format($row['ORCHESTRABUDGETED'],2)."</td>
					<td align='right'>".number_format($row['ORCHESTRAACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>PRESENTER PROFIT</td>
					<td></td>
					<td align='right'>".number_format($row['PRESENTERPROFITBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['PRESENTERPROFITACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>POLICE/SECURITY/FIRE MARSHALL</td>
					<td></td>
					<td align='right'>".number_format($row['SECURITYBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['SECURITYACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>PROGRAM</td>
					<td></td>
					<td align='right'>".number_format($row['PROGRAMBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['PROGRAMACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>RENT</td>
					<td></td>
					<td align='right'>".number_format($row['RENTBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['RENTACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>SOUND/LIGHTS</td>
					<td></td>
					<td align='right'>".number_format($row['SOUNDBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['SOUNDACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>TICKET PRINTING</td>
					<td></td>
					<td align='right'>".number_format($row['TICKETPRINTING2BUDGETED'],2)."</td>
					<td align='right'>".number_format($row['TICKETPRINTING2ACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>TELEPHONES/INTERNET</td>
					<td></td>
					<td align='right'>".number_format($row['TELEPHONESBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['TELEPHONESACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>DRY ICE/CO2</td>
					<td></td>
					<td align='right'>".number_format($row['DRYICEBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['DRYICEACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>PRESS AGENT FEE</td>
					<td></td>
					<td align='right'>".number_format($row['PRESSAGENTFEEBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['PRESSAGENTFEEACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>OTHER</td>
					<td></td>
					<td align='right'>".number_format($row['OTHERDBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['OTHERDACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>OTHER</td>
					<td></td>
					<td align='right'>".number_format($row['OTHEREBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['OTHEREACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>OTHER</td>
					<td></td>
					<td align='right'>".number_format($row['OTHERFBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['OTHERFACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>OTHER</td>
					<td></td>
					<td align='right'>".number_format($row['OTHERGBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['OTHERGACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>PIANO TUNINGS</td>
					<td></td>
					<td align='right'>".number_format($row['PIANOBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['PIANOACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>LOCAL FIXED</td>
					<td></td>
					<td align='right'>".number_format($row['LOCALFIXEDBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['LOCALFIXEDACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>SUB-TOTAL of LOCAL EXPENSES</td>
					<td></td>
					<td align='right'>".number_format($row['SUBTOTALLOCALEXPENSESBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['SUBTOTALLOCALEXPENSESACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>TOTAL LOCAL EXPENSE</td>
					<td></td>
					<td align='right'>".number_format($row['TOTALLOCALEXPENSEBUDGETED'],2)."</td>
					<td align='right'>".number_format($row['TOTALLOCALEXPENSEACTUAL'],2)."</td>
				</tr>
				<tr>
					<td>TOTAL ENGAGEMENT EXPENSES</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".number_format($row['TOTALENGAGEMENTEXPENSES'],2)."</td>
				</tr>	
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td align='right'></td>
					<td align='right'><b>To Company</b></td>
					<td align='right'></td>
					<td align='right'><b>To Presenter</></td>
					<td align='right'><b>Total</></td>
				</tr>	
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Middle Monies To</td>
					<td align='right'>".number_format($row['MIDDLEMONIESTOCOMPANY'],2)."</td>
					<td></td>
					<td align='right'>".number_format($row['MIDDLEMONIESTOPRESENTER'],2)."</td>
				</tr>	
				<tr>
					<td>Money Remaining</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".number_format($row['MONEYREMAINING'],2)."</td>
				</tr>
				<tr>
					<td>Company Overage %</td>
					<td align='right'>".number_format($row['COMPANYOVERAGEPERCENTAGE'],2)."</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Total Company Overage $</td>
					<td></td>
					<td></td>
					<td align='right'>".number_format($row['TOTALCOMPANYOVERAGEAMOUNT'],2)."</td>
				</tr>
				<tr>
					<td>NET STAR PERFORMER OVERAGE %</td>
					<td align='right'>".number_format($row['NETSTARPERFORMEROVERAGEPERCENTAGE'],2)."</td>
				</tr>		
				<tr>
					<td>TOTAL STAR PERFORMER OVERAGE $</td>
					<td></td>
					<td></td>
					<td align='right'>".number_format($row['TOTALSTARPERFORMEROVERAGEAMOUNT'],2)."</td>
				</tr>	
				<tr>
					<td>Presenter Overage %</td>
					<td align='right'>".number_format($row['PRESENTEROVERAGETOCOMPANY'],2)."</td>
					<td></td>
					<td></td>
				</tr>	
				<tr>
					<td>Presenter Overage $</td>
					<td></td>
					<td></td>
					<td align='right'>".number_format($row['PRESENTEROVERAGETOPRESENTER'],2)."</td>
				</tr>
				<tr>
					<td>TOTAL COMPANY SHARE</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".number_format($row['TOTALCOMPANYSHARE'],2)."</td>
				</tr>
				<tr>
					<td>LESS DIRECT COMPANY CHARGES</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".number_format($row['LESSDIRECTCOMPANYCHARGES'],2)."</td>
				</tr>
				<tr>
					<td>ADJUSTED COMPANY SHARE</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".number_format($row['ADJUSTEDCOMPANYSHARE'],2)."</td>
				</tr>	
				<tr>
					<td>TOTAL PRESENTER SHARE</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".number_format($row['TOTALPRESENTERSHARE'],2)."</td>
				</tr>
				<tr>
					<td>PRESENTER'S FACILITY FEE</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".number_format($row['PRESENTERFACILITYFEE'],2)."</td>
				</tr>
				<tr>
					<td>ADJUSTED PRESENTER SHARE</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".number_format($row['ADJUSTEDPRESENTERSHARE'],2)."</td>
				</tr>
				<tr>
					<td>NOTES</td>
					<td colspan=4>".$row['NOTES']."</td>
				</tr>
			</table>";
    };

}else{
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