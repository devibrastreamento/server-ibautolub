<?php 
namespace app;
use mf\init\BootStrap;

class Route extends BootStrap{
    /**
     * AjaxController - UI Ajax Componentes
     * AjaxControllerFucionario - UI Ajax Componentes Funcionarios
     * ErroController - Tratamento de erros ADM
     * ErroControllerFuncionario - Tratamento de Erros Funcionario
     * LoginController - login UI
     * IndexController - Site UI 
     * SucessController - Sucesso UI ADM
     * SucessControllerFuncionario - Sucesso UI FUuncionario
     * VendasController - FUncionario UI
     * GerencimentoController - UI ADM
     * ProcessamentoDadosAdm - Tratamento dados ADM
     * ProcessamentoDadosVendas - Tratamento dados Funcinario
     */
   
    public function initRoute(){
         // Rotas  Login---------------------------------------------------------------------------------------------------------Teste Porta------------------------------------------------
        $route['teste'] = [
            'route'=>'/teste',
            'controller'=>'IndexController',
            'action'=>'teste'
        ];
        // Rotas  Login---------------------------------------------------------------------------------------------------------Teste Porta - FIM------------------------------------------------
        $route['home'] = [
            'route'=>'/',
            'controller'=>'IndexController',
            'action'=>'home'
        ];
        $route['sobrenos'] = [
            'route'=>'/sobrenos',
            'controller'=>'IndexController',
            'action'=>'sobreNos'
        ];
         // Rotas  Login---------------------------------------------------------------------------------------------------------
         $route['loginAdm'] = [
            'route'=>'/app/login/adm',
            'controller'=>'LoginController',
            'action'=>'loginAdm'
        ];
        $route['loginUser'] = [
            'route'=>'/app/login/user',
            'controller'=>'LoginController',
            'action'=>'loginUser'
        ];
        $route['loginFun'] = [
            'route'=>'/app/login/fun',
            'controller'=>'LoginController',
            'action'=>'loginFun'
        ];
        $route['loginCliente'] = [
            'route'=>'/app/login/client',
            'controller'=>'LoginController',
            'action'=>'loginCliente'
        ];
        // Rotas  Fun/Vendas------------------------------------------------------------------------------------------------------
        $route['home'] = [
            'route'=>'/app/fun/home',
            'controller'=>'VendasController',
            'action'=>'home'
        ];
        $route['cadastroClientes'] = [
            'route'=>'/app/fun/cadastrar_cliente',
            'controller'=>'VendasController',
            'action'=>'cadastroClientes'
        ];
        $route['registrarVendas'] = [
            'route'=>'/app/fun/venda',
            'controller'=>'VendasController',
            'action'=>'registrarVendas'
        ];
        $route['buscarVendas'] = [
            'route'=>'/app/fun/pesquisar_venda',
            'controller'=>'VendasController',
            'action'=>'buscarVendas'
        ];
        $route['detalheVendas'] = [
            'route'=>'/app/fun/detalhes_compra',
            'controller'=>'VendasController',
            'action'=>'detalheVendas'
        ];
        $route['gerenciadorCadastroFuncionario'] = [
            'route'=>'/app/fun/manager_product',
            'controller'=>'VendasController',
            'action'=>'gerenciadorCadastroFuncionario'
        ];
        $route['cadastrarProdutoFuncionario'] = [
            'route'=>'/app/fun/add_product',
            'controller'=>'VendasController',
            'action'=>'cadastrarProdutoFuncionario'
        ];
        $route['cadastrarServicoFuncionario'] = [
            'route'=>'/app/fun/add_service',
            'controller'=>'VendasController',
            'action'=>'cadastrarServicoFuncionario'
        ];
        $route['managerClient'] = [
            'route'=>'/app/fun/manager_client',
            'controller'=>'VendasController',
            'action'=>'managerClient'
        ];
        $route['editarDadosCliente'] = [
            'route'=>'/app/fun/edit_client',
            'controller'=>'VendasController',
            'action'=>'editarDadosCliente'
        ];
        $route['addCarClient'] = [
            'route'=>'/app/fun/add_car_client',
            'controller'=>'VendasController',
            'action'=>'addCarClient'
        ];
        $route['editarSenhaCliente'] = [
            'route'=>'/app/fun/edit_password_client',
            'controller'=>'VendasController',
            'action'=>'editarSenhaCliente'
        ];
        $route['orcamentoVendas'] = [
            'route'=>'/app/fun/orcamento',
            'controller'=>'VendasController',
            'action'=>'orcamentoVendas'
        ];
        $route['detalheVeiculoFuncionario'] = [
            'route'=>'/app/fun/detalhe_veiculo',
            'controller'=>'VendasController',
            'action'=>'detalheVeiculoFuncionario'
        ];
        $route['historicoVendasFuncionario'] = [
            'route'=>'/app/fun/historico_vendas',
            'controller'=>'VendasController',
            'action'=>'historicoVendasFuncionario'
        ];
        $route['trocaDevolucao'] = [
            'route'=>'/app/fun/troca_devolucao',
            'controller'=>'VendasController',
            'action'=>'trocaDevolucao'
        ];
        
        
        
         // Rotas Processamento de dados Fun LOgin------------------------------------------------------------------------------------------------------
         $route['loginProcessoFun'] = [
            'route'=>'/app/login/processo_fun',
            'controller'=>'LoginControllerProcesso',
            'action'=>'loginProcessoFun'
        ];
        $route['loginProcessoCliente'] = [
            'route'=>'/app/login/processo_cliente',
            'controller'=>'LoginControllerProcesso',
            'action'=>'loginProcessoCliente'
        ];
         // Rotas Clientes View---------------------------------------------------------------------------------------------------------
         $route['homeClient'] = [
            'route'=>'/app/client/home',
            'controller'=>'ClientController',
            'action'=>'homeClient'
        ];
        $route['agendamentoCliente'] = [
            'route'=>'/app/client/agendamento',
            'controller'=>'ClientController',
            'action'=>'agendamentoCliente'
        ];
        $route['historicoCompras'] = [
            'route'=>'/app/client/history',
            'controller'=>'ClientController',
            'action'=>'historicoCompras'
        ];
        $route['detalheVendaCliente'] = [
            'route'=>'/app/client/venda_detalhe',
            'controller'=>'ClientController',
            'action'=>'detalheVendaCliente'
        ];
        $route['adicionarVeiculo'] = [
            'route'=>'/app/client/add_car',
            'controller'=>'ClientController',
            'action'=>'adicionarVeiculo'
        ];
        $route['detalheVeiculo'] = [
            'route'=>'/app/client/detalhe_veiculo',
            'controller'=>'ClientController',
            'action'=>'detalheVeiculo'
        ];
        $route['listagemProdutosCliente'] = [
            'route'=>'/app/client/list_product',
            'controller'=>'ClientController',
            'action'=>'listagemProdutosCliente'
        ];
        $route['gerenciamentoPerfil'] = [
            'route'=>'/app/client/manager_profile',
            'controller'=>'ClientController',
            'action'=>'gerenciamentoPerfil'
        ];
        $route['encerrarSessao'] = [
            'route'=>'/app/client/sair',
            'controller'=>'LoginControllerProcesso',
            'action'=>'encerrarSessao'
        ];
         // Rotas PRocessamento Client---------------------------------------------------------------------------------------------------------
         $route['atualizarDadosBasico'] = [
            'route'=>'/app/client/proccess_basic',
            'controller'=>'ClientDadosController',
            'action'=>'atualizarDadosBasico'
        ];
        $route['atualizarDadosSenha'] = [
            'route'=>'/app/client/proccess_password',
            'controller'=>'ClientDadosController',
            'action'=>'atualizarDadosSenha'
        ];
        // Rotas ADM View---------------------------------------------------------------------------------------------------------
        $route['homeGerencimaneto'] = [
            'route'=>'/app/adm/home',
            'controller'=>'GerenciamentoController',
            'action'=>'homeGerencimaneto'
        ];
        $route['admCadastro'] = [
            'route'=>'/app/adm/cadastro_usuario',
            'controller'=>'GerenciamentoController',
            'action'=>'admCadastro'
        ];
        $route['cadastrarUsuario'] = [
            'route'=>'/app/adm/form_add_user',
            'controller'=>'GerenciamentoController',
            'action'=>'cadastrarUsuario'
        ];
        $route['lsitagemFuncionarios'] = [
            'route'=>'/app/adm/listagem',
            'controller'=>'GerenciamentoController',
            'action'=>'lsitagemFuncionarios'
        ];
        
        $route['adicionarFuncaoView'] = [
            'route'=>'/app/adm/form_add_funcao',
            'controller'=>'GerenciamentoController',
            'action'=>'adicionarFuncaoView'
        ];
        $route['adicionarAdmView'] = [
            'route'=>'/app/adm/form_add_adm',
            'controller'=>'GerenciamentoController',
            'action'=>'adicionarAdmView'
        ];
        $route['editarUsuario'] = [
            'route'=>'/app/adm/edit_user',
            'controller'=>'GerenciamentoController',
            'action'=>'editarUsuario'
        ];
        $route['editarSenhaUsuario'] = [
            'route'=>'/app/adm/edit_password',
            'controller'=>'GerenciamentoController',
            'action'=>'editarSenhaUsuario'
        ];
        $route['gerenciamentoProdutos'] = [
            'route'=>'/app/adm/manager_product',
            'controller'=>'GerenciamentoController',
            'action'=>'gerenciamentoProdutos'
        ];
        $route['cadastrarProduto'] = [
            'route'=>'/app/adm/add_product',
            'controller'=>'GerenciamentoController',
            'action'=>'cadastrarProduto'
        ];
        $route['cadastrarServico'] = [
            'route'=>'/app/adm/add_service',
            'controller'=>'GerenciamentoController',
            'action'=>'cadastrarServico'
        ];
        $route['gerenciamentoView'] = [
            'route'=>'/app/adm/manager_view',
            'controller'=>'GerenciamentoController',
            'action'=>'gerenciamentoView'
        ];
        $route['editarServico'] = [
            'route'=>'/app/adm/edit_service',
            'controller'=>'GerenciamentoController',
            'action'=>'editarServico'
        ];
        $route['editarProduto'] = [
            'route'=>'/app/adm/edit_product',
            'controller'=>'GerenciamentoController',
            'action'=>'editarProduto'
        ];
        $route['editarAdm'] = [
            'route'=>'/app/adm/edit_adm',
            'controller'=>'GerenciamentoController',
            'action'=>'editarAdm'
        ];
        $route['editarSenhaAdm'] = [
            'route'=>'/app/adm/edit_adm_password',
            'controller'=>'GerenciamentoController',
            'action'=>'editarSenhaAdm'
        ];
        $route['editarPerfilAdm'] = [
            'route'=>'/app/adm/edit_profile',
            'controller'=>'GerenciamentoController',
            'action'=>'editarPerfilAdm'
        ];
        $route['relatorioAdm'] = [
            'route'=>'/app/adm/report',
            'controller'=>'GerenciamentoController',
            'action'=>'relatorioAdm'
        ];
        $route['contasPagar'] = [
            'route'=>'/app/adm/contas_apagar',
            'controller'=>'GerenciamentoController',
            'action'=>'contasPagar'
        ];
        $route['viewDespesas'] = [
            'route'=>'/app/adm/despesas_adm',
            'controller'=>'GerenciamentoController',
            'action'=>'viewDespesas'
        ];
        $route['addQtdProdutos'] = [
            'route'=>'/app/adm/add_qtd_product',
            'controller'=>'GerenciamentoController',
            'action'=>'addQtdProdutos'
        ];
        $route['historico'] = [
            'route'=>'/app/adm/history',
            'controller'=>'GerenciamentoController',
            'action'=>'historico'
        ];
        // Finalizar sessao
        $route['finalizarSessao'] = [
            'route'=>'/app/adm/finalizar_sessao',
            'controller'=>'LoginControllerProcesso',
            'action'=>'finalizarSessao'
        ];
        $route['finalizarSessaoFun'] = [
            'route'=>'/app/fun/finalizar_sessao',
            'controller'=>'LoginControllerProcesso',
            'action'=>'finalizarSessaoFun'
        ];
        // Rotas Processamento de dados Vendas------------------------------------------------------------------------------------------------------
        $route['salvarDadosBasicos'] = [
            'route'=>'/app/fun/salvar_dados_basico',
            'controller'=>'ProcessamentoDadosVendas',
            'action'=>'salvarDadosBasicos'
        ];
        $route['salvaVenda'] = [
            'route'=>'/app/fun/salvar_venda',
            'controller'=>'ProcessamentoDadosVendas',
            'action'=>'salvaVenda'
        ];
        $route['salvarProduto'] = [
            'route'=>'/app/fun/adicionar_produto',
            'controller'=>'ProcessamentoDadosVendas',
            'action'=>'salvarProduto'
        ];
        $route['salvarServico'] = [
            'route'=>'/app/fun/adicionar_servico',
            'controller'=>'ProcessamentoDadosVendas',
            'action'=>'salvarServico'
        ];
        $route['editaDadosCliente'] = [
            'route'=>'/app/fun/editar_funcionario',
            'controller'=>'ProcessamentoDadosVendas',
            'action'=>'editaDadosCliente'
        ];
        $route['editPasswordClient'] = [
            'route'=>'/app/fun/edit_password',
            'controller'=>'ProcessamentoDadosVendas',
            'action'=>'editPasswordClient'
        ];
        $route['salvarOrcamento'] = [
            'route'=>'/app/fun/salvar_orcamento',
            'controller'=>'ProcessamentoDadosVendas',
            'action'=>'salvarOrcamento'
        ];
        // Rotas Processamento de dados ADM------------------------------------------------------------------------------------------------------
        $route['loginProcessoAdm'] = [
            'route'=>'/app/login/processo_adm',
            'controller'=>'LoginControllerProcesso',
            'action'=>'loginProcessoAdm'
        ];
        $route['cadastrarNovaFuncao'] = [
            'route'=>'/app/adm/cadastro_funcao',
            'controller'=>'ProcessamentoDadosAdm',
            'action'=>'cadastrarNovaFuncao'
        ];
        $route['cadastrarNovoAdm'] = [
            'route'=>'/app/adm/cadastro_adm',
            'controller'=>'ProcessamentoDadosAdm',
            'action'=>'cadastrarNovoAdm'
        ];
        $route['cadastrarFuncinario'] = [
            'route'=>'/app/adm/cadastrar_funcionario',
            'controller'=>'ProcessamentoDadosAdm',
            'action'=>'cadastrarFuncinario'
        ];
        $route['atualizarDadosFuncionario'] = [
            'route'=>'/app/adm/update_user',
            'controller'=>'ProcessamentoDadosAdm',
            'action'=>'atualizarDadosFuncionario'
        ];
        $route['atualizarSenhaFuncionario'] = [
            'route'=>'/app/adm/update_password',
            'controller'=>'ProcessamentoDadosAdm',
            'action'=>'atualizarSenhaFuncionario'
        ];
        $route['desativarFuncionario'] = [
            'route'=>'/app/adm/desativar_usuario',
            'controller'=>'ProcessamentoDadosAdm',
            'action'=>'desativarFuncionario'
        ];
        $route['ativarFuncionario'] = [
            'route'=>'/app/adm/ativar_usuario',
            'controller'=>'ProcessamentoDadosAdm',
            'action'=>'ativarFuncionario'
        ];
        $route['adicionarProduto'] = [
            'route'=>'/app/adm/adicionar_produto',
            'controller'=>'ProcessamentoDadosAdm',
            'action'=>'adicionarProduto'
        ];
        $route['adicionarServico'] = [
            'route'=>'/app/adm/adicionar_servico',
            'controller'=>'ProcessamentoDadosAdm',
            'action'=>'adicionarServico'
        ];
        $route['editServiceManager'] = [
            'route'=>'/app/adm/edit_service_manager',
            'controller'=>'ProcessamentoDadosAdm',
            'action'=>'editServiceManager'
        ];
        
        /*
        @Deprecated
        $route['ativarServicoManager'] = [
            'route'=>'/app/adm/ativar_service_manager',
            'controller'=>'ProcessamentoDadosAdm',
            'action'=>'ativarServicoManager'
        ];
        @Deprecated
        $route['inativarServiceManager'] = [
            'route'=>'/app/adm/inativar_service_manager',
            'controller'=>'ProcessamentoDadosAdm',
            'action'=>'inativarServiceManager'
        ];*/
        $route['editProductManager'] = [
            'route'=>'/app/adm/edit_product_manager',
            'controller'=>'ProcessamentoDadosAdm',
            'action'=>'editProductManager'
        ];
        $route['editAdmManager'] = [
            'route'=>'/app/adm/edit_adm_manager',
            'controller'=>'ProcessamentoDadosAdm',
            'action'=>'editAdmManager'
        ];
        $route['editSenhaManager'] = [
            'route'=>'/app/adm/edit_manager_password',
            'controller'=>'ProcessamentoDadosAdm',
            'action'=>'editSenhaManager'
        ];
        $route['excluirProfissao'] = [
            'route'=>'/app/adm/excluir_funcao',
            'controller'=>'ProcessamentoDadosAdm',
            'action'=>'excluirProfissao'
        ];
       
        
        
         // Rotas Ajax ---------------------------------------------------------------------------------------------------------
         $route['listagemServico'] = [
            'route'=>'/app/adm/ajax/listagem_servico',
            'controller'=>'AjaxController',
            'action'=>'listagemServico'
        ];
        $route['listagemProduto'] = [
            'route'=>'/app/adm/ajax/listagem_produtos',
            'controller'=>'AjaxController',
            'action'=>'listagemProduto'
        ];
        $route['listagemAdm'] = [
            'route'=>'/app/adm/ajax/listagem_adm',
            'controller'=>'AjaxController',
            'action'=>'listagemAdm'
        ];
       
        $route['listagemFuncionario'] = [
            'route'=>'/app/adm/ajax/listagem_funcionario',
            'controller'=>'AjaxController',
            'action'=>'listagemFuncionario'
        ];
        
        $route['listagemCaixa'] = [
            'route'=>'/app/adm/ajax/listagem_caixa',
            'controller'=>'AjaxController',
            'action'=>'listagemCaixa'
        ];
        $route['relatorioVendas'] = [
            'route'=>'/app/fun/ajax/relatorio_venda',
            'controller'=>'AjaxController',
            'action'=>'relatorioVendas'
        ];
        $route['relatorioEstoque'] = [
            'route'=>'/app/fun/ajax/relatorio_estoque',
            'controller'=>'AjaxController',
            'action'=>'relatorioEstoque'
        ];
        $route['contasPagarAjax'] = [
            'route'=>'/app/fun/ajax/contas',
            'controller'=>'AjaxController',
            'action'=>'contasPagarAjax'
        ];
        $route['listReportVendas'] = [
            'route'=>'/app/fun/ajax/list_vendas',
            'controller'=>'AjaxController',
            'action'=>'listReportVendas'
        ];
        $route['listReportEstoque'] = [
            'route'=>'/app/fun/ajax/list_estoque',
            'controller'=>'AjaxController',
            'action'=>'listReportEstoque'
        ];
        $route['tabelaProdutos'] = [
            'route'=>'/app/fun/ajax/tabela_produtos',
            'controller'=>'AjaxController',
            'action'=>'tabelaProdutos'
        ];
        $route['historicoVendas'] = [
            'route'=>'/app/fun/ajax/tabela_vendas',
            'controller'=>'AjaxController',
            'action'=>'historicoVendas'
        ];
        $route['historicoSistema'] = [
            'route'=>'/app/fun/ajax/tabela_sistema',
            'controller'=>'AjaxController',
            'action'=>'historicoSistema'
        ];
        $route['historicoErro'] = [
            'route'=>'/app/fun/ajax/tabela_erro',
            'controller'=>'AjaxController',
            'action'=>'historicoErro'
        ];
        $route['historicoTroca'] = [
            'route'=>'/app/fun/ajax/tabela_troca',
            'controller'=>'AjaxController',
            'action'=>'historicoTroca'
        ];
         // -----------------------------------------------------------Ajac Funcionario
        $route['visualizarTabelProduto'] = [
            'route'=>'/app/fun/ajax/visualizar_tabela_produto',
            'controller'=>'AjaxControllerFucionario',
            'action'=>'visualizarTabelProduto'
        ];
        $route['listagemProdutosTabela'] = [
            'route'=>'/app/fun/ajax/listagem_produto',
            'controller'=>'AjaxControllerFucionario',
            'action'=>'listagemProdutosTabela'
        ];
        $route['consultaCompras'] = [
            'route'=>'/app/fun/ajax/consulta_compras',
            'controller'=>'AjaxControllerFucionario',
            'action'=>'consultaCompras'
        ];
        
        
        
        $route['consultarCliente'] = [
            'route'=>'/app/fun/ajax/consultar_cliente',
            'controller'=>'AjaxControllerFucionario',
            'action'=>'consultarCliente'
        ];
        $route['recuperarVeiculo'] = [
            'route'=>'/app/fun/ajax/get_carr',
            'controller'=>'AjaxControllerFucionario',
            'action'=>'recuperarVeiculo'
        ];
        $route['historicoVendaFuncionario'] = [
            'route'=>'/app/fun/ajax/tabela_funcionario_vendas',
            'controller'=>'AjaxControllerFucionario',
            'action'=>'historicoVendaFuncionario'
        ];
        $route['historicoTrocaFuncionario'] = [
            'route'=>'/app/fun/ajax/tabela_funcionario_troca',
            'controller'=>'AjaxControllerFucionario',
            'action'=>'historicoTrocaFuncionario'
        ];
        $route['listagemHistorico'] = [
            'route'=>'/app/fun/ajax/listagem_historico',
            'controller'=>'AjaxControllerFucionario',
            'action'=>'listagemHistorico'
        ];
        
        // Ajax Cliente--------------------------------------------------------
        $route['recuperarGastosCliente'] = [
            'route'=>'/app/fun/ajax/consultar_compra_cliente',
            'controller'=>'AjaxControllerCliente',
            'action'=>'recuperarGastosCliente'
        ];
        $route['recuperarVeiculoCliente'] = [
            'route'=>'/app/fun/ajax/consultar_carro_cliente',
            'controller'=>'AjaxControllerCliente',
            'action'=>'recuperarVeiculoCliente'
        ];
        $route['recuperarListagemProduto'] = [
            'route'=>'/app/fun/ajax/consultar_produto',
            'controller'=>'AjaxControllerCliente',
            'action'=>'recuperarListagemProduto'
        ];
        
        


 // Rotas Sucesso ADm ---------------------------------------------------------------------------------------------------------

    $route['sucessoInfo'] = [
            'route'=>'/app/adm/sucesso',
            'controller'=>'SucessoController',
            'action'=>'sucessoInfo'
        ];
        
 // Rotas Sucesso Cliente ---------------------------------------------------------------------------------------------------------

 $route['sucessoClient'] = [
    'route'=>'/app/client/sucesso',
    'controller'=>'SucessoClientController',
    'action'=>'sucessoClient'
];
 // Rotas Erro Cliente ---------------------------------------------------------------------------------------------------------

 $route['erroClient'] = [
    'route'=>'/app/client/erro',
    'controller'=>'ErroClientController',
    'action'=>'erroClient'
];

// Rotas Erros ADm ---------------------------------------------------------------------------------------------------------

$route['erroInfo'] = [
    'route'=>'/app/adm/erro',
    'controller'=>'ErroController',
    'action'=>'erroInfo'
];
// Rotas Erros Vendas ---------------------------------------------------------------------------------------------------------

$route['erroInfoFun'] = [
    'route'=>'/app/fun/erro',
    'controller'=>'ErroControllerFuncionario',
    'action'=>'erroInfoFun'
];
 // Rotas Sucesso Vendas ---------------------------------------------------------------------------------------------------------

 $route['sucessoInfoFun'] = [
    'route'=>'/app/fun/sucesso',
    'controller'=>'SucessoControllerFuncionario',
    'action'=>'sucessoInfoFun'
];
 // Rotas Impressão nota Fiscal---------------------------------------------------------------------------------------------------------
$route['sucessoInfoFun'] = [
    'route'=>'/app/fun/imprimir_nota_nao_fiscal',
    'controller'=>'VendasController',
    'action'=>'imprimirDados'
];



        $this->setRoute($route);
    }
}


?>