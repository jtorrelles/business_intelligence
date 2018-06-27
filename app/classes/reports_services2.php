<?php
require_once('../db/dbconfig2.php');
class reportsServices extends dbconfig {
   
  public static $data;

  function __construct() {
    parent::__construct();
  }

  public static function getAllRoutes($inid,$endd,$country,$state,$city,$fields,$weekending){
    try {

      if($fields==""){
        $shows = "";
      }else{
        $shows = "AND showid in ($fields)";
      }

      if($weekending==0){
        $sunday = "";
      }else{
        $sunday = "AND DAYOFWEEK(presentation_date) = 1";
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
      $UTC = new DateTimeZone("UTC"); 
      $ini = new DateTime($inid, $UTC); 
      $end = new DateTime($endd, $UTC);
      $inid = $ini->format('Ymd');
      $endd = $end->format('Ymd');
      $x = 0;          

      while($resultSet = mysqli_fetch_assoc($result)){
        $showid = $resultSet['showid'];
        $data[$x]["id"] = $resultSet['showid'];
        $data[$x]["name"] = $resultSet['showname'];

        $ini = new DateTime($inid, $UTC); 
        $y = 0;
        while($end >= $ini) { 
          $data2[$x][$y]["citystate"] = '';
          $ini->add(new DateInterval('P1D'));          
          $y++;
        } 

        $query2 = "SELECT (SELECT IFNULL(CONCAT(ci.name,', ',sta.shortname), '') 
                             FROM cities ci, 
                                states sta
                            WHERE ci.id = det.cityid
                              AND ci.state_id = sta.id
                              AND sta.country_id like ('$country')
                              AND sta.id like ('$state')
                              AND ci.id like ('$city')) as citystate,
                              det.presentation_date as presentation_date,
                              IFNULL(DATE_FORMAT(det.presentation_date, '%Y%m%d'), '') as fpresentation_date
                     FROM shows sh, routes ro, routes_det det 
                    WHERE sh.showid = ro.showid 
                      AND ro.routesid = det.routesid 
                      AND sh.showid = $showid 
                      AND det.presentation_date >= $inid
                      AND det.presentation_date <= $endd
                      AND det.cityid IS NOT NULL
                      $sunday
                      ORDER BY det.presentation_date";

        $result2 = dbconfig::run($query2);

        if(!$result2) {
          throw new exception("City/State not found.");
        }

        while($resultSet2 = mysqli_fetch_assoc($result2)){ 
          $ini = new DateTime($inid, $UTC); 
          $y = 0;
          while($end >= $ini) {
            $date = $ini->format('Ymd'); 
            if($date==$resultSet2['fpresentation_date']){
              if($resultSet2['citystate']!=null){
                $data2[$x][$y]["citystate"] = $resultSet2['citystate'];
              }  
            }
            $ini->add(new DateInterval('P1D'));          
            $y++;
          } 
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

      $query = "SELECT cityid,
                       name
                  FROM(SELECT cityid,
                              name,
                              count(*) as count
                         FROM (SELECT cityid,
                                      showid,
                                      name
                                 FROM routes_det det,
                                      routes ro,
                                      cities ci
                                WHERE det.routesid = ro.routesid
                                  AND det.cityid = ci.id
                                  AND presentation_date >= $inid
                                  AND presentation_date <= $endd
                                  AND cityid IS NOT NULL                           
                                  AND cityid like ('$city')
                                GROUP BY cityid,showid,name) A
                        GROUP BY cityid,name) B
                 WHERE count > 1
                 ORDER BY name";

      $result = dbconfig::run($query);

      if(!$result) {
        throw new exception("Conflicts not found.");
      }
     
      $data = array();
      $x = 0;

      while($resultSet = mysqli_fetch_assoc($result)) { 
        $city = $resultSet['cityid'];            
          
        $query2 = "SELECT ro.showid as showid,
                          ro.routesid as routesid,
                          showname,
                          min(presentation_date) as datemin,
                          max(presentation_date) as datemax,
                          DATE_FORMAT(min(presentation_date), '%m/%d/%Y') as fdatemin,
                          DATE_FORMAT(max(presentation_date), '%m/%d/%Y') as fdatemax,
                          CONCAT(ci.name,', ',sta.shortname) as citysta,
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
                             ro.routesid
                    ORDER BY 4,1";

        $result2 = dbconfig::run($query2);

        if(!$result2) {
          throw new exception("Conflicts not found.");
        }

        $y = 0;
        $back = 0;

        while($resultSet2 = mysqli_fetch_assoc($result2)) { 
          $data[$x]["ind1"] = 0; 
          $data[$x]["ind2"] = 0;

          if($y==0){            
            $show1 = $resultSet2['showname'];
            $datemax1 = $resultSet2['datemax'];
            $fdatemin1 = $resultSet2['fdatemin'];
            $fdatemax1 = $resultSet2['fdatemax'];
            $venue1 = $resultSet2['venue'];
          }else{ 
            $datetime1 = new DateTime($datemax1);
            $datetime2 = new DateTime($resultSet2['datemin']);
            $interval = $datetime1->diff($datetime2);
            
            if($interval->format('%R%a')<=26){
              $data[$x]["ind1"] = 1;
              $data[$x]["show1"] = $show1;
              $data[$x]["show2"] = $resultSet2['showname'];
              $data[$x]["show3"] = '';
              $data[$x]["show4"] = '';
              $data[$x]["show5"] = '';              
              $data[$x]["datevenue1"] = $fdatemin1 . ' - ' . 
                                        $fdatemax1 . '<br>' . 
                                        $venue1;
              $data[$x]["datevenue2"] = $resultSet2['fdatemin'] . ' - ' . 
                                        $resultSet2['fdatemax'] . '<br>' .
                                        $resultSet2['venue'];
              $data[$x]["datevenue3"] = '';
              $data[$x]["datevenue4"] = '';
              $data[$x]["datevenue5"] = '';
              $data[$x]["citysta"] = $resultSet2['citysta'];
              if ($interval->format('%R%a')<=0){
                if ($venue1 == $resultSet2['venue']){
                  $data[$x]["notes"] = 'DOUBLE HOLD';
                  $data[$x]["color"] = '<font color ="#6C3483">';
                }else{
                  $data[$x]["notes"] = 'OVERLAPPING MARKET HOLD';
                  $data[$x]["color"] = '<font color ="#873600">';
                }
              }else{
                if($interval->format('%R%a')<=2 ){
                  $data[$x]["notes"] = 'BACK TO BACK BOOKING';
                  $data[$x]["ind2"] = 1; 
                  if ($back == 0){
                    $back = 1;
                    $data[$x]["color"] = '<font color ="#F39C12">';
                  }else{
                    $data[$x]["notes"] = 'BACK TO BACK TO BACK';
                    $data[$x-1]["notes"] = 'BACK TO BACK TO BACK';
                    $data[$x]["color"] = '<font color ="#C0392B">';
                    $data[$x-1]["color"] = '<font color ="#C0392B">';
                    $data[$x-1]["show3"] = $resultSet2['showname'];
                    $data[$x-2]["show4"] = $resultSet2['showname'];
                    $data[$x-3]["show5"] = $resultSet2['showname'];
                    $data[$x-1]["datevenue3"] = $resultSet2['fdatemin'] . ' - ' . 
                                              $resultSet2['fdatemax'] . '<br>' .
                                              $resultSet2['venue'];
                    $data[$x-2]["datevenue4"] = $resultSet2['fdatemin'] . ' - ' . 
                                              $resultSet2['fdatemax'] . '<br>' .
                                              $resultSet2['venue'];
                    $data[$x-3]["datevenue5"] = $resultSet2['fdatemin'] . ' - ' . 
                                              $resultSet2['fdatemax'] . '<br>' .
                                              $resultSet2['venue'];                  
                    $data[$x]["ind1"] = 0;     
                  }
                }else{
                  $data[$x]["notes"] = 'PROXIMITY BOOKING';
                  $data[$x]["color"] = '<font color ="#154360">';
                }  
              }
              $show1 = $resultSet2['showname'];
              $datemax1 = $resultSet2['datemax'];
              $fdatemin1 = $resultSet2['fdatemin'];
              $fdatemax1 = $resultSet2['fdatemax'];
              $venue1 = $resultSet2['venue'];              
            }  
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

  public static function getMarketHistory($inid,$endd,$presenters,$parentpresenters,$country,$state,$city,$fields,$shows,$venues){
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
        $columns = "'%XYZ%'";
      }else{       
        $columns = $fields;
        $fields = "," . $fields;
        $fields = str_replace("'","",$fields);
      } 

      if($shows==""){
        $shows = "";
      }else{
        $shows = "AND se.showid in ($shows) ";
      }

      if($venues==""){
        $venues = "";
      }else{
        $venues = "AND se.venueid in ($venues) ";
      }
    
      if($presenters==""){
        $presenters = "";
      }else{
        $presenters = "AND se.presenterid in ($presenters) ";
      }

      if($parentpresenters==""){
        $parentpresenters = "";
      }else{
        $parentpresenters = "AND pr.presenterparent_company like '$parentpresenters' ";
      }	  

      $query = "SELECT column_name
                FROM information_schema.COLUMNS
                WHERE TABLE_SCHEMA  LIKE 'networksbi'
                    AND TABLE_NAME = 'settlements' 
                    AND COLUMN_NAME in ($columns)";

      $result = dbconfig::run($query);
      if(!$result) {
        throw new exception("Settlements not found.");
      }

      while($resultSet = mysqli_fetch_assoc($result)) {
        $data[$x]["column"] = $resultSet['column_name'];
        $x++;       
      }

      $query2 = "SELECT showname,
                        sta.name as state,
                        ci.name as city,  
                        openingdate,
                        closingdate,
                        pr.presentername,
                        IFNULL(DATE_FORMAT(openingdate, '%m/%d/%Y'), '') as fopeningdate,
                        IFNULL(DATE_FORMAT(closingdate, '%m/%d/%Y'), '') as fclosingdate,
                        venuename
                        $fields 
                   FROM settlements se, 
                        shows sh,
                        presenters pr,
                        cities ci,
                        states sta,
                        countries co,
                        venues ve
                  WHERE se.showid = sh.showid
                    AND se.PresenterID = pr.PresenterID
                    AND se.cityid = ci.id
                    AND ci.state_id = sta.id
                    AND sta.country_id = co.id
                    AND se.venueid = ve.venueid
                    AND sta.country_id like ('$country')
                    AND sta.id like ('$state')
                    AND ci.id like ('$city')
                    AND openingdate >= $inid
                    AND openingdate <= $endd
                    $shows $venues $presenters $parentpresenters
                  ORDER BY openingdate DESC";

      $result2 = dbconfig::run($query2);
      if(!$result2) {
        throw new exception("Settlements not found.");
      }

      $y = 0;
      
      while($resultSet2 = mysqli_fetch_assoc($result2)) {
        $data2[$y]['showname'] = $resultSet2['showname'];
        $data2[$y]['openingdate'] = $resultSet2['fopeningdate'];
        $data2[$y]['closingdate'] = $resultSet2['fclosingdate'];
        $data2[$y]['presentername'] = $resultSet2['presentername'];
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

      $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Settlements fetched successfully.", 'result'=>$res);      

    }catch (Exception $e) {
      $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
    } finally {
      return $data;
    }
  }

  public static function getSalesSummary($inid,$endd,$country,$state,$city,$fields,$shows){
    try {

      $UTC = new DateTimeZone("UTC"); 
      $ini = new DateTime($inid, $UTC); 
      $end = new DateTime($endd, $UTC); 
      $inid = $ini->format('Ymd');
      $endd = $end->format('Ymd'); 

      $data = array();
      $x = 0;

      if($shows==""){
        $shows = "";
      }else{
        $shows = "AND se.showid in ($shows) ";
      }

      $query = "SELECT showname,
                       sta.name as state,
                       ci.name as city,  
                       IFNULL(DATE_FORMAT(openingdate, '%m/%d/%Y'), '') as openingdate,
                       IFNULL(DATE_FORMAT(closingdate, '%m/%d/%Y'), '') as closingdate,
                       numberofperformances as perf,
                       grossboxofficepotential as gp,
                       grosssubscriptionsales as ss,
                       grossgroupsales1 as gs,
                       singletixamount as st,
                       advertisingactual as ad
                  FROM settlements se, 
                        shows sh,
                        cities ci,
                        states sta,
                        countries co
                 WHERE se.showid = sh.showid
                   AND se.cityid = ci.id
                   AND ci.state_id = sta.id
                   AND sta.country_id = co.id
                   AND sta.country_id like ('$country')
                   AND sta.id like ('$state')
                   AND ci.id like ('$city')
                   AND openingdate >= $inid
                   AND openingdate <= $endd
                   $shows
                 ORDER BY openingdate desc";

      $result = dbconfig::run($query);
      if(!$result) {
        throw new exception("Settlements not found.");
      }

      while($resultSet = mysqli_fetch_assoc($result)) {
        $data[$x]["showname"] = $resultSet['showname'];
        $data[$x]["openingdate"] = $resultSet['openingdate'];
        $data[$x]["closingdate"] = $resultSet['closingdate'];
        $data[$x]["state"] = $resultSet['state'];
        $data[$x]["city"] = $resultSet['city'];
        $data[$x]["perf"] = $resultSet['perf'];
        $data[$x]["gp"] = $resultSet['gp'];
        $data[$x]["ss"] = $resultSet['ss'];
        $data[$x]["gs"] = $resultSet['gs'];
        $data[$x]["st"] = $resultSet['st'];
        $data[$x]["ad"] = $resultSet['ad'];
        $x++;       
      }      

      dbconfig::close();
      
      $res = array();      

      $res['body'] = $data; 

      $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Settlements fetched successfully.", 'result'=>$res);      

    }catch (Exception $e) {
      $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
    } finally {
      return $data;
    }
  }

  public static function getPlayedMarkets($inid,$endd,$country,$state,$city,$shows){
    try {

      $UTC = new DateTimeZone("UTC"); 
      $ini = new DateTime($inid, $UTC); 
      $end = new DateTime($endd, $UTC); 
      $inid = $ini->format('Ymd');
      $endd = $end->format('Ymd'); 

      $data = array();
      $data2 = array();
      $data3 = array();
      $x = 0;

      if($shows!=""){
        $shows = "AND showid in ($shows)";
      } 

      $query = "SELECT showid, 
                       showname
                  FROM shows
                 WHERE showactive in ('Y','N')
                 $shows";

      $result = dbconfig::run($query);
      if(!$result) {
        throw new exception("Shows not found.");
      }      

      while($resultSet = mysqli_fetch_assoc($result)){
        $showid = $resultSet['showid'];
        $data[$x]["id"] = $resultSet['showid'];
        $data[$x]["name"] = $resultSet['showname'];
        $x++;       
      }

      $query2 = "SELECT ci.name as city,  
                        sta.name as state,
                        ci.id as cityid,
                        showid,
                        openingdate,
                        closingdate,
                        IFNULL(DATE_FORMAT(openingdate, '%m/%d/%Y'), '') as fopeningdate,
                        IFNULL(DATE_FORMAT(closingdate, '%m/%d/%Y'), '') as fclosingdate
                   FROM settlements se,
                        cities ci,
                        states sta,
                        countries co
                  WHERE se.cityid = ci.id
                    AND ci.state_id = sta.id
                    AND sta.country_id = co.id
                    AND sta.country_id like ('$country')
                    AND sta.id like ('$state')
                    AND ci.id like ('$city')
                    AND openingdate >= $inid
                    AND openingdate <= $endd
                    $shows
                  GROUP BY ci.name,  
                          sta.name,
                          ci.id,
                          showid,
                          openingdate,
                          closingdate
                  ORDER BY ci.name,  
                          sta.name,
                          showid,
                          openingdate,
                          closingdate";

      $result2 = dbconfig::run($query2);
      if(!$result2) {
        throw new exception("Settlements not found.");
      }    

      $y = 0;
      while($resultSet2 = mysqli_fetch_assoc($result2)){ 
        $daterange = $resultSet2['fopeningdate'] . " - " . $resultSet2['fclosingdate'] . ";";
        if($cityaux!=$resultSet2['city']){
          $data2[$y]['city'] = $resultSet2['city'];
          $data2[$y]['state'] = $resultSet2['state'];
          $a = 0;
          while($a<$x){
            if($resultSet2['showid']==$data[$a]["id"]){
              $data3[$y][$a]['daterange'] = $daterange;
            }else{
              $data3[$y][$a]['daterange'] = '';
            }$a++;
          }$y++;
        }else{          
          $a = 0;
          while($a<$x){
            if($resultSet2['showid']==$data[$a]["id"]){
              if(empty($data3[$y-1][$a]['daterange'])){
                $data3[$y-1][$a]['daterange'] = $daterange;
              }else{
                $data3[$y-1][$a]['daterange'] = $data3[$y-1][$a]['daterange'] . '</br>' .$daterange;
              }
            }else{
              $data3[$y][$a]['daterange'] = '';
            }$a++;
          }  
        }
        $cityaux = $resultSet2['city'];     
      }        
      
      dbconfig::close();
      
      $res = array();      

      $res['head'] = $data; 
      $res['cbody'] = $data2;
      $res['ebody'] = $data3; 

      $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Shows fetched successfully.", 'result'=>$res);

    }catch (Exception $e) {
      $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
    } finally {
      return $data;
    }
  }
}

?>