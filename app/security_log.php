<?php
include('db/database_conn.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
date_default_timezone_set("America/Denver");
$user = $_SESSION['login_user'];
//$description = "description";
$date1 = date("Y/m/d");
$time1 = date("G:i:s");

$sql= "INSERT INTO security_log(user,description,date,time) VALUES ('$user','$description','$date1','$time1')";
$conn->query($sql);
//echo "You are logged in as: <b>".$user."</b><br>";
?>