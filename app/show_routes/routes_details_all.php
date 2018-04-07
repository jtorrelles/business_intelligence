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

echo "<p><a href=show_routes_all.php> Back to Routes Administration</a></p><br>";

if (isset($_GET['selectedid']))
{
	$routeid = $_GET['selectedid'];

	$sql = "SELECT det.ROUTES_DETID, 
					det.PRESENTATION_DATE, 
					IFNULL(det.HOLIDAY, '') as HOLIDAY, 
					(SELECT IFNULL(ci.NAME, '') 
					 FROM cities ci 
					 WHERE det.CITYID = ci.ID) as CITY,
					(SELECT IFNULL(sta.NAME, '') 
					 FROM cities ci, states sta 
					 WHERE det.CITYID = ci.ID
					 AND ci.STATE_ID = sta.ID) as STATE,
					IFNULL(det.REPEAT, '') as REPEAT1,
					IFNULL(det.PERF, 0) as PERF,
					IFNULL(det.ON_SUB, '') as ON_SUB,
					IFNULL(det.DATE_CONF, '') as DATE_CONF,
					IFNULL(det.OFFER, '') as OFFER,
					IFNULL(det.PRICE_SCALES, '') as PRICE_SCALES,
					IFNULL(det.EXPENSES, '') as EXPENSES,
					IFNULL(det.DEAL_MEMO, '') as DEAL_MEMO,
					IFNULL(det.CONTRACT, '') as CONTRACT
			FROM routes_det det, routes ro
			WHERE det.ROUTESID = $routeid 
			AND det.ROUTESID = ro.ROUTESID 
			ORDER BY det.PRESENTATION_DATE ASC";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		echo "<table id=\"routesoffshows\">
		<col width=11.50%>
		<col width=6.00%>
		<col width=11.50%>
		<col width=11.50%>
		<col width=6.00%>
		<col width=11.50%>
		<col width=6.00%>
		<col width=6.00%>
		<col width=6.00%>
		<col width=6.00%>
		<col width=6.00%>
		<col width=6.00%>
		<col width=6.00%>
	    <tr>
		<th>Presentation Date</th>
		<th>Holiday</th>
		<th>City</th>
		<th>State</th>
		<th>Repeat</th>
		<th>Number Of Performances</th>
		<th>On Sub</th>
		<th>Date Conf</th>
		<th>Offer</th>
		<th>Price Scales</th>
		<th>Expenses</th>
		<th>Deal Memo</th>
		<th>Contract</th>
		<th>Options</th>
		</tr>";
	    // output data of each row
		$total_records = 0;
	    while($row = $result->fetch_assoc()) {
			$total_records = $total_records + 1;
			echo 
			"<tr>
				<td>". $row["PRESENTATION_DATE"]. "</td>";
			if($row["HOLIDAY"] == 1){
				echo 
				"<td><input type='checkbox' class=\"repeat\" name='repeat' checked disabled></td>";
			}else{
				echo 
				"<td><input type='checkbox' class=\"repeat\" name='repeat' disabled></td>";
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
			echo
				"<td>". $row["PERF"]. "</td>";
			if($row["ON_SUB"] == 1){
				echo 
				"<td><input type='checkbox' class=\"on_sub\" name='on_sub' checked disabled></td>";
			}else{
				echo 
				"<td><input type='checkbox' class=\"repeat\" name='repeat' disabled></td>";
			}	
			if($row["DATE_CONF"] == 1){
				echo 
				"<td><input type='checkbox' class=\"repeat\" name='repeat' checked disabled></td>";
			}else{
				echo 
				"<td><input type='checkbox' class=\"repeat\" name='repeat' disabled></td>";
			}	
			if($row["OFFER"] == 1){
				echo 
				"<td><input type='checkbox' class=\"repeat\" name='repeat' checked disabled></td>";
			}else{
				echo 
				"<td><input type='checkbox' class=\"repeat\" name='repeat' disabled></td>";
			}
			if($row["PRICE_SCALES"] == 1){
				echo 
				"<td><input type='checkbox' class=\"repeat\" name='repeat' checked disabled></td>";
			}else{
				echo 
				"<td><input type='checkbox' class=\"repeat\" name='repeat' disabled></td>";
			}
			if($row["EXPENSES"] == 1){
				echo 
				"<td><input type='checkbox' class=\"repeat\" name='repeat' checked disabled></td>";
			}else{
				echo 
				"<td><input type='checkbox' class=\"repeat\" name='repeat' disabled></td>";
			}
			if($row["DEAL_MEMO"] == 1){
				echo 
				"<td><input type='checkbox' class=\"repeat\" name='repeat' checked disabled></td>";
			}else{
				echo 
				"<td><input type='checkbox' class=\"repeat\" name='repeat' disabled></td>";
			}
			if($row["CONTRACT"] == 1){
				echo 
				"<td><input type='checkbox' class=\"repeat\" name='repeat' checked disabled></td>";
			}else{
				echo 
				"<td><input type='checkbox' class=\"repeat\" name='repeat' disabled></td>";
			}
			echo
				"<td align=center> 
				<a href=\"javascript:window.open('route_detail_modify_selected.php?selectedid=".$row['ROUTES_DETID']."','Modify Selected','width=480,height=530')\"><img src='../images/modify.png' width=20></a> 
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