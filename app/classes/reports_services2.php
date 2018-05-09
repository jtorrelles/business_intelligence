<?php
require_once('../db/dbconfig2.php');
class reportsServices extends dbconfig {
   
  public static $data;

  function __construct() {
    parent::__construct();
  }

  public static function getAllRoutes($inid,$endd){
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
        $ini = new DateTime($inid, $UTC); 
        $end = new DateTime($endd, $UTC); 
        $y = 0;

        while($end >= $ini) { 
          $showid = $resultSet['showid'];
          $date = $ini->format('Ymd');

          $query2 = "SELECT (SELECT CONCAT(ci.name,' , ',sta.shortname)
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

          $ini->add(new DateInterval('P1D'));          
          $y++;
        } 
        $x++;       
      }

      dbconfig::close();
      
      $res = array();      

      $res['head'] = $data; 
      $res['body'] = $data2; 

      $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Shows fetched successfully.", 'result'=>$res);

    }catch (Exception $e) {
      $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
    } finally {
      return $data;
    }
  }


  public static function getRoutesConf($inid,$endd){
    try {

      $UTC = new DateTimeZone("UTC"); 
      $ini = new DateTime($inid, $UTC); 
      $end = new DateTime($endd, $UTC); 

      $inid = $ini->format('Ymd');
      $endd = $end->format('Ymd'); 

      $query = "SELECT cityid, 
                       citysta
                  FROM (SELECT cityid, 
                               CONCAT(ci.name,' , ',sta.shortname) as citysta,
                               count(*) as count
                          FROM routes_det det, 
                               routes ro, 
                               cities ci, 
                               states sta
                         WHERE det.routesid = ro.routesid
                           AND ci.id = det.cityid
                           AND ci.state_id = sta.id
                           AND presentation_date >= $inid
                           AND presentation_date <= $endd
                           AND cityid IS NOT NULL
                         GROUP BY cityid) A 
                WHERE count > 1";

      $result = dbconfig::run($query);

      if(!$result) {
        throw new exception("Conflicts not found.");
      }
     
      $data = array();
      $x = 0;

      while($resultSet = mysqli_fetch_assoc($result)) { 
        $city = $resultSet['cityid'];
          
        $query2 = "SELECT ro.showid as showid,
                          showname,
                          presentation_date
                     FROM routes_det det, 
                          routes ro,
                          shows sh
                    WHERE det.routesid = ro.routesid
                      AND ro.showid = sh.showid
                      AND presentation_date >= $inid
                      AND presentation_date <= $endd
                      AND cityid = $city
                    GROUP BY ro.showid,
                             presentation_date";

        $result2 = dbconfig::run($query2);

        if(!$result2) {
          throw new exception("Conflicts not found.");
        }

        while($resultSet2 = mysqli_fetch_assoc($result2)) { 

          $showid = $resultSet2['showid'];
          $presentation_date = $resultSet2['presentation_date'];
          $inid2 = date("Ymd",strtotime($presentation_date."- 20 days"));
          $endd2 = date("Ymd",strtotime($presentation_date."+ 20 days"));

          $query3 = "SELECT showname,
                            presentation_date
                       FROM routes_det det, 
                            routes ro,
                            shows sh
                      WHERE det.routesid = ro.routesid
                        AND ro.showid = sh.showid
                        AND presentation_date >= $inid2
                        AND presentation_date <= $endd2
                        AND cityid = $city
                        AND ro.showid <> $showid
                      GROUP BY showname";

          $result3 = dbconfig::run($query3);

          if(!$result3) {
            throw new exception("Conflicts not found.");
          }  

          while($resultSet3 = mysqli_fetch_assoc($result3)) {
            $date1 = date("Ymd",strtotime($resultSet2['presentation_date']));
            $date2 = date("Ymd",strtotime($resultSet3['presentation_date']));
            $date2a = date("Ymd",strtotime($date2."- 1 days"));
            $date2b = date("Ymd",strtotime($date2."+ 1 days"));
            $data[$x]["citysta"] = $resultSet['citysta'];
            $data[$x]["showid1"] = $resultSet2['showname'];   
            $data[$x]["presentation_date1"] = $date1;
            $data[$x]["showid2"] = $resultSet3['showname']; 
            $data[$x]["presentation_date2"] = $date2;
            if ($date1 == $date2){
              $data[$x]["notes"] = 'SAME DATES';
            }else{
              if ($date1 == $date2a){
                $data[$x]["notes"] = 'BACK TO BACK';
              }else{
                if ($date1 == $date2b){
                  $data[$x]["notes"] = 'BACK TO BACK';
                }else{
                  $data[$x]["notes"] = 'DATES TOO CLOSE';
                }  
              }  
            }
            $x++; 
          }
        }
      }

      dbconfig::close();
      
      $res = array();      

      $res['body'] = $data; 

      $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Shows fetched successfully.", 'result'=>$res);

    }catch (Exception $e) {
      $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
    } finally {
      return $data;
    }
  }
}

?>