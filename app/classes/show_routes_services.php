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
}