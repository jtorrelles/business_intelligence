<?php
/*
* Author: Rohit Kumar
* Website: iamrohit.in
* Version: 0.0.1
* Date: 25-04-2015
* App Name: Php+ajax country state city dropdown
* Description: A simple oops based php and ajax country state city dropdown list
*/
require_once('../db/dbconfig.php');
class showRoutesServices extends dbconfig {
   
   public static $data;
   function __construct() {
     parent::__construct();
   }

    // Fetch all countries list
   public static function getCountries() {
     try {
       $query = "SELECT id, name FROM countries";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Country not found.");
       }
       $res = array();
       while($resultSet = mysqli_fetch_assoc($result)) {
        $res[$resultSet['id']] = $resultSet['name'];
       }
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Countries fetched successfully.", 'result'=>$res);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

   // Fetch all states list by country id
  public static function getStates($countryId) {
     try {
       $query = "SELECT id, name FROM states WHERE country_id=".$countryId;
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("State not found.");
       }
       $res = array();
       while($resultSet = mysqli_fetch_assoc($result)) {
        $res[$resultSet['id']] = $resultSet['name'];
       }
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"States fetched successfully.", 'result'=>$res);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

    // Fetch all cities list by state id
  public static function getCities($stateId) {
     try {
       $query = "SELECT id, name FROM cities WHERE state_id=".$stateId;
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("City not found.");
       }
       $res = array();
       while($resultSet = mysqli_fetch_assoc($result)) {
        $res[$resultSet['id']] = $resultSet['name'];
       }
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Cities fetched successfully.", 'result'=>$res);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

   public static function getGlobalLocation($cityId){
    try {

    $query = "SELECT ci.`id` as city, st.`id` as state, co.`id` as country 
            FROM cities ci, states st, countries co 
            WHERE ci.`id` = $cityId 
            AND ci.state_id = st.`id` 
            AND st.country_id = co.`id`";
    $result = dbconfig::run($query);

    if(!$result) {
      throw new exception("Data not found.");
    }

    $res = array();
    $resultSet = mysqli_fetch_assoc($result);

    $res["cityid"] = $resultSet['city'];
    $res["stateid"] = $resultSet['state'];
    $res["countryid"] = $resultSet['country'];

     $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Data fetched successfully.", 'result'=>$res);

    } catch (Exception $e) {
     $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
    } finally {
      return $data;
    }
   }
 
 // Fetch all countries list
   public static function getShows() {
     try {
       $query = "SELECT showid, showNAME as showname FROM shows WHERE showactive = 'Y' ORDER BY showname ASC";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Show not found.");
       }
       $res = array();
       while($resultSet = mysqli_fetch_assoc($result)) {
        $res[$resultSet['showid']] = $resultSet['showname'];
       }
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Shows fetched successfully.", 'result'=>$res);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

 // Fetch all countries list
   public static function getVenues() {
     try {
       $query = "SELECT venueid, venuename FROM venues WHERE venueactive = 'Y'";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Venue not found.");
       }
       $res = array();
       while($resultSet = mysqli_fetch_assoc($result)) {
        $res[$resultSet['venueid']] = $resultSet['venuename'];
       }
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Venues fetched successfully.", 'result'=>$res);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

    // Fetch all countries list
   public static function getPresenters() {
     try {
       $query = "SELECT presenterid, presentername FROM presenters WHERE presenteractive = 'Y'";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Presenter not found.");
       }
       $res = array();
       while($resultSet = mysqli_fetch_assoc($result)) {
        $res[$resultSet['presenterid']] = $resultSet['presentername'];
       }
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Presenters fetched successfully.", 'result'=>$res);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

    // Fetch all countries list
   public static function getNUTOfShow($showID) {
     try {
        $query = "SELECT IFNULL(ShowWEEKLY_NUT,0) as ShowWEEKLY_NUT, 
                         IFNULL(ShowNUMBER_OF_TRUCKS,0) as ShowNUMBER_OF_TRUCKS 
                  FROM shows WHERE ShowID = $showID";
        $result = dbconfig::run($query);
        
        if(!$result) {
          throw new exception("Show not found.");
        }

        $res = array();

        $resultSet = mysqli_fetch_assoc($result);
        $res["nut"] = $resultSet['ShowWEEKLY_NUT'];
        $res["trucks"] = $resultSet['ShowNUMBER_OF_TRUCKS'];

        $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Shows fetched successfully.", 'result'=>$res);

     } catch (Exception $e) {
        $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

    // Fetch all countries list
   public static function getDataOfRoute($routeID) {
     try {
       $query = "SELECT ro.ROUTESID as id, 
                        sw.ShowNAME as showname, 
                        ro.TRUCKS as numberoftrucks, 
                        ro.DATE_OF_ROUTE as dateroute, 
                        ro.WEEKLY_NUT as routenut
                  FROM routes ro, shows sw
                  WHERE ro.ROUTESID = $routeID 
                  AND ro.SHOWID = sw.ShowID";

       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Route not found.");
       }
       $res = array();

       $resultSet = mysqli_fetch_assoc($result);
       $res["routeid"] = $resultSet['id'];
       $res["showname"] = $resultSet['showname'];
       $res["numberoftrucks"] = $resultSet['numberoftrucks'];
       $res["dateroute"] = $resultSet['dateroute'];
       $res["nut"] = $resultSet['routenut'];
	   
	   include '../session.php';
	   $description = "Accessed main route data for show: ".$res['showname'].". Current data is: 
	   id: ".$res["routeid"].", 
	   showname: ".$res["showname"].", 
	   numberoftrucks: ".$res["numberoftrucks"].", 
	   dateroute: ".$res["dateroute"].", 
	   routenut: ".$res['nut'];
	   include '../security_log.php';

       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Route fetched successfully.", 'result'=>$res);
       
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

   public static function getChangeDataInfo($routeDetailID, $routeID){
      try {
       $sql = "SELECT r.ROUTES_DETID, r.PRESENTATION_DATE as PRESENTATION_DATE 
                  FROM routes_det r 
                  WHERE r.ROUTESID = $routeID 
                  AND r.ROUTES_DETID NOT IN ($routeDetailID) 
                  ORDER BY PRESENTATION_DATE ASC";

       $result = dbconfig::run($sql);

       if(!$result) {
         throw new exception("RouteDetail not found.");
       }

       $res = array();

       while($resultSet = mysqli_fetch_assoc($result)) {
          $res[$resultSet['ROUTES_DETID']] = $resultSet['PRESENTATION_DATE'];
       }
	   include '../session.php';
	   $description = "Modified / changed the date of a Route detail";
	   include '../security_log.php';
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Data Route Detail fetched successfully.", 'result'=>$res);
       
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

    // Fetch all countries list
    public static function getDataOfDetailRoute($detailID) {
      try {
        $query = "SELECT rd.ROUTES_DETID, rd.ROUTESID, rd.PRESENTATION_DATE, rd.HOLIDAY, 
                        IFNULL(rd.CITYID,0) as CITYID, rd.`REPEAT`, rd.MILEAGE, 
                        rd.BOOK_NOTES, rd.PROD_NOTES, rd.TIME_ZONE, rd.SHOW_TIMES, rd.PERF, 
                        IFNULL(rd.VENUEID,0) as VENUEID, IFNULL(rd.PRESENTERID, 0) as PRESENTERID, 
                        rd.CAPACITY, rd.FIXED_GNTEE, 
                        rd.ROYALTY, rd.BACKEND, rd.BREAKEVEN, rd.DEAL_NOTES, 
                        rd.EST_ROYALTY, rd.ON_SUB, rd.DATE_CONF, rd.OFFER, 
                        rd.PRICE_SCALES, rd.EXPENSES, rd.DEAL_MEMO, rd.CONTRACT, 
                        ro.TRUCKS * rd.MILEAGE AS TEAM_DRIVE, rd.GROSS_POT, 
                        rd.SPO_GROSS_POT, rd.SUBS_TSALES, rd.GROUP_TSALES,
                        rd.SINGLE_TSALES, rd.GROSS_SALES, rd.OTT_EXPENSES,
                        rd.NAGBOR, rd.PL_EXPENSES, rd.TE_EXPENSES, rd.EP_LOSS,
                        rd.GUARANTEE, rd.ROYALTY_PER, rd.MROYALTY, rd.OVERAGE_PER,
                        rd.OVERAGE, IFNULL(ve.VenueNAME, '') as VenueNAME, 
                        IFNULL(pr.PresenterNAME, '') as PresenterNAME, 
                        IFNULL(ci.`name`, '') as cityNAME, 
                        IFNULL(st.`name`, '') as stateNAME, 
                        IFNULL(co.`name`, '') as countryNAME
                  FROM routes_det rd 
                  INNER JOIN routes ro ON ro.ROUTESID = rd.ROUTESID 
                  LEFT JOIN venues ve ON rd.VENUEID = ve.VenueID 
                  LEFT JOIN presenters pr ON rd.PRESENTERID = pr.PresenterID 
                  LEFT JOIN cities ci ON rd.CITYID = ci.id 
                  LEFT JOIN states st ON ci.state_id = st.id 
                  LEFT JOIN countries co ON st.country_id = co.id  
                  WHERE rd.ROUTES_DETID = $detailID";

       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Detail Route not found.");
       }
       $res = array();

       $resultSet = mysqli_fetch_assoc($result);
       $res["routedetid"] = $resultSet['ROUTES_DETID'];
       $res["routeid"] = $resultSet['ROUTESID'];
       $res["presentation_date"] = $resultSet['PRESENTATION_DATE'];
       $res["holiday"] = $resultSet['HOLIDAY'];
       $res["cityid"] = $resultSet['CITYID'];
       $res["repeat"] = $resultSet['REPEAT'];
       $res["mileage"] = $resultSet['MILEAGE'];
       $res["book_notes"] = $resultSet['BOOK_NOTES'];
       $res["prod_notes"] = $resultSet['PROD_NOTES'];
       $res["time_zone"] = $resultSet['TIME_ZONE'];
       $res["show_times"] = $resultSet['SHOW_TIMES'];
       $res["perf"] = $resultSet['PERF'];
       $res["venueid"] = $resultSet['VENUEID'];
       $res["presenterid"] = $resultSet['PRESENTERID'];
       $res["capacity"] = $resultSet['CAPACITY'];
       $res["fixed_gntee"] = $resultSet['FIXED_GNTEE'];
       $res["royalty"] = $resultSet['ROYALTY'];
       $res["backend"] = $resultSet['BACKEND'];
       $res["breakeven"] = $resultSet['BREAKEVEN'];
       $res["deal_notes"] = $resultSet['DEAL_NOTES'];
       $res["est_royalty"] = $resultSet['EST_ROYALTY'];
       $res["on_sub"] = $resultSet['ON_SUB'];
       $res["date_conf"] = $resultSet['DATE_CONF'];
       $res["offer"] = $resultSet['OFFER'];
       $res["price_scales"] = $resultSet['PRICE_SCALES'];
       $res["expenses"] = $resultSet['EXPENSES'];
       $res["deal_memo"] = $resultSet['DEAL_MEMO'];
       $res["contract"] = $resultSet['CONTRACT'];
       $res["teamdrive"] = $resultSet['TEAM_DRIVE'];
       $res["gross_pot"] = $resultSet['GROSS_POT'];
       $res["spo_gross_pot"] = $resultSet['SPO_GROSS_POT'];
       $res["subs_tsales"] = $resultSet['SUBS_TSALES'];
       $res["group_tsales"] = $resultSet['GROUP_TSALES'];
       $res["single_tsales"] = $resultSet['SINGLE_TSALES'];
       $res["gross_sales"] = $resultSet['GROSS_SALES'];
       $res["ott_expenses"] = $resultSet['OTT_EXPENSES'];
       $res["nagbor"] = $resultSet['NAGBOR'];
       $res["pl_expenses"] = $resultSet['PL_EXPENSES'];
       $res["te_expenses"] = $resultSet['TE_EXPENSES'];
       $res["ep_loss"] = $resultSet['EP_LOSS'];
       $res["guarantee"] = $resultSet['GUARANTEE'];
       $res["royalty_per"] = $resultSet['ROYALTY_PER'];
       $res["mroyalty"] = $resultSet['MROYALTY'];
       $res["overage_per"] = $resultSet['OVERAGE_PER'];
       $res["overage"] = $resultSet['OVERAGE'];
       $res["venue_name"] = $resultSet['VenueNAME'];
       $res["presenter_name"] = $resultSet['PresenterNAME'];
       $res["city_name"] = $resultSet['cityNAME'];
       $res["state_name"] = $resultSet['stateNAME'];
       $res["country_name"] = $resultSet['countryNAME'];
	   
	   include '../session.php';
	   $description = "Accessed detail data for Route ID: ".$res['routeid'].". On Detail ID: ".$res['routedetid'].". Current data is: 
ROUTES_DETID: ".$res["routedetid"].", 
ROUTESID: ".$res["routeid"].", 
PRESENTATION_DATE: ".$res["presentation_date"].", 
HOLIDAY: ".$res["holiday"].", 
CITYID: ".$res["cityid"].", 
REPEAT: ".$res["repeat"].", 
MILEAGE: ".$res["mileage"].", 
BOOK_NOTES: ".$res["book_notes"].", 
PROD_NOTES: ".$res["prod_notes"].", 
TIME_ZONE: ".$res["time_zone"].", 
SHOW_TIMES: ".$res["show_times"].", 
PERF: ".$res["perf"].", 
VENUEID: ".$res["venueid"].", 
PRESENTERID: ".$res["presenterid"].", 
CAPACITY: ".$res["capacity"].", 
FIXED_GNTEE: ".$res["fixed_gntee"].", 
ROYALTY: ".$res["royalty"].", 
BACKEND: ".$res["backend"].", 
BREAKEVEN: ".$res["breakeven"].", 
DEAL_NOTES: ".$res["deal_notes"].", 
EST_ROYALTY: ".$res["est_royalty"].", 
ON_SUB: ".$res["on_sub"].", 
DATE_CONF: ".$res["date_conf"].", 
OFFER: ".$res["offer"].", 
PRICE_SCALES: ".$res["price_scales"].", 
EXPENSES: ".$res["expenses"].", 
DEAL_MEMO: ".$res["deal_memo"].", 
CONTRACT: ".$res["contract"].", 
TEAM_DRIVE: ".$res["teamdrive"].", 
GROSS_POT: ".$res["gross_pot"].", 
SPO_GROSS_POT: ".$res["spo_gross_pot"].", 
SUBS_TSALES: ".$res["subs_tsales"].", 
GROUP_TSALES: ".$res["group_tsales"].", 
SINGLE_TSALES: ".$res["single_tsales"].", 
GROSS_SALES: ".$res["gross_sales"].", 
OTT_EXPENSES: ".$res["ott_expenses"].", 
NAGBOR: ".$res["nagbor"].", 
PL_EXPENSES: ".$res["pl_expenses"].", 
TE_EXPENSES: ".$res["te_expenses"].", 
EP_LOSS: ".$res["ep_loss"].", 
GUARANTEE: ".$res["guarantee"].", 
ROYALTY_PER: ".$res["royalty_per"].", 
MROYALTY: ".$res["mroyalty"].", 
OVERAGE_PER: ".$res["overage_per"].", 
OVERAGE: ".$res["overage"].", 
VenueNAME: ".$res["venue_name"].", 
PresenterNAME: ".$res["presenter_name"].", 
cityNAME: ".$res["city_name"].", 
stateNAME: ".$res["state_name"].", 
countryNAME: ".$res["country_name"];
	   include '../security_log.php';

       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Route Detail fetched successfully.", 'result'=>$res);
       
      } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
      } finally {
        return $data;
      }
    }

    public static function processUploadFile($dataFileName){
      try {

        //import library
        require_once '../libs/PHPExcel/IOFactory.php';

        $uploadOk = 1;
        $target_dir = "../uploads/";
        $imageFileType = strtolower(pathinfo($dataFileName['name'],PATHINFO_EXTENSION));
        $target_file = $target_dir . basename($dataFileName['name']);

        //Verify extension File
        if($imageFileType != "xlsx") {

            $message = "Sorry, only XLSX files are allowed.";
            $uploadOk = 0;

            $data = array('status'=>'error', 'tp'=>$uploadOk, 'msg'=>$message, 'result'=>null);

        }else{
          //Verify Size File < 50MB
          if ($dataFileName['size'] > 50000000) {
            $message = "Sorry, your file is too large.";
            $uploadOk = 0;

            $data = array('status'=>'error', 'tp'=>$uploadOk, 'msg'=>$message, 'result'=>null);
          }else{

            if (file_exists($target_file)) {
                $message = "Sorry, file already exists.";
                $uploadOk = 0;

                $data = array('status'=>'error', 'tp'=>$uploadOk, 'msg'=>$message, 'result'=>null);
            }else{

              if ($uploadOk == 0) {
                $message = "Sorry, your file was not uploaded.";
                $uploadOk = 0;
                // if everything is ok, try to upload file
              }else{
                //move file to target directory
                if(move_uploaded_file($dataFileName["tmp_name"], $target_file)){

                  $objPHPExcel = PHPExcel_IOFactory::load($target_file);
		  ob_clean();
                  //Set up all the variables from the Excel Spreadsheet
                  $Showtoroute = $objPHPExcel->getSheet(1)->getCell('E1')->getValue();
                  $Showtorouteid = substr($Showtoroute,strpos($Showtoroute,"//")+2);
                  $Date_route = $objPHPExcel->getSheet(1)->getCell('R2')->getValue();
                  $DR = date($format = "Y-m-d", PHPExcel_Shared_Date::ExceltoPHP($Date_route));  
                  for($i = 0; $i < 364; $i++){
                    $id = 8 + $i;
                    $Presentation_date = $objPHPExcel->getSheet(1)->getCell("D".$id)->getValue();
                    $PD[$i] = date($format = "Y-m-d", PHPExcel_Shared_Date::ExceltoPHP($Presentation_date));  
                    $Holiday[$i] = $objPHPExcel->getSheet(1)->getCell("E".$id)->getValue();
                    $City[$i] = $objPHPExcel->getSheet(1)->getCell("G".$id)->getValue();
                    $Repeat[$i] = $objPHPExcel->getSheet(1)->getCell("H".$id)->getValue();
                    $Mileage[$i] = $objPHPExcel->getSheet(1)->getCell("I".$id)->getValue();
                    $Book_notes[$i] = $objPHPExcel->getSheet(1)->getCell("K".$id)->getValue();
                    $Prod_notes[$i] = $objPHPExcel->getSheet(1)->getCell("L".$id)->getValue();
                    $Time_zone[$i] = $objPHPExcel->getSheet(1)->getCell("N".$id)->getValue();
                    $Show_times[$i] = $objPHPExcel->getSheet(1)->getCell("O".$id)->getValue();
                    $Perf[$i] = $objPHPExcel->getSheet(1)->getCell("P".$id)->getValue();
                    $Venue[$i] = $objPHPExcel->getSheet(1)->getCell("Q".$id)->getValue();
                    $Presenter[$i] = $objPHPExcel->getSheet(1)->getCell("R".$id)->getValue();
                    $Capacity[$i] = $objPHPExcel->getSheet(1)->getCell("S".$id)->getValue();
                    $Fixed_gntee[$i] = $objPHPExcel->getSheet(1)->getCell("T".$id)->getValue();
                    $Royalty[$i] = $objPHPExcel->getSheet(1)->getCell("U".$id)->getValue();
                    $Backend[$i] = $objPHPExcel->getSheet(1)->getCell("V".$id)->getValue();
                    $Breakeven[$i] = $objPHPExcel->getSheet(1)->getCell("W".$id)->getValue();
                    $Deal_notes[$i] = $objPHPExcel->getSheet(1)->getCell("X".$id)->getValue();
                    $Est_royalty[$i] = $objPHPExcel->getSheet(1)->getCell("Y".$id)->getValue();
                    $On_sub[$i] = $objPHPExcel->getSheet(1)->getCell("Z".$id)->getValue();
                    $Date_conf[$i] = $objPHPExcel->getSheet(1)->getCell("AA".$id)->getValue();
                    $Offer[$i] = $objPHPExcel->getSheet(1)->getCell("AB".$id)->getValue();
                    $Price_scales[$i] = $objPHPExcel->getSheet(1)->getCell("AC".$id)->getValue();
                    $Expenses[$i] = $objPHPExcel->getSheet(1)->getCell("AD".$id)->getValue();
                    $Deal_memo[$i] = $objPHPExcel->getSheet(1)->getCell("AE".$id)->getValue();
                    $Contract[$i] = $objPHPExcel->getSheet(1)->getCell("AF".$id)->getValue();
                  }   

                  //Free Memory
                  $objPHPExcel->disconnectWorksheets();
                  unset($objPHPExcel);

                  $res = array();

                  $res["showtorouteid"] = $Showtorouteid;
                  $res["showtoroute"] = substr($Showtoroute,0,strpos($Showtoroute,"//"));
                  $query = "SELECT ShowNUMBER_OF_TRUCKS,
                                   ShowWEEKLY_NUT
                            FROM shows
                            WHERE ShowID = $Showtorouteid";
                      $result = dbconfig::run($query);
                      if(!$result) {    
                          //NO ESTA FUNCIONANDO ESTA EXCEPCION - PENDIENTE                    
                          throw new exception("Show not found.");
                      }
                  $resultSet = mysqli_fetch_assoc($result);
                  $res["numberoftrucks"] = $resultSet['ShowNUMBER_OF_TRUCKS'];
                  $res["weeklynut"] = $resultSet['ShowWEEKLY_NUT'];
                  $res["date_route"] = $DR;

                  for($i = 0; $i < 364; $i++){
                    $res["presentation_date" . $i] = $PD[$i];
                    $res["holiday" . $i] = $Holiday[$i];
                    $res["city" . $i] = $City[$i];
                    $res["repeat" . $i] = $Repeat[$i];
                    $res["mileage" . $i] = $Mileage[$i];
                    $res["book_notes" . $i] = $Book_notes[$i];
                    $res["prod_notes" . $i] = $Prod_notes[$i];
                    $res["time_zone" . $i] = $Time_zone[$i];
                    $res["show_times" . $i] = $Show_times[$i];
                    $res["perf" . $i] = $Perf[$i];
                    $res["venue" . $i] = $Venue[$i];
                    $res["presenter" . $i] = $Presenter[$i];
                    $res["capacity" . $i] = $Capacity[$i];
                    $res["fixed_gntee" . $i] = $Fixed_gntee[$i];
                    $res["royalty" . $i] = $Royalty[$i];
                    $res["backend" . $i] = $Backend[$i];
                    $res["breakeven" . $i] = $Breakeven[$i];
                    $res["deal_notes" . $i] = $Deal_notes[$i];
                    $res["est_royalty" . $i] = $Est_royalty[$i];
                    $res["on_sub" . $i] = $On_sub[$i];
                    $res["date_conf" . $i] = $Date_conf[$i];
                    $res["offer" . $i] = $Offer[$i];
                    $res["price_scales" . $i] = $Price_scales[$i];
                    $res["expenses" . $i] = $Expenses[$i];
                    $res["deal_memo" . $i] = $Deal_memo[$i];
                    $res["contract" . $i] = $Contract[$i];
                  }
                  include '../session.php';
				  $description = "Uploaded a new route for Show ID: ".$res["showtoroute"];
				  include '../security_log.php';
                  unlink($target_file); 
                  $data = array('status'=>'success', 'tp'=>$uploadOk, 'msg'=>'SpreadSheet Upload Successfully', 'result'=>$res);
                }
              }
            }
          }
        }

      } catch (Exception $e) {
        $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
      } finally {
        return $data;
      }
   }

   private static function checkFileSize($size){
      $res = array();
      // Check file size
      if ($size > 50000000) {
          $res["msg"] = "Sorry, your file is too large.";
          $res["ok"] = 0;
      }else{
         $res["msg"] = "Size permit's.";
         $res["ok"] = 1;
      }

      return $res;
   }

   private static function checkName($name_file){
      $res_name = array();

      $res_name["msg"] = $name_file;
      $res_name["ok"] = 1;

      return $res_name;
   } 
}
