<?php 
namespace app\controller;
use mf\action\Action;
use mf\model\Container;

class ClientDadosController extends Action{
    public function atualizarDadosBasico(){
        $this->verificarUsuarioLogado();
        $cpf = $this->configCpfCnpj($_POST['cpf']);
        $cliente = Container::getModel('Cliente');
        $cliente->__set('id_cliente',$_SESSION['id_client']);
        $cliente->__set('nome',$_POST['nome']);
        $cliente->__set('email',$_POST['email']);
        $cliente->__set('telefone',$_POST['telefone']);
        $cliente->__set('cpf_cnpj',$cpf);
        $cliente->editSideClient();
        echo '<pre>';
        print_r($cliente);
    }
    public function atualizarDadosSenha(){
        $this->verificarUsuarioLogado();
        $cliente = Container::getModel('Cliente');
        $nomeSenha = $_POST['login'].$_POST['senha'];
        $token = password_hash($nomeSenha,PASSWORD_DEFAULT);
        $cliente->__set('id_cliente',$_SESSION['id_client']);
        $cliente->__set('login',base64_encode($_POST['login']));
        $cliente->__set('senha',md5($_POST['senha']));
        $cliente->__set('token',$token);
        $cliente->editSideClientPassword();
        echo '<pre>';
        print_r($_POST);
        print_r($cliente);

    }
    public function configCpfCnpj($cpf){
        $novoCpf = str_replace('-','',$cpf);
        $cpfNovo = str_replace('/','',$novoCpf);
        $newCpf = str_replace('.','',$cpfNovo);
        return trim($newCpf);
    }
    public function verificarUsuarioLogado(){
        session_start();
        if( $_SESSION['client_login'] != 'S'){
            header('location:/app/login/client?erro=login_invalido');

        }
    }
}


?>