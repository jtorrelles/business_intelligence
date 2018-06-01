<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "
<style>
#log_size {
    font-family: \"Trebuchet MS\", Arial, Helvetica, sans-serif;
	font-size: 12px;
    border-collapse: collapse;
    width: 60%;
}

#log_size td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#log_size tr:nth-child(even){background-color: #f2f2f2;}

#log_size tr:hover {background-color: #ddd;}

#log_size th {
	padding: 8px;
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #000066;
    color: white;
}
</style>
";
$sql = "SELECT TABLE_NAME AS `Table`, 
       ROUND((DATA_LENGTH + INDEX_LENGTH) / 1024 ) AS `Size` 
	   FROM information_schema.TABLES 
	   WHERE TABLE_SCHEMA = \"networksbi\" AND TABLE_NAME = \"security_log\" 
	   ORDER BY (DATA_LENGTH + INDEX_LENGTH) DESC";
$result = $conn->query($sql);
$row = $result->fetch_assoc();   
echo "<h1 align=center style=\"color: red;\">WARNING: YOU ARE ABOUT TO EMPTY THE SECURITY LOG</h1>";
echo "
<p align=center>
	<table id='log_size' align=center width=60%>
		<tr><th>LOG TABLE</th><th>FILE SIZE</th></tr>
		<tr><td align=center>".$row['Table']."</td><td align=center>".$row['Size']." KiB</td></tr>
	</table>
</p>";
echo "
	<form action='truncate_security_log_results.php' method='POST'>
		<p style='text-align: center;'><input type=submit value='EMPTY NOW'></p>
	</form>
";
$conn->close();
include '../footer.html';
?>