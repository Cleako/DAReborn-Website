<?php 
session_start();
/* Include Files *********************/ 
include("intro.php");
include("database.php");
include("login.php");
include("style3.css");
/*************************************/
$username = filter_input(INPUT_GET, "username", FILTER_SANITIZE_STRING);
$result = mysql_query("SELECT * FROM users WHERE username='$username'");
$row = mysql_fetch_assoc($result);
$user_level = $row["user_level"];
$cur_uid = $row["id"];
GLOBAL $user_level;
GLOBAL $cur_uid;

echo '<BR>';
echo '<body bgcolor=000000>';
echo '<table width=892px border=1 align=center bordercolor=FF0000 cellpadding=0 cellspacing=0>';
echo '<tr align=center valign=top>';
echo '<td colspan=2><a href="private.php" target="_self"><img src="images/11_pirate.gif" border=0></a>';
?>
<div id="nav">
			<ul>
			<li><a href="./index.php">Home</a></li>
			<li><a href="forum_list.php">Forum</a></li>
			<li><a href="./wordpress">Blogs</a></li>
			<li><a href="memberlist.php">Members</a></li>
			<li><a href="./forum/index.php?autocom=arcade">Arcade</a></li>
			<li><a href="./entertainment.php">Pranks</a></li>
			<li><a href="./darradio.php">DAR Radio</a></li>
			<li><a href="./tda">TDA MMORPG</a></li>
			<li><a href="./">Blank</a></li>
		</ul></div>
<?php
echo '</td>';
echo '</tr>';
echo '<tr align=center valign=top>';
echo '<td width=15% height=87>';
if($logged_in)
{
?>
<br>
<img src="images/erezdragon.gif"/>
<br>
<?php
$site = "Annihilators";
include("online.php");
?>
<br>
<a href="private.php">Home</a><br>
<a href="forum_list.php">Forum</a><br>
<a href="memberlist.php">Member List</a><br>
<?php
$result = mysql_query("SELECT * FROM messaging WHERE `read`='0' AND `to`='$cur_uid'");
echo '<a href="messaging.php">Messaging</a> <small>('.mysql_num_rows($result).')</small><br>';
?>
<a href="voting.php">Voting</a><br>
<a href="account.php">Account Setup</a><br>
<a href="index.php">Public Area</a><br>
<a href="logout.php">Logout</a><br>
<br>
<B>Other Content</b><BR>
    <?php
$result = mysql_query("Select * from categories ORDER BY nummer");
$n = 0;

while($row = mysql_fetch_array($result, MYSQL_BOTH)){
$n++;
if($row["catid"] == 1){
echo '';
}
else{
?>

      <a href="page.php?catid=<?php echo $row['catid']?>"><?php echo $row['catname'];?></a><br>
    
    <?php

 }}?>
<?php
 if ($user_level <= 1)
 {
  echo '<br><B>Admin Controls</b><br>';
  echo '<a href=access.php>Access Log</a><br>';
  $result = mysql_query("SELECT * FROM users WHERE accepted='0'");
  echo '<a href="accept.php">Applications</a> <small>('.mysql_num_rows($result).')</small><br>';
  echo '<a href="panel.php">User Panel</a><br>';
  echo '<a href="forum_control.php">Forum Control</a><br>';
  echo '<a href="voting_control.php">Voting Control</a><br>';
  echo '<a href="page_edit.php">Page Control</a><br>';
  echo '<a href="message_control.php">Message Control</a><br>';
  echo '<a href="news.php">News Control</a><br>';
 }
}
else
{
echo '<center><a href="index.php">Home</a><br>';
}
?>

</td>
<td width=501>
<font color=ff0000>

