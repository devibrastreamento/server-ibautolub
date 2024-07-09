<?php 
namespace app\model;
use mf\model\Model;

class Troca extends Model{
    private $id_troca;
    private $nome_cliente;
    private $produto_antigo;
    private $produto_novo;
    private $diferenca;
    private $entrada;
    private $qtd;
    private $data_troca;
    private $funcionario;


    public function __set($atr,$value){
        $this->$atr = $value;
    }
    public function __get($atr){
        return $this->$atr;
    }
    public function salvarDadosTroca(){
       try{
        $sql = "INSERT INTO tb_troca(nome,produto_antigo,produto_novo,diferenca,valor_entrada,qtd,data_troca,funcionario)VALUES(:nome,:antigo,:novo,:diferenca,:valor,:qtd,:data_cadastro,:funcionario)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':nome',$this->__get('nome_cliente'));
        $stmt->bindValue(':antigo',$this->__get('produto_antigo'));
        $stmt->bindValue(':novo',$this->__get('produto_novo'));
        $stmt->bindValue(':diferenca',$this->__get('diferenca'));
        $stmt->bindValue(':valor',$this->__get('entrada'));
        $stmt->bindValue(':qtd',$this->__get('qtd'));
        $stmt->bindValue(':data_cadastro',$this->__get('data_troca'));
        $stmt->bindValue(':funcionario',$this->__get('funcionario'));
        $dados = $stmt->execute();
        return $dados;
       }catch(\PDOException $e){
        $date = date('Y-m-d h:i:s');
        $msg = "Erro ao realizar troca: ".$e->getMessage();
            $this->salvarDadosErro($this->__get('funcionario'),$this->__get('nome_cliente'),'troca',$msg,$date);
            return false;
       }

    }
    public function getAllTroca(){
        $sql = "SELECT id_troca,nome,produto_antigo,produto_novo,diferenca,valor_entrada,qtd,data_troca,funcionario FROM tb_troca" ;
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    
}