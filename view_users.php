<?php
	include_once"blocks/db.php";
    include"blocks/language.php";
?>
<?php include "header.html"; ?>

<head>
<?php include "head.html"; ?>
	<title><?php echo $lang["view_users"]; ?></title>
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
<p id="title"><?php echo $lang["view_users"]; ?></p>
<table border="0" id="news" width="680">
<?php
	$result = mysql_query("SELECT id, login, FirstName, LastName, ava FROM users", $db);
    $num    = mysql_num_rows($result);
    if ($num != 0)
    {
        $myrow  = mysql_fetch_array($result);
        do
        {
            echo "<tr>\n";
            echo "<td id=\"news_title\" valign=\"top\"  width=\"100\">";
            if ($myrow["ava"] != "")
            {
                echo "<center><a href=\"users.php?id=".$myrow["id"]."\"><img src=\"avatar_viewuser.php?id=".$myrow["id"]."\" alt=\"".$myrow["FirstName"]." ".$myrow["LastName"]."\" title=\"".$myrow["FirstName"]." ".$myrow["LastName"]."\" width=\"100\" /></a></center></td>\n";
            }
            else
            {
                echo "<a href=\"users.php?id=".$myrow["id"]."\"><img src=\"images_users/avatar.png\" alt=\"".$myrow["FirstName"]." ".$myrow["LastName"]."\" title=\"".$myrow["FirstName"]." ".$myrow["LastName"]."\" width=\"100\" /></a></td>\n";
            }
            echo "<td id=\"news_title\" valign=\"top\"><p><a href=\"users.php?id=".$myrow["id"]."\">".$myrow["FirstName"]." ".$myrow["LastName"]."</a><br />\n";
            echo $myrow["login"]."</p></td>\n";
            echo "</tr>\n";
        }
        while ($myrow  = mysql_fetch_array($result));
    }
    else
    {
        echo "<p>".$lang["view_users_not_users"]."</p>";
    }
?>
</table><br />
</p>
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