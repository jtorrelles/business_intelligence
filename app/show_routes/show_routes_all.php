<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
$description = "Accessed ROUTE MANAGEMENT Module";
include '../security_log.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
header('Cache-Control: no cache');
session_cache_limiter("private_no_expire");
echo "
<html>
<head>
<link rel=\"stylesheet\" href=\"../css/jquery.stickytable.min.css\">
<style>
#routesoffshows {
    font-family: \"Trebuchet MS\", Arial, Helvetica, sans-serif;
	font-size: 11px;
    border-collapse: collapse;
    width: 100%;
}

#routesoffshows td, #customers th {
    border: 1px solid #ddd;
    padding: 4px;
}

#routesoffshows tr:nth-child(even){background-color: #f2f2f2;}

#routesoffshows tr:hover {background-color: #ddd;}

#routesoffshows th {
	padding: 8px;
    padding-top: 8px;
    padding-bottom: 8px;
    text-align: left;
    background-color: #000066;
    color: white;
}
#sticky {
	overflow-x: hidden;
}
</style>
</head>
<body>";

echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/jquery.stickytable.min.js\"></script>";
echo "<script src=\"../js/show_routes_controller.js\"></script>";
echo "<script> getShows(); </script>";

echo "<h1>ROUTES MANAGEMENT:</h1>";
$selectedid = '%';
$selectedstate = '0';

echo "<form action=\"show_routes_all.php\" method=\"POST\">";

	echo "<table>";
	echo "<tr><td>Shows:</td>";
	echo "<td><select name=\"show\" class=\"shows\" id=\"showId\">";
	echo "<option value=\"%\">Select Show</option>
		  </select>";
	echo "<input type=\"submit\" name=\"search\" value=\"Find\">";
	echo "</tr>";
	echo "</table>";

echo "</form>";

echo "<p><a href=\"javascript:void(window.open('route_add.php','Add New Rote','width=650,height=450,top=100'))\" hidden>Add a New Route</a>
	<a href=\"javascript:void(window.open('upload_routes.php','Upload  Route','width=650,height=450,top=100'))\">Upload a New Route</a></p>";

if (isset($_POST['show'])){$selectedid = $_POST['show'];}

	$sql = "SELECT ro.ROUTESID as idroute,
				DATE_FORMAT(MIN(rod.presentation_date),'%m/%d/%Y') AS start_date,
				DATE_FORMAT(MAX(rod.presentation_date),'%m/%d/%Y') AS end_date,
				sw.ShowNAME as showname, 
				ro.TRUCKS as numberoftrucks, 
				DATE_FORMAT(ro.DATE_OF_ROUTE,'%m/%d/%Y') as dateroute, 
				ro.WEEKLY_NUT as routenut, 
				ro.XLSX_FILENAME as filename,
				SUM(ro.TRUCKS * rod.MILEAGE) as team_drive_cost 
		FROM routes ro, shows sw, routes_det rod 
		WHERE ro.SHOWID LIKE '$selectedid'
		AND ro.SHOWID = sw.ShowID 
		AND ro.ROUTESID = rod.ROUTESID 
		GROUP BY ro.ROUTESID 
		ORDER BY dateroute DESC";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		echo "<div id=\"sticky\" class=\"sticky-table\">";
		echo "<table id=\"routesoffshows\" class=\"sortable\">
		<col width=20%>
		<col width=20%>
		<col width=20%>
		<col width=20%>
		<col width=20%>
		<thead>
	    <tr class=\"sticky-header\">
		<th>Show Name</th>
		<th>Start Date</th>
		<th>End Date</th>
		<th>File Name of XLSX</th>
		<th style='text-align:center;'>OPTIONS</th>
		</tr>
		</thead>
		<tbody>";
	    // output data of each row
		$total_records = 0;
	    while($row = $result->fetch_assoc()) {

			$total_records = $total_records + 1;
			$id  =  $row['idroute']; 

			echo 
			"<tr>
				<td>". $row["showname"]. "</td>
				<td>". $row["start_date"]."</td>
				<td>". $row["end_date"]. "</td>
				<td>". $row["filename"]. "</td>
				<td align=center> 
				<a href=\"javascript:void(window.open('route_modify_selected.php?selectedid=".$row['idroute']."','Modify Selected','width=480,height=530,top=100'))\"><img src='../images/modify.png' width=20></a> 
				<a href=routes_details_all.php?selectedid=$id><img src='../images/route_details.png' width=20></a>";
				if ($_SESSION['user_profile'] == 'admin') {
					echo "   <a href=\"javascript:void(window.open('route_delete_selected.php?selectedid=".$row['idroute']."','Delete Selected','width=480,height=530,top=100'))\"><img src='../images/delete.png' width=20></a>";
				}
			echo "</td></tr>";
	    }
		echo "</tbody></table></div>";
		//echo "<br>";
		//echo "Total Records: ".$total_records."<br>";
	} else {
	    echo "0 results. Please select another route.";
	}
//else
//{
//	echo "No show selected<br>";
//	echo "0 results. Please select another route.";
//}

echo "</body></html>";
$conn->close();
include '../footer.html';
?> 
