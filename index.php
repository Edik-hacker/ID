<?php
	include_once "blocks/db.php";
    include "blocks/language.php";
    include "authentication.php";
    
    if (isset($_SESSION["id"]) && isset($_SESSION["hash"]))
    {
        $result_user = mysql_query("SELECT id, hash, role FROM users WHERE id='".$_SESSION["id"]."'", $db);
        $user        = mysql_fetch_array($result_user);
    
        if ($_SESSION["hash"] == $user["hash"])
        {
            $user_login = true;
        }
        else
        {
            $user_login = false;
        }
    }
?>

<?php include "header.html"; ?>

<head>
<?php include "head.html"; ?>
	<title><?php echo $lang["article"]; ?></title>
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
<p id="title"><?php echo $lang["article"]; ?></p>
<?php
    if (isset($admin) && $admin == true)
    {
        echo "<p><a href=\"add_article.php\">".$lang["article_add"]."</a></p>";
    }

	$result = mysql_query("SELECT * FROM article ORDER BY id DESC", $db);
    $num    = mysql_num_rows($result);
    if ($num != 0)
    {
        $myrow  = mysql_fetch_array($result);
        do
        {
            echo "<table border=\"0\" id=\"news\" width=\"680\">\n";
            echo "<tr>\n";
            echo "<td id=\"news_title\"><a href=\"view_article.php?id=".$myrow["id"]."\">".$myrow["title_".$language]."</a><br />\n";
            echo $lang["article_date_creating"].": ".$myrow["date"]."<br />\n";
            echo $lang["article_author"].": ".$myrow["author"]."<br />\n</td>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            
            if (strlen($myrow["text_".$language]) >=150)
            {
                echo "<td>".substr($myrow["text_".$language],0,150)." ...</td>\n";
            }
            else
            {
                echo "<td>".substr($myrow["text_".$language],0,150)."</td>\n";
            }
            
            
            echo "</tr>\n";
            echo "<tr>\n";
            if (isset($admin) && $admin == true)
            {
                echo "<td><a href=\"view_article.php?id=".$myrow["id"]."\">".$lang["article_read"]."</a>&nbsp|&nbsp<a href=\"edit_article.php?id=".$myrow["id"]."\">".$lang["article_edit"]."</a>&nbsp|&nbsp<a href=\"delete_article.php?id=".$myrow["id"]."\">".$lang["delete_article_article"]."</a></td>\n";
            }
            else
            {
                echo "<td><a href=\"view_article.php?id=".$myrow["id"]."\">".$lang["article_read"]."</a></td>\n";
            }
        
            echo "</tr>\n</table>\n<br />\n";

        }
        while ($myrow  = mysql_fetch_array($result));
    }
    else
    {
        echo "<p>".$lang["article_not"]."</p>";
    }
?>

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