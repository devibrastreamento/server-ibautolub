<?php 

namespace app\model;
use mf\model\Model;

class Contas extends Model{
    private $id_conta;
    private $nome;
    private $valor;
    private $tipo;
    private $categoria;
    private $data_conta;
    private $obs;
    private $status_conta;

    public function __set($atr,$value){
        $this->$atr = $value;
    }
    public function __get($atr){
        return $this->$atr;
    }
    public function salvarReceita(){
        try{
            $sql = "INSERT INTO contas(nome,valor,tipo,categoria,data_conta,obs)VALUES(:nome,:valor,:tipo,:categoria,:data_conta,:obs)";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':nome',$this->__get('nome'));
            $stmt->bindValue(':valor',$this->__get('valor'));
            $stmt->bindValue(':tipo',$this->__get('tipo'));
            $stmt->bindValue(':categoria',$this->__get('categoria'));
            $stmt->bindValue(':data_conta',$this->__get('data_conta'));
            $stmt->bindValue(':obs',$this->__get('obs'));
            $stmt->execute();
            return true;
        }catch(\PDOException $e){
            echo $e->getMessage();
            return false;
        }

    }
    public function getAllContas(){
        $sql = "SELECT id_conta,nome,tipo,categoria,data_conta,obs,valor,status_conta FROM contas";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getAllContaDataDefault(){
        $sql = "SELECT distinct
        (SELECT COUNT(status_conta) 'ativo' FROM contas WHERE status_conta = 1) 'ativo_qtd',
        (SELECT COUNT(status_conta) 'ativo' FROM contas WHERE status_conta = 2) 'inativo_qtd',
        (SELECT SUM(valor) 'valor_pago' FROM contas WHERE status_conta = 2) 'valor_pago',
        (SELECT SUM(valor) 'valor_pago' FROM contas WHERE status_conta = 1 AND tipo='despesa') 'valor_nao_pago',
        (SELECT SUM(valor) 'Receita' FROM contas WHERE tipo='receita') 'receita'
        FROM contas";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getConta($id){
        $sql = "SELECT c.id_conta,c.nome,c.tipo,c.categoria,c.data_conta,c.obs,c.valor,c.cadastramento_data,tb.nome 'status'
        FROM contas c
        INNER JOIN tb_status tb ON tb.id_status = c.status_conta
        WHERE id_conta = $id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function despesaPaga($id){
        $sql = "UPDATE contas SET status_conta = 2 WHERE id_conta = $id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt;

    }
    public function despesaNaoPaga($id){
        $sql = "UPDATE contas SET status_conta = 1 WHERE id_conta = $id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt;

    }
    public function getAllContaData($inicial,$final){
        $sql = "SELECT id_conta,nome,tipo,categoria,data_conta,obs,valor,status_conta FROM contas
        WHERE data_conta BETWEEN '$inicial' AND '$final'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getAllContaDataApi($inicial,$final){
        $sql = "SELECT distinct
        (SELECT COUNT(status_conta) 'ativo' FROM contas WHERE data_conta BETWEEN '$inicial' AND '$final' AND status_conta = 1) 'ativo_qtd',
        (SELECT COUNT(status_conta) 'ativo' FROM contas WHERE  data_conta BETWEEN '$inicial' AND '$final' AND status_conta = 2) 'inativo_qtd',
        (SELECT SUM(valor) 'valor_pago' FROM contas WHERE  data_conta BETWEEN '$inicial' AND '$final'  AND status_conta = 2) 'valor_pago',
        (SELECT SUM(valor) 'valor_pago' FROM contas WHERE data_conta BETWEEN '$inicial' AND '$final' AND status_conta = 1 AND tipo='despesa') 'valor_nao_pago',
        (SELECT SUM(valor) 'Receita' FROM contas WHERE data_conta BETWEEN '$inicial' AND '$final' AND tipo='receita') 'receita'
        FROM contas ";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function pesquisarConta($nome){
        $sql = "SELECT c.id_conta,c.nome,c.tipo,c.categoria,c.data_conta,c.obs,c.valor,c.cadastramento_data,tb.nome 'status'
        FROM contas c
        INNER JOIN tb_status tb ON tb.id_status = c.status_conta
        WHERE c.nome LIKE '%$nome%'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function pesquisaContaStatus($tipo){
        $sql = "SELECT c.id_conta,c.nome,c.tipo,c.categoria,c.data_conta,c.obs,c.valor,c.cadastramento_data,tb.nome 'status'
        FROM contas c
        INNER JOIN tb_status tb ON tb.id_status = c.status_conta
        WHERE lower(tb.nome)  = '$tipo'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
  
}










?>