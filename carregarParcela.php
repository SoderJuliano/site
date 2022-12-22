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

function mostrarComprovantes($user, $ano){
    echo $user. ' ' . $ano;
    echo '
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Data de pagamento</th>
        <th scope="col">Valor</th>
        <th scope="col">Comprovante</th>
        </tr>
    </thead>
    <tbody>';

    $arquivos = glob("{*.txt,*.json}", GLOB_BRACE);
    foreach($arquivos as $key => $url) {
        
        $arquivo = fopen($url, 'r') or die("Unable to open file!");
        $json = fgets($arquivo);
        $obj = json_decode($json);
        if($obj->lancador == $user && str_contains($obj->dataPagamento, $ano)){
            echo '<tr><th scope="row">'.$key.'</th>';
            echo '<td>'.$obj->dataPagamento.'</td>';
            echo '<td>R$ '.$obj->valorDaParcela.'</td>';
            echo '<td><img src="'.$obj->img.'" class="img-fluid" alt="Imagem não encontrada!" /></td>';
        }
    }    
    echo '</tbody>';
}

function getOnlineUser(){
    $arquivo = fopen("online.txt", 'r') or die("No user found!");
    return fgets($arquivo);
}

function getUserName(){
    $online = getOnlineUser();
    $obj = json_decode($online);
    //echo $online;
    return $obj->nome;
}
function getAnoVingente(){
    $online = getOnlineUser();
    $obj = json_decode($online);
    //echo $online;
    return $obj->anoVigente;
}
?>