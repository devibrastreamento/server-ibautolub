let btn_login_fun = document.getElementById('btn_login_fun')

btn_login_fun.addEventListener('click',()=>{
    let form = document.getElementById('form_login_fun')
    let login = document.getElementById('login')
    let senha = document.getElementById('senha')
    let msg = document.getElementById('msg')
    let cron = 3000
    if(login.value == '' || senha.value == ''){
        let i = 0;
        msg.className="mostrar"
        const temp = setInterval(()=>{
            
            while(i<cron){
              
                
                if(i == 2500){
                    msg.className="apagar"
                   clearInterval(temp)
                }
                i++
            }
        },cron)
        
    }else{
        form.action = "/app/login/processo_fun"
        form.method= "POST"
        btn_login_fun.type = "submit"
        
    }
})

