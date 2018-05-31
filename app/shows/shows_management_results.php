 <?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id_show = $_POST['id_show'];
$name_show = $_POST['name_show'];
$active_show = $_POST['active_show'];
$category1_show = $_POST['category1_show'];
$category2_show = $_POST['category2_show'];
$category3_show = $_POST['category3_show'];
$category4_show = $_POST['category4_show'];
$category5_show = $_POST['category5_show'];
$category6_show = $_POST['category6_show'];
$category7_show = $_POST['category7_show'];
$age_show = $_POST['age_show'];
$nut_show = $_POST['nut_show'];
$cast_show = $_POST['cast_show'];
$musicians_show = $_POST['musicians_show'];
$stagehands_show = $_POST['stagehands_show'];
$trucks_show = $_POST['trucks_show'];
$notes_show = $_POST['notes_show'];
$sql = "UPDATE shows SET 
		showid = '$id_show',
		showname = '$name_show',
		showactive = '$active_show',
		categoryid_1 = $category1_show,
		categoryid_2 = $category2_show,
		categoryid_3 = $category3_show,
		categoryid_4 = $category4_show,
		categoryid_5 = $category5_show,
		categoryid_6 = $category6_show,
		categoryid_7 = $category7_show,
		showage = '$age_show',
		showweekly_nut = $nut_show,
		shownumber_of_cast = '$cast_show',
		shownumber_of_musicians = $musicians_show,
		shownumber_of_stagehands = $stagehands_show,
		shownumber_of_trucks = $trucks_show,
		shownotes = '$notes_show'
		WHERE showid = $id_show";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
	$description = "Modified Show: ".$_POST['name_show']." using this query: ".str_replace("'"," ",$sql);
	include '../security_log.php';
} else {
    $error = "Error updating record: " .$conn->error;
	echo $error;
	$description = "Error Modifying Show: ".$_POST['name_show'].". The database returned this error: ".str_replace("'"," ",$error)." using this query: ".str_replace("'"," ",$sql);
	include '../security_log.php';
}
echo "
	<script language=\"javascript\"
		type=\"text/javascript\">
		function windowClose() {
			window.open('','_parent','');
			window.opener.location.reload();
			window.close();
		}
	</script>
	<p align=center>
	<input type=\"button\" value=\"CLOSE THIS WINDOW\" onclick=\"windowClose();\">
	</p>
";
$conn->close();
include '../footer.html';
?> 