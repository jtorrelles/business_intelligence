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
}

?>