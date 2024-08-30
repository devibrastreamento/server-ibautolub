
localhost= "http://192.168.1.206"


let id_usuario_logado = null
function carregarUsuarioLogado(id){
    id_usuario_logad = id
    
}

function abrirJanela(urlTo,name,backUrl){
    
    location.href="/app/fun/"+urlTo+"?n="+btoa(name)+"&b="+btoa(backUrl);
}
function abrirJanelaComParametros(urlTo,name,backUrl){
    location.href="/app/fun/"+urlTo+"&n="+btoa(name)+"&b="+btoa(backUrl);
}
function salvarDados(){
    let form = document.getElementById('form_cadastro_cliente_basico')
    let btn = document.getElementById('salvar_dados_basico')
    let nome = document.getElementById('nome')
    let email = document.getElementById('email')
    let telefone = document.getElementById('telefone')
    let cpf_cnpj = document.getElementById('cpf_cnpj')
    let login = document.getElementById('login')
    let senha = document.getElementById('senha')
    let senha2 = document.getElementById('senha2')
    let cron = 3000
    if( nome.value == "" || email.value == "" || telefone.value == "" || cpf_cnpj.value== ""
|| login.value == ""|| senha.value == ""){
    msg.className = "mostrar"
    let i = 0
    const temp = setInterval(()=>{
        while( i < cron){
           
            if( i == 2500){
                msg.className = "apagar"
                clearTimeout(temp)
            }
            i++
        }
    },cron)
}else{
    if(senha.value != senha2.value){
        senha.className = "form-control is-invalid"
        senha2.className = "form-control is-invalid"
    }else{
        senha.className = "form-control"
        senha2.className = "form-control"
        form.action = "/app/fun/salvar_dados_basico"
        form.method="post"
        btn.type="submit"
        
    }
}
}
function verificarNomeLogin(id_valor,id_btn){
    let btn = document.getElementById(id_btn)
    let input = document.getElementById(id_valor)
    let url = "/api/v1/login/user/"+btoa(input.value)
    let xml = new XMLHttpRequest();
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            let json = JSON.parse(dados)
            if(json.loginAth){
                input.className = "form-control is-invalid"
                btn.disabled = true
            }else{
                input.className = "form-control"
                btn.disabled = false
            }
        }
    }
    xml.send()
}
function marcarServico(){
    let servico = document.getElementById('div_servico')
    let veiculo = document.getElementById('div_veiculo')
    let classeAtual = servico.className
    if(classeAtual == 'remove'){
        servico.className = "add"
        veiculo.className = "add"
    }else{
        document.getElementById('opcao_servico').value = ""
        document.getElementById('opcao_veiculo').value = ""
        servico.className = "remove"
        veiculo.className = "remove"
    }
}
function marcarProduto(){
    let servico = document.getElementById('div_produto')
   
    let classeAtual = servico.className
    if(classeAtual == 'remove'){
        servico.className = "add"
        
    }else{
        servico.className = "remove"
        document.getElementById('opcao_produto').value = ""
       
    }
}
var id_cliente_universal;
function procurarProduto(){
    let id_cliente = document.getElementById('cliente_id').value
    let btn = document.getElementById('btn_pesquisar')
    if(id_cliente == ''){
        alert('escolha um cliente')
        
    }else{
        id_cliente_universal = id_cliente 
        let dados = document.getElementById('nome_produto').value
        abrirResultadoPesquisa(dados)
    }
   
    
}

