<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
$description = "Accessed Route Details for Show ID: ".$_GET['selectedid'];
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
#routesoffshows {
    font-family: \"Trebuchet MS\", Arial, Helvetica, sans-serif;
	font-size: 11px;
    border-collapse: collapse;
}

#routesoffshows td {
    border: 1px solid #ddd;
    padding: 8px;
	white-space: nowrap;
}

#routesoffshows tr:nth-child(even){background-color: #f2f2f2;}

#routesoffshows tr:hover {background-color: #ddd;}

#routesoffshows th {
	padding: 8px;
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #000066;
    color: white;
	white-space: nowrap;
}
</style>
</head>
<body>";

echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/show_routes_controller.js\"></script>";
echo "<script src=\"../js/jquery.stickytable.min.js\"></script>";
echo "<script> getShows(); </script>";

echo "<h1>ROUTE DETAIL MANAGEMENT:</h1>";

echo "<p><a href=show_routes_all.php>Back to Route Management</a> - 
	<a href=\"javascript:void(window.open('upload_routes_update.php?selectedid=".$_GET['selectedid']."','Upload  Route','width=650,height=500,top=100'))\">Update Route With Spreadsheet</a></p><br>";

if (isset($_GET['selectedid']))
{
	$routeid = $_GET['selectedid'];

	$sql = "SELECT det.ROUTES_DETID, 
					det.ROUTESID, 
					DATE_FORMAT(det.PRESENTATION_DATE,'%m/%d/%Y') as PRESENTATION_DATE, 
					IFNULL(det.HOLIDAY, '') as HOLIDAY, 
					(SELECT IFNULL(ci.NAME, '') 
					 FROM cities ci 
					 WHERE det.CITYID = ci.ID) as CITY,
					(SELECT IFNULL(sta.NAME, '') 
					 FROM cities ci, states sta 
					 WHERE det.CITYID = ci.ID
					 AND ci.STATE_ID = sta.ID) as STATE,
					IFNULL(det.REPEAT, '') as REPEAT1,
					IFNULL(det.MILEAGE, 0) as MILEAGE, 
					IFNULL(det.BOOK_NOTES, '') as BOOK_NOTES, 	
					IFNULL(det.PROD_NOTES, '') as PROD_NOTES,
					IFNULL(ro.TRUCKS * det.MILEAGE, 0) as TEAM_DRIVE,
					IFNULL(det.TIME_ZONE, '') as TIME_ZONE,
					IFNULL(det.SHOW_TIMES, '') as SHOW_TIMES,			
					IFNULL(det.PERF, 0) as PERF,
					(SELECT IFNULL(ve.VENUENAME, '') 
					 FROM venues ve 
					 WHERE det.VENUEID = ve.VENUEID) as VENUE,
					(SELECT IFNULL(pre.PRESENTERNAME, '') 
					 FROM presenters pre
					 WHERE det.PRESENTERID = pre.PRESENTERID) as PRESENTER,
					IFNULL(det.CAPACITY, 0) as CAPACITY,
					IFNULL(det.FIXED_GNTEE, 0) as FIXED_GNTEE,
					IFNULL(det.ROYALTY, 0) as ROYALTY,
					IFNULL(det.BACKEND, 0) as BACKEND,
					IFNULL(det.BREAKEVEN, 0) as BREAKEVEN,
					IFNULL(det.DEAL_NOTES, '') as DEAL_NOTES,
					IFNULL(det.EST_ROYALTY, 0) as EST_ROYALTY,  
					IFNULL(det.ON_SUB, '') as ON_SUB,
					IFNULL(det.DATE_CONF, '') as DATE_CONF,
					IFNULL(det.OFFER, '') as OFFER,
					IFNULL(det.PRICE_SCALES, '') as PRICE_SCALES,
					IFNULL(det.EXPENSES, '') as EXPENSES,
					IFNULL(det.DEAL_MEMO, '') as DEAL_MEMO,
					IFNULL(det.CONTRACT, '') as CONTRACT,
					det.IND as IND,
					sh.SHOWNAME as SHOWNAME
			FROM routes_det det, routes ro, shows sh
			WHERE det.ROUTESID = $routeid 
			AND det.ROUTESID = ro.ROUTESID 
			AND ro.SHOWID = sh.SHOWID
			ORDER BY det.PRESENTATION_DATE ASC";

	$result = $conn->query($sql);
	$result2 = $conn->query($sql);
	if ($result2->num_rows > 0) {
		while($row = $result2->fetch_assoc()) {
			$showname = $row["SHOWNAME"];
		}	
		echo "<h1>Show Title: ".$showname."</h1>";
		echo "<div class=\"sticky-table sticky-ltr-cells\">";
		echo "<table id=\"routesoffshows\">
		<thead>
	    <tr class=\"sticky-header\">
		<th>Presentation Date</th>
		<th>Holiday</th>
		<th>City</th>
		<th>State</th>		
		<th>Repeat</th>
		<th>Mileage</th>
		<th>Booking Notes</th>
		<th>Production Notes</th>
		<th>Team Drive Cost Estimate</th>
		<th>Time Zone</th>
		<th>Show Times</th>
		<th>Number Of Performances</th>
		<th>Venue</th>
		<th>Presenter</th>
		<th>Capacity</th>
		<th>Fixed Guarantee</th>
		<th>Royalty</th>
		<th>Backend</th>
		<th>Breakeven</th>
		<th>Deal Notes</th>
		<th>Estimated Royalty</th>
		<th>On Sub</th>
		<th>Date Conf</th>
		<th>Offer</th>
		<th>Price Scales</th>
		<th>Expenses</th>
		<th>Deal Memo</th>
		<th>Contract</th>
		<th>Options</th>
		</tr>
		</thead>
		<tbody>";
		$total_records = 0;
	    while($row = $result->fetch_assoc()) {
			$total_records = $total_records + 1;
			echo 
			"<tr>
				<td>". $row["PRESENTATION_DATE"]. "</td>";
			if($row["HOLIDAY"] == 1){
				echo 
				"<td><input type='checkbox' class=\"pres_date\" name='pres_date' checked disabled></td>";
			}else{
				echo 
				"<td><input type='checkbox' class=\"pres_date\" name='pres_date' disabled></td>";
			}
			echo
				"<td>". $row["CITY"]. "</td>
				<td>". $row["STATE"]. "</td>";
			if($row["REPEAT1"] == 1){
				echo 
				"<td><input type='checkbox' class=\"repeat\" name='repeat' checked disabled></td>";
			}else{
				echo 
				"<td><input type='checkbox' class=\"repeat\" name='repeat' disabled></td>";
			}	
			echo "<td>". $row["MILEAGE"]. "</td>";
			echo "<td>". $row["BOOK_NOTES"]. "</td>";
			echo "<td>". $row["PROD_NOTES"]. "</td>";
			echo "<td>". $row["TEAM_DRIVE"]. "</td>";
			echo "<td>". $row["TIME_ZONE"]. "</td>";
			echo "<td>". $row["SHOW_TIMES"]. "</td>";
			echo "<td>". $row["PERF"]. "</td>";
			echo "<td>". $row["VENUE"]. "</td>";
			echo "<td>". $row["PRESENTER"]. "</td>";
			echo "<td>". $row["CAPACITY"]. "</td>";
			echo "<td>$ ".number_format($row["FIXED_GNTEE"],2)."</td>";
			echo "<td>". $row["ROYALTY"]. "</td>";
			echo "<td>". $row["BACKEND"]. "</td>";
			echo "<td>". $row["BREAKEVEN"]. "</td>";
			echo "<td>". $row["DEAL_NOTES"]. "</td>";
			echo "<td>$ ".number_format($row["EST_ROYALTY"],2)."</td>";
			if($row["ON_SUB"] == 1){
				echo 
				"<td bgcolor=green><input type='checkbox' class=\"on_sub\" name='on_sub' checked disabled></td>";
			}else{
				echo 
				"<td bgcolor=red><input type='checkbox' class=\"on_sub\" name='on_sub' disabled></td>";
			}	
			if($row["DATE_CONF"] == 1){
				echo 
				"<td bgcolor=green><input type='checkbox' class=\"date_donf\" name='date_donf' checked disabled></td>";
			}else{
				echo 
				"<td bgcolor=red><input type='checkbox' class=\"date_donf\" name='date_donf' disabled></td>";
			}	
			if($row["OFFER"] == 1){
				echo 
				"<td bgcolor=green><input type='checkbox' class=\"offer\" name='offer' checked disabled></td>";
			}else{
				echo 
				"<td bgcolor=red><input type='checkbox' class=\"offer\" name='offer' disabled></td>";
			}
			if($row["PRICE_SCALES"] == 1){
				echo 
				"<td bgcolor=green><input type='checkbox' class=\"price_scales\" name='price_scales' checked disabled></td>";
			}else{
				echo 
				"<td bgcolor=red><input type='checkbox' class=\"price_scales\" name='price_scales' disabled></td>";
			}
			if($row["EXPENSES"] == 1){
				echo 
				"<td bgcolor=green><input type='checkbox' class=\"expenses\" name='expenses' checked disabled></td>";
			}else{
				echo 
				"<td bgcolor=red><input type='checkbox' class=\"expenses\" name='expenses' disabled></td>";
			}
			if($row["DEAL_MEMO"] == 1){
				echo 
				"<td bgcolor=green><input type='checkbox' class=\"deal_memo\" name='deal_memo' checked disabled></td>";
			}else{
				echo 
				"<td bgcolor=red><input type='checkbox' class=\"deal_memo\" name='deal_memo' disabled></td>";
			}
			if($row["CONTRACT"] == 1){
				echo 
				"<td bgcolor=green><input type='checkbox' class=\"contract\" name='contract' checked disabled></td>";
			}else{
				echo 
				"<td bgcolor=red><input type='checkbox' class=\"contract\" name='contract' disabled></td>";
			}
			echo
				"<td align=center> 
				<a href=\"javascript:void(window.open('route_detail_modify_selected.php?selectedid=".$row['ROUTES_DETID']."','Modify Selected','width=480,height=530,top=100'))\"><img src='../images/modify.png' width=20></a>";
			if($row["IND"] == 1){
				echo
				"<a href=\"javascript:void(window.open('market_analysis_modify_selected.php?selectedid=".$row['ROUTES_DETID']."','Modify Selected','width=480,height=530,top=100'))\"><img src='../images/analysis.png' width=20></a>";
			}else{
				echo
				"<a href=\"javascript:void(window.open('market_analysis_add_selected.php?selectedid=".$row['ROUTES_DETID']."','Modify Selected','width=480,height=530,top=100'))\"><img src='../images/analysis.png' width=20></a>";
			}
			echo
				"<a href=\"javascript:void(window.open('route_detail_change_data.php?routedetid=".$row['ROUTES_DETID']."&routeid=".$row['ROUTESID']."','Change Data','width=480,height=530,top=100'))\"><img src='../images/change_data.png' width=20></a></td></tr>";			
	    }
		echo "</tbody></table></div>";
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
