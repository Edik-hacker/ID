<?php
	include_once "blocks/db.php";
    include "blocks/language.php";
    include "authentication.php"; 
    $editlink       = "<a href=\"edit_profile.php\">".$lang["delete_avatar_editlink"]."</a>";
    $profilelink    = "<a href=\"users.php?id=".$id_user."\">".$lang["delete_avatar_profilelink"]."</a>";
?>
<?php include "header.html"; ?>

<head>
<?php include "head.html"; ?>
	<title><?php echo $lang["devete_avatar"]; ?></title>
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
<td colspan="2"><center><p id="title"><?php echo $lang["devete_avatar_delete_avatar"] ?></p></center></td>
</tr>
<tr>
<td width="175"><center><a href="delete_avatar.php?d=1"><?php echo $lang["devete_avatar_delete_yes"]; ?></a></center></td>
<td width="175"><center><a href="delete_avatar.php?d=0"><?php echo $lang["devete_avatar_delete_no"]; ?></a></center></td>
</tr>
</table>
<?php
        }
        else
        if (isset($_GET["d"]) && $_GET["d"] == 1)
        {
            $result = mysql_query("SELECT ava FROM users WHERE id='".$id."'", $db);
            $num    = mysql_num_rows($result);
            if ($num != 0)
            {
                $myrow = mysql_fetch_array($result);
                $image = "images_users/".$id."/".$myrow["ava"];
                if (is_file($image))
                {
                    unlink($image);
                } 
            
                $result = mysql_query("UPDATE users SET ava='' WHERE id='".$id_user."'", $db);
                if ($result == "true")
                {
                    echo "<p>".$lang["delete_avatar_yes_delete"]."</p>";
                    echo $editlink." | ".$profilelink;
                }
                else
                {
                    echo "<p>".$lang["delete_avatar_not_delete"]."</p>";
                    echo $editlink." | ".$profilelink;
                }
            }
        }
        else
        if (isset($_GET["d"]) && $_GET["d"] == 0)
        {
            echo "<p>".$lang["delete_avatar_not_delete"]."</p>";
            echo $editlink." | ".$profilelink;
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