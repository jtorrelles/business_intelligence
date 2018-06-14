<?php

require_once '../libs/PHPExcel.php';
        
$objPHPExcel   = new PHPExcel();
$objPHPExcel->getProperties()->setTitle("Breakeven");
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);

$style = array('font' => array('name'  => 'Arial','size' => 8));

foreach( range('A','K') as $letra ){ 
	$objPHPExcel->getActiveSheet()->getStyle($letra)->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->getStyle($letra)->getNumberFormat()->setFormatCode('#,##0');
}

$objPHPExcel->getActiveSheet()->getStyle('A1:K101')->applyFromArray(array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_NONE))));

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
Workcell('Percent','C25:K25','');
Workcell('Percent','B21:B23','');
Workcell('Percent','B26:B27','');
Workcell('Percent','B30:B32','');
Workcell('Percent','B37','');
Workcell('Percent','B80','');
Workcell('Percent','B82','');
Workcell('Percent','B86:B87','');
Workcell('Percent','B94','');
Workcell('Percent','B100','');

Workcell('Center','C12:K12','');
Workcell('Center','K7','');
Workcell('Center','K11','');

Workcell('Format','B8','$ #,##0.00');
Workcell('Format','B28:B29','$ #,##0.00');
Workcell('Format','B36:B72','#,##0.00');
Workcell('Format','B79','$ #,##0.00');
Workcell('Format','B81','$ #,##0.00');
Workcell('Format','C92:K92','$ #,##0');
Workcell('Format','B2','dd/mm/yyyy');

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
Workcell('Color','C25:J25','FCE4EC');

Workcell('Border','A1:J1','');
Workcell('Border','A2:J2','');
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

Workcell('Width','A',25);
Workcell('Width','B',8);
Workcell('Width','C',8);
Workcell('Width','D',8);
Workcell('Width','E',8);
Workcell('Width','F',8);
Workcell('Width','G',8);
Workcell('Width','H',8);
Workcell('Width','I',8);
Workcell('Width','J',8);
Workcell('Width','K',12);

Workcell('Merge','B1:C1','');
Workcell('Merge','E1:F1','');
Workcell('Merge','H1:J1','');
Workcell('Merge','B2:C2','');
Workcell('Merge','E2:F2','');
Workcell('Merge','H2:J2','');
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
Workcell('Value','B1', $_POST['SHNAMEID']);
Workcell('Value','D1', 'CITY:');
Workcell('Value','E1', $_POST['CINAMEID']);
Workcell('Value','G1', 'STATE:');
Workcell('Value','H1', $_POST['STNAMEID']);
Workcell('Value','A2', 'INIT DATE:');
Workcell('Value','B2', $_POST['IDATEID']);
Workcell('Value','D2', 'END DATE:');
Workcell('Value','E2', $_POST['EDATEID']);
Workcell('Value','G2', 'VENUE:');
Workcell('Value','H2', $_POST['VENUEID']);

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

Workcell('Value','C17', '=+$B$7*C14');
Workcell('Value','D17', '=+$B$7*D14');
Workcell('Value','E17', '=+$B$7*E14');
Workcell('Value','F17', '=+$B$7*F14');
Workcell('Value','G17', '=+$B$7*G14*$B$5');
Workcell('Value','H17', '=+$B$7*H14*$B$5');
Workcell('Value','I17', '=+$B$7*I14*$B$5');
Workcell('Value','J17', '=+$B$7*J14*$B$5');
Workcell('Value','K17', '=+$B$7*K14');

Workcell('Value','B18', str_replace(',','',$_POST['SLINII']));
Workcell('Value','C18', '=$B$18/$B$5');
Workcell('Value','D18', '=$B$18/$B$5');
Workcell('Value','E18', '=$B$18/$B$5');
Workcell('Value','F18', '=$B$18/$B$5');
Workcell('Value','G18', '=$C$18*G16');
Workcell('Value','H18', '=$C$18*H16');
Workcell('Value','I18', '=$C$18*I16');
Workcell('Value','J18', '=$C$18*J16');
Workcell('Value','K18', '=$B$18/$B$5');

Workcell('Value','B19', str_replace(',','',$_POST['ESGRII']));
Workcell('Value','C19', '=+$B$19/$B$5');
Workcell('Value','D19', '=+$B$19/$B$5');
Workcell('Value','E19', '=+$B$19/$B$5');
Workcell('Value','F19', '=+$B$19/$B$5');
Workcell('Value','G19', '=+$B$19');
Workcell('Value','H19', '=+$B$19');
Workcell('Value','I19', '=+$B$19');
Workcell('Value','J19', '=+$B$19');
Workcell('Value','K19', '=+$B$19/$B$5');

Workcell('Value','C20', '=IF((C17-C18-C19)>0,(C17-C18-C19),0)');
Workcell('Value','D20', '=IF((D17-D18-D19)>0,(D17-D18-D19),0)');
Workcell('Value','E20', '=IF((E17-E18-E19)>0,(E17-E18-E19),0)');
Workcell('Value','F20', '=IF((F17-F18-F19)>0,(F17-F18-F19),0)');
Workcell('Value','G20', '=IF((G17-G18-G19)>0,(G17-G18-G19),0)');
Workcell('Value','H20', '=IF((H17-H18-H19)>0,(H17-H18-H19),0)');
Workcell('Value','I20', '=IF((I17-I18-I19)>0,(I17-I18-I19),0)');
Workcell('Value','J20', '=IF((J17-J18-J19)>0,(J17-J18-J19),0)');
Workcell('Value','K20', '=IF((K17-K18-K19)>0,(K17-K18-K19),0)');

Workcell('Value','B21', str_replace('%','',str_replace(',','',$_POST['LSUDII']))/100);
Workcell('Value','C21', '=-(C18/(1-$B$21))+C18');
Workcell('Value','D21', '=-(D18/(1-$B$21))+D18');
Workcell('Value','E21', '=-(E18/(1-$B$21))+E18');
Workcell('Value','F21', '=-(F18/(1-$B$21))+F18');
Workcell('Value','G21', '=-(G18/(1-$B$21))+G18');
Workcell('Value','H21', '=-(H18/(1-$B$21))+H18');
Workcell('Value','I21', '=-(I18/(1-$B$21))+I18');
Workcell('Value','J21', '=-(J18/(1-$B$21))+J18');
Workcell('Value','K21', '=-(K18/(1-$B$21))+K18');

