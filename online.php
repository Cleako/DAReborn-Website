<?php 
//include("database.php");
//put you database info in here
$username = $result["username"];
$DB_name = "dargamin_dareborn"; // this is an example value
$tblname = "online"; // this is an example value

//set vars
global $REMOTE_ADDR;
$timeoutseconds = 300;
$timestamp = time();
$timeout = $timestamp-$timeoutseconds;

//set $page
$page = $_SERVER['SCRIPT_NAME'];
$page = explode("/",$page);
$page = $page[2];
//if($QUERY_STRING)
 //$page .= '?'.$QUERY_STRING;

//select db
mysql_select_db($DB_name,$conn); 

//insert values
$result = mysql_query("SELECT * FROM $tblname WHERE user='$username' AND sitename='$site'",$conn);
$user_page = $result["sitename"];
if(mysql_num_rows($result)!="0")
{
 $query = "UPDATE $tblname SET user='$username', timestamp='$timestamp', ip='$REMOTE_ADDR', sitename='$site', page='$page' WHERE user='$username'";
 $result = mysql_query($query,$conn);
}
else
{
 $query = "INSERT INTO $tblname (user, timestamp, ip, sitename, page) VALUES ('$username','$timestamp','$REMOTE_ADDR','$site','$page')";
 $result = mysql_query($query,$conn);
 //check for errors
 if(!($result))
  echo 'Useronline Insert Failed';
}

//select distinct username from current site
$a_result = mysql_query("SELECT DISTINCT user FROM $tblname WHERE sitename='$site'",$conn);
$b_result = mysql_query("SELECT * FROM $tblname WHERE sitename='$site' LIMIT 1",$conn);

//check for errors
if(!($a_result)||!($b_result))
 echo 'Useronline Select Failed ';

//start loop
echo '<table border=0>';
echo '<tr><td align="center" colspan="3"><small>Users Online:</small></td></tr>';
while($a_row = mysql_fetch_array($a_result))
{
 $b_result = mysql_query("SELECT * FROM $tblname WHERE user='".$a_row['user']."' AND sitename='$site' ORDER BY timestamp DESC LIMIT 1",$conn);
 $c_result = mysql_query("SELECT * FROM users WHERE username='".$a_row['user']."'");
 $c_row = mysql_fetch_array($c_result);
 echo '<tr><td align="right" title="'.$a_row['user'].'"><small><a href="user.php?uid='.$c_row["id"].'" class="red">';
 if(strlen($a_row['user'])>8)
 {
  $user = substr($a_row['user'],0,8);
  echo $user.'...';
 }
 else
  echo $a_row['user'];
 echo '</a></small></td><td><small>-</small></td><td align="left"';
 while($b_row = mysql_fetch_array($b_result))
 {
  $result = mysql_query("SELECT * FROM users WHERE username='$username'");
  while($row = mysql_fetch_assoc($result))
   $user_level = $row["user_level"];
  if(($user_page=="panel"||$user_page=="voting_control"||$user_page=="forum_control"||$user_page=="accept"||$user_page=="access")&&$user_level>1)
   echo '><small><i>admin area</i>';
  else
  {
   $user_page = explode("?",$b_row['page']);
   if($user_level<=1)
    echo ' title="'.$b_row['page'].'"';
   echo '><small><a href="'.$user_page[0].'" class="red">';
   $user_page = explode(".",$b_row['page']);
   $user_page = $user_page[0];
   if(strlen($user_page)>8)
   {
    $user_page = substr($user_page,0,8);
    echo $user_page.'...</a>';
   }
   else
    echo $user_page;
  }
  echo '</small></td></tr>';
 }
}
echo '</table>';

//delete values when they leave
$delete = mysql_query("DELETE FROM $tblname WHERE timestamp<$timeout OR page='logout.php'", $conn);
?>