 <?php
require '../db/database_conn.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
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
$trucks_show = $_POST['trucks_show'];

$sql = "INSERT INTO shows 
(showname,showactive,categoryid_1,categoryid_2,categoryid_3,categoryid_4,categoryid_5,categoryid_6,categoryid_7,showage,showweekly_nut,shownumber_of_trucks)
VALUES
('$name_show','$active_show',$category1_show,$category2_show,$category3_show,$category4_show,$category5_show,$category6_show,$category7_show,'$age_show',$nut_show,$trucks_show)";

if ($conn->query($sql) === TRUE) {
    echo "Record Created successfully";
} else {
    echo "Error Creating record: " . $conn->error;
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