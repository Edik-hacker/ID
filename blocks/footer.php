<?php
if (isset($_SESSION["language"]))
{
    //����
    echo  $lang["footer_language"].": ";
    //���������
    echo "<a href=\"update_language.php?id=1\">".$lang["footer_language_ua"]."</a> | ";
    //��������
    echo "<a href=\"update_language.php?id=2\">".$lang["footer_language_ru"]."</a> | ";
    //���������
    echo "<a href=\"update_language.php?id=3\">".$lang["footer_language_en"]."</a>";
}
else
{
    $_SESSION["language"] = 1;
    header("Location: index.php"); exit();
}
?>