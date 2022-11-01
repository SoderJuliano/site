<?php
echo 'called me <br/>';

$pagarParcela = $_POST['editarObj'];

$parcelas = $_GET['quantidadeDeParcelas'];

$valor = $_GET['valorDaParcela'];

$dataHoje = date("d-m-Y");

if($pagarParcela !== null) {
    echo $pagarParcela.".txt";
    $arquivo = fopen($pagarParcela.".txt", 'r') or die("Unable to open file!");
    $json = fgets($arquivo);
    $obj = json_decode($json);
    $obj->pago = 'true';
    echo $obj->pago;
    saveFile($obj->nome, json_encode($obj));
}else{
    if($parcelas == 0){
        $nome = "Parcela_".$dataHoje;
    
        echo $nome."<br />";
    
        $json = '{"valorDaParcela": "'.$valor.'", "dataPagamento": "'.$dataHoje.'", "parcela": "1", "pago": "false", "nome": "'.$nome.'"}';
    
        saveFile($nome, $json);
        teste();
    }
    for ($i=0; $i < $parcelas; $i++) {
        $lastaDate = getTheLastDammDate();
        $mes = $lastaDate ? $lastaDate.' '.'+'.$i.' month' : $dataHoje.' '.'+'.$i.' month';
        echo $dataHoje." ".$mes."<br />";
        $nome = "Parcela_".date('d-m-Y', strtotime($mes));
    
        echo $nome."<br />";
    
        $json = '{"valorDaParcela": "'.$valor.'", "dataPagamento": "'.date('d-m-Y', strtotime($mes)).'", "parcela": "'.($i+1).'", "pago": "false", "nome": "'.$nome.'"}';
    
        saveFile($nome, $json);
        teste();
    
    }

    echo '<script>
        setTimeout(function() { 
            document.write("<p>redirecionando em 4</p>");
        }, 1000);
        setTimeout(function() { 
            document.write("<p>redirecionando em 3</p>");
        }, 2000);
        setTimeout(function() { 
            document.write("<p>redirecionando em 2</p>");
        }, 3000);
        setTimeout(function() { 
            document.write("<p>redirecionando em 1</p>");
        }, 4000);
        setTimeout(function() { 
            window.location.href = "/site/";
        }, 5000);
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

    echo '<br/>';
    echo "A maior data e ".$maiorData."<br/>";
    echo "Último arquivo é ".$lastDateName."<br/>";

    return $maiorData;
} 

?>