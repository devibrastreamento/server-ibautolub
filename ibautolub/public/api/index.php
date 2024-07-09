<?php
// Create and configure Slim app
require '/var/www/html/ibautolub/vendor/autoload.php';
use mf\model\Container;
$config = ['settings' => [
    'addContentLengthHeader' => false,
]];

$app = new \Slim\App($config);


// Define app routes
$app->delete('/v1/delete/{id}', function ($request, $response, $args) {
    $id = $args['id'];
    
    $listagem = Container::getModel("Listagem");
    $retorno = $listagem->excluirItem($id);
    $msg = "";
    if($retorno){
        $msg = ['result'=>true];
    }else{
        $msg = ['result'=>false];
    }
    return $response->withJson($msg);


});
// ------------------------------------------Atualzia status Cliente desativar-----------------------------------
$app->put('/v1/client/inativar/{id}', function ($request, $response, $args) {
    $id = $args['id'];
    $cliente = Container::getModel("Cliente");
    $dados = $cliente->desativarUsuario($id);
    $msg = "";
    if($dados){
        $msg = ['result'=>true];
    }else{
        $msg = ['result'=>false];
    }
    return $response->withJson($msg);
});
$app->put('/v1/client/ativar/{id}', function ($request, $response, $args) {
    $id = $args['id'];
    $cliente = Container::getModel("Cliente");
    $dados = $cliente->ativarUsuario($id);
    $msg = "";
    if($dados){
        $msg = ['result'=>true];
    }else{
        $msg = ['result'=>false];
    }
    return $response->withJson($msg);
});
// ------------------------------------------Remover Veículo-----------------------------------
$app->delete('/v1/client/remove/{id}', function ($request, $response, $args) {
    $id = base64_decode($args['id']);
    $veiculo = Container::getModel("Veiculo");
    $dados = $veiculo->removerVeiculo($id);
    $msg = "";
    if($dados){
        $msg = ['result'=>true];
    }else{
        $msg = ['result'=>false];
    }
    return $response->withJson($msg);
});

// ------------------------------------------Salvar dados Veículo Cliente-----------------------------------
$app->post('/v1/save/client/add', function ($request, $response, $args) {
    session_start();
    $veiculo = Container::getModel("Veiculo");
    $veiculo->__set('id_cliente',$_POST['id_cliente']);
    $veiculo->__set('modelo',$_POST['modelo']);
    $veiculo->__set('marca',$_POST['nome']);
    $veiculo->__set('placa',$_POST['placa']);
    $veiculo->__set('cor',$_POST['cor']);
    $veiculo->__set('tipo',$_POST['tipo']);
    $dados = $veiculo->salvarVeiculoDireto();
       
    if($dados){
        $msg = ["result"=>true];
    }else{
        $msg = ["result"=>false];
    }
    return $response->withJson($msg);
    
    });
$app->post('/v1/save/client/new/add', function ($request, $response, $args) {
        session_start();
        $veiculo = Container::getModel("Veiculo");
        $veiculo->__set('id_cliente',$_POST['id_cliente']);
        $veiculo->__set('modelo',$_POST['modelo']);
        $veiculo->__set('marca',$_POST['nome']);
        $veiculo->__set('placa',$_POST['placa']);
        $veiculo->__set('cor',$_POST['cor']);
        $veiculo->__set('hodometro',$_POST['hodometro']);
        $veiculo->__set('tipo',$_POST['tipo']);
        $dados = $veiculo->salvarVeiculoDiretoPost();
        if($dados){
            $msg = ["result"=>true];
        }else{
            $msg = ["result"=>false];
        }
        return $response->withJson($msg);
        
});
// ------------------------------------------Salvar Receita -----------------------------------   
$app->post('/v1/save/adm/receita/add', function ($request, $response, $args) {
    $contas = Container::getModel('Contas');
    $tipo = 'receita';
    $contas->__set('nome',$_POST['nome']);
    $contas->__set('valor',$_POST['valor']);
    $contas->__set('tipo',$tipo);
    $contas->__set('categoria',$_POST['categoria']);
    $contas->__set('data_conta',$_POST['data']);
    $contas->__set('obs',$_POST['obs']);
    $dados = $contas->salvarReceita();
    $msg = "";
    if($dados){
        $msg = ['result'=>true];
    }else{
        $msg = ['result'=>false,'erro'=>$dados];
    }
    return $response->withJson($msg);
    
}); 
// ------------------------------------------Salvar Despesas-----------------------------------   
$app->post('/v1/save/adm/despesa/add', function ($request, $response, $args) {
    $contas = Container::getModel('Contas');
    $tipo = 'despesa';
    $contas->__set('nome',$_POST['nome']);
    $contas->__set('valor',$_POST['valor']);
    $contas->__set('tipo',$tipo);
    $contas->__set('categoria',$_POST['categoria']);
    $contas->__set('data_conta',$_POST['data']);
    $contas->__set('obs',$_POST['obs']);
    $dados = $contas->salvarReceita();
    $msg = "";
    if($dados){
        $msg = ['result'=>true];
    }else{
        $msg = ['result'=>false,'erro'=>$dados];
    }
    return $response->withJson($msg);
    
}); 


