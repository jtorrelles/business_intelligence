<?php
require '../db/database_conn.php';
include '../session.php';
//include 'access_control.php';
include '../header.html';

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
    padding: 4px;
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
echo "<h1 align=center>ADD A NEW TEMPLATE</h1>";
echo "<p align=center>This template will be available on the Market History Report View after you save it. Scroll all the way down to save.</p>";
$sql = "SELECT id, field_name FROM modules_fields";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<form action='templates_add_results.php' method='POST'>";
	echo "<p align=center><b>Template Name:</b> <input type='text' name='template_name'><br></p>";
	echo "<table id=\"shows\">
	<col width=20%>
	<col width=80%>
    <tr>
		<th>SELECT</th>
		<th>FIELD NAME</th>
	</tr>";
    while($row = $result->fetch_assoc()) {
        echo 
		"<tr>
		<td align=center>
		<input name='".$row["field_name"]."' value='0' type='hidden'>
		<input type='checkbox' value='".$row["id"]."' name='".$row["field_name"]."'>
		</td>
		<td align=center>".$row["field_name"]."</td>
		</tr>";
    }
	echo "</table>";
	echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"Create / Save\"></p>";
	echo "</form>";
}
else {
echo "No fields found. Please contact support now at timp@networkstours.com";
}
echo "</body></html>";

$conn->close();
include '../footer.html';
?>