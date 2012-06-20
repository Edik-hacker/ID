<?php   
    session_start(); 
    $session_name  = "language";
    $cookie_name   = "language";
    //���������� �� ������� ����
    if(empty($_GET["cookie"]))
    {
        //���� ��� ������� � ��� � �������� ��
        if (isset($_COOKIE[$cookie_name])  && $_COOKIE[$cookie_name] != "")
        {
            //���� ���� ����� �� 
            if (isset($_SESSION[$session_name]) && $_SESSION[$session_name] == "")
            {
                $_SESSION[$session_name] = $_COOKIE[$cookie_name];
            }
            else
            {
                //SetCookie($cookie_name, $_SESSION[$session_name]);
            }
        }
        //������ ���� ��� �� ������� ��� ���� ��
        else
        {
            if (isset($_SESSION[$session_name]))
            {
                SetCookie($cookie_name, $_SESSION[$session_name]);
            }
            else
            {
                $_SESSION[$session_name] = 1;
            }
        }
    }
    else
    {
        if ($_SESSION[$session_name] == "")
        {
            $_SESSION[$session_name] = 1;
        }
    }
    
    if (!isset($_SESSION[$session_name]))
    {
        $_SESSION[$session_name] = 1;
    }    
    

    
    if (isset($_SESSION[$session_name]) && $_SESSION[$session_name] == 1) {
        include "language/ua.php";
        $language = "ua";
    }
    else
    if (isset($_SESSION[$session_name]) && $_SESSION[$session_name] == 2) {
        include "language/ru.php";
        $language = "ru";
    }
    else
    if (isset($_SESSION[$session_name]) && $_SESSION[$session_name] == 3) {
        include "language/en.php";
        $language = "en";
    }
?>