<?php 
namespace mf\model;
use app\Connection;

abstract  class Container{
    public static function getModel($model){
        $class = "\\app\\model\\".$model;
        $db = Connection::getConexao();
        return new $class($db);
    }

}



?>