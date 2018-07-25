<?php
require '../db/database_conn.php';
require_once '../libs/PHPExcel.php';
include '../session.php';
include 'access_control.php';
include '../header.html';
$description = "Accessed Route Details for Show ID: ".$_GET['selectedid'];
include '../security_log.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$objPHPExcel   = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);

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
	    case 'Font':
	    	$style = array('font' => array('name'  => 'Arial','size' => 10,'color' => array('rgb' => $value)));
	        $objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($style);
	        break;     
	}
}

if (isset($_GET['selectedid']))
{
	$routeid = $_GET['selectedid'];

	$sql = "SELECT det.ROUTES_DETID, 
					det.ROUTESID, 
					DATE_FORMAT(det.PRESENTATION_DATE,'%m/%d/%Y') as PRESENTATION_DATE, 
					IFNULL(det.HOLIDAY, '') as HOLIDAY, 
					(SELECT IFNULL(ci.NAME, '') 
					 FROM cities ci 
					 WHERE det.CITYID = ci.ID) as CITY,
					(SELECT IFNULL(sta.NAME, '') 
					 FROM cities ci, states sta 
					 WHERE det.CITYID = ci.ID
					 AND ci.STATE_ID = sta.ID) as STATE,
					IFNULL(det.REPEAT, '') as REPEAT1,
					IFNULL(det.MILEAGE, 0) as MILEAGE, 
					IFNULL(det.BOOK_NOTES, '') as BOOK_NOTES, 	
					IFNULL(det.PROD_NOTES, '') as PROD_NOTES,
					IFNULL(ro.TRUCKS * det.MILEAGE, 0) as TEAM_DRIVE,
					IFNULL(det.TIME_ZONE, '') as TIME_ZONE,
					IFNULL(det.SHOW_TIMES, '') as SHOW_TIMES,			
					IFNULL(det.PERF, 0) as PERF,
					(SELECT IFNULL(ve.VENUENAME, '') 
					 FROM venues ve 
					 WHERE det.VENUEID = ve.VENUEID) as VENUE,
					(SELECT IFNULL(pre.PRESENTERNAME, '') 
					 FROM presenters pre
					 WHERE det.PRESENTERID = pre.PRESENTERID) as PRESENTER,
					IFNULL(det.CAPACITY, 0) as CAPACITY,
					IFNULL(det.FIXED_GNTEE, 0) as FIXED_GNTEE,
					IFNULL(det.ROYALTY, 0) as ROYALTY,
					IFNULL(det.BACKEND, 0) as BACKEND,
					IFNULL(det.BREAKEVEN, 0) as BREAKEVEN,
					IFNULL(det.DEAL_NOTES, '') as DEAL_NOTES,
					IFNULL(det.EST_ROYALTY, 0) as EST_ROYALTY,  
					IFNULL(det.ON_SUB, '') as ON_SUB,
					IFNULL(det.DATE_CONF, '') as DATE_CONF,
					IFNULL(det.OFFER, '') as OFFER,
					IFNULL(det.PRICE_SCALES, '') as PRICE_SCALES,
					IFNULL(det.EXPENSES, '') as EXPENSES,
					IFNULL(det.DEAL_MEMO, '') as DEAL_MEMO,
					IFNULL(det.CONTRACT, '') as CONTRACT,
					det.IND as IND,
					sh.SHOWNAME as SHOWNAME
			FROM routes_det det, routes ro, shows sh
			WHERE det.ROUTESID = $routeid 
			AND det.ROUTESID = ro.ROUTESID 
			AND ro.SHOWID = sh.SHOWID
			ORDER BY det.PRESENTATION_DATE ASC";

	$result = $conn->query($sql);
	$result2 = $conn->query($sql);
	if ($result2->num_rows > 0) {
		while($row = $result2->fetch_assoc()) {
			$showname = $row["SHOWNAME"];
		}
		Workcell('Value','A1', 'SHOW TITLE:');
		Workcell('Value','B1', $showname);	
		Workcell('Value','A3', 'Presentation Date');
		Workcell('Value','B3', 'Holiday');
		Workcell('Value','C3', 'City');
		Workcell('Value','D3', 'State');
		Workcell('Value','E3', 'Repeat');
		Workcell('Value','F3', 'Mileage');
		Workcell('Value','G3', 'Booking Notes');
		Workcell('Value','H3', 'Production Notes');
		Workcell('Value','I3', 'Team Drive Cost Estimate');
		Workcell('Value','J3', 'Time Zone');
		Workcell('Value','K3', 'Show Times');
		Workcell('Value','L3', 'Number Of Performances');
		Workcell('Value','M3', 'Venue');
		Workcell('Value','N3', 'Presenter');
		Workcell('Value','O3', 'Capacity');
		Workcell('Value','P3', 'Fixed Guarantee');
		Workcell('Value','Q3', 'Royalty');
		Workcell('Value','R3', 'Backend');
		Workcell('Value','S3', 'Breakeven');
		Workcell('Value','T3', 'Deal Notes');
		Workcell('Value','U3', 'Estimated Royalty');
		Workcell('Value','V3', 'On Sub');
		Workcell('Value','W3', 'Date Conf');
		Workcell('Value','X3', 'Offer');
		Workcell('Value','Y3', 'Price Scales');
		Workcell('Value','Z3', 'Expenses');
		Workcell('Value','AA3', 'Deal Memo');
		Workcell('Value','AB3', 'Contract');

		$rowf = 4; 

	    while($row = $result->fetch_assoc()) {
	    	Workcell('Value','A'.$rowf,$row["PRESENTATION_DATE"]);	    	
	    	if($row["HOLIDAY"] == 1){
	    		Workcell('Value','B'.$rowf,'X');
	    	}else{	
	    		Workcell('Value','B'.$rowf,' ');
	    	}
	    	Workcell('Value','C'.$rowf,$row["CITY"]);
	    	Workcell('Value','D'.$rowf,$row["STATE"]);
	    	if($row["REPEAT1"] == 1){
	    		Workcell('Value','E'.$rowf,'X');
	    	}else{	
	    		Workcell('Value','E'.$rowf,' ');
	    	}
	    	Workcell('Value','F'.$rowf,number_format($row["MILEAGE"],2));
	    	Workcell('Value','G'.$rowf,$row["BOOK_NOTES"]);
	    	Workcell('Value','H'.$rowf,$row["PROD_NOTES"]);
	    	Workcell('Value','I'.$rowf,number_format($row["TEAM_DRIVE"],2));
	    	Workcell('Value','J'.$rowf,$row["TIME_ZONE"]);
	    	Workcell('Value','K'.$rowf,$row["SHOW_TIMES"]);
	    	Workcell('Value','L'.$rowf,$row["PERF"]);
	    	Workcell('Value','M'.$rowf,$row["VENUE"]);
	    	Workcell('Value','N'.$rowf,$row["PRESENTER"]);
	    	Workcell('Value','O'.$rowf,$row["CAPACITY"]);
	    	Workcell('Value','P'.$rowf,number_format($row["FIXED_GNTEE"],2));
	    	Workcell('Value','Q'.$rowf,number_format($row["ROYALTY"],2));
	    	Workcell('Value','R'.$rowf,number_format($row["BACKEND"],2));
	    	Workcell('Value','S'.$rowf,number_format($row["BREAKEVEN"],2));
	    	Workcell('Value','T'.$rowf,$row["DEAL_NOTES"]);
	    	Workcell('Value','U'.$rowf,number_format($row["EST_ROYALTY"],2));
	    	if($row["ON_SUB"] == 1){
	    		Workcell('Value','V'.$rowf,'X');
	    		Workcell('Color','V'.$rowf,'008000');
	    	}else{	
	    		Workcell('Value','V'.$rowf,' ');
	    		Workcell('Color','V'.$rowf,'FF0000');
	    	}
	    	if($row["DATE_CONF"] == 1){
	    		Workcell('Value','W'.$rowf,'X');
	    		Workcell('Color','W'.$rowf,'008000');
	    	}else{	
	    		Workcell('Value','W'.$rowf,' ');
	    		Workcell('Color','W'.$rowf,'FF0000');
	    	}
	    	if($row["OFFER"] == 1){
	    		Workcell('Value','X'.$rowf,'X');
	    		Workcell('Color','X'.$rowf,'008000');
	    	}else{	
	    		Workcell('Value','X'.$rowf,' ');
	    		Workcell('Color','X'.$rowf,'FF0000');
	    	}
	    	if($row["PRICE_SCALES"] == 1){
	    		Workcell('Value','Y'.$rowf,'X');
	    		Workcell('Color','Y'.$rowf,'008000');
	    	}else{	
	    		Workcell('Value','Y'.$rowf,' ');
	    		Workcell('Color','Y'.$rowf,'FF0000');
	    	}
	    	if($row["EXPENSES"] == 1){
	    		Workcell('Value','Z'.$rowf,'X');
	    		Workcell('Color','Z'.$rowf,'008000');
	    	}else{	
	    		Workcell('Value','Z'.$rowf,' ');
	    		Workcell('Color','Z'.$rowf,'FF0000');
	    	}
	    	if($row["DEAL_MEMO"] == 1){
	    		Workcell('Value','AA'.$rowf,'X');
	    		Workcell('Color','AA'.$rowf,'008000');
	    	}else{	
	    		Workcell('Value','AA'.$rowf,' ');
	    		Workcell('Color','AA'.$rowf,'FF0000');
	    	}
	    	if($row["CONTRACT"] == 1){
	    		Workcell('Value','AB'.$rowf,'X');
	    		Workcell('Color','AB'.$rowf,'008000');
	    	}else{	
	    		Workcell('Value','AB'.$rowf,' ');
	    		Workcell('Color','AB'.$rowf,'FF0000');
	    	}

	    	$rowf++;		
	    }
	} 
}

$style = array('font' => array('name'  => 'Arial','size' => 10,'color' => array('rgb' => 'FF0000')));

$hcol = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
$hrow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

$hcol++;
for ($row=1;$row< $hrow+1;$row++) { 
	for ($col='A';$col!=$hcol;$col++) {
	    Workcell('Color',$col.'3','000066');
	    Workcell('Center',$col.$row,'');
	    Workcell('Font',$col.$row,'000000');
	    Workcell('Font',$col.'3','FFFFFF');
	    $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
	}    
}

for ($row=3;$row< $hrow+1;$row++) { 
	for ($col='A';$col!=$hcol;$col++) {
	    Workcell('Border',$col.$row,'');
	}    
}

$objPHPExcel->getActiveSheet()->setTitle('DETAILS');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->setPreCalculateFormulas(true);

header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Route_details.xlsx"');
$objWriter->save('php://output');

?>

$conn->close();
?> 
