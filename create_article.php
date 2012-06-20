<?php
	include_once"blocks/db.php";
    include"blocks/language.php";
    include "authentication_admin.php";
?>
<?php include "header.html"; ?>

<head>
<?php include "head.html"; ?>
	<title><?php echo $lang["create_article"]; ?></title>
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
            isset($_POST["text_en"]))
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
            
            $result = mysql_query("INSERT INTO article
                                   SET title_ua='".$title_ua."', title_ru='".$title_ru."', title_en='".$title_en."',
                                   date='".$date."', author='".$author."',
                                   text_ua='".$text_ua."', text_ru='".$text_ru."', text_en='".$text_en."';", $db);
            if ($result == "true")
            {
                echo "<p>".$lang["create_article_message_create"]."</p>";
            }
            else
            {
                echo "<p>".$lang["create_article_message_not_create"]."</p>";
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