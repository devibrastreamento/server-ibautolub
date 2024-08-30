<?php 
namespace app\controller;
use mf\action\Action;



class ErroClientController extends Action{
    private $layout_sucesso = 'layout_adm_sucesso';

    public function erroClient(){
        $this->verificarUsuarioLogado();
        $tipo = $_GET['tipo'];
        $this->view->title = "";
        $this->view->msg = "";
        $msg = $_GET['msg'];
        $this->view->link = "";
        if($tipo == 'editar_cadastro_cliente'){
            $this->view->title = "Erro Cliente";
            $this->view->msg = "Erro 1 ".$msg;
            $this->view->link = "/app/client/manager_profile?n=R2VyZW5jaWFyIFBlcmZpbA==&b=L2FwcC9jbGllbnQvaG9tZQ==";
        }else if($tipo == 'editar_senha_cliente'){
            $this->view->title = "Erro Cliente";
            $this->view->msg = "Erro 2 ".$msg;
            $this->view->link = "/app/client/manager_profile?n=R2VyZW5jaWFyIFBlcmZpbA==&b=L2FwcC9jbGllbnQvaG9tZQ==";
        }
        $this->render('sucesso',$this->layout_sucesso);
    }
    
    public function verificarUsuarioLogado(){
        session_start();
        if( $_SESSION['client_login'] != 'S'){
            header('location:/app/login/client?erro=login_invalido');

        }
      }
   
  
  
    
    
    
}


?>