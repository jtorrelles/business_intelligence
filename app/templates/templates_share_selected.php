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
#transparent {
	width: 99%;
	border-top: transparent !important;
	border-bottom: transparent !important;
	border-left: transparent !important;
	border-right: transparent !important;
	background: transparent;
	font-family: \"Trebuchet MS\", Arial, Helvetica, sans-serif;
	font-size: 12px;
}
</style>
</head>
<body>";
echo "<h1 align=center>SHARE YOUR REPORT TEMPLATE</h1>";
if(isset($_GET['selectedid'])){
  $selectedid = $_GET['selectedid'];
  $sql = "SELECT id,name FROM templates WHERE id = '$selectedid'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
		echo "<form action=\"templates_share_selected_results.php\" method=\"POST\">";
		echo "<table id='shows' align=center width=80%>
			  <col width=20%>
			  <col width=80%>";
		echo "<tr><th>Template ID:</th><td><input hidden readonly type='text' name='id_template' value='".$row['id']."'>".$row['id']."</td></tr>";	
		echo "<tr><th>Template Name:</th><td><input id='transparent' type='text' name='name_template' value=\"".$row['name']." created by ".$_SESSION['login_user']."\" autofocus></td></tr>";
		echo "
		<tr>
			<th>Share with:</th>
			<td>
				<select name='user_template' id='transparent'>";
					$sql2 = "SELECT username,userfirst_name,userlast_name FROM security WHERE useractive='Y';";
					$result2 = $conn->query($sql2);
					while ($row2 = $result2->fetch_assoc()) {
						echo "<option value='".$row2['username']."'>".$row2['userfirst_name']." ".$row2['userlast_name']."</option>";
					}
		echo "
				</select>
			</td>
		</tr>
		";
		echo "</table>";
		echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"SHARE\"></p>";
		echo "</form>";
  }
}
$conn->close();
include '../footer.html';
?>
