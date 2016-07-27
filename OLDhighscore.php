<?php
/* Include Files *********************/
session_start();
include("head.php");
$type = filter_input(INPUT_GET, "type", FILTER_SANITIZE_STRING);
if($logged_in)
{
/*************************************/

if ($user_level <= 90)
{
 if(isset($type))
 {
  if($type=="attack"||$type=="defence"||$type=="strength"||$type=="hitpoints"||$type=="ranged"||$type=="prayer"||$type=="magic"||$type=="cooking"||$type=="woodcutting"||$type=="fletching"||$type=="fishing"||$type=="firemaking"||$type=="crafting"||$type=="smithing"||$type=="mining"||$type=="herblore"||$type=="agility"||$type=="thieving"||$type=="runecrafting"||$type=="combat"||$type=="overall")
  {
   $num = "1";
   $result = mysql_query("SELECT * FROM users ORDER BY $type DESC");
   echo '<table border="1" bordercolor="#ff0000">';
   echo '<tr><th>#</th><th>username</th><th>'.$type.'</th></tr>';
   while($row = mysql_fetch_array($result))
   {
    echo '<tr>';
    echo '<td align="center">'.$num.'</td><td align="center"><a href="user.php?uid='.$row["id"].'">'.$row["username"].'</a></td><td align="center">'.$row[$type].'</td>';
    echo '</tr>';
    $num++;
   }
   echo '</table>';
   echo '<a href="highscore.php">Back</a>';
  }
 }
 else
 {
?>


<center>
The highscores:<BR>
<BR>
<a href="?type=attack">Attack</a><BR>
<a href="?type=defence">Defence</a><BR>
<a href="?type=strength">Strength</a><BR>
<a href="?type=hitpoints">Hitpoints</a><BR>
<a href="?type=ranged">Ranged</a><BR>
<a href="?type=prayer">Prayer</a><BR>
<a href="?type=magic">Magic</a><BR>
<a href="?type=cooking">Cooking</a><BR>
<a href="?type=woodcutting">Woodcutting</a><BR>
<a href="?type=fletching">Fletching</a><BR>
<a href="?type=fishing">Fishing</a><BR>
<a href="?type=firemaking">Firemaking</a><BR>
<a href="?type=crafting">Crafting</a><BR>
<a href="?type=smithing">Smithing</a><BR>
<a href="?type=mining">Mining</a><BR>
<a href="?type=herblore">Herblore</a><BR>
<a href="?type=agility">Agility</a><BR>
<a href="?type=thieving">Thieving</a><BR>
<a href="?type=runecrafting">Runecrafting</a><BR>
<a href="?type=combat">Combat</a><BR>
<a href="?type=overall">Skill Overall</a><BR>


<?php
 }
}
else
 echo 'You\'re not allowed to see this page';
}
else
 echo 'Not logged in.';

include("foot.php");
?>


