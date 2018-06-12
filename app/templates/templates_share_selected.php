<?php
require '../db/database_conn.php';
include '../session.php';
//include 'access_control.php';
include '../header.html';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<h1 align=center>SHARE YOUR REPORT TEMPLATE</h1>";
if(isset($_GET['selectedid'])){
  $selectedid = $_GET['selectedid'];
  $sql = "SELECT id,name FROM templates WHERE id = '$selectedid'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
		echo "<form action=\"templates_share_selected_results.php\" method=\"POST\">";
		echo "<table align=center width=80%>";
		echo "<tr><td><b>Template ID:</b></td><td><input style=\"width: 100%; background-color: lightgrey;\" readonly type='text' name='id_template' value='".$row['id']."'></td></tr>";	
		echo "<tr><td><b>Template Name:</b></td><td><input style='width: 100%;' type='text' name='name_template' value='".$row['name']." created by ".$_SESSION['login_user']."'</td></tr>";
		echo "
		<tr>
			<td><b>Share with:</b></td>
			<td>
				<select name='user_template' style='width: 100%;'>";
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