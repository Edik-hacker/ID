<?php
	include_once"blocks/db.php";
    include"blocks/language.php";
    
    //якщо дан≥ входу передан≥ то...
    if ( (isset($_POST["login"])) && (isset($_POST["password"])) )
    {
        //ѕереводимо глобальний массив данних в перем≥нн≥
        $login    = mysql_real_escape_string($_POST["login"]);
        //$login    = $_POST["login"];
        $password = md5(md5($_POST["password"]));
        
        $result = mysql_query("SELECT id, password FROM users WHERE login='".$login."';", $db);
        $myrow  = mysql_fetch_array($result);
        
        //якщо пароль в≥рний то..
        if ($password == $myrow["password"])
        {
            mt_srand(time() + (double)microtime()*1000000);
            $hash = mt_rand(1000, 9999);
            $hash = md5($hash);
            
            $result = mysql_query("UPDATE users SET hash='".$hash."' WHERE login='".$login."'", $db);
            $_SESSION["hash"] = $hash;
            $_SESSION["id"] = $myrow["id"];
            header("Location: index.php"); exit();
        }
        else
        {
            $message = "<p>".$lang["login_error"]."</p>";
        }
        
    }
    else
    {
        $message = "<p>".$lang["login_all_field"]."</p>";
    }
?>
<?php include "header.html"; ?>

<head>
<?php include "head.html"; ?>
	<title><?php echo $lang["login"]; ?></title>
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
<p id="title"><?php echo $lang["login"]; ?></p>
<p>
<?php
    echo $message;
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