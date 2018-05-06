<?php

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=All_Routes.xls");

$codHtml = $_POST['codhtml'];

echo $codHtml;
?>