Workcell('Value','B22', str_replace('%','',str_replace(',','',$_POST['LGRDII']))/100);
Workcell('Value','C22', '=-(C19/(1-$B$22))+C19');
Workcell('Value','D22', '=-(D19/(1-$B$22))+D19');
Workcell('Value','E22', '=-(E19/(1-$B$22))+E19');
Workcell('Value','F22', '=-(F19/(1-$B$22))+F19');
Workcell('Value','G22', '=-(G19/(1-$B$22))+G19');
Workcell('Value','H22', '=-(H19/(1-$B$22))+H19');
Workcell('Value','I22', '=-(I19/(1-$B$22))+I19');
Workcell('Value','J22', '=-(J19/(1-$B$22))+J19');
Workcell('Value','K22', '=-(K19/(1-$B$22))+K19');

Workcell('Value','B23', str_replace('%','',str_replace(',','',$_POST['LSIDII']))/100);
Workcell('Value','C23', '=-IF((C17-C19-C18)>0,(C17-C19-C18)*$B$23,0)');
Workcell('Value','D23', '=-IF((D17-D19-D18)>0,(D17-D19-D18)*$B$23,0)');
Workcell('Value','E23', '=-IF((E17-E19-E18)>0,(E17-E19-E18)*$B$23,0)');
Workcell('Value','F23', '=-IF((F17-F19-F18)>0,(F17-F19-F18)*$B$23,0)');
Workcell('Value','G23', '=-IF((G17-G19-G18)>0,(G17-G19-G18)*$B$23,0)');
Workcell('Value','H23', '=-IF((H17-H19-H18)>0,(H17-H19-H18)*$B$23,0)');
Workcell('Value','I23', '=-IF((I17-I19-I18)>0,(I17-I19-I18)*$B$23,0)');
Workcell('Value','J23', '=-IF((J17-J19-J18)>0,(J17-J19-J18)*$B$23,0)');
Workcell('Value','K23', '=-IF((K17-K19-K18)>0,(K17-K19-K18)*$B$23,0)');

Workcell('Value','C24', '=SUM(C18:C23)');
Workcell('Value','D24', '=SUM(D18:D23)');
Workcell('Value','E24', '=SUM(E18:E23)');
Workcell('Value','F24', '=SUM(F18:F23)');
Workcell('Value','G24', '=SUM(G18:G23)');
Workcell('Value','H24', '=SUM(H18:H23)');
Workcell('Value','I24', '=SUM(I18:I23)');
Workcell('Value','J24', '=SUM(J18:J23)');
Workcell('Value','K24', '=SUM(K18:K23)');

Workcell('Value','C25', '=+C24/$B$7');
Workcell('Value','D25', '=+D24/$B$7');
Workcell('Value','E25', '=+E24/$B$7');
Workcell('Value','F25', '=+F24/$B$7');
Workcell('Value','G25', '=+G24/($B$7*$B$5)');
Workcell('Value','H25', '=+H24/($B$7*$B$5)');
Workcell('Value','I25', '=+I24/($B$7*$B$5)');
Workcell('Value','J25', '=+J24/($B$7*$B$5)');
Workcell('Value','K25', '=+K24/$B$7');

Workcell('Value','B26', str_replace('%','',str_replace(',','',$_POST['TAX1II']))/100);
Workcell('Value','C26', '=-C24/(1+$B$26)*$B$26');
Workcell('Value','D26', '=-D24/(1+$B$26)*$B$26');
Workcell('Value','E26', '=-E24/(1+$B$26)*$B$26');
Workcell('Value','F26', '=-F24/(1+$B$26)*$B$26');
Workcell('Value','G26', '=-G24/(1+$B$26)*$B$26');
Workcell('Value','H26', '=-H24/(1+$B$26)*$B$26');
Workcell('Value','I26', '=-I24/(1+$B$26)*$B$26');
Workcell('Value','J26', '=-J24/(1+$B$26)*$B$26');
Workcell('Value','K26', '=-K24/(1+$B$26)*$B$26');

Workcell('Value','B27', str_replace('%','',str_replace(',','',$_POST['TAX2II']))/100);
Workcell('Value','C27', '=-C24/(1+$B$27)*$B$27');
Workcell('Value','D27', '=-D24/(1+$B$27)*$B$27');
Workcell('Value','E27', '=-E24/(1+$B$27)*$B$27');
Workcell('Value','F27', '=-F24/(1+$B$27)*$B$27');
Workcell('Value','G27', '=-G24/(1+$B$27)*$B$27');
Workcell('Value','H27', '=-H24/(1+$B$27)*$B$27');
Workcell('Value','I27', '=-I24/(1+$B$27)*$B$27');
Workcell('Value','J27', '=-J24/(1+$B$27)*$B$27');
Workcell('Value','K27', '=-K24/(1+$B$27)*$B$27');

Workcell('Value','B28', str_replace('$ ','',str_replace(',','',$_POST['FAF1II'])));
Workcell('Value','C28', '=-C$15*$B28');
Workcell('Value','D28', '=-D$15*$B28');
Workcell('Value','E28', '=-E$15*$B28');
Workcell('Value','F28', '=-F$15*$B28');
Workcell('Value','G28', '=+C28*$B$5');
Workcell('Value','H28', '=+D28*$B$5');
Workcell('Value','I28', '=+E28*$B$5');
Workcell('Value','J28', '=+F28*$B$5');
Workcell('Value','K28', '=-K$15*$B28');

Workcell('Value','B29', str_replace('$ ','',str_replace(',','',$_POST['FAF2II'])));
Workcell('Value','C29', '=-C$15*$B29');
Workcell('Value','D29', '=-D$15*$B29');
Workcell('Value','E29', '=-E$15*$B29');
Workcell('Value','F29', '=-F$15*$B29');
Workcell('Value','G29', '=+C29*$B$5');
Workcell('Value','H29', '=+D29*$B$5');
Workcell('Value','I29', '=+E29*$B$5');
Workcell('Value','J29', '=+F29*$B$5');
Workcell('Value','K29', '=-K$15*$B29');

