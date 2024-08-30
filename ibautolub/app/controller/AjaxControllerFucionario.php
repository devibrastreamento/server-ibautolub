<?php 
namespace app\controller;
use mf\action\Action;
use mf\model\Container;

class AjaxControllerFucionario extends Action{
    private $layout_ajax = 'layout_ajax';
   
    
    public function visualizarTabelProduto(){
        $this->verificarUsuarioLogado();
        $nome  = $_GET['produto'];
        $produto = Container::getModel('Produto');
        $this->view->dados = $produto->pesquisarProduto($nome);
         
   
       
        
        $this->render('resultado_produto',$this->layout_ajax);
    }
    public function listagemProdutosTabela(){
        $this->verificarUsuarioLogado();
        $id_cliente = $_GET['id_cliente'];
        $id_funcionario = $_SESSION['id_fun'];
        $datatime = date('Y-m-d H:m:s');
        $data = date('Y-m-d');
        $chave_venda = sha1('date='.$data.'/cliente='.$id_cliente.'/fun='.$id_funcionario);
        $listagem = Container::getModel('Listagem');
        $cliente = Container::getModel('Cliente');
        $dadosCliente = $cliente->getCliente($id_cliente);
        $this->view->cliente = [];
        $this->view->dados = $listagem->getProduto($chave_venda);
        $dados = $listagem->somarValor($chave_venda);
        $this->view->soma = 0;
        foreach($dados as $value){
            $this->view->soma = $value['soma'];
            
        }
        foreach($dadosCliente as $value){
            $this->view->cliente = $value['nome'];
        }
        if($this->view->soma == null){
            $this->view->soma = 0;
        }
        $this->render('tabela_produto',$this->layout_ajax);
    }
    public function consultaCompras(){
        $this->verificarUsuarioLogado();
        $codigo = $_GET['codigo'];
       
        $venda = Container::getModel('Vendas');
        
        $this->view->dados = $venda->getVenda($codigo);
        
        $this->render('resultado_consulta_venda',$this->layout_ajax);
    }
    public function consultarCliente(){
        $this->verificarUsuarioLogado();
       $nome = $_GET['cliente'];
       $cliente = Container::getModel('Cliente');
       $this->view->dados = $cliente->getClienteNome($nome);
        
       
       
        
        $this->render('client_search',$this->layout_ajax);
    }
    public function recuperarVeiculo(){
        $this->verificarUsuarioLogado();
        $id = $_GET['id'];
        $veiculo = Container::getModel('Veiculo');
        $this->view->dados = $veiculo->getVeiculo($id);
       
        $this->render('resulta_veiculos',$this->layout_ajax);
    }
    public function historicoVendaFuncionario()
    {
        $this->verificarUsuarioLogado();
        $venda = Container::getModel('Vendas');
        $this->view->dados = $venda->getAllVenda();
        $this->render('tabela_historico_vendas', $this->layout_ajax);
        
    }
    public function historicoTrocaFuncionario()
    {
        $this->verificarUsuarioLogado();
        $troca = Container::getModel('Troca');
        $this->view->dados = $troca->getAllTroca();
        $this->render('tabela_historico_troca', $this->layout_ajax);
        
    }
    public function listagemHistorico()
    {
        $this->verificarUsuarioLogado();
        
        $this->render('listagem_troca_produtos', $this->layout_ajax);
        
    }
    public function verificarUsuarioLogado(){
        session_start();
        if( $_SESSION['login_fun'] != 'S'){
            header('location:/app/login/fun?erro=login_invalido');

        }
    }
  
  
    
    
    
}


?>