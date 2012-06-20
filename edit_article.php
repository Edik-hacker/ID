<?php
	include_once "blocks/db.php";
    include "blocks/language.php";
    include "authentication_admin.php";
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
    if (isset($_GET["id"]))
    {
        $id = $_GET["id"];
            
        $result = mysql_query("SELECT * FROM article WHERE id='".$id."'", $db);
        $num    = mysql_num_rows($result);
        //якщо статтю існує то...
        if ($num != 0)
        {
            $myrow = mysql_fetch_array($result);
                
                //форма редагування статті
?>
<form action="update_article.php" method="POST">
<label><?php echo $lang["edit_article_title_ua"]; ?>:</label><br />
<input type="text" name="title_ua" size="80" value="<?php echo $myrow["title_ua"]; ?>" /><br /><br />

<label><?php echo $lang["edit_article_title_ru"]; ?>:</label><br />
<input type="text" name="title_ru" size="80" value="<?php echo $myrow["title_ru"]; ?>" /><br /><br />

<label><?php echo $lang["edit_article_title_en"]; ?>:</label><br />
<input type="text" name="title_en" size="80" value="<?php echo $myrow["title_en"]; ?>" /><br /><br />
<hr />
<label><?php echo $lang["edit_article_date"]; ?>:</label><br />
<input type="text" name="date" size="80" value="<?php echo $myrow["date"]; ?>" /><br /><br />

<label><?php echo $lang["edit_article_author"]; ?>:</label><br />
<input type="text" name="author" size="80" value="<?php echo $myrow["author"]; ?>" /><br /><br />
<hr />

<label><?php echo $lang["edit_article_text_ua"]; ?>:</label><br />
<textarea name="text_ua" cols="80" rows="15"><?php echo $myrow["text_ua"]; ?></textarea><br /><br />

<label><?php echo $lang["edit_article_text_ru"]; ?>:</label><br />
<textarea name="text_ru" cols="80" rows="15"><?php echo $myrow["text_ru"]; ?></textarea><br /><br />

<label><?php echo $lang["edit_article_text_en"]; ?>:</label><br />
<textarea name="text_en" cols="80" rows="15"><?php echo $myrow["text_en"]; ?></textarea><br /><br />

<input type="hidden" name="id" value="<?php echo $myrow["id"]; ?>" />
<input type="submit" name="submit" value="<?php echo $lang["edit_article_edit"]; ?>" />
</form>
<?php
                
        }
        else
        {
            echo "<p>".$lang["edit_article_not_article"]."</p>";
            echo "<a href=\"index.php\">".$lang["article"]."</a>";
        }
            
    }
    else
    {
        echo "<p>".$lang["edit_article_not_id"]."</p>";
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