Workcell('Value','B30', str_replace('%','',str_replace(',','',$_POST['SUBCII']))/100);
Workcell('Value','C30', '=-C$18*$B30');
Workcell('Value','D30', '=-D$18*$B30');
Workcell('Value','E30', '=-E$18*$B30');
Workcell('Value','F30', '=-F$18*$B30');
Workcell('Value','G30', '=-G$18*$B30');
Workcell('Value','H30', '=-H$18*$B30');
Workcell('Value','I30', '=-I$18*$B30');
Workcell('Value','J30', '=-J$18*$B30');
Workcell('Value','K30', '=-K$18*$B30');

Workcell('Value','B31', str_replace('%','',str_replace(',','',$_POST['GSACII']))/100);
Workcell('Value','C31', '=-C$19*$B31');
Workcell('Value','D31', '=-D$19*$B31');
Workcell('Value','E31', '=-E$19*$B31');
Workcell('Value','F31', '=-F$19*$B31');
Workcell('Value','G31', '=-G$19*$B31');
Workcell('Value','H31', '=-H$19*$B31');
Workcell('Value','I31', '=-I$19*$B31');
Workcell('Value','J31', '=-J$19*$B31');
Workcell('Value','K31', '=-K$19*$B31');

Workcell('Value','B32', str_replace('%','',str_replace(',','',$_POST['CCOCII']))/100);
Workcell('Value','C32', '=-IF((C24-C19-C18)>0,(C24-C19-C18)*$B$32,0)');
Workcell('Value','D32', '=-IF((D24-D19-D18)>0,(D24-D19-D18)*$B$32,0)');
Workcell('Value','E32', '=-IF((E24-E19-E18)>0,(E24-E19-E18)*$B$32,0)');
Workcell('Value','F32', '=-IF((F24-F19-F18)>0,(F24-F19-F18)*$B$32,0)');
Workcell('Value','G32', '=-IF((G24-G19-G18)>0,(G24-G19-G18)*$B$32,0)');
Workcell('Value','H32', '=-IF((H24-H19-H18)>0,(H24-H19-H18)*$B$32,0)');
Workcell('Value','I32', '=-IF((I24-I19-I18)>0,(I24-I19-I18)*$B$32,0)');
Workcell('Value','J32', '=-IF((J24-J19-J18)>0,(J24-J19-J18)*$B$32,0)');
Workcell('Value','K32', '=-IF((K24-K19-K18)>0,(K24-K19-K18)*$B$32,0)');

Workcell('Value','C33', '=SUM(C24:C32)');
Workcell('Value','D33', '=SUM(D24:D32)');
Workcell('Value','E33', '=SUM(E24:E32)');
Workcell('Value','F33', '=SUM(F24:F32)');
Workcell('Value','G33', '=SUM(G24:G32)');
Workcell('Value','H33', '=SUM(H24:H32)');
Workcell('Value','I33', '=SUM(I24:I32)');
Workcell('Value','J33', '=SUM(J24:J32)');
Workcell('Value','K33', '=SUM(K24:K32)');

Workcell('Value','B35', '@ US $');
Workcell('Value','C35', ' @ Can $');

Workcell('Value','B36', str_replace(',','',$_POST['GUA1II']));
Workcell('Value','C36', '=+$B36*$B$9');
Workcell('Value','D36', '=+$B36*$B$9');
Workcell('Value','E36', '=+$B36*$B$9');
Workcell('Value','F36', '=+$B36*$B$9');
Workcell('Value','G36', '=+C36*$B$5');
Workcell('Value','H36', '=+D36*$B$5');
Workcell('Value','I36', '=+E36*$B$5');
Workcell('Value','J36', '=+F36*$B$5');
Workcell('Value','K36', '=+$B36*$B$9');

Workcell('Value','B37', str_replace('%','',str_replace(',','',$_POST['VGUAII']))/100);
Workcell('Value','C37', '=+C33*$B$37');
Workcell('Value','D37', '=+D33*$B$37');
Workcell('Value','E37', '=+E33*$B$37');
Workcell('Value','F37', '=+F33*$B$37');
Workcell('Value','G37', '=+G33*$B$37');
Workcell('Value','H37', '=+H33*$B$37');
Workcell('Value','I37', '=+I33*$B$37');
Workcell('Value','J37', '=+J33*$B$37');
Workcell('Value','K37', '=+K33*$B$37');

Workcell('Value','B38', str_replace(',','',$_POST['ADVEII']));
Workcell('Value','C38', '=$B$38');
Workcell('Value','D38', '=$B$38');
Workcell('Value','E38', '=$B$38');
Workcell('Value','F38', '=$B$38');
Workcell('Value','G38', '=$B$38*$B$5');
Workcell('Value','H38', '=$B$38*$B$5');
Workcell('Value','I38', '=$B$38*$B$5');
Workcell('Value','J38', '=$B$38*$B$5');
Workcell('Value','K38', '=$B$38');

Workcell('Value','B39', str_replace(',','',$_POST['STINII']));
Workcell('Value','C39', '=$B$39');
Workcell('Value','D39', '=$B$39');
Workcell('Value','E39', '=$B$39');
Workcell('Value','F39', '=$B$39');
Workcell('Value','G39', '=$B$39*$B$5');
Workcell('Value','H39', '=$B$39*$B$5');
Workcell('Value','I39', '=$B$39*$B$5');
Workcell('Value','J39', '=$B$39*$B$5');
Workcell('Value','K39', '=$B$39');

Workcell('Value','B40', str_replace(',','',$_POST['STOTII']));
Workcell('Value','C40', '=$B$40');
Workcell('Value','D40', '=$B$40');
Workcell('Value','E40', '=$B$40');
Workcell('Value','F40', '=$B$40');
Workcell('Value','G40', '=$B$40*$B$5');
Workcell('Value','H40', '=$B$40*$B$5');
Workcell('Value','I40', '=$B$40*$B$5');
Workcell('Value','J40', '=$B$40*$B$5');
Workcell('Value','K40', '=$B$40');

Workcell('Value','B41', str_replace(',','',$_POST['STRUII']));
Workcell('Value','C41', '=$B$41');
Workcell('Value','D41', '=$B$41');
Workcell('Value','E41', '=$B$41');
Workcell('Value','F41', '=$B$41');
Workcell('Value','G41', '=$B$41*$B$5');
Workcell('Value','H41', '=$B$41*$B$5');
Workcell('Value','I41', '=$B$41*$B$5');
Workcell('Value','J41', '=$B$41*$B$5');
Workcell('Value','K41', '=$B$41');

