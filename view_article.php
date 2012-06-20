<?php
	include_once "blocks/db.php";
    include "blocks/language.php";
    include "authentication.php";
    
    if (isset($_GET["id"]))
    {
        $id = $_GET["id"];
        
        $result = mysql_query("SELECT id FROM article WHERE id='".$id."'", $db);
        $num    = mysql_num_rows($result);
    }
    
    if (isset($_SESSION["id"]) && isset($_SESSION["hash"]))
    {
        $result_log = mysql_query("SELECT id, hash FROM users WHERE id='".$_SESSION["id"]."'", $db);
        $log        = mysql_fetch_array($result_log);
    
        if ($_SESSION["hash"] == $log["hash"])
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
	<title><?php
    if (isset($_GET["id"]))
    {
        $id = $_GET["id"];
        if ($num != 0)
        {
            $result = mysql_query("SELECT * FROM article WHERE id='".$id."'", $db);
            $myrow  = mysql_fetch_array($result);
            echo $myrow["title_".$language];
        }
        else
        {
            echo "<p>".$lang["view_article_not_id"]."</p>";
        }
    }
 ?></title>
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
    if (isset($_GET["id"]))
    {
        $id = $_GET["id"];
        if ($num != 0)
        {
            $result = mysql_query("SELECT * FROM article WHERE id='".$id."'", $db);
            $myrow  = mysql_fetch_array($result);
            
            if (isset($admin) && $admin == true)
            {
                echo "<p id=\"title\">".$myrow["title_".$language]."&nbsp|&nbsp<a href=\"edit_article.php?id=".$id."\">".$lang["article_edit"]."</a>&nbsp|&nbsp<a href=\"delete_article.php?id=".$id."\">".$lang["delete_article_article"]."</a></p>";
            }
            else
            {
                echo "<p id=\"title\">".$myrow["title_".$language]."</p>";
            }
            
            do
            {
echo "<table border=\"0\" id=\"news\" width=\"680\">\n";
echo "<tr>\n";
echo "<td id=\"news_title\">";
echo $lang["article_date_creating"].": ".$myrow["date"]."<br />\n";
echo $lang["article_author"].": ".$myrow["author"]."<br />\n</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td>".$myrow["text_".$language]."</td>\n";
echo "</tr>\n";
echo "</table>\n<br>\n";



echo "<table border=\"1\" id=\"news\" width=\"680\">\n";
echo "<tr><td>".$lang["view_article_comment"]."</td></tr></table>";


echo "<p><a href=\"index.php\">".$lang["article"]."</a></p>";
            }
            while ($myrow  = mysql_fetch_array($result));
        }
        else
        {
            echo "<p>".$lang["view_article_not_fiels"]."</p>";
            echo "<a href=\"index.php\">".$lang["article"]."</a>";
        }
    }
    else
    {
        echo "<p>".$lang["view_article_not_id"]."</p>";
        echo "<a href=\"index.php\">".$lang["article"]."</a>";
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