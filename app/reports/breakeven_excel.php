<?php

require_once '../libs/PHPExcel.php';       
        
$objPHPExcel   = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);

$style = array('font' => array('name'  => 'Arial','size' => 10));

foreach( range('A','K') as $letra ){ 
	$objPHPExcel->getActiveSheet()->getStyle($letra)->applyFromArray($style);
}

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);

$objPHPExcel->getActiveSheet()->getStyle('C12:K12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('K7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('K11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

function cellColor($cells,$color){
    global $objPHPExcel;

    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => $color)));

    $objPHPExcel->getActiveSheet()->getStyle($cells)->applyFromArray(array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))));
}

cellColor('A1:I1','FFFFFF');
cellColor('A2:I2','FFFFFF');
cellColor('B4:B7','008000');
cellColor('B9','FFFFFF');
cellColor('B9','008000');
cellColor('K7:K9','FFFFFF');
cellColor('K11','FFFFFF');
cellColor('C12:K12','FFFFFF');

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B1:C1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E1:F1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('H1:I1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B2:C2');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E2:F2');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('H2:I2');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('K7:K8');

$objPHPExcel->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("D1:D2")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("G1:G2")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("K7")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("K11")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("C12:K12")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("A33")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("A35")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("A73")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("A75")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("A77")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("A84")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("A91")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("A96")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("A101")->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'SHOW NAME:');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'A Chorus Line');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'CITY:');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Newark');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'STATE:');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Nottinghamshire');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'INIT DATE:');
$objPHPExcel->getActiveSheet()->SetCellValue('B2', '04/26/2011');
$objPHPExcel->getActiveSheet()->SetCellValue('D2', 'END DATE:');
$objPHPExcel->getActiveSheet()->SetCellValue('E2', '05/01/2011');
$objPHPExcel->getActiveSheet()->SetCellValue('G2', 'VENUE:');
$objPHPExcel->getActiveSheet()->SetCellValue('H2', 'New Jersey PAC');

$objPHPExcel->getActiveSheet()->SetCellValue('A4', 'No. of Shows Per Week');
$objPHPExcel->getActiveSheet()->SetCellValue('B4', str_replace(",","",$_POST['NSPWII']));
$objPHPExcel->getActiveSheet()->SetCellValue('A5', '# of Weeks');
$objPHPExcel->getActiveSheet()->SetCellValue('B5', str_replace(",","",$_POST['NOW1II']));
$objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Seats Per Show');
$objPHPExcel->getActiveSheet()->SetCellValue('B6', str_replace(",","",$_POST['SPSHII']));
$objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Weekly Gross Potential');
$objPHPExcel->getActiveSheet()->SetCellValue('B7', str_replace(",","",$_POST['WGPOII']));
$objPHPExcel->getActiveSheet()->SetCellValue('A8', 'Net Avg per Tix');
$objPHPExcel->getActiveSheet()->setCellValue('B8', '=ROUND((+B7/(B6*B4)),2)');
$objPHPExcel->getActiveSheet()->SetCellValue('A9', 'Exchange Rate');
$objPHPExcel->getActiveSheet()->SetCellValue('B9', str_replace(",","",$_POST['EXRAII']));

$objPHPExcel->getActiveSheet()->SetCellValue('K7', 'Cumulative Engagement Break');
$objPHPExcel->getActiveSheet()->SetCellValue('K9', '=ROUND(+K24*B5,0)');
$objPHPExcel->getActiveSheet()->SetCellValue('K11', 'Weekly Engagement');

