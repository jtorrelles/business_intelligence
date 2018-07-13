<?php
require_once("../db/dbconfig.php");
class venuesServices extends dbconfig {
   
   public static $data;
   function __construct() {
     parent::__construct();
   }
 
 // Fetch all countries list
   public static function getCountries() {
     try {
       $query = "SELECT id, name FROM countries ORDER BY name ASC";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Country not found.");
       }
        $res = array();
        $x=0;

        while($resultSet = mysqli_fetch_assoc($result)) {
          $res[$x]["id"] = $resultSet['id'];
          $res[$x]["name"] = $resultSet['name'];
          $x++;       
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
       $query = "SELECT id, name FROM states WHERE country_id=$countryId ORDER BY name ASC";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("State not found.");
       }
        $res = array();
        $x=0;

        while($resultSet = mysqli_fetch_assoc($result)) {
          $res[$x]["id"] = $resultSet['id'];
          $res[$x]["name"] = $resultSet['name'];
          $x++;       
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
       $query = "SELECT id, name FROM cities WHERE state_id=$stateId ORDER BY name ASC";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("City not found.");
       }
        $res = array();
        $x=0;

        while($resultSet = mysqli_fetch_assoc($result)) {
          $res[$x]["id"] = $resultSet['id'];
          $res[$x]["name"] = $resultSet['name'];
          $x++;       
        }
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Cities fetched successfully.", 'result'=>$res);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }   

   // Fetch all states list by country id
  public static function getVenues($stateId) {
     try {
       $query = "SELECT venueid, venuename 
                 FROM venues ve, cities ci, states st 
                 WHERE st.id = ci.state_id 
                 AND ci.id = ve.venuecityid
                 AND st.id = $stateId 
                 ORDER BY venuename ASC";

       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Venues not found.");
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

  public static function getVenuesByStatus($status) {
     try {
       $query = "SELECT venueid, venuename 
                 FROM venues 
                 WHERE venueactive LIKE ('$status') 
                 ORDER BY venuename ASC";
       /*$query = "SELECT venueid, venuename 
                 FROM venues ve, cities ci, states st 
                 WHERE st.id = ci.state_id 
                 AND ci.id = ve.venuecityid
                 AND st.id = $stateId 
                 ORDER BY venuename ASC";*/

       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Venues not found.");
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

      // Fetch all states list by country id
  public static function getVenuesFilter($countryId, $stateId, $cityId) {

     try {
                
            if($countryId != 0){
              $filter = "AND co.id IN ($countryId)";
            }
            if($cityId != 0){
              $filter = "AND ci.id IN ($cityId)";
            }
            if($stateId != 0){
              $filter = "AND st.id IN ($stateId)";
            }

      $query = "SELECT venueid, venuename 
                FROM venues ve, countries co, cities ci, states st 
                WHERE co.id = st.country_id 
                AND st.id = ci.state_id
                AND ci.id = ve.venuecityid 
                $filter";

       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Venues not found.");
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

   public static function getDataVenues($venueId){
      try {
       $query = "SELECT venueid, venuename, venueaddress_1, venueaddress_2,
                        ci.id as venuecity, st.id as venuestate,
                        venuezip, ct.id as venuecountry, venuephone,
                        venuefax, venueemail, venuenotes, venueactive
                 FROM venues ve, cities ci, states st, countries ct 
                 WHERE ve.venuecityid = ci.id 
                 AND ci.state_id = st.id 
                 AND st.country_id = ct.id 
                 AND ve.venueid = ".$venueId;

       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Venues not found.");
       }

       $res = array();

       $resultSet = mysqli_fetch_assoc($result);
       $res["id"] = $resultSet['venueid'];
       $res["name"] = $resultSet['venuename'];
       $res["address_1"] = $resultSet['venueaddress_1'];
       $res["address_2"] = $resultSet['venueaddress_2'];
       $res["city"] = $resultSet['venuecity'];
       $res["state"] = $resultSet['venuestate'];
       $res["country"] = $resultSet['venuecountry'];
       $res["zip"] = $resultSet['venuezip'];
       $res["phone"] = $resultSet['venuephone'];
       $res["fax"] = $resultSet['venuefax'];
       $res["email"] = $resultSet['venueemail'];
       $res["notes"] = $resultSet['venuenotes'];
       $res["active"] = $resultSet['venueactive'];
	   
	   include '../session.php';
	   $description = "Accessed venue data for: ".$res["name"].". Current data is: 
	   venueaddress_1: ".$res["address_1"].", 
	   venueaddress_2: ".$res["address_2"].", 
	   venuecity: ".$res["city"].", 
	   venuestate: ".$res["state"].", 
	   venuecountry: ".$res["country"].", 
	   venuezip: ".$res["zip"].", 
	   venuephone: ".$res["phone"].", 
	   venuefax: ".$res["fax"].", 
	   venueemail: ".$res["email"].", 
	   venuenotes: ".$res["notes"].", 
	   venueactive: ".$res["active"];
	   include '../security_log.php';

       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Venues fetched successfully.", 'result'=>$res);

     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }
}
?>
