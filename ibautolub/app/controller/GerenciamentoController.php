<?php 
namespace app\controller;
use mf\action\Action;
use mf\model\Container;



class GerenciamentoController extends Action{
    private $layout_adm = 'layout_adm';
    private $layout_default = 'layout_adm_default';
    private $layout_gerenciador = 'layout_adm_gerenciador';
    private $layout_contas = 'layout_contas_adm';
    private $layout_add_product = 'layout_add_product';
    public function homeGerencimaneto(){
        $this->verificarUsuarioLogado();
        
        $this->render('home',$this->layout_adm);
        
    }
    public function admCadastro(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome = base64_decode($_GET['n']);
        
        $this->render('gerenciamento_user',$this->layout_default);
    }
    public function cadastrarUsuario(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome = base64_decode($_GET['n']);
        $profissao = Container::getModel('Profissao');
        $this->view->dados = $profissao->getAllProfissao();
        $this->render('cadastro_user',$this->layout_default);
      
    }
    public function lsitagemFuncionarios(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome = base64_decode($_GET['n']);
        $this->view->link = "/app/adm/listagem?n=TGlzdGFnZW0=&b=L2FwcC9hZG0vY2FkYXN0cm9fdXN1YXJpbz9uPVIyVnlaVzVqYVcxbGJuUnYmYj1MMkZ3Y0M5aFpHMHZhRzl0WlE9PQ==";
        $fun = Container::getModel('Funcionario');
        $this->view->dados = $fun->getAllFuncionario();
 
        $this->render('listagem_funcionario',$this->layout_default);
      
    }
    public function editarUsuario(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome = base64_decode($_GET['n']);
        $fun = Container::getModel('Funcionario');
        $this->view->dados = $fun->getAllFuncionario();
        $id = $_GET['id_fun'];
        $profissao = Container::getModel('Profissao');
        $this->view->dados = $profissao->getAllProfissao();
        $fun = Container::getModel('Funcionario');
        $id = $_GET['id_fun'];
        $dados = $fun->getFuncionario($id);
        $this->view->dadosFun = [];
        foreach($dados as $value){
            $this->view->dadosFun = $value;
        }
        $this->render('editar_usuario',$this->layout_default);
       
        
      
      
    }
    public function editarSenhaUsuario(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome = base64_decode($_GET['n']);
        $fun = Container::getModel('Funcionario');
        $this->view->dados = $fun->getAllFuncionario();
        $id = $_GET['id_fun'];
        $profissao = Container::getModel('Profissao');
        $this->view->dados = $profissao->getAllProfissao();
        $fun = Container::getModel('Funcionario');
        $id = $_GET['id_fun'];
        $dados = $fun->getFuncionario($id);
        $this->view->dadosFun = [];
        foreach($dados as $value){
            $this->view->dadosFun = $value;
        }
        $this->render('editar_usuario_senha',$this->layout_default);
       
        
      
      
    }
    public function adicionarFuncaoView(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome = base64_decode($_GET['n']);
        $profissao = Container::getModel('Profissao');
        $this->view->dados = $profissao->getAllProfissao();
        $this->render('adicionar_funcao',$this->layout_default);
    }
    public function adicionarAdmView(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome = base64_decode($_GET['n']);
       
        $this->render('adicionar_adm',$this->layout_default);
    }
    public function gerenciamentoProdutos(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
         $this->view->nome = base64_decode($_GET['n']);
       
        $this->render('gerenciamento_produtos',$this->layout_default);
    }
    public function cadastrarProduto(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
         $this->view->nome = base64_decode($_GET['n']);
       
        $this->render('adicionar_produto',$this->layout_default);
    }
    public function cadastrarServico(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
         $this->view->nome = base64_decode($_GET['n']);
       
        $this->render('adicionar_servico',$this->layout_default);
    }
    public function gerenciamentoView(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
         $this->view->nome = base64_decode($_GET['n']);
       
        $this->render('manager_view',$this->layout_gerenciador);
    }
    public function editarServico(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
         $this->view->nome = base64_decode($_GET['n']);
        $this->view->id = $_GET['id_service'];
        $servico = Container::getModel('Produto');
        $dados = $servico->getService($_GET['id_service']);
        $this->view->dados = [];
        foreach($dados as $value){
            $this->view->dados = $value;
        }
        $this->render('edit_service',$this->layout_default);
    }
    public function editarProduto(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
         $this->view->nome = base64_decode($_GET['n']);
        $this->view->id = $_GET['id_produto'];
        $servico = Container::getModel('Produto');
        $dados = $servico->getProduto($this->view->id);
        $this->view->dados = [];
        foreach($dados as $value){
            $this->view->dados = $value;
        }
        $this->render('edit_product',$this->layout_default);
    }
    public function editarAdm(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
         $this->view->nome = base64_decode($_GET['n']);
        $this->view->id = $_GET['id_adm'];
        $adm = Container::getModel('Adm');
        $this->view->dados =[];
        $dados = $adm->getAdm($this->view->id);
        foreach($dados as $value){
            $this->view->dados = $value;
        }

        
        $this->render('edit_adm',$this->layout_default);
    }
    public function editarSenhaAdm(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
         $this->view->nome = base64_decode($_GET['n']);
        $this->view->id = $_GET['id_adm'];
        $adm = Container::getModel('Adm');
        $this->view->dados =[];
        $dados = $adm->getAdm($this->view->id);
        foreach($dados as $value){
            $this->view->dados = $value;
        }

        
        $this->render('edit_adm_senha',$this->layout_default);
    }
    public function editarPerfilAdm(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
         $this->view->nome = base64_decode($_GET['n']);
        $this->view->id = $_GET['id_user'];
        $adm = Container::getModel('Adm');
        $dados = $adm->getAdm($this->view->id);
        $this->view->dados = [];
        foreach($dados as $value){
            $this->view->dados = $value;
        }
        $this->render('editar_perfil_usuario',$this->layout_default);
    }
    public function relatorioAdm(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome = "Relatório";
        
        $this->render('report',$this->layout_default);
    }
    public function contasPagar(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
         $this->view->nome = base64_decode($_GET['n']);
        
        $this->render('cadastrar_contas',$this->layout_contas);
    }
    public function viewDespesas(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
         $this->view->nome = base64_decode($_GET['n']);
        $id = $_GET['id'];
        $contas = Container::getModel('Contas');
        $this->view->dados = $contas->getConta($id);
       
        
        $this->render('view_despesas',$this->layout_default);
    }
    public function addQtdProdutos(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
         $this->view->nome = base64_decode($_GET['n']);
      
        $this->render('add_qtd_produtos',$this->layout_add_product);
    }
    public function historico(){
        $this->verificarUsuarioLogado();
        $this->view->back =base64_decode($_GET['b']);
        $this->view->nome = "Histórico";
      
        $this->render('historico',$this->layout_default);
    }
    public function verificarUsuarioLogado(){
        session_start();
        if( $_SESSION['login'] != 'S'){
            header('location:/app/login/adm?erro=login_invalido');

        }
    }
  
  
    
    
    
}


?>