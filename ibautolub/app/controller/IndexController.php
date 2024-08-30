<?php 
namespace app\controller;
use mf\action\Action;
use mf\model\Container;


set_include_path('C:\xampp\php\PEAR');
class IndexController extends Action{
    public function home(){
        echo 'home';
        

        $this->render('index','layout');
    }
    public function sobreNos(){
        echo 'ola mundo';
        $this->render('sobrenos','layout');
    }
    public function teste(){

        echo 'home';
        

        $this->render('indexs','layouts');
    }
    
    
    
}


?>