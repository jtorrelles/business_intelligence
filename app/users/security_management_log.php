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
echo "<p><a href='security_management.php'>Back to User Management</a> - ";
echo "<a href=\"javascript:window.open('truncate_security_log.php','Add New User','width=480,height=530')\">Empty Security Log</a></p>";

$sql = "SELECT username, userfirst_name, userlast_name FROM security";
$result = $conn->query($sql);
$sql2 = "SELECT MIN(date) as init, MAX(date) as end FROM security_log";
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();

$selecteduser = '%';
$selectedinit = $row2['init'];
$selectedend = $row2['end'];

echo "
<form action=\"security_management_log.php\" method=\"POST\">
<p>
<table>
	<tr>
		<td>Select User:</td>
		<td><select name='username'>
				<option value='%' selected>-- SELECT --</option>";
				while($row = $result->fetch_assoc()) {
					echo "<option value='".$row['username']."'>".$row['userfirst_name']." ".$row['userlast_name']."</option>";
				}	
				echo "
			</select>
		</td>
		<td>Init Date <font color=red><b>*</b></font>:</td>
		<td><input name='initdate' type=date value=\"".$row2['init']."\" min=\"".$row2['init']."\" max=\"".$row2['end']."\"></td>
		<td>End Date <font color=red><b>*</b></font>:</td>
		<td><input name='enddate' type=date value=\"".$row2['end']."\" min=\"".$row2['init']."\" max=\"".$row2['end']."\"></td>	
		<td><input type=submit value='FIND'></td>
	</tr>	
</table>
</p>
</form>
";

if (isset($_POST['username']))
{
	$selecteduser = $_POST['username'];
}
else
{
	$selectedid = '%';
}

if (isset($_POST['initdate']))
{
	$selectedinit = $_POST['initdate'];
}
else
{
	$selectedinit = $row2['init'];
}

if (isset($_POST['enddate']))
{
	$selectedend = $_POST['enddate'];
}
else
{
	$selectedend = $row2['end'];
}

$sql = "SELECT user, description, date, time FROM security_log WHERE user like '$selecteduser' AND date >= '$selectedinit' AND date <= '$selectedend' ORDER BY date DESC, time DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<table id=\"shows\" class='sortable'>
	<col width=10%>
	<col width=70%>
	<col width=10%>
	<col width=10%>
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
echo "No entries found using these filters. Please verify the dates and the user you are trying to review.";
}
echo "</body></html>";
$conn->close();
include '../footer.html';
?> 