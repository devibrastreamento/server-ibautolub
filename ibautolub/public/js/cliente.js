let localhost= "http://192.168.1.206"
function abrirJanela(urlTo,name,backUrl){
    
    location.href="/app/client/"+urlTo+"?n="+btoa(name)+"&b="+btoa(backUrl);
}
function abrirJanelaComParametros(urlTo,name,backUrl){
    location.href="/app/client/"+urlTo+"&n="+btoa(name)+"&b="+btoa(backUrl);
}
function carregarDados(id){
   
    carregarDadosCompras(id)
    
}
function carregarDadosCompras(id){
    let xml = new XMLHttpRequest();
    let url = localhost+"/app/fun/ajax/consultar_compra_cliente?id="+btoa(id)
    let div = document.getElementById('conteudo_painel')
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        
        if(xml.readyState == 4 && xml.status == 200){
           
            let dados = xml.responseText
            div.innerHTML = dados
        }
    }
    xml.send()
}
function pesquisarCompraData(id){
    let dt_inicial = document.getElementById('dt_inicial')
    let dt_final = document.getElementById('dt_final')
    if(dt_inicial.value == "" || dt_final.value == ""){
        if(dt_final.value == ""){
            dt_final.className = "form-control is-invalid"
        }
        if(dt_inicial.value == ""){
            dt_inicial.className = "form-control is-invalid"
        }
    }else{
        dt_final.className = "form-control"
        dt_inicial.className = "form-control"
        solicitacaoDadosData(id,dt_inicial.value,dt_final.value);
    }
}
function solicitacaoDadosData(id,inicial,final){
    let xml = new XMLHttpRequest();
    let url = localhost+"/app/fun/ajax/consultar_compra_cliente?acao=pesquisa&id="+btoa(id)+"&dt_inicial="+inicial+"&dt_final="+final
    let div = document.getElementById('conteudo_painel')
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            div.innerHTML = dados
     
        }
    }
    xml.send()

}
function carregarResultadoCarros(id){
    let url = localhost+"/app/fun/ajax/consultar_carro_cliente?id="+id
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
function carregarListaProdutos(){
    let url = localhost+"/app/fun/ajax/consultar_produto"
    let xml = new XMLHttpRequest();
    let div = document.getElementById('result_product')
    xml.open('GET',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            div.innerHTML = dados
            
            
     
        }
    }
    xml.send()

}
function reloadAutomatico(){
      carregarListaProdutos()
    let temp = setInterval(()=>{
        carregarListaProdutos()
    },5000)
}
function atualizarDadosBasico(id){
   let nome = document.getElementById('nome')
   let email = document.getElementById('email')
   let telefone = document.getElementById('telefone')
   let cpf = document.getElementById('cpf')
   let form = document.getElementById('update_basic')
   let btn = document.getElementById('btn_update_basic')
   if(nome.value == "" || email.value == "" || telefone.value == "" || cpf.value == ""){
    if(nome.value == ""){
        nome.className =  "form-control is-invalid"
    }else{
        nome.className =  "form-control"
    }
    if(email.value == ""){
        email.className =  "form-control is-invalid"
    }else{
        email.className =  "form-control"
    }
    if(cpf.value == ""){
        cpf.className =  "form-control is-invalid"
    }else{
        cpf.className =  "form-control"
    }
    if(telefone.value == ""){
        telefone.className =  "form-control is-invalid"
    }else{
        telefone.className =  "form-control"
    }
   }else{
        form.action = "/app/client/proccess_basic"
        btn.type = "submit"
        form.method= "POST"
   }
}
function salvarDadosSenha(){
    let senha = document.getElementById('senha')
   let login = document.getElementById('login')
   let senha2 = document.getElementById('senha2')
   let form = document.getElementById('form_password')
   let btn = document.getElementById('btn_password')
   let msg = document.getElementById('msg')
   if(login.value == "" || senha.value == ""){
            msg.className = "mostrar"
            let i = 0;
            let cron = 3000
            let temp = setInterval(()=>{
                    while( i < cron){
                        if(i == 2500){
                            msg.className = "apagar"
                            clearInterval(temp)
                        }
                        i++
                    }
            },cron)
   }else{
       if(senha2.value == senha.value){
        form.action = "/app/client/proccess_password"
        btn.type = "submit"
        form.method= "POST"
        senha2.className = "form-control"
        senha.className = "form-control"
       }else{
        senha2.className = "form-control is-invalid"
        senha.className = "form-control is-invalid"
       }
   }
}
