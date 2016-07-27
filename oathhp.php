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
This is the Offical Oath Of the Dragon Annihilators

<center><b>If banned and wish for permission to return, You must send a copy of this oath with the blanks filled in and sent to cleako@Homail.com</b>

<h4><i>I, __your_name_here__ Here by swear on everything swearable on, that I will remain faithfull to the Dark Tigers of Death Clan of runescape, Will not hack, kill another member in wilderness without both members agreeing to; I will not steal, scam or break the rules of Runescape stated by Jagex. I will also visit the clan site once every 2 months at least or will be deleted from the clan.  I will respect other members and even if not alloud to rejoin for certian reasons, will respect the desisions of the members and find somthing else to do, never bothering anyone from the clan again.</i></h4>

<Center><h1>Signed,</h1>

<center><h3>__Your_Name_Here__</h3>
<?php
}else{
echo 'You\'re not allowed to see this page';
}
 }else{
   echo 'Not logged in.';
}
include("foot.php");
?>


