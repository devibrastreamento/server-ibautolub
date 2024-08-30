<?php 
namespace app\controller;
use mf\action\Action;



class SucessoController extends Action{
    private $layout_sucesso = 'layout_adm_sucesso';

    public function sucessoInfo(){
        $this->verificarUsuarioLogado();
        $tipo = $_GET['tipo'];
        $this->view->title = "";
        $this->view->msg = "";
        $this->view->link = "";
        if($tipo == 'profissao'){
            $this->view->title = "Sucesso ao cadastrar";
            $this->view->msg = "Sucesso ao cadastrar uma função ao sistema, clique no botão abaixo para retornar";
            $this->view->link = "/app/adm/form_add_funcao?n=Tm92bw==&b=L2FwcC9hZG0vaG9tZQ==";
        }else if($tipo == 'cadastro_adm'){
            $this->view->title = "Sucesso ao cadastrar";
            $this->view->msg = "Sucesso ao cadastrar usuário Administrativo";
            $this->view->link = "/app/adm/form_add_adm?n=Tm92byBBZG0=&b=L2FwcC9hZG0vaG9tZQ==";
        }else if($tipo == 'cadastro_funcionario'){
            $this->view->title = "Sucesso ao cadastrar";
            $this->view->msg = "Sucesso ao cadastrar Funcionario";
            $this->view->link = "/app/adm/cadastro_usuario?n=R2VyZW5jaW1lbnRv&b=L2FwcC9hZG0vaG9tZQ==";
        }else if($tipo == 'atualizacao_funcionario'){
            $this->view->title = "Sucesso ao Atualizar";
            $this->view->msg = "Sucesso ao atualizar o Funcionario";
            $this->view->link = "/app/adm/listagem?n=TGlzdGFnZW0=&b=L2FwcC9hZG0vY2FkYXN0cm9fdXN1YXJpbz9uPVIyVnlaVzVqYVcxbGJuUnYmYj1MMkZ3Y0M5aFpHMHZhRzl0WlE9PQ==";
        }
        else if($tipo == 'atualizar_senha'){
            $this->view->title = "Sucesso ao Atualizar";
            $this->view->msg = "Sucesso ao atualizar a senha";
            $this->view->link = "/app/adm/listagem?n=TGlzdGFnZW0=&b=L2FwcC9hZG0vY2FkYXN0cm9fdXN1YXJpbz9uPVIyVnlaVzVqYVcxbGJuUnYmYj1MMkZ3Y0M5aFpHMHZhRzl0WlE9PQ==";
        }
        else if($tipo == 'cadastro_produto'){
            $this->view->title = "Sucesso ao Cadastrar";
            $this->view->msg = "Sucesso ao cadastrar Produto";
            $this->view->link = "/app/adm/manager_product?n=R2VyZW5jaW1lbnRv&b=L2FwcC9hZG0vaG9tZQ==";
        }
        else if($tipo == 'cadastro_servico'){
            $this->view->title = "Sucesso ao Cadastrar";
            $this->view->msg = "Sucesso ao cadastrar Serviço";
            $this->view->link = "/app/adm/manager_product?n=R2VyZW5jaW1lbnRv&b=L2FwcC9hZG0vaG9tZQ==";
        }
        else if($tipo == 'atualizar_servico'){
            $this->view->title = "Sucesso ao Atualizar";
            $this->view->msg = "Sucesso ao atualizar Serviço";
            $this->view->link = "/app/adm/manager_view?n=R2VyZW5jaWFtZW50byBHZXJlYWw=&b=L2FwcC9hZG0vaG9tZQ==";
        }
        else if($tipo == 'atualizar_produto'){
            $this->view->title = "Sucesso ao Atualizar";
            $this->view->msg = "Sucesso ao atualizar Produto";
            $this->view->link = "/app/adm/manager_view?n=R2VyZW5jaWFtZW50byBHZXJlYWw=&b=L2FwcC9hZG0vaG9tZQ==";
        }
        else if($tipo == 'atualizar_adm'){
            $this->view->title = "Sucesso ao Atualizar";
            $this->view->msg = "Sucesso ao atualizar Adm";
            $this->view->link = "/app/adm/manager_view?n=R2VyZW5jaWFtZW50byBHZXJlYWw=&b=L2FwcC9hZG0vaG9tZQ==";
        }
        else if($tipo == 'atualizar_adm_senha'){
            $this->view->title = "Sucesso ao Atualizar";
            $this->view->msg = "Sucesso ao atualizar Senha adm";
            $this->view->link = "/app/adm/manager_view?n=R2VyZW5jaWFtZW50byBHZXJlYWw=&b=L2FwcC9hZG0vaG9tZQ==";
        }
        
        $this->render('sucesso',$this->layout_sucesso);
    }
    
    public function verificarUsuarioLogado(){
        session_start();
        if( $_SESSION['login'] != 'S'){
            header('location:/app/login/adm?erro=login_invalido');
      
        }
      }
   
  
  
    
    
    
}


?>