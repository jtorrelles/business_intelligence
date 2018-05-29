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
echo "<h1>User Administration</h1>";
echo "<p><a href=\"javascript:window.open('user_add.php','Add New User','width=480,height=530')\">Add New User</a> - ";
echo "<a href='security_management_log.php'>View Security Log</a></p>";
$sql = "SELECT userid, userfirst_name, userlast_name, username, userpassword, userprofile FROM security ORDER BY userid ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<table id=\"shows\">
	<col width=16.66%>
	<col width=16.66%>
	<col width=16.66%>
	<col width=16.66%>
	<col width=16.66%>
	<col width=16.66%>
    <tr>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Username</th>
	<th>Password</th>
	<th>Profile</th>
	<th>Options</th>
</tr>";
    while($row = $result->fetch_assoc()) {

        echo 
		"<tr>
		<td>".$row["userfirst_name"]."</td>
		<td>".$row["userlast_name"]."</td>
		<td>".$row["username"]."</td>
		<td>••••••••</td>
		<td>".$row["userprofile"]."</td>
		<td align=center>
		<a href=\"javascript:window.open('user_modify_selected.php?selectedid=".$row['userid']."','Modify Selected','width=480,height=530')\"><img src='../images/modify.png' width=20></a>   
		<a href=\"javascript:window.open('user_delete_selected.php?selectedid=".$row['userid']."','Delete Selected','width=480,height=530')\"><img src='../images/delete.png' width=20></a>
		</td>
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