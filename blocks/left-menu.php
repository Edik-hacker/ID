<table>
<tr>
  <td valign="top">
  <p id="left-menu_title"><?php echo $lang["left-menu_menu"]; ?></p>
  
  <div id="left-menu_link">
  <a href="index.php"><?php echo $lang["article"]; ?></a><br />
  <a href="view_users.php"><?php echo $lang["view_users"]; ?></a><br />
<?php
    if ((isset($_SESSION["id"]) && isset($_SESSION["hash"])) && ($_SESSION["id"] != "") && ($_SESSION["hash"] != ""))
    {
        $result = mysql_query("SELECT login, password, hash FROM users WHERE id='".$_SESSION["id"]."';", $db);
        $myrow  = mysql_fetch_array($result);
    }
?>
  </div>
  </td>
</tr>
</table>
<br />
<?php include"auth.php"; ?>