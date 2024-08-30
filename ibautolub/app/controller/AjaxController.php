<?php

namespace app\controller;

use mf\action\Action;
use mf\model\Container;

class AjaxController extends Action
{
    private $layout_ajax = 'layout_ajax';

    public function listagemServico()
    {
        $this->verificarUsuarioLogado();
        $servico = Container::getModel('Produto');
        $dados = $servico->getQtdTotal();
        $this->view->qtd = [];
        foreach ($dados as $value) {
            $this->view->qtd = $value;
        }
        $this->view->dados = $servico->listagemServico();

        $this->render('listagem_servico', $this->layout_ajax);
    }
    public function listagemProduto()
    {
        $this->verificarUsuarioLogado();
        $servico = Container::getModel('Produto');
        $dados = $servico->getQtdTotalProduto();
        $this->view->qtd = [];
        foreach ($dados as $value) {
            $this->view->qtd = $value;
        }
        $this->view->dados = $servico->listagemProduto();

        $this->render('listagem_produtos', $this->layout_ajax);
    }
    public function listagemAdm()
    {
        $this->verificarUsuarioLogado();
        $adm = Container::getModel('Adm');
        $this->view->dados = $adm->listarAdm();
        $dados = $adm->getQtdTotal();
        $this->view->qtd = [];
        foreach ($dados as $value) {
            $this->view->qtd = $value;
        }


        $this->render('listagem_adm', $this->layout_ajax);
    }
    public function listagemFuncionario()
    {
        $this->verificarUsuarioLogado();
        $fun = Container::getModel('Funcionario');
        $this->view->dados = $fun->getAllFuncionario();
        $dados = $fun->getTotalFuncionario();
        $this->view->qtd = [];
        foreach ($dados as $value) {
            $this->view->qtd = $value;
        }


        $this->render('listagem_funcionario', $this->layout_ajax);
    }
    public function listagemCaixa()
    {
        $this->verificarUsuarioLogado();
        $venda = Container::getModel('Vendas');
        $dt_final  = date('Y-m-d');
        $configDataDia = date('d') - 1;
       
        $dt_inicial  = date('Y-m-') . $configDataDia;
        $dados = $venda->vendaEfetuadasTipo($dt_inicial, $dt_final);
        $qtdDados = $venda->qtdItensVendioData($dt_inicial,$dt_final);
        $this->view->somaVenda = "0.00";
        $this->view->dados = [];
        $this->view->qtdDados = [];
        foreach ($dados as $value) {
            $this->view->dados = $value;
            $valor  = ($this->view->dados['dinheiro'] + $this->view->dados['pix'] + $this->view->dados['credito'] + $this->view->dados['debito']);
            $this->view->somaVenda = str_replace('.',',',$valor);
        }
        foreach ($qtdDados as $item) {
            $this->view->qtdDados = $item;
        }

        if (isset($_GET['dt_inicial'])) {
            $dt_inicial = $_GET['dt_inicial'];
            $dt_final = $_GET['dt_final'];
            $dados = $venda->vendaEfetuadasTipo($dt_inicial, $dt_final);
            $qtdDados = $venda->qtdItensVendioData($dt_inicial,$dt_final);
            $this->view->dados = [];
            $this->view->somaVenda = "0,00";
            foreach ($dados as $value) {
                $this->view->dados = $value;
                $valor  = ($this->view->dados['dinheiro'] + $this->view->dados['pix'] + $this->view->dados['credito'] + $this->view->dados['debito']);
                $this->view->somaVenda = str_replace('.',',',$valor);
            }
            foreach ($qtdDados as $item) {
                $this->view->qtdDados = $item;
            }
            
        }
        $this->view->data_inicial = $dt_inicial;
        $this->view->data_final = $dt_final;

        
        $this->render('listagem_caixa', $this->layout_ajax);
    }
    public function relatorioVendas()
    {
        echo 'ola';
        $this->verificarUsuarioLogado();
        $inicio = $_GET['dt_inicial'];
        $final = $_GET['dt_final'];
        $hist = Container::getModel('Historico');
        $fun = Container::getModel('Funcionario');
        $venda = Container::getModel('Vendas');
        $this->view->dados = $hist->getRelatorioVendasPreView($inicio, $final);
        $this->view->servico = $hist->getRelatorioServico($inicio, $final);
        $this->view->topFiveProduct = $hist->getTopFiveProduct($inicio, $final);
        $this->view->topFiveService = $hist->getTopFiveService($inicio, $final);
        $dados = $fun->getAllFuncionario();
        $dadosVenda = $venda->getDataVendaAdm($inicio, $final);
        $this->view->servico = 
        $array = [];
        $j = 0;
       
        
        foreach ($dados as $value) {
            $array[$j] = $hist->getTopFiveFun($value['id_funcionario']);
            $this->view->somaVenda .= $value['preco'];
            
            $j++;
        }

        foreach ($dadosVenda as $value) {
            $this->view->dadosVenda = array_filter($value);
        }
        $this->view->qtdFun = array_filter($array);
        
        $this->render('relatorio_venda', $this->layout_ajax);
        
       
    }
    public function relatorioEstoque()
    {
        $this->verificarUsuarioLogado();
        $produto = Container::getModel('Produto');
        $inicio = $_GET['dt_inicial'];
        $final = $_GET['dt_final'];
        $this->view->dados = $produto->getListPreviewEstoque($inicio,$final);
        $this->render('relatorio_estoque', $this->layout_ajax);
    }
    public function contasPagarAjax()
    {
        
        $this->verificarUsuarioLogado();
        $contas = Container::getModel('Contas');
        $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;
        $this->view->dados = $contas->getAllContas();
        $this->view->dadosDefault = $contas->getAllContaDataDefault();
        if($acao == 'data'){
            $incial = $_GET['dt_inicial'];
            $final = $_GET['dt_final'];
            $this->view->dados = $contas->getAllContaData($incial,$final);
        }else if($acao == 'ativo' || $acao == 'inativo'){
            $this->view->dados  = $contas->pesquisaContaStatus($acao);
           
        }
        
        
        $this->render('contas_a_pagar', $this->layout_ajax);
    }
    public function listReportVendas()
    {
        
        $this->verificarUsuarioLogado();
        $inicio = $_GET['dt_inicial'];
        $final = $_GET['dt_final'];
        $hist = Container::getModel('Historico');
        
        $this->view->dados = $hist->getListReport($inicio,$final);
        $this->render('table_body_vendas', $this->layout_ajax);
    }
    public function listReportEstoque()
    {
        
        $this->verificarUsuarioLogado();
        $inicio = $_GET['dt_inicial'];
        $final = $_GET['dt_final'];
        $produto = Container::getModel('Produto');
        $this->view->dados = $produto->listagemProdutoEstoque($inicio,$final);
        $this->render('table_body_estoque', $this->layout_ajax);
    }
    public function tabelaProdutos()
    {
        $produto = Container::getModel('Produto');
        $this->verificarUsuarioLogado();
        $this->view->dados = $produto->listagemProduto();
        if($_GET['pesquisa']){
            $this->view->dados = $produto->pesquisarProdutoCadastrado($_GET['pesquisa']);
        }
        $this->render('tabela_adicionar_produto', $this->layout_ajax);
    }
    public function historicoVendas()
    {
      
        $this->verificarUsuarioLogado();
        $venda = Container::getModel('Vendas');
        $this->view->dados = $venda->getAllVenda();
        $this->render('tabela_historico_vendas', $this->layout_ajax);
    }
    public function historicoSistema()
    {
      
        $this->verificarUsuarioLogado();
        $log = Container::getModel('Log');
        $this->view->dados = $log->listagemEventoSistema();
        $this->render('tabela_historico_sistema', $this->layout_ajax);
    }
    public function historicoErro()
    {
      
        $this->verificarUsuarioLogado();
        $log = Container::getModel('Log');
        $this->view->dados = $log->listagemErroSistema();
        $this->render('tabela_historico_erro', $this->layout_ajax);
    }
    public function historicoTroca()
    {
      
        $this->verificarUsuarioLogado();
        $troca = Container::getModel('Troca');
        $this->view->dados = $troca->getAllTroca();
        $this->render('tabela_historico_troca', $this->layout_ajax);
    }
    public function verificarUsuarioLogado()
    {
        session_start();
        if ($_SESSION['login'] != 'S') {
            header('location:/app/login/adm?erro=login_invalido');
        }
    }
    
}