// ------------------------------------------Salvar dados de Listagem-----------------------------------
$app->post('/v1/save/list/add', function ($request, $response, $args) {
session_start();

date_default_timezone_set('America/Manaus');
$qtd = $_POST['qtd'];
$msg = "";
$data = date('Y-m-d');
$datatime = date('Y-m-d H:m:s');
$id_produto = $_POST['id_produto'];
$id_funcionario = $_SESSION['id_fun'];
$id_cliente = $_POST['id_cliente'];
//chave para pesquisar comprar realizada no mesmo dia;
$chave_venda = sha1('date='.$data.'/cliente='.$id_cliente.'/fun='.$id_funcionario);
$listagem = Container::getModel("Listagem");
$listagem->__set('id_funcionario',$id_funcionario);
$listagem->__set('id_produto',$id_produto);
$listagem->__set('id_cliente',$id_cliente);
$listagem->__set('chave_venda',$chave_venda);
$listagem->__set('qtd',$qtd);
$listagem->__set('data_compra',$datatime);
$retorno = $listagem->salvarProduto();
if($retorno){
    $msg = ["result"=>true];
}else{
    $msg = ["result"=>false];
}
return $response->withJson($msg);

});
// ------------------------------------------Listagem Veículos Preview -----------------------------------
$app->get('/v1/client/list_preview/carr/{id}', function ($request, $response, $args) {
    $id = $args['id'];
    $veiculo = Container::getModel("Veiculo");
    $dados = $veiculo->getVeiculoPreview($id);
    
    $msg = [];
    if(count($dados) > 0 ){
        $msg = ['result'=>true,'qtd'=>count($dados),'dados'=>$dados];
    }else{
        $msg = ['result'=>false,'qtd'=>'0','dados'=>'vazio'];
    }
    return $response->withJson($msg);
    
    });
// ------------------------------------------Listagem Veículos -----------------------------------
$app->get('/v1/client/list/carr/{id}', function ($request, $response, $args) {
    $id = $args['id'];
    $veiculo = Container::getModel("Veiculo");
    $dados = $veiculo->getVeiculo($id);
    $msg = [];
    if(count($dados) > 0 ){
        $msg = ['result'=>true,'dados'=>$dados];
    }else{
        $msg = ['result'=>false,'dados'=>'null'];
    }
    return $response->withJson($msg);
    
    });

// ------------------------------------------Verificação de logins de funcionarios -----------------------------------
$app->get('/v1/login/fun/{login}', function ($request, $response, $args) {
    
    $login =$args['login'];
    $fun = Container::getModel("Funcionario");
    $dados = $fun->recuperarLoginFun($login);
    $nome = "";
    $id = "";
    foreach($dados as $value){
        $nome = $value['login'];
        $id =$value['id_funcionario'];
    }
    $qtd = count($dados);
    $msg = "";
    if($qtd >= 1){
        $msg = ["loginAth"=>true,'dados'=>$nome,"id"=>$id];
    }else{
        $msg = ["loginAth"=>false];
    }
    return $response->withJson($msg);

});
// ------------------------------------------Verificação de logins de Usuários -----------------------------------
$app->get('/v1/login/user/{login}', function ($request, $response, $args) {
    
    $login = $args['login'];
    $cliente = Container::getModel("Cliente");
    $dados = $cliente->recuperarLoginFun($login);
    $nome = "";
    $id = "";
    foreach($dados as $value){
        $nome = $value['login'];
        $id =$value['id_cliente'];
    }
    $qtd = count($dados);
    $msg = "";
    if($qtd >= 1){
        $msg = ["loginAth"=>true,'dados'=>$nome,"id"=>$id];
    }else{
        $msg = ["loginAth"=>false];
    }
    return $response->withJson($msg);

});

