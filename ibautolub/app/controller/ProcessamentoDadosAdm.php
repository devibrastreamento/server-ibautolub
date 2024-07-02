<?php 
namespace app\controller;
use mf\action\Action;
use mf\model\Container;

class ProcessamentoDadosAdm extends Action{

  
    
  public function cadastrarNovaFuncao(){
    $this->verificarUsuarioLogado();
        $funcao = Container::getModel('Profissao');
        $funcao->__set('nome_profissao',$_POST['novaFuncao']);
        $funcao->salvar();
  }
  public function cadastrarNovoAdm(){
    $this->verificarUsuarioLogado();
    $timestamp = time();
    $nomeSenha = $_POST['login'].$_POST['senha'];
    $senha = md5($_POST['senha']);
    $login = base64_encode($_POST['login']);
    $token = password_hash($nomeSenha,PASSWORD_DEFAULT);
    $adm = Container::getModel('Adm');
    $adm->__set('nome',$_POST['nome']);
    $adm->__set('email',$_POST['email']);
    $adm->__set('login',$login);
    $adm->__set('permissao_cadastro',$_POST['permissao']);
    $adm->__set('senha',$senha);
    $adm->__set('data_ativo',$timestamp);
    $adm->__set('token',$token);
    $receptor = $_POST['nome'];
    $msg = "Cadastro novo Adm ".$_POST['nome']." feito pelo ".$_SESSION['nome']."(a)";
    $tipo = "Cadastro ADM";
    $this->registrarDadosSistema($_SESSION['nome'],$receptor,$msg,$tipo);
    $adm->salvar();
    echo '<pre>';
    print_r($adm);
    print_r($_POST);
}
public function cadastrarFuncinario(){
  $this->verificarUsuarioLogado();
  $data_cadastro = date('Y-m-d');
  $nomeSenha = $_POST['login'].$_POST['senha'];
  $token = password_hash($nomeSenha,PASSWORD_DEFAULT);
  $login = base64_encode($_POST['login']);
  $senha = md5($_POST['senha']);
  $fun = Container::getModel('Funcionario');
  $id_adm = $_SESSION['id'];
  $fun->__set('id_adm',$id_adm);
  $fun->__set('nome',$_POST['nome']);
  $fun->__set('email',$_POST['email']);
  $fun->__set('id_profissao',$_POST['profissao']);
  $fun->__set('data_cadastro',$data_cadastro);
  $fun->__set('descricao_atividade',$_POST['descricao']);
  $fun->__set('login',$login);
  $fun->__set('senha',$senha);
  $fun->__set('token',$token);
  $receptor = $_POST['nome'];
  $msg = "Cadastro do Funcionario do(a) ".$_POST['nome']." feito pelo ".$_SESSION['nome']."(a)";
  $tipo = "Cadastro";
  $this->registrarDadosSistema($_SESSION['nome'],$receptor,$msg,$tipo);
  $fun->salvar();
 
  echo '<pre>';
  print_r($_POST);
  print_r($fun);
 
}
public function atualizarDadosFuncionario(){
  $this->verificarUsuarioLogado();
  $fun = Container::getModel('Funcionario');
  $id = $_GET['id_fun'];
  $fun->__set('id_funcionario',$id);
  $fun->__set('nome',$_POST['nome']);
  $fun->__set('email',$_POST['email']);
  $fun->__set('id_profissao',$_POST['profissao']);
  $fun->__set('descricao_atividade',$_POST['descricao']);
  $msg = "Atualização do Funcionario do(a) ".$_POST['nome']." feito pelo ".$_SESSION['nome']."(a)";
  $tipo = "Atualizar";
  $receptor = $_POST['nome'];
  $this->registrarDadosSistema($_SESSION['nome'],$receptor,$msg,$tipo);
  $fun->atualizarDados();
  echo '<pre>';
  print_r($_POST);
  print_r($fun);

 
}
public function atualizarSenhaFuncionario(){
  $this->verificarUsuarioLogado();
  $fun = Container::getModel('Funcionario');
  $id = $_GET['id_fun'];
  $login = base64_encode($_POST['login']);
  $nomeSenha = $_POST['login'].$_POST['senha'];
  $token = password_hash($nomeSenha,PASSWORD_DEFAULT);
  $fun->__set('id_funcionario',$id);
  $fun->__set('login',$login);
  $fun->__set('senha',md5($_POST['senha']));
  $fun->__set('token',$token);
  $msg = "Atualização senha do Funcionario do id".$id." feito pelo ".$_SESSION['nome']."(a)";
  $tipo = "Atualizar Senha";
  $receptor =$id;
  $this->registrarDadosSistema($_SESSION['nome'],$receptor,$msg,$tipo);
  $fun->atualizarSenha();
  echo '<pre>';
  print_r($fun);


 
}
public function desativarFuncionario(){
  $this->verificarUsuarioLogado();
  $fun = Container::getModel('Funcionario');
  $id = $_GET['id_fun'];
  $fun->desativarFuncionario($id);
  $link = "/app/adm/listagem?n=TGlzdGFnZW0=&b=L2FwcC9hZG0vY2FkYXN0cm9fdXN1YXJpbz9uPVIyVnlaVzVqYVcxbGJuUnYmYj1MMkZ3Y0M5aFpHMHZhRzl0WlE9PQ==";
  header('location:'.$link);



 
}
public function ativarFuncionario(){
  $this->verificarUsuarioLogado();
  $fun = Container::getModel('Funcionario');
  $id = $_GET['id_fun'];
  $fun->ativarFuncionario($id);
  $link = "/app/adm/listagem?n=TGlzdGFnZW0=&b=L2FwcC9hZG0vY2FkYXN0cm9fdXN1YXJpbz9uPVIyVnlaVzVqYVcxbGJuUnYmYj1MMkZ3Y0M5aFpHMHZhRzl0WlE9PQ==";
  header('location:'.$link);


 
}
public function adicionarProduto(){
  $this->verificarUsuarioLogado();
  $produto = Container::getModel("Produto");
  $data = date('Y-m-d');
  $tipo = "produto";
  $preco_venda = $this->configurarPreco($_POST['preco']);
  $preco_compra =  $this->configurarPreco($_POST['preco_compra']);
  $id_user = $_SESSION['id'];
  $produto->__set('produto',$_POST['nome_produto']);
  $produto->__set('data_cadastro',$data);
  $produto->__set('tipo',$tipo);
  $produto->__set('preco',$preco_venda);
  $produto->__set('codigo_barra',$_POST['codigo_barra']);
  $produto->__set('id_user',$id_user);
  $produto->__set('qtd',$_POST['qtd']);
  $produto->__set('preco_compra',$preco_compra);
  $produto->__set('fornecedor',$_POST['fornecedor']);
  $produto->__set('categoria',$_POST['categoria']);
  $msg = "Adição de novo Produto feito pelo(a) ".$_SESSION['nome'];
  $Novotipo = "Adição novo Produto";
  $receptor =$_POST['nome_produto'];
  $this->registrarDadosSistema($_SESSION['nome'],$receptor,$msg,$Novotipo);
  $produto->salvarProduto();
  echo '<pre>';
  print_r($_POST);
  print_r($produto);


 
}
public function adicionarServico(){
  $this->verificarUsuarioLogado();
  $produto = Container::getModel("Produto");
  $data = date('Y-m-d');
  $tipo = "servico";
  $preco_venda = $this->configurarPreco($_POST['preco_servico']);
  $id_user = $_SESSION['id'];
  $produto->__set('produto',$_POST['nome_servico']);
  $produto->__set('data_cadastro',$data);
  $produto->__set('tipo',$tipo);
  $produto->__set('preco',$preco_venda);
  $produto->__set('id_user',$id_user);
  $msg = "Adição de novo Serviço feito pelo(a) ".$_SESSION['nome'];
  $Novotipo = "Adição novo Serviço";
  $receptor =$_POST['nome_servico'];
  $this->registrarDadosSistema($_SESSION['nome'],$receptor,$msg,$Novotipo);
  $produto->salvarServico();
  echo '<pre>';
  print_r($_POST);
  print_r($produto);
  


 
}
public function editServiceManager(){
  $this->verificarUsuarioLogado();
  $produto = Container::getModel("Produto");
  $id = $_GET['id_service'];
  $preco = $this->configurarPreco($_POST['edit_price_service']);
  $produto->__set('id_produto',$id);
  $produto->__set('produto',$_POST['edit_name_service']);
  $produto->__set('preco',$preco);
  $msg = "Atulizacao de novo Serviço feito pelo(a) ".$_SESSION['nome'];
  $Novotipo = "Atualizar novo Serviço";
  $receptor =$_POST['edit_name_service'];
  $this->registrarDadosSistema($_SESSION['nome'],$receptor,$msg,$Novotipo);
  $produto->atualizarServico();
  echo '<pre>';
  print_r($_POST);
  print_r($produto);
}
/*
public function ativarServicoManager(){
  $this->verificarUsuarioLogado();
  $produto = Container::getModel("Produto");
  $id = $_GET['id_service'];
  $produto->ativarServico($id);
  header('location:/app/adm/manager_view?n=R2VyZW5jaWFtZW50byBHZXJlYWw=&b=L2FwcC9hZG0vaG9tZQ==');
}
public function inativarServiceManager(){
  $this->verificarUsuarioLogado();
  $produto = Container::getModel("Produto");
  $id = $_GET['id_service'];
  $produto->inativarServico($id);
  header('location:/app/adm/manager_view?n=R2VyZW5jaWFtZW50byBHZXJlYWw=&b=L2FwcC9hZG0vaG9tZQ==');
}*/
public function editProductManager(){
  $this->verificarUsuarioLogado();
  $produto = Container::getModel("Produto");
  $preco_venda = $this->configurarPreco($_POST['preco']);
  $preco_compra = $this->configurarPreco($_POST['preco_compra']);
  $produto->__set('id_produto',$_GET['id_produto']);
  $produto->__set('produto',$_POST['nome_produto']);
  $produto->__set('preco',$preco_venda);
  $produto->__set('codigo_barra',$_POST['codigo_barra']);
  $produto->__set('qtd',$_POST['qtd']);
  $produto->__set('preco_compra',$preco_compra);
  $produto->__set('fornecedor',$_POST['fornecedor']);
  $produto->__set('categoria',$_POST['categoria']);
  $msg = "Atulizacao de novo Serviço feito pelo(a) ".$_SESSION['nome'];
  $Novotipo = "Atualizar novo Produto";
  $receptor =$_POST['nome_produto'];
  $this->registrarDadosSistema($_SESSION['nome'],$receptor,$msg,$Novotipo);
  $produto->atualizarProduto();
  echo '<pre>';
  print_r($_POST);
  print_r($produto);
}
public function editAdmManager(){
  $this->verificarUsuarioLogado();
  $adm = Container::getModel('Adm');
  $id = $_GET['id_adm'];
  $data_update = date('Y-m-d');
  $adm->__set('id_adm',$id);
  $adm->__set('nome',$_POST['nome_adm']);
  $adm->__set('email',$_POST['email']);
  $adm->__set('permissao_cadastro',$_POST['permissao']);
  $adm->__set('update_user',$data_update);
  $msg = "Ediçao de ADM feito pelo(a)".$_SESSION['nome'];
  $Novotipo = "Edição ADM";
  $receptor =$_POST['nome_adm'];
  $this->registrarDadosSistema($_SESSION['nome'],$receptor,$msg,$Novotipo);
  $adm->atualizarDadosAdm();
  echo '<pre>';
  print_r($_POST);
  print_r($adm);
}
public function editSenhaManager(){
  $this->verificarUsuarioLogado();
  $adm = Container::getModel('Adm');
  $nomeSenha = $_POST['login'].$_POST['senha'];
  $token = password_hash($nomeSenha,PASSWORD_DEFAULT);
  $adm->__set('id_adm',$_GET['id_adm']);
  $adm->__set('login',base64_encode($_POST['login']));
  $adm->__set('senha',md5($_POST['senha']));
  $adm->__set('token',$token);
  $msg = "Ediçao de senha ADM feito pelo(a)".$_SESSION['nome'];
  $Novotipo = "Edição Senha ADM";
  $receptor =$_GET['id_adm'];
  $this->registrarDadosSistema($_SESSION['nome'],$receptor,$msg,$Novotipo);
  $adm->atualizarSenhaAdm();
  echo '<pre>';
  print_r($_POST);
  print_r($adm);
}
public function excluirProfissao(){
  $this->verificarUsuarioLogado();
  $funcao = Container::getModel('Profissao');
  $funcao->desativarProfissao($_GET['id']);
  $msg = "Ediçao de senha ADM feito pelo(a)".$_SESSION['nome'];
  $Novotipo = "Edição Senha ADM";
  $receptor =$_GET['id'];
  $this->registrarDadosSistema($_SESSION['nome'],$receptor,$msg,$Novotipo);

  header('location:/app/adm/form_add_funcao?n=Tm92bw==&b=L2FwcC9hZG0vaG9tZQ==');
 
}

public function editDadosBasico(){
  $this->verificarUsuarioLogado();
  $adm = Container::getModel('Adm');
  $id = $_GET['id_adm'];
 
  echo '<pre>';
  print_r($_POST);
  print_r($adm);
}
public function registrarDadosSistema($autor,$user,$msg,$tipo){
  $log = Container::getModel('Log');
  $data = date('Y-m-d h:i:s');
  $log->__set('autor',$autor);
  $log->__set('receptor',$user);
  $log->__set('msg',$msg);
  $log->__set('data_cadastro',$data);
  $log->__set('tipo',$tipo);
  $log->salvarALteracaoSistema();
}
public function configurarPreco($valor){
  $novoValor = str_replace(',','.',$valor);
  return $novoValor;
}
public function verificarUsuarioLogado(){
  session_start();
  if( $_SESSION['login'] != 'S'){
      header('location:/app/login/adm?erro=login_invalido');

  }
}

  
    
    
    
}


?>