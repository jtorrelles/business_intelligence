<?php
require '../db/database_conn.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<h1>Modify An Existing Presenter:</h1>";
if(isset($_GET['selectedid'])){
  $selectedid = $_GET['selectedid'];

  	$sql = "SELECT presenterid,
                   presentername,
                   presenteraddress_1,
				   presenteraddress_2,
                   presenteractive,
                   co.id as presentercountry,
                   PresenterCITYID as presentercity,
				   st.id as presenterstate,
				   presenterphone,
				   presenterphone_ext,
				   presenterfax,
				   presenteremail,
				   presenterpace,
				   presenternotes, 
				   presentercontact_name, 
				   presenterzip
		  	FROM presenters pr, cities ci, states st, countries co 
			WHERE presenterid = $selectedid 
			AND pr.PresenterCITYID = ci.id 
			AND ci.state_id = st.id 
			AND st.country_id = co.id";

	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
	echo "<form action=\"presenter_modify_results.php\" method=\"POST\">";
	echo "<table>";
	echo "<tr><td><b>Presenter ID:</b></td><td><input style=\"background-color: lightgrey;\" readonly type='text' name='id_presenter' value='".$row['presenterid']."'>This field cannot be modified</td></tr>";	
    echo "<tr><td><b>Presenter Name:</b></td><td><input autofocus='autofocus' type='text' name='name' value='".$row['presentername']."'></td></tr>";
	
	echo "<tr><td><b>Address 1:</b></td><td><input type='text' name='address1' value='".$row['presenteraddress_1']."'></td></tr>";
	echo "<tr><td><b>Address 2:</b></td><td><input type='text' name='address2' value='".$row['presenteraddress_2']."'></td></tr>";
	echo "<tr><td><b>ZIP Code:</b></td><td><input type='text' name='zip' value='".$row['presenterzip']."'></td></tr>";
	echo "<tr><td><b>Phone:</b></td><td><input type='text' name='phone' value='".$row['presenterphone']."'></td></tr>";
	echo "<tr><td><b>Phone Ext:</b></td><td><input type='text' name='extphone' value='".$row['presenterphone_ext']."'></td></tr>";
	echo "<tr><td><b>Fax:</b></td><td><input type='text' name='fax' value='".$row['presenterfax']."'></td></tr>";
	echo "<tr><td><b>Email:</b></td><td><input type='text' name='email' value='".$row['presenteremail']."'></td></tr>";
	echo "<tr><td><b>Contact:</b></td><td><input type='text' name='contact' value='".$row['presentercontact_name']."'></td></tr>";
	echo "<tr><td><b>Pace:</b></td><td><input type='text' name='pace' value='".$row['presenterpace']."'></td></tr>";
	echo "<tr><td><b>Notes:</b></td><td><textarea name='notes' rows=4 cols=40>".$row['presenternotes']."</textarea></td></tr>";

	$active = $row['presenteractive'];
	echo "<tr><td><b>Is the Presenter Active?:</b></td>
	      <td><select name='active_presenter'><br><br>";
			if ($active == 'N') {
				echo "<option value='Y'>YES</option>
			  		<option value='N' selected='selected'>NO</option>";
			}else{
				echo "<option value='Y' selected='selected'>YES</option>
		  			<option value='N'>NO</option>";
			}
	echo "</select></td></tr>";

	echo "</table>";
	echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
	echo "</form>";
} 
}
else {
  echo "failed";
}
$conn->close();
include '../footer.html';
?>
