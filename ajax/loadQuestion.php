<?php
session_start();

include "../library/SessionUtilities.php";
include "../library/QuestionRenderer.php";

$fileName = $_POST["liste"];
$switchLanguage = isset($_POST['switchLanguage']);

$sessionName = SessionUtilities::getSessionName($fileName);

if($switchLanguage)
{
    if($_SESSION[$sessionName] == 1)
    {
        $_SESSION[$sessionName] = 2;
    }else{
        $_SESSION[$sessionName] = 1;
    }
}

QuestionRenderer::renderQuestion("../", $fileName);