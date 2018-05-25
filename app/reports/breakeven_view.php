<?php
require "../db/database_conn.php";
include "../session.php";
include "../header.html";
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<head>
	<style>
		input[type=number] {
			width: 100px;
		}
	</style>
</head>
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
		<td><input id="showsperweek" type=number value="0" step=0.01 onkeyup="weeklyHouseCapacity()"></td>
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
		<td><input id="noweeks" type=number value="0" step=1 onkeyup="noWeeks(); weeklyHouseCapacity();"></td>
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
		<td>Capacity:</td>
		<td><input id="capacity" type=number value="0" step=1 onkeyup="weeklyHouseCapacity()"></td>
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
		<td><input id="weeklygrosspotential" type=number value="0" step=0.01 onkeyup="avgPerTicket(); weeklyHouseCapacity();"></td>
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
		<td><input id="avgperticket" type=number value="0" step=0.01 readonly></td>
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
		<td><input type=number value="1" step=0.01></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><input type=number value="0" step=0.01></td>
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
		<td><input id="weeklyhc1" type=number value="0" readonly></td>
		<td><input id="weeklyhc2" type=number value="0" readonly></td>
		<td><input id="weeklyhc3" type=number value="0" readonly></td>
		<td><input id="weeklyhc4" type=number value="0" readonly></td>
		<td><input id="runhc1" type=number value="0"></td>
		<td><input id="runhc2" type=number value="0"></td>
		<td><input id="runhc3" type=number value="0"></td>
		<td><input id="runhc4" type=number value="0"></td>
		<td><input id="finalhc" type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Performance Capacity:</td>
		<td></td>
		<td><input id="weeklypc1" type=number value="100" style="background-color:lightblue;" onkeyup="weeklyHouseCapacity(); estimatedSingles();"></td>
		<td><input id="weeklypc2" type=number value="90" style="background-color:lightblue;" onkeyup="weeklyHouseCapacity(); estimatedSingles();"></td>
		<td><input id="weeklypc3" type=number value="80" style="background-color:lightblue;" onkeyup="weeklyHouseCapacity(); estimatedSingles();"></td>
		<td><input id="weeklypc4" type=number value="70" style="background-color:lightblue;" onkeyup="weeklyHouseCapacity(); estimatedSingles();"></td>
		<td><input id="runpc1" type=number value="100" style="background-color:lightblue;" onkeyup="weeklyHouseCapacity(); estimatedSingles();"></td>
		<td><input id="runpc2" type=number value="90" style="background-color:lightblue;" onkeyup="weeklyHouseCapacity(); estimatedSingles();"></td>
		<td><input id="runpc3" type=number value="80" style="background-color:lightblue;" onkeyup="weeklyHouseCapacity(); estimatedSingles();"></td>
		<td><input id="runpc4" type=number value="70" style="background-color:lightblue;" onkeyup="weeklyHouseCapacity(); estimatedSingles();"></td>
		<td><input type=number value="0" style="background-color:yellow;"></td>
	</tr>
	<tr>
		<td>Tickets Sold:</td>
		<td></td>
		<td><input id="weeklyts1" type=number value="0"></td>
		<td><input id="weeklyts2" type=number value="0"></td>
		<td><input id="weeklyts3" type=number value="0"></td>
		<td><input id="weeklyts4" type=number value="0"></td>
		<td><input id="runts1" type=number value="0"></td>
		<td><input id="runts2" type=number value="0"></td>
		<td><input id="runts3" type=number value="0"></td>
		<td><input id="runts4" type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Number of Weeks:</td>
		<td></td>
		<td><input type=number value="1" readonly></td>
		<td><input type=number value="1" readonly></td>
		<td><input type=number value="1" readonly></td>
		<td><input type=number value="1" readonly></td>
		<td><input id="noweeksRUN1" type=number value="0"></td>
		<td><input id="noweeksRUN2" type=number value="0"></td>
		<td><input id="noweeksRUN3" type=number value="0"></td>
		<td><input id="noweeksRUN4" type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Box Office Gross:</td>
		<td></td>
		<td><input id="weeklybog1" type=number value="0"></td>
		<td><input id="weeklybog2" type=number value="0"></td>
		<td><input id="weeklybog3" type=number value="0"></td>
		<td><input id="weeklybog4" type=number value="0"></td>
		<td><input id="runbog1" type=number value="0"></td>
		<td><input id="runbog2" type=number value="0"></td>
		<td><input id="runbog3" type=number value="0"></td>
		<td><input id="runbog4" type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Sub Load-in:</td>
		<td><input id="subloadin" type=number value="0" style="background-color:lightblue;" onkeyup="weeklySubLoadIn(); estimatedSingles(); adjustedGross();"></td>
		<td><input id="weeklysl1" type=number value="0"></td>
		<td><input id="weeklysl2" type=number value="0"></td>
		<td><input id="weeklysl3" type=number value="0"></td>
		<td><input id="weeklysl4" type=number value="0"></td>
		<td><input id="runsl1" type=number value="0"></td>
		<td><input id="runsl2" type=number value="0"></td>
		<td><input id="runsl3" type=number value="0"></td>
		<td><input id="runsl4" type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Estimated Groups:</td>
		<td><input id="estimatedgroups" type=number value="0" style="background-color:lightblue;" onkeyup="weeklyEstimatedGroups(); estimatedSingles(); adjustedGross();"></td>
		<td><input id="weeklyeg1" type=number value="0"></td>
		<td><input id="weeklyeg2" type=number value="0"></td>
		<td><input id="weeklyeg3" type=number value="0"></td>
		<td><input id="weeklyeg4" type=number value="0"></td>
		<td><input id="runeg1" type=number value="0"></td>
		<td><input id="runeg2" type=number value="0"></td>
		<td><input id="runeg3" type=number value="0"></td>
		<td><input id="runeg4" type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>	
	</tr>
	<tr>
		<td>Estimated Singles:</td>
		<td></td>
		<td><input id="weeklyes1" type=number value="0"></td>
		<td><input id="weeklyes2" type=number value="0"></td>
		<td><input id="weeklyes3" type=number value="0"></td>
		<td><input id="weeklyes4" type=number value="0"></td>
		<td><input id="runes1" type=number value="0"></td>
		<td><input id="runes2" type=number value="0"></td>
		<td><input id="runes3" type=number value="0"></td>
		<td><input id="runes4" type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Less Sub Discounts:</td>
		<td><input id="lesssubdiscounts" type=number value="0" style="background-color:lightblue;" onkeyup="weeklyEstimatedGroups(); estimatedSingles(); lessSubDiscounts(); adjustedGross();"></td>
		<td><input id="weeklysd1" type=number value="0"></td>
		<td><input id="weeklysd2" type=number value="0"></td>
		<td><input id="weeklysd3" type=number value="0"></td>
		<td><input id="weeklysd4" type=number value="0"></td>
		<td><input id="runsd1" type=number value="0"></td>
		<td><input id="runsd2" type=number value="0"></td>
		<td><input id="runsd3" type=number value="0"></td>
		<td><input id="runsd4" type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Less Group Discounts:</td>
		<td><input id="lessgroupdiscounts" type=number value="0" style="background-color:lightblue;" onkeyup="weeklyEstimatedGroups(); estimatedSingles(); lessGroupDiscounts(); adjustedGross();"></td>
		<td><input id="weeklygd1" type=number value="0" readonly></td>
		<td><input id="weeklygd2" type=number value="0" readonly></td>
		<td><input id="weeklygd3" type=number value="0" readonly></td>
		<td><input id="weeklygd4" type=number value="0" readonly></td>
		<td><input id="rungd1" type=number value="0" readonly></td>
		<td><input id="rungd2" type=number value="0" readonly></td>
		<td><input id="rungd3" type=number value="0" readonly></td>
		<td><input id="rungd4" type=number value="0" readonly></td>
		<td><input id="finalrd" type=number value="0" style="background-color:#ccffdd;" readonly></td>
	</tr>
	<tr>
		<td>Less Single Discounts:</td>
		<td><input id="lesssinglediscounts" type=number value="0" style="background-color:lightblue;" onkeyup="weeklyEstimatedGroups(); estimatedSingles(); lessSingleDiscounts(); adjustedGross();"></td>
		<td><input id="weeklysingles1" type=number value="0"></td>
		<td><input id="weeklysingles2" type=number value="0"></td>
		<td><input id="weeklysingles3" type=number value="0"></td>
		<td><input id="weeklysingles4" type=number value="0"></td>
		<td><input id="runsingles1" type=number value="0"></td>
		<td><input id="runsingles2" type=number value="0"></td>
		<td><input id="runsingles3" type=number value="0"></td>
		<td><input id="runsingles4" type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Adjusted Gross:</td>
		<td></td>
		<td><input id="weeklyag1" type=number value="0" readonly></td>
		<td><input id="weeklyag2" type=number value="0" readonly></td>
		<td><input id="weeklyag3" type=number value="0" readonly></td>
		<td><input id="weeklyag4" type=number value="0" readonly></td>
		<td><input id="runag1" type=number value="0" readonly></td>
		<td><input id="runag2" type=number value="0" readonly></td>
		<td><input id="runag3" type=number value="0" readonly></td>
		<td><input id="runag4" type=number value="0" readonly></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Adjusted GP%:</td>
		<td></td>
		<td><input type=number value="0" style="background-color:#ffe6e6;"></td>
		<td><input type=number value="0" style="background-color:#ffe6e6;"></td>
		<td><input type=number value="0" style="background-color:#ffe6e6;"></td>
		<td><input type=number value="0" style="background-color:#ffe6e6;"></td>
		<td><input type=number value="0" style="background-color:#ffe6e6;"></td>
		<td><input type=number value="0" style="background-color:#ffe6e6;"></td>
		<td><input type=number value="0" style="background-color:#ffe6e6;"></td>
		<td><input type=number value="0" style="background-color:#ffe6e6;"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Sales Tax 1:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Sales Tax 2:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Facility Fee 1:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Facility Fee 2:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Subscription Charge:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Groups Commission:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Credit Card & Other Commissions:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Net Adjusted B.O. Receipts:</td>
		<td></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
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
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Royalty:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Fixed Costs:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>ADA:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Advertising:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Catering:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Insurance:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Equipment Rental:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Ticket Printing:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Rent:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Stagehands (Load-in):</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Stagehands (Load-out):</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Stagehands (Running):</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Wardrobe & Hair (Load-in):</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Wardrobe & Hair (Load-out):</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Wardrobe & Hair (Running):</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Labor Catering:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Musicians:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Other:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Misc. - PR Fee:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Miscellaneous:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td><b>TOTAL LOCAL EXPENSE</b></td>
		<td></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
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
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Next Monies - To Producer:</td>
		<td><input type=number value="0" style="background-color:lightblue;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Next Monies - To Presenter:</td>
		<td><input type=number value="0" style="background-color:lightblue;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
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
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Presenter Overages:</td>
		<td><input type=number value="0" style="background-color:lightblue;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Producer Overages of Split:</td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Next Monies:</td>
		<td></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Variable Guarantee:</td>
		<td></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Guarantee:</td>
		<td></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td><b>TOTAL TO PRODUCER</b></td>
		<td></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td><i>U.S. Rate</i></td>
		<td></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
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
		<td>Less Taxes Withheld at Source %:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Less Taxes Withheld at Source $:</td>
		<td><input type=number value="0" style="background-color:lightblue;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td><b>Net Income to Producer</b></td>
		<td></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
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
		<td>Weekly Nut:</td>
		<td><input type=number value="0" style="background-color:green;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Royalty Minimum $:</td>
		<td><input type=number value="0" style="background-color:lightblue;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td>Variable Royalty %:</td>
		<td><input type=number value="0" style="background-color:lightblue;"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>
	<tr>
		<td><b>TOTAL SHOW PROFIT</b></td>
		<td></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0"></td>
		<td><input type=number value="0" style="background-color:#ccffdd;"></td>
	</tr>	
