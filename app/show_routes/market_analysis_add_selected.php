<?php
require '../db/database_conn.php';
include '../header.html';
echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/show_routes_controller.js\"></script>";
echo "<table>";
echo "<tr><td><h2>MARKET ANALYSIS</h2></td></tr>";
echo "<tr><td><h3>PROFORMA: VENUE TAB</h3></td></tr>";
echo "</table>";
$id = $_GET['selectedid'];
include 'market_analysis_add_selected.html';
include '../footer.html';
?>