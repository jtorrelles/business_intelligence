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


   // Fetch all countries list
   public static function getFindData($contractID) {
     try {
       $query = "SELECT co.ContractID as contractID, 
                        sw.ShowID as contractSHOW_NAME,
                        pr.PresenterID as contractPRESENTER_NAME,
                        ve.VenueID as contractVENUE_NAME,
                        ci.id as contractCITYID, 
                        st.id as contractSTATEID, 
                        ci.`name` as contractCITY, 
                        st.`name` as contractSTATE, 
                        contractOPENING_DATE as OPENING,
                        contractCLOSING_DATE as CLOSING,
                        ContractNUMBER_OF_PERFORMANCES as PERFORMANCE,
                        ContractGROSS_POTENTIAL as GROSS,
                        ContractTAX as TAX,
                        ContractGUARANTEE as GUARANTEE,
                        ContractGROUP_COMISSION as GROUP_COM,
                        ContractSUBSCRIPTION_COMISSION as SUBSC_COM,
                        ContractPHONE_COMISSION as PHONE_COM,
                        ContractINTERNET_COMISSION as INT_COM,
                        ContractCREDIT_CARD_COMISSION as CC_COM,
                        ContractREMOTES_COMISSION as REM_COM,
                        ContractTOTAL_FIXED_EXPENSE as FIX_COM,  
                        ContractTOTAL_DOCUMENTED_EXPENSE as DOC_COM,  
                        ContractTOTAL_PRESENTER_EXPENSES  as PRE_COM
                    FROM contracts co, cities ci, states st, countries ct, shows sw, presenters pr, venues ve  
                    WHERE co.ContractID = $contractID  
                    AND co.showid = sw.ShowID 
                    AND co.ContractPRESENTERID = pr.PresenterID 
                    AND co.ContractVENUEID = ve.VenueID 
                    AND co.ContractCITYID = ci.id 
                    AND ci.state_id = st.id 
                    AND st.country_id = ct.id";

       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Contract not found.");
       }
       $res = array();

       $resultSet = mysqli_fetch_assoc($result);
       $res["contractid"] = $resultSet['contractID'];
       $res["showid"] = $resultSet['contractSHOW_NAME'];
       $res["presenterid"] = $resultSet['contractPRESENTER_NAME'];
       $res["venueid"] = $resultSet['contractVENUE_NAME'];
       $res["cityid"] = $resultSet['contractCITYID'];
       $res["stateid"] = $resultSet['contractSTATEID'];
       $res["cityname"] = $resultSet['contractCITY'];
       $res["statename"] = $resultSet['contractSTATE'];
       $res["opening_date"] = $resultSet['OPENING'];
       $res["closing_date"] = $resultSet['CLOSING'];
       $res["num_performances"] = $resultSet['PERFORMANCE'];
       $res["gross_potential"] = $resultSet['GROSS'];
       $res["tax"] = $resultSet['TAX'];
       $res["guarantee"] = $resultSet['GUARANTEE'];
       $res["group_com"] = $resultSet['GROUP_COM'];
       $res["subsc_com"] = $resultSet['SUBSC_COM'];
       $res["phone_com"] = $resultSet['PHONE_COM'];
       $res["int_com"] = $resultSet['INT_COM'];
       $res["cc_com"] = $resultSet['CC_COM'];
       $res["rem_com"] = $resultSet['REM_COM'];
       $res["fix_com"] = $resultSet['FIX_COM'];
       $res["doc_com"] = $resultSet['DOC_COM'];
       $res["pre_com"] = $resultSet['PRE_COM'];

       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Contract fetched successfully.", 'result'=>$res);
       
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }


}