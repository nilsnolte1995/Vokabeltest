<?php
include "../library/QuestionRenderer.php";

$fileName = $_POST["liste"];
$cookieName = QuestionRenderer::getCookieName($fileName);

if(!isset($_COOKIE[$cookieName]))
{
    die();
}


$switchLanguage = isset($_POST['switchLanguage']);

if($switchLanguage)
{
    if($_COOKIE[$cookieName] == "1")
    {
        setcookie($cookieName, "2");
    }else{
        setcookie($cookieName, "1");
    }
}

//echo $_COOKIE[$cookieName];

QuestionRenderer::renderQuestion("../", $fileName);