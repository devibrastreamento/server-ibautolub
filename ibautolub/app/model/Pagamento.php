<?php 
namespace app\model;
use mf\model\Model;
class Pagamento extends Model{
    private $id_tipo;
    private $nome;

    public function __set($atr,$value){
        $this->$atr = $value;
    }
    public function __get($atr){
        return $this->$atr;
    }
    public function listagemTipoPagamento(){
        $sql = "SELECT id_tipo,nome FROM tipo_pagamento";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
        
    }
    
}


?>