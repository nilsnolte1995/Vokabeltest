<!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"/>
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        <link rel="stylesheet" href="fragen1.css">
    
    </head>
   
    <body>

    <div data-role="page" id="antwort">
        <div data-role="header" data-theme="a">
            <h1><?php echo $_GET["lektion"]?></h1>
        </div>
        <div data-role="content">
            <?php 
            include("write_file.php");
            $lektion = $_GET["lektion"];
            $vokabel1 = $_POST["vokabel1"];
            $vokabel2 = $_POST["vokabel2"];   
            
            if(isset($_POST["antwort_klickt"])) {

            $antwort_klickt = $_POST["antwort_klickt"];

                //zum Auslesen der Statistikdateien

            if (($handle = fopen("./Statistik/".basename($lektion,".txt")."_statistik.txt", "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    $num = count($data);
                    for ($c=0; $c < $num; $c++) {
                         $inhalt[] = $data[$c]; 
                    }
                }
                fclose($handle);
                }
                //Variablen für die Antworten der Stastistik
                    $richtige_antworten = (int)$inhalt[0];
                    $gesamt_antworten = (int)$inhalt[1];
                //zählt die gesamten Variablen    
                    $gesamt_antworten++;
             

                if($vokabel2 == $antwort_klickt) {
                    echo "
                    <div class='antwort-box green'>
                        <p> {$vokabel1 }</p>
                         <p>{$vokabel2 }</p>
                    </div>";
                    $richtige_antworten ++;

                    
                }
                else {
                    echo"
                    <div class='antwort-box red'>
                        <p> {$vokabel1 }</p>
                         <p class='durchgestrichen'> {$antwort_klickt }</p>
                         <p>{$vokabel2 }</p>
                    </div>";
                }
            }
            else {
                  echo "
                    <div class='antwort-box red'>
                        <p> {$vokabel1 }</p>
                         <p>{$vokabel2 }</p>
                    </div>";
            }
            
            write_file(basename($lektion,".txt"),$richtige_antworten.";".$gesamt_antworten);
            ?>
            
            
           <center><a type='submit' data-inline='true' data-role='button' data-icon='arrow-r' data-iconpos='right' href='fragen.php?liste=<?php echo $_GET['lektion'] ?>'>Weiter</a> </center> 
            

            <div data-role="footer" data-id="foo2" data-position="fixed">
                <div data-role="navbar">
                    <ul>
                        <li><a href="index.php">Auswahl</a></li>
                        <li><a href="statistik.php">Statisik</a></li>
                        <li><a href="setup.php">Setup</a></li>
                    </ul>
                </div><!-- /navbar -->
            </div><!-- /footer -->
        </div>


    </body>
    </html>