//Default API /v1/service/ativar/
// ------------------------------------------Verificação de logins de ADM -----------------------------------
$app->get('/v1/login/adm/{login}', function ($request, $response, $args) {
    $login = $args['login'];
    $adm = Container::getModel("Adm");
    $dados = $adm->recuperarLoginAdm($login);
    $nome = "";
    $id = "";
    foreach($dados as $value){
        $nome = $value['login'];
        $id =$value['id_adm'];
    }
    $qtd = count($dados);
    $msg = "";
    if($qtd >= 1){
        $msg = ["loginAth"=>true,'dados'=>$nome,"id"=>$id];
    }else{
        $msg = ["loginAth"=>false];
    }

    return $response->withJson($msg);
});

// ------------------------------------------Ativar Funcionario -----------------------------------
$app->put('/v1/fun/ativar/{id}', function ($request, $response, $args) {
    $id =$args['id'];
    $fun = Container::getModel("Funcionario");
    $dados = $fun->ativarFuncionario($id);
    $msg = "";
    if($dados){
        $msg = ["ativar"=>true];
    }else{
        $msg =["ativar"=>false];
    }
    return $response->withJson($msg);

});
// ------------------------------------------Inativar Funcionario -----------------------------------
$app->put('/v1/fun/inativar/{id}', function ($request, $response, $args) {
    $id =$args['id'];
    $fun = Container::getModel("Funcionario");
    $dados = $fun->desativarFuncionario($id);
    $msg = "";
    if($dados){
        $msg = ["ativar"=>true];
    }else{
        $msg =["ativar"=>false];
    }
    return $response->withJson($msg);

});

// ------------------------------------------Ativar Serviço -----------------------------------
$app->put('/v1/service/ativar/{id}', function ($request, $response, $args) {
    $id = $args['id'];
    $produto = Container::getModel("Produto");
    $dados = $produto->ativarServico($id);
    $msg = null;
    if($dados){
        $msg = ["ativar"=>true];
    }else{
        $msg =["ativar"=>false];
    }
   

    return $response->withJson($msg);
});
// ------------------------------------------INativacao Serviço -----------------------------------
$app->put('/v1/service/inativar/{id}', function ($request, $response, $args) {
    $id = $args['id'];
    $produto = Container::getModel("Produto");
    $dados = $produto->inativarServico($id);
    $msg = null;
    if($dados){
        $msg = ["inativar"=>true];
    }else{
        $msg =["inativar"=>false];
    }
   

    return $response->withJson($msg);
});
// ------------------------------------------INativacao Produto -----------------------------------
$app->put('/v1/produto/inativar/{id}', function ($request, $response, $args) {
    $id = $args['id'];
    $produto = Container::getModel("Produto");
    $dados = $produto->inativarProduto($id);
    $dados = true;
    $msg = null;
    if($dados){
        $msg = ["inativar"=>true];
    }else{
        $msg =["inativar"=>false];
    }
   

    return $response->withJson($msg);
});
// ------------------------------------------Ativacao Produto -----------------------------------
$app->put('/v1/produto/ativar/{id}', function ($request, $response, $args) {
    $id = $args['id'];
    $produto = Container::getModel("Produto");
    $dados = $produto->ativarProduto($id);
   
    $msg = null;
    if($dados){
        $msg = ["inativar"=>true];
    }else{
        $msg =["inativar"=>false];
    }
   

    return $response->withJson($msg);
});
// ------------------------------------------Ativacao ADM -----------------------------------
$app->put('/v1/adm/ativar/{id}', function ($request, $response, $args) {
    $id = $args['id'];
    $adm = Container::getModel("Adm");
    $dados = $adm->ativarAdm($id);
    $msg = null;
    if($dados){
        $msg = ["ativar"=>true];
    }else{
        $msg =["ativar"=>false];
    }
   

    return $response->withJson($msg);
});
// ------------------------------------------Inativar ADM -----------------------------------
$app->put('/v1/adm/inativar/{id}', function ($request, $response, $args) {
    $id = $args['id'];
    $adm = Container::getModel("Adm");
    $dados = $adm->inativarAdm($id);
   
    $msg = null;
    if($dados){
        $msg = ["inativar"=>true];
    }else{
        $msg =["inativar"=>false];
    }
   

    return $response->withJson($msg);
});
// ------------------------------------------Login cliente-----------------------------------
$app->get('/v1/login/client/{login}/{senha}', function ($request, $response, $args) {
    $login = $args['login'];
    $senha = $args['senha'];
    $msg = null;
    $loginSenha = $login.$senha;
    $login64 = base64_encode($login);
    $cliente = Container::getModel("Cliente");
    $dados = $cliente->loginCliente($login64);
    if(count($dados) >=1){
        foreach($dados as $value){
            if($value['status_ativo']){
                if(password_verify($loginSenha,$value['token'])){
                    $msg = ["auth"=>true,"nome"=>$value['nome'],"id_cliente"=>$value['id_cliente']];
                    
                }else{
                    $msg = ["auth"=>false]; 
                }
            }else{
                $msg = ["auth"=>'inativo'];
            }
        }
    }else{
        $msg = ["auth"=>'null'];
    }
   
   

    return $response->withJson($msg);
});
// ------------------------------------------Alterar Despesas(Deixa como paga))-----------------------------------   
$app->put('/v1/update/adm/despesa/ativar/{id}', function ($request, $response, $args) {
    $contas = Container::getModel('Contas');
    $id = $args['id'];
    $dados = $contas->despesaPaga($id);
    $msg = "";
    if($dados){
        $msg = ['result'=>true];
    }else{
        $msg = ['result'=>false,'erro'=>$dados];
    }
    return $response->withJson($msg);
    
}); 
// ------------------------------------------Alterar Despesas(Deixa como paga))-----------------------------------   
$app->put('/v1/update/adm/despesa/inativar/{id}', function ($request, $response, $args) {
    $contas = Container::getModel('Contas');
    $id = $args['id'];
    $dados = $contas->despesaNaoPaga($id);
    $msg = "";
    if($dados){
        $msg = ['result'=>true];
    }else{
        $msg = ['result'=>false,'erro'=>$dados];
    }
    return $response->withJson($msg);
    
}); 