Workcell('Value','B42', str_replace(',','',$_POST['WHINII']));
Workcell('Value','C42', '=$B$42');
Workcell('Value','D42', '=$B$42');
Workcell('Value','E42', '=$B$42');
Workcell('Value','F42', '=$B$42');
Workcell('Value','G42', '=$B$42*$B$5');
Workcell('Value','H42', '=$B$42*$B$5');
Workcell('Value','I42', '=$B$42*$B$5');
Workcell('Value','J42', '=$B$42*$B$5');
Workcell('Value','K42', '=$B$42');

Workcell('Value','B43', str_replace(',','',$_POST['WHOTII']));
Workcell('Value','C43', '=$B$43');
Workcell('Value','D43', '=$B$43');
Workcell('Value','E43', '=$B$43');
Workcell('Value','F43', '=$B$43');
Workcell('Value','G43', '=$B$43*$B$5');
Workcell('Value','H43', '=$B$43*$B$5');
Workcell('Value','I43', '=$B$43*$B$5');
Workcell('Value','J43', '=$B$43*$B$5');
Workcell('Value','K43', '=$B$43');

Workcell('Value','B44', str_replace(',','',$_POST['WHRUII']));
Workcell('Value','C44', '=$B$44');
Workcell('Value','D44', '=$B$44');
Workcell('Value','E44', '=$B$44');
Workcell('Value','F44', '=$B$44');
Workcell('Value','G44', '=$B$44*$B$5');
Workcell('Value','H44', '=$B$44*$B$5');
Workcell('Value','I44', '=$B$44*$B$5');
Workcell('Value','J44', '=$B$44*$B$5');
Workcell('Value','K44', '=$B$44');

Workcell('Value','B45', str_replace(',','',$_POST['LACAII']));
Workcell('Value','C45', '=$B$45');
Workcell('Value','D45', '=$B$45');
Workcell('Value','E45', '=$B$45');
Workcell('Value','F45', '=$B$45');
Workcell('Value','G45', '=$B$45*$B$5');
Workcell('Value','H45', '=$B$45*$B$5');
Workcell('Value','I45', '=$B$45*$B$5');
Workcell('Value','J45', '=$B$45*$B$5');
Workcell('Value','K45', '=$B$45');

Workcell('Value','B46', str_replace(',','',$_POST['MUSIII']));
Workcell('Value','C46', '=$B$46');
Workcell('Value','D46', '=$B$46');
Workcell('Value','E46', '=$B$46');
Workcell('Value','F46', '=$B$46');
Workcell('Value','G46', '=$B$46*$B$5');
Workcell('Value','H46', '=$B$46*$B$5');
Workcell('Value','I46', '=$B$46*$B$5');
Workcell('Value','J46', '=$B$46*$B$5');
Workcell('Value','K46', '=$B$46');

Workcell('Value','B47', str_replace(',','',$_POST['INSUII']));
Workcell('Value','C47', '=C15*$B$47');
Workcell('Value','D47', '=D15*$B$47');
Workcell('Value','E47', '=E15*$B$47');
Workcell('Value','F47', '=F15*$B$47');
Workcell('Value','G47', '=G15*$B$47');
Workcell('Value','H47', '=H15*$B$47');
Workcell('Value','I47', '=I15*$B$47');
Workcell('Value','J47', '=J15*$B$47');
Workcell('Value','K47', '=K15*$B$47');

Workcell('Value','B48', str_replace(',','',$_POST['TIPRII']));
Workcell('Value','C48', '=C15*$B$48');
Workcell('Value','D48', '=D15*$B$48');
Workcell('Value','E48', '=E15*$B$48');
Workcell('Value','F48', '=F15*$B$48');
Workcell('Value','G48', '=G15*$B$48');
Workcell('Value','H48', '=H15*$B$48');
Workcell('Value','I48', '=I15*$B$48');
Workcell('Value','J48', '=J15*$B$48');
Workcell('Value','K48', '=K15*$B$48');

Workcell('Value','B49', str_replace(',','',$_POST['OTH1II']));
Workcell('Value','C49', '=$B$49');
Workcell('Value','D49', '=$B$49');
Workcell('Value','E49', '=$B$49');
Workcell('Value','F49', '=$B$49');
Workcell('Value','G49', '=$B$49*$B$5');
Workcell('Value','H49', '=$B$49*$B$5');
Workcell('Value','I49', '=$B$49*$B$5');
Workcell('Value','J49', '=$B$49*$B$5');
Workcell('Value','K49', '=$B$49');

Workcell('Value','B50', str_replace(',','',$_POST['ADEXII']));
Workcell('Value','C50', '=$B$50');
Workcell('Value','D50', '=$B$50');
Workcell('Value','E50', '=$B$50');
Workcell('Value','F50', '=$B$50');
Workcell('Value','G50', '=$B$50*$B$5');
Workcell('Value','H50', '=$B$50*$B$5');
Workcell('Value','I50', '=$B$50*$B$5');
Workcell('Value','J50', '=$B$50*$B$5');
Workcell('Value','K50', '=$B$50');

Workcell('Value','B51', str_replace(',','',$_POST['BOOFII']));
Workcell('Value','C51', '=$B$51');
Workcell('Value','D51', '=$B$51');
Workcell('Value','E51', '=$B$51');
Workcell('Value','F51', '=$B$51');
Workcell('Value','G51', '=$B$51*$B$5');
Workcell('Value','H51', '=$B$51*$B$5');
Workcell('Value','I51', '=$B$51*$B$5');
Workcell('Value','J51', '=$B$51*$B$5');
Workcell('Value','K51', '=$B$51');

Workcell('Value','B52', str_replace(',','',$_POST['DRICII']));
Workcell('Value','C52', '=$B$52');
Workcell('Value','D52', '=$B$52');
Workcell('Value','E52', '=$B$52');
Workcell('Value','F52', '=$B$52');
Workcell('Value','G52', '=$B$52*$B$5');
Workcell('Value','H52', '=$B$52*$B$5');
Workcell('Value','I52', '=$B$52*$B$5');
Workcell('Value','J52', '=$B$52*$B$5');
Workcell('Value','K52', '=$B$52');

