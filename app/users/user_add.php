<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<h1 align=center>Add New User</h1>";
echo "
		<form action=\"user_add_results.php\" method=\"POST\">
		<table align=center>
			<tr><td>First Name:</td><td><input type=text name='first_name'></td></tr>
			<tr><td>Last Name:</td><td><input type=text name='last_name'></td></tr>
			<tr><td>Username:</td><td><input type=text name='user_name'></td></tr>
			<tr><td>Password:</td><td><input type=password name='user_password'></td></tr>
			<tr>
			    <td>Choose Profile:</td>
				<td>
				     <select name='user_profile'>
					    <option disabled hidden selected>Select a Profile...</option>
						<option value='admin'>Super Administrator</option>
						<option value='business'>Business Intelligence User</option>
						<option value='report'>Reports User</option>
				     </select>
				</td>
			</tr>
			<tr>
			    <td>Status:</td>
				<td>
				     <select name='user_active'>
					    <option disabled hidden selected>Select a Status...</option>
						<option value='Y'>ENABLED</option>
						<option value='N'>DISABLED</option>
				     </select>
				</td>
			</tr>			
		</table>
		<p align=center><input type=\"submit\" name=\"save\" value=\"Save / Create\"></p>
		</form>
";
$conn->close();
include '../footer.html';
?> 