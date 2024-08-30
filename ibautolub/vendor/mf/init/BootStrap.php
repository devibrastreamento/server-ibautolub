<?php 
namespace mf\init;

use Exception;

class BootStrap{
    protected $route;

    protected function setRoute($route){
        $this->route = $route;
    }
    protected function getRoute(){
        return $this->route;
    }
    public function __construct(){
       $this->initRoute();
       $this->run($this->getRoute());
    }
    protected function  getURl(){
        return parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
    }
    protected function run($url){
        foreach($url as $value){
          if($value['route'] == $this->getURl()){
          
            $class = "app\\controller\\".$value['controller'];
            $action = $value['action'];
            $new = new $class;
            $new->$action();
                    
          }
        }
    }
}



?>