<?php
/*
* Author: JTorrelles
* Website: ConnectIT
* Version: 0.1
* Date: 30-04-2018
* App Name: Business Intelligence
* Description: Clase de metodos basicos para modulo de reportes, esta a su vez hereda la clase de conexión
*/
require_once('../db/dbconfig.php');
class reports_basics extends dbconfig {
   
   public static $data;

   function __construct() {
     parent::__construct();
   }

   // Función para obtener todos los shows
   public static function getAllShows() {
     try {
       $query = "SELECT showid, showname, showactive, categoryid_1, categoryid_2, categoryid_3, categoryid_4,
						categoryid_5, categoryid_6, categoryid_7, showage, showweekly_nut, shownumber_of_cast,
						shownumber_of_musicians, shownumber_of_stagehands, shownumber_of_trucks, shownotes 
						FROM shows";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Shows not found.");
       }

       $data = array();
       $x = 0;

       while($resultSet = mysqli_fetch_assoc($result)) {
			$data[$x]["id"] = $resultSet['showid'];
			$data[$x]["name"] = $resultSet['showname'];
			$data[$x]["active"] = $resultSet['showactive'];
			$data[$x]["category1"] = $resultSet['categoryid_1'];
			$data[$x]["category2"] = $resultSet['categoryid_2'];
			$data[$x]["category3"] = $resultSet['categoryid_3'];
			$data[$x]["category4"] = $resultSet['categoryid_4'];
			$data[$x]["category5"] = $resultSet['categoryid_5'];
			$data[$x]["category6"] = $resultSet['categoryid_6'];
			$data[$x]["category7"] = $resultSet['categoryid_7'];
			$data[$x]["age"] = $resultSet['showage'];
			$data[$x]["weeklynut"] = $resultSet['showweekly_nut'];
			$data[$x]["numberofcast"] = $resultSet['shownumber_of_cast'];
			$data[$x]["musicians"] = $resultSet['shownumber_of_musicians'];
			$data[$x]["stagehands"] = $resultSet['shownumber_of_stagehands'];
			$data[$x]["numberoftrucks"] = $resultSet['shownumber_of_trucks'];
			$data[$x]["notes"] = $resultSet['shownotes'];
			$x++;
       }

       $res = array();
       //El resultado se asigna a un atributo general 'shows', para identificar los datos.
       $res['shows'] = $data; 

       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Shows fetched successfully.", 'result'=>$res);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }
}
?>