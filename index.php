<DOCKTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <link rel="stylesheet" href="resources/css/fragen.css">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        
        
</head>


<body>
    <div data-role="page" id = "Startseite">
        <div data-role="header" data-theme="a">
            <h1> Auswahl</h1>
        </div>
        <div data-role="content">
          
            <?php
            include ("write_file.php");
            $vokabellisten = scandir('uploads');
            $vokabellisten =  array_slice($vokabellisten, 2);
            foreach($vokabellisten as $liste) 
            {
                $file_name = basename($liste,".txt");
                echo "<a href='fragen.php?liste={$liste}'data-role='button' data-icon='arrow-r' data-iconpos='right'>".$file_name."</a>";
                if (!file_exists("./statistik/".$file_name ."_statistik.txt")) { //legt für eine neue Lektion eien Stat Datei an
                    write_file($file_name,"0;0");
            }
            }

            ?>  
        </div>
          
       
        <div data-role="footer" data-id="foo1" data-position="fixed">
            <div data-role="navbar">
                <ul>
                    <li><a href="statistik.php">Statistik</a></li>
                    <li><a href="setup.php">Setup</a></li>
                </ul>
            </div><!-- /navbar -->
        </div><!-- /footer -->
    </div>
</body>
</html>