Workcell('Value','B53', str_replace(',','',$_POST['FIMAII']));
Workcell('Value','C53', '=$B$53');
Workcell('Value','D53', '=$B$53');
Workcell('Value','E53', '=$B$53');
Workcell('Value','F53', '=$B$53');
Workcell('Value','G53', '=$B$53*$B$5');
Workcell('Value','H53', '=$B$53*$B$5');
Workcell('Value','I53', '=$B$53*$B$5');
Workcell('Value','J53', '=$B$53*$B$5');
Workcell('Value','K53', '=$B$53');

Workcell('Value','B54', str_replace(',','',$_POST['HOWAII']));
Workcell('Value','C54', '=$B$54');
Workcell('Value','D54', '=$B$54');
Workcell('Value','E54', '=$B$54');
Workcell('Value','F54', '=$B$54');
Workcell('Value','G54', '=$B$54*$B$5');
Workcell('Value','H54', '=$B$54*$B$5');
Workcell('Value','I54', '=$B$54*$B$5');
Workcell('Value','J54', '=$B$54*$B$5');
Workcell('Value','K54', '=$B$54');

Workcell('Value','B55', str_replace(',','',$_POST['HOSTII']));
Workcell('Value','C55', '=$B$55');
Workcell('Value','D55', '=$B$55');
Workcell('Value','E55', '=$B$55');
Workcell('Value','F55', '=$B$55');
Workcell('Value','G55', '=$B$55*$B$5');
Workcell('Value','H55', '=$B$55*$B$5');
Workcell('Value','I55', '=$B$55*$B$5');
Workcell('Value','J55', '=$B$55*$B$5');
Workcell('Value','K55', '=$B$55');

Workcell('Value','B56', str_replace(',','',$_POST['LIPEII']));
Workcell('Value','C56', '=$B$56');
Workcell('Value','D56', '=$B$56');
Workcell('Value','E56', '=$B$56');
Workcell('Value','F56', '=$B$56');
Workcell('Value','G56', '=$B$56*$B$5');
Workcell('Value','H56', '=$B$56*$B$5');
Workcell('Value','I56', '=$B$56*$B$5');
Workcell('Value','J56', '=$B$56*$B$5');
Workcell('Value','K56', '=$B$56');

Workcell('Value','B57', str_replace(',','',$_POST['LIAUII']));
Workcell('Value','C57', '=$B$57');
Workcell('Value','D57', '=$B$57');
Workcell('Value','E57', '=$B$57');
Workcell('Value','F57', '=$B$57');
Workcell('Value','G57', '=$B$57*$B$5');
Workcell('Value','H57', '=$B$57*$B$5');
Workcell('Value','I57', '=$B$57*$B$5');
Workcell('Value','J57', '=$B$57*$B$5');
Workcell('Value','K57', '=$B$57');

Workcell('Value','B58', str_replace(',','',$_POST['PITUII']));
Workcell('Value','C58', '=$B$58');
Workcell('Value','D58', '=$B$58');
Workcell('Value','E58', '=$B$58');
Workcell('Value','F58', '=$B$58');
Workcell('Value','G58', '=$B$58*$B$5');
Workcell('Value','H58', '=$B$58*$B$5');
Workcell('Value','I58', '=$B$58*$B$5');
Workcell('Value','J58', '=$B$58*$B$5');
Workcell('Value','K58', '=$B$58');

Workcell('Value','B59', str_replace(',','',$_POST['POSEII']));
Workcell('Value','C59', '=$B$59');
Workcell('Value','D59', '=$B$59');
Workcell('Value','E59', '=$B$59');
Workcell('Value','F59', '=$B$59');
Workcell('Value','G59', '=$B$59*$B$5');
Workcell('Value','H59', '=$B$59*$B$5');
Workcell('Value','I59', '=$B$59*$B$5');
Workcell('Value','J59', '=$B$59*$B$5');
Workcell('Value','K59', '=$B$59');

Workcell('Value','B60', str_replace(',','',$_POST['PRPRII']));
Workcell('Value','C60', '=$B$60');
Workcell('Value','D60', '=$B$60');
Workcell('Value','E60', '=$B$60');
Workcell('Value','F60', '=$B$60');
Workcell('Value','G60', '=$B$60*$B$5');
Workcell('Value','H60', '=$B$60*$B$5');
Workcell('Value','I60', '=$B$60*$B$5');
Workcell('Value','J60', '=$B$60*$B$5');
Workcell('Value','K60', '=$B$60');

Workcell('Value','B61', str_replace(',','',$_POST['PRAFII']));
Workcell('Value','C61', '=$B$61');
Workcell('Value','D61', '=$B$61');
Workcell('Value','E61', '=$B$61');
Workcell('Value','F61', '=$B$61');
Workcell('Value','G61', '=$B$61*$B$5');
Workcell('Value','H61', '=$B$61*$B$5');
Workcell('Value','I61', '=$B$61*$B$5');
Workcell('Value','J61', '=$B$61*$B$5');
Workcell('Value','K61', '=$B$61');

Workcell('Value','B62', str_replace(',','',$_POST['PROGII']));
Workcell('Value','C62', '=$B$62');
Workcell('Value','D62', '=$B$62');
Workcell('Value','E62', '=$B$62');
Workcell('Value','F62', '=$B$62');
Workcell('Value','G62', '=$B$62*$B$5');
Workcell('Value','H62', '=$B$62*$B$5');
Workcell('Value','I62', '=$B$62*$B$5');
Workcell('Value','J62', '=$B$62*$B$5');
Workcell('Value','K62', '=$B$62');

Workcell('Value','B63', str_replace(',','',$_POST['RENTII']));
Workcell('Value','C63', '=$B$63');
Workcell('Value','D63', '=$B$63');
Workcell('Value','E63', '=$B$63');
Workcell('Value','F63', '=$B$63');
Workcell('Value','G63', '=$B$63*$B$5');
Workcell('Value','H63', '=$B$63*$B$5');
Workcell('Value','I63', '=$B$63*$B$5');
Workcell('Value','J63', '=$B$63*$B$5');
Workcell('Value','K63', '=$B$63');

Workcell('Value','B64', str_replace(',','',$_POST['SOLIII']));
Workcell('Value','C64', '=$B$64');
Workcell('Value','D64', '=$B$64');
Workcell('Value','E64', '=$B$64');
Workcell('Value','F64', '=$B$64');
Workcell('Value','G64', '=$B$64*$B$5');
Workcell('Value','H64', '=$B$64*$B$5');
Workcell('Value','I64', '=$B$64*$B$5');
Workcell('Value','J64', '=$B$64*$B$5');
Workcell('Value','K64', '=$B$64');

