

<DOCKTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
    

  
<div data-role="page" id = "Statistik">
        <div data-role="header" data-theme="a">
            <h1> Statistik</h1>
            <form class="ui-filterable">
            <input id="filterable-input" data-type="search" placeholder="Search Languages...">
            <center><ul class="list-group"  data-role="listview"data-filter="true" data-inset="true" data-input="#filterable-input" >
            <?php include("stat_funkt.php"); ?>
        </ul></center> 
      </form>
      
      
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