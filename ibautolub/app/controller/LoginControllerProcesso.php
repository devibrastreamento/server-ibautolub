<?php 
namespace app\controller;

use mf\action\Action;
use mf\model\Container;

class LoginControllerProcesso extends Action{

    public function loginProcessoAdm(){
        $adm = Container::getModel('Adm');
        $nomeSenha = $_POST['login'].$_POST['senha'];
        $login = base64_encode($_POST['login']);
        $senha = md5($_POST['senha']);
        $dados = $adm->verificarUsuario($login);
        if(count($dados) > 0){
            foreach($dados as $value){
               if($value['status_ativo'] == 1){
                    if(password_verify($nomeSenha,$value['token'])){
                        session_start();
                        $_SESSION['nome'] = $value['nome'];
                        $_SESSION['id'] = $value['id_adm'];
                        $_SESSION['login'] = 'S';
                        $_SESSION['permissao'] = $value['permissao_cadastro'];
                       
                        header('location:/app/adm/home');
                    }else{
                        header('location:/app/login/adm?error=login_senha');
                    }
               }else{
                header('location:/app/login/adm?error=inativo');
               }
            }
        }else{
            header('location:/app/login/adm?error=null');
        }
        
        
        
    }
    public function loginProcessoFun(){
        $fun = Container::getModel('Funcionario');
        $nomeSenha = $_POST['login'].$_POST['senha'];
        $login = base64_encode($_POST['login']);
        $senha = md5($_POST['senha']);
        $dados = $fun->recuperarLoginFun($login);
        if(count($dados) >= 1){
            foreach($dados as $value){
                if($value['status_ativo'] == 1){
                    if(password_verify($nomeSenha,$value['token'])){
                        session_start();
                        $_SESSION['nome_fun'] = $value['nome'];
                        $_SESSION['id_fun'] = $value['id_funcionario'];
                        $_SESSION['login_fun'] = 'S';
                        header('location:/app/fun/home');
                    }else{
                       header('location:/app/login/fun?erro=usuario_senha');
                    }
                }else{
                    header('location:/app/login/fun?erro=inativo');
                }
               
            }
        }else{
            header('location:/app/login/fun?erro=null');
        }
    }
    public function loginProcessoCliente(){
        $login = base64_encode($_POST['login']);
        $nomeSenha = $_POST['login'].$_POST['senha'];
        $cleinte = Container::getModel('Cliente');
        $dados  = $cleinte->loginCliente($login);
        if(count($dados) >= 1){
            foreach($dados as $value){
               if($value['status_ativo'] == 1){
                if(password_verify($nomeSenha,$value['token'])){
                    session_start();
                    $_SESSION['nome_cliente'] = $value['nome'];
                    $_SESSION['id_client'] = $value['id_cliente'];
                    $_SESSION['client_login'] = 'S';
                    header('location:/app/client/home');
                    }else{
                        header('location:/app/login/client?erro=usuario_senha');
                     }
                 }else{
                     header('location:/app/login/client?erro=inativo');
                 }
                
             }
         }else{
             header('location:/app/login/client?erro=null');
         }
        
    }
    public function encerrarSessao(){
        session_start();
        $_SESSION['client_login'] = 'N';
        header('location:/app/login/client');
    }
    public function finalizarSessaoFun(){
        session_start();
        $_SESSION['login_fun'] = 'N';
        header('location:/app/login/fun');
    }
    public function finalizarSessao(){
        session_start();
        $_SESSION['login'] = 'N';
        header('location:/app/login/adm');
        
    }
    
    
}



?>