<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
$description = "Accessed SETTLEMENTS Module";
include '../security_log.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "
<html>
<head>
<style>
#settlements {
    font-family: \"Trebuchet MS\", Arial, Helvetica, sans-serif;
	font-size: 11px;
    border-collapse: collapse;
    width: 100%;
}

#settlements td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#settlements tr:nth-child(even){background-color: #f2f2f2;}

#settlements tr:hover {background-color: #ddd;}

#settlements th {
	padding: 8px;
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #000066;
    color: white;
}
</style>
</head>
<body>";

echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/settlements_controller.js\"></script>";
echo "<script> getShows(); </script>";

echo "<h1>Settlements Administration:</h1>";
$selectedid = '0';
$selectedstate = '0';

echo "<form action=\"settlements_all.php\" method=\"POST\">";

	echo "<table>";
	echo "<tr><td>Shows:</td>";
	echo "<td><select name=\"show\" class=\"shows\" id=\"showId\">";
	echo "<option value=\"\">Select Show</option>
		  </select>";
	echo "<input type=\"submit\" name=\"search\" value=\"Find\">";
	echo "</tr>";
	echo "</table>";

echo "</form>";

echo "<br>";
echo "<p><a href=\"javascript:void(window.open('settlement_add.php','Add New Settlement','width=700,height=450,top=100'))\">Add a New Settlement</a>";
echo " - "; 
echo "<a href=\"javascript:void(window.open('upload_settlement.php','Upload  Settlement','width=650,height=450,top=100'))\">Upload a New Settlement</a></p>";
echo "<br>";

if (isset($_POST['show']))
{
	$selectedid = $_POST['show'];
}
else
{
	$selectedid = '9999';
	echo "No show selected<br>";
}

$sql = "SELECT 	se.ID,
				sw.ShowID as showid,
				sw.ShowNAME as show_name,
				ve.VenueNAME as venue_name, 
				ci.`name` as city, 
				st.`name` as state,
				DATE_FORMAT(OPENINGDATE,'%m/%d/%Y') as OPENINGDATE,
				DATE_FORMAT(CLOSINGDATE,'%m/%d/%Y') as CLOSINGDATE, 
				GROSSBOXOFFICEPOTENTIAL as GROSS_POTENTIAL,
				GROSSBOXOFFICERECEIPTS as GROSS_RECEIPTS,
				NAGBOR as NAGBOR,
				TOTALENGAGEMENTEXPENSES as TOTAL_ENGAGEMENT_EXPENSES,
				TOTALCOMPANYROYALTY as TOTAL_COMPANY_ROYALTY,
				TOTALCOMPANYGUARANTEE as TOTAL_COMPANY_GUARANTEE, 
				MONEYREMAINING as MONEY_REMAINING
		FROM settlements se, shows sw, venues ve, cities ci, states st, countries co 
		WHERE sw.ShowID = $selectedid 
		AND sw.ShowID = se.SHOWID 
		AND se.VENUEID = ve.VenueID 
		AND se.CITYID = ci.id 
		AND ci.state_id = st.id 
		AND st.country_id = co.id 
		ORDER BY OPENINGDATE DESC";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<table id=\"settlements\">
	<col width=14.28%>
    <col width=14.28%>
	<col width=14.28%>
	<col width=14.28%>
	<col width=14.28%>
	<col width=14.28%>
	<col width=14.28%>
    <tr>
	<th>Show Name</th>
	<th>Venue</th>
	<th>City</th>
	<th>Opening Date</th>
	<th>Closing Date</th>
	<th>Gross Potential</th>
	<th>Gross Receipts</th>
	<th>NAGBOR</th>
	<th>Total Engagement Expense</th>
	<th>Total Company Royalty</th>
	<th>Total Company Guarantee</th>
	<th>Money Remaining</th>
	<th>Options</th>
	</tr>";
    // output data of each row
	$total_records = 0;
	$total_amount = 0;
    while($row = $result->fetch_assoc()) {
		$total_records = $total_records + 1;
		echo 
		"<tr>
			<td>". $row["show_name"]. "</td>
			<td>". $row["venue_name"]. "</td>
			<td>". $row["city"]. "</td>
			<td>". $row["OPENINGDATE"]."</td>
			<td>". $row["CLOSINGDATE"]."</td>
			<td>". number_format($row["GROSS_POTENTIAL"],2) ."</td>
			<td>". number_format($row["GROSS_RECEIPTS"],2) ."</td>
			<td>". number_format($row["NAGBOR"],2) ."</td>
			<td>". number_format($row["TOTAL_ENGAGEMENT_EXPENSES"],2) ."</td>
			<td>". number_format($row["TOTAL_COMPANY_ROYALTY"],2) ."</td>
			<td>". number_format($row["TOTAL_COMPANY_GUARANTEE"],2) ."</td>
			<td>". number_format($row["MONEY_REMAINING"],2) ."</td>
			<td align=center>
			<a href=\"javascript:void(window.open('settlement_preview_selected.php?selectedid=".$row['ID']."','Preview Selected','width=650,height=530,top=100'))\"><img src='../images/view.png' width=20></a>   
			<a href=\"javascript:void(window.open('settlement_modify_selected.php?selectedid=".$row['ID']."','Modify Selected','width=700,height=580,top=100'))\"><img src='../images/modify.png' width=20></a> 
			<a href=\"javascript:void(window.open('settlement_delete_selected.php?selectedid=".$row['ID']."','Delete Selected','width=700,height=530,top=100'))\" hidden ><img src='../images/delete.png' width=20></a> 
		</td>
		</tr>";
    }
	echo "</table>";
	echo "<br>";
	echo "Total Records: ".$total_records."<br>";
} else {
    echo "0 results. Please select another show.";
}
echo "</body></html>";
$conn->close();
include '../footer.html';
?> 