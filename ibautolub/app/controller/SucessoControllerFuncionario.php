<?php 
namespace app\controller;
use mf\action\Action;



class SucessoControllerFuncionario extends Action{
    private $layout_sucesso = 'layout_adm_sucesso';

    public function sucessoInfoFun(){
        $this->verificarUsuarioLogado();
        $tipo = $_GET['tipo'];
        $this->view->title = "";
        $this->view->msg = "";
        $this->view->link = "";
        if($tipo == 'cadastro_cliente'){
            $this->view->title = "Sucesso ao cadastrar";
            $this->view->msg = "Sucesso ao cadastrar Cliente";
            $this->view->link = "/app/fun/cadastrar_cliente?n=Q2FkYXN0cmFyIENsaWVudGU=&b=L2FwcC9mdW4vaG9tZQ==";
        }else if($tipo == 'cadastrar_venda'){
            $this->view->title = "Venda Finalizada";
            $this->view->msg = "Sucesso ao vender";
            $this->view->link = "/app/fun/venda?n=UmVnaXN0cmFyIFZlbmRhcw==&b=L2FwcC9mdW4vaG9tZQ==";
        }
        else if($tipo == 'editar_cadastro_cliente'){
            $this->view->title = "Cliente Atualizado";
            $this->view->msg = "Sucesso ao atualizar Cliente";
            $this->view->link = "/app/fun/manager_client?n=R2VyZW5jaWFyIENsaWVudGVz&b=L2FwcC9mdW4vaG9tZQ==";
        }
        else if($tipo == 'editar_senha_cliente'){
            $this->view->title = "Cliente Atualizado";
            $this->view->msg = "Sucesso ao atualizar Senha do Cliente";
            $this->view->link = "/app/fun/manager_client?n=R2VyZW5jaWFyIENsaWVudGVz&b=L2FwcC9mdW4vaG9tZQ==";
        }
        else if($tipo == 'cadastrar_orcamento'){
            $this->view->title = "Orçamento";
            $this->view->msg = "Orçamento salvo com sucesso";
            $this->view->link = "/app/fun/venda?n=UmVnaXN0cmFyIFZlbmRhcw==&b=L2FwcC9mdW4vaG9tZQ==";
        }
        $this->render('sucesso',$this->layout_sucesso);
    }
    
    public function verificarUsuarioLogado(){
        session_start();
        if( $_SESSION['login_fun'] != 'S'){
            header('location:/app/login/adm?erro=login_invalido');
      
        }
      }
   
  
  
    
    
    
}


?>