</table></p>
<script>
function noWeeks() {
    var now = document.getElementById("noweeks").value;
    document.getElementById("noweeksRUN1").value = now;
	document.getElementById("noweeksRUN2").value = now;
	document.getElementById("noweeksRUN3").value = now;
	document.getElementById("noweeksRUN4").value = now;
}
function avgPerTicket() {
    var wgp = document.getElementById("weeklygrosspotential").value;
	var cap = document.getElementById("capacity").value;
	var spw = document.getElementById("showsperweek").value;
	var cap_spw = cap * spw;
	var wgp_result = wgp / cap_spw;
	var wgp_result_fixed = wgp_result.toFixed(2);
    document.getElementById("avgperticket").value = wgp_result_fixed;
}
function weeklyHouseCapacity() {
    var spw = document.getElementById("showsperweek").value;
	var cap = document.getElementById("capacity").value;
	var spw_cap = spw * cap;
	var now = document.getElementById("noweeks").value;
	var spw_cap_now = spw_cap * now;
    document.getElementById("weeklyhc1").value = spw_cap;
	document.getElementById("weeklyhc2").value = spw_cap;
	document.getElementById("weeklyhc3").value = spw_cap;
	document.getElementById("weeklyhc4").value = spw_cap;
	document.getElementById("runhc1").value = spw_cap_now;
	document.getElementById("runhc2").value = spw_cap_now;
	document.getElementById("runhc3").value = spw_cap_now;
	document.getElementById("runhc4").value = spw_cap_now;
	document.getElementById("finalhc").value = spw_cap;
	
	var wpc1 = document.getElementById("weeklypc1").value;
	var wpc2 = document.getElementById("weeklypc2").value;
	var wpc3 = document.getElementById("weeklypc3").value;
	var wpc4 = document.getElementById("weeklypc4").value;
	var rpc1 = document.getElementById("runpc1").value;
	var rpc2 = document.getElementById("runpc2").value;
	var rpc3 = document.getElementById("runpc3").value;
	var rpc4 = document.getElementById("runpc4").value;	
	var resultwpc1 = (spw_cap * wpc1)/100;
	var resultwpc2 = (spw_cap * wpc2)/100;
	var resultwpc3 = (spw_cap * wpc3)/100;
	var resultwpc4 = (spw_cap * wpc4)/100;
	var resultrpc1 = (spw_cap_now * rpc1)/100;
	var resultrpc2 = (spw_cap_now * rpc2)/100;
	var resultrpc3 = (spw_cap_now * rpc3)/100;
	var resultrpc4 = (spw_cap_now * rpc4)/100;	
	document.getElementById("weeklyts1").value = resultwpc1;
	document.getElementById("weeklyts2").value = resultwpc2;
	document.getElementById("weeklyts3").value = resultwpc3;
	document.getElementById("weeklyts4").value = resultwpc4;
	document.getElementById("runts1").value = resultrpc1;
	document.getElementById("runts2").value = resultrpc2;
	document.getElementById("runts3").value = resultrpc3;
	document.getElementById("runts4").value = resultrpc4;
	
    var wgp = document.getElementById("weeklygrosspotential").value;
	var wbog1 = (wgp * wpc1)/100;
	var wbog2 = (wgp * wpc2)/100;
	var wbog3 = (wgp * wpc3)/100;
	var wbog4 = (wgp * wpc4)/100;
	var wbog1_fixed = wbog1.toFixed(2);
	var wbog2_fixed = wbog2.toFixed(2);
	var wbog3_fixed = wbog3.toFixed(2);
	var wbog4_fixed = wbog4.toFixed(2);
	var rbog1 = (wgp * rpc1 * now)/100;
	var rbog2 = (wgp * rpc2 * now)/100;
	var rbog3 = (wgp * rpc3 * now)/100;
	var rbog4 = (wgp * rpc4 * now)/100;
	var rbog1_fixed = rbog1.toFixed(2);
	var rbog2_fixed = rbog2.toFixed(2);
	var rbog3_fixed = rbog3.toFixed(2);
	var rbog4_fixed = rbog4.toFixed(2);
    document.getElementById("weeklybog1").value = wbog1_fixed;
	document.getElementById("weeklybog2").value = wbog2_fixed;
	document.getElementById("weeklybog3").value = wbog3_fixed;
	document.getElementById("weeklybog4").value = wbog4_fixed;
    document.getElementById("runbog1").value = rbog1_fixed;
	document.getElementById("runbog2").value = rbog2_fixed;
	document.getElementById("runbog3").value = rbog3_fixed;
	document.getElementById("runbog4").value = rbog4_fixed;	
}
function weeklySubLoadIn() {
    var sl = document.getElementById("subloadin").value;
	var now = document.getElementById("noweeks").value;
	var sl_now = sl / now;
    document.getElementById("weeklysl1").value = sl_now;
	document.getElementById("weeklysl2").value = sl_now;
	document.getElementById("weeklysl3").value = sl_now;
	document.getElementById("weeklysl4").value = sl_now;
    document.getElementById("runsl1").value = sl;
	document.getElementById("runsl2").value = sl;
	document.getElementById("runsl3").value = sl;
	document.getElementById("runsl4").value = sl;	
}
function weeklyEstimatedGroups() {
    var eg = document.getElementById("estimatedgroups").value;
	var now = document.getElementById("noweeks").value;
	var eg_now = eg / now;
    document.getElementById("weeklyeg1").value = eg_now;
	document.getElementById("weeklyeg2").value = eg_now;
	document.getElementById("weeklyeg3").value = eg_now;
	document.getElementById("weeklyeg4").value = eg_now;
    document.getElementById("runeg1").value = eg;
	document.getElementById("runeg2").value = eg;
	document.getElementById("runeg3").value = eg;
	document.getElementById("runeg4").value = eg;	
}
function estimatedSingles() {
    var wbog1 = document.getElementById("weeklybog1").value;
	var wbog2 = document.getElementById("weeklybog2").value;
	var wbog3 = document.getElementById("weeklybog3").value;
	var wbog4 = document.getElementById("weeklybog4").value;
    var wsl1 = document.getElementById("weeklysl1").value;
	var wsl2 = document.getElementById("weeklysl2").value;
	var wsl3 = document.getElementById("weeklysl3").value;
	var wsl4 = document.getElementById("weeklysl4").value;	
    var weg1 = document.getElementById("weeklyeg1").value;
	var weg2 = document.getElementById("weeklyeg2").value;
	var weg3 = document.getElementById("weeklyeg3").value;
	var weg4 = document.getElementById("weeklyeg4").value;
	var wes1 = wbog1 - wsl1 - weg1;
	var wes2 = wbog2 - wsl2 - weg2;
	var wes3 = wbog3 - wsl3 - weg3;
	var wes4 = wbog4 - wsl4 - weg4;
    document.getElementById("weeklyes1").value = wes1;
	document.getElementById("weeklyes2").value = wes2;
	document.getElementById("weeklyes3").value = wes3;
	document.getElementById("weeklyes4").value = wes4;

    var rbog1 = document.getElementById("runbog1").value;
	var rbog2 = document.getElementById("runbog2").value;
	var rbog3 = document.getElementById("runbog3").value;
	var rbog4 = document.getElementById("runbog4").value;
    var rsl1 = document.getElementById("runsl1").value;
	var rsl2 = document.getElementById("runsl2").value;
	var rsl3 = document.getElementById("runsl3").value;
	var rsl4 = document.getElementById("runsl4").value;	
    var reg1 = document.getElementById("runeg1").value;
	var reg2 = document.getElementById("runeg2").value;
	var reg3 = document.getElementById("runeg3").value;
	var reg4 = document.getElementById("runeg4").value;
	var res1 = rbog1 - rsl1 - reg1;
	var res2 = rbog2 - rsl2 - reg2;
	var res3 = rbog3 - rsl3 - reg3;
	var res4 = rbog4 - rsl4 - reg4;
    document.getElementById("runes1").value = res1;
	document.getElementById("runes2").value = res2;
	document.getElementById("runes3").value = res3;
	document.getElementById("runes4").value = res4;	
}
function lessSubDiscounts() {
    var lsd = document.getElementById("lesssubdiscounts").value;
	var wsl1 = document.getElementById("weeklysl1").value;
	var wsl2 = document.getElementById("weeklysl2").value;
	var wsl3 = document.getElementById("weeklysl3").value;
	var wsl4 = document.getElementById("weeklysl4").value;
	var lsd_wsl1 = wsl1 - (wsl1/(1-(lsd / 100)));
	var lsd_wsl2 = wsl2 - (wsl2/(1-(lsd / 100)));
	var lsd_wsl3 = wsl3 - (wsl3/(1-(lsd / 100)));
	var lsd_wsl4 = wsl4 - (wsl4/(1-(lsd / 100)));	
	var lsd_wsl1_fixed = lsd_wsl1.toFixed(2);
	var lsd_wsl2_fixed = lsd_wsl2.toFixed(2);	
	var lsd_wsl3_fixed = lsd_wsl3.toFixed(2);	
	var lsd_wsl4_fixed = lsd_wsl4.toFixed(2);
    document.getElementById("weeklysd1").value = lsd_wsl1_fixed;
	document.getElementById("weeklysd2").value = lsd_wsl2_fixed;
	document.getElementById("weeklysd3").value = lsd_wsl3_fixed;
	document.getElementById("weeklysd4").value = lsd_wsl4_fixed;
	
	var rsl1 = document.getElementById("runsl1").value;
	var rsl2 = document.getElementById("runsl2").value;
	var rsl3 = document.getElementById("runsl3").value;
	var rsl4 = document.getElementById("runsl4").value;
	var lsd_rsl1 = rsl1 - (rsl1/(1-(lsd / 100)));
	var lsd_rsl2 = rsl2 - (rsl2/(1-(lsd / 100)));
	var lsd_rsl3 = rsl3 - (rsl3/(1-(lsd / 100)));
	var lsd_rsl4 = rsl4 - (rsl4/(1-(lsd / 100)));	
	var lsd_rsl1_fixed = lsd_rsl1.toFixed(2);
	var lsd_rsl2_fixed = lsd_rsl2.toFixed(2);	
	var lsd_rsl3_fixed = lsd_rsl3.toFixed(2);	
	var lsd_rsl4_fixed = lsd_rsl4.toFixed(2);
    document.getElementById("runsd1").value = lsd_rsl1_fixed;
	document.getElementById("runsd2").value = lsd_rsl2_fixed;
	document.getElementById("runsd3").value = lsd_rsl3_fixed;
	document.getElementById("runsd4").value = lsd_rsl4_fixed;	
}

