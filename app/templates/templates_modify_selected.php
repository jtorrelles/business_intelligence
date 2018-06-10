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
echo "<h1>Modify An Existing Template:</h1>";
if(isset($_GET['selectedid'])){
  $selectedid = $_GET['selectedid'];
  $sql = "SELECT id,name FROM templates WHERE id = '$selectedid'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
		echo "<form action=\"templates_modify_selected_results.php\" method=\"POST\">";
		echo "<table align=center>";
		echo "<tr><td><b>Template ID:</b></td><td><input style=\"background-color: lightgrey;\" readonly type='text' name='id_template' value='".$row['id']."'></td></tr>";	
		echo "<tr><td><b>Template Name:</b></td><td><input type='text' name='name_template' value='".$row['name']."'</td></tr>";
		echo "</table>";
		echo "<table id=\"shows\">
			  <col width=20%>
			  <col width=80%>
			  <tr>
			  	<th>SELECT</th>
			  	<th>FIELD NAME</th>
			  </tr>";
		$sql2 = "SELECT id, field_name FROM modules_fields";
		$result2 = $conn->query($sql2);
		while($row2 = $result2->fetch_assoc()) {
		$selectedmodulefieldid = $row2['id'];
		$sql3 = "SELECT id,templateid,modulefieldid FROM templates_fields WHERE templateid = '$selectedid' AND modulefieldid = '$selectedmodulefieldid'";
		$result3 = $conn->query($sql3);
		$row3 = $result3->fetch_assoc();
		$selectedmodulefieldid2 = $row3['modulefieldid'];
		if ($selectedmodulefieldid == $selectedmodulefieldid2) {
			echo "<tr>
			<td align=center>
			<input name='".$row2["field_name"]."' value='0' type='hidden'>
			<input type='checkbox' value='".$row2["id"]."' name='".$row2["field_name"]."' checked>
			</td>
			<td align=center>".$row2["field_name"]."</td>
			</tr>";
		} else {		
        echo 
			"<tr>
			<td align=center>
			<input name='".$row2["field_name"]."' value='0' type='hidden'>
			<input type='checkbox' value='".$row2["id"]."' name='".$row2["field_name"]."'>
			</td>
			<td align=center>".$row2["field_name"]."</td>
			</tr>";
		}
		}
		echo "</table>";
		echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"MODIFY\"></p>";
		echo "</form>";
  }
  else {
		echo "ERROR!!!";
}
$conn->close();
include '../footer.html';
?>