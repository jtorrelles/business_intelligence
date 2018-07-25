<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
$description = "Accessed VENUES MANAGEMENT Module";
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
#sticky {
	overflow-x: hidden;
}
</style>
</head>
<body>";
echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/jquery.stickytable.min.js\"></script>";
echo "<h1>VENUES MANAGEMENT:</h1>";
echo "<p><a href=\"javascript:window.open('venue_add.php','Add New User','width=480,height=530')\">Add New Venue</a> - 
	  <a href=\"javascript:window.open('venue_management.php','Modify Any Venue','width=550,height=650')\">Modify Venue</a>
	  </p>";
$sql = "SELECT venueid,
        venuename,
		venueaddress_1,
		venueaddress_2,
		ci.`name` as venuecity,
		st.`name` as venuestate,
		venuezip,
		ct.sortname as venuecountry, 
		venuephone,
		venuefax,
		venueemail,
		venuenotes,
		venueactive
  	FROM venues ve, cities ci, states st, countries ct 
	WHERE ve.VenueCITYID = ci.id 
	AND ci.state_id = st.id 
	AND st.country_id = ct.id 
	ORDER BY venueactive DESC, venuestate ASC, venuecity ASC, venuename ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<div id=\"sticky\" class=\"sticky-table\">";
	echo "<table id=\"shows\" class='sortable'>
	<col width=15%>
	<col width=10%>
	<col width=10%>
	<col width=4%>
	<col width=4%>
	<col width=4%>
	<col width=4%>
	<col width=7.69%>
	<col width=7.69%>
	<col width=7.69%>
	<col width=10%>
	<col width=4%>
	<col width=5%>
	<thead>
    <tr class=\"sticky-header\">
	<th>Venue Name</th>
	<th>Address</th>
	<th>Address (Opt.)</th>
	<th>City</th>
	<th>State</th>
	<th>ZIP Code</th>
	<th>Country</th>
	<th>Phone</th>
	<th>Fax</th>
	<th>Contact Info</th>
	<th>Notes</th>
	<th>Active?</th>
	<th>Options</th>
	</tr>
	</thead>
	<tbody>";
    while($row = $result->fetch_assoc()) {

        echo 
		"<tr>
		<td>".$row["venuename"]."</td>
		<td>".$row["venueaddress_1"]."</td>
		<td>".$row["venueaddress_2"]."</td>
		<td>".$row["venuecity"]."</td>
		<td>".$row["venuestate"]."</td>
		<td>".$row["venuezip"]."</td>
		<td>".$row["venuecountry"]."</td>
		<td>".$row["venuephone"]."</td>
		<td>".$row["venuefax"]."</td>
		<td>".$row["venueemail"]."</td>
		<td>".$row["venuenotes"]."</td>
		<td>".$row["venueactive"]."</td>
		<td align=center>
		<a href=\"javascript:window.open('venue_modify_selected.php?selectedid=".$row['venueid']."','Modify Selected','width=480,height=530')\"><img src='../images/modify.png' width=20></a>";
	    	if ($_SESSION['user_profile'] == 'admin') {
		echo "<a href=\"javascript:window.open('venue_delete_selected.php?selectedid=".$row['venueid']."','Delete Selected','width=480,height=530')\"><img src='../images/delete.png' width=20></a>";
		}
		echo "</td></tr>";
    }
	echo "</tbody></table></div>";
}
else {
echo "No Venues - Please check your database connection.";
}
echo "</body></html>";
$conn->close();
include '../footer.html';
?> 
