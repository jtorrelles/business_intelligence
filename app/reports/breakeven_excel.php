<?php

require_once '../libs/PHPExcel.php';       
        
$objPHPExcel   = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);

foreach( range('A','L') as $letra ){ 
   $objPHPExcel->getActiveSheet()->getColumnDimension($letra)->setAutoSize(true);
}

$objPHPExcel->getActiveSheet()->SetCellValue('B4', 'No. of Shows Per Week');
$objPHPExcel->getActiveSheet()->SetCellValue('C4', $_POST['NSPWII']);
$objPHPExcel->getActiveSheet()->SetCellValue('B5', '# of Weeks');
$objPHPExcel->getActiveSheet()->SetCellValue('C5', $_POST['NOW1II']);
$objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Seats Per Show');
$objPHPExcel->getActiveSheet()->SetCellValue('C6', $_POST['SPSHII']);

$objPHPExcel->getActiveSheet()->setTitle('Breakeven');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

ob_end_clean();

header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Breakeven.xlsx"');
$objWriter->save('php://output');




?>