function abrirResultadoPesquisa(valor){
    let div = document.getElementById('result_produto')
    let url = localhost+"/app/fun/ajax/visualizar_tabela_produto?produto="+valor;
    let xml = new XMLHttpRequest();
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4  && xml.status == 200){
            let dados = xml.responseText
            div.innerHTML = dados
        }
    }
    xml.send()


}
function fecharPainelProduto(){
    let div = document.getElementById('painel_geral')
    div.className = "apagar"
}
function retirarQtd(id,qtd_estoque){
    let botao = document.getElementById('btn_'+id)
    botao.disabled = false
    let qtd = document.getElementById('result_'+id)
    let qtd_atual = parseInt(qtd.innerText)
    if(qtd_atual <= 0){
        qtd.className = "text-danger"
        botao.disabled = true
        qtd.innerText = 1
    }else{
        botao.disabled = false
        qtd.innerText = --qtd_atual
    }
    
}
function aumentarQtd(id,qtd_estoque){
    let botao = document.getElementById('btn_'+id)
    let qtd = document.getElementById('result_'+id)
    let qtd_atual = parseInt(qtd.innerText)
    qtd.className = "text-success"
    if( qtd_atual >= qtd_estoque){
        qtd.className = "text-success"
    }else{
        botao.disabled = false
        qtd.className = "text-success"
        qtd.innerText = ++qtd_atual
    }
    
    
}
function enviarDadosTabelaListagem(id_produto){

    let qtd_escolhida = document.getElementById('result_'+id_produto).innerText
    let url = localhost+"/ibautolub/public/api/v1/save/list/add"
    let xml = new XMLHttpRequest()
    let form = new FormData();
    form.append('id_produto',id_produto)
    form.append('qtd',qtd_escolhida)
    form.append('id_cliente',id_cliente_universal)
    xml.open('POST',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            let json = JSON.parse(dados)
            if(json.result == true){
                fecharPainelProduto()
                mostrarTabelaListagem();
            }
        }
    }
    xml.send(form)
      
}

function mostrarTabelaListagem(){
    let div = document.getElementById('componente_tabela')
    let valor = document.getElementById('valor_total')
    let url = localhost+"/app/fun/ajax/listagem_produto?id_cliente="+id_cliente_universal
    let xml = new XMLHttpRequest();
    xml.open('GET',url);
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            div.innerHTML = dados
            console.log(valor)
        }
    
 }
 xml.send()
}
function removerItem(id){
    let url = localhost+"/ibautolub/public/api/v1/delete/"+id
    let div = document.getElementById('componente_tabela')
    let xml = new XMLHttpRequest();
    xml.open('DELETE',url);
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            let json = JSON.parse(dados)
            if(json.result == true){
                mostrarTabelaListagem();
            }
        }
    
 }
 xml.send()
}
function selecaoCompra(){

    let compra = document.getElementById('compra')
    let orcamento = document.getElementById('orcamento')
    let form = document.getElementById('form_envio')
    let valor = document.getElementById('valor_pagamento')
    if(compra.checked){
        form.className = "visible"
        valor.className = "visible"
    }else{
        form.className = "invisible"
        valor.className = "invisible"
    }
   
}
function selecaoOrcamento(){
    let btn = document.getElementById('btn_enviar_pagamento')
    let compra = document.getElementById('compra')
    let orcamento = document.getElementById('orcamento')
    let form = document.getElementById('form_envio')
    let valor = document.getElementById('valor_pagamento')
    if(orcamento.checked){
        form.className = "invisible"
        valor.className = "invisible"
        btn.className = "btn btn-success visible"
    }else{
        form.className = "visible"
        valor.className = "visible"
    }
   
}
function adicionarPagamento(valor_compra,cliente){
    let valorEntrada = document.getElementById('valor_entrada')
    let bloco_finalizar = document.getElementById('finalizar_compra')
    let valor_final = document.getElementById('valor_compra_final')
    let cliente_final = document.getElementById('cliente_final')
    let msg = document.getElementById('msg')
    let cron = 3000
    console.log(valor_compra)
    if(valor_compra == '' || valor_compra == undefined || valor_compra == '0.00'){
        msg.className = "mostrar"
    let i = 0
    const temp = setInterval(()=>{
        while( i < cron){
           
            if( i == 2500){
                msg.className = "apagar"
                clearTimeout(temp)
            }
            i++
        }
        },cron)
    }else{
        bloco_finalizar.className = "bloco-venda"
        valor_final.innerText = 'R$ '+valor_compra
        cliente_final.innerText = cliente
        valorEntrada.value = valor_compra
    }
    
}