function lessGroupDiscounts() {
    var lgd = document.getElementById("lessgroupdiscounts").value;
	var weg1 = document.getElementById("weeklyeg1").value;
	var weg2 = document.getElementById("weeklyeg2").value;
	var weg3 = document.getElementById("weeklyeg3").value;
	var weg4 = document.getElementById("weeklyeg4").value;
	var lgd_weg1 = weg1 - (weg1/(1-(lgd / 100)));
	var lgd_weg2 = weg2 - (weg2/(1-(lgd / 100)));
	var lgd_weg3 = weg3 - (weg3/(1-(lgd / 100)));
	var lgd_weg4 = weg4 - (weg4/(1-(lgd / 100)));	
	var lgd_weg1_fixed = lgd_weg1.toFixed(2);
	var lgd_weg2_fixed = lgd_weg2.toFixed(2);	
	var lgd_weg3_fixed = lgd_weg3.toFixed(2);	
	var lgd_weg4_fixed = lgd_weg4.toFixed(2);
    document.getElementById("weeklygd1").value = lgd_weg1_fixed;
	document.getElementById("weeklygd2").value = lgd_weg2_fixed;
	document.getElementById("weeklygd3").value = lgd_weg3_fixed;
	document.getElementById("weeklygd4").value = lgd_weg4_fixed;
	
	var reg1 = document.getElementById("runeg1").value;
	var reg2 = document.getElementById("runeg2").value;
	var reg3 = document.getElementById("runeg3").value;
	var reg4 = document.getElementById("runeg4").value;
	var lgd_reg1 = reg1 - (reg1/(1-(lgd / 100)));
	var lgd_reg2 = reg2 - (reg2/(1-(lgd / 100)));
	var lgd_reg3 = reg3 - (reg3/(1-(lgd / 100)));
	var lgd_reg4 = reg4 - (reg4/(1-(lgd / 100)));	
	var lgd_reg1_fixed = lgd_reg1.toFixed(2);
	var lgd_reg2_fixed = lgd_reg2.toFixed(2);	
	var lgd_reg3_fixed = lgd_reg3.toFixed(2);	
	var lgd_reg4_fixed = lgd_reg4.toFixed(2);
    document.getElementById("rungd1").value = lgd_reg1_fixed;
	document.getElementById("rungd2").value = lgd_reg2_fixed;
	document.getElementById("rungd3").value = lgd_reg3_fixed;
	document.getElementById("rungd4").value = lgd_reg4_fixed;	
}

