<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
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
echo "<h1>SECURITY LOG</h1>";
echo "<p><a href='security_management.php'>Back to User Management</a></p>";
$sql = "SELECT user, description, date, time FROM security_log ORDER BY date, time DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<table id=\"shows\">
	<col width=25%>
	<col width=25%>
	<col width=25%>
	<col width=25%>
    <tr>
	<th>Username</th>
	<th>Description</th>
	<th>Date</th>
	<th>Time</th>
</tr>";
    while($row = $result->fetch_assoc()) {

        echo 
		"<tr>
		<td>".$row["user"]."</td>
		<td>".$row["description"]."</td>
		<td align=center>".$row["date"]."</td>
		<td align=center>".$row["time"]."</td>
		</tr>";
    }
	echo "</table>";
}
else {
echo "No Users - Please check your database connection.";
}
echo "</body></html>";
$conn->close();
include '../footer.html';
?> 