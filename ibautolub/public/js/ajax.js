// ---------------------------------Setar Rotas com paramentros--------------------------------------
let localhost = "http://192.168.1.206"
function abrirJanelaComParametros(urlTo,name,backUrl){
    location.href="/app/adm/"+urlTo+"&n="+btoa(name)+"&b="+btoa(backUrl);
}
// ---------------------------------Ativação Ajax Onclick--------------------------------------
function getTabelaService(){
    ajaxTableService()
}
function getTable(nome_pagina,marcador){
    let servico = document.getElementById('servico')
    let produto = document.getElementById('produto')
    let adm = document.getElementById('adm')
    let funcionario = document.getElementById('funcionario')
    let caixa = document.getElementById('caixa')
    switch(marcador){
        case 'servico':
            servico.className = "ativo"
            produto.className = ""
            adm.className = ""
            funcionario.className = ""
            caixa.className = ""
            break;
        case 'produto':
            servico.className = ""
            produto.className = "ativo"
            adm.className = ""
            funcionario.className = ""
            caixa.className = ""
            break;
        case 'funcionario':
            servico.className = ""
            produto.className = ""
            adm.className = ""
            funcionario.className = "ativo"    
            caixa.className = ""
            break
        case 'adm':
            servico.className = ""
            produto.className = ""
            adm.className = "ativo"
            funcionario.className = ""
            caixa.className = ""
            break;
        case 'caixa':
        servico.className = ""
        produto.className = ""
        adm.className = ""
        funcionario.className = ""
        caixa.className = "ativo"
        break;

    }
    
    ajaxGenerico(nome_pagina)
    //OBS.: as vezes não será o nome da página
}

// ---------------------------------Função Ajax Service--------------------------------------
function ajaxTableService(){
    let div = document.getElementById('manager_table');
    let url = "/app/adm/ajax/listagem_servico";
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
// ---------------------------------Função Ajax Service ATivacao--------------------------------------
//@Deprecated não pode ser usada
function enviarAtivacao(id){
  let xml = new XMLHttpRequest();
  let url = localhost+"/ibautolub/public/api/v1/service/ativar/"+id;
  xml.open('PUT',url);
  xml.onreadystatechange = ()=>{
    if(xml.readyState == 4 && xml.status == 200){
       let dados = xml.responseText
       let json = JSON.parse(dados)
       if(json.ativar == true){
        ajaxTableService()
       }
    }
  }
  xml.send();
}
// ---------------------------------Função Ajax Service Inativacao--------------------------------------
//@Deprecated não pode ser usada
function enviarInvativacao(id){
    let xml = new XMLHttpRequest();
    let url = localhost+"/ibautolub/public/api/v1/service/inativar/"+id;
    xml.open('PUT',url);
    xml.onreadystatechange = ()=>{
      if(xml.readyState == 4 && xml.status == 200){
         let dados = xml.responseText
         let json = JSON.parse(dados)
         if(json.inativar == true){
            ajaxTableService()
         }
      }
    }
    xml.send();
}
// ---------------------------------Função Ajax Ativacao/Inativacao Generica--------------------------------------
//Recomendação de Uso
function solicitacaoAjax(id,tipo,end_point,nome_pagina){
    let xml = new XMLHttpRequest();
    let url  = localhost+"/ibautolub/public/api/v1/"+tipo+"/"+end_point+"/"+id;
    xml.open('PUT',url)
    xml.onreadystatechange = ()=>{
        if(xml.readyState == 4 && xml.status == 200){
            let dados = xml.responseText
            let json = JSON.parse(dados);
            console.log(json)
            if(json.ativar == true || json.inativar == true){
                ajaxGenerico(nome_pagina)
            }
            
        }
    }
    xml.send()
}

// ---------------------------------Função Ajax Generica--------------------------------------
//Recomendação de Uso
function ajaxGenerico(nome_pagina){
    let div = document.getElementById('manager_table');
    let url = "/app/adm/ajax/"+nome_pagina;
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
function solicitarPedidoData(){
    let dt_inicial = document.getElementById('dt_incial')
    let dt_final = document.getElementById('dt_final')
    if(dt_final.value == "" || dt_inicial.value == ""){
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
        dt_inicial.className = "form-control"
        dt_final.className = "form-control"
        let div = document.getElementById('manager_table');
        let url = "/app/adm/ajax/listagem_caixa?dt_inicial="+dt_inicial.value+"&dt_final="+dt_final.value;
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

}


