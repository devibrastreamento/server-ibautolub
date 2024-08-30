<?php 
namespace app\controller;
use mf\action\Action;



class SucessoClientController extends Action{
    private $layout_sucesso = 'layout_adm_sucesso';

    public function sucessoClient(){
        $this->verificarUsuarioLogado();
        $tipo = $_GET['tipo'];
        $this->view->title = "";
        $this->view->msg = "";
        $this->view->link = "";
        if($tipo == 'editar_cadastro_cliente'){
            $this->view->title = "Sucesso ao Atualizar";
            $this->view->msg = "Sucesso ao atualizar Cadastro";
            $this->view->link = "/app/client/manager_profile?n=R2VyZW5jaWFyIFBlcmZpbA==&b=L2FwcC9jbGllbnQvaG9tZQ==";
        }else if($tipo == 'editar_senha_cliente'){
            $this->view->title = "Sucesso ao Atualizar";
            $this->view->msg = "Sucesso ao atualizar Senha";
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