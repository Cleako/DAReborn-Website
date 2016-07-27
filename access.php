<?php
include("head.php");
$user_id = filter_input(INPUT_GET, "uid", FILTER_SANITIZE_STRING);
if($logged_in)
{
 if($user_level <= 1)
 {
  $num = 1;
  echo '<br>';
  echo '<table border="1" bordercolor="#ff0000" cellpadding="1" cellspacing="3" align="center">';
  echo '<tr><th>#</th><th>username</th><th>last login</th><th>logins</th></tr>';
  $result = mysql_query("SELECT * FROM users ORDER BY last_login_timestamp DESC");
  while($row = mysql_fetch_array($result))
  {
   echo '<tr>';
   echo '<td>'.$num.'</td>';
   echo '<td>'.$row["username"].'</td>';
   echo '<td align="center">'.$row["last_login_date"].'</td>';
   echo '<td align="center">'.$row["login_count"].'</td>';
   echo '</tr>';
   $num++;
  }
  echo '</table>';
 }
 else
  echo 'You\'re now allowed to see this page';
}
else
 echo 'Not logged in.';
?>
</body>
</html>