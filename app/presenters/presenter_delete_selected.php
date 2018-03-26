<?php
require '../db/database_conn.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<h1 align=center style=\"color: red;\">WARNING: YOU ARE ABOUT TO DELETE THIS PRESENTER</h1>";
if(isset($_GET['selectedid'])){
  $selectedid = $_GET['selectedid'];
  	$sql = "SELECT presenterid,
                   presentername,
                   presenteractive,
                   presenteraddress_1,
				   presenteraddress_2,
				   presentercityid,
				   presenterphone,
				   presenterphone_ext,
				   presenterfax,
				   presentercontact_name,
				   presenteremail,
				   presenterpace,
				   presenternotes 
				   FROM presenters WHERE presenterid = $selectedid ";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
	echo "<form action=\"presenter_delete_selected_results.php\" method=\"POST\">";
	echo "<table align=center>";
	echo "<tr><td><b>Presenter ID:</b></td><td><input style=\"background-color: lightgrey;\" readonly type='text' name='id_presenter' value='".$row['presenterid']."'></td></tr>";	
    echo "<tr><td><b>Presenter Name:</b></td><td>".$row['presentername']."</td></tr>";
	echo "<tr><td><b>Address 1:</b></td><td>".$row['presenteraddress_1']."</td></tr>";
	echo "<tr><td><b>Address 2:</b></td><td>".$row['presenteraddress_2']."</td></tr>";
	/*echo "<tr><td><b>Country:</b></td><td>".$row['presentercountry']."</td></tr>";
	echo "<tr><td><b>State:</b></td><td>".$row['presenterstate']."</td></tr>";
	echo "<tr><td><b>City:</b></td><td>".$row['presentercity']."</td></tr>";*/
	echo "<tr><td><b>Phone:</b></td><td>".$row['presenterphone']."</td></tr>";
	echo "<tr><td><b>Ext Phone:</b></td><td>".$row['presenterphone_ext']."</td></tr>";
	echo "<tr><td><b>Fax:</b></td><td>".$row['presenterfax']."</td></tr>";
	echo "<tr><td><b>Contact:</b></td><td>".$row['presentercontact_name']."</td></tr>";
	echo "<tr><td><b>Email:</b></td><td>".$row['presenteremail']."</td></tr>";
	echo "<tr><td><b>Notes:</b></td><td>".$row['presenternotes']."</td></tr>";
	echo "<tr><td><b>Is the Presenter Active?:</b></td><td>".$row['presenteractive']."</td></tr>";
	echo "<tr><td colspan=2></td></tr>";
	echo "<tr><td colspan=2></td></tr>";
	echo "<tr><td colspan=2 align=center><input type=\"submit\" name=\"modify\" value=\"DELETE\"></td></tr>";
	echo "</table>";
	echo "</form>";
} 
}
else {
  echo "failed";
}
$conn->close();
include '../footer.html';
?>