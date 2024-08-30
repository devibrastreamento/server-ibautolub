<?php 
namespace app\model;
use mf\model\Model;
class Vendas extends Model{
    private $id_venda;
    private $id_funcionario;
    private $id_cliente;
    private $data_venda;
    private $valor_recebido;
    private $troco;
    private $chave_venda;
    private $total;
    private $tipo_pagamento;
    private $tipo_venda;
    private $key_buy;
    

    public function __set($atr,$value){
        $this->$atr = $value;
    }
    public function __get($atr){
        return $this->$atr;
    }
    public function salvarDados(){
       try{
        $sql = "INSERT INTO vendas(id_funcionario,id_cliente,data_venda,valor_recebido,troco,chave_venda,total,tipo_pagamento,key_buy)
        VALUE(:id_funcionario,:id_cliente,:data_venda,:valor_recebido,:troco,:chave_venda,:total,:tipo_pagamento,:key_buy)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id_funcionario',$this->__get('id_funcionario'));
        $stmt->bindValue(':id_cliente',$this->__get('id_cliente'));
        $stmt->bindValue(':data_venda',$this->__get('data_venda'));
        $stmt->bindValue(':valor_recebido',$this->__get('valor_recebido'));
        $stmt->bindValue(':troco',$this->__get('troco'));
        $stmt->bindValue(':chave_venda',$this->__get('chave_venda'));
        $stmt->bindValue(':total',$this->__get('total'));
        $stmt->bindValue(':tipo_pagamento',$this->__get('tipo_pagamento'));
        $stmt->bindValue(':key_buy',$this->__get('key_buy'));
        $stmt->execute();
        header('location:/app/fun/imprimir_nota_nao_fiscal?key_buy='.$this->__get('key_buy'));
       }catch(\PDOException $e){
        header('location:/app/fun/erro?tipo=cadastrar_venda&msg='.$e->getMessage());
       }


    }
    public function salvarOrcamento(){
        try{
         $sql = "INSERT INTO vendas(id_funcionario,id_cliente,data_venda,chave_venda,total,key_buy)
         VALUE(:id_funcionario,:id_cliente,:data_venda,:chave_venda,:total,:key_buy)";
         $stmt = $this->conexao->prepare($sql);
         $stmt->bindValue(':id_funcionario',$this->__get('id_funcionario'));
         $stmt->bindValue(':id_cliente',$this->__get('id_cliente'));
         $stmt->bindValue(':data_venda',$this->__get('data_venda'));
         $stmt->bindValue(':chave_venda',$this->__get('chave_venda'));
         $stmt->bindValue(':total',$this->__get('total'));
         $stmt->bindValue(':key_buy',$this->__get('key_buy'));
         $stmt->execute();
         header('location:/app/fun/sucesso?tipo=cadastrar_orcamento');
        }catch(\PDOException $e){
            echo $e->getMessage();
         header('location:/app/fun/erro?tipo=cadastrar_orcamento&msg='.$e->getMessage());
        }
 
 
     }
    
