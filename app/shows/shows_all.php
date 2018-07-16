<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
$description = "Accessed SHOWS MANAGEMENT Module";
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
#shows {
    font-family: \"Trebuchet MS\", Arial, Helvetica, sans-serif;
	font-size: 11px;
    border-collapse: collapse;
    width: 100%;
}

#shows td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#shows tr:nth-child(even){background-color: #f2f2f2;}

#shows tr:hover {background-color: #ddd;}

#shows th {
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
echo "<h1>SHOWS MANAGEMENT:</h1>";
echo "<p>
	  <a href=\"javascript:window.open('shows_add.php','Add Show','width=480,height=650')\">Add New Show</a>
	   - 
	  <a href=\"javascript:window.open('shows_management.php','Modify Any Show','width=480,height=650')\">Modify Shows</a>
	  </p>";
$sql = "SELECT
		showid,
		showname,
		showactive,
		categoryid_1,
		categoryid_2,
		categoryid_3,
		categoryid_4,
		categoryid_5,
		categoryid_6,
		categoryid_7,
		showage,
		showweekly_nut,
		shownumber_of_cast,
		shownumber_of_musicians,
		shownumber_of_stagehands,
		shownumber_of_trucks,
		shownotes
		FROM shows ORDER BY showname ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<div class=\"sticky-table\">";
	echo "<table id=\"shows\" class=\"sortable\">
	<col width=10%>
	<col width=5%>
	<col width=5%>
	<col width=5%>
	<col width=5%>
	<col width=5%>
	<col width=5%>
	<col width=5%>
	<col width=5%>
	<col width=5%>
	<col width=5%>
	<col width=5%>
	<col width=5%>
	<col width=5%>
	<col width=5%>
	<col width=5%>
	<col width=5%>
	<thead>
    <tr class=\"sticky-header\">
	<th>Show Name</th>
	<th>Active?</th>
	<th>Category 1</th>
	<th>Category 2</th>
	<th>Category 3</th>
	<th>Category 4</th>
	<th>Category 5</th>
	<th>Category 6</th>
	<th>Category 7</th>
	<th>Show Age</th>
	<th>Weekly Nut</th>
	<th># of Cast</th>
	<th># of Musicians</th>
	<th># of Stagehands</th>
	<th># of Trucks</th>
	<th>Notes</th>
	<th>Options</th>
	</tr>
	</thead>
	<tbody>";
    while($row = $result->fetch_assoc()) {

    	$cat1 = $row['categoryid_1'];
		$cat1_sql = "SELECT categoryname FROM category WHERE categoryid = $cat1";
		$cat1_sql_result = $conn->query($cat1_sql);
		$row1 = $cat1_sql_result->fetch_assoc();
		
		$cat2 = $row['categoryid_2'];
		$cat2_sql = "SELECT categoryname FROM category WHERE categoryid = $cat2";
		$cat2_sql_result = $conn->query($cat2_sql);
		$row2 = $cat2_sql_result->fetch_assoc();	

		$cat3 = $row['categoryid_3'];
		$cat3_sql = "SELECT categoryname FROM category WHERE categoryid = $cat3";
		$cat3_sql_result = $conn->query($cat3_sql);
		$row3 = $cat3_sql_result->fetch_assoc();	

		$cat4 = $row['categoryid_4'];
		$cat4_sql = "SELECT categoryname FROM category WHERE categoryid = $cat4";
		$cat4_sql_result = $conn->query($cat4_sql);
		$row4 = $cat4_sql_result->fetch_assoc();		
		
		$cat5 = $row['categoryid_5'];
		$cat5_sql = "SELECT categoryname FROM category WHERE categoryid = $cat5";
		$cat5_sql_result = $conn->query($cat5_sql);
		$row5 = $cat5_sql_result->fetch_assoc();	

		$cat6 = $row['categoryid_6'];
		$cat6_sql = "SELECT categoryname FROM category WHERE categoryid = $cat6";
		$cat6_sql_result = $conn->query($cat6_sql);
		$row6 = $cat6_sql_result->fetch_assoc();	

		$cat7 = $row['categoryid_7'];
		$cat7_sql = "SELECT categoryname FROM category WHERE categoryid = $cat7";
		$cat7_sql_result = $conn->query($cat7_sql);
		$row7 = $cat7_sql_result->fetch_assoc();	
		
        echo 
		"<tr>
		<td>". $row["showname"]. "</td>
		<td align=center>". $row["showactive"]. "</td>
		<td align=center>". $row1["categoryname"]. "</td>
		<td align=center>". $row2["categoryname"]. "</td>
		<td align=center>". $row3["categoryname"]. "</td>
		<td align=center>". $row4["categoryname"]. "</td>
		<td align=center>". $row5["categoryname"]. "</td>
		<td align=center>". $row6["categoryname"]. "</td>
		<td align=center>". $row7["categoryname"]. "</td>
		<td align=center>". $row["showage"]. "</td>
		<td align=center>$ ".number_format($row["showweekly_nut"],2)."</td>
		<td align=center>".$row["shownumber_of_cast"]."</td>
		<td align=center>".$row["shownumber_of_musicians"]."</td>
		<td align=center>".$row["shownumber_of_stagehands"]."</td>
		<td align=center>".$row["shownumber_of_trucks"]."</td>
		<td align=center>".$row["shownotes"]."</td>
		<td align=center>
		<a href=\"javascript:window.open('shows_modify_selected.php?selectedid=".$row['showid']."','Modify Selected','width=480,height=650')\"><img src='../images/modify.png' width=20></a>";   
		if ($_SESSION['user_profile'] == 'admin') {
		echo "<a href=\"javascript:window.open('shows_delete_selected.php?selectedid=".$row['showid']."','Delete Selected','width=480,height=650')\"><img src='../images/delete.png' width=20></a>";
		}
		echo "</td></tr>";
    }
	echo "</tbody></table></div>";
}
else {
echo "No shows";
}
echo "</body></html>";
$conn->close();
include '../footer.html';
?> 
