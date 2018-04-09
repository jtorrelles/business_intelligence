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
 
 // Fetch all countries list
   public static function getShows() {
     try {
       $query = "SELECT showid, showname FROM shows WHERE showactive = 'Y'";
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
   public static function getNUTOfShow($showID) {
     try {
        $query = "SELECT IFNULL(ShowWEEKLY_NUT,0) as ShowWEEKLY_NUT FROM shows WHERE ShowID = $showID";
        $result = dbconfig::run($query);
        
        if(!$result) {
          throw new exception("Show not found.");
        }

        $res = array();

        $resultSet = mysqli_fetch_assoc($result);
        $res["nut"] = $resultSet['ShowWEEKLY_NUT'];

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

       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Route fetched successfully.", 'result'=>$res);
       
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
                        rd.PRICE_SCALES, rd.EXPENSES, rd.DEAL_MEMO, rd.CONTRACT 
                  FROM routes_det rd
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
       $res["deal_nemo"] = $resultSet['DEAL_MEMO'];
       $res["contract"] = $resultSet['CONTRACT'];

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
        if($imageFileType != "xls" && $imageFileType != "xlsx" && 
          $imageFileType != "ods" && $imageFileType != "csv" ) {

            $message = "Sorry, only XLS, XLSX, ODS & CSV files are allowed.";
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

                  //Set up all the variables from the Excel Spreadsheet
                  $Showtoroute = $objPHPExcel->getSheet(1)->getCell('E1')->getValue();
                  $Showtorouteid = substr($Showtoroute,0,strpos($Showtoroute,"-"));
                  $Date_route = $objPHPExcel->getSheet(1)->getCell('R2')->getValue();
                  $DR = date($format = "Y-m-d", PHPExcel_Shared_Date::ExceltoPHP($Date_route));  
                  for($i = 0; $i < 364; $i++){
                    $id = 8 + $i;
                    $Presentation_date = $objPHPExcel->getSheet(1)->getCell("D".$id)->getValue();
                    $PD[$i] = date($format = "Y-m-d", PHPExcel_Shared_Date::ExceltoPHP($Presentation_date));  
                    $Holiday[$i] = $objPHPExcel->getSheet(1)->getCell("E".$id)->getValue();
                    $City[$i] = $objPHPExcel->getSheet(1)->getCell("F".$id)->getValue();
                    $Repeat[$i] = $objPHPExcel->getSheet(1)->getCell("H".$id)->getValue();
                    $Mileage[$i] = $objPHPExcel->getSheet(1)->getCell("I".$id)->getValue();
                    $Book_notes[$i] = $objPHPExcel->getSheet(1)->getCell("K".$id)->getValue();
                    $Prod_notes[$i] = $objPHPExcel->getSheet(1)->getCell("L".$id)->getValue();
                    $Time_zone[$i] = $objPHPExcel->getSheet(1)->getCell("N".$id)->getValue();
                    $Show_times[$i] = $objPHPExcel->getSheet(1)->getCell("O".$id)->getValue();
                  }   

                  //Free Memory
                  $objPHPExcel->disconnectWorksheets();
                  unset($objPHPExcel);

                  $res = array();

                  $res["showtorouteid"] = $Showtorouteid;
                  $res["showtoroute"] = substr($Showtoroute,strpos($Showtoroute,"-")+1);
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
                  }
                  

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