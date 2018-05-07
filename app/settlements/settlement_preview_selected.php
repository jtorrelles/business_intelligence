<?php
require '../db/database_conn.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['selectedid'])){

	$selectedid = $_GET['selectedid'];

	$sql = "SELECT 	se.ID, se.SHOWID, sw.ShowNAME, se.CITYID, se.VENUEID, ve.VenueNAME, 
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
			FROM settlements se, shows sw, venues ve, cities ci, states st, countries co 
			WHERE se.ID = $selectedid  
			AND se.SHOWID = sw.ShowID 
			AND se.VENUEID = ve.VenueID 
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
					<td align='right'>".$row['PAIDATTENDANCE']."</td>
				</tr>
				<tr>
					<td>Comps</td>
					<td align='right'>".$row['COMPS']."</td>
				</tr>
				<tr>
					<td>Total Attendance</td>
					<td align='right'>".$row['TOTALATTENDANCE']."</td>
				</tr>
				<tr>
					<td>Capacity</td>
					<td align='right'>".$row['CAPACITY']."</td>
				</tr>
				<tr>
					<td>Gross Subscription Sales</td>
					<td align='right'>".$row['GROSSSUBSCRIPTIONSALES']."</td>
				</tr>
				<tr>
					<td>Gross Phone Sales</td>
					<td align='right'>".$row['GROSSPHONESALES']."</td>
				</tr>
				<tr>
					<td>Gross Internet Sales</td>
					<td align='right'>".$row['GROSSINTERNETSALES']."</td>
				</tr>
				<tr>
					<td>Gross Cedit Card Sales</td>
					<td align='right'>".$row['GROSSCREDITCARDSALES']."</td>
				</tr>
				<tr>
					<td>Gross Remote Outlet Sales</td>
					<td align='right'>".$row['GROSSREMOTEOUTLETSALES']."</td>
				</tr>
				<tr>
					<td>Gross Single Tix</td>
					<td align='right'>".$row['GROSSSINGLETIX']."</td>
				</tr>
				<tr>
					<td>Gross Group Sales 1</td>
					<td align='right'>".$row['GROSSGROUPSALES1']."</td>
				</tr>
				<tr>
					<td>Gross Group Sales 2</td>
					<td align='right'>".$row['GROSSGROUPSALES2']."</td>
				</tr>
				<tr>
					<td>Gross Goldstar %</td>
					<td align='right'>".$row['GROSSGOLDSTARPERCENTAGE']."</td>
				</tr>
				<tr>
					<td>Gross Groupon %</td>
					<td align='right'>".$row['GROSSGROUPONPERCENTAGE']."</td>
				</tr>
				<tr>
					<td>Gross Traveloo %</td>
					<td align='right'>".$row['GROSSTRAVELOOPERCENTAGE']."</td>
				</tr>
				<tr>
					<td>Gross Living Social %</td>
					<td align='right'>".$row['GROSSLIVINGSOCIALPERCENTAGE']."</td>
				</tr>
				<tr>
					<td>Gross Other %</td>
					<td align='right'>".$row['GROSSOTHERPERCENTAGE']."</td>
				</tr>
				<tr>
					<td>Gross Other $</td>
					<td align='right'>".$row['GROSSOTHERAMOUNT']."</td>
				</tr>
				<tr>
					<td>TTL Sub Discount</td>
					<td align='right'>".$row['TTLSUBDISCOUNT']."</td>
				</tr>
				<tr>
					<td>TTL Group 1 Discount</td>
					<td align='right'>".$row['TTLGROUPDISCOUNT1']."</td>
				</tr>
				<tr>
					<td>TTL Group 2 Discount</td>
					<td align='right'>".$row['TTLGROUPDISCOUNT2']."</td>
				</tr>
				<tr>
					<td>Total Discounts</td>
					<td align='right'>".$row['TOTALDISCOUNTS']."</td>
				</tr>
				<tr>
					<td>TTL Comp Ticket Cost</td>
					<td align='right'>".$row['TTLCOMPTICKETCOST']."</td>
				</tr>
				<tr>
					<td>Demand Pricing $</td>
					<td align='right'>".$row['DEMANDPRICING']."</td>
				</tr>
				<tr>
					<td>Number Of Performance</td>
					<td align='right'>".$row['NUMBEROFPERFORMANCES']."</td>
				</tr>
				<tr>
					<td>Top Ticket Price</td>
					<td align='right'>".$row['TOPTICKETPRICE']."</td>
				</tr>
				<tr>
					<td>US/Canadian Exchange Rate</td>
					<td align='right'>".$row['USCANADIANEXCHANGERATE']."</td>
				</tr>
				<tr>
					<td>Gross Box Office Potential</td>
					<td align='right'>".$row['GROSSBOXOFFICEPOTENTIAL']."</td>
				</tr>
				<tr>
					<td>Gross Box Office Receipts</td>
					<td align='right'>".$row['GROSSBOXOFFICERECEIPTS']."</td>
				</tr>
				<tr>
					<td>Gross Box Office % of Potential</td>
					<td align='right'>".$row['GROSSBOXOFFICEPERCENTAGEOFPOTENTIAL']."</td>
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
					<td align='right'>".$row['TAX1PERCENTAGE']."</td>
					<td align='right'>".$row['TAX1AMOUNT']."</td>
				</tr>
				<tr>
					<td>Tax 2 and/or Percent deduction</td>
					<td align='right'>".$row['TAX2PERCENTAGE']."</td>
					<td align='right'>".$row['TAX2AMOUNT']."</td>
				</tr>
				<tr>
					<td>Facility/Restoration Fee </td>
					<td align='right'>".$row['FACILITYPERCENTAGE']."</td>
					<td align='right'>".$row['FACILITYAMOUNT']."</td>
				</tr>
				<tr>
					<td>Subscription Sales Comm</td>
					<td align='right'>".$row['SUBSCRIPTIONSALESCOMMPERCENTAGE']."</td>
					<td align='right'>".$row['SUBSCRIPTIONSALESCOMMAMOUNT']."</td>
				</tr>
				<tr>
					<td>Phone Sales Commission</td>
					<td align='right'>".$row['PHONESALESCOMMPERCENTAGE']."</td>
					<td align='right'>".$row['PHONESALESCOMMAMOUNT']."</td>
				</tr>
				<tr>
					<td>Internet Sales Commisssion</td>
					<td align='right'>".$row['INTERNETSALESCOMMPERCENTAGE']."</td>
					<td align='right'>".$row['INTERNETSALESCOMMAMOUNT']."</td>
				</tr>
				<tr>
					<td>Credit Card Sales Comm</td>
					<td align='right'>".$row['CREDITCARDSALESCOMMPERCENTAGE']."</td>
					<td align='right'>".$row['CREDITCARDSALESCOMMAMOUNT']."</td>
				</tr>
				<tr>
					<td>Remote Sales Commission</td>
					<td align='right'>".$row['REMOTESALESCOMMPERCENTAGE']."</td>
					<td align='right'>".$row['REMOTESALESCOMMAMOUNT']."</td>
				</tr>
				<tr>
					<td>Single Tix (if applicable)</td>
					<td align='right'>".$row['SINGLETIXPERCENTAGE']."</td>
					<td align='right'>".$row['SINGLETIXAMOUNT']."</td>
				</tr>	
				<tr>
					<td>Group Sales Commission 1</td>
					<td align='right'>".$row['GROUPSALESCOMM1PERCENTAGE']."</td>
					<td align='right'>".$row['GROUPSALESCOMM1AMOUNT']."</td>
				</tr>
				<tr>
					<td>Group Sales Commission 2</td>
					<td align='right'>".$row['GROUPSALESCOMM2PERCENTAGE']."</td>
					<td align='right'>".$row['GROUPSALESCOMM2AMOUNT']."</td>
				</tr>
				<tr>
					<td>Goldstar</td>
					<td align='right'>".$row['GOLDSTARPERCENTAGE']."</td>
					<td align='right'>".$row['GOLDSTARAMOUNT']."</td>
				</tr>
				<tr>
					<td>Groupon</td>
					<td align='right'>".$row['GROUPONPERCENTAGE']."</td>
					<td align='right'>".$row['GROUPONAMOUNT']."</td>
				</tr>
				<tr>
					<td>Travelzoo</td>
					<td align='right'>".$row['TRAVELZOOPERCENTAGE']."</td>
					<td align='right'>".$row['TRAVELZOOAMOUNT']."</td>
				</tr>
				<tr>
					<td>Living Social</td>
					<td align='right'>".$row['LIVINGSOCIALPERCENTAGE']."</td>
					<td align='right'>".$row['LIVINGSOCIALAMOUNT']."</td>
				</tr>	
				<tr>
					<td>Other %</td>
					<td align='right'>".$row['OTHERAPERCENTAGE']."</td>
					<td align='right'>".$row['OTHERAAMOUNT']."</td>
				</tr>
				<tr>
					<td>Other $</td>
					<td align='right'>".$row['OTHERBPERCENTAGE']."</td>
					<td align='right'>".$row['OTHERBAMOUNT']."</td>
				</tr>
				<tr>
					<td>Total Allowable B.O. Expenses</td>
					<td></td>
					<td></td>
					<td align='right'>".$row['TOTALALLOWABLEBOEXPENSES']."</td>
				</tr>
				<tr>
					<td>Deductions % of GBOR</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".$row['DEDUCTIONSOFGBOR']."</td>
				</tr>
				<tr>
					<td>NAGBOR</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".$row['NAGBOR']."</td>
				</tr>
				<tr>
					<td>Net Company Royalty</td>
					<td align='right'>".$row['NETCOMPANYROYALTY']."</td>
				</tr>
				<tr>
					<td>Tax Withheld at Source</td>
					<td align='right'>".$row['TAXWITHHELDATSOURCE']."</td>
				</tr>
				<tr>
					<td>Total Company Royalty</td>
					<td></td>
					<td></td>
					<td align='right'>".$row['TOTALCOMPANYROYALTY']."</td>
				</tr>
				<tr>
					<td>Total Company Guarantee</td>
					<td></td>
					<td></td>
					<td align='right'>".$row['TOTALCOMPANYGUARANTEE']."</td>
				</tr>
				<tr>
					<td>Less Other Deduction To CO.</td>
					<td></td>
					<td></td>
					<td align='right'>".$row['LESSOTHERDEDUCTION']."</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td align='right'><b>Percentage</b></td>
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
					<td align='right'>".$row['INSURANCEPERTICKET']."</td>
					<td align='right'>".$row['INSURANCEBUDGETED']."</td>
					<td align='right'>".$row['INSURANCEACTUAL']."</td>
				</tr>	
				<tr>
					<td>Ticket Printing</td>
					<td align='right'>".$row['TICKETPRINTING1PERTICKET']."</td>
					<td align='right'>".$row['TICKETPRINTING1BUDGETED']."</td>
					<td align='right'>".$row['TICKETPRINTING1ACTUAL']."</td>
				</tr>	
				<tr>
					<td>ADVERTISING (at gross)</td>
					<td></td>
					<td align='right'>".$row['ADVERTISINGBUDGETED']."</td>
					<td align='right'>".$row['ADVERTISINGACTUAL']."</td>
				</tr>
				<tr>
					<td>STAGEHANDS (Load-in)</td>
					<td></td>
					<td align='right'>".$row['STAGEHANDSLOAINBUDGETED']."</td>
					<td align='right'>".$row['STAGEHANDSLOAINACTUAL']."</td>
				</tr>
				<tr>
					<td>STAGEHANDS (Load-out)</td>
					<td></td>
					<td align='right'>".$row['STAGEHANDSLOADOUTBUDGETED']."</td>
					<td align='right'>".$row['STAGEHANDSLOADOUTACTUAL']."</td>
				</tr>
				<tr>
					<td>STAGEHANDS (Running)</td>
					<td></td>
					<td align='right'>".$row['STAGEHANDSRUNNINGBUDGETED']."</td>
					<td align='right'>".$row['STAGEHANDSRUNNINGACTUAL']."</td>
				</tr>
				<tr>
					<td>WARDROBE and HAIR (Load-in)</td>
					<td></td>
					<td align='right'>".$row['WARDROBELOADINBUDGETED']."</td>
					<td align='right'>".$row['WARDROBELOADINACTUAL']."</td>
				</tr>
				<tr>
					<td>WARDROBE and HAIR (Load-out)</td>
					<td></td>
					<td align='right'>".$row['WARDROBELOADOUTBUDGETED']."</td>
					<td align='right'>".$row['WARDROBELOADOUTACTUAL']."</td>
				</tr>
				<tr>
					<td>WARDROBE and HAIR (Running)</td>
					<td></td>
					<td align='right'>".$row['WARDROBERUNNINGBUDGETED']."</td>
					<td align='right'>".$row['WARDROBERUNNINGACTUAL']."</td>
				</tr>
				<tr>
					<td>LABOR CATERING</td>
					<td></td>
					<td align='right'>".$row['LABORCATERINGBUDGETED']."</td>
					<td align='right'>".$row['LABORCATERINGACTUAL']."</td>
				</tr>
				<tr>
					<td>MUSICIANS</td>
					<td></td>
					<td align='right'>".$row['MUSICIANSBUDGETED']."</td>
					<td align='right'>".$row['MUSICIANSACTUAL']."</td>
				</tr>	
				<tr>
					<td>Other</td>
					<td></td>
					<td align='right'>".$row['OTHERCBUDGETED']."</td>
					<td align='right'>".$row['OTHERCACTUAL']."</td>
				</tr>
				<tr>
					<td>SUBTOTAL of VARIABLE EXPENSE</td>
					<td></td>
					<td align='right'>".$row['SUBTOTALVARIABLEEXPENSEBUDGETED']."</td>
					<td align='right'>".$row['SUBTOTALVARIABLEEXPENSEACTUAL']."</td>
				</tr>
				<tr>
					<td>ADA EXPENSE</td>
					<td></td>
					<td align='right'>".$row['ADAEXPENSEBUDGETED']."</td>
					<td align='right'>".$row['ADAEXPENSEACTUAL']."</td>
				</tr>	
				<tr>
					<td>BOX OFFICE</td>
					<td></td>
					<td align='right'>".$row['BOXOFFICEBUDGETED']."</td>
					<td align='right'>".$row['BOXOFFICEACTUAL']."</td>
				</tr>
				<tr>
					<td>HOSPITALITY (WATER)</td>
					<td></td>
					<td align='right'>".$row['HOSPITALITYBUDGETED']."</td>
					<td align='right'>".$row['HOSPITALITYACTUAL']."</td>
				</tr>
				<tr>
					<td>3RD PARTY EQUIPMENT RENTAL</td>
					<td></td>
					<td align='right'>".$row['THIRDPARTYBUDGETED']."</td>
					<td align='right'>".$row['THIRDPARTYACTUAL']."</td>
				</tr>
				<tr>
					<td>HOUSE STAFF</td>
					<td></td>
					<td align='right'>".$row['HOUSESTAFFBUDGETED']."</td>
					<td align='right'>".$row['HOUSESTAFFACTUAL']."</td>
				</tr>
				<tr>
					<td>LICENSES/PERMITS</td>
					<td></td>
					<td align='right'>".$row['LICENSESBUDGETED']."</td>
					<td align='right'>".$row['LICENSESACTUAL']."</td>
				</tr>
				<tr>
					<td>LIMOS/AUTO</td>
					<td></td>
					<td align='right'>".$row['LIMOSAUTOBUDGETED']."</td>
					<td align='right'>".$row['LIMOSAUTOACTUAL']."</td>
				</tr>
				<tr>
					<td>ORCHESTRA SHELL REMOVAL</td>
					<td></td>
					<td align='right'>".$row['ORCHESTRABUDGETED']."</td>
					<td align='right'>".$row['ORCHESTRAACTUAL']."</td>
				</tr>
				<tr>
					<td>PRESENTER PROFIT</td>
					<td></td>
					<td align='right'>".$row['PRESENTERPROFITBUDGETED']."</td>
					<td align='right'>".$row['PRESENTERPROFITACTUAL']."</td>
				</tr>
				<tr>
					<td>POLICE/SECURITY/FIRE MARSHALL</td>
					<td></td>
					<td align='right'>".$row['SECURITYBUDGETED']."</td>
					<td align='right'>".$row['SECURITYACTUAL']."</td>
				</tr>
				<tr>
					<td>PROGRAM</td>
					<td></td>
					<td align='right'>".$row['PROGRAMBUDGETED']."</td>
					<td align='right'>".$row['PROGRAMACTUAL']."</td>
				</tr>
				<tr>
					<td>RENT</td>
					<td></td>
					<td align='right'>".$row['RENTBUDGETED']."</td>
					<td align='right'>".$row['RENTACTUAL']."</td>
				</tr>
				<tr>
					<td>SOUND/LIGHTS</td>
					<td></td>
					<td align='right'>".$row['SOUNDBUDGETED']."</td>
					<td align='right'>".$row['SOUNDACTUAL']."</td>
				</tr>
				<tr>
					<td>TICKET PRINTING</td>
					<td></td>
					<td align='right'>".$row['TICKETPRINTING2BUDGETED']."</td>
					<td align='right'>".$row['TICKETPRINTING2ACTUAL']."</td>
				</tr>
				<tr>
					<td>TELEPHONES/INTERNET</td>
					<td></td>
					<td align='right'>".$row['TELEPHONESBUDGETED']."</td>
					<td align='right'>".$row['TELEPHONESACTUAL']."</td>
				</tr>
				<tr>
					<td>DRY ICE/CO2</td>
					<td></td>
					<td align='right'>".$row['DRYICEBUDGETED']."</td>
					<td align='right'>".$row['DRYICEACTUAL']."</td>
				</tr>
				<tr>
					<td>PRESS AGENT FEE</td>
					<td></td>
					<td align='right'>".$row['PRESSAGENTFEEBUDGETED']."</td>
					<td align='right'>".$row['PRESSAGENTFEEACTUAL']."</td>
				</tr>
				<tr>
					<td>OTHER</td>
					<td></td>
					<td align='right'>".$row['OTHERDBUDGETED']."</td>
					<td align='right'>".$row['OTHERDACTUAL']."</td>
				</tr>
				<tr>
					<td>OTHER</td>
					<td></td>
					<td align='right'>".$row['OTHEREBUDGETED']."</td>
					<td align='right'>".$row['OTHEREACTUAL']."</td>
				</tr>
				<tr>
					<td>OTHER</td>
					<td></td>
					<td align='right'>".$row['OTHERFBUDGETED']."</td>
					<td align='right'>".$row['OTHERFACTUAL']."</td>
				</tr>
				<tr>
					<td>OTHER</td>
					<td></td>
					<td align='right'>".$row['OTHERGBUDGETED']."</td>
					<td align='right'>".$row['OTHERGACTUAL']."</td>
				</tr>
				<tr>
					<td>PIANO TUNINGS</td>
					<td></td>
					<td align='right'>".$row['PIANOBUDGETED']."</td>
					<td align='right'>".$row['PIANOACTUAL']."</td>
				</tr>
				<tr>
					<td>LOCAL FIXED</td>
					<td></td>
					<td align='right'>".$row['LOCALFIXEDBUDGETED']."</td>
					<td align='right'>".$row['LOCALFIXEDACTUAL']."</td>
				</tr>
				<tr>
					<td>SUB-TOTAL of LOCAL EXPENSES</td>
					<td></td>
					<td align='right'>".$row['SUBTOTALLOCALEXPENSESBUDGETED']."</td>
					<td align='right'>".$row['SUBTOTALLOCALEXPENSESACTUAL']."</td>
				</tr>
				<tr>
					<td>TOTAL LOCAL EXPENSE</td>
					<td></td>
					<td align='right'>".$row['TOTALLOCALEXPENSEBUDGETED']."</td>
					<td align='right'>".$row['TOTALLOCALEXPENSEACTUAL']."</td>
				</tr>
				<tr>
					<td>TOTAL ENGAGEMENT EXPENSES</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".$row['TOTALENGAGEMENTEXPENSES']."</td>
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
					<td align='right'><b>To Share</b></td>
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
					<td>Middel Monies To</td>
					<td align='right'>".$row['MIDDLEMONIESTOCOMPANY']."</td>
					<td></td>
					<td align='right'>".$row['MIDDLEMONIESTOPRESENTER']."</td>
				</tr>	
				<tr>
					<td>Money Remaining</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".$row['MONEYREMAINING']."</td>
				</tr>
				<tr>
					<td>Company Overage %</td>
					<td align='right'>".$row['COMPANYOVERAGEPERCENTAGE']."</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Total Company Overage $</td>
					<td></td>
					<td></td>
					<td align='right'>".$row['TOTALCOMPANYOVERAGEAMOUNT']."</td>
				</tr>
				<tr>
					<td>NET STAR PERFORMER OVERAGE %</td>
					<td align='right'>".$row['NETSTARPERFORMEROVERAGEPERCENTAGE']."</td>
				</tr>		
				<tr>
					<td>TOTAL STAR PERFORMER OVERAGE $</td>
					<td></td>
					<td></td>
					<td align='right'>".$row['TOTALSTARPERFORMEROVERAGEAMOUNT']."</td>
				</tr>	
				<tr>
					<td>Presenter Overage % to Company</td>
					<td align='right'>".$row['PRESENTEROVERAGETOCOMPANY']."</td>
					<td></td>
					<td></td>
				</tr>	
				<tr>
					<td>Presenter Overage % Adjusted Company Share</td>
					<td></td>
					<td align='right'>".$row['PRESENTEROVERAGEADJUSTED']."</td>
					<td></td>
				</tr>
				<tr>
					<td>Presenter Overage % to Presenter</td>
					<td></td>
					<td></td>
					<td align='right'>".$row['PRESENTEROVERAGETOPRESENTER']."</td>
				</tr>
				<tr>
					<td>TOTAL COMPANY SHARE</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".$row['TOTALCOMPANYSHARE']."</td>
				</tr>
				<tr>
					<td>LESS DIRECT COMPANY CHARGES</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".$row['LESSDIRECTCOMPANYCHARGES']."</td>
				</tr>
				<tr>
					<td>ADJUSTED COMPANY SHARE</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".$row['ADJUSTEDCOMPANYSHARE']."</td>
				</tr>	
				<tr>
					<td>TOTAL PRESENTER SHARE</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".$row['TOTALPRESENTERSHARE']."</td>
				</tr>
				<tr>
					<td>PRESENTER'S FACILITY FEE</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".$row['PRESENTERFACILITYFEE']."</td>
				</tr>
				<tr>
					<td>ADJUSTED PRESENTER SHARE</td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right'>".$row['ADJUSTEDPRESENTERSHARE']."</td>
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