// ------------------------------------------Carregas Dados PAgamento-----------------------------------   
$app->get('/v1/search/adm/despesa/load', function ($request, $response, $args) {
    $contas = Container::getModel('Contas');
    $dados = $contas->getAllContaDataDefault();
    $msg = "";
    if(count($dados) >=1){
        $msg = ['result'=>true,$dados];
    }else{
        $msg = ['result'=>false];
    }
    return $response->withJson($msg);
    
}); 
// ------------------------------------------Pesquisar Dados PAgamento(Datas)-----------------------------------   
$app->get('/v1/search/adm/despesa/{inicial}/{final}', function ($request, $response, $args) {
    $contas = Container::getModel('Contas');
    $inicial = $args['inicial'];
    $final = $args['final'];
    $dados = $contas->getAllContaDataApi($inicial,$final);
    $msg = "";
    if(count($dados) >=1){
        $msg = ['result'=>true,$dados];
    }else{
        $msg = ['result'=>false];
    }
    return $response->withJson($msg);
    
}); 
// ------------------------------------------Atualizar Qtd-----------------------------------   
$app->post('/v1/update/adm/produto/qtd', function ($request, $response, $args) {
    $produto = Container::getModel('Produto');
    $dados = $produto->atualizarQtdProduto($_POST['id'],$_POST['qtd']);
    $msg = "";
    if($dados == true){
        $msg = ['result'=>true];
    }else{
        $msg = ['result'=>false];
    }
    return $response->withJson($msg);
    
}); 
// ------------------------------------------Salvar Troca dados-----------------------------------   
$app->post('/v1/save/fun/save/troca', function ($request, $response, $args) {
    $troca = Container::getModel('Troca');
    session_start();
    $date = date('Y-m-d h:i:s');
    $troca->__set('nome_cliente',$_POST['nome']);
    $troca->__set('funcionario',$_SESSION['nome_fun']);
    $troca->__set('produto_novo',$_POST['produto_novo']);
    $troca->__set('produto_antigo',$_POST['produto_antigo']);
    $troca->__set('diferenca',$_POST['diferenca']);
    $troca->__set('qtd',$_POST['qtd']);
    $troca->__set('entrada',$_POST['valor']);
    $troca->__set('data_troca',$date);
    $dados = $troca->salvarDadosTroca();
    $msg = "";
    if($dados){
        $msg = ['result'=>true];
    }else{
        $msg = ['result'=>false];
    }
    return $response->withJson($msg);

    
    
}); 
// Run app
$app->run();