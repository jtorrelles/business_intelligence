<?php

	require "../db/database_conn.php";
	include "../session.php";
	include "../header.html";
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

?>

<html>
<head>
</head>
<body>

<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="../js/multiple/multiple-select.css">

<script src="../js/jquery.min.js"></script>
<script src="../js/multiple/multiple-select.js"></script>
<script src="../js/breakeven_controller.js"></script>
<script src="../js/jquery.maskMoney.min.js"></script>
<script src="../js/utility.js"></script>

<script> getCountries(); getBasicShowsByStatus('Y'); getVenues();</script>

<h1>Breakeven Analysis Report:</h1>
<div class="selection_data" id="selection_data">
	<table style="width:100%">
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>			
			<th>ACTIONS</th>
		</tr>
		<tr>
			<td>
				<b>Country:</b>
			</td>
			<td>
				<select name="country" class="countries" id="countryId">
					<option value="">Select Country</option>
				</select>
			</td>
			<td>
				<b>State:</b>
			</td>		
			<td>
				<select name="state" class="states" id="stateId">
					<option value="">Select State</option>
				</select>
			</td>
			<td>
				<b>City:</b>
			</td>			
			<td>
				<select name="city" class="cities" id="cityId">
					<option value="">Select City</option>
				</select>
			</td>
			<td align="center" rowspan="2">
				<input type="button" class="button" id="btnFindBreakevenSelection" value="Find">
				<input type="button" class="button" id="btnCleanBreakevenSelection" value="Clear">
				<input type="button" class="button" id="btnBreakevenManual" value="Manually">
			</td>
		</tr>
		<tr>
			<td>
				<b>Init Date <font color=red>*</font>:</b>
			</td>		
			<td>
				<input type="date" class="dateini" name="dateini">
			</td>
			<td>
				<b>End Date <font color=red>*</font>:</b>
			</td>	
			<td>
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
			<td>
				<b>Shows:</b>
			</td>
			<td>
				<select name="show" class="shows" id="showId">
					<option value="0">Select Show</option>
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
		<td>
				<b>Venues:</b>
			</td>
			<td>
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
	</table>
	<p><b><font color=red>*</font> Indicates a mandatory field</b></p>
</div>
<div style="display:none" class="loader" id="loader"></div>
<div style="display:none" class="results" id="results">
	<h3><font color=blue>Results of Breakeven Selection:</font></h3>
	<div style="display:none" class="contracts_data" id="contracts_data">
		<h3>Approved Deals & Terms (Contracts):</h3>
		<table style="width:100%" class="tablecss">
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>
			<tr>
				<th>Show Name</th>
				<th>Opening Date</th>
				<th>Closing Date</th>
				<th>City</th>
				<th>State</th>
				<th>Venue</th>			
				<th>OPTIONS</th>
			</tr>
			<tbody id="body_contracts">
			</tbody>
		</table>		
	</div>	
	<div style="display:none" class="routes_data" id="routes_data">
		<h3>Routes:</h3>
		<table style="width:100%" class="tablecss">
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>			
			<tr>
				<th>Show Name</th>
				<th>Opening Date</th>
				<th>Closing Date</th>
				<th>City</th>
				<th>State</th>
				<th>Venue</th>			
				<th>OPTIONS</th>
			</tr>
			<tbody id="body_routes">
			</tbody>
		</table>		
	</div>	
	<div style="display:none" class="settements_data" id="settements_data">
		<h3>Recent Settlements (History Data):</h3>
		<table style="width:100%" class="tablecss">
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>			
			<tr>
				<th>Show Name</th>
				<th>Opening Date</th>
				<th>Closing Date</th>
				<th>City</th>
				<th>State</th>
				<th>Venue</th>			
				<th>OPTIONS</th>
			</tr>
			<tbody id="body_settlements">
			</tbody>
		</table>	
	</div>
	<div style="display:none" class="contracts_nodata" id="contracts_nodata">
		<h3><font color=red>No Approved Deals & Terms Data</font></h3>
	</div>	
	<div style="display:none" class="routes_nodata" id="routes_nodata">
		<h3><font color=red>No Routes / Details Routes Data</font></h3>
	</div>
	<div style="display:none" class="settements_nodata" id="settements_nodata">
		<h3><font color=red>No Recent Settlements (History Data)</font></h3>
	</div>
</div>
<div style="display:none" id="back_to_selection">
	<p><a href='#' id="btnBackSelection">Return to Selection</a></p><br>
