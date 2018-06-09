<?php
require '../db/database_conn.php';
include '../session.php';
//include 'access_control.php';
include '../header.html';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<h1 align=center style=\"color: red;\">WARNING: YOU ARE ABOUT TO DELETE THIS TEMPLATE</h1>";
if(isset($_GET['selectedid'])){
  $selectedid = $_GET['selectedid'];
  $sql = "SELECT id,name FROM templates WHERE id = '$selectedid'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
		echo "<form action=\"templates_delete_selected_results.php\" method=\"POST\">";
		echo "<table align=center>";
		echo "<tr><td><b>Template ID:</b></td><td><input style=\"background-color: lightgrey;\" readonly type='text' name='id_template' value='".$row['id']."'></td></tr>";	
		echo "<tr><td><b>Template Name:</b></td><td>".$row['name']."</td></tr>";
		echo "<tr><td colspan=2></td></tr>";
		echo "<tr><td colspan=2 align=center><input type=\"submit\" name=\"modify\" value=\"DELETE\"></td></tr>";
		echo "</table>";
		echo "</form>";
  }
}
$conn->close();
include '../footer.html';
?>