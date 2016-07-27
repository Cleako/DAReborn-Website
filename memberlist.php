<?php
session_start();
include("head.php");
if($logged_in)
{
 $result = mysql_query("SELECT * FROM users WHERE username='$username'");
 while($row = mysql_fetch_array($result))
  $user_level = $row["user_level"];
  $username = $row["username"];
 if ($user_level <= 90)
 {
  echo '<table width=870 border=1 align=center bordercolor=ff0000>';
  echo '<tr>';
  echo '<td width=400 align="center"><font color="#ff0000">#</td>';
  echo '<td width=400 align="center"><font color="#ff0000">Username</td>';
  echo '<td width=400 align="center"><font color="#ff0000">User_Level</td>';
  echo '<td width=400 align="center"><font color="#ff0000">Email</td>';
  echo '<td width=400 align="center"><font color="#ff0000">Yahoo</td>';
  echo '<td width=400 align="center"><font color="#ff0000">ICQ</td>';
  echo '<td width=400 align="center"><font color="#ff0000">AIM</td>';
  echo '<td width=400 align="center"><font color="#ff0000">MSN</td>';
  echo '<td width=400 align="center"><font color="#ff0000">Skype</td>';
  echo '</tr>';
$num = 1;
  $result = mysql_query("SELECT * FROM users WHERE accepted='1' ORDER BY user_level");
  mysql_query($result,$conn);
  while ($rij = mysql_fetch_array($result))
  {
  
   echo '<tr align=center valign=top>';
   echo '<td><font color="#ff0000" align="center">'.$num.'</td>';
   echo '<td><font color="#ff0000" align="center"><a href="user.php?uid='.$rij["id"].'">'.$rij["username"].'</a></td>';
   echo '<td><font color="#ff0000" align="center">'.$rij["user_level"].'</td>';
   echo '<td><font color="#ff0000" align="center">'.$rij["email"].'</td>';
   echo '<td><font color="#ff0000" align="center">'.$rij["yahoo"].'</td>';
   echo '<td><font color="#ff0000" align="center">'.$rij["icq"].'</td>';
   echo '<td><font color="#ff0000" align="center">'.$rij["aim"].'</td>';
   echo '<td><font color="#ff0000" align="center">'.$rij["msn"].'</td>';
   echo '<td><font color="#ff0000" align="center">'.$rij["skype"].'</td>';
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