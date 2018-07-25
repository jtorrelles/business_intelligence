<?php
require_once('../db/dbconfig.php');
class contractsServices extends dbconfig {
   
   public static $data;
   function __construct() {
     parent::__construct();
   }
 
 // Fetch all countries list
   public static function getShows() {
     try {
       $query = "SELECT showid, showname FROM shows WHERE showactive = 'Y' ORDER BY showname ASC";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Show not found.");
       }
        $res = array();
        $x=0;

        while($resultSet = mysqli_fetch_assoc($result)) {
          $res[$x]["showid"] = $resultSet['showid'];
          $res[$x]["showname"] = $resultSet['showname'];
          $x++;       
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
       $query = "SELECT venueid, venuename FROM venues ORDER BY venuename ASC";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Venue not found.");
       }
        $res = array();
        $x=0;

        while($resultSet = mysqli_fetch_assoc($result)) {
          $res[$x]["venueid"] = $resultSet['venueid'];
          $res[$x]["venuename"] = $resultSet['venuename'];
          $x++;       
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
       $query = "SELECT presenterid, presentername FROM presenters ORDER BY presentername ASC";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Presenter not found.");
       }
        $res = array();
        $x=0;

        while($resultSet = mysqli_fetch_assoc($result)) {
          $res[$x]["presenterid"] = $resultSet['presenterid'];
          $res[$x]["presentername"] = $resultSet['presentername'];
          $x++;       
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
            						ContractVARIABLE_GUARANTEE as VARIABLE_GUARANTEE,
            						ContractPRODUCER_OVERAGES as PRODUCER_OVERAGES,
            						ContractSALES_TAX_1 as SALES_TAX_1,
            						ContractSALES_TAX_2 as SALES_TAX_2,
            						ContractFACILITY_FEES_1 as FACILITY_FEES_1,
            						ContractFACILITY_FEES_2 as FACILITY_FEES_2,
                        ContractGROUP_COMISSION as GROUP_COM,
                        ContractSUBSCRIPTION_COMISSION as SUBSC_COM,
                        ContractPHONE_COMISSION as PHONE_COM,
                        ContractINTERNET_COMISSION as INT_COM,
                        ContractCREDIT_CARD_COMISSION as CC_COM,
                        ContractREMOTES_COMISSION as REM_COM,
                        ContractTOTAL_FIXED_EXPENSE as FIX_COM,  
                        ContractTOTAL_DOCUMENTED_EXPENSE as DOC_COM,  
                        ContractTOTAL_PRESENTER_EXPENSES  as PRE_COM,
						            ContractNOTES as NOTES
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
  	   $res["variable_guarantee"] = $resultSet['VARIABLE_GUARANTEE'];
  	   $res["producer_overages"] = $resultSet['PRODUCER_OVERAGES'];
  	   $res["sales_tax_1"] = $resultSet['SALES_TAX_1'];
  	   $res["sales_tax_2"] = $resultSet['SALES_TAX_2'];
  	   $res["facility_fees_1"] = $resultSet['FACILITY_FEES_1'];
  	   $res["facility_fees_2"] = $resultSet['FACILITY_FEES_2'];
       $res["group_com"] = $resultSet['GROUP_COM'];
       $res["subsc_com"] = $resultSet['SUBSC_COM'];
       $res["phone_com"] = $resultSet['PHONE_COM'];
       $res["int_com"] = $resultSet['INT_COM'];
       $res["cc_com"] = $resultSet['CC_COM'];
       $res["rem_com"] = $resultSet['REM_COM'];
       $res["fix_com"] = $resultSet['FIX_COM'];
       $res["doc_com"] = $resultSet['DOC_COM'];
       $res["pre_com"] = $resultSet['PRE_COM'];
	   $res["notes"] = $resultSet['NOTES'];
	   
include '../session.php';
$description = "Accessed contract data for Show ID: ".$res['showid'].". The current data for this AD&T is: 
contractID: ".$res["contractid"].", 
contractSHOW_NAME: ".$res["showid"].", 
contractPRESENTER_NAME: ".$res["presenterid"].", 
contractVENUE_NAME: ".$res["venueid"].", 
contractCITYID: ".$res["cityid"].", 
contractSTATEID: ".$res["stateid"].", 
contractCITY: ".$res["cityname"].", 
contractSTATE: ".$res["statename"].", 
OPENING: ".$res["opening_date"].", 
CLOSING: ".$res["closing_date"].", 
PERFORMANCE: ".$res["num_performances"].", 
GROSS: ".$res["gross_potential"].", 
TAX: ".$res["tax"].", 
GUARANTEE: ".$res["guarantee"].", 
VARIABLE_GUARANTEE: ".$res["variable_guarantee"].", 
PRODUCER_OVERAGES: ".$res["producer_overages"].", 
SALES_TAX_1: ".$res["sales_tax_1"].", 
SALES_TAX_2: ".$res["sales_tax_2"].", 
FACILITY_FEES_1: ".$res["facility_fees_1"].", 
FACILITY_FEES_2: ".$res["facility_fees_2"].", 
GROUP_COM: ".$res["group_com"].", 
SUBSC_COM: ".$res["subsc_com"].", 
PHONE_COM: ".$res["phone_com"].", 
INT_COM: ".$res["int_com"].", 
CC_COM: ".$res["cc_com"].", 
REM_COM: ".$res["rem_com"].", 
FIX_COM: ".$res["fix_com"].", 
DOC_COM: ".$res["doc_com"].", 
PRE_COM: ".$res["pre_com"].", 
NOTES: ".$res["notes"];
include '../security_log.php';	   

       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Contract fetched successfully.", 'result'=>$res);
       
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }
}
?>
