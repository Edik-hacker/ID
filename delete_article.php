<?php
	include_once "blocks/db.php";
    include "blocks/language.php";
    include "authentication_admin.php"; 
    $articleslink = "<a href=\"index.php\">".$lang["article"]."</a>";
?>
<?php include "header.html"; ?>

<head>
<?php include "head.html"; ?>
	<title><?php echo $lang["delete_article"]; ?></title>
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
<td colspan="2"><center><p id="title"><?php echo $lang["delete_article_delete"] ?></p></center></td>
</tr>
<tr>
<td width="175"><center><a href="delete_article.php?d=1&id=<?php echo $_GET["id"]; ?>"><?php echo $lang["delete_article_delete_yes"]; ?></a></center></td>
<td width="175"><center><a href="delete_article.php?d=0"><?php echo $lang["delete_article_delete_no"]; ?></a></center></td>
</tr>
</table>
<?php
	}
    else
    if (isset($_GET["d"]) && $_GET["d"] == 1)
    {
        if (isset($_GET["id"]))
        {
            $result = mysql_query("DELETE FROM article WHERE id='".$_GET["id"]."'", $db);
            if ($result == "true")
            {
                echo "<p>".$lang["delete_article_yes_delete"]."</p>\n";
                echo $articleslink;
            }
            else
            {
                echo "<p>".$lang["delete_article_not_delete"]."</p>\n";
                echo $articleslink;
            }
        }
    }
    else
    if (isset($_GET["d"]) && $_GET["d"] == 0)
    {
        echo "<p>".$lang["delete_article_not_delete"]."</p>\n";
        echo $articleslink;
    }
?>

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