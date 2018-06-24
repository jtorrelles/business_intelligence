<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header_nologout.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h1>Add a New Show:</h1>";
	echo "<form action=\"shows_add_results.php\" method=\"POST\">";
	echo "<table>";
	//echo "<tr><td><b>Show ID:</b></td><td><input disabled type='text' name='id_show'> This field is AUTO GENERATED</td></tr>";	
    echo "<tr><td><b>Show Name:</b></td><td><input autofocus='autofocus' type='text' name='name_show'></td></tr>";
	echo "<tr><td><b>Is the Show Active?:</b></td>
	      <td><select name='active_show'><br><br>
		         <option value='Y'>YES</option>
		         <option value='N' selected='selected'>NO</option>
		  </select></td></tr>";
	echo "<tr><td><b>Category 1:</b></td>";
	echo "<td><select name='category1_show'>";
	    echo "<option selected hidden value='0'>Choose Category 1</option>";
		$category_sql = "SELECT categoryid, categoryname FROM category ORDER BY categoryid ASC";
		$category_sql_result = $conn->query($category_sql);
		while ($row_sql = $category_sql_result->fetch_assoc()) {
              echo "<option value='".$row_sql['categoryid']."'>".$row_sql['categoryname']."</option>";
        }
	echo "</select></td></tr>";

	echo "<tr><td><b>Category 2:</b></td>";	
	echo "<td><select name='category2_show'>";
	    echo "<option selected hidden value='0'>Choose Category 2</option>";
		$category_sql = "SELECT categoryid, categoryname FROM category ORDER BY categoryid ASC";
		$category_sql_result = $conn->query($category_sql);
		while ($row_sql = $category_sql_result->fetch_assoc()) {
              echo "<option value='".$row_sql['categoryid']."'>".$row_sql['categoryname']."</option>";
        }
	echo "</select></td></tr>";
	
	echo "<tr><td><b>Category 3:</b></td>";	
	echo "<td><select name='category3_show'>";
	    echo "<option selected hidden value='0'>Choose Category 3</option>";
		$category_sql = "SELECT categoryid, categoryname FROM category ORDER BY categoryid ASC";
		$category_sql_result = $conn->query($category_sql);
		while ($row_sql = $category_sql_result->fetch_assoc()) {
              echo "<option value='".$row_sql['categoryid']."'>".$row_sql['categoryname']."</option>";
        }
	echo "</select></td></tr>";	
	
	echo "<tr><td><b>Category 4:</b></td>";	
	echo "<td><select name='category4_show'>";
	    echo "<option selected hidden value='0'>Choose Category 4</option>";
		$category_sql = "SELECT categoryid, categoryname FROM category ORDER BY categoryid ASC";
		$category_sql_result = $conn->query($category_sql);
		while ($row_sql = $category_sql_result->fetch_assoc()) {
              echo "<option value='".$row_sql['categoryid']."'>".$row_sql['categoryname']."</option>";
        }
	echo "</select></td></tr>";
	
	echo "<tr><td><b>Category 5:</b></td>";	
	echo "<td><select name='category5_show'>";
	    echo "<option selected hidden value='0'>Choose Category 5</option>";
		$category_sql = "SELECT categoryid, categoryname FROM category ORDER BY categoryid ASC";
		$category_sql_result = $conn->query($category_sql);
		while ($row_sql = $category_sql_result->fetch_assoc()) {
              echo "<option value='".$row_sql['categoryid']."'>".$row_sql['categoryname']."</option>";
        }
	echo "</select></td></tr>";
	
	echo "<tr><td><b>Category 6:</b></td>";	
	echo "<td><select name='category6_show'>";
	    echo "<option selected hidden value='0'>Choose Category 6</option>";
		$category_sql = "SELECT categoryid, categoryname FROM category ORDER BY categoryid ASC";
		$category_sql_result = $conn->query($category_sql);
		while ($row_sql = $category_sql_result->fetch_assoc()) {
              echo "<option value='".$row_sql['categoryid']."'>".$row_sql['categoryname']."</option>";
        }
	echo "</select></td></tr>";
	
	echo "<tr><td><b>Category 7:</b></td>";	
	echo "<td><select name='category7_show'>";
	    echo "<option selected hidden value='0'>Choose Category 7</option>";
		$category_sql = "SELECT categoryid, categoryname FROM category ORDER BY categoryid ASC";
		$category_sql_result = $conn->query($category_sql);
		while ($row_sql = $category_sql_result->fetch_assoc()) {
              echo "<option value='".$row_sql['categoryid']."'>".$row_sql['categoryname']."</option>";
        }
	echo "</select></td></tr>";

	echo "<tr><td><b>Show Age:</b></td><td><input type='text' name='age_show' value='ALL AGES'></td></tr>";
	echo "<tr><td><b>Weekly Nut:</b></td><td><input type='text' name='nut_show' value='0'></td></tr>";
	echo "<tr><td><b>Number of Cast:</b></td><td><input type='text' name='cast_show' value='0'></td></tr>";
	echo "<tr><td><b>Number of Musicians:</b></td><td><input type='text' name='musicians_show' value='0'></td></tr>";
	echo "<tr><td><b>Number of Stagehands:</b></td><td><input type='text' name='stagehands_show' value=0></td></tr>";
	echo "<tr><td><b>Number of Trucks:</b></td><td><input type='text' name='trucks_show' value=0></td></tr>";
	echo "<tr><td><b>Notes:</b></td><td><textarea rows=4 cols=40 name='notes_show'></textarea></td></tr>";
	echo "</table>";
	echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"Create / Save\"></p>";
	echo "</form>";

$conn->close();
include '../footer.html';
?>
