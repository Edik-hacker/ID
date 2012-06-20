<?php
	include_once "blocks/db.php";
    include "blocks/language.php";
    include "authentication_admin.php"; 
    $userslink      = "<a href=\"view_users.php\">".$lang["view_users"]."</a>";
    $profilelink    = "<a href=\"users.php?id=".$id_user."\">".$lang["auth_account"]."</a>";
?>
<?php include "header.html"; ?>

<head>
<?php include "head.html"; ?>
	<title><?php echo $lang["delete_user"]; ?></title>
</head>

<body>
<div id="header"><!--block header-->
<div id="logo"></div>
</div><!--End block header-->


<div id="page"><!--block page-->
<div id="left-menu"><!--block left-menu-->
<?php include"blocks/left-menu.php"; ?>
</div><!--End block left-menu-->

<div id="content"><!--block content-->

<?php
        if (!isset($_GET["d"]))
        {
?>
<table border="0" width="350">
<tr>
<td colspan="2"><center><p id="title"><?php echo $lang["delete_user_delete"] ?></p></center></td>
</tr>
<tr>
<td width="175"><center><a href="delete_user.php?d=1&id=<?php echo $_GET["id"]; ?>"><?php echo $lang["delete_user_delete_yes"]; ?></a></center></td>
<td width="175"><center><a href="delete_user.php?d=0&"><?php echo $lang["delete_user_delete_no"]; ?></a></center></td>
</tr>
</table>
<?php
        }
        else
        if (isset($_GET["d"]) && $_GET["d"] == 1)
        {
            $result = mysql_query("SELECT * FROM users WHERE id='".$id."'", $db);
            $num    = mysql_num_rows($result);
            if ($num != 0)
            {            
                $result = mysql_query("DELETE FROM users WHERE id='".$_GET["id"]."'", $db);
                if ($result == "true")
                {
                    echo "<p>".$lang["delete_user_yes_delete"]."</p>";
                    echo $userslink." | ".$profilelink;
                }
                else
                {
                    echo "<p>".$lang["delete_user_not_delete"]."</p>";
                    echo $userslink." | ".$profilelink;
                }
            }
        }
        else
        if (isset($_GET["d"]) && $_GET["d"] == 0)
        {
            echo "<p>".$lang["delete_user_not_delete"]."</p>";
            echo $userslink." | ".$profilelink;
        }
?>

</form>

</div><!--End block content-->

<div id="clear"></div>
<div id="footer"><!--block footer-->
<center>
<?php
	include"blocks/footer.php";
?>
</center>
</div><!--End block footer-->

</div><!--End block page-->



</body>
</html>