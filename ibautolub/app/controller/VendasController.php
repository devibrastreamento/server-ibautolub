<?php 
namespace app\controller;
use mf\action\Action;
use mf\model\Container;

class VendasController extends Action{
    private $layout_vendas = 'layout_vendas';
    private $layout_default = 'layout_default_vendas';
    private $layout_carr = 'layout_ajax_load_default_carr_fun';
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
   
   
    public function verificarUsuarioLogado(){
        session_start();
        if( $_SESSION['login_fun'] != 'S'){
            header('location:/app/login/fun?erro=login_invalido');

        }
    }
    
  
    
    
    
}


?>