function fecharBlocoVenda(){
    let bloco_finalizar = document.getElementById('finalizar_compra')
    bloco_finalizar.className = "apagar"
}
function finalizarVenda(){
    let compra = document.getElementById('compra')
    let orcamento = document.getElementById('orcamento')
    let form = document.getElementById('form_enivar_pagamento')
    let selecao = document.getElementById('selecao_pagamento')
    let btn = document.getElementById('btn_enviar_pagamento')
    let valor = document.getElementById('valor_entrada')
    if(compra.checked){
        if(selecao.value == ""){
            selecao.className = "form-control is-invalid"
        }
        else if( valor.value == ""){
            selecao.className = "form-control"
            valor.className = "form-control is-invalid"
        }else{
            let valor_total = document.getElementById('valor_compra_final')
            let valor_final = document.createElement('input')
            valor_final.name = "valor_final"
            valor_final.value = valor_total.innerText
            let id_cliente = document.createElement('input')
            id_cliente.name = "id_cliente"
            id_cliente.value = id_cliente_universal
            let tipo_pagamento = document.createElement('input')
            tipo_pagamento.name = "tipo_pagamento"
            valor.className = "form-control"
            selecao.className = "form-control"
            selecao.name = "selecao_pagamento"
            form.appendChild(valor_final)
            form.appendChild(id_cliente)
            form.appendChild(tipo_pagamento)
            form.appendChild(selecao)
            form.action = "/app/fun/salvar_venda"
            form.method = "POST"
            btn.type = "submit"
            
            
            }
        }else{
            let valor_final = document.createElement('input')
            valor_final.name = "valor_final"
            valor_final.value = valor_total.innerText
            let tipo_pagamento = document.createElement('input')
            tipo_pagamento.name = "tipo_pagamento"
            let id_cliente = document.createElement('input')
            id_cliente.name = "id_cliente"
            id_cliente.value = id_cliente_universal
            form.appendChild(id_cliente)
            form.appendChild(valor_final)
            form.appendChild(tipo_pagamento)
            form.action = "/app/fun/salvar_orcamento"
            form.method = "POST"
            btn.type = "submit"
        }
    
}
function pesquisarItem(){
    let data_inicial = document.getElementById('data_inicial')
    let data_final = document.getElementById('data_final')
    let codigo = document.getElementById('codigo_venda')
    let cron = 3000
    if(codigo.value == ""){
        codigo.className = "form-control is-invalid"
        const temp = setInterval(()=>{
            let i =0;
            while( i < cron){
                
                if( i == 2500){
                    codigo.className = "form-control"
                    clearInterval(temp)
                }
                i++
            }
            
        },cron)
    }
    else{
        
        pesquisarCompra(codigo.value)
    }
    
}
function pesquisarCompra(codigo){
    
    let url = localhost+"/app/fun/ajax/consulta_compras?codigo="+codigo
    let div = document.getElementById('conteudo_pesquisa')
    let xml = new XMLHttpRequest();
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            div.innerHTML = dados;
            console.log(dados)
        }
    }
    xml.send()

}
function salvarProduto(){
    let btn_salvar_produto = document.getElementById('btn_salvar_produto')
    let msg_numeros = document.getElementById('msg_numeros')
    let form = document.getElementById('form_add_product')
    let nome_produto = document.getElementById('nome_produto')
    let codigo_barra = document.getElementById('codigo_barra')
    let preco = document.getElementById('preco')
    let fornecedor = document.getElementById('fornecedor')
    let qtd = document.getElementById('qtd')
    let preco_compra = document.getElementById('preco_compra')
    let categoria = document.getElementById('categoria').value
    let msg = document.getElementById('msg')
    let cron = 3000
    console.log(preco)
    if(nome_produto.value == "" || codigo_barra.value == "" || preco.value == "" 
    || qtd.value == "" || preco_compra.value == ""){
        
        msg.className = "mostrar"
        let i = 0
        const temp = setInterval(()=>{
            while( i < cron){
               
                if( i == 2500){
                    msg.className = "apagar"
                    clearTimeout(temp)
                }
                i++
            }
        },cron)
    }else{
           
           msg_numeros.className = "apagar"
           preco.className = "form-control"
           preco_compra.className = "form-control"
           form.action = "/app/fun/adicionar_produto"
           form.method = "POST"
           btn_salvar_produto.type = "submit"
        
    }
}
function salvarServico(){
    let btn = document.getElementById('btn_salvar_servico')
    let form = document.getElementById('form_add_service')
    let nome = document.getElementById('nome_servico')
    let preco = document.getElementById('preco_servico')
    let cron = 3000
    if( nome.value ==  "" || preco.value == "" ){
        msg.className = "mostrar"
        let i = 0
        const temp = setInterval(()=>{
            while( i < cron){
               
                if( i == 2500){
                    msg.className = "apagar"
                    clearTimeout(temp)
                }
                i++
            }
        },cron)
    }else{
        form.action = "/app/fun/adicionar_servico"
        form.method = "post"
        btn.type ="submit"
    }
}
function pesquisarCliente(){
    let input = document.getElementById('cliente')
    let btn = document.getElementById('btn_pesquisar')
    
    let cron = 3000
    if(input.value == ""){
      
        input.className = "form-control is-invalid"
     const temp = setInterval(()=>{
        
        let i = 0;
        while( i < cron){
         
            if(i == 2500){
                input.className = "form-control"
                clearInterval(temp)
            }
            i++
        }
     },cron)
    }else{
       solicitarCliente(input.value)
    }
}
function solicitarCliente(cliente){
    let url = "/app/fun/ajax/consultar_cliente?cliente="+cliente
    let div = document.getElementById('result_search')
    let xml = new XMLHttpRequest()
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            div.innerHTML = dados
        }
    }
    xml.send()

}
function editarDadosCliente(id){
    let form = document.getElementById('form_edit_cliente_basico')
    let nome = document.getElementById('nome')
    let email = document.getElementById('email')
    let cpf = document.getElementById('cpf_cnpj')
    let telefone = document.getElementById('telefone')
    let btn = document.getElementById('btn_editar_dados')
    
    /*if( nome.value == "" || email.value == "" || telefone.value == "" || cpf_cnpj.value== ""){
        if()
    }*/
    if(nome.value == ""){
        nome.className = "form-control is-invalid"
    }else if( email.value == "" ){
        email.className ="form-control is-invalid"
    }else if(cpf.value == ""){
        cpf.className ="form-control is-invalid"
    }else if(telefone.value == ""){
        telefone.className ="form-control is-invalid"
    }else{
        let id_fun = document.createElement('input')
        id_fun.value = id
        id_fun.name = "id_cliente";
        form.appendChild(id_fun)
        form.action = "/app/fun/editar_funcionario"
        form.method = "POST";
        btn.type="submit"

    }
}
function verificarSenhaCliente(loginAtual){
    let login = document.getElementById('login_atualizar')
    let btn = document.getElementById('btn_editar_senha')
    let url = "/api/v1/login/user/"+btoa(login.value)
    let xml = new XMLHttpRequest();
    xml.open('GET',url)
   
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            let json = JSON.parse(dados)
            let nome = json.dados
            console.log(nome)
            console.log(loginAtual)
            if(json.loginAth){
                if(nome === loginAtual){
                    login.className = "form-control"
                    btn.disabled = false
                }else{
                     login.className = "form-control is-invalid"
                        btn.disabled = true
                }
               
            }else{
                login.className = "form-control"
                btn.disabled = false
            }
        }
    }
    xml.send()

}
function editarSenhaCliente(id){
    let msg = document.getElementById('msg')
    let form = document.getElementById('form_editar_login_cliente')
    let btn = document.getElementById('btn_editar_senha')
    let login = document.getElementById('login_atualizar')
    let senha = document.getElementById('senha_atualizar')
    let senha2 = document.getElementById('senha2')
    let cron = 3000;
    if(login.value == "" || senha.value == ""){
        msg.className = "mostrar"
        const temp = setInterval(()=>{
            let i=0;
            while( i < cron){
                if(i == 2500){
                    msg.className = "apagar"
                    clearInterval(temp)
                }
                i++
            }
        },cron)
    }else{
        if(senha.value != senha2.value){
            senha.className = "form-control is-invalid"
            senha2.className = "form-control is-invalid"
        }else{
            senha.className = "form-control"
            senha2.className = "form-control"
            let id_cliente = document.createElement('input')
            id_cliente.name ="id_cliente"
            id_cliente.value = id
            form.appendChild(id_cliente)
           form.action = "/app/fun/edit_password"
           form.method = "POST"
           btn.type = "submit"
        }
    }
}
function desativarUsuario(id){
    url = localhost+"/ibautolub/public/api/v1/client/inativar/"+id
    let input = document.getElementById('cliente')
    let xml = new XMLHttpRequest()
    xml.open('PUT',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            let json = JSON.parse(dados)
            console.log(json)
            solicitarCliente(input.value)
        }
    }
    xml.send()

}
function ativarUsuario(id){
    url = localhost+"/ibautolub/public/api/v1/client/ativar/"+id
    let input = document.getElementById('cliente')
    let xml = new XMLHttpRequest()
    xml.open('PUT',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            let json = JSON.parse(dados)
            console.log(json)
            solicitarCliente(input.value)
        }
    }
    xml.send()

}
function carregarResultadoCarros(id){
    
    let url = localhost+"/app/fun/ajax/get_carr?id="+id
    let xml = new XMLHttpRequest();
    let div = document.getElementById('result_carr')
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            div.innerHTML = dados
     
        }
    }
    xml.send()

}
function abrirPainelCarro(){
    let div = document.getElementById('component')
    div.className = "visible"
}
function fecharPainelCarro(){
    
    
    let div = document.getElementById('component')
    div.className = "invisible"
    normalizarEnvioVeiculo()
}
function normalizarEnvioVeiculo(){
    let nome = document.getElementById('nome')    
    let placa = document.getElementById('placa')    
    let modelo = document.getElementById('modelo')    
    let cor = document.getElementById('cor')    
    let tipo = document.getElementById('tipo')
    tipo.className = "form-control"
    modelo.className = "form-control"
    cor.className = "form-control"
    placa.className = "form-control"
    nome.className = "form-control"
    nome.value = ""
    modelo.value = ""
    cor.value = ""
    placa.value = ""
    
}
function salvarVeiculo(id){
    let nome = document.getElementById('nome')    
    let placa = document.getElementById('placa')    
    let modelo = document.getElementById('modelo')    
    let cor = document.getElementById('cor')    
    let tipo = document.getElementById('tipo')
    
    if( nome.value=="" || placa.value=="" || modelo.value == "" || cor.value=="" || tipo.value == ""){
        if(nome.value == ""){
            nome.className = "form-control is-invalid"
        }else{
            nome.className = "form-control"
        }
        if(placa.value == ""){
            placa.className = "form-control is-invalid"
        }else{
            placa.className = "form-control"
        }
        if(modelo.value == ""){
            modelo.className = "form-control is-invalid"
        }else{
            
            modelo.className = "form-control"
        }
        if(cor.value == ""){
            cor.className = "form-control is-invalid"
        }else{
            cor.className = "form-control"
        }
        if(tipo.value == ""){
            tipo.className = "form-control is-invalid"
        }else{
            tipo.className = "form-control"
        }
    }else{
        tipo.className = "form-control"
        modelo.className = "form-control"
        cor.className = "form-control"
        placa.className = "form-control"
        nome.className = "form-control"
        
    let url = localhost+"/ibautolub/public/api/v1/save/client/add"
    let xml = new XMLHttpRequest();
    xml.open('POST',url)
    let dados = new FormData();
    dados.append('id_cliente',id);
    dados.append('nome',nome.value);
    dados.append('placa',placa.value);
    dados.append('modelo',modelo.value);
    dados.append('cor',cor.value);
    dados.append('tipo',tipo.value);
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            let json = JSON.parse(dados)
            if(json.result == true){
               
                carregarResultadoCarros(id)
                fecharPainelCarro()
            }
        }
    }
    xml.send(dados)
    }


}
function abrirPainelSystem(){
    let div = document.getElementById('component_add_carr_system')
    div.className = 'visible'
}
function fecharPainelSystem(){
    let div = document.getElementById('component_add_carr_system')
    let imei = document.getElementById('imei')
    div.className = 'invisible'
    imei.value = ""
}
function adicionarCarroEmpresa(url,id){
    let xml = new XMLHttpRequest();
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            let json = JSON.parse(dados)
            console.log(json[0]);
            if(json.length == 0 ){
                msgErroSemVeiculo()
            }else{
                let dados = json[0];
                let form = new FormData();
                form.append('id_cliente',id);
                form.append('nome',dados.marca)
                form.append('modelo',dados.modelo)
                form.append('hodometro',dados.hodometro)
                form.append('placa',dados.name)
                form.append('cor',dados.cor)
                form.append('tipo',dados.tipo);
                let newUrl = localhost+"/ibautolub/public/api/v1/save/client/new/add"
                let xml = new XMLHttpRequest();
                xml.open('POST',newUrl)
                xml.onreadystatechange = ()=>{
                    if(xml.readyState == 4 && xml.status == 200){
                        let dados = xml.responseText
                        console.log(dados)
                        let json = JSON.parse(dados)
                        if(json.result == true){
                            carregarResultadoCarros(id)
                            fecharPainelSystem()
                            let imei = document.getElementById('imei').value = ""
                        }
                    }
                }
                xml.send(form)
            }
           
     
        }
    }
    xml.send()
}
function msgErroSemVeiculo(){
    let msg = document.getElementById('msg')
    msg.className = "visible"
    let cron = 3000;
    const temp = setInterval(()=>{
        
        let i=0;
        while( i < cron){
           
            if( i==2500){
                msg.className = "invisible"
                clearInterval(temp)
            }
            i++
        }
    },cron)
}
function adiconarVeiculoSystem(id){
    let imei = document.getElementById('imei')
    let rast50 = document.getElementById('50rastreamento')
    let rastIb= document.getElementById('ibrastreamento')
    if( imei.value == "" ){
        imei.className = "form-control is-invalid"
    }else{
        if(rastIb.checked == true){
            let url = "https://ibrastreamento.com.br/api/public/index.php?imei="+imei.value
            adicionarCarroEmpresa(url,id)
        }else{
            let url = "https://50rastreamento.com.br/api/public/index.php?imei="+imei.value
            adicionarCarroEmpresa(url,id)
        }
    }
}
function removerVeiculo(id,id_cliente){
    let url = localhost+"/ibautolub/public/api/v1/client/remove/"+id
    let xml = new XMLHttpRequest();
    let div = document.getElementById('result_carr')
    xml.open('DELETE',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            let json = JSON.parse(dados)
            if(json.result == true){
                carregarResultadoCarros(id_cliente)
            }
     
        }
    }
    xml.send()
}
function escolherTipoLog(){
    let opcao = document.getElementById('opcao_tipo')
    switch(opcao.value){
        case 'erro':
            getAjaxGenerico('erro')
            break
        case 'sistema':
            getAjaxGenerico('sistema')
            break
        case 'vendas':
            getAjaxGenerico('vendas');
            break;
        case 'troca':
            getAjaxGenerico('troca');
            break;

    }
}
function getAjaxGenerico(tipo){
    let url = localhost+'/app/fun/ajax/tabela_funcionario_'+tipo
    let div = document.getElementById('tabela_conteudo')
    let xml = new XMLHttpRequest();
    xml.open('get',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText;
            div.innerHTML = dados
           
        }
    }
    xml.send()
}
function selecaoOpcao(id){
    let id_opcao = document.getElementById(id)
    switch(id){
        case 'cadastro_ok':
            let opcao = document.getElementById('cadastro_nao_ok')
            opcao.checked = false
            ativarAba(id)
            break;
        case 'cadastro_nao_ok':
            let opcao2 = document.getElementById('cadastro_ok')
            opcao2.checked = false
            ativarAba(id)
            break;
    }
}
function ativarAba(tipo){
    let cliente_ok = document.getElementById('cliente_ok')
    let cliente_nao_ok = document.getElementById('cliente_nao_ok')
    switch(tipo){
        case 'cadastro_ok':
            cliente_ok.className = "d-block"
            cliente_nao_ok.className = "d-none"
            break;
        case 'cadastro_nao_ok':
             cliente_ok.className = "d-none"
            cliente_nao_ok.className = "d-block"
            break;
    }
}
function previewInfo(){
    let cadastro_nao_ok = document.getElementById('cadastro_nao_ok')
    let cadastro_ok = document.getElementById('cadastro_ok')
    if(cadastro_nao_ok.checked){
        let btn = document.getElementById('salvar_cliente_sem_nome')
        let nome = document.getElementById('nome_cliente_novo')
        let novo = document.getElementById('produto_cliente_novo').value
        let antigo = document.getElementById('produto_cliente_antigo').value
        let qtd = document.getElementById('qtd').value
        
        if(nome.value == "" || novo.value == "" || antigo == ""){
            alert('vazio campos')
        } else{
        
        let dados_novo = novo.split('/')
        let dados_antigo = antigo.split('/')
        console.log(dados_antigo)
        let dados = {
            "nome" :nome.value,
            "novo":dados_novo[0],
            "preco_novo":dados_novo[1],
            "antigo":dados_antigo[0],
            "preco_antigo":dados_antigo[1],
            "qtd":qtd
        }
        tratarDados(dados)
    }
    }else{
        let n1 = document.getElementById('selecao_nome')
        let n2 = document.getElementById('novo_produto')
        let n3 = document.getElementById('antigo_produto')
      
 
        let qtd = document.getElementById('qtd').value
        if(n1.value == "" || n2.value == "" || n3.value == ""){

         alert('campo vazioo')

        }else{
            let nome = document.getElementById('selecao_nome').value
            let novo = document.getElementById('novo_produto').value
            let antigo = document.getElementById('antigo_produto').value
        let btn = document.getElementById('salvar_cliente_nome')
        let dados_novo = novo.split('/')
        let dados_antigo = antigo.split('/')
        let dados = {
            "nome" :nome,
            "novo":dados_novo[0],
            "preco_novo":dados_novo[1],
            "antigo":dados_antigo[0],
            "preco_antigo":dados_antigo[1],
            "qtd":qtd
        }
        tratarDados(dados)
     }
    }
}
function tratarDados(dados){
    console.log(dados)
    let div = document.getElementById('result_troca')
    div.className = "d-block"
    let btn = document.getElementById('btn_salvar_dados')
    let nome = document.getElementById('nome_cliente').innerText = dados.nome
    let produto_novo = document.getElementById('produto_novo').innerText = dados.novo
    let produto_antigo = document.getElementById('produto_antigo').innerText = dados.antigo
    let total = document.getElementById('total').innerText = dados.preco_antigo +"-"+ dados.preco_novo+" = "+(parseFloat(dados.preco_novo) - (parseFloat(dados.preco_antigo)*dados.qtd))
    let diferenca = document.getElementById('diferenca').innerText = (parseFloat(dados.preco_novo)  -  (parseFloat(dados.preco_antigo)*dados.qtd))
    let valor = document.getElementById('valor_entrada')
    let qtd = document.getElementById('qtd_recuperada').innerText = dados.qtd
    valor.value = dados.preco_novo
        

}
function enviarDadosTroca(){
    let nome = document.getElementById('nome_cliente')
    let produto_novo = document.getElementById('produto_novo')
    let produto_antigo = document.getElementById('produto_antigo')
    let total = document.getElementById('total')
    let diferenca = document.getElementById('diferenca')
    let valor = document.getElementById('valor_entrada')
    let qtd = document.getElementById('qtd_recuperada')
    form = new FormData();
    form.append('nome',nome.innerText)
    form.append('produto_novo',produto_novo.innerText)
    form.append('produto_antigo',produto_antigo.innerText)
    form.append('total',total.innerText)
    form.append('total',total.innerText)
    form.append('diferenca',diferenca.innerText)
    form.append('qtd',qtd.innerText)
    form.append('valor',valor.value)
    let div = document.getElementById('result_troca')
 
    let xml = new XMLHttpRequest()
    let url = localhost+"/ibautolub/public/api/v1/save/fun/save/troca"
    xml.open('POST',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
         let dados = xml.responseText
        let json = JSON.parse(dados)
        console.log(json)
        if(json.result == true){
            msgSucesso('msg')
            console.log('ok')
            div.className = "d-none"
        }else{
            msgErro('msg_erro')
            div.className = "d-none"
        }
        }
    }
    xml.send(form)

}
function msgSucesso(id){
    let msg = document.getElementById(id)
    let cron = 3000
    let i=0;
    msg.className = "mostrar"
    const temp = setInterval(()=>{
        
        let i=0;
        while( i < cron){
           
            if( i==2500){
                msg.className = "apagar"
                clearInterval(temp)

            }
            i++
        }
    },cron)
   
}
function msgErro(id){
    let msg = document.getElementById(id)
    let cron = 3000
    let i=0;
    msg.className = "mostrar"
    const temp = setInterval(()=>{
        
        let i=0;
        while( i < cron){
           
            if( i==2500){
                msg.className = "apagar"
                clearInterval(temp)
                location.reload()
            }
            i++
        }
    },cron)
    
}