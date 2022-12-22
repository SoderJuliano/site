<?php
function saveFileLogin($name, $value){
    
    $location = $name.".txt";
    $myfile = fopen($location, "w") or die("Unable to open file!");
    $txt = $value;
    fwrite($myfile, $txt);
    fclose($myfile);
}
?>