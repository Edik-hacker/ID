<?php
	include_once "blocks/db.php";
    include "blocks/language.php";
    include "authentication.php";
?>
<?php include "header.html"; ?>

<head>
<?php include "head.html"; ?>
	<title><?php echo $lang["messages"]; ?></title>
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
<p id="title"><?php echo $lang["messages"]; ?></p>
<?php
	$result = mysql_query("SELECT * FROM messages WHERE id_recipient='".$id_user."'", $db);
    $num    = mysql_num_rows($result);
    if ($num != 0)
    {
        $myrow = mysql_fetch_array($result);
        do
        {
            
        
            $id_sender = $myrow["id_sender"];
            $sender       = mysql_query("SELECT * FROM users WHERE id='".$id_sender."'", $db);
            $sender_row   = mysql_fetch_array($sender);
?>
<table border="1" width="500" id="news">
<tr>
<td id="news_title" width="50px"><a href="users.php?id=<?php
            echo $sender_row["id"]
?>"><img src="<?php
            if ($sender_row["ava"] == "")
            {
                echo "images_users/avatar.png";
            }
            else
            {
                echo "message_avatar.php?id=".$sender_row["id"];
            }
?>" /></a></td>
<td id="news_title"><p><a href="users.php?id=<?php
            echo $sender_row["id"];
?>"><?php
            echo $sender_row["FirstName"]." ".$sender_row["LastName"]." (".$sender_row["login"].")";
?></a></p></td>
<td width="80"><center><a href="delete_message.php?id=<?php
	echo $myrow["id"];
?>"><?php echo $lang["messages_delete"]; ?></a></center></td>
</tr>
<tr>
<td colspan="3"><p><?php
            echo $myrow["message"];
?></p></td>
</tr>
</table><br />
<?php
        }
        while ($myrow = mysql_fetch_array($result));
    }
    else
    {
        echo "Повідомлень не знайдено";
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