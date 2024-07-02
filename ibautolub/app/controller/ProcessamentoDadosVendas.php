<?php 
namespace app\controller;
use mf\action\Action;
use mf\model\Container;

class ProcessamentoDadosVendas extends Action{
   
  
    
    public function salvarDadosBasicos(){
        $this->verificarUsuarioLogado();
        $cliente = Container::getModel('Cliente');
        $data = date('Y-m-d');
        $cpf = $this->configCpfCnpj($_POST['cpf_cnpj']);
        $nomeSenha = $_POST['login'].$_POST['senha'];
        $token = password_hash($nomeSenha,PASSWORD_DEFAULT);
        $login = base64_encode($_POST['login']);
        $id_funcionario = $_SESSION['id_fun'];
        $cliente->__set('nome',$_POST['nome']);
        $cliente->__set('id_funcionario',$id_funcionario);
        $cliente->__set('cpf_cnpj',$cpf);
        $cliente->__set('telefone',$_POST['telefone']);
        $cliente->__set('email',$_POST['email']);
        $cliente->__set('data_cadastro',$data);
        $cliente->__set('login',$login);
        $cliente->__set('senha',md5($_POST['senha']));
        $cliente->__set('token',$token);
        $msg = "Cadastrando Cliente ".$_POST['nome'];
        $Novotipo = "Cadastro Cliente";
        $receptor =$_POST['nome'];
        $this->registrarDadosSistema($_SESSION['nome_fun'],$receptor,$msg,$Novotipo);
        $cliente->salvarDadosBasico();
        echo '<pre>';
        print_r($_POST);
        print_r($cliente);
    }
    public function salvaVenda(){
        date_default_timezone_set('America/Manaus');
        $this->verificarUsuarioLogado();
        $data = date('Y-m-d H:m:s');
        $data_key = date('Y-m-d');
        $id=$_SESSION['id_fun'];
        $venda = Container::getModel('Vendas');
        //chave
        
        $chave_venda = sha1('date='.$data_key.'/cliente='.$_POST['id_cliente'].'/fun='.$id);
        $id=$_SESSION['id_fun'];
        $tipoVenda  =1;
        $num = rand(0,99999);
        $key_by = sha1('time='.time().'/rand='.$num);
        $total_compra = str_replace('R$ ','',$_POST['valor_final']);
        $troco = $_POST['valor_entrada'] - $total_compra;
        $venda->__set('id_funcionario',$id);
        $venda->__set('id_cliente',$_POST['id_cliente']);
        $venda->__set('data_venda',$data);
        $venda->__set('valor_recebido',$_POST['valor_entrada']);
        $venda->__set('troco',$troco);
        $venda->__set('chave_venda',$chave_venda);
        $venda->__set('total',$total_compra);
        $venda->__set('tipo_venda',$tipoVenda);
        $venda->__set('tipo_pagamento',$_POST['selecao_pagamento']);
        $venda->__set('key_buy',$key_by);
        $this->salvarHistorico($chave_venda,$_POST['id_cliente'],$key_by);
        
        $msg = "Venda Efetuada por ".$_SESSION['nome_fun'];
        $Novotipo = "Venda";
        $receptor =$_POST['id_cliente'];
        $this->registrarDadosSistema($_SESSION['nome_fun'],$receptor,$msg,$Novotipo);
        $venda->salvarDados();
        $this->deletarRegistros($chave_venda);
        $this->recuperarItensVendas($key_by);
   
        
        
    }
    