function lessSingleDiscounts() {
    var lsingled = document.getElementById("lesssinglediscounts").value;
	var wes1 = document.getElementById("weeklyes1").value;
	var wes2 = document.getElementById("weeklyes2").value;
	var wes3 = document.getElementById("weeklyes3").value;
	var wes4 = document.getElementById("weeklyes4").value;
	var lsingled_wes1 = -wes1 * (lsingled / 100);
	var lsingled_wes2 = -wes2 * (lsingled / 100);
	var lsingled_wes3 = -wes3 * (lsingled / 100);
	var lsingled_wes4 = -wes4 * (lsingled / 100);	
	var lsingled_wes1_fixed = lsingled_wes1.toFixed(2);
	var lsingled_wes2_fixed = lsingled_wes2.toFixed(2);	
	var lsingled_wes3_fixed = lsingled_wes3.toFixed(2);	
	var lsingled_wes4_fixed = lsingled_wes4.toFixed(2);
    document.getElementById("weeklysingles1").value = lsingled_wes1_fixed;
	document.getElementById("weeklysingles2").value = lsingled_wes2_fixed;
	document.getElementById("weeklysingles3").value = lsingled_wes3_fixed;
	document.getElementById("weeklysingles4").value = lsingled_wes4_fixed;
	
	var res1 = document.getElementById("runes1").value;
	var res2 = document.getElementById("runes2").value;
	var res3 = document.getElementById("runes3").value;
	var res4 = document.getElementById("runes4").value;
	var lsingled_res1 = -res1 * (lsingled / 100);
	var lsingled_res2 = -res2 * (lsingled / 100);
	var lsingled_res3 = -res3 * (lsingled / 100);
	var lsingled_res4 = -res4 * (lsingled / 100);	
	var lsingled_res1_fixed = lsingled_res1.toFixed(2);
	var lsingled_res2_fixed = lsingled_res2.toFixed(2);	
	var lsingled_res3_fixed = lsingled_res3.toFixed(2);	
	var lsingled_res4_fixed = lsingled_res4.toFixed(2);
    document.getElementById("runsingles1").value = lsingled_res1_fixed;
	document.getElementById("runsingles2").value = lsingled_res2_fixed;
	document.getElementById("runsingles3").value = lsingled_res3_fixed;
	document.getElementById("runsingles4").value = lsingled_res4_fixed;	
}

