<?php
    //«м≥нюЇмо мову
	if (isset($_GET["id"]))
    {
        $id = $_GET["id"];
        session_start();
        $_SESSION["language"] = $id;
        header("Location: index.php"); exit();
    }
?>