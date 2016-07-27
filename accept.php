<?php
$stage = filter_input(INPUT_GET, "stage", FILTER_SANITIZE_STRING);
$user_id = filter_input(INPUT_GET, "uid", FILTER_SANITIZE_STRING);
$msg = filter_input(INPUT_GET, "msg", FILTER_SANITIZE_STRING);
//if($stage=="action"&&$action=="accept")
// header("Location: $_SERVER[SCRIPT_NAME]?msg=1");
//elseif($stage=="action"&&$action=="decline")
// header("Location: $_SERVER[SCRIPT_NAME]?msg=2");
session_start();
include("head.php");
if($logged_in)
{
 if($stage=="action")
 {
  if($action=="accept")
   $query = "UPDATE users SET username='$user', user_level='$level', dl='$dl', accepted='1' WHERE id='$user_id'";
  elseif($action=="decline")
   $query = "DELETE FROM users WHERE id='$user_id'";
  mysql_query($query,$conn);
  $result = mysql_query("SELECT * FROM users WHERE id='$user_id'");
  $row = mysql_fetch_array($result);
  $to = $row["email"];
  $subject = "DAR Application: $action"."ed";
  $message = "Welcome aboard!  Your application has been accepted!
  
  URL: www.DARGamingCo.com\nusername:".$row["username"]."\npassword: ".$row["password"];
  mail($to,$subject,$message,"From: cleako@gmail.com") or print "Could Not Send Mail";
  echo 'Operation preformed sucessfully. <a href="javascript:history.go(-1)">back</a>';
  exit;
 }
 if($msg=="1")
  echo '<font color="white">User Accepted</font>';
 elseif($msg=="2")
  echo '<font color="white">User Declined</font>';
 $result = mysql_query("SELECT * FROM users WHERE username='$username'");
 while($row = mysql_fetch_assoc($result))
  $user_level = $row["user_level"];
 if ($user_level <= 1)
 {
  $num = 1;
  echo '<table border="1" cellpadding="0" cellspacing=0 bordercolor=000000 align="center">';
  $result = mysql_query("SELECT * FROM users WHERE accepted='0' ORDER BY id");
  if(!(mysql_num_rows($result)=="0"))
  {
   echo '<tr><th align="center">#</th><th align="center">username</th><th align="center">user_level</th><th align="center">Email</th><th align="center">lvl name</th><th align="center">action</th></tr>';
   while ($row = mysql_fetch_array($result))
   {
    echo '<tr>';
    echo '<form method="POST" action="'.$_SERVER['SCRIPT_NAME'].'?stage=action&uid='.$row["id"].'">';
    echo '<td>'.$num.'</td>';
    echo '<td><input type="text" name="user" value="'.$row["username"].'" size="16" maxlength="30"></td>';
    echo '<td><input type="text" name="level" value="'.$row["user_level"].'" size="16"></td>';
   echo '<td>'.$row["email"].'</td>';
echo '<td><input type="text" name="dl" value="'.$row["dl"].'" size="16"></td>';

    echo '<td><select name="action"><option value="accept">Accept</option><option value="decline">Decline</option></select>';
    echo '<td><input type="submit" value="Submit"></td>';
    echo '</form>';
    echo '</tr>';
    $num++;
   }
  }
  else
   echo '<tr><td>No users in accept list</td></tr>';
  echo '</table>';
  if(!(mysql_num_rows($result)=="0"))
   echo '<center>*Note: 1 = Admin, 10 = Clan Member</center>';
 }
 elseif(!($user_level <= 1))
  echo 'You\'re now allowed to see this page';
}
else
 echo 'Not logged in.';
include("foot.php");
?>