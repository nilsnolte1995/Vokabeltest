<?php
session_start();

include "library/QuestionRenderer.php";
include "library/SessionUtilities.php";
//header("Cache-Control: post-check=0, pre-check=0", FALSE);
$fileName = $_GET["liste"];

SessionUtilities::setSessionIfNeeded($fileName);
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"/>

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <link rel="stylesheet" href="resources/css/fragen.css">

</head>

<body>


<div data-role="page" id="fragen" data-dom-cache="never">
    <div data-role="header" data-theme="a">
        <h1><?php echo basename($fileName, ".txt"); ?></h1>
    </div>


    <div>
        <div data-role="content">
            <center>
                <fieldset data-role="controlgroup" data-type="horizontal">
                    <input type="button" id="switchLanguageButton" value="Switch language">
                </fieldset>
            </center>

            <div class="ui-grid-a ui-responsive" id="questionContent">
                <?php QuestionRenderer::renderQuestion("./", $fileName); ?>
            </div>
            <div class="indicator" id="questionLoadingIndicator" style="display: none;"></div>
        </div>
    </div>


    <div data-role="footer" data-id="foo2" data-position="fixed">
        <div data-role="navbar">
            <ul>
                <li><a href="index.php">Auswahl</a></li>
                <li><a href="statistik.php">Statisik</a></li>
                <li><a href="setup.php">Setup</a></li>
            </ul>
        </div><!-- /navbar -->
    </div><!-- /footer -->

    <script type="text/javascript">

        $(document).ready(function () {

            $("#switchLanguageButton").on("click", function () {
                reloadQuestion(true, true);
            });

            function reloadQuestion(switchLang, animating) {

                var content = $("#questionContent");
                var indicator = $("#questionLoadingIndicator");

                var fileName = "<?php echo $fileName; ?>";

                content.hide();
                indicator.show();

                var data;

                if(switchLang)
                {
                    data = {liste: fileName, switchLanguage: switchLang};
                }else
                {
                    data = {liste: fileName};
                }
                $.ajax({
                    url: "./ajax/loadQuestion.php",
                    type: "post",
                    data: data ,
                    success: function (response) {
                        content.html(response);
                        content.enhanceWithin();

                        if(animating)
                        {
                            content.slideDown();
                        }else
                        {
                            content.show();
                        }

                        indicator.hide();

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }

            $(document).on("pagebeforeshow", "#fragen", function () {
                reloadQuestion(false, false);
            });

        });


    </script>
</div>

</body>
</html>