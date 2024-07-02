<?php 
namespace app\controller;

use mf\action\Action;

class LoginController extends Action{
    private $layout_login_adm = 'layout_login_adm';
    private $layout_login_fun = 'layout_login_fun';
    private $layout_login_cliente = 'layout_login_client';
    public function loginAdm(){
        $this->render('login_adm',$this->layout_login_adm);
    }
    public function loginUser(){
        echo 'ola user';
    }
    public function loginFun(){
        $this->render('login_fun',$this->layout_login_fun);
    }
    public function loginCliente(){
        $this->render('login_cliente',$this->layout_login_cliente);
    }
}

?>