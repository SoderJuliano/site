<?php
function saveFileLogin($name, $value){
    
    $location = $name.".txt";
    $myfile = fopen($location, "w") or die("Unable to open file!");
    $txt = $value;
    fwrite($myfile, $txt);
    fclose($myfile);
}
    echo 'Iniciando login';
    
    $nome = $_POST['loginName'];
    $ano = $_POST['loginAno'];

    $string = '{"nome": "'.$nome.'", "anoVigente": "'.$ano.'"}';

    saveFileLogin("online", $string);

    echo 'login efetuado '.$nome;

?>