<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
$description = "Accessed APPROVED DEALS & TERMS Module";
include '../security_log.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "
<html>
<head>
<link rel=\"stylesheet\" href=\"../css/jquery.stickytable.min.css\">
<style>
#contracts {
    font-family: \"Trebuchet MS\", Arial, Helvetica, sans-serif;
	font-size: 11px;
    border-collapse: collapse;
    width: 100%;
}
#contracts td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}
#contracts tr:nth-child(even){background-color: #f2f2f2;}
#contracts tr:hover {background-color: #ddd;}
#contracts th {
	padding: 8px;
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #000066;
    color: white;
}
</style>
</head>
<body>";

echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/jquery.stickytable.min.js\"></script>";
echo "<script src=\"../js/contracts_controller.js\"></script>";
echo "<script> getShows(); </script>";

echo "<h1>APPROVED DEALS & TERMS MANAGEMENT:</h1>";

echo "<form action=\"contracts_all.php\" method=\"POST\">";

echo "<table>";
echo "<tr><td>Shows:</td>";
echo "<td><select name=\"show\" class=\"shows\" id=\"showId\">";
echo "<option value=\"9999\">Select Show</option>
	  </select>";
echo "<input type=\"submit\" name=\"search\" value=\"Find\">";
echo "</tr>";
echo "</table>";

echo "</form>";
echo "<br>";

if (isset($_POST['show']))
{
	$selectedid = $_POST['show'];
	echo "<p><a href=\"javascript:window.open('contract_add.php','Add New Deal Terms','width=650,height=450')\">Add New Deal Terms</a></p><br>";
}
else
{
	$selectedid = '9999';
	echo "<p><a href=\"javascript:window.open('contract_add.php','Add New Deal Terms','width=650,height=450')\">Add New Deal Terms</a></p><br>";
	echo "No show selected<br>";
}

$sql = "SELECT 	co.ContractID as contractID, 
				sw.ShowNAME as contractSHOW_NAME,
				pr.PresenterNAME as contractPRESENTER_NAME,
				ve.VenueNAME as contractVENUE_NAME,
				ci.`name` as contractCITY, 
				st.`name` as contractSTATE, 
				DATE_FORMAT(contractOPENING_DATE,'%m/%d/%Y') as contractOPENING_DATE,
				DATE_FORMAT(contractCLOSING_DATE,'%m/%d/%Y') as contractCLOSING_DATE,
				contractGROSS_POTENTIAL,
				contractGUARANTEE,
				contractTOTAL_PRESENTER_EXPENSES 
		FROM contracts co, cities ci, states st, countries ct, shows sw, presenters pr, venues ve  
		WHERE co.showid = $selectedid  
		AND co.showid = sw.ShowID 
		AND co.ContractPRESENTERID = pr.PresenterID 
		AND co.ContractVENUEID = ve.VenueID 
		AND co.ContractCITYID = ci.id 
		AND ci.state_id = st.id 
		AND st.country_id = ct.id";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<div class=\"sticky-table\">";
	echo "<table id=\"contracts\" class=\"sortable\">
	<col width=9%>
	<col width=9%>
	<col width=9%>
	<col width=9%>
	<col width=9%>
	<col width=9%>
	<col width=9%>
	<col width=9%>
	<col width=9%>
	<col width=9%>
	<col width=9%>
	<thead>
    <tr class=\"sticky-header\">
	<th>Show Name</th>
	<th>Presenter</th>
	<th>Venue</th>
	<th>City</th>
	<th>State</th>
	<th>Opening Date</th>
	<th>Closing Date</th>
	<th>Gross Potential</th>
	<th>Guarantee</th>
	<th>Total Presenter Expenses</th>
	<th>Options</th>
	</tr>
	</thead>
	<tbody>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo 
		"<tr>
		<td>". $row["contractSHOW_NAME"]. "</td>
		<td>". $row["contractPRESENTER_NAME"]. "</td>
		<td>". $row["contractVENUE_NAME"]. "</td>
		<td>". $row["contractCITY"]."</td>
		<td align=center>". $row["contractSTATE"]."</td>
		<td align=center>". $row["contractOPENING_DATE"]."</td>
		<td align=center>". $row["contractCLOSING_DATE"]."</td>
		<td align=right>".number_format($row["contractGROSS_POTENTIAL"],2)."</td>
		<td align=right>".number_format($row["contractGUARANTEE"],2)."</td>
		<td align=right>".number_format($row["contractTOTAL_PRESENTER_EXPENSES"],2)."</td>
		<td align=center>
		<a href=\"javascript:window.open('contract_modify_selected.php?selectedid=".$row['contractID']."','Modify Selected','width=650,height=530')\"><img src='../images/modify.png' width=20></a>   
		<a href=\"javascript:window.open('contract_delete_selected.php?selectedid=".$row['contractID']."','Delete Selected','width=480,height=530')\" hidden><img src='../images/delete.png' width=20></a>
		</td>
		</tr>";
    }
	echo "</tbody></table></div>";
	echo "<br>";
} else {
    echo "0 results. Please select another show.";
}
echo "</body></html>";
$conn->close();
include '../footer.html';
?> 