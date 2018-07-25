<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
$description = "Accessed PRESENTERS MANAGEMENT Module";
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
echo "<h1>PRESENTERS MANAGEMENT:</h1>";
echo "<p><a href=\"javascript:window.open('presenter_add.php','Add New User','width=480,height=530')\">Add New Presenter</a> - 
	  <a href=\"javascript:window.open('presenters_management.php','Modify Any Venue','width=480,height=650')\">Modify Presenter</a>
	  </p>";

$sql = "SELECT presenterid,
        presentername,
		presenterparent_company,
		presenteraddress_1,
		presenteraddress_2,
		ci.`name` as presentercity,
		st.`name` as presenterstate,
		presenterzip,
		ct.sortname as presentercountry,
		presenterphone,
		presenterphone_ext,
		presenterfax,
		presentercontact_name,
		presenteremail,
		presenternotes,
		presenteractive
  	FROM presenters pr, cities ci, states st, countries ct 
	WHERE pr.PresenterCITYID = ci.id 
	AND ci.state_id = st.id 
	AND st.country_id = ct.id 
	ORDER BY presenterid ASC";
	
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<div id=\"sticky\" class=\"sticky-table\">";
	echo "<table id=\"shows\" class='sortable'>
	<col width=6.25%>
	<col width=6.25%>
	<col width=6.25%>
	<col width=6.25%>
	<col width=6.25%>
	<col width=6.25%>
	<col width=6.25%>
	<col width=6.25%>
	<col width=6.25%>
	<col width=6.25%>
	<col width=6.25%>
	<col width=6.25%>
	<col width=6.25%>
	<col width=6.25%>
	<col width=6.25%>
	<col width=6.25%>
	<thead>
    <tr class=\"sticky-header\">
	<th>Presenter Name</th>
	<th>Parent Company</th>
	<th>Address</th>
	<th>Address (Opt.)</th>
	<th>City</th>
	<th>State</th>
	<th>ZIP Code</th>
	<th>Country</th>
	<th>Phone</th>
	<th>(EXT.)
	<th>Fax</th>
	<th>Contact</th>
	<th>Email</th>
	<th>Notes</th>
	<th>Active?</th>
	<th>Options</th>
	</tr>
	</thead>
	<tbody>";
    while($row = $result->fetch_assoc()) {

        echo 
		"<tr>
		<td>".$row["presentername"]."</td>
		<td>".$row["presenterparent_company"]."</td>
		<td>".$row["presenteraddress_1"]."</td>
		<td>".$row["presenteraddress_2"]."</td>
		<td>".$row["presentercity"]."</td>
		<td>".$row["presenterstate"]."</td>
		<td>".$row["presenterzip"]."</td>
		<td>".$row["presentercountry"]."</td>
		<td>".$row["presenterphone"]."</td>
		<td>".$row["presenterphone_ext"]."</td>
		<td>".$row["presenterfax"]."</td>
		<td>".$row["presentercontact_name"]."</td>
		<td>".$row["presenteremail"]."</td>		
		<td>".$row["presenternotes"]."</td>
		<td>".$row["presenteractive"]."</td>
		<td align=center>
		<a href=\"javascript:window.open('presenter_modify_selected.php?selectedid=".$row['presenterid']."','Modify Selected','width=480,height=530')\"><img src='../images/modify.png' width=20></a>";
	    	if ($_SESSION['user_profile'] == 'admin') {
		echo "<a href=\"javascript:window.open('presenter_delete_selected.php?selectedid=".$row['presenterid']."','Delete Selected','width=480,height=530')\" hidden ><img src='../images/delete.png' width=20></a>";
		}	
		echo "</td></tr>";
    }
	echo "</tbody></table></div>";
}
else {
echo "No Presenters - Please check your database connection.";
}
echo "</body></html>";
$conn->close();
include '../footer.html';
?> 
