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
#shows td {
    border: 1px solid #ddd;
    padding: 4px;
}
#shows tr:nth-child(even){background-color: #f2f2f2;}
#shows tr:hover {background-color: #ddd;}
#shows th {
	border: 1px solid #ddd;
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
echo "<h1 align=center style=\"color: red;\">WARNING:<br>YOU ARE ABOUT TO DELETE<br>THIS TEMPLATE</h1>";
if(isset($_GET['selectedid'])){
  $selectedid = $_GET['selectedid'];
  $sql = "SELECT id,name FROM templates WHERE id = '$selectedid'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
		echo "<form action=\"templates_delete_selected_results.php\" method=\"POST\">";
		echo "<table id='shows' align=center>";
		echo "<tr><th>Template ID:</th><td><input hidden style=\"background-color: lightgrey;\" readonly type='text' name='id_template' value='".$row['id']."'>".$row['id']."</td></tr>";	
		echo "<tr><th>Template Name:</th><td>".$row['name']."</td></tr>";
		echo "</table>";
		echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"DELETE\"></p>";
		echo "</form>";
  }
}
$conn->close();
include '../footer.html';
?>