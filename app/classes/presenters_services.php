<?php
/*
* Author: Rohit Kumar
* Website: iamrohit.in
* Version: 0.0.1
* Date: 25-04-2015
* App Name: Php+ajax country state city dropdown
* Description: A simple oops based php and ajax country state city dropdown list
*/
require_once("../db/dbconfig.php");
class presenterServices extends dbconfig {
   
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

  public static function getPresenters($stateId) {
     try {
       $query = "SELECT pe.PresenterID, pe.PresenterNAME  
                  FROM presenters pe, cities ci, states st 
                  WHERE st.id = ci.state_id 
                  AND ci.id = pe.PresenterCITYID 
                  AND pe.PresenterACTIVE = 'Y' 
                  AND st.id =".$stateId;

       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Presenters not found.");
       }
       $res = array();
       while($resultSet = mysqli_fetch_assoc($result)) {
        $res[$resultSet['PresenterID']] = $resultSet['PresenterNAME'];
       }
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Presenters fetched successfully.", 'result'=>$res);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

  public static function getDataPresenters($presenterId){
      try {
       $query = "SELECT PresenterID, PresenterNAME, PresenterPARENT_COMPANY, PresenterADDRESS_1, PresenterADDRESS_2,
                  ci.id as presentercity, st.id as presenterstate,
                  PresenterZIP, ct.id as presentercountry, PresenterPHONE,
                  PresenterFAX, PresenterEMAIL, PresenterNOTES, PresenterACTIVE, 
                  PresenterPHONE_EXT, PresenterCONTACT_NAME 
                FROM presenters pe, cities ci, states st, countries ct 
                WHERE pe.PresenterCITYID = ci.id 
                AND ci.state_id = st.id 
                AND st.country_id = ct.id 
                AND pe.PresenterID = ".$presenterId;

       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Presenter not found.");
       }

       $res = array();

       $resultSet = mysqli_fetch_assoc($result);
       $res["id"] = $resultSet['PresenterID'];
       $res["name"] = $resultSet['PresenterNAME'];
	     $res["parentcompany"] = $resultSet['PresenterPARENT_COMPANY'];
       $res["address_1"] = $resultSet['PresenterADDRESS_1'];
       $res["address_2"] = $resultSet['PresenterADDRESS_2'];
       $res["city"] = $resultSet['presentercity'];
       $res["state"] = $resultSet['presenterstate'];
       $res["country"] = $resultSet['presentercountry'];
       $res["zip"] = $resultSet['PresenterZIP'];
       $res["phone"] = $resultSet['PresenterPHONE'];
       $res["fax"] = $resultSet['PresenterFAX'];
       $res["email"] = $resultSet['PresenterEMAIL'];
       $res["notes"] = $resultSet['PresenterNOTES'];
       $res["active"] = $resultSet['PresenterACTIVE'];
       $res["phoneext"] = $resultSet['PresenterPHONE_EXT'];
       $res["contactname"] = $resultSet['PresenterCONTACT_NAME'];
       

       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Presenters fetched successfully.", 'result'=>$res);

     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

}