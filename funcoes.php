<?php

$pagarParcela = $_POST['editarObj'];

$comprovante = $_POST['comprovante'];

$pegarParcela = $_GET['detalhesObjeto'];

$parcelas = $_GET['quantidadeDeParcelas'];

$valor = $_GET['valorDaParcela'];

$dataHoje = date("d-m-Y");

$mesReferencia = explode("-", $dataHoje)[1];

$lancador = $_GET['lancadorParcela'];
/* 
echo "pagar parcela ".$pagarParcela;
echo "pagar parcela ".$comprovante; */

if($pagarParcela !== null && $comprovante !== null) {

    $arquivo = fopen($pagarParcela.".txt", 'r') or die("Unable to open file!");
    $json = fgets($arquivo);
    $obj = json_decode($json);
    $obj->pago = 'true';
    $obj->img = $comprovante;
    echo $obj->pago;
    saveFile($obj->nome, json_encode($obj));

    $pagarParcela = null;
    $comprovante = null;
    
}elseif($pagarParcela == null && $pegarParcela == null){
    
    if($parcelas == 0){
        $nome = "Parcela_".$dataHoje;
        $arquivos = glob("{*.txt}", GLOB_BRACE);

        foreach($arquivos as $arquivo){
            if(str_contains($arquivo, "-".$mesReferencia."-")){
                $js = getObjectByName(explode(".txt", $arquivo)[0]);
                unlink($js->nome.".txt");
            }
        }

        $json = '{"valorDaParcela": "'.$valor.'", "dataPagamento": "'.$dataHoje.'", "parcela": "1", "pago": "false", "nome": "'.$nome.'", "lancador": "'.$lancador.'"}';
    
        saveFile($nome, $json);
        //teste();
    }
    $arquivos = glob("{*.txt}", GLOB_BRACE);
    $idParcela = sizeof($arquivos)+1;
    $lastaDate = getTheLastDammDate();

    for ($i=0; $i < $parcelas; $i++) {
        $mes = $lastaDate ? $lastaDate.' '.'+'.$i.' month' : $dataHoje.' '.'+'.$i.' month';
        $nome = "Parcela_".date('d-m-Y', strtotime($mes));
    
    
        $json = '{"valorDaParcela": "'.$valor.'", "dataPagamento": "'.date('d-m-Y', strtotime($mes)).'", "parcela": "'.($idParcela+$i).'", "pago": "false", "nome": "'.$nome.'", "lancador": "'.$lancador.'"}';
    
        saveFile($nome, $json);
        //teste();
    
    }

    goBack();
} 

function goBack(){
    echo '<script>
        setTimeout(function() { 
            window.location.reload;
        }, 900);
        window.location.href = "/site/main.php";
    </script>';
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
    echo "Funcionou<br/>";
}

 
function getTheLastDammDate(){
    $maiorData = null;

    $arquivos = glob("{*.txt}", GLOB_BRACE);

    for ($i=0; $i < sizeof($arquivos) ; $i++) { 
        
        $data1 = explode("_", $arquivos[$i])[1];
        if(is_null($arquivos[$i+1])){
            $data2 = explode("_", $arquivos[0])[1];
        }else{
            $data2 = explode("_", $arquivos[$i+1])[1];
        }
        
        $data1 = explode(".", $data1)[0];
        $data2 = explode(".", $data2)[0];

        $date1 = date_create($data1);
        $date2 = date_create($data2);
        $data1 = date_format($date1, 'Y-m-d');
        $data2 = date_format($date2, 'Y-m-d');

        if(strtotime($data2) > strtotime($data1) && strtotime($data2) > strtotime($maiorData)){
            echo 'data2 '.$data2. ' e maior que '.$data1.'<br/>';
            $maiorData = $data2;
        }
    }

    $maiorData = date_create($maiorData);
    $maiorData = date_format($maiorData, "d-m-Y");

    $lastDateName = "Parcela_".$maiorData.".txt";
/* 
    echo '<br/>';
    echo "A maior data e ".$maiorData."<br/>";
    echo "??ltimo arquivo ?? ".$lastDateName."<br/>"; */

    return $maiorData;
} 

function getObjectByName($name){
    $arquivo = fopen($name.".txt", 'r') or die("Unable to open file!");
    $json = fgets($arquivo);
    return json_decode($json);
}

?>