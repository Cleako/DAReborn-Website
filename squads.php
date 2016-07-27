<?php
/* Include Files *********************/
session_start();
include("head.php");



/*************************************/

if($logged_in)  {

$result = mysql_query("SELECT * FROM users WHERE username='$username'");

while($row = mysql_fetch_assoc($result))
   $user_level = $row["user_level"];
if ($user_level <= 100)
{
?>
<p><font face="Arial"><br>
Now, the only squad you can join is the Dark Alliance as there are no more squads. It will
be like a side clan with extra events and more organisation. Join it!</font></p>

<p><font face="Arial"><a href="http://www.avidgamers.com/tareborn" target=_blank>www.avidgamers.com/tareborn</a>
</font></p>

<h3><font face="Arial"><i><br>
<br>
</i>The old page restored:<i><br>
<br>
</i></font></h3>
<i>

<h2></i><font face="Arial">Dark Alliance Squad</font><i></h2>

<p><font face="Arial"><img src="http://www.angelfire.com/rpg2/towelon/dalogo.jpg"></font></p>

<p></i><em><font face="Arial">Leader: EREZ GOLD</p>

<p><em><font face="Arial">Well, since I came up with the idea of squads,I had a vision of
the ultimate pking method, and here it is! in the form of the DA we will be the most
orginized and lethal squad in the DA clan. The name symbolyses the harmony between the
squads which are participating in the dark art of combat! JOIN TODAY! </font></em></p>

<p><em><font face="Arial">Squad site is at: <a
href="http://www.avidgamers.com/tareborn/index.php?main" target=_blank>http://www.avidgamers.com/tareborn/index.php?main</a></font></em><i></p>

<?php
}else{
echo 'You\'re not allowed to see this page';
}
 }else{
   echo 'Not logged in.';
}
include("foot.php");
?>


