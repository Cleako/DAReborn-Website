<?php
session_start();
include("head.php");

$result = mysql_query("SELECT * FROM users WHERE username='$username'");

while($row = mysql_fetch_assoc($result))
   $user_level = $row["user_level"];
if ($user_level <= 90)
{

$uid = filter_input(INPUT_GET, "uid", FILTER_SANITIZE_STRING);
if(!(isset($uid)))
{
 echo '<font color="white"><b>Error</b>: Expected UID in URL.</font>';
 exit;
}
if($logged_in)
{
 echo '<center><a href=highscore.php>Back</a><BR></center>';
 echo '<table border="1" cellpadding="3" bordercolor=ff0000 align="center">';
 $result = mysql_query("SELECT * FROM users WHERE id='$uid'");
 while ($row = mysql_fetch_array($result))
 {
   echo '<tr><th align="center" colspan="4"><h2><u>User Info For "<i>'.$row["username"].'</i>"</u>&nbsp;(level '.$row["user_level"].')</h2></th></tr>';
  echo '<tr><td colspan="4"><b><center>Contact Info:</a></center></td></tr>';
  echo '<tr><th>Email:</th><td>'.$row["email"].'</td><th>MSN:</th><td>'.$row["msn"].'</td></tr>';
  echo '<tr><th>AIM:</th><td>'.$row["aim"].'</td><th>ICQ:</th><td>'.$row["icq"].'</td></tr>';
  echo '<tr><th>Yahoo</th><td>'.$row["yahoo"].'</td></tr>';
  echo '<tr><td colspan="4"><b><center>Personal Details:</b></center></td></tr>';
  echo '<tr><th>Name:</th><td>'.$row["name"].'</td><th>Birthdate:</th><td>'.$row["birth"].'</td></tr>';
  echo '<tr><th>Country:</th><td>'.$row["country"].'</td></tr>';
  echo '<tr><td colspan="4"><b><center>Fighting Stats:</b></center></td></tr>';
  echo '<tr><th>Attack:</th><td>'.$row["attack"].'</td><th>Defence:</th><td>'.$row["defence"].'</td></tr>';
  echo '<tr><th>Strength:</th><td>'.$row["strength"].'</td><th>Hitpoints:</th><td>'.$row["hitpoints"].'</td></tr>';
  echo '<tr><td colspan="4"><b><center>Other Runescape Stats:</b></center></td></tr>';
  echo '<tr><th>Ranged:</th><td>'.$row["ranged"].'</td><th>Prayer:</th><td>'.$row["prayer"].'</td></tr>';
  echo '<tr><th>Magic:</th><td>'.$row["magic"].'</td><th>Cooking:</th><td>'.$row["cooking"].'</td></tr>';
  echo '<tr><th><small>Woodcutting:</small></th><td>'.$row["woodcutting"].'</td><th>Fletching:</th><td>'.$row["fletching"].'</td></tr>';
  echo '<tr><th>Fishing:</th><td>'.$row["fishing"].'</td><th>Firemaking:</th><td>'.$row["firemaking"].'</td></tr>';
  echo '<tr><th>Crafting:</th><td>'.$row["crafting"].'</td><th>Smithing:</th><td>'.$row["smithing"].'</td></tr>';
  echo '<tr><th>Mining:</th><td>'.$row["mining"].'</td><th>Herblore:</th><td>'.$row["herblore"].'</td></tr>';
  echo '<tr><th>Agility:</th><td>'.$row["agility"].'</td><th>Thieving:</th><td>'.$row["thieving"].'</td></tr>';
  echo '<tr><th><small>Runecrafting</small>:</th><td>'.$row["runecrafting"].'</td><th>Combat:</th><td>'.$row["combat"].'</td></tr>';
  echo '<tr><th>Overall:</th><td>'.$row["overall"].'</td><th>Playing:</th><td>'.$row["rs"].'</td></tr>';
  echo '<tr><th>Squad:</th><td>'.$row["squad"].'</td><th>Is A:</th><td>'.$row["dl"].'</td></tr>';
echo '<tr><td colspan="4"><center><B>If Diplomat:</b></td></center></tr>';
echo '<tr><th>Clan Name</th><td>'.$row["clanname"].'</td><th>Clan_Website</th><td>'.$row["url"].'</td></tr>';
echo '<tr><th>Total_Members</th><td>'.$row["totmembers"].'</td><th></th><td></td></tr>';

  echo '</tr>';
 }
 echo '</table>';
}else{
echo 'You\'re not allowed to see this page';
}
}
else {
 echo 'Not logged in.';
}
?>