<?php namespace app\Helpers;

/**
 * Yezz club - Dinamics GP Functions Helper
 *
 * CONFIGURACION DE SQL SERVER EN LINUX (VM Homestead)
 *   1) Iniciar vagrant (vagrant up)
 *   2) conectarse a la consola mediante ssh con el comando "vm". Primero debes configurar el comando vm con esto
 *   -> alias vm="ssh vagrant@127.0.0.1 -p 2222"
 *   3) ejecutar comando vm
 *   4) para estar seguro que los repositorios estan actualizados, ejecutar "sudo apt-get update"
 *   5) luego, ejecutar "sudo apt-get install php7.0-sybase"
 *   6) ejecutar comando "php -m" para crear pdo_dblib
 * @author  Julio Hernandez <juliohernandezs@gmail.com>
 * 
 */

class DinamicsGP {
    /**
     * get data by IMEI CODE
     * @return [void]
     *
     * @author  Julio Hernandez <juliohernandezs@gmail.com>
     */
    public static function getDataByImei($serial, $json = true) {
  
  		try {

        $data = null;
        if ($serial) {
          $db_ext = \DB::connection('sqlsrv');
        	$sql = "exec GA_FindSopSerialNumberPostVenta '$serial';";
          $result = $db_ext->select($sql);
          //Trim Result
          if (!$result) $data["ERROR"] = trans("globals.imei_not_registered_dinamicsgp");
          else $data = self::trim_array($result[0]);
        }
        else {
          $data["ERROR"] = trans("globals.imei_is_not_blank");
        }
        
        return ($json)?json_encode($data):$data;;

  		} catch (ModelNotFoundException $e) {
            throw new NotFoundHttpException();
        }
    }

    public static function trim_array(&$data)
    {
        $trimmed_array = [];
        if ($data) {
          foreach ($data as $key => $value) {
              $trimmed_array[$key] = trim($value);
          }
        }
        return $trimmed_array;
    }

}
