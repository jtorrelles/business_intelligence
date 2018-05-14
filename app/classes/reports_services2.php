<?php
require_once('../db/dbconfig2.php');
class reportsServices extends dbconfig {
   
  public static $data;

  function __construct() {
    parent::__construct();
  }

  public static function getAllRoutes($inid,$endd,$country,$state,$city,$fields){
    try {

      if($fields==""){
        $shows = "";
      }else{
        $shows = "AND showid in ($fields)";
      }

      $query = "SELECT showid, 
                       showname
                  FROM shows
                 WHERE showactive = 'Y' 
                 $shows";

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
                                 AND ci.state_id = sta.id
                                 AND sta.country_id like ('$country')
                                 AND sta.id like ('$state')
                                 AND ci.id like ('$city')) as citystate 
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


  public static function getRoutesConf($inid,$endd,$country,$state,$city,$reason){
    try {

      $UTC = new DateTimeZone("UTC"); 
      $ini = new DateTime($inid, $UTC); 
      $end = new DateTime($endd, $UTC); 

      $inid = $ini->format('Ymd');
      $endd = $end->format('Ymd'); 

      $query = "SELECT cityid
                  FROM (SELECT cityid,
                               count(*) as count
                          FROM routes_det det
                         WHERE presentation_date >= $inid
                           AND presentation_date <= $endd
                           AND cityid IS NOT NULL                           
                           AND cityid like ('$city')
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
                          presentation_date,
                          DATE_FORMAT(presentation_date, '%M %d %Y') as format_date,
                          CONCAT(ci.name,' , ',sta.shortname) as citysta,
                          (SELECT venuename 
                             FROM venues ve
                            WHERE ve.venueid = det.venueid) as venue
                     FROM routes_det det, 
                          routes ro,
                          shows sh, 
                          cities ci, 
                          states sta
                    WHERE det.routesid = ro.routesid
                      AND ro.showid = sh.showid
                      AND presentation_date >= $inid
                      AND presentation_date <= $endd
                      AND ci.id = det.cityid
                      AND ci.state_id = sta.id
                      AND cityid = $city
                      AND sta.country_id like ('$country')
                      AND sta.id like ('$state')
                    GROUP BY ro.showid,
                             presentation_date
                    ORDER BY presentation_date,
                             ro.showid";

        $result2 = dbconfig::run($query2);

        if(!$result2) {
          throw new exception("Conflicts not found.");
        }

        $y = 0;
        $back = 0;

        while($resultSet2 = mysqli_fetch_assoc($result2)) { 
          $data[$x]["ind"] = $y; 

          if($y==0){            
            $showaux = $resultSet2['showname'];
            $dateaux = $resultSet2['presentation_date'];
            $fdateaux = $resultSet2['format_date'];
            $venueaux = $resultSet2['venue'];
          }else{            
            $data[$x]["show1"] = $showaux;
            $data[$x]["show2"] = $resultSet2['showname'];
            $data[$x]["date1"] = $fdateaux;
            $data[$x]["date2"] = $resultSet2['format_date'];
            $data[$x]["venue1"] = $venueaux;           
            $data[$x]["venue2"] = $resultSet2['venue'];
            $data[$x]["citysta"] = $resultSet2['citysta'];
            $date1 = date("Ymd",strtotime($dateaux));
            $date2 = date("Ymd",strtotime($resultSet2['presentation_date']));
            $date2a = date("Ymd",strtotime($date2."- 1 days"));
            $date2b = date("Ymd",strtotime($date2."+ 1 days"));
            if ($date1 == $date2){
              if ($venueaux == $resultSet2['venue']){
                $data[$x]["notes"] = 'DOUBLE HOLD';
                $data[$x]["color"] = '<font color ="#6C3483">';
              }else{
                $data[$x]["notes"] = 'OVERLAPPING MARKET HOLD';
                $data[$x]["color"] = '<font color ="#873600">';
              }
            }else{
              if ($date1 == $date2a){
                $data[$x]["notes"] = 'BACK TO BACK BOOKING';
                if ($back == 0){
                  $back = 1;
                  $data[$x]["color"] = '<font color ="#F39C12">';
                }else{
                  $data[$x]["color"] = '<font color ="#C0392B">';
                  $data[$x-1]["color"] = '<font color ="#C0392B">';
                }
              }else{
                $data[$x]["notes"] = 'PROXIMITY BOOKING';
                $data[$x]["color"] = '<font color ="#154360">';
              }  
            }
            $showaux = $resultSet2['showname'];
            $dateaux = $resultSet2['presentation_date'];
            $fdateaux = $resultSet2['format_date'];
            $venueaux = $resultSet2['venue'];
          }
          $y++;
          $x++;        
        }
      }

      dbconfig::close();
      
      $res = array();    

      $res['body'] = $data; 

      $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Conflicts fetched successfully.", 'result'=>$res);

    }catch (Exception $e) {
      $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
    } finally {
      return $data;
    }
  }


  public static function getMarketHistory($inid,$endd,$country,$state,$city,$fields){
    try {

      $UTC = new DateTimeZone("UTC"); 
      $ini = new DateTime($inid, $UTC); 
      $end = new DateTime($endd, $UTC); 
      $inid = $ini->format('Ymd');
      $endd = $end->format('Ymd'); 

      $data = array();
      $data2 = array();
      $x = 0;

      if($fields==""){
        $columns = "";
        $fields = "se.*";
      }else{
        $columns = "AND COLUMN_NAME in ($fields)";
      }

      $query = "SELECT column_name
                FROM information_schema.COLUMNS
                WHERE TABLE_SCHEMA  LIKE 'networksbi'
                    AND TABLE_NAME = 'settlements' 
                    AND COLUMN_NAME NOT IN ('ID','SHOWID','CITYID','VENUEID','OPENINGDATE','CLOSINGDATE')
                    $columns";

      $result = dbconfig::run($query);
      if(!$result) {
        throw new exception("Settlements not found.");
      }

      while($resultSet = mysqli_fetch_assoc($result)) {
        $data[$x]["column"] = $resultSet['column_name'];
        $x++;       
      }

      $fields = str_replace("'","",$fields);

      $query2 = "SELECT showname,
                        co.name as country,
                        sta.name as state,
                        ci.name as city,  
                        IFNULL(DATE_FORMAT(openingdate, '%M %d %Y'), '') as openingdate,
                        IFNULL(DATE_FORMAT(closingdate, '%M %d %Y'), '') as closingdate,
                        venuename,
                        $fields 
                   FROM settlements se, 
                        shows sh,
                        cities ci,
                        states sta,
                        countries co,
                        venues ve
                  WHERE se.showid = sh.showid
                    AND se.cityid = ci.id
                    AND ci.state_id = sta.id
                    AND sta.country_id = co.id
                    AND se.venueid = ve.venueid
                    AND openingdate >= $inid
                    AND openingdate <= $endd
                  ORDER BY openingdate desc";

      $result2 = dbconfig::run($query2);
      if(!$result2) {
        throw new exception("Settlements not found.");
      }

      $y = 0;
      
      while($resultSet2 = mysqli_fetch_assoc($result2)) {
        $data2[$y]['showname'] = $resultSet2['showname'];
        $data2[$y]['openingdate'] = $resultSet2['openingdate'];
        $data2[$y]['closingdate'] = $resultSet2['closingdate'];
        $data2[$y]['country'] = $resultSet2['country'];
        $data2[$y]['state'] = $resultSet2['state'];
        $data2[$y]['city'] = $resultSet2['city'];        
        $data2[$y]['venuename'] = $resultSet2['venuename'];
        $z = 0;
        while($z < $x) {
          $col = $data[$z]["column"];
          $data2[$y][$col] = $resultSet2[$col];
          $z++;       
        }        
        $y++;
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
}

?>