</div>
<form id="frmbreakeven" method="POST" target="pp">
	<div style="display:none" id="export">
		<input type="image" name="excel" src="../images/excel.png" width=30 onclick=this.form.action="breakeven_excel.php">
		<input type="image" name="pdf" src="../images/pdf.png" width=30 onclick=this.form.action="breakeven_pdf.php">
		<input type="image" name="goalseek" src="../images/goalseek.png" width=30 onclick=GoalSeek();>
	</div>
	<br>
	<div style="display:none" class="breakeven_data" id="breakeven_data">
		<table width=100% id="btable">
			<col width=20%>
			<col width=8%>
			<col width=8%>
			<col width=8%>
			<col width=8%>
			<col width=8%>
			<col width=8%>
			<col width=8%>
			<col width=8%>
			<col width=8%>
			<col width=8%>
			<tr>
				<td class="a7" colspan="1" id="SHNAME"><b>SHOW NAME: </b></td>
				<td class="a7" colspan="2" id="CINAME"><b>CITY: </b></td>
				<td class="a7" colspan="3" id="STNAME"><b>STATE: </b></td>
				<td><input id="SHNAMEID" name="SHNAMEID" type=hidden></td>
				<td><input id="CINAMEID" name="CINAMEID" type=hidden></td>
				<td><input id="STNAMEID" name="STNAMEID" type=hidden></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td class="a7" colspan="1" id="IDATE"><b>INIT DATE: </b></td>
				<td class="a7" colspan="2" id="EDATE"><b>END DATE: </b></td>
				<td class="a7" colspan="3" id="VENUE"><b>VENUE: </b></td>
				<td><input id="IDATEID" name="IDATEID" type=hidden></td>
				<td><input id="EDATEID" name="EDATEID" type=hidden></td>
				<td><input id="VENUEID" name="VENUEID" type=hidden></td>
				<td></td>
				<td></td>
			</tr>		
			<tr>
				<td class="a1">BOOKING ANALYSIS</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td class="a1">No. of Shows Per Week:</td>
				<td class="a0 a3"><input id="NSPWII" name="NSPWII" type=text value="0" class="m4 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>	
			<tr>
				<td class="a1"># of Weeks:</td>
				<td class="a0 a3"><input id="NOW1II" name="NOW1II" type=text value="0" class="m4 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td class="a1">Seats Per Show:</td>
				<td class="a0 a3"><input id="SPSHII" name="SPSHII" type=text value="0" class="m4 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td class="a1">Weekly Gross Potential:</td>
				<td class="a0 a3"><input id="WGPOII" name="WGPOII" type=text value="0" class="m4 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td class="a1">Net Avg. Per Tix:</td>
				<td class="a0"><input id="NAPTII" name="NAPTII" type=text value="$ 0.00" class="m7 t1" readonly></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td  class="a1" align=center>Cumulative Engagement Break</td>
			</tr>
			<tr>
				<td class="a1">Exchange Rate:</td>
				<td class="a0 a3"><input id="EXRAII" name="EXRAII" type=text value="1" class="m4 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="a0"><input id="CUEBII" type=text value="$ 0" class="t1" readonly></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td  class="a1" align=center>Weekly Engagement</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td class="a1"  align=center>Weekly</td>
				<td class="a1" align=center>Weekly</td>
				<td class="a1" align=center>Weekly</td>
				<td class="a1" align=center>Weekly</td>
				<td class="a1" align=center>RUN</td>
				<td class="a1" align=center>RUN</td>
				<td class="a1" align=center>RUN</td>
				<td class="a1" align=center>RUN</td>
				<td class="a1" align=center>BREAKEVEN</td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td class="a1">House Capacity:</td>
				<td></td>
				<td class="a0"><input id="HOCAW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOCAW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOCAW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOCAW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOCAR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOCAR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOCAR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOCAR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="HOCATT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Performance Capacity:</td>
				<td></td>
				<td class="a0 a6"><input id="PECAW1" name="PECAW1" type=text value="100.00%" class="m5 b3" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0 a6"><input id="PECAW2" name="PECAW2" type=text value="90.00%" class="m5 b3" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0 a6"><input id="PECAW3" name="PECAW3" type=text value="80.00%" class="m5 b3" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0 a6"><input id="PECAW4" name="PECAW4" type=text value="70.00%" class="m5 b3" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0 a6"><input id="PECAR1" name="PECAR1" type=text value="100.00%" class="b3" readonly></td>
				<td class="a0 a6"><input id="PECAR2" name="PECAR2" type=text value="90.00%" class="b3" readonly></td>
				<td class="a0 a6"><input id="PECAR3" name="PECAR3" type=text value="80.00%" class="b3" readonly></td>
				<td class="a0 a6"><input id="PECAR4" name="PECAR4" type=text value="70.00%" class="b3" readonly></td>
				<td class="a0 a4"><input id="PECATT" name="PECATT" type=text value="0.00%" class="m5 b4" onkeyup="BCalc()" tabindex="1"></td>
			</tr>
			<tr>
				<td class="a1">Tickets Sold:</td>
				<td></td>
				<td class="a0"><input id="TISOW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TISOW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TISOW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TISOW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TISOR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TISOR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TISOR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TISOR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="TISOTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Number of Weeks:</td>
				<td></td>
				<td class="a0"><input id="NOW2W1" type=text value="1" class="t1" readonly></td>
				<td class="a0"><input id="NOW2W2" type=text value="1" class="t1" readonly></td>
				<td class="a0"><input id="NOW2W3" type=text value="1" class="t1" readonly></td>
				<td class="a0"><input id="NOW2W4" type=text value="1" class="t1" readonly></td>
				<td class="a0"><input id="NOW2R1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NOW2R2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NOW2R3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NOW2R4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="NOW2TT" type=text value="1" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Box Office Gross:</td>
				<td></td>
				<td class="a0"><input id="BOGRW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="BOGRW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="BOGRW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="BOGRW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="BOGRR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="BOGRR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="BOGRR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="BOGRR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="BOGRTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Sub Load-in:</td>
				<td class="a0 a6"><input id="SLINII" name="SLINII" type=text value="0" class="m4 b3" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="SLINW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SLINW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SLINW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SLINW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SLINR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SLINR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SLINR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SLINR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="SLINTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Estimated Groups:</td>
				<td class="a0 a6"><input id="ESGRII" name="ESGRII" type=text value="0" class="m4 b3" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="ESGRW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ESGRW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ESGRW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ESGRW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ESGRR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ESGRR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ESGRR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ESGRR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="ESGRTT" type=text value="0" class="b1" readonly></td>	
			</tr>
			<tr>
				<td class="a1">Estimated Singles:</td>
				<td></td>
				<td class="a0"><input id="ESSIW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ESSIW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ESSIW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ESSIW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ESSIR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ESSIR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ESSIR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ESSIR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="ESSITT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Less Subs Discounts:</td>
				<td class="a0 a6"><input id="LSUDII" name="LSUDII" type=text value="0.00%" class="m5 b3" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="LSUDW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LSUDW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LSUDW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LSUDW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LSUDR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LSUDR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LSUDR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LSUDR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="LSUDTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Less Group Discounts:</td>
				<td class="a0 a6"><input id="LGRDII" name="LGRDII" type=text value="0.00%" class="m5 b3" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="LGRDW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LGRDW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LGRDW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LGRDW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LGRDR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LGRDR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LGRDR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LGRDR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="LGRDTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Less Single Discounts:</td>
				<td class="a0 a6"><input id="LSIDII" name="LSIDII" type=text value="0.00%" class="m5 b3" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="LSIDW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LSIDW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LSIDW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LSIDW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LSIDR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LSIDR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LSIDR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LSIDR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="LSIDTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Adjusted Gross:</td>
				<td></td>
				<td class="a0"><input id="AGROW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="AGROW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="AGROW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="AGROW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="AGROR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="AGROR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="AGROR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="AGROR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="AGROTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Adjusted Gross Potential %:</td>
				<td></td>
				<td class="a0 a5"><input id="AGPPW1" type=text value="0%" class="b5" readonly></td>
				<td class="a0 a5"><input id="AGPPW2" type=text value="0%" class="b5" readonly></td>
				<td class="a0 a5"><input id="AGPPW3" type=text value="0%" class="b5" readonly></td>
				<td class="a0 a5"><input id="AGPPW4" type=text value="0%" class="b5" readonly></td>
				<td class="a0 a5"><input id="AGPPR1" type=text value="0%" class="b5" readonly></td>
				<td class="a0 a5"><input id="AGPPR2" type=text value="0%" class="b5" readonly></td>
				<td class="a0 a5"><input id="AGPPR3" type=text value="0%" class="b5" readonly></td>
				<td class="a0 a5"><input id="AGPPR4" type=text value="0%" class="b5" readonly></td>
				<td class="a0 a2"><input id="AGPPTT" type=text value="0%" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Sales Tax 1:</td>
				<td class="a0 a3"><input id="TAX1II" name="TAX1II" type=text value="0.00%" class="m5 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="TAX1W1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TAX1W2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TAX1W3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TAX1W4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TAX1R1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TAX1R2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TAX1R3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TAX1R4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="TAX1TT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Sales Tax 2:</td>
				<td class="a0 a3"><input id="TAX2II" name="TAX2II" type=text value="0.00%" class="m5 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="TAX2W1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TAX2W2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TAX2W3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TAX2W4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TAX2R1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TAX2R2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TAX2R3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TAX2R4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="TAX2TT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Facility Fee 1:</td>
				<td class="a0 a3"><input id="FAF1II" name="FAF1II" type=text value="$ 0.00" class="m7 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="FAF1W1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FAF1W2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FAF1W3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FAF1W4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FAF1R1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FAF1R2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FAF1R3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FAF1R4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="FAF1TT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Facility Fee 2:</td>
				<td class="a0 a3"><input id="FAF2II" name="FAF2II" type=text value="$ 0.00" class="m7 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="FAF2W1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FAF2W2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FAF2W3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FAF2W4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FAF2R1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FAF2R2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FAF2R3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FAF2R4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="FAF2TT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Subscription Commission:</td>
				<td class="a0 a3"><input id="SUBCII" name="SUBCII" type=text value="0%" class="m6 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="SUBCW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SUBCW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SUBCW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SUBCW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SUBCR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SUBCR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SUBCR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SUBCR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="SUBCTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Group Sales Commission:</td>
				<td class="a0 a3"><input id="GSACII" name="GSACII" type=text value="0%" class="m6 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="GSACW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GSACW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GSACW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GSACW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GSACR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GSACR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GSACR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GSACR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="GSACTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Credit Card & Other Commissions:</td>
				<td class="a0 a3"><input id="CCOCII" name="CCOCII" type=text value="0%" class="m6 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="CCOCW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="CCOCW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="CCOCW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="CCOCW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="CCOCR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="CCOCR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="CCOCR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="CCOCR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="CCOCTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Net Adjusted B.O. Receipts:</td>
				<td></td>
				<td class="a0"><input id="NABRW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NABRW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NABRW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NABRW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NABRR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NABRR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NABRR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NABRR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="NABRTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td class="a1"><b>WEEKLY EXPENSES</b></td>
				<td>@ US $</td>
				<td>@ CAN $</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td class="a1">Guarantee:</td>
				<td class="a0 a3"><input id="GUA1II" name="GUA1II" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="GUA1W1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GUA1W2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GUA1W3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GUA1W4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GUA1R1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GUA1R2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GUA1R3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GUA1R4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="GUA1TT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Variable Guarantee:</td>
				<td class="a0 a3"><input id="VGUAII" name="VGUAII" type=text value="0.00%" class="m5 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="VGUAW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VGUAW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VGUAW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VGUAW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VGUAR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VGUAR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VGUAR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VGUAR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="VGUATT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Advertising (at gross):</td>
				<td class="a0 a3"><input id="ADVEII" name="ADVEII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="ADVEW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ADVEW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ADVEW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ADVEW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ADVER1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ADVER2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ADVER3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ADVER4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="ADVETT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Stagehands (Load-in):</td>
				<td class="a0 a3"><input id="STINII" name="STINII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="STINW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STINW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STINW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STINW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STINR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STINR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STINR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STINR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="STINTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Stagehands (Load-out):</td>
				<td class="a0 a3"><input id="STOTII" name="STOTII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="STOTW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STOTW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STOTW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STOTW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STOTR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STOTR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STOTR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STOTR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="STOTTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Stagehands (Running):</td>
				<td class="a0 a3"><input id="STRUII" name="STRUII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="STRUW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STRUW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STRUW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STRUW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STRUR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STRUR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STRUR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="STRUR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="STRUTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Wardrobe & Hair (Load-in):</td>
				<td class="a0 a3"><input id="WHINII" name="WHINII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="WHINW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHINW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHINW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHINW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHINR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHINR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHINR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHINR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="WHINTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Wardrobe & Hair (Load-out):</td>
				<td class="a0 a3"><input id="WHOTII" name="WHOTII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="WHOTW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHOTW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHOTW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHOTW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHOTR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHOTR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHOTR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHOTR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="WHOTTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Wardrobe & Hair (Running):</td>
				<td class="a0 a3"><input id="WHRUII" name="WHRUII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="WHRUW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHRUW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHRUW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHRUW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHRUR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHRUR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHRUR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WHRUR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="WHRUTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Labor Catering:</td>
				<td class="a0 a3"><input id="LACAII" name="LACAII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="LACAW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LACAW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LACAW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LACAW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LACAR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LACAR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LACAR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LACAR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="LACATT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Musicians:</td>
				<td class="a0 a3"><input id="MUSIII" name="MUSIII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="MUSIW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="MUSIW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="MUSIW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="MUSIW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="MUSIR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="MUSIR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="MUSIR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="MUSIR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="MUSITT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Insurance (on drop count):</td>
				<td class="a0 a3"><input id="INSUII" name="INSUII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="INSUW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="INSUW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="INSUW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="INSUW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="INSUR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="INSUR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="INSUR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="INSUR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="INSUTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Ticket Printing:</td>
				<td class="a0 a3"><input id="TIPRII" name="TIPRII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="TIPRW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TIPRW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TIPRW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TIPRW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TIPRR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TIPRR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TIPRR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TIPRR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="TIPRTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Other:</td>
				<td class="a0 a3"><input id="OTH1II" name="OTH1II" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="OTH1W1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH1W2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH1W3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH1W4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH1R1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH1R2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH1R3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH1R4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="OTH1TT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Ada Expense:</td>
				<td class="a0 a3"><input id="ADEXII" name="ADEXII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="ADEXW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ADEXW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ADEXW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ADEXW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ADEXR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ADEXR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ADEXR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ADEXR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="ADEXTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Box Office:</td>
				<td class="a0 a3"><input id="BOOFII" name="BOOFII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="BOOFW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="BOOFW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="BOOFW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="BOOFW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="BOOFR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="BOOFR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="BOOFR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="BOOFR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="BOOFTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Dry Ice/Co2:</td>
				<td class="a0 a3"><input id="DRICII" name="DRICII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="DRICW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="DRICW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="DRICW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="DRICW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="DRICR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="DRICR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="DRICR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="DRICR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="DRICTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Fire Marshall/Pyro:</td>
				<td class="a0 a3"><input id="FIMAII" name="FIMAII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="FIMAW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FIMAW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FIMAW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FIMAW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FIMAR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FIMAR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FIMAR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FIMAR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="FIMATT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Hospitality/Water:</td>
				<td class="a0 a3"><input id="HOWAII" name="HOWAII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="HOWAW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOWAW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOWAW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOWAW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOWAR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOWAR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOWAR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOWAR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="HOWATT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">House Staff:</td>
				<td class="a0 a3"><input id="HOSTII" name="HOSTII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="HOSTW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOSTW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOSTW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOSTW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOSTR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOSTR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOSTR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="HOSTR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="HOSTTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Licenses/Permits:</td>
				<td class="a0 a3"><input id="LIPEII" name="LIPEII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="LIPEW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIPEW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIPEW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIPEW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIPER1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIPER2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIPER3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIPER4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="LIPETT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Limos/Auto (Stars/Pr):</td>
				<td class="a0 a3"><input id="LIAUII" name="LIAUII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="LIAUW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIAUW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIAUW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIAUW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIAUR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIAUR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIAUR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIAUR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="LIAUTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Piano Tunings:</td>
				<td class="a0 a3"><input id="PITUII" name="PITUII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="PITUW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PITUW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PITUW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PITUW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PITUR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PITUR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PITUR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PITUR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="PITUTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Police/Security:</td>
				<td class="a0 a3"><input id="POSEII" name="POSEII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="POSEW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="POSEW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="POSEW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="POSEW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="POSER1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="POSER2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="POSER3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="POSER4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="POSETT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Presenter Profit:</td>
				<td class="a0 a3"><input id="PRPRII" name="PRPRII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="PRPRW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PRPRW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PRPRW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PRPRW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PRPRR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PRPRR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PRPRR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PRPRR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="PRPRTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Press Agent Fee:</td>
				<td class="a0 a3"><input id="PRAFII" name="PRAFII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="PRAFW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PRAFW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PRAFW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PRAFW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PRAFR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PRAFR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PRAFR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PRAFR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="PRAFTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Programs:</td>
				<td class="a0 a3"><input id="PROGII" name="PROGII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="PROGW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PROGW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PROGW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PROGW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PROGR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PROGR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PROGR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PROGR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="PROGTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Rent:</td>
				<td class="a0 a3"><input id="RENTII" name="RENTII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="RENTW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="RENTW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="RENTW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="RENTW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="RENTR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="RENTR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="RENTR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="RENTR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="RENTTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Sound/Lights:</td>
				<td class="a0 a3"><input id="SOLIII" name="SOLIII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="SOLIW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SOLIW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SOLIW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SOLIW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SOLIR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SOLIR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SOLIR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="SOLIR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="SOLITT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Telephones/Internet:</td>
				<td class="a0 a3"><input id="TEINII" name="TEINII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="TEINW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TEINW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TEINW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TEINW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TEINR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TEINR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TEINR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TEINR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="TEINTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">3rd Party Equipment Rental:</td>
				<td class="a0 a3"><input id="PAERII" name="PAERII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="PAERW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PAERW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PAERW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PAERW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PAERR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PAERR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PAERR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PAERR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="PAERTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Truck Parking/Wreckers:</td>
				<td class="a0 a3"><input id="TRPAII" name="TRPAII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="TRPAW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TRPAW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TRPAW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TRPAW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TRPAR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TRPAR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TRPAR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TRPAR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="TRPATT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Other:</td>
				<td class="a0 a3"><input id="OTH2II" name="OTH2II" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="OTH2W1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH2W2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH2W3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH2W4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH2R1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH2R2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH2R3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH2R4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="OTH2TT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Other:</td>
				<td class="a0 a3"><input id="OTH3II" name="OTH3II" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="OTH3W1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH3W2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH3W3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH3W4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH3R1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH3R2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH3R3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH3R4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="OTH3TT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Other:</td>
				<td class="a0 a3"><input id="OTH4II" name="OTH4II" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="OTH4W1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH4W2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH4W3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH4W4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH4R1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH4R2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH4R3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH4R4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="OTH4TT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Other:</td>
				<td class="a0 a3"><input id="OTH5II" name="OTH5II" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="OTH5W1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH5W2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH5W3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH5W4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH5R1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH5R2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH5R3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="OTH5R4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="OTH5TT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Local Fixed:</td>
				<td class="a0 a3"><input id="LOFIII" name="LOFIII" type=text value="0.00" class="m3 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="LOFIW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LOFIW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LOFIW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LOFIW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LOFIR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LOFIR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LOFIR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LOFIR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="LOFITT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1"><b>TOTAL LOCAL EXPENSE</b></td>
				<td></td>
				<td class="a0"><input id="TLEXW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TLEXW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TLEXW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TLEXW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TLEXR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TLEXR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TLEXR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TLEXR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="TLEXTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td class="a1"><b>FORMULA CHECK</b></td>
				<td></td>
				<td class="a0"><input id="FOCHW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FOCHW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FOCHW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FOCHW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FOCHR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FOCHR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FOCHR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="FOCHR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="FOCHTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td class="a1"><b>Money Remaining</b></td>
				<td></td>
				<td class="a0"><input id="MOREW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="MOREW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="MOREW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="MOREW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="MORER1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="MORER2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="MORER3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="MORER4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="MORETT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td class="a1">Next Monies - To Producer (Base):</td>
				<td class="a0 a3"><input id="NPROBB" name="NPROBB" type=text value="$ 0.00" class="m7 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td class="a1">Next Monies - To Producer:</td>
				<td class="a0 a6"><input id="NPROII" name="NPROII" type=text value="0%" class="m6 b3" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="NPROW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NPROW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NPROW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NPROW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NPROR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NPROR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NPROR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NPROR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="NPROTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Next Monies - To Presenter (Base):</td>
				<td class="a0 a3"><input id="NPREBB" name="NPREBB" type=text value="$ 0.00" class="m7 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td class="a1">Next Monies - To Presenter:</td>
				<td class="a0 a6"><input id="NPREII" name="NPREII" type=text value="0%" class="m6 b3" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="NPREW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NPREW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NPREW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NPREW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NPRER1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NPRER2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NPRER3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NPRER4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="NPRETT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td class="a1"><b>Total Engagement Profit</b></td>
				<td></td>
				<td class="a0"><input id="TEPRW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TEPRW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TEPRW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TEPRW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TEPRR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TEPRR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TEPRR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TEPRR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a4"><input id="TEPRTT" type=text value="0" class="b4" readonly></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td class="a1">Producer Share of Overages:</td>
				<td class="a0 a6"><input id="PROOII" name="PROOII" type=text value="0%" class="m6 b3" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="PROOW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PROOW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PROOW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PROOW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PROOR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PROOR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PROOR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PROOR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="PROOTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Presenter Share of Overages:</td>
				<td class="a0 a6"><input id="PREOII" name="PREOII" type=text value="0%" class="m6 b3" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="PREOW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PREOW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PREOW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PREOW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PREOR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PREOR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PREOR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="PREOR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="PREOTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Next Monies:</td>
				<td></td>
				<td class="a0"><input id="NEMOW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NEMOW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NEMOW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NEMOW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NEMOR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NEMOR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NEMOR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NEMOR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="NEMOTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Variable Guarantee:</td>
				<td></td>
				<td class="a0"><input id="VAGUW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VAGUW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VAGUW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VAGUW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VAGUR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VAGUR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VAGUR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VAGUR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="VAGUTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Guarantee:</td>
				<td></td>
				<td class="a0"><input id="GUA2W1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GUA2W2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GUA2W3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GUA2W4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GUA2R1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GUA2R2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GUA2R3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="GUA2R4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="GUA2TT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1"><b>TOTAL TO PRODUCER</b></td>
				<td></td>
				<td class="a0"><input id="TTPRW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TTPRW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TTPRW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TTPRW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TTPRR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TTPRR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TTPRR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TTPRR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="TTPRTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1"><i>U.S. Rate</i></td>
				<td></td>
				<td class="a0"><input id="USRAW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="USRAW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="USRAW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="USRAW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="USRAR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="USRAR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="USRAR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="USRAR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="USRATT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td class="a1">Less Income Taxes Witheld (1):</td>
				<td class="a0 a3"><input id="LIT1II" name="LIT1II" type=text value="0.00%" class="m5 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="LIT1W1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIT1W2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIT1W3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIT1W4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIT1R1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIT1R2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIT1R3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIT1R4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="LIT1TT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Less Income Taxes Witheld (2):</td>
				<td class="a0 a6"><input id="LIT2II" name="LIT2II" type=text value="0" class="m4 b3" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="LIT2W1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIT2W2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIT2W3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIT2W4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIT2R1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIT2R2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIT2R3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="LIT2R4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="LIT2TT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1"><b>Net Income to Producer</b></td>
				<td></td>
				<td class="a0"><input id="NITPW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NITPW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NITPW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NITPW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NITPR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NITPR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NITPR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="NITPR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="NITPTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td class="a1">Weekly Operating Expenses (include Amort):</td>
				<td class="a0 a3"><input id="WOEXII" name="WOEXII" type=text value="0" class="m4 b2" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="WOEXW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WOEXW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WOEXW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WOEXW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WOEXR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WOEXR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WOEXR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="WOEXR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="WOEXTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Royalty Minimum $:</td>
				<td class="a0 a6"><input id="ROMIII" name="ROMIII" type=text value="0" class="m4 b3" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="ROMIW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ROMIW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ROMIW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ROMIW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ROMIR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ROMIR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ROMIR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="ROMIR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="ROMITT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td class="a1">Variable Royalty %:</td>
				<td class="a0 a6"><input id="VAROII" name="VAROII" type=text value="0%" class="m6 b3" onkeyup="BCalc()" tabindex="1"></td>
				<td class="a0"><input id="VAROW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VAROW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VAROW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VAROW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VAROR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VAROR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VAROR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="VAROR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a2"><input id="VAROTT" type=text value="0" class="b1" readonly></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td class="a1"><b>TOTAL SHOW PROFIT</b></td>
				<td></td>
				<td class="a0"><input id="TSPRW1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TSPRW2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TSPRW3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TSPRW4" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TSPRR1" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TSPRR2" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TSPRR3" type=text value="0" class="t1" readonly></td>
				<td class="a0"><input id="TSPRR4" type=text value="0" class="t1" readonly></td>
				<td class="a0 a4"><input id="TSPRTT" type=text value="0" class="b4" readonly></td>
			</tr>	
		</table>
	</div>

</form>
<iframe name="pp" style="position:absolute; top:-1500px;"></iframe> 

</body>
</html>

<?php
	$conn->close();
	include '../footer.html';
?> 
