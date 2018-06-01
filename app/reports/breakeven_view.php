<?php
require "../db/database_conn.php";
include "../session.php";
include "../header.html";
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<<<<<<< HEAD
<head>
	<style>
		input[type=number] {
			width: 100px;
		}
	</style>
</head>
=======

<html>
<head>
</head>
<body>

<link rel="stylesheet" type="text/css" href="../css/style.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/breakeven_controller.js"></script>
<script src="../js/jquery.mask.min.js"></script>
<script src="../js/utility.js"></script>
<h1>BREAKEVEN ANALYSIS</h1>
<p><table width=100%>
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
		<td><font color=green><b>SHOW NAME</b></font></td>
		<td><font color=green><b>City</b></font></td>
		<td><font color=green><b>STATE</b></font></td>
		<td></td>
		<td><font color=green><b>Init Date</b></font></td>
		<td><font color=green><b>End Date</b></font></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>BOOKING ANALYSIS</td>
		<td><font color=green><b>Venue</b></font></td>
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
		<td>No. of Shows Per Week:</td>
		<td><input id="NSPWII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>

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
		<td># of Weeks:</td>
		<td><input id="NOW1II" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>

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
		<td>Seats Per Show:</td>
		<td><input id="SPSHII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>

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
		<td>Weekly Gross Potential:</td>
		<td><input id="WGPOII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>

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
		<td>Net Avg. Per Tix:</td>
		<td><input id="NAPTII" type=text value="0.00" class="money5 text" readonly></td>

		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align=center>Cumulative Engagement Break</td>
	</tr>
	<tr>
		<td>Exchange Rate:</td>
		<td><input id="EXRAII" type=text value="1" class="money bgreenb" onkeyup="BCalc()"></td>

		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><input id="CUEBII" type=text value="0" class="money bgreenb" onkeyup="BCalc()"></td>

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
		<td align=center>Weekly Engagement</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td align=center>Weekly</td>
		<td align=center>Weekly</td>
		<td align=center>Weekly</td>
		<td align=center>Weekly</td>
		<td align=center>RUN</td>
		<td align=center>RUN</td>
		<td align=center>RUN</td>
		<td align=center>RUN</td>
		<td align=center>BREAKEVEN</td>
	</tr>
	<tr>
		<td>House Capacity:</td>
		<td></td>
		<td><input id="HOCAW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOCAW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOCAW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOCAW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOCAR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOCAR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOCAR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOCAR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOCATT" type=text value="0" class="money2 bgreena" readonly></td>

	</tr>
	<tr>
		<td>Performance Capacity:</td>
		<td></td>
		<td><input id="PECAW1" type=text value="100" class="money4 bblue" onkeyup="BCalc()"></td>
		<td><input id="PECAW2" type=text value="90" class="money4 bblue" onkeyup="BCalc()"></td>
		<td><input id="PECAW3" type=text value="80" class="money4 bblue" onkeyup="BCalc()"></td>
		<td><input id="PECAW4" type=text value="70" class="money4 bblue" onkeyup="BCalc()"></td>
		<td><input id="PECAR1" type=text value="100" class="money4 bblue" onkeyup="BCalc()"></td>
		<td><input id="PECAR2" type=text value="90" class="money4 bblue" onkeyup="BCalc()"></td>
		<td><input id="PECAR3" type=text value="80" class="money4 bblue" onkeyup="BCalc()"></td>
		<td><input id="PECAR4" type=text value="70" class="money4 bblue" onkeyup="BCalc()"></td>
		<td><input id="PECATT" type=text value="0" class="money4 byellow" onkeyup="BCalc()"></td>

	</tr>
	<tr>
		<td>Tickets Sold:</td>
		<td></td>
		<td><input id="TISOW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TISOW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TISOW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TISOW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TISOR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TISOR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TISOR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TISOR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TISOTT" type=text value="0" class="money2 bgreena" readonly></td>

	</tr>
	<tr>
		<td>Number of Weeks:</td>
		<td></td>
		<td><input id="NOW2W1" type=text value="1" class="money2 text" readonly></td>
		<td><input id="NOW2W2" type=text value="1" class="money2 text" readonly></td>
		<td><input id="NOW2W3" type=text value="1" class="money2 text" readonly></td>
		<td><input id="NOW2W4" type=text value="1" class="money2 text" readonly></td>
		<td><input id="NOW2R1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NOW2R2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NOW2R3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NOW2R4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NOW2TT" type=text value="0" class="money2 bgreena" readonly></td>

	</tr>
	<tr>
		<td>Box Office Gross:</td>
		<td></td>
		<td><input id="BOGRW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="BOGRW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="BOGRW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="BOGRW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="BOGRR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="BOGRR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="BOGRR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="BOGRR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="BOGRTT" type=text value="0" class="money2 bgreena"></td>
	</tr>
	<tr>
		<td>Sub Load-in:</td>
		<td><input id="SLINII" type=text value="0" class="money2 bblue" onkeyup="BCalc()"></td>
		<td><input id="SLINW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SLINW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SLINW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SLINW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SLINR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SLINR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SLINR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SLINW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SLINTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Estimated Groups:</td>
		<td><input id="ESGRII" type=text value="0" class="money2 bblue" onkeyup="BCalc()"></td>
		<td><input id="ESGRW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ESGRW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ESGRW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ESGRW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ESGRR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ESGRR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ESGRR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ESGRR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ESGRTT" type=text value="0" class="money2 bgreena" readonly></td>	

	</tr>
	<tr>
		<td>Estimated Singles:</td>
		<td></td>
		<td><input id="ESSIW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ESSIW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ESSIW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ESSIW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ESSIR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ESSIR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ESSIR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ESSIR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ESSITT" type=text value="0" class="money2 byellow" readonly></td>
	</tr>
	<tr>
		<td>Less Subs Discounts:</td>
		<td><input id="LSUDII" type=text value="0" class="money2 bblue" onkeyup="BCalc()"></td>
		<td><input id="LSUDW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LSUDW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LSUDW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LSUDW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LSUDR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LSUDR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LSUDR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LSUDR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LSUDTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Less Group Discounts:</td>
		<td><input id="LGRDII" type=text value="0" class="money2 bblue" onkeyup="BCalc()"></td>
		<td><input id="LGRDW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LGRDW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LGRDW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LGRDW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LGRDR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LGRDR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LGRDR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LGRDR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LGRDTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Less Single Discounts:</td>
		<td><input id="LSIDII" type=text value="0" class="money2 bblue" onkeyup="BCalc()"></td>
		<td><input id="LSIDW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LSIDW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LSIDW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LSIDW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LSIDR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LSIDR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LSIDR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LSIDR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LSIDTT" type=text value="0" class="money2 bgreena" readonly></td>

	</tr>
	<tr>
		<td>Adjusted Gross:</td>
		<td></td>
		<td><input id="AGROW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="AGROW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="AGROW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="AGROW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="AGROR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="AGROR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="AGROR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="AGROR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="AGROTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Adjusted Gross Potential %:</td>
		<td></td>
		<td><input id="AGPPW1" type=text value="0" class="money2 bpink" readonly></td>
		<td><input id="AGPPW2" type=text value="0" class="money2 bpink" readonly></td>
		<td><input id="AGPPW3" type=text value="0" class="money2 bpink" readonly></td>
		<td><input id="AGPPW4" type=text value="0" class="money2 bpink" readonly></td>
		<td><input id="AGPPR1" type=text value="0" class="money2 bpink" readonly></td>
		<td><input id="AGPPR2" type=text value="0" class="money2 bpink" readonly></td>
		<td><input id="AGPPR3" type=text value="0" class="money2 bpink" readonly></td>
		<td><input id="AGPPR4" type=text value="0" class="money2 bpink" readonly></td>
		<td><input id="AGPPTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Sales Tax 1:</td>
		<td><input id="TAX1II" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="TAX1W1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TAX1W2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TAX1W3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TAX1W4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TAX1R1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TAX1R2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TAX1R3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TAX1R4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TAX1TT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Sales Tax 2:</td>
		<td><input id="TAX2II" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="TAX2W1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TAX2W2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TAX2W3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TAX2W4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TAX2R1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TAX2R2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TAX2R3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TAX2R4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TAX2TT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Facility Fee 1:</td>
		<td><input id="FAF1II" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="FAF1W1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FAF1W2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FAF1W3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FAF1W4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FAF1R1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FAF1R2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FAF1R3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FAF1R4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FAF1TT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Facility Fee 2:</td>
		<td><input id="FAF2II" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="FAF2W1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FAF2W2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FAF2W3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FAF2W4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FAF2R1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FAF2R2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FAF2R3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FAF2R4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FAF2TT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Subscription Commission:</td>
		<td><input id="SUBCII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="SUBCW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SUBCW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SUBCW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SUBCW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SUBCR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SUBCR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SUBCR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SUBCR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SUBCTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Group Sales Commission:</td>
		<td><input id="GSACII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="GSACW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GSACW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GSACW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GSACW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GSACR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GSACR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GSACR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GSACR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GSACTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Credit Card & Other Commissions:</td>
		<td><input id="CCOCII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="CCOCW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="CCOCW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="CCOCW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="CCOCW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="CCOCR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="CCOCR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="CCOCR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="CCOCR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="CCOCTT" type=text value="0" class="money2 bgreena" readonly></td>

	</tr>
	<tr>
		<td>Net Adjusted B.O. Receipts:</td>
		<td></td>
		<td><input id="NABRW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NABRW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NABRW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NABRW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NABRR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NABRR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NABRR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NABRR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NABRTT" type=text value="0" class="money2 bgreena" readonly></td>
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
		<td><b>WEEKLY EXPENSES</b></td>
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
		<td>Guarantee:</td>
		<td><input id="GUA1II" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="GUA1W1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GUA1W2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GUA1W3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GUA1W4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GUA1R1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GUA1R2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GUA1R3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GUA1R4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GUA1TT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Variable Guarantee:</td>
		<td><input id="VGUAII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="VGUAW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VGUAW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VGUAW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VGUAW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VGUAR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VGUAR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VGUAR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VGUAR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VGUATT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Advertising (at gross):</td>
		<td><input id="ADVEII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="ADVEW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ADVEW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ADVEW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ADVEW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ADVER1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ADVER2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ADVER3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ADVER4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ADVETT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Stagehands (Load-in):</td>
		<td><input id="STINII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="STINW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STINW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STINW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STINW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STINR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STINR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STINR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STINR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STINTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Stagehands (Load-out):</td>
		<td><input id="STOTII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="STOTW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STOTW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STOTW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STOTW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STOTR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STOTR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STOTR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STOTR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STOTTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Stagehands (Running):</td>
		<td><input id="STRUII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="STRUW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STRUW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STRUW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STRUW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STRUR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STRUR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STRUR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STRUR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="STRUTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Wardrobe & Hair (Load-in):</td>
		<td><input id="WHINII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="WHINW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHINW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHINW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHINW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHINR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHINR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHINR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHINR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHINTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Wardrobe & Hair (Load-out):</td>
		<td><input id="WHOTII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="WHOTW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHOTW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHOTW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHOTW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHOTR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHOTR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHOTR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHOTR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHOTTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Wardrobe & Hair (Running):</td>
		<td><input id="WHRUII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="WHRUW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHRUW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHRUW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHRUW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHRUR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHRUR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHRUR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHRUR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WHRUTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Labor Catering:</td>
		<td><input id="LACAII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="LACAW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LACAW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LACAW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LACAW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LACAR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LACAR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LACAR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LACAR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LACATT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Musicians:</td>
		<td><input id="MUSIII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="MUSIW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="MUSIW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="MUSIW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="MUSIW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="MUSIR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="MUSIR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="MUSIR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="MUSIR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="MUSITT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Insurance (on drop count):</td>
		<td><input id="INSUII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="INSUW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="INSUW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="INSUW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="INSUW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="INSUR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="INSUR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="INSUR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="INSUR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="INSUTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Ticket Printing:</td>
		<td><input id="TIPRII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="TIPRW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TIPRW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TIPRW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TIPRW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TIPRR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TIPRR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TIPRR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TIPRR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TIPRTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Other:</td>
		<td><input id="OTH1II" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="OTH1W1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH1W2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH1W3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH1W4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH1R1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH1R2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH1R3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH1R4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH1TT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Ada Expense:</td>
		<td><input id="ADEXII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="ADEXW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ADEXW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ADEXW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ADEXW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ADEXR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ADEXR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ADEXR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ADEXR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ADEXTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Box Office:</td>
		<td><input id="BOOFII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="BOOFW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="BOOFW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="BOOFW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="BOOFW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="BOOFR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="BOOFR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="BOOFR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="BOOFR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="BOOFTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Dry Ice/Co2:</td>
		<td><input id="DRICII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="DRICW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="DRICW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="DRICW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="DRICW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="DRICR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="DRICR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="DRICR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="DRICR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="DRICTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Fire Marshall/Pyro:</td>
		<td><input id="FIMAII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="FIMAW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FIMAW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FIMAW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FIMAW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FIMAR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FIMAR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FIMAR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FIMAR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FIMATT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Hospitality/Water:</td>
		<td><input id="HOWAII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="HOWAW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOWAW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOWAW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOWAW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOWAR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOWAR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOWAR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOWAR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOWATT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>House Staff:</td>
		<td><input id="HOSTII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="HOSTW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOSTW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOSTW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOSTW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOSTR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOSTR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOSTR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOSTR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="HOSTTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Licenses/Permits:</td>
		<td><input id="LIPEII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="LIPEW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIPEW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIPEW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIPEW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIPER1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIPER2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIPER3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIPER4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIPETT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Limos/Auto (Stars/Pr):</td>
		<td><input id="LIAUII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="LIAUW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIAUW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIAUW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIAUW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIAUR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIAUR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIAUR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIAUR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIAUTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Piano Tunings:</td>
		<td><input id="PITUII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="PITUW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PITUW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PITUW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PITUW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PITUR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PITUR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PITUR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PITUR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PITUTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Police/Security:</td>
		<td><input id="POSEII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="POSEW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="POSEW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="POSEW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="POSEW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="POSER1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="POSER2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="POSER3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="POSER4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="POSETT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Presenter Profit:</td>
		<td><input id="PRPRII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="PRPRW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PRPRW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PRPRW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PRPRW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PRPRR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PRPRR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PRPRR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PRPRR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PRPRTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Press Agent Fee:</td>
		<td><input id="PRAFII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="PRAFW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PRAFW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PRAFW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PRAFW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PRAFR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PRAFR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PRAFR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PRAFR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PRAFTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Programs:</td>
		<td><input id="PROGII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="PROGW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PROGW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PROGW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PROGW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PROGR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PROGR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PROGR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PROGR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PROGTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Rent:</td>
		<td><input id="RENTII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="RENTW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="RENTW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="RENTW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="RENTW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="RENTR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="RENTR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="RENTR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="RENTR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="RENTTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Sound/Lights:</td>
		<td><input id="SOLIII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="SOLIW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SOLIW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SOLIW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SOLIW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SOLIR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SOLIR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SOLIR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SOLIR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="SOLITT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Telephones/Internet:</td>
		<td><input id="TEINII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="TEINW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TEINW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TEINW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TEINW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TEINR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TEINR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TEINR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TEINR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TEINTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>3rd Party Equipment Rental:</td>
		<td><input id="PAERII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="PAERW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PAERW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PAERW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PAERW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PAERR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PAERR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PAERR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PAERR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PAERTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Truck Parking/Wreckers:</td>
		<td><input id="TRPAII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="TRPAW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TRPAW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TRPAW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TRPAW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TRPAR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TRPAR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TRPAR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TRPAR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TRPATT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Other:</td>
		<td><input id="OTH2II" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="OTH2W1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH2W2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH2W3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH2W4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH2R1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH2R2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH2R3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH2R4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH2TT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Other:</td>
		<td><input id="OTH3II" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="OTH3W1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH3W2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH3W3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH3W4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH3R1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH3R2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH3R3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH3R4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH3TT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Other:</td>
		<td><input id="OTH4II" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="OTH4W1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH4W2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH4W3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH4W4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH4R1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH4R2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH4R3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH4R4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH4TT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Other:</td>
		<td><input id="OTH5II" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="OTH5W1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH5W2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH5W3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH5W4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH5R1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH5R2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH5R3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH5R4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="OTH5TT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Local Fixed:</td>
		<td><input id="LOFIII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="LOFIW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LOFIW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LOFIW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LOFIW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LOFIR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LOFIR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LOFIR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LOFIR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LOFITT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td><b>TOTAL LOCAL EXPENSE</b></td>
		<td></td>
		<td><input id="TLEXW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TLEXW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TLEXW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TLEXW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TLEXR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TLEXR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TLEXR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TLEXR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TLEXTT" type=text value="0" class="money2 bgreena" readonly></td>
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
		<td><b>FORMULA CHECK</b></td>
		<td></td>
		<td><input id="FOCHW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FOCHW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FOCHW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FOCHW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FOCHR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FOCHR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FOCHR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FOCHR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="FOCHTT" type=text value="0" class="money2 bgreena" readonly></td>

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
		<td><b>Money Remaining</b></td>
		<td></td>
		<td><input id="MOREW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="MOREW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="MOREW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="MOREW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="MORER1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="MORER2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="MORER3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="MORER4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="MORETT" type=text value="0" class="money2 bgreena" readonly></td>
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
		<td>Next Monies - To Producer:</td>
		<td><input id="NPROII" type=text value="0" class="money2 bblue" onkeyup="BCalc()"></td>
		<td><input id="NPROW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NPROW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NPROW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NPROW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NPROR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NPROR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NPROR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NPROR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NPROTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Next Monies - To Presenter:</td>
		<td><input id="NPREII" type=text value="0" class="money2 bblue" onkeyup="BCalc()"></td>
		<td><input id="NPREW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NPREW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NPREW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NPREW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NPRER1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NPRER2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NPRER3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NPRER4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NPRETT" type=text value="0" class="money2 bgreena" readonly></td>

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
		<td><b>Total Engagement Profit</b></td>
		<td></td>
		<td><input id="TEPRW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TEPRW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TEPRW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TEPRW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TEPRR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TEPRR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TEPRR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TEPRR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TEPRTT" type=text value="0" class="money2 byellow" readonly></td>
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
		<td>Producer Share of Overages:</td>
		<td><input id="PROOII" type=text value="0" class="money2 bblue" onkeyup="BCalc()"></td>
		<td><input id="PROOW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PROOW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PROOW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PROOW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PROOR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PROOR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PROOR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PROOR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PROOTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Presenter Share of Overages:</td>
		<td><input id="PREOII" type=text value="0" class="money2 bblue" onkeyup="BCalc()"></td>
		<td><input id="PREOW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PREOW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PREOW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PREOW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PREOR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PREOR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PREOR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PREOR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="PREOTT" type=text value="0" class="money2 bgreena" readonly></td>

	</tr>
	<tr>
		<td>Next Monies:</td>
		<td></td>
		<td><input id="NEMOW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NEMOW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NEMOW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NEMOW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NEMOR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NEMOR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NEMOR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NEMOR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NEMOTT" type=text value="0" class="money2 bgreena" readonly></td>

	</tr>
	<tr>
		<td>Variable Guarantee:</td>
		<td></td>
		<td><input id="VAGUW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VAGUW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VAGUW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VAGUW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VAGUR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VAGUR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VAGUR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VAGUR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VAGUTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Guarantee:</td>
		<td></td>
		<td><input id="GUA2W1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GUA2W2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GUA2W3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GUA2W4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GUA2R1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GUA2R2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GUA2R3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GUA2R4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="GUA2TT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td><b>TOTAL TO PRODUCER</b></td>
		<td></td>
		<td><input id="TTPRW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TTPRW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TTPRW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TTPRW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TTPRR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TTPRR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TTPRR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TTPRR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TTPRTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td><i>U.S. Rate</i></td>
		<td></td>
		<td><input id="USRAW1" type=text value="0" class="money2 money2 text" readonly></td>
		<td><input id="USRAW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="USRAW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="USRAW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="USRAR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="USRAR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="USRAR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="USRAR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="USRATT" type=text value="0" class="money2 bgreena" readonly></td>
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
		<td>Less Income Taxes Witheld (1):</td>
		<td><input id="LIT1II" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="LIT1W1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIT1W2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIT1W3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIT1W4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIT1R1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIT1R2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIT1R3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIT1R4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIT1TT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Less Income Taxes Witheld (2):</td>
		<td><input id="LIT2II" type=text value="0" class="money2 bblue" onkeyup="BCalc()"></td>
		<td><input id="LIT2W1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIT2W2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIT2W3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIT2W4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIT2R1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIT2R2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIT2R3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIT2R4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="LIT2TT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td><b>Net Income to Producer</b></td>
		<td></td>
		<td><input id="NITPW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NITPW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NITPW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NITPW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NITPR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NITPW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NITPW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NITPW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="NITPTT" type=text value="0" class="money2 bgreena" readonly></td>
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
		<td>Weekly Operating Expenses (include Amort):</td>
		<td><input id="WOEXII" type=text value="0" class="money2 bgreenb" onkeyup="BCalc()"></td>
		<td><input id="WOEXW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WOEXW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WOEXW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WOEXW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WOEXR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WOEXR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WOEXR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WOEXR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="WOEXTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Royalty Minimum $:</td>
		<td><input id="ROMIII" type=text value="0" class="money2 bblue" onkeyup="BCalc()"></td>
		<td><input id="ROMIW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ROMIW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ROMIW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ROMIW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ROMIR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ROMIR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ROMIR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ROMIR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="ROMITT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td>Variable Royalty %:</td>
		<td><input id="VAROII" type=text value="0" class="money2 bblue" onkeyup="BCalc()"></td>
		<td><input id="VAROW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VAROW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VAROW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VAROW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VAROR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VAROR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VAROR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VAROR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="VAROTT" type=text value="0" class="money2 bgreena" readonly></td>
	</tr>
	<tr>
		<td><b>TOTAL SHOW PROFIT</b></td>
		<td></td>
		<td><input id="TSPRW1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TSPRW2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TSPRW3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TSPRW4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TSPRR1" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TSPRR2" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TSPRR3" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TSPRR4" type=text value="0" class="money2 text" readonly></td>
		<td><input id="TSPRTT" type=text value="0" class="money2 byellow" readonly></td>
	</tr>	
</table></p>

</body>
</html>

<?
$conn->close();
include "../footer.html";
?> 