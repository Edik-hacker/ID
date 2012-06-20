<?php
	include_once "blocks/db.php";
    include "blocks/language.php";
    include "authentication.php";
?>
<?php include "header.html"; ?>

<head>
<?php include "head.html"; ?>
	<title><?php echo $lang["edit_profile"]; ?></title>
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
    if (isset($_POST["submit"]))
    {
        $backlink = "<a href=\"edit_profile.php\">".$lang["back"]."</a>";
        
        //Обробка даних і занесення в базу
        
        //Перетворення глобального массива на перемінні
        if (isset($_POST["login"]))             { $login                    = $_POST["login"]; }
        if (isset($_POST["FirstName"]))         { $FirstName                = $_POST["FirstName"]; }
        if (isset($_POST["LastName"]))          { $LastName                 = $_POST["LastName"]; }
        if (isset($_POST["email"]))             { $email                    = $_POST["email"]; }
        if (isset($_POST["day"]))               { $day                      = $_POST["day"]; }
        if (isset($_POST["month"]))             { $month                    = $_POST["month"]; }
        if (isset($_POST["year"]))              { $year                     = $_POST["year"]; }
        if (isset($_POST["sex"]))               { $sex                      = $_POST["sex"]; }
        if (isset($_POST["new_password"]))      { $new_password             = $_POST["new_password"]; }
        if (isset($_POST["new_password_retry"])){ $new_password_retry       = $_POST["new_password_retry"]; }
        if (isset($_POST["password"]))          { $password                 = $_POST["password"]; }
        //Якщо перемінна пуста то видалити її
        if ($login == "")               { unset($login); }
        if ($FirstName == "")           { unset($FirstName); }
        if ($email == "")               { unset($email); }
        if ($day == "")                 { unset($day); }
        if ($month == "")               { unset($month); }
        if ($year == "")                { unset($year); }
        if ($sex == "")                 { unset($sex); }
        if ($new_password == "")        { unset($new_password); }
        if ($new_password_retry == "")  { unset($new_password_retry); }
        if ($password == "")            { unset($password); }
       
       

            //перевірка існування логіну та емейлу
            $result = mysql_query("SELECT * FROM users WHERE id='".$id."'", $db);
            $num    = mysql_num_rows($result);
            $myrow  = mysql_fetch_array($result);
            
            $login_one = $myrow["login"];

            $result_login = mysql_query("SELECT login FROM users WHERE login='".$login."'", $db);
            $num          = mysql_num_rows($result_login);
            
            if ($login_one != $login)
            {
                if ($num == 0)
                {
                    $result = mysql_query("UPDATE users SET login='".$login."' WHERE id='".$id."'", $db);
                    if ($result == "true")
                    {
                        echo "<p>".$lang["edit_profile_edit_login"]."</p>\n";
                    }
                    else
                    {
                        echo "<p>".$lang["edit_profile_not_edit_login"]."</p>\n";
                    }
                }
                else
                {
                    echo "<p>".$lang["edit_profile_edit_login_isset_user"]."</p>\n";
                }
            }
            
            //зміна e-mail'лу
            $result_email = mysql_query("SELECT email FROM users WHERE email='".$email."'", $db);
            $num_email    = mysql_num_rows($result_email);
            
            if ($num_email == 0)
            {
                $result_email = mysql_query("UPDATE users SET email='".$email."' WHERE id='".$id."'", $db);
                if ($result_email == "true")
                    {
                        echo "<p>".$lang["edit_profile_edit_email"]."</p>\n";
                    }
                    else
                    {
                        echo "<p>".$lang["edit_profile_not_edit_email"]."</p>\n";
                    }
                
            }
            else
            {
                echo "<p>".$lang["edit_profile_edit_email_isset_user"]."</p>\n";
            }
            
            
            
            
            
            //----------------------------------------------------------
            
                //Заносиво дані в базу
                $result = mysql_query("UPDATE users
                                   SET FirstName='".$FirstName."', LastName='".$LastName."', day='".$day."', month='".$month."', year='".$year."', sex='".$sex."' WHERE id='".$id."';", $db);
                if ($result == "true")
                {
                    echo "<p>".$lang["edit_profile_edit_save"]."</p>";
                }
                else
                {
                    echo "<p>".$lang["edit_profile_not_update"]."</p>";
                }
            
            //Завантажуємо аватарку
            if (isset($_FILES["avatar"]) && $_FILES["avatar"]["type"] == "image/png" || $_FILES["avatar"]["type"] == "image/jpeg" || $_FILES["avatar"]["type"] == "image/gif")
            {
                if (is_uploaded_file($_FILES["avatar"]["tmp_name"]))
                {
                    if (!is_dir("images_users/".$myrow["id"]))
                    {
                        $dir = "images_users/".$myrow["id"];
                        mkdir($dir);
                    }
                    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], "images_users/".$myrow["id"]."/".$_FILES["avatar"]["name"]))
                    {
                        $result = mysql_query("UPDATE users SET ava='".$_FILES["avatar"]["name"]."' WHERE id='".$id."'", $db);
                        if ($result == "true")
                        {
                            echo "<p>".$lang["edit_profile_ava_add"]."</p>";
                        }
                    }
                    else
                    {
                        echo "<p>".$lang["edit_profile_ava_not_add"]."</p>";
                    }
                }
            }
            
        //Якщо існує перемінна то заносимо дані в базу
        if (/*(isset($login)                  && 
            (isset($FirstName))             && 
            (isset($LastName))              && 
            (isset($day))                   && 
            (isset($month)))                &&
            (isset($year))                  &&
            (isset($sex))                   &&*/
            (isset($new_password))          &&
            (isset($new_password_retry))    &&
            (isset($password)))
        {
                if (isset($password) && md5(md5($password)) == $myrow["password"])
                {
                
                    //Перевірка правильності паролю
                    if (isset($new_password) && isset($new_password_retry) && $new_password == $new_password_retry)
                    {
                        $password   = md5(md5($new_password));
                        
                        //Заносиво дані в базу
                        $result = mysql_query("UPDATE users
                                               SET password='".$password."' WHERE id='".$id."';", $db);
                        if ($result == "true")
                        {
                            echo "<p>".$lang["edit_profile_password_update"]."</p>";
                        }
                        else
                        {
                            echo "<p>".$lang["edit_profile_password_not_update"]."</p>";
                        }
                    }
    
                    else
                    {
                        echo "<p>".$lang["edit_profile_new_password_not"]."</p>";
                    }
                }
                else
                {
                    echo "<p>".$lang["edit_profile_password_not"]."</p>";
                }
        }
            /*else
            if (!isset($new_password) || !isset($new_password_retry) || !isset($password))
            {
                echo "<p>".$lang["edit_profile_fields_not_all"]."</p>";
            }*/
            echo $backlink;
        }
        else
        {
            $result = mysql_query("SELECT * FROM users WHERE id='".$id."'", $db);
            $myrow  = mysql_fetch_array($result);
?>

<p id="title"><?php echo $lang["edit_profile"]; ?></p>

<form enctype="multipart/form-data" action="" method="POST">

<p><label><?php
    echo $lang["edit_profile_login"];
?>: *</label><br />
<input type="text" name="login" size="50" value="<?php
	echo $myrow["login"];
?>" /></p>

<p><label><?php
    echo $lang["edit_profile_FirstName"];
?>: *</label><br />
<input type="text" name="FirstName" size="50" value="<?php
	echo $myrow["FirstName"];
?>" /></p>

<p><label><?php
    echo $lang["edit_profile_LastName"];
?>:</label><br />
<input type="text" name="LastName" size="50" value="<?php
	echo $myrow["LastName"];
?>" /><br /></p>

<p><label><?php
    echo $lang["edit_profile_email"];
?>:</label><br />
<input type="text" name="email" size="50" value="<?php
	echo $myrow["email"];
?>" /><br /></p>

<p><label><?php
    echo $lang["edit_profile_date"];
?>: *</label><br />

<select name="day">
<option value="" ><?php
    echo $lang["edit_profile_day"];
?></option>
<?php
	   for ($i = 1; $i<=31; $i++)
        {
            if ($myrow["day"] == $i)
            {
                echo "<option value=\"".$myrow["day"]."\" selected>".$i."</option>";
            }
            else
            {
                echo "<option value=\"".$i."\">".$i."</option>";
            }
        }
?>
</select>

<select name="month">
<option value="" selected><?php
	echo $lang["edit_profile_month"];
?></option>
<?php
    
	for ($i = 0; $i<count($month); $i++)
    {
        $value = $i;
        $value++;
            if ($myrow["month"] == $value)
            {
                echo "<option value=\"".$value."\" selected>".$month[$i]."</option>";
            }
            else
            {
                echo "<option value=\"".$value."\">".$month[$i]."</option>";
            }
    }
?>
</select>

<select name="year">
<option value="" selected><?php
	echo $lang["edit_profile_year"];
?></option>
<?php
    for ($i = 1900; $i<=date("Y"); $i++)
    {
            if ($myrow["year"] == $i)
            {
                echo "<option value=\"".$i."\" selected>".$i."</option>";
            }
            else
            {
                echo "<option value=\"".$i."\">".$i."</option>";
            }
    }
?>
</select>
<br /></p>


<p><label><?php
	echo $lang["edit_profile_sex"];
?>: *</label><br />
<input type="radio" name="sex" value="man" <?php
        if (isset($myrow["sex"]) && $myrow["sex"] == "man")
        {
            echo "checked";
        }
?>/><?php
	echo $lang["edit_profile_man"];
?><input type="radio" name="sex" value="woman" <?php
        if (isset($myrow["sex"]) && $myrow["sex"] == "woman")
        {
            echo "checked";
        }
?>/><?php
	echo $lang["edit_profile_woman"];
?></p>


<p><label><?php
    if ($myrow["ava"] != "")
    {
	   echo $lang["edit_profile_ava"];
    }
    else
    {
        echo $lang["edit_profile_ava_not"];
    }
?>:</label><br /><?php
    if ($myrow["ava"] != "")
    {
	   echo "<img src=\"avatar_viewuser.php?id=".$myrow["id"]."\" width=\"160px\" /><br />\n";
       echo "<a href=\"delete_avatar.php\">".$lang["edit_profile_delete_avatar"]."</a><br /><br />";
       echo $lang["edit_profile_ava_new"]."<br />\n";
    }
?>
<input type="file" name="avatar" size="40" /></p>

<p><label><?php
	echo $lang["edit_profile_new_password"];
?>: *</label><br />
<input type="password" name="new_password" size="50" /></p>

<p><label><?php
	echo $lang["edit_profile_new_password_retry"];
?>: *</label><br />
<input type="password" name="new_password_retry" size="50" /></p>

<p><label><?php
	echo $lang["edit_profile_password"];
?>: *</label><br />
<input type="password" name="password" size="50" /></p>

<input type="submit" name="submit" value="<?php
		echo $lang["edit_profile_edit"];
?>" />
<?php
        }
?>
</form>

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