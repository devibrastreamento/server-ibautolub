<?php 
namespace app\controller;
use mf\action\Action;
use mf\model\Container;

class VendasController extends Action{
    private $layout_vendas = 'layout_vendas';
    private $layout_default = 'layout_default_vendas';
    private $layout_carr = 'layout_ajax_load_default_carr_fun';
    private $layout_impressao = 'layout_impressao';
    public function home(){
        $this->verificarUsuarioLogado();
    
        $this->render('home',$this->layout_vendas);
    }
    public function cadastroClientes(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome = base64_decode($_GET['n']);
        
       
        $this->render('cadastrar_cliente',$this->layout_default);
    }
    public function registrarVendas(){
        date_default_timezone_set('America/Manaus');
        $data = date('Y-m-d,H:i:s');
        
       
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =base64_decode($_GET['n']);
        $this->view->id_fun = $_SESSION['id_fun'];
        $cliente = Container::getModel('Cliente');
        $lsitagemPagameto = Container::getModel('Pagamento');
        $this->view->dados_pagamento = $lsitagemPagameto->listagemTipoPagamento();
        $this->view->dados_cliente = $cliente->getAllClientes();
        $this->render('registrar_venda',$this->layout_default);
       
    }
    public function buscarVendas(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =base64_decode($_GET['n']);
        $this->render('buscar_vendas',$this->layout_default);
       
    }
    public function detalheVendas(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =base64_decode($_GET['n']);
        $key = $_GET['key'];
        $chave = $_GET['chave'];
        $venda = Container::getModel('Vendas');
        $historico = Container::getModel('Historico');
        
        $dados = $venda->getVendaDetalhes($key);
        $this->view->his = $historico->getProdutos($chave);
        $this->view->dados = null;
        $dados_venda = $historico->getProdutos($chave);
        foreach($dados_venda as $value){
            $this->view->tipo_venda = $value['tipo_venda'];
        }
        foreach($dados as $value){
            $this->view->dados = $value;
        }
        
        $this->render('detalhe_vendas',$this->layout_default);
       
    }
    public function gerenciadorCadastroFuncionario(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =base64_decode($_GET['n']);
        $this->render('gerenciamento_produtos',$this->layout_default);
       
    }
    public function cadastrarProdutoFuncionario(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =base64_decode($_GET['n']);
        $this->render('adicionar_produto',$this->layout_default);
       
    }
    public function cadastrarServicoFuncionario(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =base64_decode($_GET['n']);
        $this->render('adicionar_servico',$this->layout_default);
       
    }
    public function managerClient(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =base64_decode($_GET['n']);
        $this->render('manager_client',$this->layout_default);
       
    }
    public function editarDadosCliente(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =base64_decode($_GET['n']);
        $cliente = Container::getModel('Cliente');
        $id = $_GET['id'];
        $dados = $cliente->getCliente($id);
        $this->view->dados = [];
        foreach($dados as $value){
            $this->view->dados = $value;
        }
        $this->render('editar_dados_cliente',$this->layout_default);
       
    }
    public function editarSenhaCliente(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =base64_decode($_GET['n']);
        $cliente = Container::getModel('Cliente');
        $id = $_GET['id'];
        $dados = $cliente->getCliente($id);
        $this->view->dados = [];
        foreach($dados as $value){
            $this->view->dados = $value;
        }
        $this->render('editar_senha_cliente',$this->layout_default);
       
    }
    public function addCarClient(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =base64_decode($_GET['n']);
        $this->view->id = $_GET['id'];
        $this->render('add_car_client',$this->layout_carr);
       
    }
    public function detalheVeiculoFuncionario(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =base64_decode($_GET['n']);
        $id_veiculo = $_GET['id'];
        $veiculo = Container::getModel('Veiculo');
        $dados  = $veiculo->getVeiculoDetalhe($id_veiculo);
        $this->view->dados= [];
        foreach($dados as $value){
            $this->view->dados = $value;
        }
        $this->render('detalhe_veiculo',$this->layout_carr);
       
    }
    public function imprimirDados(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome = "";
        $key_buy = $_GET['key_buy'];
        $historico = Container::getModel('Historico');
        $this->view->dados = $historico->getProdutos($key_buy);
        $this->view->cliente = "";
        $this->view->fun = "";
        foreach ($this->view->dados as $item) {
            $this->view->cliente = $item['cliente'];
            $this->view->fun = $item['fun'];
        }
        $this->render('imprimir_nota_nao_fiscal',$this->layout_impressao);
      
       
    }
    public function historicoVendasFuncionario(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome ="Histórico";
        $this->render('historico_vendas',$this->layout_default);
       
    }
    public function trocaDevolucao(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $clientes =  Container::getModel('Cliente');
        $produto =  Container::getModel('Produto');
        $this->view->produtos = $produto->listagemProduto();
        $this->view->dados_cliente = $clientes->getAllClientes();
        $this->view->nome ="Troca";
        $this->render('troca_devolucao',$this->layout_default);
       
    }
   
    public function verificarUsuarioLogado(){
        session_start();
        if( $_SESSION['login_fun'] != 'S'){
            header('location:/app/login/fun?erro=login_invalido');

        }
    }
    
  
    
    
    
}


?>