Workcell('Value','B65', str_replace(',','',$_POST['TEINII']));
Workcell('Value','C65', '=$B$65');
Workcell('Value','D65', '=$B$65');
Workcell('Value','E65', '=$B$65');
Workcell('Value','F65', '=$B$65');
Workcell('Value','G65', '=$B$65*$B$5');
Workcell('Value','H65', '=$B$65*$B$5');
Workcell('Value','I65', '=$B$65*$B$5');
Workcell('Value','J65', '=$B$65*$B$5');
Workcell('Value','K65', '=$B$65');

Workcell('Value','B66', str_replace(',','',$_POST['PAERII']));
Workcell('Value','C66', '=$B$66');
Workcell('Value','D66', '=$B$66');
Workcell('Value','E66', '=$B$66');
Workcell('Value','F66', '=$B$66');
Workcell('Value','G66', '=$B$66*$B$5');
Workcell('Value','H66', '=$B$66*$B$5');
Workcell('Value','I66', '=$B$66*$B$5');
Workcell('Value','J66', '=$B$66*$B$5');
Workcell('Value','K66', '=$B$66');

Workcell('Value','B67', str_replace(',','',$_POST['TRPAII']));
Workcell('Value','C67', '=$B$67');
Workcell('Value','D67', '=$B$67');
Workcell('Value','E67', '=$B$67');
Workcell('Value','F67', '=$B$67');
Workcell('Value','G67', '=$B$67*$B$5');
Workcell('Value','H67', '=$B$67*$B$5');
Workcell('Value','I67', '=$B$67*$B$5');
Workcell('Value','J67', '=$B$67*$B$5');
Workcell('Value','K67', '=$B$67');

Workcell('Value','B68', str_replace(',','',$_POST['OTH2II']));
Workcell('Value','C68', '=$B$68');
Workcell('Value','D68', '=$B$68');
Workcell('Value','E68', '=$B$68');
Workcell('Value','F68', '=$B$68');
Workcell('Value','G68', '=$B$68*$B$5');
Workcell('Value','H68', '=$B$68*$B$5');
Workcell('Value','I68', '=$B$68*$B$5');
Workcell('Value','J68', '=$B$68*$B$5');
Workcell('Value','K68', '=$B$68');

Workcell('Value','B69', str_replace(',','',$_POST['OTH3II']));
Workcell('Value','C69', '=$B$69');
Workcell('Value','D69', '=$B$69');
Workcell('Value','E69', '=$B$69');
Workcell('Value','F69', '=$B$69');
Workcell('Value','G69', '=$B$69*$B$5');
Workcell('Value','H69', '=$B$69*$B$5');
Workcell('Value','I69', '=$B$69*$B$5');
Workcell('Value','J69', '=$B$69*$B$5');
Workcell('Value','K69', '=$B$69');

Workcell('Value','B70', str_replace(',','',$_POST['OTH4II']));
Workcell('Value','C70', '=$B$70');
Workcell('Value','D70', '=$B$70');
Workcell('Value','E70', '=$B$70');
Workcell('Value','F70', '=$B$70');
Workcell('Value','G70', '=$B$70*$B$5');
Workcell('Value','H70', '=$B$70*$B$5');
Workcell('Value','I70', '=$B$70*$B$5');
Workcell('Value','J70', '=$B$70*$B$5');
Workcell('Value','K70', '=$B$70');

Workcell('Value','B71', str_replace(',','',$_POST['OTH5II']));
Workcell('Value','C71', '=$B$71');
Workcell('Value','D71', '=$B$71');
Workcell('Value','E71', '=$B$71');
Workcell('Value','F71', '=$B$71');
Workcell('Value','G71', '=$B$71*$B$5');
Workcell('Value','H71', '=$B$71*$B$5');
Workcell('Value','I71', '=$B$71*$B$5');
Workcell('Value','J71', '=$B$71*$B$5');
Workcell('Value','K71', '=$B$71');

Workcell('Value','B72', str_replace(',','',$_POST['LOFIII']));
Workcell('Value','C72', '=$B$72');
Workcell('Value','D72', '=$B$72');
Workcell('Value','E72', '=$B$72');
Workcell('Value','F72', '=$B$72');
Workcell('Value','G72', '=$B$72*$B$5');
Workcell('Value','H72', '=$B$72*$B$5');
Workcell('Value','I72', '=$B$72*$B$5');
Workcell('Value','J72', '=$B$72*$B$5');
Workcell('Value','K72', '=$B$72');

Workcell('Value','C73', '=SUM(C36:C72)');
Workcell('Value','D73', '=SUM(D36:D72)');
Workcell('Value','E73', '=SUM(E36:E72)');
Workcell('Value','F73', '=SUM(F36:F72)');
Workcell('Value','G73', '=SUM(G36:G72)');
Workcell('Value','H73', '=SUM(H36:H72)');
Workcell('Value','I73', '=SUM(I36:I72)');
Workcell('Value','J73', '=SUM(J36:J72)');
Workcell('Value','K73', '=SUM(K36:K72)');

Workcell('Value','C75', '=C73-(IF(X36=1,C36,0)+(IF(X37=1,C37,0)))');
Workcell('Value','D75', '=D73-(IF(Y36=1,D36,0)+(IF(Y37=1,D37,0)))');
Workcell('Value','E75', '=E73-(IF(Z36=1,E36,0)+(IF(Z37=1,E37,0)))');
Workcell('Value','F75', '=F73-(IF(AA36=1,F36,0)+(IF(AA37=1,F37,0)))');
Workcell('Value','G75', '=G73-(IF(AB36=1,G36,0)+(IF(AB37=1,G37,0)))');
Workcell('Value','H75', '=H73-(IF(AC36=1,H36,0)+(IF(AC37=1,H37,0)))');
Workcell('Value','I75', '=I73-(IF(AD36=1,I36,0)+(IF(AD37=1,I37,0)))');
Workcell('Value','J75', '=J73-(IF(AE36=1,J36,0)+(IF(AE37=1,J37,0)))');
Workcell('Value','K75', '=K73-(IF(AF36=1,K36,0)+(IF(AF37=1,K37,0)))');

