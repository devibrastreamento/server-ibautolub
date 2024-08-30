<?php 
namespace app\model;
use mf\model\Model;
class Historico extends Model{
    private $fun;
    private $produto;
    private $qtd;
    private $data;
    private $cliente;
    private $chave;
    private $key_buy;
   
    public function __set($atr,$value){
        $this->$atr = $value;
    }
    public function __get($atr){
        return $this->$atr;
    }
    public function salvarHistorico($fun,$produto,$qtd,$data,$cliente,$chave,$tipo_venda,$key_buy){
        $sql = "INSERT INTO historico(id_funcionario,id_produto,qtd,data_compra,id_cliente,codigo_venda,tipo_venda,key_buy)
        VALUE(:id_funcionario,:id_produto,:qtd,:data_compra,:id_cliente,:codigo_venda,:tipo_venda,:key_buy)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id_funcionario',$fun);
        $stmt->bindValue(':id_produto',$produto);
        $stmt->bindValue(':qtd',$qtd);
        $stmt->bindValue(':data_compra',$data);
        $stmt->bindValue(':id_cliente',$cliente);
        $stmt->bindValue(':codigo_venda',$chave);
        $stmt->bindValue(':tipo_venda',$tipo_venda);
        $stmt->bindValue(':key_buy',$key_buy);
        $stmt->execute();

    }
  
    public function getProdutos($chave){
        $sql = "SELECT 
        p.id_produto,p.produto,p.preco,h.qtd,tb.nome as 'tipo_venda', c.nome 'cliente',f.nome 'fun'
        FROM historico h
        iNNER JOIN produtos p ON h.id_produto = p.id_produto
        INNER JOIN tb_venda tb ON tb.tipo_venda = h.tipo_venda
        INNER JOIN clientes c ON c.id_cliente = h.id_cliente
        INNER JOIN funcionario f ON f.id_funcionario = h.id_funcionario
        WHERE h.key_buy = '$chave'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    
    public function getRelatorioVendasPreView($inicial,$final){
        $sql = "SELECT distinct
                (SELECT SUM(p.preco)FROM produtos p LEFT JOIN historico h ON p.id_produto = h.id_produto WHERE h.data_compra between '$inicial' AND '$final' ) as 'total',
                (SELECT SUM(h.qtd) FROM produtos p LEFT JOIN historico h ON p.id_produto = h.id_produto WHERE p.tipo = 'produto' AND h.data_compra between '$inicial' AND '$final' ) as 'qtd_produtos',
                (SELECT SUM(h.qtd) FROM produtos p LEFT JOIN historico h ON p.id_produto = h.id_produto WHERE p.tipo = 'servico' AND h.data_compra between '$inicial' AND '$final' ) as 'qtd_servico'
                FROM historico";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getListReport($dt_inicial,$dt_final){
        $sql = "SELECT p.produto,p.preco,h.qtd,p.tipo FROM historico h
            INNER JOIN produtos p ON p.id_produto = h.id_produto
            WHERE h.data_compra between '$dt_inicial' AND '$dt_final'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getRelatorioServico($inicial,$final){
        $sql = "SELECT p.produto,h.qtd FROM historico h 
        INNER JOIN produtos p ON p.id_produto = h.id_produto
        WHERE p.tipo = 'servico' AND h.data_compra between '$inicial' AND '$final'
        ORDER BY h.qtd DESC LIMIT 1";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getTopFiveProduct($inicial,$final){
        $sql = "SELECT p.produto,h.qtd,p.preco FROM historico h 
        INNER JOIN produtos p ON p.id_produto = h.id_produto
        WHERE p.tipo = 'produto' AND h.data_compra between '$inicial' AND '$final'
        ORDER BY h.qtd DESC LIMIT 5";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;

    }
    public function getTopFiveService($inicial,$final){
        $sql = "SELECT p.produto,h.qtd,p.preco FROM historico h 
        INNER JOIN produtos p ON p.id_produto = h.id_produto
        WHERE p.tipo = 'servico' AND h.data_compra between '$inicial' AND '$final'
        ORDER BY h.qtd DESC LIMIT 5";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;

    }
    public function getTopFiveFun($id){
        $sql = "SELECT f.nome,count(v.id_funcionario) as 'qtd'
        FROM vendas v
        INNER JOIN funcionario f ON f.id_funcionario = v.id_funcionario
        WHERE v.id_funcionario = $id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;

    }
    public function recuperarQtdVendida($chave){
        $sql = "SELECT 
        p.id_produto,p.produto,h.qtd,p.qtd 'estoque',(p.qtd - h.qtd) 'result'
        FROM historico h
        iNNER JOIN produtos p ON h.id_produto = p.id_produto
        INNER JOIN tb_venda tb ON tb.tipo_venda = h.tipo_venda
        WHERE h.key_buy = '$chave'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
   
    
}


?>