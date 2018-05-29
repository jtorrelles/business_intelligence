<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<h1 align=center style=\"color: red;\">WARNING: YOU ARE ABOUT TO DELETE THIS USER</h1>";
if(isset($_GET['selectedid'])){
  $selectedid = $_GET['selectedid'];
  	$sql = "SELECT userid,
				   username,
				   userpassword,
				   userfirst_name,
				   userlast_name,
				   userprofile
				   FROM security WHERE userid = $selectedid";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
	echo "<form action=\"user_delete_selected_results.php\" method=\"POST\">";
	echo "<table align=center>";
	echo "<tr><td><b>User ID:</b></td><td><input style=\"background-color: lightgrey;\" readonly type='text' name='user_id' value='".$row['userid']."'></td></tr>";	
    echo "<tr><td><b>First Name:</b></td><td>".$row['userfirst_name']."</td></tr>";
	echo "<tr><td><b>Last Name:</b></td><td>".$row['userlast_name']."</td></tr>";
	echo "<tr><td><b>Username:</b></td><td>".$row['username']."</td></tr>";
	echo "<tr><td><b>Password:</b></td><td>••••••••</td></tr>";
	echo "<tr><td><b>Profile:</b></td><td>".$row['userprofile']."</td></tr>";
	echo "</table>";
	echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"DELETE\"></p>";
	echo "</form>";
} 
}
else {
  echo "failed";
}
$conn->close();
include '../footer.html';
?>