Workcell('Value','C77', '=+C33-C73');
Workcell('Value','D77', '=+D33-D73');
Workcell('Value','E77', '=+E33-E73');
Workcell('Value','F77', '=+F33-F73');
Workcell('Value','G77', '=+G33-G73');
Workcell('Value','H77', '=+H33-H73');
Workcell('Value','I77', '=+I33-I73');
Workcell('Value','J77', '=+J33-J73');
Workcell('Value','K77', '=+K33-K73');

Workcell('Value','B79', str_replace('$ ','',str_replace(',','',$_POST['NPROBB'])));

Workcell('Value','B80', str_replace('%','',str_replace(',','',$_POST['NPROII']))/100);
Workcell('Value','C80', '=IF(C77>0,IF(C77>$B$79,$B$79*$B$80,C77*$B$80),0)');
Workcell('Value','D80', '=IF(D77>0,IF(D77>$B$79,$B$79*$B$80,D77*$B$80),0)');
Workcell('Value','E80', '=IF(E77>0,IF(E77>$B$79,$B$79*$B$80,E77*$B$80),0)');
Workcell('Value','F80', '=IF(F77>0,IF(F77>$B$79,$B$79*$B$80,F77*$B$80),0)');
Workcell('Value','G80', '=IF(G77>0,IF(G77>$B$79*$B$5,$B$79*$B$5*$B$80,G77*$B$80),0)');
Workcell('Value','H80', '=IF(H77>0,IF(H77>$B$79*$B$5,$B$79*$B$5*$B$80,H77*$B$80),0)');
Workcell('Value','I80', '=IF(I77>0,IF(I77>$B$79*$B$5,$B$79*$B$5*$B$80,I77*$B$80),0)');
Workcell('Value','J80', '=IF(J77>0,IF(J77>$B$79*$B$5,$B$79*$B$5*$B$80,J77*$B$80),0)');
Workcell('Value','K80', '=IF(K77>0,IF(K77>$B$79,$B$79*$B$80,K77*$B$80),0)');

Workcell('Value','B81', str_replace('$ ','',str_replace(',','',$_POST['NPREBB'])));

Workcell('Value','B82', str_replace('%','',str_replace(',','',$_POST['NPREII']))/100);
Workcell('Value','C82', '=IF(C77>0,IF(C77>$B$81,$B$81*$B$82,C77*$B$82),0)');
Workcell('Value','D82', '=IF(D77>0,IF(D77>$B$81,$B$81*$B$82,D77*$B$82),0)');
Workcell('Value','E82', '=IF(E77>0,IF(E77>$B$81,$B$81*$B$82,E77*$B$82),0)');
Workcell('Value','F82', '=IF(F77>0,IF(F77>$B$81,$B$81*$B$82,F77*$B$82),0)');
Workcell('Value','G82', '=IF(G77>0,IF(G77>$B$81*$B$5,$B$81*$B$5*$B$82,G77*$B$82),0)');
Workcell('Value','H82', '=IF(H77>0,IF(H77>$B$81*$B$5,$B$81*$B$5*$B$82,H77*$B$82),0)');
Workcell('Value','I82', '=IF(I77>0,IF(I77>$B$81*$B$5,$B$81*$B$5*$B$82,I77*$B$82),0)');
Workcell('Value','J82', '=IF(J77>0,IF(J77>$B$81*$B$5,$B$81*$B$5*$B$82,J77*$B$82),0)');
Workcell('Value','K82', '=IF(K77>0,IF(K77>$B$81,$B$81*$B$82,K77*$B$82),0)');

Workcell('Value','C84', '=SUM(C77-C80-C82)');
Workcell('Value','D84', '=SUM(D77-D80-D82)');
Workcell('Value','E84', '=SUM(E77-E80-E82)');
Workcell('Value','F84', '=SUM(F77-F80-F82)');
Workcell('Value','G84', '=SUM(G77-G80-G82)');
Workcell('Value','H84', '=SUM(H77-H80-H82)');
Workcell('Value','I84', '=SUM(I77-I80-I82)');
Workcell('Value','J84', '=SUM(J77-J80-J82)');
Workcell('Value','K84', '=SUM(K77-K80-K82)');

Workcell('Value','B86', str_replace('%','',str_replace(',','',$_POST['PROOII']))/100);
Workcell('Value','C86', '=SUM(C84-C87)');
Workcell('Value','D86', '=SUM(D84-D87)');
Workcell('Value','E86', '=SUM(E84-E87)');
Workcell('Value','F86', '=SUM(F84-F87)');
Workcell('Value','G86', '=SUM(G84-G87)');
Workcell('Value','H86', '=SUM(H84-H87)');
Workcell('Value','I86', '=SUM(I84-I87)');
Workcell('Value','J86', '=SUM(J84-J87)');
Workcell('Value','K86', '=SUM(K84-K87)');

Workcell('Value','B87', str_replace('%','',str_replace(',','',$_POST['PREOII']))/100);
Workcell('Value','C87', '=IF(C84>0,C84*$B$87,0)');
Workcell('Value','D87', '=IF(D84>0,D84*$B$87,0)');
Workcell('Value','E87', '=IF(E84>0,E84*$B$87,0)');
Workcell('Value','F87', '=IF(F84>0,F84*$B$87,0)');
Workcell('Value','G87', '=IF(G84>0,G84*$B$87,0)');
Workcell('Value','H87', '=IF(H84>0,H84*$B$87,0)');
Workcell('Value','I87', '=IF(I84>0,I84*$B$87,0)');
Workcell('Value','J87', '=IF(J84>0,J84*$B$87,0)');
Workcell('Value','K87', '=IF(K84>0,K84*$B$87,0)');

Workcell('Value','C88', '=+C80');
Workcell('Value','D88', '=+D80');
Workcell('Value','E88', '=+E80');
Workcell('Value','F88', '=+F80');
Workcell('Value','G88', '=+G80');
Workcell('Value','H88', '=+H80');
Workcell('Value','I88', '=+I80');
Workcell('Value','J88', '=+J80');
Workcell('Value','K88', '=+K80');

Workcell('Value','C89', '=+C37');
Workcell('Value','D89', '=+D37');
Workcell('Value','E89', '=+E37');
Workcell('Value','F89', '=+F37');
Workcell('Value','G89', '=+G37');
Workcell('Value','H89', '=+H37');
Workcell('Value','I89', '=+I37');
Workcell('Value','J89', '=+J37');
Workcell('Value','K89', '=+K37');

