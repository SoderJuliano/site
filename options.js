const Tiago = {
    name: 'Tiago',
    senha: 'tiago2022'
}

const Julianos = {
    name: 'Juliano',   
    senha: 'soder2022'
}

function validaLogin(nome, senha){
    if(nome == 'Tiago'){
        localStorage.setItem('login', JSON.stringify(Tiago));
        return senha == Tiago.senha;
    }
    if(nome == 'Juliano'){
        localStorage.setItem('login', JSON.stringify(Julianos));
        return senha == Julianos.senha;
    }
    return false;
}