$objPHPExcel->getActiveSheet()->SetCellValue('A13', 'House Capacity');
$objPHPExcel->getActiveSheet()->SetCellValue('A14', 'Performance Capacity'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A15', 'Tickets Sold'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A16', 'No. of Weeks'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A17', 'Box Office Gross'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A18', 'Sub Load - in');  
$objPHPExcel->getActiveSheet()->SetCellValue('A19', 'Estimated Groups'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A20', 'Estimated Singles'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A21', 'Less Subs Discounts'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A22', 'Less Group Discounts'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A23', 'Less Singles Discounts'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A24', 'Adjusted Gross'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A25', 'Adjusted Gross Potential %'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A26', 'Sales Tax 1'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A27', 'Sales Tax 2'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A28', 'Facility Fee 1'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A29', 'Facility Fee 2'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A30', 'Subscription Commission'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A31', 'Group Sales Commission'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A32', 'Credit Card & Other Commissions'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A33', 'Net Adjusted B. O. Recepts'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A35', 'WEEKLY EXPENSES'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A36', 'Guarantee'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A37', 'Variable Guarantee'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A38', 'ADVERTISING (at gross)'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A39', 'STAGEHANDS (Load-in)'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A40', 'STAGEHANDS (Load-out)'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A41', 'STAGEHANDS (Running)'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A42', 'WARDROBE and HAIR (Load-in)'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A43', 'WARDROBE and HAIR (Load-out)'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A44', 'WARDROBE and HAIR (Running)'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A45', 'LABOR CATERING'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A46', 'MUSICIANS'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A47', 'INSURANCE (ON DROP COUNT)'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A48', 'TICKET PRINTING'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A49', 'OTHER'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A50', 'ADA EXPENSE'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A51', 'BOX OFFICE'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A52', 'DRY ICE/CO2'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A53', 'FIRE MARSHALL/PYRO'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A54', 'HOSPITALITY/WATER'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A55', 'HOUSE STAFF'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A56', 'LICENSES/PERMITS'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A57', 'LIMOS/AUTO (STARS/PR)'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A58', 'PIANO TUNINGS'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A59', 'POLICE/SECURITY'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A60', 'PRESENTER PROFIT'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A61', 'PRESS AGENT FEE'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A62', 'PROGRAMS'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A63', 'RENT'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A64', 'SOUND/LIGHTS'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A65', 'TELEPHONES/INTERNET'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A66', '3RD PARTY EQUIPMENT RENTAL'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A67', 'TRUCK PARKING/WRECKERS'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A68', 'OTHER'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A69', 'OTHER'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A70', 'OTHER'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A71', 'OTHER'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A72', 'LOCAL FIXED'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A73', 'TOTAL LOCAL EXPENSE'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A75', 'FORMULA CHECK');  
$objPHPExcel->getActiveSheet()->SetCellValue('A77', 'Money Remaining'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A79', 'Next Monies - To Producer (Base)'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A80', 'Next Monies - To Producer');  
$objPHPExcel->getActiveSheet()->SetCellValue('A81', 'Next Monies - To Presenter (Base)'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A82', 'Next Monies - To Presenter');  
$objPHPExcel->getActiveSheet()->SetCellValue('A84', 'Total Engagement Profit');  
$objPHPExcel->getActiveSheet()->SetCellValue('A86', 'Producer Share of Overages');  
$objPHPExcel->getActiveSheet()->SetCellValue('A87', 'Presenter Share of Overages');  
$objPHPExcel->getActiveSheet()->SetCellValue('A88', 'Next Monies');  
$objPHPExcel->getActiveSheet()->SetCellValue('A89', 'Variable Guarantee');  
$objPHPExcel->getActiveSheet()->SetCellValue('A90', 'Guarantee');  
$objPHPExcel->getActiveSheet()->SetCellValue('A91', 'TOTAL TO PRODUCER');  
$objPHPExcel->getActiveSheet()->SetCellValue('A92', 'U. S. Rate'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A94', 'Less Income Taxes Witheld (1)'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A95', 'Less Income Taxes Witheld (2)'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A96', 'Net Income to Producer'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A98', 'Weekly Operating Expenses (include Amort)'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A99', 'Royalty Minimum $'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A100', 'Variable Royalty %'); 
$objPHPExcel->getActiveSheet()->SetCellValue('A101', 'Total Show Profit');

$objPHPExcel->getActiveSheet()->SetCellValue('C12', 'Weekly');
$objPHPExcel->getActiveSheet()->SetCellValue('D12', 'Weekly');
$objPHPExcel->getActiveSheet()->SetCellValue('E12', 'Weekly');
$objPHPExcel->getActiveSheet()->SetCellValue('F12', 'Weekly');
$objPHPExcel->getActiveSheet()->SetCellValue('G12', 'RUN');
$objPHPExcel->getActiveSheet()->SetCellValue('H12', 'RUN');
$objPHPExcel->getActiveSheet()->SetCellValue('I12', 'RUN');
$objPHPExcel->getActiveSheet()->SetCellValue('J12', 'RUN');
$objPHPExcel->getActiveSheet()->SetCellValue('K12', 'BREAKEVEN');




$objPHPExcel->getActiveSheet()->setTitle('BOOKING ANALYSIS');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setPreCalculateFormulas(true);

ob_end_clean();

header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Breakeven.xlsx"');
$objWriter->save('php://output');

?>



