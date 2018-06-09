<?php

require_once '../libs/PHPExcel.php';
        
$objPHPExcel   = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);

$style = array('font' => array('name'  => 'Arial','size' => 10));

foreach( range('A','K') as $letra ){ 
	$objPHPExcel->getActiveSheet()->getStyle($letra)->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->getStyle($letra)->getNumberFormat()->setFormatCode('#,##0');
}

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
	        break;  
	}
}


Workcell('Percent','C14:K14','');

Workcell('Center','C12:K12','');
Workcell('Center','K7','');
Workcell('Center','K11','');

Workcell('Format','B8','$ #,##0.00');

Workcell('Color','A1:I1','FFFFFF');
Workcell('Color','A2:I2','FFFFFF');
Workcell('Color','B4:B7','008000');
Workcell('Color','B26:B32','008000');
Workcell('Color','B36:B72','008000');
Workcell('Color','B79','008000');
Workcell('Color','B81','008000');
Workcell('Color','B94','008000');
Workcell('Color','B98','008000');
Workcell('Color','B9','FFFFFF');
Workcell('Color','B9','008000');
Workcell('Color','K7:K9','FFFFFF');
Workcell('Color','K11','FFFFFF');
Workcell('Color','C12:K12','FFFFFF');
Workcell('Color','C14:J14','00FFFF');
Workcell('Color','B18:B19','00FFFF');
Workcell('Color','B21:B23','00FFFF');
Workcell('Color','B80','00FFFF');
Workcell('Color','B82','00FFFF');
Workcell('Color','B86:B87','00FFFF');
Workcell('Color','B94:B95','00FFFF');
Workcell('Color','B99:B100','00FFFF');
Workcell('Color','K13:K101','7FFFD4');
Workcell('Color','K14','FFFF00');
Workcell('Color','K84','FFFF00');
Workcell('Color','K101','FFFF00');

Workcell('Border','A1:I1','');
Workcell('Border','A2:I2','');
Workcell('Border','B4:B7','');
Workcell('Border','B9','');
Workcell('Border','B9','');
Workcell('Border','C14:K14','');
Workcell('Border','K7:K9','');
Workcell('Border','K11','');
Workcell('Border','C12:K12','');
Workcell('Border','B18:B19','');
Workcell('Border','B21:B23','');
Workcell('Border','B80','');
Workcell('Border','B82','');
Workcell('Border','B86:B87','');
Workcell('Border','B94:B95','');
Workcell('Border','B99:B100','');
Workcell('Border','B26:B32','');
Workcell('Border','B36:B72','');
Workcell('Border','B79','');
Workcell('Border','B81','');
Workcell('Border','B94','');
Workcell('Border','B98','');

Workcell('Width','A',30);
Workcell('Width','B',9);
Workcell('Width','C',9);
Workcell('Width','D',9);
Workcell('Width','E',9);
Workcell('Width','F',9);
Workcell('Width','G',9);
Workcell('Width','H',9);
Workcell('Width','I',9);
Workcell('Width','J',9);
Workcell('Width','K',15);

Workcell('Merge','B1:C1','');
Workcell('Merge','E1:F1','');
Workcell('Merge','H1:I1','');
Workcell('Merge','B2:C2','');
Workcell('Merge','E2:F2','');
Workcell('Merge','H2:I2','');
Workcell('Merge','K7:K8','');

Workcell('Bold','A1:A2','');
Workcell('Bold','D1:D2','');
Workcell('Bold','G1:G2','');
Workcell('Bold','K7','');
Workcell('Bold','K11','');
Workcell('Bold','C12:K12','');
Workcell('Bold','A33','');
Workcell('Bold','A35','');
Workcell('Bold','A73','');
Workcell('Bold','A75','');
Workcell('Bold','A77','');
Workcell('Bold','A84','');
Workcell('Bold','A91','');
Workcell('Bold','A96','');
Workcell('Bold','A101','');

Workcell('Value','A1', 'SHOW NAME:');
Workcell('Value','B1', 'A Chorus Line');
Workcell('Value','D1', 'CITY:');
Workcell('Value','E1', 'Newark');
Workcell('Value','G1', 'STATE:');
Workcell('Value','H1', 'Nottinghamshire');
Workcell('Value','A2', 'INIT DATE:');
Workcell('Value','B2', '04/26/2011');
Workcell('Value','D2', 'END DATE:');
Workcell('Value','E2', '05/01/2011');
Workcell('Value','G2', 'VENUE:');
Workcell('Value','H2', 'New Jersey PAC');

