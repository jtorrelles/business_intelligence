<?php
/*
* Author: JTorrelles
* Project: BI
* Version: 0.1
* Date: 30-04-2018
* App Name: Business Intelligence
* Description: Clase que funciona Provee de Información las peticiones del route, 
                hereda de la clase de metodos basicos para modulo de reportes, que 
                a su vez hereda la conexion a la BD.
*/
require_once('reports_basics.php');
class reportsServices extends reports_basics {
   
   public static $data;

   function __construct() {
     parent::__construct();
   }

    //Funcion para obtener todos los shows
   public static function getShows(){
    try {

      $res = array();

      //Ejecución del Metodo getAllShows de la Clase Padre (basica)
      $res = reports_basics::getAllShows();

      if(!$res) {
        throw new exception("Data not found.");
      }

      //De la respuesta que es un array, en este caso solo se necesito el atributo 'result'
      $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Data fetched successfully.", 'result'=>$res['result']);

    } catch (Exception $e) {
      $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
    } finally {
      return $data;
    }
  }

  //Función para Reporte AllRoutes
  public static function getAllRoutes($finicio, $ffin){
    try{

      $res = array();

      //Ejecución del Metodo getAllShows de la Clase Padre (basica)
      $res = reports_basics::getAllShows();
      $shows = $res['result']['shows'];

      $UTC = new DateTimeZone("UTC"); 
      $ini = new DateTime($finicio, $UTC); 
      $end = new DateTime($ffin, $UTC); 

      $initdate = $ini->format('Ymd');
      $enddate = $end->format('Ymd');

      foreach ($shows as $show => $attrib){
          $showid = $attrib->id;
          $showname = $attrib->name;

          $query2 = "SELECT IFNULL((SELECT CONCAT(ci.name,'/',sta.name)
                               FROM cities ci, 
                                    states sta
                               WHERE ci.id = det.cityid
                                 AND ci.state_id = sta.id),'') as citystate 
                       FROM shows sh, routes ro, routes_det det 
                      WHERE sh.showid = ro.showid 
                        AND ro.routesid = det.routesid 
                        AND sh.showid = 4 
                        AND det.presentation_date BETWEEN '$initdate' AND '$enddate'";

          $result2 = reports_basics::run($query2);
          /*$result2 = reports_basics::run2($query2);*/
          if(!$result2) {
            throw new exception("City/State not found.");
          }

          //$json = mysqli_fetch_all ($result2, MYSQLI_ASSOC);

        }

      $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Data fetched successfully.", 'result'=>$shows);
    }catch (Exception $e) {
      $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
    } finally {
      return $data;
    }
  }
}

?>