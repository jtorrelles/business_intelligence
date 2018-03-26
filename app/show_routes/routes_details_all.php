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
#routesoffshows {
    font-family: \"Trebuchet MS\", Arial, Helvetica, sans-serif;
	font-size: 11px;
    border-collapse: collapse;
    width: 100%;
}

#routesoffshows td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#routesoffshows tr:nth-child(even){background-color: #f2f2f2;}

#routesoffshows tr:hover {background-color: #ddd;}

#routesoffshows th {
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
echo "<script src=\"../js/show_routes_controller.js\"></script>";
echo "<script> getShows(); </script>";

echo "<h1>Details Routes Administration:</h1>";

echo "<p><a href=show_routes_all.php> Back to Routes </a></p><br>";

if (isset($_GET['selectedid']))
{
	$routeid = $_GET['selectedid'];

	$sql = "SELECT ROUTES_DETID, 
					PRESENTATION_DATE, 
					IFNULL(HOLIDAY, '') as HOLIDAY, 
					MILEAGE, 
					IFNULL(BOOK_NOTES,'') as BOOK_NOTES, 
					IFNULL(PROD_NOTES,'') as PROD_NOTES, 
					TEAM_DRIVE_COST 
			FROM routes_det 
			WHERE ROUTESID = $routeid 
			ORDER BY PRESENTATION_DATE DESC";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		echo "<table id=\"routesoffshows\">
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>
		<col width=14.28%>
	    <tr>
		<th>Presentation Date</th>
		<th>Holiday</th>
		<th>Mileage</th>
		<th>Book Notes</th>
		<th>Production Notes</th>
		<th>Team Drive Cost Estimate</th>
		<th>Options</th>
		</tr>";
	    // output data of each row
		$total_records = 0;
	    while($row = $result->fetch_assoc()) {
			$total_records = $total_records + 1;
			echo 
			"<tr>
				<td>". $row["PRESENTATION_DATE"]. "</td>
				<td>". $row["HOLIDAY"]."</td>
				<td>". $row["MILEAGE"]. "</td>
				<td>". $row["BOOK_NOTES"]. "</td>
				<td>". $row["PROD_NOTES"]."</td>
				<td>". $row["TEAM_DRIVE_COST"]."</td>
				<td align=center> 
				<a href=\"javascript:window.open('route_modify_selected.php?selectedid=".$row['ROUTES_DETID']."','Modify Selected','width=480,height=530')\"><img src='../images/modify.png' width=20></a> 
			</td>
			</tr>";
	    }
		echo "</table>";
		echo "<br>";
		echo "Total Records: ".$total_records."<br>";
	} else {
		echo "No details find<br>";
		echo "0 results. Please select another route.";
	}
}
else
{
	echo "No details find<br>";
	echo "0 results. Please select another route.";
}

echo "</body></html>";
$conn->close();
include '../footer.html';
?> 