    public function getAllVendaCliente($id){
        $sql = "SELECT id_venda,data_venda,total,chave_venda,key_buy,tipo_pagamento
        FROM vendas WHERE id_cliente = $id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getVenda($codigo){
        //id_funcionario,id_cliente,
        $sql = "SELECT id_venda,data_venda,total,chave_venda,key_buy
        FROM vendas WHERE chave_venda = '$codigo'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getVendaDetalhes($key){
        //id_funcionario,id_cliente,
        $sql = "SELECT v.valor_recebido,v.troco,t.nome 'nome_pg',v.total,c.nome,c.pontuacao,f.nome 'funcionario',v.chave_venda
        FROM vendas v 
        INNER JOIN clientes c ON c.id_cliente = v.id_cliente 
        LEFT JOIN tipo_pagamento t ON v.tipo_pagamento = t.id_tipo
        LEFT JOIN funcionario f ON v.id_funcionario = f.id_funcionario
        WHERE v.id_venda = $key";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getVendaDetalhesCliente($key){
        //id_funcionario,id_cliente,
        $sql = "SELECT v.valor_recebido,v.troco,t.nome 'nome_pg',v.total,c.nome,c.pontuacao,f.nome 'funcionario',v.chave_venda,tipo_pagamento
        FROM vendas v 
        INNER JOIN clientes c ON c.id_cliente = v.id_cliente 
        LEFT JOIN tipo_pagamento t ON v.tipo_pagamento = t.id_tipo
        LEFT JOIN funcionario f ON v.id_funcionario = f.id_funcionario
        WHERE v.key_buy = '$key'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getVendaData($id,$inicial,$final){
        $sql = "SELECT id_venda,data_venda,total,chave_venda,key_buy
        FROM vendas 
        WHERE data_venda between '$inicial' AND '$final'
        AND id_cliente = $id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function vendaEfetuadasTipo($dt_inicial,$dt_final){
        $sql = "SELECT distinct
        (SELECT  SUM(total) FROM vendas WHERE data_venda between '$dt_inicial 00:00:00' AND '$dt_final 00:00:00' AND tipo_pagamento = 1 ) 'dinheiro',
        (SELECT  SUM(total) FROM vendas WHERE data_venda between '$dt_inicial 00:00:00' AND '$dt_final 00:00:00' AND tipo_pagamento = 2 ) 'credito',
        (SELECT  SUM(total) FROM vendas WHERE data_venda between '$dt_inicial 00:00:00' AND '$dt_final 00:00:00' AND tipo_pagamento = 3 ) 'debito',
        (SELECT  SUM(total) FROM vendas WHERE data_venda between '$dt_inicial 00:00:00' AND '$dt_final 00:00:00' AND tipo_pagamento = 4 ) 'pix',
        (SELECT  SUM(total) FROM vendas WHERE data_venda between '$dt_inicial 00:00:00' AND '$dt_final 00:00:00' AND tipo_pagamento = 5 ) 'boleto'
        FROM vendas;";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function qtdItensVendioData($dt_inicial,$dt_final){
        $sql = "SELECT distinct
        (SELECT  COUNT(tipo_pagamento) FROM vendas WHERE data_venda between '$dt_inicial 00:00:00' AND '$dt_final 00:00:00' AND tipo_pagamento = 1 ) 'dinheiro',
        (SELECT   COUNT(tipo_pagamento)FROM vendas WHERE data_venda between '$dt_inicial 00:00:00' AND '$dt_final 00:00:00' AND tipo_pagamento = 2 ) 'credito',
        (SELECT   COUNT(tipo_pagamento) FROM vendas WHERE data_venda between '$dt_inicial 00:00:00' AND '$dt_final 00:00:00' AND tipo_pagamento = 3 ) 'debito',
        (SELECT   COUNT(tipo_pagamento) FROM vendas WHERE data_venda between '$dt_inicial 00:00:00' AND '$dt_final 00:00:00' AND tipo_pagamento = 4 ) 'pix',
        (SELECT   COUNT(tipo_pagamento) FROM vendas WHERE data_venda between '$dt_inicial 00:00:00' AND '$dt_final 00:00:00' AND tipo_pagamento = 5 ) 'boleto'
        FROM vendas;";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    
    public function qtdVenda($id){
        $sql = "SELECT f.nome,count(v.id_funcionario) 'qtd'
        FROM ibautolub.vendas v
        INNER JOIN funcionario f ON f.id_funcionario = v.id_funcionario
        WHERE v.id_funcionario = $id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getDataVendaAdm($incial,$final){
        $sql = "SELECT COUNT(id_venda) 'qtd_venda',SUM(total) 'total'
        FROM vendas
        WHERE data_venda between '$incial' AND '$final' AND tipo_pagamento ";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;
    }
    public function getAllVenda(){
        $sql = "SELECT c.nome 'cliente',f.nome 'funcionario',v.total,v.troco,v.valor_recebido,chave_venda,v.data_venda FROM vendas v
                INNER JOIN clientes c ON c.id_cliente = v.id_cliente
                INNER JOIN funcionario f ON f.id_funcionario = v.id_funcionario
                WHERE v.tipo_pagamento
                ";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $dados;         
    }
   
    
}


?>