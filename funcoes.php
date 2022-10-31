<?php
echo 'called me <br/>';

getTheLastDammDate();

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
    if($parcelas == 0){
        $nome = "Parcela_".$dataHoje;
    
        echo $nome."<br />";
    
        $json = '{"valorDaParcela": "'.$valor.'", "dataPagamento": "'.date('d-m-Y', strtotime($mes)).'", "parcela": "1", "pago": "false", "nome": "'.$nome.'"}';
    
        saveFile($nome, $json);
        teste();
    }
    for ($i=0; $i < $parcelas; $i++) {

        $mes = $dataHoje.' '.'+'.$i.' month';
        echo $dataHoje." ".$mes."<br />";
        $nome = "Parcela_".date('d-m-Y', strtotime($mes));
    
        echo $nome."<br />";
    
        $json = '{"valorDaParcela": "'.$valor.'", "dataPagamento": "'.date('d-m-Y', strtotime($mes)).'", "parcela": "'.($i+1).'", "pago": "false", "nome": "'.$nome.'"}';
    
        saveFile($nome, $json);
        teste();
    
    }

    //echo '<script>window.location.href = "/site/"</script>';
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
    $maiorData = date_create("1989-09-11");
    $maiorData = date_format($maiorData,"Y-m-d");

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
/*   
        $data1 = (int)str_replace("-", "",$data1);
        $data2 = (int)str_replace("-", "",$data2);

        echo intval($data1) == intval($data2);
        echo "<br/>"; */

        if(strtotime($data2) > strtotime($data1) && strtotime($data2) > strtotime($maiorData)){
            echo 'data2 '.$data2. ' e maior que '.$data1.'<br/>';
            $maiorData = $data2;
        }
    }
    echo '<br/>';
    echo "A maior data e ".$maiorData."<br/>";
} 

?>