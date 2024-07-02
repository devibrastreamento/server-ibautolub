<?php 
namespace app;

class Connection{
    public static function getConexao(){
        try{
            $conexao = new \PDO('mysql:host=localhost;dbname=ibautolub','ibautolub','123456');
            return $conexao;
        }catch(\PDOException $e){
            echo $e->getMessage();
        }
    }
}


?>