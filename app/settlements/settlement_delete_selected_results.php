 <?php
require '../db/database_conn.php';
include '../header.html';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$sql = "DELETE FROM settlements_details WHERE SettlementID = $id";

if ($conn->query($sql) === TRUE) {

	$sql2 = "DELETE FROM settlements WHERE SettlementID = $id";
	if ($conn->query($sql2) === TRUE) {

		echo "Record Deleted Successfully";

	}else{
		echo "Error Deleting Record: " . $conn->error;
	}

} else {
    echo "Error Deleting Record: " . $conn->error;
}

echo "<script language=\"javascript\" type=\"text/javascript\">
		function windowClose() {
			window.open('','_parent','');
			window.opener.location.reload();
			window.close();
		}
	</script>
	<p align=center>
		<input type=\"button\" value=\"CLOSE THIS WINDOW\" onclick=\"windowClose();\">
	</p>";

$conn->close();

include '../footer.html';

?> 