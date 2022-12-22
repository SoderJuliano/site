<?php
function saveFileLogin($name, $value){
    
    $location = $name.".txt";
    $myfile = fopen($location, "w") or die("Unable to open file!");
    $txt = $value;
    fwrite($myfile, $txt);
    fclose($myfile);
}  

function saveFileAnoVigente($ano){
    $arquivo = fopen("online.txt", 'r') or die("No user found!");
    $json = fgets($arquivo);
    $obj = json_decode($json);

    $obj->anoVigente = $ano;
    $string = json_encode($obj);
    
    fwrite($arquivo, $string);
    fclose($arquivo);
    echo $obj->anoVigente;
}
    $nome = $_POST['loginName'];
    $ano = $_POST['loginAno'];

    if($nome && $ano){

        $string = '{"nome": "'.$nome.'", "anoVigente": "'.$ano.'"}';
        saveFileLogin("online", $string);
        echo 'realizado login'; 

    }elseif($nome==null && $ano){
        saveFileAnoVigente($ano);
    }

?>