Workcell('Value','A4', 'No. of Shows Per Week');
Workcell('Value','B4', str_replace(',','',$_POST['NSPWII']));
Workcell('Value','A5', '# of Weeks');
Workcell('Value','B5', str_replace(',','',$_POST['NOW1II']));
Workcell('Value','A6', 'Seats Per Show');
Workcell('Value','B6', str_replace(',','',$_POST['SPSHII']));
Workcell('Value','A7', 'Weekly Gross Potential');
Workcell('Value','B7', str_replace(',','',$_POST['WGPOII']));
Workcell('Value','A8', 'Net Avg per Tix');
Workcell('Value','B8', '=ROUND((+B7/(B6*B4)),2)');
Workcell('Value','A9', 'Exchange Rate');
Workcell('Value','B9', str_replace(',','',$_POST['EXRAII']));

Workcell('Value','K7', 'Cumulative Engagement Break');
Workcell('Value','K9', '=ROUND(+K24*B5,0)');
Workcell('Value','K11', 'Weekly Engagement');

Workcell('Value','A13', 'House Capacity');
Workcell('Value','A14', 'Performance Capacity'); 
Workcell('Value','A15', 'Tickets Sold'); 
Workcell('Value','A16', 'No. of Weeks'); 
Workcell('Value','A17', 'Box Office Gross'); 
Workcell('Value','A18', 'Sub Load - in');  
Workcell('Value','A19', 'Estimated Groups'); 
Workcell('Value','A20', 'Estimated Singles'); 
Workcell('Value','A21', 'Less Subs Discounts'); 
Workcell('Value','A22', 'Less Group Discounts'); 
Workcell('Value','A23', 'Less Singles Discounts'); 
Workcell('Value','A24', 'Adjusted Gross'); 
Workcell('Value','A25', 'Adjusted Gross Potential %'); 
Workcell('Value','A26', 'Sales Tax 1'); 
Workcell('Value','A27', 'Sales Tax 2'); 
Workcell('Value','A28', 'Facility Fee 1'); 
Workcell('Value','A29', 'Facility Fee 2'); 
Workcell('Value','A30', 'Subscription Commission'); 
Workcell('Value','A31', 'Group Sales Commission'); 
Workcell('Value','A32', 'Credit Card & Other Commissions'); 
Workcell('Value','A33', 'Net Adjusted B. O. Recepts'); 
Workcell('Value','A35', 'WEEKLY EXPENSES'); 
Workcell('Value','A36', 'Guarantee'); 
Workcell('Value','A37', 'Variable Guarantee'); 
Workcell('Value','A38', 'ADVERTISING (at gross)'); 
Workcell('Value','A39', 'STAGEHANDS (Load-in)'); 
Workcell('Value','A40', 'STAGEHANDS (Load-out)'); 
Workcell('Value','A41', 'STAGEHANDS (Running)'); 
Workcell('Value','A42', 'WARDROBE and HAIR (Load-in)'); 
Workcell('Value','A43', 'WARDROBE and HAIR (Load-out)'); 
Workcell('Value','A44', 'WARDROBE and HAIR (Running)'); 
Workcell('Value','A45', 'LABOR CATERING'); 
Workcell('Value','A46', 'MUSICIANS'); 
Workcell('Value','A47', 'INSURANCE (ON DROP COUNT)'); 
Workcell('Value','A48', 'TICKET PRINTING'); 
Workcell('Value','A49', 'OTHER'); 
Workcell('Value','A50', 'ADA EXPENSE'); 
Workcell('Value','A51', 'BOX OFFICE'); 
Workcell('Value','A52', 'DRY ICE/CO2'); 
Workcell('Value','A53', 'FIRE MARSHALL/PYRO'); 
Workcell('Value','A54', 'HOSPITALITY/WATER'); 
Workcell('Value','A55', 'HOUSE STAFF'); 
Workcell('Value','A56', 'LICENSES/PERMITS'); 
Workcell('Value','A57', 'LIMOS/AUTO (STARS/PR)'); 
Workcell('Value','A58', 'PIANO TUNINGS'); 
Workcell('Value','A59', 'POLICE/SECURITY'); 
Workcell('Value','A60', 'PRESENTER PROFIT'); 
Workcell('Value','A61', 'PRESS AGENT FEE'); 
Workcell('Value','A62', 'PROGRAMS'); 
Workcell('Value','A63', 'RENT'); 
Workcell('Value','A64', 'SOUND/LIGHTS'); 
Workcell('Value','A65', 'TELEPHONES/INTERNET'); 
Workcell('Value','A66', '3RD PARTY EQUIPMENT RENTAL'); 
Workcell('Value','A67', 'TRUCK PARKING/WRECKERS'); 
Workcell('Value','A68', 'OTHER'); 
Workcell('Value','A69', 'OTHER'); 
Workcell('Value','A70', 'OTHER'); 
Workcell('Value','A71', 'OTHER'); 
Workcell('Value','A72', 'LOCAL FIXED'); 
Workcell('Value','A73', 'TOTAL LOCAL EXPENSE'); 
Workcell('Value','A75', 'FORMULA CHECK');  
Workcell('Value','A77', 'Money Remaining'); 
Workcell('Value','A79', 'Next Monies - To Producer (Base)'); 
Workcell('Value','A80', 'Next Monies - To Producer');  
Workcell('Value','A81', 'Next Monies - To Presenter (Base)'); 
Workcell('Value','A82', 'Next Monies - To Presenter');  
Workcell('Value','A84', 'Total Engagement Profit');  
Workcell('Value','A86', 'Producer Share of Overages');  
Workcell('Value','A87', 'Presenter Share of Overages');  
Workcell('Value','A88', 'Next Monies');  
Workcell('Value','A89', 'Variable Guarantee');  
Workcell('Value','A90', 'Guarantee');  
Workcell('Value','A91', 'TOTAL TO PRODUCER');  
Workcell('Value','A92', 'U. S. Rate'); 
Workcell('Value','A94', 'Less Income Taxes Witheld (1)'); 
Workcell('Value','A95', 'Less Income Taxes Witheld (2)'); 
Workcell('Value','A96', 'Net Income to Producer'); 
Workcell('Value','A98', 'Weekly Operating Expenses (include Amort)'); 
Workcell('Value','A99', 'Royalty Minimum $'); 
Workcell('Value','A100', 'Variable Royalty %'); 
Workcell('Value','A101', 'Total Show Profit');

