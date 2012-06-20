<?php
    if (isset($_SESSION["id"]) && isset($_SESSION["hash"]))
    {
        $result_log = mysql_query("SELECT id, hash, role FROM users WHERE id='".$_SESSION["id"]."'", $db);
        $log        = mysql_fetch_array($result_log);
    
        if ($_SESSION["hash"] == $log["hash"])
        {
            $user_login = true;
            if ($log["role"] == "admin")
            {
                $admin = true;
            }
        }
        else
        {
            $user_login = false;
        }
        $id         = $_SESSION["id"];
        $id_user    = $_SESSION["id"];
    }
    

    if (!isset($admin) || $admin == false)
    {
        header("Location: index.php");
    }

?>