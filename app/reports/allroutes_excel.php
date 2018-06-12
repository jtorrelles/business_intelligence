<?php

require_once '../libs/PHPExcel.php';

$codHtml = $_POST['htmlexc'];
$name = $_POST['name'];
$file = $_POST['name'] . ".xlsx";

libxml_use_internal_errors(true);

function Workcell($type,$cell,$value){
	global $objPHPExcel; 

	switch ($type) {
	    case 'Color':
	        $objPHPExcel->getActiveSheet()->getStyle($cell)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => $value)));	
	        break;
	    case 'Border':
	    	$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray(array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))));
	        break;    
	    case 'Width':
	        $objPHPExcel->getActiveSheet()->getColumnDimension($cell)->setWidth($value);
	        break;
	    case 'Merge':
	        $objPHPExcel->setActiveSheetIndex(0)->mergeCells($cell);
	        break;
	    case 'Bold':
	        $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
	        break;
	    case 'Value':
	        $objPHPExcel->getActiveSheet()->setCellValue($cell,$value);
	        break;
	    case 'Format':
	        $objPHPExcel->getActiveSheet()->getStyle($cell)->getNumberFormat()->setFormatCode($value);
	        break;  
	    case 'Center':
	        $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        break; 
	    case 'Percent':
	        $objPHPExcel->getActiveSheet()->getStyle($cell)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00));
	    case 'Font':
	    	$style = array('font' => array('name'  => 'Arial','size' => 10,'color' => array('rgb' => $value)));
	        $objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($style);
	        break;  
	}
}

$tmpfile = tempnam(sys_get_temp_dir(), 'html');
file_put_contents($tmpfile, $codHtml);

$objPHPExcel = new PHPExcel();
$excelHTMLReader = PHPExcel_IOFactory::createReader('HTML');
$excelHTMLReader->loadIntoExisting($tmpfile,$objPHPExcel);
$objPHPExcel->getActiveSheet()->setTitle($name); 
unlink($tmpfile);

$objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);

$style = array('font' => array('name'  => 'Arial','size' => 10,'color' => array('rgb' => 'FF0000')));

$hcol = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
$hrow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

$hcol++;
for ($row=1;$row< $hrow+1;$row++) { 
	for ($col='A';$col!=$hcol;$col++) {
	    Workcell('Color',$col.'1','000066');
	    Workcell('Center',$col.$row,'');
	    Workcell('Font',$col.$row,'000000');
	    Workcell('Font',$col.'1','FFFFFF');
	    $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
	}    
}

$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(1,2);

ob_end_clean();

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');	
$objWriter->save('php://output');

exit;

?>

