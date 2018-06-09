<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<h1>Modify An Existing Template:</h1>";

$conn->close();
include '../footer.html';
?>