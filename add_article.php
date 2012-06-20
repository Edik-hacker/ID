<?php
	include_once "blocks/db.php";
    include "blocks/language.php";
    include "authentication_admin.php";
?>
<?php include "header.html"; ?>

<head>
<?php include "head.html"; ?>
	<title><?php echo $lang["add_article"]; ?></title>
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
<p id="title"><?php echo $lang["add_article"]; ?></p>

<form action="create_article.php" method="POST">
<label><?php echo $lang["edit_article_title_ua"]; ?>:</label><br />
<input type="text" name="title_ua" size="80" /><br /><br />

<label><?php echo $lang["edit_article_title_ru"]; ?>:</label><br />
<input type="text" name="title_ru" size="80" /><br /><br />

<label><?php echo $lang["edit_article_title_en"]; ?>:</label><br />
<input type="text" name="title_en" size="80" /><br /><br />
<hr />
<label><?php echo $lang["edit_article_date"]; ?>:</label><br />
<input type="text" name="date" size="80" /><br /><br />

<label><?php echo $lang["edit_article_author"]; ?>:</label><br />
<input type="text" name="author" size="80" /><br /><br />
<hr />

<label><?php echo $lang["edit_article_text_ua"]; ?>:</label><br />
<textarea name="text_ua" cols="80" rows="15"></textarea><br /><br />

<label><?php echo $lang["edit_article_text_ru"]; ?>:</label><br />
<textarea name="text_ru" cols="80" rows="15"></textarea><br /><br />

<label><?php echo $lang["edit_article_text_en"]; ?>:</label><br />
<textarea name="text_en" cols="80" rows="15"></textarea><br /><br />

<input type="hidden" name="id" />
<input type="submit" name="submit" value="<?php echo $lang["add_article_create"]; ?>" />
</form>


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