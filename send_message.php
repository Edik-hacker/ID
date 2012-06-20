<?php
	include_once "blocks/db.php";
    include "blocks/language.php";
    include "authentication.php";
?>
<?php include "header.html"; ?>

<head>
<?php include "head.html"; ?>
	<title><?php echo $lang["send_message"]; ?></title>
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
<p id="title"><?php echo $lang["send_message"]; ?></p>
<?php
	if (isset($_POST["submit"]))
    {
        $result = mysql_query("INSERT INTO messages SET id_sender='".$id_user."', id_recipient='".$_POST["id_recipient"]."', status_read='0', message='".$_POST["message"]."'", $db);
        if ($result == "true")
        {
            echo "<p>".$lang["send_message_sending"]."</p>";
        }
        else
        {
            echo "<p>".$lang["send_message_not_sending"]."</p>";
        }
    }
    else
    {
?>
<table border="0" width="500">
<form action="" method="POST">

<tr>
<td><label><?php echo $lang["send_message_recipient"]; ?>:</label></td>
<td><input type="text" name="recipient" style="width: 350px;" value="<?php
	$result = mysql_query("SELECT login, FirstName, LastName FROM users WHERE id='".$_GET["id"]."'", $db);
    $myrow  = mysql_fetch_array($result);
    echo $myrow["FirstName"]." ".$myrow["LastName"]." (".$myrow["login"].")";
?>" /></td>
</tr>

<tr>
<td valign="top"><label><?php echo $lang["send_message_message"]; ?>:</label></td>
<td><textarea style="width: 350px;" rows="10" name="message"></textarea></td>
</tr>

<tr>
<td></td>
<td><input type="submit" name="submit" value="<?php echo $lang["send_message_send"]; ?>" />&nbsp;<input type="reset" name="reset" value="<?php echo $lang["send_message_reset"]; ?>" /></td>
</tr>
<input type="hidden" name="id_recipient" value="<?php echo $_GET["id"] ?>" />
</form>
</table>
<?php
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