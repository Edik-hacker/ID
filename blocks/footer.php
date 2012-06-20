<?php
if (isset($_SESSION["language"]))
{
    //Мова
    echo  $lang["footer_language"].": ";
    //Українська
    echo "<a href=\"update_language.php?id=1\">".$lang["footer_language_ua"]."</a> | ";
    //Російська
    echo "<a href=\"update_language.php?id=2\">".$lang["footer_language_ru"]."</a> | ";
    //Англійська
    echo "<a href=\"update_language.php?id=3\">".$lang["footer_language_en"]."</a>";
}
else
{
    $_SESSION["language"] = 1;
    header("Location: index.php"); exit();
}
?>