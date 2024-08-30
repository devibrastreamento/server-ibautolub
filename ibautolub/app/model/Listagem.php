<?php 
namespace app\model;
use mf\model\Model;

class Listagem extends Model{
    private $id_listagem_venda;
    private $id_funcionario;
    private $id_produto;
    private $chave_venda;
    private $id_cliente;
    private $qtd;
    private $data_compra;
   


    public function __set($atr,$value){
        $this->$atr = $value;
    }
    public function __get($atr){
        return $this->$atr;
    }
    public function salvarProduto(){
        try{
        $sql = "INSERT INTO listagem(id_funcionario,id_produto,chave_venda,id_cliente,qtd,data_compra)
        VALUE(:id_funcionario,:id_produto,:chave_venda,:id_cliente,:qtd,:data_compra)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id_funcionario',$this->__get('id_funcionario'));
        $stmt->bindValue(':id_produto',$this->__get('id_produto'));
        $stmt->bindValue(':chave_venda',$this->__get('chave_venda'));
        $stmt->bindValue(':id_cliente',$this->__get('id_cliente'));
        $stmt->bindValue(':qtd',$this->__get('qtd'));
        $stmt->bindValue(':data_compra',$this->__get('data_compra'));
        $stmt->execute();
        return true;
        }catch(\PDOException $e){
            $e->getMessage();
            return false;
        }

        
    }
    public function getProduto($chave){
        $sql = "SELECT l.chave_venda,l.id_listagem_venda,l.id_funcionario,l.id_produto,p.produto,p.preco,l.qtd
        FROM listagem l
        INNER JOIN produtos p ON p.id_produto = l.id_produto
        WHERE l.chave_venda = '$chave'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function somarValor($chave){
        $sql = "SELECT SUM((p.preco * l.qtd)) 'soma'
        FROM listagem l
        INNER JOIN produtos p ON p.id_produto = l.id_produto
        WHERE l.chave_venda = '$chave'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function excluirItem($id){
        $sql = "DELETE FROM listagem WHERE id_listagem_venda = $id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt;
        return $dados;
    }
    public function deletarRegistros($chave){
        $sql = "DELETE FROM listagem WHERE chave_venda = '$chave'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt;
        return $dados;
    }
    public function getProdutosChaveVenda($chave){
        $sql = "SELECT 
                l.qtd,p.produto
                FROM listagem l
                INNER JOIN produtos p ON l.id_produto = l.id_produto
                WHERE l.chave_venda = '$chave'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
}


?>