Workcell('Value','C12', 'Weekly');
Workcell('Value','D12', 'Weekly');
Workcell('Value','E12', 'Weekly');
Workcell('Value','F12', 'Weekly');
Workcell('Value','G12', 'RUN');
Workcell('Value','H12', 'RUN');
Workcell('Value','I12', 'RUN');
Workcell('Value','J12', 'RUN');
Workcell('Value','K12', 'BREAKEVEN');

Workcell('Value','C14', str_replace('%','',str_replace(',','',$_POST['PECAW1']))/100);
Workcell('Value','D14', str_replace('%','',str_replace(',','',$_POST['PECAW2']))/100);
Workcell('Value','E14', str_replace('%','',str_replace(',','',$_POST['PECAW3']))/100);
Workcell('Value','F14', str_replace('%','',str_replace(',','',$_POST['PECAW4']))/100);
Workcell('Value','G14', '=+C14');
Workcell('Value','H14', '=+D14');
Workcell('Value','I14', '=+E14');
Workcell('Value','J14', '=+F14');
Workcell('Value','K14', str_replace('%','',str_replace(',','',$_POST['PECATT']))/100);

Workcell('Value','C13', '=$B$6*$B$4');
Workcell('Value','D13', '=$B$6*$B$4');
Workcell('Value','E13', '=$B$6*$B$4');
Workcell('Value','F13', '=$B$6*$B$4');
Workcell('Value','G13', '=$B$6*$B$4*$B$5');
Workcell('Value','H13', '=$B$6*$B$4*$B$5');
Workcell('Value','I13', '=$B$6*$B$4*$B$5');
Workcell('Value','J13', '=$B$6*$B$4*$B$5');
Workcell('Value','K13', '=$B$6*$B$4');

Workcell('Value','C15', '=+C14*C13');
Workcell('Value','D15', '=+D14*D13');
Workcell('Value','E15', '=+E14*E13');
Workcell('Value','F15', '=+F14*F13');
Workcell('Value','G15', '=+G14*G13*$B$5');
Workcell('Value','H15', '=+H14*H13*$B$5');
Workcell('Value','I15', '=+I14*I13*$B$5');
Workcell('Value','J15', '=+J14*J13*$B$5');
Workcell('Value','K15', '=+K14*K13');

Workcell('Value','C16', '1');
Workcell('Value','D16', '1');
Workcell('Value','E16', '1');
Workcell('Value','F16', '1');
Workcell('Value','G16', '=$B$5');
Workcell('Value','H16', '=$B$5');
Workcell('Value','I16', '=$B$5');
Workcell('Value','J16', '=$B$5');
Workcell('Value','K16', '1');

$objPHPExcel->getActiveSheet()->setTitle('BOOKING ANALYSIS');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setPreCalculateFormulas(true);

ob_end_clean();

header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Breakeven.xlsx"');
$objWriter->save('php://output');

?>