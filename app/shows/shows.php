<?php
require '../db/database_conn.php';
include '../session.php';
include '../header.html';
// Check connection
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

#shows td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#shows tr:nth-child(even){background-color: #f2f2f2;}

#shows tr:hover {background-color: #ddd;}

#shows th {
	padding: 8px;
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #000066;
    color: white;
}
</style>
</head>
<body>";

echo "<form action=\"shows.php\" method=\"POST\">";
$sql = "SELECT categoryid, categoryname FROM category";
$result = $conn->query($sql);
echo "<select name='CATEGORY'>";
echo "<option value=''>Select a Category</option>";
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['categoryid'] . "'>" . $row['categoryname'] . "</option>";
}
echo "</select>";
echo "<input type=\"submit\" name=\"search\" value=\"Find\">";
echo "</form>";
echo "<br>";
if (isset($_POST['CATEGORY']))
{
	$selectedcategory = $_POST['CATEGORY'];
	$sql = "SELECT categoryname FROM category WHERE categoryid = $selectedcategory";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
    echo "<b>Selected Category: ".$row['categoryname']."</b><br><br>";
}
}
else
{
	$selectedcategory = '9999';
	echo "No category selected<br>";
}

$sql = "SELECT 
		showname,
		showactive
		FROM shows WHERE 
		(showactive = 'Y' AND categoryid_1 = $selectedcategory)
		OR (showactive = 'Y' AND categoryid_2 = $selectedcategory)
		OR (showactive = 'Y' AND categoryid_3 = $selectedcategory)
		OR (showactive = 'Y' AND categoryid_4 = $selectedcategory)
		OR (showactive = 'Y' AND categoryid_5 = $selectedcategory)
		OR (showactive = 'Y' AND categoryid_6 = $selectedcategory)
		OR (showactive = 'Y' AND categoryid_7 = $selectedcategory)";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<table id=\"shows\">
    <tr>
	<th>Show Name</th>
	<th>Is the Show Active?</th>
	<th>Options</th>
	</tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo 
		"<tr>
		<td>". $row["showname"]. "</td>
		<td>". $row["showactive"]. "</td>
		<td>Edit Options Here</td>
		</tr>";
    }
	echo "</table>";
} else {
    echo "0 results. Please select another category.";
}
echo "</body></html>";
$conn->close();
include '../footer.html';
?> 