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
class contractsServices extends dbconfig {
   
   public static $data;
   function __construct() {
     parent::__construct();
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
   public static function getCityOfVenues($venueID) {
     try {
       $query = "SELECT s.`name` as statename, c.`name` as cityname, c.id as cityid 
                  FROM states s, cities c, venues ve 
                  WHERE ve.VenueID = $venueID 
                  AND ve.VenueCITYID = c.id 
                  AND c.state_id = s.id";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Cities not found.");
       }
       $res = array();

       $resultSet = mysqli_fetch_assoc($result);
       $res["statename"] = $resultSet['statename'];
       $res["cityname"] = $resultSet['cityname'];
       $res["cityid"] = $resultSet['cityid'];

       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Venues fetched successfully.", 'result'=>$res);
       
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

}