<?php
	include_once "blocks/db.php";
    include "blocks/language.php";
    include "authentication_admin.php";
    
    $articlelink = "<p><a href=\"index.php\">".$lang["article"]."</a></p>";
?>
<?php include "header.html"; ?>

<head>
<?php include "head.html"; ?>
	<title><?php echo $lang["edit_article"]; ?></title>
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
<p id="title"><?php echo $lang["edit_article"]; ?></p>
<?php
    if (isset($_POST["submit"]))
    {
        if (isset($_POST["title_ua"])        &&
            isset($_POST["title_ru"])        &&
            isset($_POST["title_en"])        &&
            isset($_POST["date"])            &&
            isset($_POST["author"])          &&
            isset($_POST["text_ua"])         &&
            isset($_POST["text_ru"])         &&
            isset($_POST["text_en"])        &&
            isset($_POST["id"]))
        {
            //Видалення тегів
            $title_ua   = strip_tags($_POST["title_ua"]);
            $title_ru   = strip_tags($_POST["title_ru"]);
            $title_en   = strip_tags($_POST["title_en"]);
            $date       = strip_tags($_POST["date"]);
            $author     = strip_tags($_POST["author"]);
            $text_ua    = strip_tags($_POST["text_ua"]);
            $text_ru    = strip_tags($_POST["text_ru"]);
            $text_en    = strip_tags($_POST["text_en"]);
            $id         = strip_tags($_POST["id"]);
            
            $result = mysql_query("UPDATE article
                                   SET title_ua='".$title_ua."', title_ru='".$title_ru."', title_en='".$title_en."',
                                   date='".$date."', author='".$author."',
                                   text_ua='".$text_ua."', text_ru='".$text_ru."', text_en='".$text_en."'
                                   WHERE id='".$id."'", $db);
            if ($result == "true")
            {
                echo "<p>".$lang["update_article_message_update"]."</p>\n";
                echo $articlelink;
            }
            else
            {
                echo "<p>".$lang["update_article_message_not_update"]."</p>\n";
                echo $articlelink;
            }
        }
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