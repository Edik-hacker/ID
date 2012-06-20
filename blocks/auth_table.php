<table>
<tr>
  <td valign="top">
  <p id="left-menu_title"><?php echo $lang["auth_table_input"]; ?></p>
  <div id="left-menu_link">

  <form action="login.php" method="POST">
  <p>
  <label><?php echo $lang["auth_table_login"]; ?>:</label><br />
  <input type="text" name="login" size="28" />
  </p>
  
  <p>
  <label><?php echo $lang["auth_table_password"]; ?>:</label><br />
  <input type="password" name="password" size="28" /><br />
  <input type="submit" name="submit" value="<?php echo $lang["auth_table_enter"]; ?>" style="width: 215px;" />
  </p>
  </form>
  <br />
  <a href="registration.php"><?php echo $lang["auth_table_registration"]; ?></a>
  
  </div>
  </td>
</tr>
</table>
<br />