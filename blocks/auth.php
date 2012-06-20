<?php
    if ((isset($_SESSION["id"]) && isset($_SESSION["hash"])) && ($_SESSION["id"] != "") && ($_SESSION["hash"] != ""))
    {
        $result = mysql_query("SELECT login, password, hash FROM users WHERE id='".$_SESSION["id"]."';", $db);
        $myrow  = mysql_fetch_array($result);
        
        //якщо хеш в≥рно то
        if ($_SESSION["hash"] == $myrow["hash"])
        {
?>
<table>
<tr>
<td valign="top">
<p id="left-menu_title"><?php
    echo $lang["auth_account"];
?></p>
<div id="left-menu_link">
<?php
            //¬≥дкриваЇмо доспуп
            echo "<p>".$lang["auth_hello"].": <strong><a href=\"users.php?id=".$_SESSION["id"]."\">".$myrow["login"]."</a></strong><br></p>";
            echo "<p><a href=\"messages.php\">".$lang["messages"]."</a></p>";
            echo "<p><a href=\"edit_profile.php\">".$lang["auth_id_edit"]."</a></p>";
            echo "<p><a href=\"logout.php\">".$lang["auth_exit"]."</a></p>";
?></div>
</td>
</tr>
</table><?php
        }
        else
        {
            include"blocks/auth_table.php";
            echo "<p>".$lang["auth_false_login_or_pass"]."</p>";
        }
    }
    else
    {
        include"blocks/auth_table.php";
    }
?>