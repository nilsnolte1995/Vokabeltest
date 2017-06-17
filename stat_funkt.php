<?php
$dateinamen = scandir('Statistik'); 
foreach($dateinamen as $datei){
    if($datei != "."&& $datei != ".."  && $datei != ".DS_Store:") {
        $datei_ohne_Endung = del_dateityp($datei);
        //(basename($lektion,".txt")
    if($datei_ohne_Endung != ".DS" && $datei_ohne_Endung != ".DS_Store:" && file_exists("uploads/".$datei_ohne_Endung.".txt")){  //nur die Dateien die in Uploads sind und keine die gelöscht wurden
        if (($handle = fopen("./Statistik/".$datei_ohne_Endung."_statistik.txt", "r")) !== FALSE) {

            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
             $inhalt = $data[0]. "/" . $data[1];
            }
                fclose($handle);
            } 
                echo "<li class='list-group-item'>".$datei_ohne_Endung.":<br>".$inhalt."</li>" ;
        }   
    }
}
function del_dateityp($datei){
    
    return substr($datei, 0, strlen($datei) - strlen(strrchr($datei, "_")));
}
?>