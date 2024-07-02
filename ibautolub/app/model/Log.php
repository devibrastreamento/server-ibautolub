<?php 
namespace app\model;
use mf\model\Model;

class Log extends Model{
    private $id_log;
    private $autor;
    private $receptor;
    private $tipo;
    private $msg;
    private $data_cadastro;
    public function __set($atr,$value){
        $this->$atr = $value;
    }
    public function __get($atr){
        return $this->$atr;
    }
    public function salvarALteracaoSistema(){
       try{
        $sql = "INSERT INTO tb_log(autor,receptor,tipo,msg,data_cadastro)VALUES(:autor,:receptor,:tipo,:msg,:data_cadastro)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':autor',$this->__get('autor'));
        $stmt->bindValue(':receptor',$this->__get('receptor'));
        $stmt->bindValue(':tipo',$this->__get('tipo'));
        $stmt->bindValue(':msg',$this->__get('msg'));
        $stmt->bindValue(':data_cadastro',$this->__get('data_cadastro'));
        $stmt->execute();
       }catch(\PDOException $e){
        print_r($e->getMessage());
       }
    }
    public function listagemEventoSistema(){
        $sql = "SELECT autor,receptor,tipo,msg,data_cadastro FROM tb_log";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function listagemErroSistema(){
        $sql = "SELECT autor,receptor,tipo,msg,data_cadastro FROM tb_log WHERE tipo='erro'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    
    


}