<?php
require 'config/database_conn.php';
include 'header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<h1 align=center>Modify An Existing User:</h1>";
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
	echo "<form action=\"user_modify_selected_results.php\" method=\"POST\">";
	echo "<table align=center>";
	echo "<tr><td><b>User ID:</b></td><td><input style=\"background-color: lightgrey;\" readonly type='text' name='user_id' value='".$row['userid']."'></td></tr>";	
    echo "<tr><td>First Name:</td><td><input type=text name='first_name' value='".$row['userfirst_name']."'></td></tr>";
	echo "<tr><td>Last Name:</td><td><input type=text name='last_name' value='".$row['userlast_name']."'></td></tr>";
	echo "<tr><td>Username:</td><td><input type=text name='user_name' value='".$row['username']."'></td></tr>";
	echo "<tr><td>Password:</td><td><input type=password name='user_password' value='".$row['userpassword']."'></td></tr>";
	echo "<tr>
			    <td>Choose Profile:</td>
				<td>
				     <select name='user_profile'>
					    <option hidden selected value='".$row['userprofile']."'>".$row['userprofile']."</option>
						<option value='admin'>Super Administrator</option>
						<option value='business'>Business Intelligence User</option>
						<option value='report'>Reports User</option>
				     </select>
				</td>
		 </tr>";
	echo "</table>";
	echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
	echo "</form>";
} 
}
else {
  echo "failed";
}
$conn->close();
include 'footer.html';
?>
