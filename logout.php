<?php
    session_start();
    if (isset($_SESSION["id"]) && isset($_SESSION["hash"]))
    {
        unset($_SESSION["id"]);
        unset($_SESSION["hash"]);
    }
    header("Location: index.php"); exit();
?>