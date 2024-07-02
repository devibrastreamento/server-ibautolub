<?php 
namespace app\controller;
use mf\action\Action;
use mf\model\Container;

class ClientController extends Action{
    private $layout_client = 'layout_client';
    private $layout_default = 'layout_default_cliente';
    private $layout_ajax_cliente_load = 'layout_ajax_load_default';
    private $layout_ajax_cliente_carr = 'layout_ajax_load_default_carr';
    private $layout_ajax_listagem_produto = 'layout_ajax_listagem_produto';
    public function homeClient(){
        $this->verificarUsuarioLogado();
        echo 'ola';
        $this->render('home',$this->layout_client);
    }
    public function agendamentoCliente(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =   base64_decode($_GET['n']);;
        $this->render('agendamento',$this->layout_default);
    }
    public function historicoCompras(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =   base64_decode($_GET['n']);
        $this->render('history',$this->layout_ajax_cliente_load);
        
    }
    public function detalheVendaCliente(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =   base64_decode($_GET['n']);
        $key = $_GET['id'];
        $chave = $_GET['key'];
        $venda = Container::getModel('Vendas');
        $historico = Container::getModel('Historico');
        
        $dados = $venda->getVendaDetalhesCliente($chave);
        $this->view->his = $historico->getProdutos($chave);
        $this->view->dados = null;
        
        foreach($dados as $value){
            $this->view->dados = $value;
        }
        $this->render('detalhe_vendas',$this->layout_ajax_cliente_load);
   

        
    }
    public function adicionarVeiculo(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =   base64_decode($_GET['n']);
        $this->view->id = $_SESSION['id_client'];
        
        $this->render('add_car',$this->layout_ajax_cliente_carr);
   

        
    }
    public function detalheVeiculo(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =   base64_decode($_GET['n']);
        $id_veiculo = $_GET['id'];
        $veiculo = Container::getModel('Veiculo');
        $dados  = $veiculo->getVeiculoDetalhe($id_veiculo);
        $this->view->dados= [];
        foreach($dados as $value){
            $this->view->dados = $value;
        }
        $this->render('detalhe_veiculo',$this->layout_default);
   

        
    }
    public function listagemProdutosCliente(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =   base64_decode($_GET['n']);

        $this->render('listagem_produtos',$this->layout_ajax_listagem_produto);
   

        
    }
    public function gerenciamentoPerfil(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome =   base64_decode($_GET['n']);
        $cliente = Container::getModel('Cliente');
        $dados = $cliente->getCliente($_SESSION['id_client']);
        $this->view->dados = [];
        foreach($dados as $value){
            $this->view->dados = $value;
        }
        $this->view->id = $_SESSION['id_client'];
        $this->render('profile',$this->layout_default);

   

        
    }
    
    public function verificarUsuarioLogado(){
        session_start();
        if( $_SESSION['client_login'] != 'S'){
            header('location:/app/login/client?erro=login_invalido');

        }
    }
}


?>