const Julianos = {
    name: 'Juliano',   
    senha: 'soder2022'
}

const Teste = {
    name: 'Teste',   
    senha: 'teste123'
}

function validaLogin(nome, senha){
    if(nome == 'Juliano'){
        localStorage.setItem('login', JSON.stringify(Julianos));
        return senha == Julianos.senha;
    }
    if(nome == 'Teste'){
        localStorage.setItem('login', JSON.stringify(Teste));
        return senha == Teste.senha;
    }
    return false;
}