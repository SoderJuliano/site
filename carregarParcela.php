<?php

$novoAno = $_POST['trocouAno'];

if ($novoAno != null){
    lerTodosArquivos($novoAno);
}  

function carrgarParcela($url){
    $arquivo = fopen($url, 'r') or die("Unable to open file!");
    $json = fgets($arquivo);
    if(str_contains($json, 'dataPagamento')){

        $obj = json_decode($json);
        $arr = array($obj->valorDaParcela,$obj->dataPagamento,$obj->parcela,$obj->pago,$obj->nome);
        //var_dump($arr);
        if($obj->pago == "true"){

            echo '
            <li class="list-group-item">'.$obj->dataPagamento.'
                <button class="btn btn-success" data-toggle="collapse" data-target="#collapseOne">
                <i class="bi bi-check"></i>Pago
                </button>
            </li>
        ';

        }else{

            echo '
            <form action="detalhesParcela.php" method="GET" >
                <li class="list-group-item">'.$obj->dataPagamento.'
                    <button name="bntTrash" value="'.$obj->nome.'" type="submit" class="btn btn-light">
                        <i class="bi bi-trash"></i>
                    </button>
                    <button name="detalhesObjeto" value="'.$obj->nome.'" type="submit" class="btn btn-warning" data-toggle="collapse" data-target="#collapseOne">
                        <img src="./img/papel-moeda.png" alt="Nao pago png" width="23" height="20"> 
                    </button>
                    <button id="pagar-bnt" value="'.$obj->nome.'" type="button" class="btn btn-success" disabled>Pagar</button>
                    <input id="inp" type="file" class="btn btn-primary" type="button" value="Input">
                    <p id="b64"></p>
                </li> 
            </form>  
            <script>
                $(".btn.btn-success").click(function (e) { 
                    pagarParcela(e.target.value, document.getElementById("b64").textContent);
                });
            </script>
        ';

        }
        
    }
    
    fclose($arquivo);
}

function lerTodosArquivos($ano){
    $arquivos = glob("{*".$ano.".txt,*.json}", GLOB_BRACE);
    foreach($arquivos as $title){
        carrgarParcela($title);
    }
}

function objToString($obj){
    return '{"valorDaParcela": "'.$obj->valor.'", "dataPagamento": "'.$obj->dataPagamento.'", "parcela": "'.$obj->parcela.'", "pago": "'.$obj->pago.'", "nome": "'.$obj->nome.'"}';
}

function mostrarComprovantes($user){
    $parcelas = array();
    $arquivos = glob("{*.txt,*.json}", GLOB_BRACE);
    foreach($arquivos as $key => $arquivo) {
        if($arquivo->lancador == $user->name){
            array_push($parcelas, $arquivo)
        }
    }
}
?>