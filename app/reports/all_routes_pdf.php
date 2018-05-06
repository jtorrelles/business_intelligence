<?php

require '../libs/dompdf/dompdf_config.inc.php';

$codHtml = $_POST['codhtml'];

$codHtml=utf8_encode($codHtml);
$dompdf=new DOMPDF();
$dompdf->set_paper("letter", "portrait");
$dompdf->load_html($codHtml);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("AllRoutes.pdf");

?>
