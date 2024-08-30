<?php 
namespace app\controller;
use mf\action\Action;




class ErroControllerFuncionario extends Action{
    private $layout_erro = 'layout_adm_erro';

    public function erroInfoFun(){
        $this->verificarUsuarioLogado();
        $tipo = $_GET['tipo'];
        $msg = $_GET['msg'];
        $this->view->title = "";
        $this->view->msg = "";
        $this->view->link = "";
        if($tipo == 'cadastro_cliente'){
            $this->view->title = "Erro Cadastro Cliente";
            $this->view->msg = "#Erro 1 ".$msg;
            $this->view->link = "/app/fun/cadastrar_cliente?n=Q2FkYXN0cmFyIENsaWVudGU=&b=L2FwcC9mdW4vaG9tZQ==";
        }else if($tipo == 'cadastrar_venda'){
            $this->view->title = "Erro ao Efetuar a venda";
            $this->view->msg = "#Erro 2 ".$msg;
            $this->view->link = "/app/fun/venda?n=UmVnaXN0cmFyIFZlbmRhcw==&b=L2FwcC9mdW4vaG9tZQ==";
        }
        else if($tipo == 'editar_cadastro_cliente'){
            $this->view->title = "Erro ao Atualizar CLiente";
            $this->view->msg = "#Erro 3 ".$msg;
            $this->view->link = "/app/fun/manager_client?n=R2VyZW5jaWFyIENsaWVudGVz&b=L2FwcC9mdW4vaG9tZQ==";
        }
        else if($tipo == 'editar_senha_cliente'){
            $this->view->title = "Erro ao Atualizar senha CLiente";
            $this->view->msg = "#Erro 4 ".$msg;
            $this->view->link = "/app/fun/manager_client?n=R2VyZW5jaWFyIENsaWVudGVz&b=L2FwcC9mdW4vaG9tZQ==";
        }
        $this->render('erro',$this->layout_erro);
    }
   
    public function verificarUsuarioLogado(){
        session_start();
        if( $_SESSION['login_fun'] != 'S'){
            header('location:/app/login/adm?erro=login_invalido');
      
        }
      }
  
    
    
    
}


?>