let Julianos = {
    name: 'Juliano',   
    senha: 'soder2022',
    anoVigente: '2022'
}

let Teste = {
    name: 'Teste',   
    senha: 'teste123',
    anoVigente: '2022'
}

function validaLogin(nome, senha){
    console.log('validando login');
    if(nome == 'Juliano'){
        if(!localStorage.getItem('login')){
            localStorage.setItem('login', JSON.stringify(Julianos));
        }
        return senha == Julianos.senha;
    }
    if(nome == 'Teste'){
        if(!localStorage.getItem('login')){
            localStorage.setItem('login', JSON.stringify(Teste));
        }
        return senha == Teste.senha;
    }
    return false;
}

function atualizaAnovigente(nome, ano){
    if(nome == 'Juliano'){
        Julianos.anoVigente = ano;
        localStorage.setItem('login', JSON.stringify(Julianos));
    }else{
        Teste.anoVigente = ano;
        localStorage.setItem('login', JSON.stringify(Teste)); 
    }
}

function getNomeUsuarioLogado(){
    return JSON.parse(localStorage.getItem('login')).name;
}