<?php

function write_file($filename, $inhalt){
$handle = fopen("./Statistik/".$filename."_statistik.txt","w");
    //var_dump("./Statistik/".$filename."_statistik.txt");
   // var_dump($handle);
    fputs($handle, $inhalt);
    fclose($handle);
}

?>