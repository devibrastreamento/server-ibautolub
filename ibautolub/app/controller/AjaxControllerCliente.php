<?php 
namespace app\controller;
use mf\action\Action;
use mf\model\Container;

class AjaxControllerCliente extends Action{
    private $layout_ajax = 'layout_ajax';
   
   
    
    public function recuperarGastosCliente(){
        $this->verificarUsuarioLogado();  

        
        $id = base64_decode($_GET['id']);
        $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;
        $venda = Container::getModel('Vendas');
        $this->view->dados = $venda->getAllVendaCliente($id);
        if( $acao == 'pesquisa' ){
            
            $dt_inicial = $_GET['dt_inicial'];
            $dt_final = $_GET['dt_final'];
            $this->view->dados = $venda->getVendaData($id,$dt_inicial,$dt_final);
            
        }
        
        
        $this->render('resultado_cliente',$this->layout_ajax);
       
        
        
    }
    public function recuperarVeiculoCliente(){
        $this->verificarUsuarioLogado();  
        $id = $_GET['id'];
        $veiculo = Container::getModel('Veiculo');
        $this->view->dados = $veiculo->getVeiculo($id);
        $this->render('resulta_veiculos',$this->layout_ajax);
       
        
        
    }
    public function recuperarListagemProduto(){
        $this->verificarUsuarioLogado();  
        $produto = Container::getModel('Produto');
        $this->view->dados = $produto->listagemProdutoCliente();
        
        $this->render('resultado_listagem_itens',$this->layout_ajax);
       
        
        
    }
    public function verificarUsuarioLogado(){
        session_start();
        if( $_SESSION['client_login'] != 'S'){
            header('location:/app/client/fun?erro=login_invalido');

        }
    }
  
  
    
    
    
}


?>