<DOCKTYPE html>
    <html>
    <head>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        <link rel="stylesheet" href="fragen1.css">
    </head>

    <body>

    <div data-role="page" id = "Setup">
        <div data-role="header" data-theme="a">
            <h1>Setup</h1>
        </div>
        <div data-role="content" >
         
            <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data" data-ajax="false">
                 <label for="file">Laden sie eine Datei zum einlesen hoch</label>
                 <input type="file" data-clear-btn="false" id="fileToUpload">
                <button name = "submit" type="submit" data-role="button" data-icon="plus" data-inline="true" >Datei hochladen</button>
            </form>

            <div id="fileUploadResult"></div>
                
        </div>
        <div data-role="footer" data-id="foo1" data-position="fixed">
            <div data-role="navbar">
                <ul>
                    <li><a href="index.php">Auswahl</a></li>
                    <li><a href="statistik.php">Statistik</a></li>
                </ul>
            </div><!-- /navbar -->
        </div><!-- /footer -->

        <script type="text/javascript">

            $("#uploadForm").submit(function (e) {
                e.preventDefault();

                var file_data = $('#fileToUpload').prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);
                $.mobile.loading("show");

                $.ajax({
                    url: 'upload.php', // point to server-side PHP script
                    dataType: 'text',  // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(response){
                        $("#fileUploadResult").html(response); // display response from the PHP script, if any
                        $.mobile.loading("hide");
                    }
                });
            });

        </script>

    </div>
    
    </body>
</html>