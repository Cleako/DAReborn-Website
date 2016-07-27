<?php
include("head.php");
if($logged_in)
{
 if ($user_level <= 1)
 {
  echo '<center><B>Admin Controls</b><br>';
  echo '<a href=access.php>Access Log</a><br>';
  $result = mysql_query("SELECT * FROM users WHERE accepted='0'");
  echo '<a href="accept.php">Applications</a> <small>('.mysql_num_rows($result).')</small><br>';
  echo '<a href="panel.php">User Panel</a><br>';
  echo '<a href="forum_control.php">Forum Control</a><br>';
  echo '<a href="voting_control.php">Voting Control</a><br>';
  echo '<a href="page_edit.php">Page Control</a><br>';
  echo '<a href="message_control.php">Message Control</a><br>';

}
else{
echo 'Go away.';
}
}
else{
 echo 'Not logged in.';
}
include("foot.php");
?>