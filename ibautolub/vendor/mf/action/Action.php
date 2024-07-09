<?php 
namespace mf\action;



class Action{
    protected $view;

    public function __construct()
    {
        $this->view = new \stdClass;
    }
    protected function render($page,$layout){
       $this->view->page = $page;
      
       if(!file_exists($layout.'.phtml')){
            require 'ibautolub/app/'.$layout.'.phtml';
       }else{
            require 'ibautolub/app/404.phtml';
       }
    }
    protected function content(){
        $class = get_class($this);
        $novaClass = str_replace('app\\controller\\','',$class);
        $pasta = strtolower(str_replace('Controller','',$novaClass));
        
        require 'ibautolub/app/view/'.$pasta.'/'.$this->view->page.'.phtml';
    }
}


?>