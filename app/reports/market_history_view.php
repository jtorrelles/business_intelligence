<?php

include '../session.php';
include '../header.html';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<html>
<head>
</head>
<body>

<script src="../js/jquery.min.js"></script>
<script src="../js/multiple/multiple-select.js"></script>
<script src="../js/utility.js"></script>
<script src="../js/reports_controller.js"></script>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="../js/multiple/multiple-select.css">
<script> getCountries(); getShows(); getVenues(); getCategories();</script>

<h1>Market History Report:</h1>

<form action="#" method="POST">
	<table style="width:100%">
		<col align="center">
		<col align="center">
		<col align="center">
		<col align="center">
		<col align="center">
		<col align="center">
		<col align="center">
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th>Actions</th>
		</tr>
		<tr>
			<td align="right">
				<b>Contry:</b>
			</td>
			<td align="left">
				<select name="country" class="countries" id="countryId">
					<option value="">Select Country</option>
				</select>
			</td>
			<td align="right">
				<b>State:</b>
			</td>
			<td align="left">
				<select name="state" class="states" id="stateId">
					<option value="">Select State</option>
				</select>
			</td>
			<td align="right">
				<b>City:</b>
			</td>			
			<td align="left">
				<select name="city" class="cities" id="cityId">
					<option value="">Select City</option>
				</select>
			</td>
			<td align="center" rowspan="5">
				<input type="button" class="button" id="btnFindMarketHistory" value="Find">
				<input type="button" class="button" id="btnCleanMarketHistory" value="Clear">
			</td>
		</tr>
		<tr>
			<td align="right">
				<b>Init Date <font color=red>*</font>:</b>
			</td >
			<td align="left">
				<input type="date" class="dateini" name="dateini">
			</td>
			<td align="right">
				<b>End Date <font color=red>*</font>:</b>
			</td>
			<td align="left">
				<input type="date" class="dateend" name='dateend'>
			</td>
			<td>
			</td>
			<td>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td align="right">
				<b>Venue <font color=red>*</font>:</b>
			</td>
			<td align="left">
				<select name="venues[]" multiple="multiple" id="venues">
					<option value="0">Select Venues</option>
				</select>			
			</td>
			<td>
			</td>
			<td>
			</td>
			<td>
			</td>
			<td>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td align="right">
				<b>Categories:</b>
			</td>
			<td align="left">
				<select name="category" class="categories" id="categoryId">
					<option value="0">Select Category</option>
				</select>
			</td>
			<td>
			</td>
			<td>
			</td>
			<td>
			</td>
			<td>
			</td>
			<td>
			</td>
		</tr>		
		<tr>
			<td align="right">
				<b>Shows:</b>
			</td>
			<td align="left">
				<select name="shows[]" multiple="multiple" id="shows">
					<option value="0">Select Shows</option>
				</select>
			</td>
			<td align="right">
				<b>Fields:</b>
			</td>
			<td align="left">
				<select name="fields[]" multiple="multiple" id="fields">
					<option value="DROPCOUNT"> DROP COUNT </option>
					<option value="PAIDATTENDANCE"> PAID ATTENDANCE </option>
					<option value="COMPS"> COMPS </option>
					<option value="TOTALATTENDANCE"> TOTAL ATTENDANCE </option>
					<option value="CAPACITY"> CAPACITY </option>
					<option value="GROSSSUBSCRIPTIONSALES"> GROSS SUBSCRIPTION SALES </option>
					<option value="GROSSPHONESALES"> GROSS PHONE SALES </option>
					<option value="GROSSINTERNETSALES"> GROSS INTERNET SALES </option>
					<option value="GROSSCREDITCARDSALES"> GROSS CREDIT CARD SALES </option>
					<option value="GROSSREMOTEOUTLETSALES"> GROSS REMOTE/OUTLET SALES </option>
					<option value="GROSSSINGLETIX"> GROSS SINGLE TIX </option>
					<option value="GROSSGROUPSALES1"> GROSS GROUP SALES 1 </option>
					<option value="GROSSGROUPSALES2"> GROSS GROUP SALES 2 </option>
					<option value="GROSSGOLDSTARPERCENTAGE"> GROSS GOLDSTAR PERCENTAGE </option>
					<option value="GROSSGROUPONPERCENTAGE"> GROSS GROUPON PERCENTAGE </option>
					<option value="GROSSTRAVELOOPERCENTAGE"> GROSS TRAVELOO PERCENTAGE </option>
					<option value="GROSSLIVINGSOCIALPERCENTAGE"> GROSS LIVING SOCIAL PERCENTAGE </option>
					<option value="GROSSOTHERPERCENTAGE"> GROSS OTHER PERCENTAGE </option>
					<option value="GROSSOTHERAMOUNT"> GROSS OTHER AMOUNT </option>
					<option value="TTLSUBDISCOUNT"> TOTAL SUB DISCOUNT </option>
					<option value="TTLGROUPDISCOUNT1"> TOTAL GROUP 1 DISCOUNT </option>
					<option value="TTLGROUPDISCOUNT2"> TOTAL GROUP 2 DISCOUNT </option>
					<option value="TOTALDISCOUNTS"> TOTAL DISCOUNTS </option>
					<option value="TTLCOMPTICKETCOST"> TOTAL COMP TICKET COST </option>
					<option value="DEMANDPRICING"> DEMAND PRICING AMOUNT </option>
					<option value="NUMBEROFPERFORMANCES"> NUMBER OF PERFORMANCES </option>
					<option value="TOPTICKETPRICE"> TOP TICKET PRICE </option>
					<option value="USCANADIANEXCHANGERATE"> US/CANADIAN EXCHANGE RATE </option>
					<option value="GROSSBOXOFFICEPOTENTIAL"> GROSS BOX OFFICE POTENTIAL </option>
					<option value="GROSSBOXOFFICERECEIPTS"> GROSS BOX OFFICE RECEIPTS </option>
					<option value="GROSSBOXOFFICEPERCENTAGEOFPOTENTIAL"> GROSS BOX OFFICE PERCENTAGE OF POTENTIAL </option>
					<option value="TAX1PERCENTAGE"> TAX 1 PERCENTAGE</option>
					<option value="TAX2PERCENTAGE"> TAX 2 AND/OR PERCENT DEDUCTION </option>
					<option value="FACILITYPERCENTAGE"> FACILITY/RESTORATION FEE </option>
					<option value="SUBSCRIPTIONSALESCOMMPERCENTAGE"> SUBSCRIPTION SALES COMMISSION </option>
					<option value="PHONESALESCOMMPERCENTAGE"> PHONE SALES COMMISSION </option>
					<option value="INTERNETSALESCOMMPERCENTAGE"> INTERNET SALES COMMISSION </option>
					<option value="CREDITCARDSALESCOMMPERCENTAGE"> CREDIT CARD SALES COMMISSION </option>
					<option value="REMOTESALESCOMMPERCENTAGE"> REMOTE SALES COMMISSION </option>
					<option value="SINGLETIXPERCENTAGE"> SINGLE TIX </option>
					<option value="GROUPSALESCOMM1PERCENTAGE"> GROUP SALES COMMISSION 1 </option>
					<option value="GROUPSALESCOMM2PERCENTAGE"> GROUP SALES COMMISSION 2 </option>
					<option value="GOLDSTARPERCENTAGE"> GOLDSTAR </option>
					<option value="GROUPONPERCENTAGE"> GROUPON </option>
					<option value="TRAVELZOOPERCENTAGE"> TRAVELZOO </option>
					<option value="LIVINGSOCIALPERCENTAGE"> LIVING SOCIAL </option>
					<option value="OTHERAPERCENTAGE"> OTHER A PERCENTAGE </option>
					<option value="OTHERBPERCENTAGE"> OTHER B PERCENTAGE </option>
					<option value="TAX1AMOUNT"> TAX 1 AMOUNT</option>
					<option value="TAX2AMOUNT"> TAX 2 AND/OR PERCENT DEDUCTION AMOUNT</option>
					<option value="FACILITYAMOUNT"> FACILITY/RESTORATION FEE </option>
					<option value="SUBSCRIPTIONSALESCOMMAMOUNT"> SUBSCRIPTION SALES COMMISSION </option>
					<option value="PHONESALESCOMMAMOUNT"> PHONE SALES COMMISSION </option>
					<option value="INTERNETSALESCOMMAMOUNT"> INTERNET SALES COMMISSION </option>
					<option value="CREDITCARDSALESCOMMAMOUNT"> CREDIT CARD SALES COMMISSION </option>
					<option value="REMOTESALESCOMMAMOUNT"> REMOTE SALES COMMISSION </option>
					<option value="SINGLETIXAMOUNT"> SINGLE TIX AMOUNT</option>
					<option value="GROUPSALESCOMM1AMOUNT"> GROUP SALES COMMISSION 1 </option>
					<option value="GROUPSALESCOMM2AMOUNT"> GROUP SALES COMMISSION 2 </option>
					<option value="GOLDSTARAMOUNT"> GOLDSTAR </option>
					<option value="GROUPONAMOUNT"> GROUPON </option>
					<option value="TRAVELZOOAMOUNT"> TRAVELZOO </option>
					<option value="LIVINGSOCIALAMOUNT"> LIVING SOCIAL </option>
					<option value="OTHERAAMOUNT"> OTHER A AMOUNT </option>
					<option value="OTHERBAMOUNT"> OTHER B AMOUNT </option>
					<option value="TOTALALLOWABLEBOEXPENSES"> TOTAL ALLOWABLE B.O EXPENSES </option>
					<option value="DEDUCTIONSOFGBOR"> DEDUCTIONS PERCENTAGE OF GBOR </option>
					<option value="NAGBOR"> NAGBOR </option>
					<option value="NETCOMPANYROYALTY"> NET COMPANY ROYALTY </option>
					<option value="TAXWITHHELDATSOURCE"> TAX WITHHELD AT SOURCE </option>
					<option value="TOTALCOMPANYROYALTY"> TOTAL COMPANY ROYALTY </option>
					<option value="TOTALCOMPANYGUARANTEE"> TOTAL COMPANY GUARANTEE </option>
					<option value="LESSOTHERDEDUCTION"> LESS OTHER DEDUCTION TO CO </option>
					<option value="INSURANCEPERTICKET"> INSURANCE (ON DROP COUNT) </option>
					<option value="TICKETPRINTING1PERTICKET"> TICKET PRINTING </option>
					<option value="ADVERTISINGBUDGETED"> ADVERTISING (AT GROSS) </option>
					<option value="STAGEHANDSLOAINBUDGETED"> STAGEHANDS (LOAD-IN) BUDGETED </option>
					<option value="STAGEHANDSLOADOUTBUDGETED"> STAGEHANDS (LOAD-OUT) BUDGETED </option>
					<option value="STAGEHANDSRUNNINGBUDGETED"> STAGEHANDS (RUNNING) BUDGETED </option>
					<option value="WARDROBELOADINBUDGETED"> WARDROBE AND HAIR (LOAD-IN) BUDGETED </option>
					<option value="WARDROBELOADOUTBUDGETED"> WARDROBE AND HAIR (LOAD-OUT) BUDGETED </option>
					<option value="WARDROBERUNNINGBUDGETED"> WARDROBE AND HAIR (RUNNING) BUDGETED </option>
					<option value="LABORCATERINGBUDGETED"> LABOR CATERING BUDGETED </option>
					<option value="MUSICIANSBUDGETED"> MUSICIANS BUDGETED </option>
					<option value="INSURANCEBUDGETED"> INSURANCE (ON DROP COUNT) BUDGETED </option>
					<option value="TICKETPRINTING1BUDGETED"> TICKET PRINTING BUDGETED </option>
					<option value="OTHERCBUDGETED"> OTHER BUDGETED </option>
					<option value="SUBTOTALVARIABLEEXPENSEBUDGETED"> SUBTOTAL OF VARIABLE EXPENSE BUDGETED </option>
					<option value="ADAEXPENSEBUDGETED"> ADA EXPENSE BUDGETED </option>
					<option value="BOXOFFICEBUDGETED"> BOX OFFICE BUDGETED </option>
					<option value="HOSPITALITYBUDGETED"> HOSPITALITY (WATER) BUDGETED </option>
					<option value="THIRDPARTYBUDGETED"> 3RD PARTY EQUIPMENT RENTAL BUDGETED </option>
					<option value="HOUSESTAFFBUDGETED"> HOUSE STAFF BUDGETED </option>
					<option value="LICENSESBUDGETED"> LICENSES/PERMITS BUDGETED </option>
					<option value="LIMOSAUTOBUDGETED"> LIMOS/AUTO BUDGETED </option>
					<option value="ORCHESTRABUDGETED"> ORCHESTRA SHELL REMOVAL BUDGETED </option>
					<option value="PRESENTERPROFITBUDGETED"> PRESENTER PROFIT BUDGETED </option>
					<option value="SECURITYBUDGETED"> POLICE/SECURITY/FIRE MARSHALL BUDGETED </option>
					<option value="PROGRAMBUDGETED"> PROGRAM BUDGETED </option>
					<option value="RENTBUDGETED"> RENT BUDGETED </option>
					<option value="SOUNDBUDGETED"> SOUND/LIGHTS BUDGETED </option>
					<option value="TICKETPRINTING2BUDGETED"> TICKET PRINTING BUDGETED </option>
					<option value="TELEPHONESBUDGETED"> TELEPHONES/INTERNET BUDGETED </option>
					<option value="DRYICEBUDGETED"> DRY ICE/CO2 BUDGETED </option>
					<option value="PRESSAGENTFEEBUDGETED"> PRESS AGENT FEE BUDGETED </option>
					<option value="OTHERDBUDGETED"> OTHER D BUDGETED </option>
					<option value="OTHEEDBUDGETED"> OTHER E BUDGETED </option>
					<option value="OTHEFDBUDGETED"> OTHER F BUDGETED </option>
					<option value="OTHEGDBUDGETED"> OTHER G BUDGETED </option>
					<option value="PIANOBUDGETED"> PIANO TUNINGS </option>
					<option value="LOCALFIXEDBUDGETED"> LOCAL FIXED BUDGETED </option>
					<option value="SUBTOTALLOCALEXPENSESBUDGETED"> SUB-TOTAL OF LOCAL EXPENSES BUDGETED </option>
					<option value="TOTALLOCALEXPENSEBUDGETED"> TOTAL LOCAL EXPENSE BUDGETED </option>
					<option value="ADVERTISINGACTUAL"> ADVERTISING (AT GROSS) ACTUAL </option>
					<option value="STAGEHANDSLOAINACTUAL"> STAGEHANDS (LOAD-IN) ACTUAL </option>
					<option value="STAGEHANDSLOADOUTACTUAL"> STAGEHANDS (LOAD-OUT) ACTUAL </option>
					<option value="STAGEHANDSRUNNINGACTUAL"> STAGEHANDS (RUNNING) ACTUAL </option>
					<option value="WARDROBELOADINACTUAL"> WARDROBE AND HAIR (LOAD-IN) ACTUAL </option>
					<option value="WARDROBELOADOUTACTUAL"> WARDROBE AND HAIR (LOAD-OUT) ACTUAL </option>
					<option value="WARDROBERUNNINGACTUAL"> WARDROBE AND HAIR (RUNNING) ACTUAL </option>
					<option value="LABORCATERINGACTUAL"> LABOR CATERING ACTUAL </option>
					<option value="MUSICIANSACTUAL"> MUSICIANS ACTUAL </option>
					<option value="INSURANCEACTUAL"> INSURANCE (ON DROP COUNT) ACTUAL </option>
					<option value="TICKETPRINTING1ACTUAL"> TICKET PRINTING ACTUAL </option>
					<option value="OTHERCACTUAL"> OTHER C ACTUAL </option>
					<option value="SUBTOTALVARIABLEEXPENSEACTUAL"> SUBTOTAL OF VARIABLE EXPENSE ACTUAL </option>
					<option value="ADAEXPENSEACTUAL"> ADA EXPENSE ACTUAL </option>
					<option value="BOXOFFICEACTUAL"> BOX OFFICE ACTUAL </option>
					<option value="HOSPITALITYACTUAL"> HOSPITALITY (WATER) ACTUAL </option>
					<option value="THIRDPARTYACTUAL"> 3RD PARTY EQUIPMENT RENTAL ACTUAL </option>
					<option value="HOUSESTAFFACTUAL"> HOUSE STAFF ACTUAL </option>
					<option value="LICENSESACTUAL"> LICENSES/PERMITS ACTUAL </option>
					<option value="LIMOSAUTOACTUAL"> LIMOS/AUTO ACTUAL </option>
					<option value="ORCHESTRAACTUAL"> ORCHESTRA SHELL REMOVAL ACTUAL </option>
					<option value="PRESENTERPROFITACTUAL"> PRESENTER PROFIT ACTUAL </option>
					<option value="SECURITYACTUAL"> POLICE/SECURITY/FIRE MARSHALL ACTUAL </option>
					<option value="PROGRAMACTUAL"> PROGRAM ACTUAL </option>
					<option value="RENTACTUAL"> RENT ACTUAL </option>
					<option value="SOUNDACTUAL"> SOUND/LIGHTS ACTUAL </option>
					<option value="TICKETPRINTING2ACTUAL"> TICKET PRINTING ACTUAL </option>
					<option value="TELEPHONESACTUAL"> TELEPHONES/INTERNET ACTUAL </option>
					<option value="DRYICEACTUAL"> DRY ICE/CO2 ACTUAL </option>
					<option value="PRESSAGENTFEEACTUAL"> PRESS AGENT FEE ACTUAL </option>
					<option value="OTHERDACTUAL"> OTHER D ACTUAL </option>
					<option value="OTHERDACTUAL"> OTHER E ACTUAL </option>
					<option value="OTHERDACTUAL"> OTHER F ACTUAL </option>
					<option value="OTHERDACTUAL"> OTHER G ACTUAL </option>
					<option value="PIANOACTUAL"> PIANO TUNINGS ACTUAL </option>
					<option value="LOCALFIXEDACTUAL"> LOCAL FIXED ACTUAL </option>
					<option value="SUBTOTALLOCALEXPENSESACTUAL"> SUB-TOTAL OF LOCAL EXPENSES </option>
					<option value="TOTALLOCALEXPENSEACTUAL"> TOTAL LOCAL EXPENSE </option>
					<option value="TOTALENGAGEMENTEXPENSES"> TOTAL ENGAGEMENT EXPENSES </option>
					<option value="MIDDLEMONIESTOCOMPANY"> MIDDLE MONIES TO COMPANY </option>
					<option value="MIDDLEMONIESTOPRESENTER"> MIDDLE MONIES TO PRESENTER </option>
					<option value="MONEYREMAINING"> MONEY REMAINING </option>
					<option value="COMPANYOVERAGEPERCENTAGE"> COMPANY OVERAGE PERCENTAGE </option>
					<option value="TOTALCOMPANYOVERAGEAMOUNT"> TOTAL COMPANY OVERAGE AMOUNT </option>
					<option value="NETSTARPERFORMEROVERAGEPERCENTAGE"> NET STAR PERFORMER OVERAGE PERCENTAGE </option>
					<option value="TOTALSTARPERFORMEROVERAGEAMOUNT"> TOTAL STAR PERFORMER OVERAGE AMOUNT </option>
					<option value="PRESENTEROVERAGETOCOMPANY"> PRESENTER OVERAGE PERCENTAGE TO COMPANY </option>
					<option value="PRESENTEROVERAGEADJUSTED"> PRESENTER OVERAGE PERCENTAGE ADJUSTED COMPANY SHARE </option>
					<option value="PRESENTEROVERAGETOPRESENTER"> PRESENTER OVERAGE PERCENTAGE TO PRESENTER </option>
					<option value="TOTALCOMPANYSHARE"> TOTAL COMPANY SHARE </option>
					<option value="LESSDIRECTCOMPANYCHARGES"> LESS DIRECT COMPANY CHARGES </option>
					<option value="ADJUSTEDCOMPANYSHARE"> ADJUSTED COMPANY SHARE </option>
					<option value="TOTALPRESENTERSHARE"> TOTAL PRESENTER SHARE </option>
					<option value="PRESENTERFACILITYFEE"> PRESENTER'S FACILITY FEE </option>
					<option value="ADJUSTEDPRESENTERSHARE"> ADJUESTED PRESENTER SHARE </option>
					<option value="NOTES"> NOTES </option>
				</select>
			</td>
			<td>

			</td>
			<td>

			</td>
			<td>
			</td>
		</tr>
	</table>
	<b><font color=red>*</font> Indicates a mandatory field</b></p>
</form>	
	<div style="display:none" class="loader" id="loader"></div>
	<div style="display:none" class="export" id="export">
		<form method="POST">
			<input type="image" name="excel" src="../images/excel.png" width=30 onclick=this.form.action="export_excel.php">
			<input type="image" name="pdf" src="../images/pdf.png" width=30 onclick=this.form.action="export_pdf.php">
			</p>
			<table id="allroutestable">
				<thead id="header">
				</thead>
				<tbody id="body">
				</tbody>
			</table>
			<input type='hidden' class="htmlpdf" name=htmlpdf>
			<input type='hidden' class="htmlexc" name=htmlexc>
			<input type='hidden' class="name" name=name value="Market_History">
		</form>
	</div>
</body>
</html>
<?php
	$conn->close();
	include '../footer.html';
?> 