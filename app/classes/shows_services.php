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
                  WHERE CategoryID_1 = $categoryId 
                  OR CategoryID_2 = $categoryId  
                  OR CategoryID_3 = $categoryId 
                  OR CategoryID_4 = $categoryId  
                  OR CategoryID_5 = $categoryId  
                  OR CategoryID_6 = $categoryId  
                  OR CategoryID_7 = $categoryId";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Shows not found.");
       }
       $res = array();
       while($resultSet = mysqli_fetch_assoc($result)) {
        $res[$resultSet['showid']] = $resultSet['showname'];
       }
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Shows By Category fetched successfully.", 'result'=>$res);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

}