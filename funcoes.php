<?php

$pagarParcela = $_POST['editarObj'];

$parcelas = $_GET['quantidadeDeParcelas'];

$valor = $_GET['valorDaParcela'];

$dataHoje = date("d-m-Y");

if($pagarParcela !== null) {
    //echo $pagarParcela.".txt";
    $arquivo = fopen($pagarParcela.".txt", 'r') or die("Unable to open file!");
    $json = fgets($arquivo);
    $obj = json_decode($json);
    $obj->pago = 'true';
    echo $obj->pago;
    saveFile($obj->nome, json_encode($obj));
}else{

    for ($i=0; $i < $parcelas; $i++) {

        $mes = $dataHoje.' '.'+'.$i.' month';
        echo $dataHoje." ".$mes."<br />";
        $nome = "Parcela_".date('d-m-Y', strtotime($mes));
    
        echo $nome."<br />";
    
        $json = '{"valorDaParcela": "'.$valor.'", "dataPagamento": "'.date('d-m-Y', strtotime($mes)).'", "parcela": "'.($i+1).'", "pago": "false", "nome": "'.$nome.'"}';
    
        saveFile($nome, $json);
        teste();
    
    }
} 


function saveFile($name, $value){
    $location = $name.".txt";
    $myfile = fopen($location, "w") or die("Unable to open file!");
    $txt = $value;
    fwrite($myfile, $txt);
    fclose($myfile);
}

function deleteFile($name){
    $location = $location.''.$name.".txt";
    unlink($location);
}

function teste(){
    echo "Funcionou<br>";
}

/* if(strtotime($data1) > strtotime($data2))
 
  echo 'A data 1 é maior que a data 2.';
  */

?>