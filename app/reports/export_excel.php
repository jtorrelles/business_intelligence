<?php

$codHtml = $_POST['codhtml'];
$name = $_POST['name'] . ".xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$name");

echo $codHtml;
?>