    public function deletarRegistros($chave){
        $listagem = Container::getModel('Listagem');
        $listagem->deletarRegistros($chave);
    }
    public function salvarHistorico($chave,$cliente,$key){
        $data = date('Y-m-d H:m:s');
        $historico = Container::getModel('Historico');
        $Listagem = Container::getModel('Listagem');
        $dados = $Listagem->getProduto($chave);
        $tipo_venda = 1;
        foreach( $dados as $value) {
            // id_funcionario,id_produto,qtd do produto,data e o lciente
            $historico->salvarHistorico(
                $value['id_funcionario'],
                $value['id_produto'],
                $value['qtd'],
                $data,
                $cliente,
                $chave,
                $tipo_venda,
                $key
            );
        }
    }
    public function salvarProduto(){
        $this->verificarUsuarioLogado();
        $produto = Container::getModel("Produto");
        $data = date('Y-m-d');
        $tipo = "produto";
        $preco_venda = $this->configurarPreco($_POST['preco']);
        $preco_compra =  $this->configurarPreco($_POST['preco_compra']);
        $id_user = $_SESSION['id_fun'];
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
        $msg = "Produto cadastro por ".$_SESSION['nome_fun'];
        $Novotipo = "Cadastro Produto";
        $receptor =$_POST['nome_produto'];
        $this->registrarDadosSistema($_SESSION['nome_fun'],$receptor,$msg,$Novotipo);
        $produto->salvarProduto();
        echo '<pre>';
        print_r($_POST);
        print_r($produto);
        
    }
    public function salvarServico(){
        $this->verificarUsuarioLogado();
        $produto = Container::getModel("Produto");
        $data = date('Y-m-d');
        $tipo = "servico";
        $preco_venda = $this->configurarPreco($_POST['preco_servico']);
        $id_user = $_SESSION['id_fun'];
        $produto->__set('produto',$_POST['nome_servico']);
        $produto->__set('data_cadastro',$data);
        $produto->__set('tipo',$tipo);
        $produto->__set('preco',$preco_venda);
        $produto->__set('id_user',$id_user);
        $msg = "Serviço cadastro por ".$_SESSION['nome_fun'];
        $Novotipo = "Cadastro Serviço";
        $receptor =$_POST['nome_servico'];
        $this->registrarDadosSistema($_SESSION['nome_fun'],$receptor,$msg,$Novotipo);
        $produto->salvarServico();
        echo '<pre>';
        print_r($_POST);
        print_r($produto);
        
      
      
       
    }
    public function editaDadosCliente(){
        $this->verificarUsuarioLogado();
        $cliente = Container::getModel('Cliente');
        $cpf = $this->configCpfCnpj($_POST['cpf_cnpj']);
        $cliente->__set('id_cliente',$_POST['id_cliente']);
        $cliente->__set('nome',$_POST['nome']);
        $cliente->__set('cpf_cnpj',$cpf);
        $cliente->__set('telefone',$_POST['telefone']);
        $cliente->__set('email',$_POST['email']);
        $msg = "Dados editado por ".$_SESSION['nome_fun'];
        $Novotipo = "Edição dados Cliente";
        $receptor =$_POST['nome'];
        $this->registrarDadosSistema($_SESSION['nome_fun'],$receptor,$msg,$Novotipo);
        $cliente->editarCliente();
        echo '<pre>';
        print_r($_POST);
        print_r($cliente);
    }
    public function editPasswordClient(){
        $this->verificarUsuarioLogado();
        $cliente = Container::getModel('Cliente');
        $nomeSenha = $_POST['login'].$_POST['senha'];
        $token = password_hash($nomeSenha,PASSWORD_DEFAULT);
        $cliente->__set('id_cliente',$_POST['id_cliente']);
        $cliente->__set('login',base64_encode($_POST['login']));
        $cliente->__set('senha',md5($_POST['senha']));
        $cliente->__set('token',$token);
        $msg = "Senha editada por ".$_SESSION['nome_fun'];
        $Novotipo = "Edição Senha Cliente";
        $receptor =$_POST['login'];
        $this->registrarDadosSistema($_SESSION['nome_fun'],$receptor,$msg,$Novotipo);
        $cliente->editarSenha();
        echo '<pre>';
        print_r($_POST);
        print_r($cliente);

    }
    public function salvarOrcamento(){
        date_default_timezone_set('America/Manaus');
        $this->verificarUsuarioLogado();
        $data = date('Y-m-d H:m:s');
        $data_key = date('Y-m-d');
        $id=$_SESSION['id_fun'];
        $venda = Container::getModel('Vendas');
        
        $chave_venda = sha1('date='.$data_key.'/cliente='.$_POST['id_cliente'].'/fun='.$id);
        $id=$_SESSION['id_fun'];
        $tipoVenda  =1;
        $total_compra = str_replace('R$ ','',$_POST['valor_final']);
        $num = rand(0,99999);
        $key_by = sha1('time='.time().'/rand='.$num);
        $venda->__set('id_funcionario',$id);
        $venda->__set('id_cliente',$_POST['id_cliente']);
        $venda->__set('data_venda',$data);
        $venda->__set('total',$total_compra);
        $venda->__set('chave_venda',$chave_venda);  
        $venda->__set('key_buy',$key_by);
        $msg = "Orçamento salvo ".$_SESSION['nome_fun'];
        $Novotipo = "Salvando orçamento";
        $receptor =$_POST['id_cliente'];
        $this->registrarDadosSistema($_SESSION['nome_fun'],$receptor,$msg,$Novotipo);
        $this->salvarHistoricoOrcamento($chave_venda,$_POST['id_cliente'],$key_by);
        $venda->salvarOrcamento();
        $this->deletarRegistros($chave_venda);
        echo '<pre>';
        print_r($_POST);
        print_r($venda);
    }
    public function salvarHistoricoOrcamento($chave,$cliente,$key_buy){
        $data = date('Y-m-d H:m:s');
        $historico = Container::getModel('Historico');
        $Listagem = Container::getModel('Listagem');
        $dados = $Listagem->getProduto($chave);
        $tipo_venda = 2;
        foreach( $dados as $value) {
            // id_funcionario,id_produto,qtd do produto,data e o lciente
            $historico->salvarHistorico(
                $value['id_funcionario'],
                $value['id_produto'],
                $value['qtd'],
                $data,
                $cliente,
                $chave,
                $tipo_venda,
                $key_buy
            );
        }
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
   public function recuperarItensVendas($key){
        $historico = Container::getModel('Historico');
        $produto = Container::getModel("Produto");
        $dados = $historico->recuperarQtdVendida($key);
        foreach($dados as $value){
           
           $produto->atualizarDadosEstoque($value['id_produto'],$value['result']);
        }
        


   }
    public function configCpfCnpj($cpf){
        $novoCpf = str_replace('-','',$cpf);
        $cpfNovo = str_replace('/','',$novoCpf);
        $newCpf = str_replace('.','',$cpfNovo);
        return trim($newCpf);
    }
    public function configurarPreco($valor){
        $novoValor = str_replace(',','.',$valor);
        return $novoValor;
      }
    public function verificarUsuarioLogado(){
        session_start();
        if( $_SESSION['login_fun'] != 'S'){
            header('location:/app/login/fun?erro=login_invalido');

        }
    }
    
}


?>