Workcell('Value','C90', '=+C36');
Workcell('Value','D90', '=+D36');
Workcell('Value','E90', '=+E36');
Workcell('Value','F90', '=+F36');
Workcell('Value','G90', '=+G36');
Workcell('Value','H90', '=+H36');
Workcell('Value','I90', '=+I36');
Workcell('Value','J90', '=+J36');
Workcell('Value','K90', '=+K36');

Workcell('Value','C91', '=SUM(C86:C90)');
Workcell('Value','D91', '=SUM(D86:D90)');
Workcell('Value','E91', '=SUM(E86:E90)');
Workcell('Value','F91', '=SUM(F86:F90)');
Workcell('Value','G91', '=SUM(G86:G90)');
Workcell('Value','H91', '=SUM(H86:H90)');
Workcell('Value','I91', '=SUM(I86:I90)');
Workcell('Value','J91', '=SUM(J86:J90)');
Workcell('Value','K91', '=SUM(K86:K90)');

Workcell('Value','C92', '=+C91/$B$9');
Workcell('Value','D92', '=+D91/$B$9');
Workcell('Value','E92', '=+E91/$B$9');
Workcell('Value','F92', '=+F91/$B$9');
Workcell('Value','G92', '=+G91/$B$9');
Workcell('Value','H92', '=+H91/$B$9');
Workcell('Value','I92', '=+I91/$B$9');
Workcell('Value','J92', '=+J91/$B$9');
Workcell('Value','K92', '=+K91/$B$9');

Workcell('Value','B94', str_replace('%','',str_replace(',','',$_POST['LIT1II']))/100);
Workcell('Value','C94', '=-C91*$B$94');
Workcell('Value','D94', '=-D91*$B$94');
Workcell('Value','E94', '=-E91*$B$94');
Workcell('Value','F94', '=-F91*$B$94');
Workcell('Value','G94', '=-G91*$B$94*$B$5');
Workcell('Value','H94', '=-H91*$B$94*$B$5');
Workcell('Value','I94', '=-I91*$B$94*$B$5');
Workcell('Value','J94', '=-J91*$B$94*$B$5');
Workcell('Value','K94', '=-K91*$B$94');

Workcell('Value','B95', str_replace(',','',$_POST['LIT2II']));
Workcell('Value','C95', '=-$B$95');
Workcell('Value','D95', '=-$B$95');
Workcell('Value','E95', '=-$B$95');
Workcell('Value','F95', '=-$B$95');
Workcell('Value','G95', '=-$B$95*$B$5');
Workcell('Value','H95', '=-$B$95*$B$5');
Workcell('Value','I95', '=-$B$95*$B$5');
Workcell('Value','J95', '=-$B$95*$B$5');
Workcell('Value','K95', '=-$B$95*$B$5');

Workcell('Value','C96', '=SUM(C92:C95)');
Workcell('Value','D96', '=SUM(D92:D95)');
Workcell('Value','E96', '=SUM(E92:E95)');
Workcell('Value','F96', '=SUM(F92:F95)');
Workcell('Value','G96', '=SUM(G92:G95)');
Workcell('Value','H96', '=SUM(H92:H95)');
Workcell('Value','I96', '=SUM(I92:I95)');
Workcell('Value','J96', '=SUM(J92:J95)');
Workcell('Value','K96', '=SUM(K92:K95)');

Workcell('Value','B98', str_replace(',','',$_POST['WOEXII']));
Workcell('Value','C98', '=-$B$98');
Workcell('Value','D98', '=-$B$98');
Workcell('Value','E98', '=-$B$98');
Workcell('Value','F98', '=-$B$98');
Workcell('Value','G98', '=-B98*$B$5');
Workcell('Value','H98', '=-B98*$B$5');
Workcell('Value','I98', '=-B98*$B$5');
Workcell('Value','J98', '=-B98*$B$5');
Workcell('Value','K98', '=-$B$98');

Workcell('Value','B99', str_replace(',','',$_POST['ROMIII']));
Workcell('Value','C99', '=-$B$99');
Workcell('Value','D99', '=-$B$99');
Workcell('Value','E99', '=-$B$99');
Workcell('Value','F99', '=-$B$99');
Workcell('Value','G99', '=-B99*$B$5');
Workcell('Value','H99', '=-B99*$B$5');
Workcell('Value','I99', '=-B99*$B$5');
Workcell('Value','J99', '=-B99*$B$5');
Workcell('Value','K99', '=-$B$99*$B$5');

Workcell('Value','B100', str_replace('%','',str_replace(',','',$_POST['VAROII']))/100);
Workcell('Value','C100', '=-SUM(C96-C98)*$B$100');
Workcell('Value','D100', '=-SUM(D96-D98)*$B$100');
Workcell('Value','E100', '=-SUM(E96-E98)*$B$100');
Workcell('Value','F100', '=-SUM(F96-F98)*$B$100');
Workcell('Value','G100', '=-SUM(G96-G98)*$B$100');
Workcell('Value','H100', '=-SUM(H96-H98)*$B$100');
Workcell('Value','I100', '=-SUM(I96-I98)*$B$100');
Workcell('Value','J100', '=-SUM(J96-J98)*$B$100');
Workcell('Value','K100', '=-SUM(K96-K98)*$B$100');

Workcell('Value','C101', '=SUM(C96:C100)');
Workcell('Value','D101', '=SUM(D96:D100)');
Workcell('Value','E101', '=SUM(E96:E100)');
Workcell('Value','F101', '=SUM(F96:F100)');
Workcell('Value','G101', '=SUM(G96:G100)');
Workcell('Value','H101', '=SUM(H96:H100)');
Workcell('Value','I101', '=SUM(I96:I100)');
Workcell('Value','J101', '=SUM(J96:J100)');
Workcell('Value','K101', '=SUM(K96:K100)');

$rendererName = PHPExcel_Settings::PDF_RENDERER_DOMPDF;
$rendererLibrary = 'dompdf';
$rendererLibraryPath = '../libs/' . $rendererLibrary;

PHPExcel_Settings::setPdfRenderer($rendererName,$rendererLibraryPath);

ob_end_clean();

header("Content-type: application/pdf");
header("Content-Disposition: attachment; filename='Breakeven.pdf'");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');	
$objWriter->save('php://output');

exit;

?>