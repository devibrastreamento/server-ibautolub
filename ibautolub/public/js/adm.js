let localhost= "http://192.168.1.206"
let btn_enviar_profissao = document.getElementById('btn_enviar_profissao');
let btn_salvar_adm = document.getElementById('btn_salvar_adm');
let btn_adiconar_funcionario = document.getElementById('btn_adiconar_funcionario');

// ------------------------------------------------------------salvar Funcionario------------------------------
function salvarFuncionario(){
   let msg = document.getElementById('msg');
   let senhaVerificar = document.getElementById('senha_verificar');
   let form = document.getElementById('form_cadastro_funcionario');
   let nome = document.getElementById('nome');
   let login = document.getElementById('email');
   let email = document.getElementById('login');
   let funcao = document.getElementById('profissao');
   let senha = document.getElementById('senha');
   let senha2 = document.getElementById('senha2');
   let cron = 3000
   if( nome.value == '' || login.value == '' || email.value == '' || funcao.value == '' || senha == ''){
       let i =0;
        msg.className = "mostrar"
       temp = setInterval( ()=>{
           while( i < cron){

           msg.className = "apagar";
           if(i== 2500){
            msg.className = "apagar";
              clearInterval(temp)
           }
           i++
           }
       },cron)
   }else{
    if(verifcarSenha(senha,senha2)){
       form.action = "/app/adm/cadastrar_funcionario"
       form.method = "POST"
       btn_adiconar_funcionario.type = "submit"
    }else{
        let i=0
            senhaVerificar.className = "mostrar";
            const senhaTemp = setInterval( ()=>{
               while( i < cron){
                
                    if( i==2500){
                        senhaVerificar.className = "apagar";
                        setInterval(senhaTemp)
                    }
                    i++
               }
               
            },cron)
    }
   }
}
// ------------------------------------------------------------salvar Adm------------------------------
function salvarADm(){
    
    let msg = document.getElementById('msg');
    let senhaVerificar = document.getElementById('senha_verificar');
    let form = document.getElementById('form_adm');
    let nome = document.getElementById('nome_adm');
    let login = document.getElementById('login_adm');
    let email = document.getElementById('email_adm');
    let permissao = document.getElementById('permissao');
    let senha = document.getElementById('senha_adm');
    let senha2 = document.getElementById('senha2_adm');
    let cron = 3000
    if(nome.value == '' || login.value == '' || email.value == '' 
    || permissao.value == '' || senha.value == '' || senha2 ==  ''){
        msg.className = "mostrar";
        let i =0;
       
        temp = setInterval( ()=>{
            while( i < cron){

            msg.className = "apagar";
            if(i== 2500){
               clearInterval(temp)
            }
            i++
            }
        },cron)
      
    }else{
        if(verifcarSenha(senha,senha2)){
           form.method = "POST"
           form.action = "/app/adm/cadastro_adm"
           btn_salvar_adm.type = "submit"
        }else{
            let i=0
            senhaVerificar.className = "mostrar";
            const senhaTemp = setInterval( ()=>{
               while( i < cron){
                
                    if( i==2500){
                        senhaVerificar.className = "apagar";
                        setInterval(senhaTemp)
                    }
                    i++
               }
               
            },cron)
           
        }
    }
    
}

// ------------------------------------------------------------salvar Profissao------------------------------
function salvarProfissional(){
    let dados = document.getElementById('novaFuncao');
    let msg = document.getElementById('msg');
    if(dados.value == '' || dados.value == null){
        msg.className = "mostrar";
        const temp = setInterval( ()=>{
            msg.className = "apagar";
           
        },3000)
        setTimeout(temp);
    }else{
        let form = document.getElementById('fomr_profissao')
        form.action = "/app/adm/cadastro_funcao";
        form.method = "POST";
        btn_enviar_profissao.type = "submit";
    }
}
// ------------------------------------------------------------Verificar Senha------------------------------
function verifcarSenha(senha1,senha2){
    let validar = false;
    if(senha1.value == senha2.value){
        
        validar =  true;
    }
    return validar;
}
// ------------------------------------------------------------Setar Rotas------------------------------
/**
 * Somente para Setar as Rotas do Sistema, não suporta Parametros
 * 
 */
