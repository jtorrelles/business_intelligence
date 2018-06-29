<?php
require_once('../db/dbconfig.php');
class showsServices extends dbconfig {
   
   public static $data;
   function __construct() {
     parent::__construct();
   }
 
 // Fetch all countries list
   public static function getByCategory($categoryId) {
     try {
       $query = "SELECT showid, showname 
                  FROM shows 
                  WHERE CategoryID_1 IN ($categoryId)  
                  OR CategoryID_2 IN ($categoryId)  
                  OR CategoryID_3 IN ($categoryId) 
                  OR CategoryID_4 IN ($categoryId)  
                  OR CategoryID_5 IN ($categoryId)   
                  OR CategoryID_6 IN ($categoryId)  
                  OR CategoryID_7 IN ($categoryId) 
                  ORDER BY showname ASC";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Shows not found.");
       }

        $res = array();
        $x=0;

        while($resultSet = mysqli_fetch_assoc($result)) {
          $res[$x]["showid"] = $resultSet['showid'];
          $res[$x]["showname"] = $resultSet['showname'];
          $x++;       
        } 
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Shows By Category fetched successfully.", 'result'=>$res);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

 // Fetch shows by status
   public static function getByStatus($status) {
     try {
       $query = "SELECT showid, showname 
                  FROM shows 
                  WHERE showactive LIKE ('$status') 
                  ORDER BY showname ASC";
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
}
?>
