<?php
	include_once"blocks/db.php";
    include"blocks/language.php";
    
    if (isset($_POST["submit"]))
    {
        //створюємо сесію у випадку возврату назад
        $_SESSION["reg_login"]      = $_POST["login"];
        $_SESSION["reg_FirstName"]  = $_POST["FirstName"];
        $_SESSION["reg_LastName"]   = $_POST["LastName"];
        $_SESSION["reg_email"]      = $_POST["email"];
        $_SESSION["reg_day"]        = $_POST["day"];
        $_SESSION["reg_month"]      = $_POST["month"];
        $_SESSION["reg_year"]       = $_POST["year"];
        $_SESSION["reg_sex"]        = $_POST["sex"];
    }
    
    if (isset($_GET["back"]))
    {
        $back = TRUE;
            if (isset($_SESSION["reg_login"]))      { $reg_login          = "value=\"".$_SESSION["reg_login"]."\""; }
            if (isset($_SESSION["reg_FirstName"]))  { $reg_FirstName      = "value=\"".$_SESSION["reg_FirstName"]."\""; }
            if (isset($_SESSION["reg_LastName"]))   { $reg_LastName       = "value=\"".$_SESSION["reg_LastName"]."\""; }
            if (isset($_SESSION["reg_email"]))      { $reg_email          = "value=\"".$_SESSION["reg_email"]."\""; }
            if (isset($_SESSION["reg_day"]))        { $reg_day            = $_SESSION["reg_day"]; }
            if (isset($_SESSION["reg_month"]))      { $reg_month          = $_SESSION["reg_month"]; }
            if (isset($_SESSION["reg_year"]))       { $reg_year           = $_SESSION["reg_year"]; }
            if (isset($_SESSION["reg_sex"]))        { $reg_sex            = $_SESSION["reg_sex"]; }
        
    }
    else
    {
        $back = FALSE;
    }
    
    
    
    
    
    
    
    if (isset($_POST["submit"]))
    {
        $backlink = "<a href=\"registration.php?back=1\">".$lang["back"]."</a>";
        
        //Обробка даних і занесення в базу
        
        //Перетворення глобального массива на перемінні
        if (isset($_POST["login"]))          { $login              = $_POST["login"]; }
        if (isset($_POST["FirstName"]))      { $FirstName          = $_POST["FirstName"]; }
        if (isset($_POST["LastName"]))       { $LastName           = $_POST["LastName"]; }
        if (isset($_POST["email"]))          { $email              = $_POST["email"]; }
        if (isset($_POST["day"]))            { $day                = $_POST["day"]; }
        if (isset($_POST["month"]))          { $month              = $_POST["month"]; }
        if (isset($_POST["year"]))           { $year               = $_POST["year"]; }
        if (isset($_POST["sex"]))            { $sex                = $_POST["sex"]; }
        if (isset($_POST["password"]))       { $password           = $_POST["password"]; }
        if (isset($_POST["password_retry"])) { $password_retry     = $_POST["password_retry"]; }
        //Якщо перемінна пуста то видалити її
        if ($login == "")          { unset($login); }
        if ($FirstName == "")      { unset($FirstName); }
        //if ($LastName == "")       { unset($LastName); }
        if ($email == "")          { unset($email); }
        if ($day == "")            { unset($day); }
        if ($month == "")          { unset($month); }
        if ($year == "")           { unset($year); }
        if ($sex == "")            { unset($sex); }
        if ($password == "")       { unset($password); }
        if ($password_retry == "") { unset($password_retry); }
       
        //Якщо існує перемінна то заносимо дані в базу
        if ((isset($login)      && 
            (isset($FirstName)) && 
            (isset($LastName))  && 
            (isset($email))  && 
            (isset($day))       && 
            (isset($month)))    &&
            (isset($year))      &&
            (isset($sex))       &&
            (isset($password))  &&
            (isset($password_retry)))
        {
            //перевірка існування логіну
            $result = mysql_query("SELECT * FROM users WHERE login='".$login."'", $db);
            $num    = mysql_num_rows($result);
            if ($num == 0) //якщо логін не існує то створюємо ...
            {
                $result_email = mysql_query("SELECT * FROM users WHERE email='".$email."'", $db);
                $num_email    = mysql_num_rows($result_email);
                if ($num_email == 0)
                {
                    //Перевірка правильності паролю
                    if ($password == $password_retry)
                    {
                        //Перед добавленням видаляємо пробіли на початку і в кінці
                        $login      = trim($login);
                        $FirstName  = trim($FirstName);
                        $LastName   = trim($LastName);
                        $email      = trim($email);
                        $day        = trim($day);
                        $month      = trim($month);
                        $year       = trim($year);
                        $sex        = trim($sex);
                        $password   = md5(md5($password));
                        
                        //Заносиво дані в базу
                        $result = mysql_query("INSERT INTO users (login, FirstName, LastName, email, day, month, year, sex, password)
                                               VALUES ('".$login."', '".$FirstName."', email='".$email."', '".$LastName."', '".$day."', '".$month."', '".$year."', '".$sex."', '".$password."');", $db) or die($myrow["title_".$language]);
                        if ($result == "true")
                        {
                            echo "<p>".$lang["registration_error_message_2"]."</p>";
                        }
                        else
                        {
                            echo "<p>".$lang["registration_error_message_1"]."</p>";
                            echo $backlink;
                        }
                    }
                    else
                    {
                        echo "<p>".$lang["registration_error_message_3"]."</p>";
                        echo $backlink;
                    }
                }
                else
                {
                    echo "<p>".$lang["registration_email_not"]."</p>";
                        echo $backlink;
                }
        
            }
            else
            {
                echo "<p>".$lang["registration_login_not"]."</p>";
                echo $backlink;
            }
        }
        else
        {
            echo "<p>".$lang["registration_error_message_4"]."</p>";
            echo $backlink;
        }
    }
    else
    {
?>
<?php include "header.html"; ?>

<head>
<?php include "head.html"; ?>
	<title><?php echo $lang["registration"]; ?></title>
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

?>

<p id="title"><?php echo $lang["registration"]; ?></p>

<form action="registration.php" method="POST">

<p><label><?php
    echo $lang["registration_login"];
?>: *</label><br />
<input type="text" name="login" size="50" <?php
	if ($back == TRUE) { if (isset($reg_login)) { echo $reg_login; } }
?> /></p>

<p><label><?php
    echo $lang["registration_FirstName"];
?>: *</label><br />
<input type="text" name="FirstName" size="50" <?php
	if ($back == TRUE) { if (isset($reg_FirstName)) { echo $reg_FirstName; } }
?> /></p>

<p><label><?php
    echo $lang["registration_LastName"];
?>:</label><br />
<input type="text" name="LastName" size="50" <?php
	if ($back == TRUE) { if (isset($reg_LastName)) { echo $reg_LastName; } }
?> /><br /></p>

<p><label><?php
    echo $lang["registration_email"];
?>:</label><br />
<input type="text" name="email" size="50" <?php
	if ($back == TRUE) { if (isset($reg_email)) { echo $reg_email; } }
?> /><br /></p>

<p><label><?php
    echo $lang["registration_date"];
?>: *</label><br />

<select name="day">
<option value="" ><?php
    echo $lang["registration_day"];
?></option>
<?php
	for ($i = 1; $i<=31; $i++)
    {
        if ($back == TRUE)
        {
            if (isset($reg_day))
            {
                if ($reg_day == $i)
                {
                    echo "<option value=\"".$reg_day."\" selected>".$i."</option>";
                }
                else
                {
                    echo "<option value=\"".$i."\">".$i."</option>";
                }
            }
            else
            {
                echo "<option value=\"".$i."\">".$i."</option>";
            }
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
	echo $lang["registration_month"];
?></option>
<?php
    
	for ($i = 0; $i<count($month); $i++)
    {
        $value = $i;
        $value++;
        if ($back == TRUE)
        {
            if (isset($reg_month))
            {
                if ($reg_month == $value)
                {
                    echo "<option value=\"".$value."\" selected>".$month[$i]."</option>";
                }
                else
                {
                    echo "<option value=\"".$value."\">".$month[$i]."</option>";
                }
            }
            else
            {
                echo "<option value=\"".$value."\">".$month[$i]."</option>";
            }
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
	echo $lang["registration_year"];
?></option>
<?php
    for ($i = date("Y"); $i>=1900; $i--)
    {
        if ($back == TRUE)
        {
            if (isset($reg_year))
            {
                if ($reg_year == $i)
                {
                    echo "<option value=\"".$i."\" selected>".$i."</option>";
                }
                else
                {
                    echo "<option value=\"".$i."\">".$i."</option>";
                }
            }
            else
            {
                echo "<option value=\"".$i."\">".$i."</option>";
            }
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
	echo $lang["registration_sex"];
?>: *</label><br />
<input type="radio" name="sex" value="man" <?php
	if ($back == TRUE)
    {
        if (isset($reg_sex) && $reg_sex == "man")
        {
            echo "checked";
        }
        else
        {
            echo "checked";
        }
    }
    else
    {
        echo "checked";
    }
?>/><?php
	echo $lang["registration_man"];
?><input type="radio" name="sex" value="woman" <?php
	if ($back == TRUE)
    {
        if (isset($reg_sex) && $reg_sex == "woman")
        {
            echo "checked";
        }
    }
?>/><?php
	echo $lang["registration_woman"];
?></p>

<p><label><?php
	echo $lang["registration_password"];
?>: *</label><br />
<input type="password" name="password" size="50" /></p>

<p><label><?php
	echo $lang["registration_pepeat_password"];
?>: *</label><br />
<input type="password" name="password_retry" size="50" /></p>

<input type="submit" name="submit" value="<?php
		echo $lang["registration_sign_up"];
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