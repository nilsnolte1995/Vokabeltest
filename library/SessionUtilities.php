<?php

class SessionUtilities
{
    public static function setSessionIfNeeded($fileName)
    {
        $sessionName = self::getSessionName($fileName);

        if(!isset($_SESSION[$sessionName]))
        {
            $_SESSION[$sessionName] = 1;
        }

        return $sessionName;
    }

    public static function getSessionName($fileName)
    {
        return "language-".str_replace("." ,"_" , $fileName);
    }
}