<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header_nologout.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<h1>Modify An Existing Show:</h1>";
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
				   shownumber_of_cast,
				   shownumber_of_musicians,
				   shownumber_of_stagehands,
				   shownumber_of_trucks,
				   shownotes
				   FROM shows WHERE showid = $selectedid";
	$result = $conn->query($sql);

	while ($row = $result->fetch_assoc()) {
	$description = "Accessed show data for: ".$row['showname'].". Current data is: 
	showactive: ".$row['showactive'].", 
	categoryid_1: ".$row['categoryid_1'].", 
	categoryid_2: ".$row['categoryid_2'].", 
	categoryid_3: ".$row['categoryid_3'].", 
	categoryid_4: ".$row['categoryid_4'].", 
	categoryid_5: ".$row['categoryid_5'].", 
	categoryid_6: ".$row['categoryid_6'].", 
	categoryid_7: ".$row['categoryid_7'].", 
	showage: ".$row['showage'].", 
	showweekly_nut: ".$row['showweekly_nut'].", 
	shownumber_of_cast: ".$row['shownumber_of_cast'].", 
	shownumber_of_musicians: ".$row['shownumber_of_musicians'].", 
	shownumber_of_stagehands: ".$row['shownumber_of_stagehands'].", 
	shownumber_of_trucks: ".$row['shownumber_of_trucks'].", 
	shownotes: ".$row['shownotes'];
	include '../security_log.php';
	echo "<form action=\"shows_management_results.php\" method=\"POST\">";
	echo "<table>";
	echo "<tr><td><b>Show ID:</b></td><td><input style=\"background-color: lightgrey;\" readonly type='text' name='id_show' value='".$row['showid']."'></td></tr>";	
    echo "<tr><td><b>Show Name:</b></td><td><input autofocus='autofocus' type='text' name='name_show' value=\"".$row['showname']."\"></td></tr>";

	$active = $row['showactive'];
	if ($active == 'N') {
	echo "<tr><td><b>Is the Show Active?:</b></td>
	      <td><select name='active_show'><br><br>
		         <option value='Y'>YES</option>
		         <option value='N' selected='selected'>NO</option>
		  </select></td></tr>
	";}
	else {
	echo "<tr><td><b>Is the Show Active?:</b></td>
	      <td><select name='active_show'>
		         <option value='Y' selected='selected'>YES</option>
		         <option value='N'>NO</option>
		  </select></td></tr>";
	}
	$cat1 = $row['categoryid_1'];
	$category1_select = "SELECT categoryid, categoryname FROM category WHERE categoryid = $cat1";
	$category1_result = $conn->query($category1_select);
	$row1 = $category1_result->fetch_assoc();
	echo "<tr><td><b>Category 1:</b></td>";
	echo "
	<td><select name='category1_show'>
		<option selected hidden value=".$row1['categoryid'].">".$row1['categoryname']."</option>";
		$category_sql = "SELECT categoryid, categoryname FROM category ORDER BY categoryid ASC";
		$category_sql_result = $conn->query($category_sql);
		while ($row_sql = $category_sql_result->fetch_assoc()) {
              echo "<option value='".$row_sql['categoryid']."'>".$row_sql['categoryname']."</option>";
        }
	echo "</select></td></tr>";

	$cat2 = $row['categoryid_2'];
	$category2_select = "SELECT categoryid, categoryname FROM category WHERE categoryid = $cat2";
	$category2_result = $conn->query($category2_select);
	$row2 = $category2_result->fetch_assoc();
	echo "<tr><td><b>Category 2:</b></td>";
	echo "
	<td><select name='category2_show'>
		<option selected hidden value=".$row2['categoryid'].">".$row2['categoryname']."</option>";
		$category_sql = "SELECT categoryid, categoryname FROM category ORDER BY categoryid ASC";
		$category_sql_result = $conn->query($category_sql);
		while ($row_sql = $category_sql_result->fetch_assoc()) {
              echo "<option value='".$row_sql['categoryid']."'>".$row_sql['categoryname']."</option>";
        }
	echo "</select></td></tr>";	

	$cat3 = $row['categoryid_3'];
	$category3_select = "SELECT categoryid, categoryname FROM category WHERE categoryid = $cat3";
	$category3_result = $conn->query($category3_select);
	$row3 = $category3_result->fetch_assoc();
	echo "<tr><td><b>Category 3:</b></td>";
	echo "
	<td><select name='category3_show'>
		<option selected hidden value=".$row3['categoryid'].">".$row3['categoryname']."</option>";
		$category_sql = "SELECT categoryid, categoryname FROM category ORDER BY categoryid ASC";
		$category_sql_result = $conn->query($category_sql);
		while ($row_sql = $category_sql_result->fetch_assoc()) {
              echo "<option value='".$row_sql['categoryid']."'>".$row_sql['categoryname']."</option>";
        }
	echo "</select></td></tr>";	
	
	$cat4 = $row['categoryid_4'];
	$category4_select = "SELECT categoryid, categoryname FROM category WHERE categoryid = $cat4";
	$category4_result = $conn->query($category4_select);
	$row4 = $category4_result->fetch_assoc();
	echo "<tr><td><b>Category 4:</b></td>";
	echo "
	<td><select name='category4_show'>
		<option selected hidden value=".$row4['categoryid'].">".$row4['categoryname']."</option>";
		$category_sql = "SELECT categoryid, categoryname FROM category ORDER BY categoryid ASC";
		$category_sql_result = $conn->query($category_sql);
		while ($row_sql = $category_sql_result->fetch_assoc()) {
              echo "<option value='".$row_sql['categoryid']."'>".$row_sql['categoryname']."</option>";
        }
	echo "</select></td></tr>";	
	
	$cat5 = $row['categoryid_5'];
	$category5_select = "SELECT categoryid, categoryname FROM category WHERE categoryid = $cat5";
	$category5_result = $conn->query($category5_select);
	$row5 = $category5_result->fetch_assoc();
	echo "<tr><td><b>Category 5:</b></td>";
	echo "
	<td><select name='category5_show'>
		<option selected hidden value=".$row5['categoryid'].">".$row5['categoryname']."</option>";
		$category_sql = "SELECT categoryid, categoryname FROM category ORDER BY categoryid ASC";
		$category_sql_result = $conn->query($category_sql);
		while ($row_sql = $category_sql_result->fetch_assoc()) {
              echo "<option value='".$row_sql['categoryid']."'>".$row_sql['categoryname']."</option>";
        }
	echo "</select></td></tr>";	
	
	$cat6 = $row['categoryid_6'];
	$category6_select = "SELECT categoryid, categoryname FROM category WHERE categoryid = $cat6";
	$category6_result = $conn->query($category6_select);
	$row6 = $category6_result->fetch_assoc();
	echo "<tr><td><b>Category 6:</b></td>";
	echo "
	<td><select name='category6_show'>
		<option selected hidden value=".$row6['categoryid'].">".$row6['categoryname']."</option>";
		$category_sql = "SELECT categoryid, categoryname FROM category ORDER BY categoryid ASC";
		$category_sql_result = $conn->query($category_sql);
		while ($row_sql = $category_sql_result->fetch_assoc()) {
              echo "<option value='".$row_sql['categoryid']."'>".$row_sql['categoryname']."</option>";
        }
	echo "</select></td></tr>";	
	
	$cat7 = $row['categoryid_7'];
	$category7_select = "SELECT categoryid, categoryname FROM category WHERE categoryid = $cat7";
	$category7_result = $conn->query($category7_select);
	$row7 = $category7_result->fetch_assoc();
	echo "<tr><td><b>Category 7:</b></td>";
	echo "
	<td><select name='category7_show'>
		<option selected hidden value=".$row7['categoryid'].">".$row7['categoryname']."</option>";
		$category_sql = "SELECT categoryid, categoryname FROM category ORDER BY categoryid ASC";
		$category_sql_result = $conn->query($category_sql);
		while ($row_sql = $category_sql_result->fetch_assoc()) {
              echo "<option value='".$row_sql['categoryid']."'>".$row_sql['categoryname']."</option>";
        }
	echo "</select></td></tr>";		
	
	echo "<tr><td><b>Show Age:</b></td><td><input type='text' name='age_show' value='".$row['showage']."'></td></tr>";
	echo "<tr><td><b>Nut:</b></td><td><input type='text' name='nut_show' value='".$row['showweekly_nut']."'></td></tr>";
	echo "<tr><td><b>Number of Cast:</b></td><td><input type='text' name='cast_show' value='".$row['shownumber_of_cast']."'></td></tr>";
	echo "<tr><td><b>Number of Musicians:</b></td><td><input type='text' name='musicians_show' value='".$row['shownumber_of_musicians']."'></td></tr>";
	echo "<tr><td><b>Number of Stagehands:</b></td><td><input type='text' name='stagehands_show' value='".$row['shownumber_of_stagehands']."'></td></tr>";
	echo "<tr><td><b>Number of Trucks:</b></td><td><input type='text' name='trucks_show' value='".$row['shownumber_of_trucks']."'></td></tr>";
	echo "<tr><td><b>Notes:</b></td><td><textarea rows=4 cols=40 name='notes_show'>".$row['shownotes']."</textarea></td></tr>";
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
