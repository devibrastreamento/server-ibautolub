<?php 
namespace app\controller;
use mf\action\Action;




class ErroController extends Action{
    private $layout_erro = 'layout_adm_erro';

    public function erroInfo(){
        $this->verificarUsuarioLogado();
        $tipo = $_GET['tipo'];
        $msg = $_GET['msg'];
        $this->view->title = "";
        $this->view->msg = "";
        $this->view->link = "";
        if($tipo == 'profissao'){
            $this->view->title = "Erro Cadastro Profissao";
            $this->view->msg = "#Erro 1 ".$msg;
            $this->view->link = "/app/adm/form_add_funcao?n=Tm92bw==&b=L2FwcC9hZG0vaG9tZQ==";
        }else if($tipo == 'cadastro_adm'){
            $this->view->title = "Erro Cadastro ADM";
            $this->view->msg = "#Erro 2 ".$msg;
            $this->view->link = "/app/adm/form_add_adm?n=Tm92byBBZG0=&b=L2FwcC9hZG0vaG9tZQ==";

        }
        else if($tipo == 'cadastro_funcionario'){
            $this->view->title = "Erro Cadastro Fun";
            $this->view->msg = "#Erro 3 ".$msg;
            $this->view->link = "/app/adm/cadastro_usuario?n=R2VyZW5jaW1lbnRv&b=L2FwcC9hZG0vaG9tZQ==";

        }
        else if($tipo == 'atualizacao_funcionario'){
            $this->view->title = "Erro Atualização Fun";
            $this->view->msg = "#Erro 4 ".$msg;
            $this->view->link = "/app/adm/cadastro_usuario?n=R2VyZW5jaW1lbnRv&b=L2FwcC9hZG0vaG9tZQ==";

        }
        else if($tipo == 'cadastro_produto'){
            $this->view->title = "Erro Cadastro Produto";
            $this->view->msg = "#Erro 5 ".$msg;
            $this->view->link = "/app/adm/manager_product?n=R2VyZW5jaW1lbnRv&b=L2FwcC9hZG0vaG9tZQ==";

        }
        else if($tipo == 'cadastro_servico'){
            $this->view->title = "Erro Cadastro Serviço";
            $this->view->msg = "#Erro 6 ".$msg;
            $this->view->link = "/app/adm/manager_product?n=R2VyZW5jaW1lbnRv&b=L2FwcC9hZG0vaG9tZQ==";

        }
        else if($tipo == 'atualizar_servico'){
            $this->view->title = "Erro ao Atualizar Serviço";
            $this->view->msg = "#Erro 7 ".$msg;
            $this->view->link = "/app/adm/manager_view?n=R2VyZW5jaWFtZW50byBHZXJlYWw=&b=L2FwcC9hZG0vaG9tZQ==";
        }
        else if($tipo == 'atualizar_produto'){
            $this->view->title = "Erro Atualizar Produto";
            $this->view->msg = "#Erro 8 ".$msg;
            $this->view->link = "/app/adm/manager_view?n=R2VyZW5jaWFtZW50byBHZXJlYWw=&b=L2FwcC9hZG0vaG9tZQ==";
        }
        else if($tipo == 'atualizar_adm'){
            $this->view->title = "Erro Atualizar Adm";
            $this->view->msg = "#Erro 9 ".$msg;
            $this->view->link = "/app/adm/manager_view?n=R2VyZW5jaWFtZW50byBHZXJlYWw=&b=L2FwcC9hZG0vaG9tZQ==";
        }
        else if($tipo == 'atualizar_adm_senha'){
            $this->view->title = "Erro Atualizar Adm";
            $this->view->msg = "#Erro 10 ".$msg;
            $this->view->link = "/app/adm/manager_view?n=R2VyZW5jaWFtZW50byBHZXJlYWw=&b=L2FwcC9hZG0vaG9tZQ==";
        }
        $this->render('erro',$this->layout_erro);
    }
   
    public function verificarUsuarioLogado(){
        session_start();
        if( $_SESSION['login'] != 'S'){
            header('location:/app/login/adm?erro=login_invalido');
      
        }
      }
  
    
    
    
}


?>