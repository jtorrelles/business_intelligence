<?php
require '../db/database_conn.php';
include '../session.php';
include '../header.html';
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
echo "<p><a href=\"javascript:window.open('settlement_add.php','Add New Settlement','width=650,height=450')\">Add a New Settlement</a> - <a href=\"javascript:window.open('upload_settlement.php','Upload  Settlement','width=650,height=450')\">Upload a New Settlement</a></p><br>";

if (isset($_POST['show']))
{
	$selectedid = $_POST['show'];
}
else
{
	$selectedid = '9999';
	echo "No show selected<br>";
}

$sql = "SELECT 	settlementid,
				sw.ShowID as showid,
				sw.ShowNAME as settlementshow_name,
				ve.VenueNAME as settlementvenue_name, 
				ci.`name` as settlementcity, 
				st.`name` as settlementstate,
				DATE_FORMAT(settlementopening_date,'%m/%d/%Y') as settlementopening_date,
				DATE_FORMAT(settlementclosing_date,'%m/%d/%Y') as settlementclosing_date, 
				FORMAT(settlementgross_potential,2) as settlementgross_potential,
				FORMAT(settlementactual_gross,2) as settlementactual_gross,
				FORMAT(settlementactual_gross-settlementnagbor,2) as settlementtae,
				FORMAT(settlementnagbor,2) as settlementnagbor,
				FORMAT(settlementtotal_presenter_expense,2) as settlementtotal_presenter_expense,
				FORMAT(settlementroyalty+settlementguarantee, 2) as settlementstcc,
				FORMAT(settlementtotal_presenter_expense+settlementroyalty+settlementguarantee,2) as settlementengagementexpense,
				FORMAT(settlementnagbor-settlementtotal_presenter_expense-settlementroyalty-settlementguarantee,2) as settlementmoney_remaining
		FROM settlements se, shows sw, venues ve, cities ci, states st, countries co 
		WHERE sw.ShowID = $selectedid 
		AND sw.ShowID = se.SettlementShowID 
		AND se.SettlementVENUEID = ve.VenueID 
		AND se.SettlementCITYID = ci.id 
		AND ci.state_id = st.id 
		AND st.country_id = co.id 
		ORDER BY settlementopening_date DESC";

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
	<th>Actual Gross</th>
	<th>Total Allowable Expenses</th>
	<th>NAGBOR</th>
	<th>Total Presenter Expense</th>
	<th>Subtotal Company Compensation</th>
	<th>Total Engagement Expense</th>
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
			<td>". $row["settlementshow_name"]. "</td>
			<td>". $row["settlementvenue_name"]. "</td>
			<td>". $row["settlementcity"]. "</td>
			<td>". $row["settlementopening_date"]."</td>
			<td>". $row["settlementclosing_date"]."</td>
			<td>". $row["settlementgross_potential"]. "</td>
			<td>". $row["settlementactual_gross"]. "</td>
			<td>". $row["settlementtae"]. "</td>
			<td>". $row["settlementnagbor"]."</td>
			<td>". $row["settlementtotal_presenter_expense"]."</td>
			<td>". $row["settlementstcc"]."</td>
			<td>". $row["settlementengagementexpense"]."</td>
			<td>". $row["settlementmoney_remaining"]."</td>
			<td align=center>
			<a href=\"javascript:window.open('settlement_preview_selected.php?selectedid=".$row['settlementid']."','Preview Selected','width=480,height=530')\"><img src='../images/view.png' width=20></a>   
			<a href=\"javascript:window.open('settlement_modify_selected.php?selectedid=".$row['settlementid']."','Modify Selected','width=480,height=530')\"><img src='../images/modify.png' width=20></a> 
			<a href=\"javascript:window.open('settlement_delete_selected.php?selectedid=".$row['settlementid']."','Delete Selected','width=480,height=530')\"><img src='../images/delete.png' width=20></a> 
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