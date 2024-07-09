<?php 
namespace app\model;
use mf\model\Model;


class Produto extends Model{
    private $id_produto;
    private $produto;
    private $data_cadastro;
    private $tipo;// se é serviço ou produto
    private $preco;
    private $codigo_barra;
    private $id_user;
    private $status_ativo;
    private $qtd;
    private $preco_compra;
    private $fornecedor;
    private $categoria;
    
    public function __set($atr,$value){
        $this->$atr = $value;
    }
    public function __get($atr){
        return $this->$atr;
    }
    public function salvarProduto(){
        try {
            $sql = "INSERT 
        INTO produtos(produto,data_cadastro,tipo,preco,codigo_barra,id_user,qtd,preco_compra,fornecedor,categoria)
        VALUE(:produto,:data_cadastro,:tipo,:preco,:codigo_barra,:id_user,:qtd,:preco_compra,:fornecedor,:categoria)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':produto',$this->__get('produto'));
        $stmt->bindValue(':data_cadastro',$this->__get('data_cadastro'));
        $stmt->bindValue(':tipo',$this->__get('tipo'));
        $stmt->bindValue(':preco',$this->__get('preco'));
        $stmt->bindValue(':codigo_barra',$this->__get('codigo_barra'));
        $stmt->bindValue(':id_user',$this->__get('id_user'));
        $stmt->bindValue(':qtd',$this->__get('qtd'));
        $stmt->bindValue(':preco_compra',$this->__get('preco_compra'));
        $stmt->bindValue(':fornecedor',$this->__get('fornecedor'));
        $stmt->bindValue(':categoria',$this->__get('categoria'));
        $stmt->execute();
        header('location:/app/adm/sucesso?tipo=cadastro_produto');
        } catch (\PDOException $e) {
            header('location:/app/adm/erro?tipo=cadastro_produto&msg='.$e->getMessage());
            #echo $e->getMessage();
        }
        
        
    }
    public function salvarServico(){
        try {
            $sql = "INSERT INTO produtos(produto,data_cadastro,tipo,preco,id_user)
            VALUE(:produto,:data_cadastro,:tipo,:preco,:id_user)";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':produto',$this->__get('produto'));
            $stmt->bindValue(':data_cadastro',$this->__get('data_cadastro'));
            $stmt->bindValue(':tipo',$this->__get('tipo'));
            $stmt->bindValue(':preco',$this->__get('preco'));
            $stmt->bindValue(':id_user',$this->__get('id_user'));
            $stmt->execute();
            header('location:/app/adm/sucesso?tipo=cadastro_servico');
        } catch (\PDOException $e) {
            header('location:/app/adm/erro?tipo=cadastro_servico&msg='.$e->getMessage());
            #echo $e->getMessage();
        }
    }
    public function listagemProduto(){
        $sql = "SELECT id_produto,produto 'produto',preco,status_ativo,tipo,qtd FROM produtos WHERE tipo = 'produto'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function listagemProdutoCliente(){
        $sql = "SELECT id_produto,produto 'produto',preco,status_ativo,tipo,qtd FROM produtos WHERE tipo = 'produto' AND status_ativo = 1";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getListPreviewEstoque($inicio,$fim){
        $sql="SELECT 
(SELECT SUM(qtd) FROM produtos WHERE tipo='produto') 'qtd_disponivel',
SUM(h.qtd) 'qtd_vendida',
(SUM(h.qtd)/30) 'media'
FROM historico h
INNER JOIN produtos p ON h.id_produto = p.id_produto
WHERE p.tipo = 'produto'
AND h.data_compra between '$inicio' AND '$fim'";
$stmt = $this->conexao->prepare($sql);
$stmt->execute();
$dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
return $dados;
    }
    public function listagemProdutoEstoque($inicio,$fim){
        $sql = "SELECT DISTINCT
            p.produto,p.preco,p.qtd 'estoque',h.qtd 'vendida'
            FROM produtos p
            INNER JOIN historico h ON h.id_produto = p.id_produto
            where p.tipo = 'produto' AND h.data_compra between '$inicio'  and '$fim'";
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute();
            $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $dados;
    }
    public function listagemServico(){
        $sql = "SELECT id_produto,produto 'servico',preco,status_ativo,tipo FROM produtos WHERE tipo = 'servico'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getProduto($id){
        $sql = "SELECT id_produto,produto,preco,fornecedor,codigo_barra,qtd,status_ativo,tipo,preco_compra,categoria
        FROM produtos 
        WHERE tipo = 'produto' AND id_produto = '$id'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getService($id){
        $sql = "SELECT id_produto,produto 'servico',preco,status_ativo,tipo 
        FROM produtos 
        WHERE tipo = 'servico' AND id_produto = '$id'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function atualizarProduto(){
        try {
            $sql = "UPDATE  produtos SET produto=:produto,preco=:preco,codigo_barra=:codigo_barra,
            qtd=:qtd,preco_compra=:preco_compra,fornecedor=:fornecedor,categoria=:categoria
            WHERE id_produto = :id";
             $stmt = $this->conexao->prepare($sql);
             $stmt->bindValue(':id',$this->__get('id_produto'));
             $stmt->bindValue(':produto',$this->__get('produto'));
             $stmt->bindValue(':preco',$this->__get('preco'));
             $stmt->bindValue(':codigo_barra',$this->__get('codigo_barra'));
             $stmt->bindValue(':qtd',$this->__get('qtd'));
             $stmt->bindValue(':preco_compra',$this->__get('preco_compra'));
             $stmt->bindValue(':fornecedor',$this->__get('fornecedor'));
             $stmt->bindValue(':categoria',$this->__get('categoria'));
             $stmt->execute();
             header('location:/app/adm/sucesso?tipo=atualizar_produto');
        } catch (\PDOException $e) {
            header('location:/app/adm/erro?tipo=atualizar_produto&msg='.$e->getMessage());
            echo $e->getMessage();
        }
    }
    public function atualizarServico(){
        try {
            $sql = "UPDATE produtos SET produto=:produto,preco=:preco WHERE id_produto = :id";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':id',$this->__get('id_produto'));
            $stmt->bindValue(':produto',$this->__get('produto'));
            $stmt->bindValue(':preco',$this->__get('preco'));
            $stmt->execute();
            header('location:/app/adm/sucesso?tipo=atualizar_servico');
        } catch (\PDOException $e) {
            header('location:/app/adm/erro?tipo=atualizar_servico&msg='.$e->getMessage());
            #echo $e->getMessage();
        }
    }
    public function getQtdTotal(){
        $sql = "SELECT distinct
        (SELECT COUNT(produto) FROM produtos WHERE status_ativo = 1 AND tipo='servico') 'qtd_ativo',
        (SELECT COUNT(produto) FROM produtos WHERE status_ativo = 2 AND tipo='servico') 'qtd_inativo',
        (SELECT COUNT(produto) FROM produtos WHERE tipo='servico') 'total'
        FROM produtos";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getQtdTotalProduto(){
        $sql = "SELECT distinct
        (SELECT COUNT(produto) FROM produtos WHERE status_ativo = 1 AND tipo='produto') 'qtd_ativo',
        (SELECT COUNT(produto) FROM produtos WHERE status_ativo = 2 AND tipo='produto') 'qtd_inativo',
        (SELECT COUNT(produto) FROM produtos WHERE tipo='produto') 'total'
        FROM produtos";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function ativarServico($id){
        $sql = "UPDATE produtos SET status_ativo = 1 WHERE id_produto = '$id'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function inativarServico($id){
        $sql = "UPDATE produtos SET status_ativo = 2 WHERE id_produto = '$id'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function ativarProduto($id){
        $sql = "UPDATE produtos SET status_ativo = 1 WHERE id_produto = '$id'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function inativarProduto($id){
        $sql = "UPDATE produtos SET status_ativo = 2 WHERE id_produto = '$id'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function pesquisarProduto($nome){
        $sql = "SELECT 
        p.id_produto,p.produto,p.id_user,p.preco,p.qtd,p.categoria,p.tipo,p.status_ativo
         FROM produtos p
        
         WHERE produto LIKE '%$nome%'
         AND status_ativo = 1";
         $stmt = $this->conexao->prepare($sql);
         $stmt->execute();
         $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
         return $dados;
    }
    public function pesquisarProdutoCadastrado($nome){
        $sql = "SELECT 
        p.id_produto,p.produto,p.id_user,p.preco,p.qtd,p.categoria,p.tipo,p.status_ativo
         FROM produtos p
        
         WHERE produto LIKE '%$nome%'
         AND tipo='produto'
         AND status_ativo = 1";
         $stmt = $this->conexao->prepare($sql);
         $stmt->execute();
         $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
         return $dados;
    }
    public function listagemItensRelatorio(){
        $sql = "SELECT distinct p.produto,p.qtd 'disponivel',h.qtd 'vendida' FROM historico h
        INNER JOIN produtos p ON h.id_produto = p.id_produto
        WHERE p.tipo = 'produto' ORDER BY h.qtd DESC";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;

    }
    public function atualizarQtdProduto($id,$qtd){
        try{
            $sql = "UPDATE produtos SET qtd=:qtd WHERE id_produto = :id";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':qtd',$qtd);
            $stmt->bindValue(':id',$id);
            $dados = $stmt->execute();
            return $dados;
        }catch(\PDOException $e){
            return false;
        }
    }
    public function atualizarDadosEstoque($id,$qtd){
        try{
            $sql = "UPDATE produtos SET qtd=$qtd WHERE id_produto = $id";
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute();
            return $stmt;
        }catch(\PDOException $e){
            return $e->getMessage();
        }
    }
}



?>