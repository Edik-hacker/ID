<?php
	include_once "blocks/db.php";
    include "blocks/language.php";  
    include "authentication.php";         
?>
<?php include "header.html"; ?>

<head>
<?php include "head.html"; ?>
	<title><?php
    if (isset($_GET["id"]))
    {
        $id = $_GET["id"];
       	$result = mysql_query("SELECT * FROM users WHERE id='".$id."'", $db);
        $num    = mysql_num_rows($result);
        if ($num != 0)
        {
            $myrow  = mysql_fetch_array($result);
            echo $lang["users_user"].": ";
            echo $myrow["FirstName"]." ".$myrow["LastName"];
        }
        else
        {
            echo $lang["user_not_id"];
        }
    }
    else
    {
        echo $lang["users_not_user"];
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
    $userslink = "<a href=\"view_users.php\">".$lang["view_users"]."</a>";
    if (isset($_GET["id"]))
    {
        $id = $_GET["id"];
       	$result = mysql_query("SELECT * FROM users WHERE id='".$id."'", $db);
        $num    = mysql_num_rows($result);
        if ($num != 0)
        {
            $myrow  = mysql_fetch_array($result);
            echo "<table border=\"0\" id=\"user\" width=\"680\">\n";
            echo "<tr>\n";
            
            if (isset($admin) && $admin == true)
            {
                echo "<td id=\"news_title\" colspan=\"2\">".$myrow["FirstName"]." ".$myrow["LastName"]." (".$myrow["login"].")&nbsp;|&nbsp;<a href=\"role_user.php?id=".$myrow["id"]."\">".$lang["users_role"]."</a>&nbsp;|&nbsp;<a href=\"delete_user.php?id=".$myrow["id"]."\">".$lang["users_delete"]."</a></td>\n";
            }
            else
            {
                echo "<td id=\"news_title\" colspan=\"2\">".$myrow["FirstName"]." ".$myrow["LastName"]." (".$myrow["login"].")</td>\n";
            }
            
            echo "</tr>\n";
            echo "<tr>\n";
            if ($myrow["ava"] == "")
            {
                echo "<td rowspan=\"2\" width=\"160px\"><img src=\"images_users/avatar.png\" width=\"160px\" /></td>";
            }
            else
            {
                echo "<td rowspan=\"2\" width=\"160px\"><img src=\"avatar.php?id=".$myrow["id"]."\" alt=\"".$myrow["FirstName"]." ".$myrow["LastName"]."\" width=\"160px\" /></td>";
            }

            echo "<td id=\"news_title\"><center>".$lang["users_info"]."</center></td>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            echo "<td valign=\"top\">".$lang["users_birthday"].": ".$myrow["day"]."-".$myrow["month"]."-".$myrow["year"]."<br />\n";
            
            //перевірка статі
            if ($myrow["sex"] == "man")
            {
                echo $lang["users_sex"].": ".$lang["users_man"]."<br />\n";
            }
            else
            if ($myrow["sex"] == "woman")
            {
                echo $lang["users_sex"].": ".$lang["users_woman"]."<br />\n";
            }
            else
            {
                echo $lang["users_sex"].": ".$lang["users_no_sex"]."<br />\n";
            }
            
            //перевірка емейлу
            if ($myrow["email"] != "")
            {
                echo $lang["registration_email"].": ".$myrow["email"]."</td>";
            }
            else
            {
                echo $lang["registration_email"].": ".$lang["users_not_email"]."</td>";
            }
            
            echo "</tr>\n";
            
            
            //message
            if (isset($id_user) && $id_user == true)
            {
                if ($id_user != $_GET["id"])
                {
                    echo "<tr>";
                    echo "<td colspan=\"2\" width=\"10\"><a href=\"send_message.php?id=".$myrow["id"]."\">Надіслати повідомлення</a></td>";
                    echo "</tr>";
                }
            }
            
            
            echo "</table><br />\n";
        }
        else
        {
            echo "<p>".$lang["user_not_id"]."</p>\n";
            echo "<p>".$userslink."</p>";
        }
    }
    else
    {
        echo "<p>".$lang["users_not_user"]."</p>\n";
        echo "<p>".$userslink."</p>";
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