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
class categoriesServices extends dbconfig {
   
   public static $data;
   function __construct() {
     parent::__construct();
   }
 
 // Fetch all countries list
   public static function getCategories() {
     try {
       $query = "SELECT categoryid, categoryname FROM category";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Category not found.");
       }
       $res = array();
       while($resultSet = mysqli_fetch_assoc($result)) {
        $res[$resultSet['categoryid']] = $resultSet['categoryname'];
       }
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Categories fetched successfully.", 'result'=>$res);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

}