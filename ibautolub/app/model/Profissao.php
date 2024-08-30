<?php 
namespace app\model;

use mf\model\Model;
class Profissao extends Model{

   private $id_profissao;
   private $nome_profissao;

   public function __set($atr,$value){
    $this->$atr = $value;
   }
   public function __get($atr){
    return $this->$atr;
   }
   public function salvar(){
     try{
      $sql = "INSERT INTO profissao(nome_profissao) VALUE(:nome)";
      $stmt = $this->conexao->prepare($sql);
      $stmt->bindValue('nome',$this->__get('nome_profissao'));
      $stmt->execute();
      header('location:/app/adm/sucesso?tipo=profissao');
     }catch(\PDOException $e){
      header('location:/app/adm/erro?tipo=profissao&msg='.$e->getMessage());
         echo $e->getMessage();
     }

   }
   public function getAllProfissao(){
    $sql = "SELECT id_profissao,nome_profissao FROM profissao WHERE status_funcao = 1";
    $stmt =$this->conexao->prepare($sql);
    $stmt->execute();
    $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $dados;
   }
   public function desativarProfissao($id){
      $sql = "UPDATE profissao SET status_funcao = 0 WHERE id_profissao = $id";
      $stmt = $this->conexao->prepare($sql);
      $stmt->execute();
      return $stmt;
     
    
   }
   public function ativarProfissao($id){
      $sql = "UPDATE profissao SET status_funcao = 1 WHERE id_profissao = $id";
      $stmt =$this->conexao->prepare($sql);
      $stmt->execute();
     
    
   }
}


?>