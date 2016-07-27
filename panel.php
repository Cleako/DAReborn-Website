<?php
session_start();
$stage = filter_input(INPUT_GET, "stage", FILTER_SANITIZE_STRING);
$user_id = filter_input(INPUT_GET, "user_id", FILTER_SANITIZE_STRING);
$msg = filter_input(INPUT_GET, "msg", FILTER_SANITIZE_STRING);
if(isset($user_id))
{
 if($stage=="update")
  header("Location: $_SERVER[SCRIPT_NAME]?msg=1");
 elseif($stage=="delete")
  header("Location: $_SERVER[SCRIPT_NAME]?msg=2");
}
include("head.php");
if($logged_in)
{
 if($stage=="update")
 {
  $query = "UPDATE users SET user_level='$userlevel', rank='$rank' WHERE id='$user_id'";
  mysql_query($query,$conn);
 }
 elseif($stage=="confirm")
 {
  $result = mysql_query("SELECT * FROM users WHERE id='$user_id'");
  while($row = mysql_fetch_assoc($result))
   $v_username = $row["username"];
  echo '<font color="000000">Are you sure you want to delete user #'.$user_id.' ("'.$v_username.'")?</font><br>';
  echo '<a href="'.$_SERVER[SCRIPT_NAME].'?stage=delete&user_id='.$user_id.'">Yes, delete</a>&nbsp;&nbsp;<a href="'.$_SERVER[SCRIPT_NAME].'">No, cancel</a>';
  exit;
 }
 elseif($stage=="delete")
 {
  $query = "DELETE FROM users WHERE id='$user_id'";
  mysql_query($query,$conn);
 }
 if($msg=="1")
  echo '<font color="000000">Value Successfully Updated</font>';
 elseif($msg=="2")
  echo '<font color="000000">User Successfully Deleted</font>';
 $result = mysql_query("SELECT * FROM users WHERE username='$username'");
 while($row = mysql_fetch_assoc($result))
  $user_level = $row["user_level"];
 if ($user_level <= 1)
 {
  $num = 1;
  $result = mysql_query("SELECT * FROM users WHERE accepted='1'");
  echo '<br>';
  echo '<table border="1" cellpadding="0" cellspacing=0 bordercolor=000000 align="center">';
  echo '<tr><th align="center">#</th><th align="center">username</th><th align="center">Rank</th><th align="center">user_level</th><th align="center" colspan="2">options</th></tr>';
  while ($row = mysql_fetch_array($result))
  {
   echo '<form method="POST" action="'.$_SERVER[SCRIPT_NAME].'?stage=update&user_id='.$row["id"].'">';
   echo '<tr>';
   echo '<td>'.$num.'</td>';
   echo '<td>'.$row["username"].'</td>';
   echo '<td><input type="text" name="rank" value="'.$row["rank"].'"></td>';
    print "<td><select name=\"userlevel\"><option value=\"1\"";
    if($row["user_level"]=="1")
     print " SELECTED";
    print ">Admin</option><option value=\"5\"";
    if($row["user_level"]=="5")
     print " SELECTED";
    print ">Mod</option><option value=\"10\"";
    if($row["user_level"]=="10")
     print " SELECTED";
    print ">Member</option></select></td>";
   echo '<td><input type="submit" value="Change"></td>';
   echo '</form>';
   echo '<form method="POST" action="'.$_SERVER[SCRIPT_NAME].'?stage=confirm&user_id='.$row["id"].'">';
   echo '<td><input type="submit" value="Delete"></td>';
   echo '</form>';
   echo '</tr>';
   $num++;
  }
  echo '</table>';
 }
 else
  echo 'You\'re not allowed to see this page';
}
else
 echo 'Not logged in.';
include("foot.php");
?>