function abrirJanela(urlTo,name,backUrl){
    
    location.href="/app/adm/"+urlTo+"?n="+btoa(name)+"&b="+btoa(backUrl);
}
// ------------------------------------------------------------Setar Rotas Com parametros------------------------------
/**
 * tem supore para mais de um parâmetro, podendo seta mais de 1
 * basta adicionar o & a cada parametro
 * /app/adm/edit_user?id=1&parametro=2&parametro=3& ... &n=RWRpdGFy&b=L2FwcC9hZG0vbGlzdGFnZW0/
 */
function abrirJanelaComParametros(urlTo,name,backUrl){
    location.href="/app/adm/"+urlTo+"&n="+btoa(name)+"&b="+btoa(backUrl);
}
function alterarFuncionario(id){
    let msg = document.getElementById('msg');
    let senhaVerificar = document.getElementById('senha_verificar');
    let form = document.getElementById('form_cadastro_funcionario');
    let nome = document.getElementById('nome');
  
    let email = document.getElementById('email');
    let funcao = document.getElementById('profissao');

    let cron = 3000
    if( nome.value == '' || email.value == '' || funcao.value == ''){
        let i =0;
         msg.className = "mostrar"
        temp = setInterval( ()=>{
            while( i < cron){
 
            msg.className = "apagar";
            if(i== 2500){
             msg.className = "apagar";
               clearInterval(temp)
            }
            i++
            }
        },cron)
    }else{
    
        form.action = "/app/adm/update_user?id_fun="+id
        form.method = "POST"
        btn_adiconar_funcionario.type = "submit"
     
    }
}
function alterarSenha(id){
    let msg = document.getElementById('verificar_campo');
    let senhaVerificar = document.getElementById('verificar_senha');
    let senha = document.getElementById('senha');
    let login = document.getElementById('login');
    let senha2 = document.getElementById('senha2');
    let btn_alterar_senha = document.getElementById('btn_alterar_senha');
    let form = document.getElementById('form_alterar_senha')
    let cron = 3000
    if( senha.value == ''|| login.value == ''){
        let i =0;
         msg.className = "mostrar"
        temp = setInterval( ()=>{
            while( i < cron){
 
            msg.className = "apagar";
            if(i== 2500){
             msg.className = "apagar";
               clearInterval(temp)
            }
            i++
            }
        },cron)
        
    }else{
        if(verifcarSenha(senha,senha2)){
            form.action = "/app/adm/update_password?id_fun="+id
            form.method = "post"
            btn_alterar_senha.type="submit"
        }else{
            senhaVerificar.className = "mostrar";
            const temp = setInterval( ()=>{
                senhaVerificar.className = "apagar";
               
            },3000)
            setTimeout(temp);
        }
    }
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
           form.action = "/app/adm/adicionar_produto"
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
        form.action = "/app/adm/adicionar_servico"
        form.method = "post"
        btn.type ="submit"
    }
}
function verificarValores(valor,idBtn){
    let msg = document.getElementById('msg_numeros')
   
    let btn = document.getElementById(idBtn)
    let cron = 3000
   let mask = /^[0-9]+$/ // mascar para verificar números
    if(!mask.test(valor)){
        msg.className = "mostrar"
        btn.disabled = true
    }else{
        btn.disabled = false
        msg.className = "apagar"
    }
}
function verificarCampos(campo1,campo2){
    let mask = /^[0-9]+$/
    let result1 = mask.test(campo1)
    let result2 = mask.test(campo2)
    let validar = false;
    if(result1 && result2 == true){
        validar = true
        
    }
    return validar;
}
function editarServico(id){
   let nome = document.getElementById('edit_name_service')
   let preco = document.getElementById('edit_price_service')
   let btn = document.getElementById('btn_editar_servico')
   let msg = document.getElementById('msg_edit_service')
   let form = document.getElementById('form_edit_service')
   let cron = 3000
   if( nome.value == "" || preco.value == ""){
        msg.className = "mostrar"
        let i=0
        const temp = setInterval(()=>{
          
            while( i < cron ){
                
                if(i == 2500){
                    msg.className="apagar"
                    clearInterval(temp)
                }
                i++
            }
        },cron)
   }else{
    form.action = "/app/adm/edit_service_manager?id_service="+id
    form.method = "POST"
    btn.type="submit"
   }
}
function editarProduto(id){
    let btn_salvar_produto = document.getElementById('btn_editar_produto')
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
        form.action = "/app/adm/edit_product_manager?id_produto="+id
        form.method = "POST"
        btn_salvar_produto.type = "submit"
        
    }
}
function editarAdm(id){
    let msg = document.getElementById('msg');
    let btn = document.getElementById('btn_edit_adm')
   
    let form = document.getElementById('form_adm_edit');
    let nome = document.getElementById('nome_adm');
    let email = document.getElementById('email_adm');
    let permissao = document.getElementById('permissao').value;
    let cron = 3000
    if(nome.value == ''){
        nome.className = "form-control is-invalid"
        if(email.valie == ''){
            email.className = "form-control is-invalid"
            if(permissao == ''){
                permissao.className = "form-control is-invalid"
            }
        }
        
    }else{
        form.action="/app/adm/edit_adm_manager?id_adm="+id
        form.method="POST"
        btn.type="submit"
    }
}
function editarSenha(id){
    let form = document.getElementById('form_adm_senha')
    let btn = document.getElementById('btn_edit_senha')
    let senha2 = document.getElementById('confirmar_senha')
    let senha = document.getElementById('senha')
    let login = document.getElementById('login')
    let cron = 3000
    if( login.value == "" || senha.value == ""){
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
      if(verificarSenha(senha.value,senha2.value)){
        senha.className = "form-control"
        senha2.className = "form-control"
           form.action = "/app/adm/edit_manager_password?id_adm="+id
           form.method = "POST"
           btn.type = "submit"
      }else{
        senha.className = "form-control is-invalid"
        senha2.className = "form-control is-invalid"
      }
    }
}
function verificarSenha(s1,s2){
    let validar = true;
    if(s1 != s2){
        validar=false
    }
    return validar;
}
function verificarLoginFunCadastro(){
    let login = document.getElementById('login')
    let btn = document.getElementById('btn_adiconar_funcionario')
    let xml = new XMLHttpRequest();
    let url = localhost+"/ibautolub/public/api/v1/login/fun/"+btoa(login.value)
    console.log(url)
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
           let dados = xml.responseText
           let json = JSON.parse(dados)
           console.log(json)
           if(json.loginAth){
            login.className = "form-control is-invalid"
            btn.disabled =true
           }else{
            login.className = "form-control"
            btn.disabled =false
           }
           
        }
    }

    xml.send()
}
function verificarLoginFuncionario(login,id){
    let btn = document.getElementById('btn_alterar_senha')
    let xml = new XMLHttpRequest();
    let url = localhost+"/ibautolub/public/api/v1/login/fun/"+btoa(login)
    console.log(url)
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
           let dados = xml.responseText
           let json = JSON.parse(dados)
           let input = document.getElementById('login')
           let idUser = json.id
           if(json.loginAth){
            input.className = "form-control is-invalid"
            btn.disabled = true
            if(id == idUser){
                input.className = "form-control"
                btn.disabled = false
            }
        }else{
            btn.disabled = false
            input.className = "form-control"
        }
        }
    }

    xml.send()
}
function verificarLoginAdm(login,id){
    let btn = document.getElementById('btn_edit_senha')
    let xml = new XMLHttpRequest();
    let url = localhost+"/ibautolub/public/api/v1/login/adm/"+btoa(login)
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            let json = JSON.parse(dados)
            let nome = json.dados
            let idUser = json.id
            let input = document.getElementById('login')
            console.log(json)
          
            if(json.loginAth){
                input.className = "form-control is-invalid"
                btn.disabled = true
                if(id == idUser){
                    input.className = "form-control"
                    btn.disabled = false
                }
            }else{
                btn.disabled = false
                input.className = "form-control"
            }
        }
    }

    xml.send()
}
function editarDadosAdmUser(id){
    let form  = document.getElementById('form_edit_dados_adm')
    let nome = document.getElementById('nome_adm')
    let email = document.getElementById('email_adm')
    let permissao = document.getElementById('permissao').value
    let msg = document.getElementById('msg_basico')
    let cron = 3000
    let btn = document.getElementById('btn_edit_adm_basico')
    if(nome.value == "" || email.value == "value" || permissao == ""){
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
        btn.type="submit"
        form.action="/app/adm/edit_adm_manager?id_adm="+id
        form.method="post"
    }
    

}
function editarSenhaAdmUser(id){
    let form = document.getElementById('form_edit_senha_adm')
    let btn = document.getElementById('btn_edit_dados_senha')
    let login = document.getElementById('login')
    let senha = document.getElementById('senha')
    let senha2 = document.getElementById('senha2')
    let msg = document.getElementById('msg_login')
    let cron = 3000
    if(login.value == "" || senha.value == ""){
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
            form.action = "/app/adm/edit_manager_password?id_adm="+id
           form.method = "POST"
           btn.type = "submit"
        }
    }
}
function verificarLoginAdmProfile(login,id){
    let btn = document.getElementById('btn_edit_dados_senha')
    let xml = new XMLHttpRequest();
    let url = localhost+"/ibautolub/public/api/v1/login/adm/"+btoa(login)
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            let json = JSON.parse(dados)
            let nome = json.dados
            let idUser = json.id
            let input = document.getElementById('login')
            console.log(json)
          
            if(json.loginAth){
                input.className = "form-control is-invalid"
                btn.disabled = true
                if(id == idUser){
                    input.className = "form-control"
                    btn.disabled = false
                }
            }else{
                btn.disabled = false
                input.className = "form-control"
            }
        }
    }

    xml.send()
}
function solicitarRelatorio(){
   let tipo_relatorio = document.getElementById('tipo_relatorio')
   let dt_inicial = document.getElementById('dt_inicial');
   let dt_final = document.getElementById('dt_final')
   if(dt_inicial.value == "" || dt_final.value == "" || tipo_relatorio.value == ""){
    if(dt_final.value == ""){
        dt_final.className = "form-control is-invalid";
    }else{
        dt_final.className = "form-control";
    }
    if(dt_inicial.value == ""){
        dt_inicial.className = "form-control is-invalid";
    }else{
        dt_inicial.className = "form-control";
    }
    if(tipo_relatorio.value == ""){
        tipo_relatorio.className = "form-control is-invalid";
    }else{
        tipo_relatorio.className = "form-control";
    }
   }else{
    tipo_relatorio.className = "form-control";
    dt_inicial.className = "form-control";
    dt_final.className = "form-control";
    switch(tipo_relatorio.value){
        case 'venda':
            ajaxVenda(dt_inicial.value,dt_final.value)
           
            break;
        case 'estoque':
            ajaxEstoque(dt_inicial.value,dt_final.value)
            
            break;
        
       }
   }
   
}
function ajaxVenda(inicio,final){
    let xml = new XMLHttpRequest();
    let url = localhost+"/app/fun/ajax/relatorio_venda?dt_inicial="+inicio+"&dt_final="+final
    console.log(url)
    let div = document.getElementById('result_search')
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            div.innerHTML = dados
         
        }
    }

    xml.send()
}
function ajaxEstoque(inicio,final){
    let xml = new XMLHttpRequest();
    let url = localhost+"/app/fun/ajax/relatorio_estoque?dt_inicial="+inicio+"&dt_final="+final
    console.log(url)
    let div = document.getElementById('result_search')
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            div.innerHTML = dados
         
        }
    }

    xml.send()
}
function abrirReceita(){
    let div = document.getElementById('cadastrar_receita')
    div.className = 'd-block'
}
function fecharReceita(){
    let div = document.getElementById('cadastrar_receita')
    div.className = 'd-none'
}
function abrirDespesa(){
    let div = document.getElementById('cadastrar_despesa')
    div.className = 'd-block'
}
function fecharDespesa(){
    let div = document.getElementById('cadastrar_despesa')
    div.className = 'd-none'
}
function cadastrarReceita(){
    let nome = document.getElementById('nome')
    let valor = document.getElementById('valor')
    let categoria = document.getElementById('categoria_despesa').value
    let data = document.getElementById('data')
    let obs = document.getElementById('obs')
    if( nome.value == "" || valor.value == "" || categoria == "" || data.value == ""){
        if(nome.value == ""){
            nome.className = "form-control is-invalid"
        }else{
            nome.className = "form-control"
        }
        if(valor.value == "" ){
            valor.className = "form-control is-invalid"
        }else{
            valor.className = "form-control"
        }
        if(categoria == ""){
            categoria.className = "form-control is-invalid"
        }else{
            categoria.className = "form-control"
        }
        if(data.value == ""){
            data.className = "form-control is-invalid"
        }else{
            data.className = "form-control"
        }
    }else{
        categoria.className = "form-control"
        data.className = "form-control"
        valor.className = "form-control"
        nome.className = "form-control"
        let sucesso = document.getElementById('msg_sucesso');
        let erro = document.getElementById('msg_erro');
        let form = new FormData();
        form.append('nome',nome.value)
        form.append('valor',valor.value)
        form.append('categoria',categoria)
        form.append('data',data.value)
        form.append('obs',obs.value)
        let xml = new XMLHttpRequest();
        let url = localhost+"/ibautolub/public/api/v1/save/adm/receita/add"
        xml.open('POST',url)
        xml.onreadystatechange = ()=>{
            if(xml.readyState == 4 && xml.status == 200){
                let dados = xml.responseText
                let json = JSON.parse(dados);
                if(json.result){
                    msgSucesso()
                    nome.value = ""
                    obs.value = ""
                    data.value = ""
                    valor.value = ""
                    carregarContas()
                }else{
                    msgErro();
                }
            }else{

            }
        }
        xml.send(form)
    }
}
function cadastrarDespesa(){
    
    let nome = document.getElementById('nome_despesa')
    let valor = document.getElementById('valor_despesa')
    let categoria = document.getElementById('categoria').value
    let data = document.getElementById('data_despesa')
    let obs = document.getElementById('obs_despesa')
    if( nome.value == "" || valor.value == "" || categoria == "" || data.value == ""){
        if(nome.value == ""){
            nome.className = "form-control is-invalid"
        }else{
            nome.className = "form-control"
        }
        if(valor.value == "" ){
            valor.className = "form-control is-invalid"
        }else{
            valor.className = "form-control"
        }
        if(categoria == ""){
            categoria.className = "form-control is-invalid"
        }else{
            categoria.className = "form-control"
        }
        if(data.value == ""){
            data.className = "form-control is-invalid"
        }else{
            data.className = "form-control"
        }
    }else{
        categoria.className = "form-control"
        data.className = "form-control"
        valor.className = "form-control"
        nome.className = "form-control"
        let sucesso = document.getElementById('msg_sucesso');
        let erro = document.getElementById('msg_erro');
        let form = new FormData();
        form.append('nome',nome.value)
        form.append('valor',valor.value)
        form.append('categoria',categoria)
        form.append('data',data.value)
        form.append('obs',obs.value)
        let xml = new XMLHttpRequest();
        let url = localhost+"/ibautolub/public/api/v1/save/adm/despesa/add"
        xml.open('POST',url)
        xml.onreadystatechange = ()=>{
            if(xml.readyState == 4 && xml.status == 200){
                let dados = xml.responseText
                let json = JSON.parse(dados);
                if(json.result){
                    msgSucesso()
                    nome.value = ""
                    obs.value = ""
                    data.value = ""
                    valor.value = ""
                    carregarContas()
                }else{
                    msgErro();
                }
            }else{

            }
        }
        xml.send(form)
    }
}
function msgSucesso(){
    let sucesso = document.getElementById('msg_sucesso');
    let cron = 3000
    sucesso.className = 'mostrar'
    let temp = setInterval(()=>{
        let i = 0;
        while( i < cron){
            if(i == 2500){
                sucesso.className = "apagar"
                clearInterval(temp)
            }
            i++
        }
    },cron)
}
function msgErro(){
    let erro = doocument.getElementById('msg_erro');
    let cron = 3000
    erro.className = 'mostrar'
    let temp = setInterval(()=>{
        
        let i = 0;
        while( i < cron){
            if(i == 2500){
                erro.className = "apagar"
                clearInterval(temp)
            }
            i++
        }
    },cron)
}
function carregarContas(){
   let url = localhost+"/app/fun/ajax/contas"
   let div = document.getElementById('result_count')
   let xml = new XMLHttpRequest();
   xml.open('GET',url)
   xml.onreadystatechange = ()=>{
    if(xml.readyState == 4 && xml.status == 200){
        let dados = xml.responseText
        div.innerHTML = dados
        pesquisarDadosDefaultLoad()
    }

   }
   xml.send()
}
function ativarPagamento(id){
    let url = localhost+"/ibautolub/public/api/v1/update/adm/despesa/ativar/"+id
    let xml = new XMLHttpRequest();
    xml.open('PUT',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText;
            let json = JSON.parse(dados)
            console.log(json)
            if(json.result){
                carregarContas()
            }
        }
    }
    xml.send()

}
function inativarPagamento(id){
    let url = localhost+"/ibautolub/public/api/v1/update/adm/despesa/inativar/"+id
    let xml = new XMLHttpRequest();
    xml.open('PUT',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText;
            let json = JSON.parse(dados)
            console.log(json)
            if(json.result){
                carregarContas()
                
            }
        }
    }
    xml.send()

}
function pesquisarPorData(){
    let dt_inicial = document.getElementById('dt_inicial')
    let dt_final = document.getElementById('dt_final')
    if(dt_inicial.value == "" || dt_final.value == ""){
        if(dt_inicial.value == ""){
            dt_inicial.className = "form-control is-invalid"
        }else{
            dt_inicial.className = "form-control"
        }
        if(dt_final.value == ""){
            dt_final.className = "form-control is-invalid"
        }else{
            dt_final.className = "form-control"
        }
    }else{
        dt_final.className = "form-control"
        dt_inicial.className = "form-control"
        searchDate1(dt_inicial.value,dt_final.value)
        pesquisarEstatisticaData(dt_inicial.value,dt_final.value)
    }
}
function searchDate1(dt_inicial,dt_final){
    let url = localhost+"/app/fun/ajax/contas?acao=data&dt_inicial="+dt_inicial+"&dt_final="+dt_final
    let div = document.getElementById('result_count')
    console.log(url)
    let xml = new XMLHttpRequest();
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText;
            div.innerHTML = dados
           
        }
    }
    xml.send()
}
function pesquisarEstatisticaData(dt_inicial,dt_final){
    let url = localhost+"/api/v1/search/adm/despesa/"+dt_inicial+"/"+dt_final
    let contas_ativa = document.getElementById('contas_ativa')
    let contas_inativas = document.getElementById('contas_inativas')
    let contas_pagas = document.getElementById('contas_pagas')
    let contas_a_pagar = document.getElementById('contas_a_pagar')
    let receita = document.getElementById('receita')
    let div = document.getElementById('result_count')
    console.log(url)
    let xml = new XMLHttpRequest();
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText;
            let json = JSON.parse(dados)
            let newJson = json[0][0]
            console.log(newJson)
            contas_ativa.innerText = newJson.ativo_qtd
            contas_inativas.innerText = newJson.inativo_qtd
            contas_pagas.innerText = newJson.valor_pago
            contas_a_pagar.innerText = newJson.valor_nao_pago
            receita.innerText = newJson.receita
            

           
        }
    }
    xml.send()
}
function pesquisarDadosDefaultLoad(){
    let url = localhost+"/ibautolub/public/api/v1/search/adm/despesa/load"
    let contas_ativa = document.getElementById('contas_ativa')
    let contas_inativas = document.getElementById('contas_inativas')
    let contas_pagas = document.getElementById('contas_pagas')
    let contas_a_pagar = document.getElementById('contas_a_pagar')
    let receita = document.getElementById('receita')
    let total = document.getElementById('soma')
    let div = document.getElementById('result_count')

    let xml = new XMLHttpRequest();
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText;
            let json = JSON.parse(dados)
            let newJson = json[0][0]
            let soma  =  parseFloat(newJson.receita) - parseFloat(newJson.valor_pago)
            if(soma == NaN){
                soma = newJson.receita
            }
            console.log(soma)
            contas_ativa.innerText = newJson.ativo_qtd
            contas_inativas.innerText = newJson.inativo_qtd
            contas_pagas.innerText = newJson.valor_pago
            contas_a_pagar.innerText = newJson.valor_nao_pago
            receita.innerText = newJson.receita
            total.innerText =soma 
            
            

           
        }
    }
    xml.send()
}
function verificarStatus(tipo){
    let ativo =  document.getElementById('ativo')
    let inativo =  document.getElementById('inativo')
    let div = document.getElementById('result_count')
    let url = localhost+"/app/fun/ajax/contas?acao="+tipo
    let xml = new XMLHttpRequest();
    if(tipo == 'ativo'){
        ativo.checked = true
        inativo.checked = false
    }else{
        ativo.checked = false
        inativo.checked = true
    }
    xml.open('GET',url);
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            div.innerHTML = dados
        }else{

        }
    }
    xml.send()

}
function excluirFuncao(id){
    //Irá desativar a função e não "Excluir"
    location.href="/app/adm/excluir_funcao?id="+id
}
function exibiListagem(){
    let box_tabela = document.getElementById('box_tabela')
    let table = document.getElementById('table_body')
    box_tabela.className = "box-solicitacao-api"
    let dt_inicial = document.getElementById('dt_inicial');
    let dt_final = document.getElementById('dt_final')
    let url = localhost+"/app/fun/ajax/list_vendas?dt_inicial="+dt_inicial.value+"&dt_final="+dt_final.value
    let xml = new XMLHttpRequest();
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            table.innerHTML = dados
           
        }
    }
    xml.send()
}
function fecharTabela(){
    let box_tabela = document.getElementById('box_tabela')
    box_tabela.className = "box-solicitacao-api d-none"
}
function fecharTabelaEstoque(){
    let box_tabela = document.getElementById('box_table_estoque')
    box_tabela.className = "box-solicitacao-api d-none"
}
function exibiListagemEstoque(){
    let box_tabela = document.getElementById('box_table_estoque')
    let table = document.getElementById('table_body_estoque')
    box_tabela.className = "box-solicitacao-api"
    let dt_inicial = document.getElementById('dt_inicial');
    let dt_final = document.getElementById('dt_final')
    let url = localhost+"/app/fun/ajax/list_estoque?dt_inicial="+dt_inicial.value+"&dt_final="+dt_final.value
    let xml = new XMLHttpRequest();
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            table.innerHTML = dados
           
        }
    }
    xml.send()
}
function carregarProdutos(){
    let url = localhost+"/app/fun/ajax/tabela_produtos"
    let div = document.getElementById('conteudo_tabela')
    let xml = new XMLHttpRequest();
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            div.innerHTML = dados
           
        }
    }
    xml.send()
}
function marcarDados(id){
    let marcador = document.getElementById(id)
    console.log(marcador)
    if(marcador.checked == true){
       if(marcador.isChecked){
        marcador.checked= false
       }
    }else{
        marcador.checked= false
    }
}
function pesquisarProduto(valor){
    let url = localhost+"/app/fun/ajax/tabela_produtos?pesquisa="+valor
    let div = document.getElementById('conteudo_tabela')
    let xml = new XMLHttpRequest();
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            div.innerHTML = dados
           
        }
    }
    xml.send()
}
function atualizarQtdProduto(id,qtd_atual){
    let valor = document.getElementById('item_'+id)
    if(valor.value == "" || valor.value <= -1){
        let cron = 3000
        let i=0
         valor.className ="form-control is-invalid"
         var temp = setInterval( ()=>{
            while( i < cron){

            if(i== 2500){
             valor.className ="form-control"
               clearInterval(temp)
            }
            i++
            }
        },cron)
      
    }else{
        valor.className = "form-control"
    let url  = localhost+"/ibautolub/public/api/v1/update/adm/produto/qtd"
    if(qtd_atual == undefined){
        qtd_atual = 0
    }
    let soma = parseInt(valor.value) + parseInt(qtd_atual);
    
    let form = new FormData()
    form.append('id',id)
    form.append('qtd',soma)
    let xml = new XMLHttpRequest();
    xml.open('post',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText;
            let json = JSON.parse(dados)
            if(json.result == true){
                msgSucesso()
                carregarProdutos()
                
            }else{
               console.log()
            }
        }
    }
    xml.send(form)
}
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
    let url = localhost+'/app/fun/ajax/tabela_'+tipo
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
function verificarAdm(){
    
    let input = document.getElementById('login_adm')
    let btn = document.getElementById('btn_salvar_adm')
    let url = localhost+"/ibautolub/public/api/v1/login/adm/"+btoa(input.value)
    console.log(url)
    let xml = new XMLHttpRequest()
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText;
            let json = JSON.parse(dados)
            //console.log(json)
            if(json.loginAth) {
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