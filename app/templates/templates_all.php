<?php
require '../db/database_conn.php';
include '../session.php';
//include 'access_control.php';
include '../header.html';
$description = "Accessed CUSTOM REPORTS MANAGEMENT Module";
include '../security_log.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$current_user = $_SESSION['login_user'];

echo "
<html>
<head>
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
echo "<h1>CUSTOM REPORTS MANAGEMENT:</h1>";
echo "<p>This module will help you customize the Market History Report with templates. These templates will be available to select on the Market History Report View.</p>";
echo "<p>
	  <a href=\"javascript:window.open('templates_add.php','Add Show','width=480,height=650')\">Add New Template</a></p>";
$sql = "SELECT id, name, user FROM templates WHERE user = '$current_user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo "<table id=\"shows\">
	<col width=60%>
	<col width=30%>
	<col width=10%>
    <tr>
		<th>REPORT NAME</th>
		<th>ASSIGNED TO</th>
		<th>OPTIONS</th>
	</tr>";
	
    while($row = $result->fetch_assoc()) {
        echo 
		"<tr>
		<td>". $row["name"]. "</td>
		<td align=center>". $row["user"]. "</td>
		<td align=center>
		<a href=\"javascript:window.open('templates_modify_selected.php?selectedid=".$row['id']."','Modify Selected','width=480,height=650')\"><img src='../images/modify.png' width=20></a> 
		<a href=\"javascript:window.open('templates_share_selected.php?selectedid=".$row['id']."','Share Selected','width=480,height=650')\"><img src='../images/share.png' width=20></a> 
		<a href=\"javascript:window.open('templates_delete_selected.php?selectedid=".$row['id']."','Delete Selected','width=480,height=650')\"><img src='../images/delete.png' width=20></a></td>
		</tr>";
    }
	echo "</table>";
}
else {
echo "No custom reports found for this user.";
}
echo "</body></html>";

$conn->close();
include '../footer.html';
?>