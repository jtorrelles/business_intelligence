<?php
require '../db/database_conn.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<h1 align=center style=\"color: red;\">WARNING: YOU ARE ABOUT TO DELETE THIS SHOW</h1>";
if(isset($_GET['selectedid'])){
  $selectedid = $_GET['selectedid'];
  	$sql = "SELECT showid,
                   showname,
                   showactive,
                   categoryid_1,
				   categoryid_2,
				   categoryid_3,
				   categoryid_4,
				   categoryid_5,
				   categoryid_6,
				   categoryid_7,
				   showage,
				   showweekly_nut,
				   shownumber_of_trucks
				   FROM shows WHERE showid = $selectedid ";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
	echo "<form action=\"shows_delete_selected_results.php\" method=\"POST\">";
	echo "<table align=center>";
	echo "<tr><td><b>Show ID:</b></td><td><input style=\"background-color: lightgrey;\" readonly type='text' name='id_show' value='".$row['showid']."'></td></tr>";	
    echo "<tr><td><b>Show Name:</b></td><td>".$row['showname']."</td></tr>";
    echo "<tr><td><b>Is the Show Active?:</b></td><td>".$row['showactive']."</td></tr>";

	$cat1 = $row['categoryid_1'];
	$category1_select = "SELECT categoryid, categoryname FROM category WHERE categoryid = $cat1";
	$category1_result = $conn->query($category1_select);
	$row1 = $category1_result->fetch_assoc();
	echo "<tr><td><b>Category 1:</b></td><td>".$row1['categoryname']."</td></tr>";

	$cat2 = $row['categoryid_2'];
	$category2_select = "SELECT categoryid, categoryname FROM category WHERE categoryid = $cat2";
	$category2_result = $conn->query($category2_select);
	$row2 = $category2_result->fetch_assoc();
	echo "<tr><td><b>Category 2:</b></td><td>".$row2['categoryname']."</td></tr>";

	$cat3 = $row['categoryid_3'];
	$category3_select = "SELECT categoryid, categoryname FROM category WHERE categoryid = $cat3";
	$category3_result = $conn->query($category3_select);
	$row3 = $category3_result->fetch_assoc();
	echo "<tr><td><b>Category 3:</b></td><td>".$row3['categoryname']."</td></tr>";	
	
	$cat4 = $row['categoryid_4'];
	$category4_select = "SELECT categoryid, categoryname FROM category WHERE categoryid = $cat4";
	$category4_result = $conn->query($category4_select);
	$row4 = $category4_result->fetch_assoc();
	echo "<tr><td><b>Category 4:</b></td><td>".$row4['categoryname']."</td></tr>";
	
	$cat5 = $row['categoryid_5'];
	$category5_select = "SELECT categoryid, categoryname FROM category WHERE categoryid = $cat5";
	$category5_result = $conn->query($category5_select);
	$row5 = $category5_result->fetch_assoc();
	echo "<tr><td><b>Category 5:</b></td><td>".$row5['categoryname']."</td></tr>";
	
	$cat6 = $row['categoryid_6'];
	$category6_select = "SELECT categoryid, categoryname FROM category WHERE categoryid = $cat6";
	$category6_result = $conn->query($category6_select);
	$row6 = $category6_result->fetch_assoc();
	echo "<tr><td><b>Category 6:</b></td><td>".$row6['categoryname']."</td></tr>";	
	
	$cat7 = $row['categoryid_7'];
	$category7_select = "SELECT categoryid, categoryname FROM category WHERE categoryid = $cat7";
	$category7_result = $conn->query($category7_select);
	$row7 = $category7_result->fetch_assoc();
	echo "<tr><td><b>Category 7:</b></td><td>".$row7['categoryname']."</td></tr>";
	
	echo "<tr><td><b>Show Age:</b></td><td>".$row['showage']."</td></tr>";
	echo "<tr><td><b>Nut:</b></td><td>".$row['showweekly_nut']."</td></tr>";
	echo "<tr><td><b>Number of Trucks:</b></td><td>".$row['shownumber_of_trucks']."</td></tr>";	
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