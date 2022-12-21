<?php
function saveFile($name, $value){
    $location = $name.".txt";
    $myfile = fopen($location, "w") or die("Unable to open file!");
    $txt = $value;
    fwrite($myfile, $txt);
    fclose($myfile);
}
    
    $login = $_POST['loginName'];

    saveFile("online", $login);

    echo 'login efetuado '.$login;

?>