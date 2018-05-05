<?php
require_once('../db/dbconfig2.php');
class reportsServices extends dbconfig {
   
  public static $data;

  function __construct() {
    parent::__construct();
  }

  public static function getAllRoutes($fini,$ffin){
    try {

      $query = "SELECT showid, 
                       showname
                  FROM shows";

      $result = dbconfig::run($query);
      if(!$result) {
        throw new exception("Shows not found.");
      }

      $data = array();
      $data2 = array();
      $x = 0;

      while($resultSet = mysqli_fetch_assoc($result)) {
        $showid = $resultSet['showid'];
        $data[$x]["id"] = $resultSet['showid'];
        $data[$x]["name"] = $resultSet['showname']; 

        $UTC = new DateTimeZone("UTC"); 
        $inic = new DateTime($fini, $UTC); 
        $fin = new DateTime($ffin, $UTC); 
        $y = 0;

        while($fin >= $inic) { 
          $showid = $resultSet['showid'];
          $date = $inic->format('Ymd');

          $query2 = "SELECT (SELECT CONCAT(ci.name,'/',sta.name)
                               FROM cities ci, 
                                    states sta
                               WHERE ci.id = det.cityid
                                 AND ci.state_id = sta.id) as citystate 
                       FROM shows sh, routes ro, routes_det det 
                      WHERE sh.showid = ro.showid 
                        AND ro.routesid = det.routesid 
                        AND sh.showid = $showid 
                        AND det.presentation_date = '$date'";       

          $result2 = dbconfig::run($query2);

          if(!$result2) {
            throw new exception("City/State not found.");
          }

          $resultSet2 = mysqli_fetch_assoc($result2);
          if(empty($resultSet2['citystate'])){
            $data2[$x][$y]["citystate"] = '';
          }else{
            $data2[$x][$y]["citystate"] = $resultSet2['citystate'];
          } 

          $inic->add(new DateInterval('P1D'));          
          $y++;
        } 
        $x++;       
      }

      dbconfig::close();
      
      $res = array();      

      $res['shows'] = $data; 
      $res['body'] = $data2; 

      $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Shows fetched successfully.", 'result'=>$res);

    }catch (Exception $e) {
      $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
    } finally {
      return $data;
    }
  }
}

?>