function adjustedGross() {
    var wsl1 = parseInt(document.getElementById("weeklysl1").value);
	var wsl2 = parseInt(document.getElementById("weeklysl2").value);
	var wsl3 = parseInt(document.getElementById("weeklysl3").value);
	var wsl4 = parseInt(document.getElementById("weeklysl4").value);
	var rsl1 = parseInt(document.getElementById("runsl1").value);
	var rsl2 = parseInt(document.getElementById("runsl2").value);
	var rsl3 = parseInt(document.getElementById("runsl3").value);
	var rsl4 = parseInt(document.getElementById("runsl4").value);
	
	var weg1 = parseInt(document.getElementById("weeklyeg1").value);
	var weg2 = parseInt(document.getElementById("weeklyeg2").value);
	var weg3 = parseInt(document.getElementById("weeklyeg3").value);
	var weg4 = parseInt(document.getElementById("weeklyeg4").value);
	var reg1 = parseInt(document.getElementById("runeg1").value);
	var reg2 = parseInt(document.getElementById("runeg2").value);
	var reg3 = parseInt(document.getElementById("runeg3").value);
	var reg4 = parseInt(document.getElementById("runeg4").value);	
	
	var wes1 = parseInt(document.getElementById("weeklyes1").value);
	var wes2 = parseInt(document.getElementById("weeklyes2").value);
	var wes3 = parseInt(document.getElementById("weeklyes3").value);
	var wes4 = parseInt(document.getElementById("weeklyes4").value);
	var res1 = parseInt(document.getElementById("runes1").value);
	var res2 = parseInt(document.getElementById("runes2").value);
	var res3 = parseInt(document.getElementById("runes3").value);
	var res4 = parseInt(document.getElementById("runes4").value);	
	
	var wsd1 = parseInt(document.getElementById("weeklysd1").value);
	var wsd2 = parseInt(document.getElementById("weeklysd2").value);
	var wsd3 = parseInt(document.getElementById("weeklysd3").value);
	var wsd4 = parseInt(document.getElementById("weeklysd4").value);
	var rsd1 = parseInt(document.getElementById("runsd1").value);
	var rsd2 = parseInt(document.getElementById("runsd2").value);
	var rsd3 = parseInt(document.getElementById("runsd3").value);
	var rsd4 = parseInt(document.getElementById("runsd4").value);	
	
	var wgd1 = parseInt(document.getElementById("weeklygd1").value);
	var wgd2 = parseInt(document.getElementById("weeklygd2").value);
	var wgd3 = parseInt(document.getElementById("weeklygd3").value);
	var wgd4 = parseInt(document.getElementById("weeklygd4").value);
	var rgd1 = parseInt(document.getElementById("rungd1").value);
	var rgd2 = parseInt(document.getElementById("rungd2").value);
	var rgd3 = parseInt(document.getElementById("rungd3").value);
	var rgd4 = parseInt(document.getElementById("rungd4").value);	
	
	var wsingles1 = parseInt(document.getElementById("weeklysingles1").value);
	var wsingles2 = parseInt(document.getElementById("weeklysingles2").value);
	var wsingles3 = parseInt(document.getElementById("weeklysingles3").value);
	var wsingles4 = parseInt(document.getElementById("weeklysingles4").value);
	var rsingles1 = parseInt(document.getElementById("runsingles1").value);
	var rsingles2 = parseInt(document.getElementById("runsingles2").value);
	var rsingles3 = parseInt(document.getElementById("runsingles3").value);
	var rsingles4 = parseInt(document.getElementById("runsingles4").value);	
	
	var wag1 = wsl1 + weg1 + wes1 + wsd1 + wgd1 + wsingles1;
	var wag2 = wsl2 + weg2 + wes2 + wsd2 + wgd2 + wsingles2;
	var wag3 = wsl3 + weg3 + wes3 + wsd3 + wgd3 + wsingles3;
	var wag4 = wsl4 + weg4 + wes4 + wsd4 + wgd4 + wsingles4;
	var rag1 = rsl1 + reg1 + res1 + rsd1 + rgd1 + rsingles1;
	var rag2 = rsl2 + reg2 + res2 + rsd2 + rgd2 + rsingles2;
	var rag3 = rsl3 + reg3 + res3 + rsd3 + rgd3 + rsingles3;
	var rag4 = rsl4 + reg4 + res4 + rsd4 + rgd4 + rsingles4;	
	
	document.getElementById("weeklyag1").value = wag1;
	document.getElementById("weeklyag2").value = wag2;
	document.getElementById("weeklyag3").value = wag3;
	document.getElementById("weeklyag4").value = wag4;
	document.getElementById("runag1").value = rag1;
	document.getElementById("runag2").value = rag2;
	document.getElementById("runag3").value = rag3;
	document.getElementById("runag4").value = rag4;	
}	
</script>
<?
$conn->close();
include "../footer.html";
?> 