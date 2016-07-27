<?php
include("head3.php");

$post_id = filter_input(INPUT_GET, "pid", FILTER_SANITIZE_STRING);
$user_id = filter_input(INPUT_GET, "uid", FILTER_SANITIZE_STRING);
$topic_id = filter_input(INPUT_GET, "tid", FILTER_SANITIZE_STRING);
$type = filter_input(INPUT_GET, "type", FILTER_SANITIZE_STRING);
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
$page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRING);
if(!isset($page))
   $page = "1";
$topicperpage = "20";
$show1 = "0";
for($i=1;$i!=$page;$i++)
   $show1+=$topicperpage;
$show2 = $page*$topicperpage;
$show3 = "$show1,$show2";
$pattern = array();
$replace = array();
$pattern[] = '/\[url=(.+)\](.+)\[\/url\]/i';
$replace[] = '<a href="traffic.php?url=\\1" class="visit">\\2</a>';
$pattern[] = '/\[img=(.+)\]/i';
$replace[] = '<img src="\\1">';
$pattern[] = '/\[b](.+)\[\/b\]/i';
$replace[] = '<b>\\1</b>';
$pattern[] = '/\[i](.+)\[\/i\]/i';
$replace[] = '<i>\\1</i>';
$pattern[] = '/\[u](.+)\[\/u\]/i';
$replace[] = '<u>\\1</u>';
$pattern[] = '/\[s](.+)\[\/s\]/i';
$replace[] = '<s>\\1</s>';
$pattern[] = '/\[left](.+)[\/left]/i';
$replace[] = '<p align="left">\\1</p>';
$pattern[] = '/\[center](.+)[\/center]/i';
$replace[] = '<p align="center">\\1</p>';
$pattern[] = '/\[right](.+)[\/right]/i';
$replace[] = '<p align="right">\\1</p>';
$pattern[] = '/(.+)?:-\)(.?+)/i';
$replace[] = '\\1<img src="images/grin.png" width="15" height="15">\\2';
$pattern[] = '/(.+)?:-[(](.?+)/i';
$replace[] = '\\1<img src="images/frown.png" width="15" height="15">\\2';
$pattern[] = '/(.+)?:-o(.?+)/i';
$replace[] = '\\1<img src="images/surprised.png" width="15" height="15">\\2';
$pattern[] = '/(.+)8-\)(.?+)/i';
$replace[] = '\\1<img src="images/cool.png" width="15" height="15">\\2';

if($type=="read"||$type=="reply"||$type=="edit"||$type=="delete")
{
 if(!isset($post_id))
 {
  echo '<br><b>Error</b>: Cannot find post ID.';
  exit;
 }
}
if(!isset($area))
{
 echo '<br><b>Error</b>: Cannot find area ID.';
 exit;
}
if($type=="post")
{
 if(isset($subject)&&isset($message))
 {
  $table = "users";
  $result = mysql_query("SELECT * FROM $table ORDER BY id ASC");
  add_to_database_post($username,$subject,$message,$area,$conn);
  $replied = mysql_insert_id();
  $tag = "false";
  update_post_count($username,$conn);
  update_board_list($area,$tag,$conn);
  success($area,$replied,$area,$conn);
 }
}
elseif($type=="read")
{
 $a_table = "forum";
 $a_result = mysql_query("SELECT * FROM $a_table WHERE replied='$post_id' ORDER BY id ASC");
 $b_table = "users";
 $num = 1;
}
elseif($type=="reply")
{
 $result = mysql_query("SELECT * FROM forum WHERE id='$post_id'");
 $row = mysql_fetch_array($result);
 if($row["locked"]=="0"&&isset($subject)&&isset($message))
 {
  $table = "users";
  $result = mysql_query("SELECT * FROM $table ORDER BY id ASC");
  $tag = "false";
  add_to_database_reply($username,$subject,$message,$post_id,$area,$conn);
  update_board_list($area,$tag,$conn);
  $table = "forum";
  $result = mysql_query("SELECT * FROM $table WHERE id='$post_id'");
  $row = mysql_fetch_array($result);
  $replies = $row["replies"]+1;
  $stamp = time();
  $lastpost = date("M d h:iA");
  $query = "UPDATE $table SET lastpost='$lastpost', timestamp='$stamp', replies='$replies' WHERE id='$post_id'";
  mysql_query($query,$conn);
  update_post_count($username,$conn);
  echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=forum.php?area=$board&pid=$replied&type=read">';
  echo '<meta http-equiv="refresh" content="0; url=javascript:history.go(-1)">';
exit;
?>
<?php
exit;
 }

}
elseif($type=="edit")
{
 $result = mysql_query("SELECT * FROM forum WHERE id='$post_id'");
 $row = mysql_fetch_array($result);
 if($row["locked"]=="0"&&isset($subject)&&isset($message))
 {
  $table = "forum";
  $result = mysql_query("SELECT * FROM $table WHERE id='$post_id'");
  $row = mysql_fetch_array($result);
  if($row["username"]=="$username"||$user_level<=50)
  {
   $usertrue = "1";
   if($user_level<=50)
    $ranktrue = "1";
   if(isset($ranktrue)&&isset($hide_tag))
    $tag = "on";
   add_to_database_edit($subject,$message,$post_id,$tag,$conn);
   update_board_list($area,$tag,$conn);
   echo 'Message successfully edited. <a href="javascript:history.go(-2)">back</a>';
  }
  else
   echo 'You can not edit this post';
  exit;
 }
}
elseif($type=="extras_submit")
{
 if($user_level<=5)
 {
  if($e_action=="delete")
   delete_from_database($post_id,$area,$conn);
  elseif($e_action=="lock thread"||$e_action=="unlock thread")
  {
   $way = explode(" ",$e_action);
   lock_thread($way[0],$post_id,$conn);
  }
 }
 else
  echo 'You do not have sufficient rights to perform this operation';
}

function add_to_database_post($username,$subject,$message,$board,$conn)
{
 $table = "forum";
 $stamp = time();
 $posted = date("M d h:iA");
 $lastpost = $posted;
 $topic = "1";
 $subject = ereg_replace("<","&lt;",$subject);
 $subject = ereg_replace(">","&gt;",$subject);
 $message = ereg_replace("<","&lt;",$message);
 $message = ereg_replace(">","&gt;",$message);
 $query = "INSERT INTO $table (username,subject,message,topic,posted,timestamp,lastpost,board) values ('$username','$subject','$message','$topic','$posted','$stamp','$lastpost','$board')";
 mysql_query($query,$conn);
}
function add_to_database_reply($username,$subject,$message,$replied,$board,$conn)
{
 $table = "forum";
 $posted = date("M d h:iA");
 $stamp = time();
 $subject = ereg_replace("<","&lt;",$subject);
 $subject = ereg_replace(">","&gt;",$subject);
 $message = ereg_replace("<","&lt;",$message);
 $message = ereg_replace(">","&gt;",$message);
 $query = "INSERT INTO $table (username,subject,message,posted,timestamp,replied,board) values ('$username','$subject','$message','$posted','$stamp','$replied','$board')";
 mysql_query($query,$conn);
}
function add_to_database_edit($subject,$message,$post_id,$tag,$conn)
{
 $table = "forum";
 $result = mysql_query("SELECT * FROM $table WHERE id=$post_id");
 $row = mysql_fetch_array($result);
 if(isset($tag))
 {
  $stamp = $row["timestamp"];
  $edited = $row["edited"];
 }
 else
 {
  $stamp = time();
  $edited = date("M d h:iA");
 }
 $subject = ereg_replace("<","&lt;",$subject);
 $subject = ereg_replace(">","&gt;",$subject);
 $message = ereg_replace("<","&lt;",$message);
 $message = ereg_replace(">","&gt;",$message);
 $query = "UPDATE $table SET subject='$subject', message='$message', edited='$edited', timestamp='$stamp' WHERE id='$post_id'";
 mysql_query($query,$conn);
}
function update_post_count($username,$conn)
{
 $table = "users";
 $result = mysql_query("SELECT * FROM $table WHERE username='$username'");
 $row = mysql_fetch_array($result);
 $posts = $row["posts"]+1;
 $query = "UPDATE $table SET posts='$posts' WHERE username='$username'";
 mysql_query($query,$conn);
}
function lock_thread($way,$post_id,$conn)
{
 $table = "forum";
 $result = mysql_query("SELECT * FROM $table WHERE id='$post_id'");
 $row = mysql_fetch_array($result);
 if($row["topic"]=="1")
 {
  $query = "UPDATE $table SET locked='";
  if($way=="unlock")
   $query .= '0';
  else
   $query .= '1';
  $query .= "' WHERE id='$post_id'";
  mysql_query($query,$conn);
 }
}
function delete_from_database($post_id,$board,$conn)
{
 $table = "forum";
 $result = mysql_query("SELECT * FROM $table WHERE id='$post_id'");
 $row = mysql_fetch_array($result);
 if($row["topic"]=="1")
 {
  $query = "DELETE FROM $table WHERE replied='$post_id'";
  mysql_query($query,$conn);
  $table = "forum_list";
  $result = mysql_query("SELECT * FROM $table WHERE id='$board'");
  $row = mysql_fetch_array($result);
  $topics = $row["topics"]-1;
  $query = "UPDATE $table SET topics='$topics' WHERE id='$board'";
 }
 else
 {
  $main_id = $row["replied"];
  $result = mysql_query("SELECT * FROM $table WHERE id='$main_id'");
  $row = mysql_fetch_array($result);
  $replies = $row["replies"]-1;
  $query = "DELETE FROM $table WHERE id='$post_id'";
  mysql_query($query,$conn);
  $query = "UPDATE $table SET replies='$replies' WHERE id='$main_id'";
 }
 mysql_query($query,$conn);
  echo '<meta http-equiv="refresh" content="0; url=javascript:history.go(-2)">';
 exit;
}
function success($board,$replied,$board,$conn)
{
   $table = "forum";
   $query = "UPDATE $table SET replied='$replied' WHERE id='$replied'";
   mysql_query($query,$conn);
   echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=forum.php?area=$board&pid=$replied&type=read">';
  echo '<meta http-equiv="refresh" content="0; url=javascript:history.go(-1)">';
   exit;
}
function update_board_list($board,$tag,$conn)
{
   $table = "forum_list";
   $result = mysql_query("SELECT * FROM $table WHERE id='$board'");
   $row = mysql_fetch_array($result);
   if($tag=="true")
   {
      $stamp = $row["timestamp"];
      $lastpost = $row["lastpost"];
   }
   else
   {
      $stamp = time();
      $lastpost = date("M d h:iA");
   }
   $query = "UPDATE $table SET lastpost='$lastpost', timestamp='$stamp' WHERE id='$board'";
   mysql_query($query,$conn);
}
?>
</head>
<body>
<?php
if($logged_in)
{
if(isset($msg))
   echo '<b>Error</b>: '.$msg;
echo '<div align="center">';
if($type=="read")
{
 echo '<table border="0" cellpadding="1" cellspacing="0" width="100%" align="center">';
 while($a_row = mysql_fetch_array($a_result))
 {
  if($num=="1")
  {
   $result = mysql_query("SELECT * FROM forum_list WHERE id='$area'");
   $row = mysql_fetch_array($result);
   echo '<tr><td>[<a href="forum_list.php">Forum List</a>] -&gt; [<a href="?area='.$area.'">'.$row["forum"].'<a>] -&gt; [<a href="?area='.$area.'&method=read&pid='.$post_id.'&type=read">'.$a_row["subject"].'</a>]</td></tr>';
   echo '<tr><td>';
   echo '<table border="1" cellspacing="0" width="100%"  cellpadding="0" bordercolor="000000" cellspacing=0>';
  }
  $b_result = mysql_query("SELECT * FROM $b_table WHERE username='".$a_row["username"]."' ORDER BY id ASC");
  $b_row = mysql_fetch_array($b_result);
$cresult = mysql_query("SELECT * FROM users WHERE username='".$a_row["username"]."' ORDER BY id ASC");
  $crow = mysql_fetch_array($cresult);
  $message = preg_replace($pattern,$replace,$a_row["message"]);
  if($num=="1")
  {
   $id = $a_row["id"];
   $views = $a_row["views"]+1;
   $query = "UPDATE $a_table SET views='$views' WHERE id=$id";
   mysql_query($query,$conn);
  }
  if($num%2==1)
   echo '<tr class="one">';
  else
   echo '<tr class="two">';
  echo '<td valign="top" width="15%"><center><a href="user.php?type=user&uid='.$b_row["id"].'" class="visit">'.$a_row["username"].'</a></b><BR>';
echo '<img src="'.$crow["avatar"].'" width="100px" heigth="100px"><br>';
echo ''.$b_row["rank"].'<br><br><small>Posts: '.$b_row["posts"].'</small></td><td width="85%" valign=top><div title="'.$a_row["id"].'"><b><u>'.$a_row["subject"].'</u></b></div>'.$message.'<br><BR>---------------<BR>'.$crow["sig"].'<BR><BR><small>Posted on <b>'.$a_row["posted"].'</b>';
  if($a_row["edited"]!="0")
   echo '<br>Edited on <b>'.$a_row["edited"].'</b>';
if($b_row["username"] == $username)
echo '<br><B><a href="?area='.$area.'&pid='.$a_row["id"].'&type=edit">Edit</a></b>';
  echo '</td></small>';
if ($user_level <= 1)

echo '</small></td><td valign="top"><a href="?area='.$area.'&pid='.$a_row["id"].'&type=extras"><img src="images/x.png" width="10" height="10" border="1" bordercolor=006699></a></td></tr>';

$num++;
 }
 echo '</table>';
 echo '</td></tr>';
echo '</table>';
  echo '<br>';
 $result = mysql_query("SELECT * FROM forum WHERE id='$post_id'");
 $row = mysql_fetch_array($result);
 if($row["locked"]=="0")
 {
  echo '<form method="POST" action="?area='.$area.'&pid='.$post_id.'&type=reply">';
  echo '<table border="1" cellpadding="0" bordercolor="000000" cellspacing=0>';
  echo '<tr><td>';
  echo '<table border="0" cellpadding="3">';
  echo '<tr><td>subject:</td><td><input type="text" name="subject" maxlength="20"><font size="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><i>Reply</i></b></font></td></tr>';
  echo '<tr><td valign="top">message:</td><td><textarea name="message" rows="6" cols="35"></textarea></td></tr>';
  echo '<tr><td></td><td><input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;<input type="reset"></td></tr>';
echo '</table>';
echo '</table>';
  echo '</form>';
 }
 else{
exit;
?>
<?php
}
}
elseif($type=="edit")
{
 $result = mysql_query("SELECT * FROM forum WHERE id='$post_id'");
 $row = mysql_fetch_array($result);
 if($row["locked"]=="0")
 {
  $table = "forum";
  $result = mysql_query("SELECT * FROM $table WHERE id='$post_id'");
  $row = mysql_fetch_array($result);
  echo '<form method="POST" action="?area='.$area.'&pid='.$post_id.'&type=edit">';
  echo '<table border="1" cellpadding="0" bordercolor="000000" cellspacing=0>';
  echo '<tr><td>';
  echo '<table border="0" cellpadding="3">';
  echo '<tr><td>subject:</td><td><input type="text" name="subject" value="'.$row["subject"].'" maxlength="20"><font size="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><i>Edit Message</i></b></font></td></tr>';
  echo '<tr><td valign="top">message:</td><td><textarea name="message" rows="6" cols="35">'.$row["message"].'</textarea></td></tr>';
  echo '<tr><td></td><td><input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;<input type="reset">';
  if($user_level<=5)
   echo '&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hide_tag"><small>No Edit Tag</small>';
  echo '</td></tr>';
  echo '</table>';
  echo '</td></tr>';
  echo '</table>';
  echo '</form>';
 }
 else
echo 'This thread is locked, You cannot reply.';
}
elseif($type=="extras")
{
 if($user_level<=5)
 {
  $table = "forum";
  $result = mysql_query("SELECT * FROM $table WHERE id='$post_id'");
  $row = mysql_fetch_array($result);
  echo '<form method="POST" action="?area='.$area.'&pid='.$post_id.'&type=extras_submit">';
  echo '<table border="1" width="100%"  cellpadding="0" bordercolor="000000" cellspacing=0>';
  echo '<tr><td valign="top" width="15%">'.$row["username"].'</td><td width="85%"><b><u>'.$row["subject"].'</u></b><br>'.$row["message"].'</td></tr>';
  echo '<tr><td colspan="2">';
  echo '<center><table border="0"  cellpadding="0" bordercolor="000000" cellspacing=0>';
  echo '<tr><td colspan="2" align="center"><input type="submit" name="e_action" value="delete">';
  if($row["topic"]=="1")
  {
    echo '&nbsp;&nbsp;&nbsp;<input type="submit" name="e_action" value="';
   if($row["locked"]=="1")
    echo 'un';
   echo 'lock thread">';
  }
  echo '</td></tr>';
  echo '</table>';
  echo '</td></tr>';
  echo '</table>';
  echo '</form>';
 }
 else
  echo '<b>Error</b>: Only admin/moderators can view extra options';
}
elseif($type=="delete")
{
 if($user_level<=5)
 {
  $table = "forum";
  $result = mysql_query("SELECT * FROM $table WHERE id='$post_id'");
  $row = mysql_fetch_array($result);
  echo '<form method="POST" action="?area='.$area.'&pid='.$post_id.'&type=delete">';
  echo '<table border="1" width="100%"  cellpadding="0" bordercolor="000000" cellspacing=0>';
  echo '<tr><td valign="top" width="15%">'.$row["username"].'</td><td width="85%"><b><u>'.$row["subject"].'</u></b><br>'.$row["message"].'</td></tr>';
  echo '<tr><td colspan="2">';
  echo '<table border="0" cellpadding="3">';
  echo '<tr><td></td><td><input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;<input type="reset"></td></tr>';
  echo '</table>';
  echo '</td></tr>';
  echo '</table>';
  echo '</form>';
 }
 else
  echo '<b>Error</b>: Only admin/moderators can delete posts';
}
else
{
  $b_result = mysql_query("SELECT * FROM users");
  $b_row = mysql_fetch_array($b_result);
 $table = "forum";
 $result = mysql_query("SELECT * FROM $table WHERE board='$area' AND topic='1'");
 $num_rows = mysql_num_rows($result);
 $num_pages = $num_rows/$topicperpage;
 $result = mysql_query("SELECT * FROM $table WHERE board='$area' AND topic='1' ORDER BY timestamp DESC LIMIT $show3");
 $num = 1+($topicperpage*($page-1));
 echo '<table border="0" cellpadding="1" cellspacing="0" align="center">';
 echo '<tr><td>';
 echo '<table border="1" align="center" width="100%"  cellpadding="0" bordercolor="000000" cellspacing=0>';
 echo '<tr><th align="center">#</th><th align="center">subject</th><th align="center">username</th><th align="center">views</th><th align="center">replies</th><th align="center">last post</th></tr>';
 while ($row = mysql_fetch_array($result))
 {
  if($num%2==0)
     echo '<tr class="one">';
  else
     echo '<tr class="two">';
  echo '<td>'.$num.'</td>';
  echo '<td><a href="?area='.$area.'&pid='.$row["id"].'&type=read&lastpost='.$row["timestamp"].'" title="'.substr($row["message"], 0, 55).'..." class="visit">'.$row["subject"].'</a>';
  if($row["locked"]=="1")
   echo ' <small>[locked]</small>';
  echo '</td>';
  echo '<td><a href="user.php?type=user&uid='.$b_row["id"].'" class="visit">'.$row["username"].'</td>';
  echo '<td>'.$row["views"].'</td>';
  echo '<td>'.$row["replies"].'</td>';
  echo '<td>'.$row["lastpost"].'</td>';
  echo '</tr>';
 $num++;
 }
 echo '</table>';
 echo '</td></tr>';
 echo '</table>';
 echo $num_rows.' topics.&nbsp;';
 for($i=1;$i!=ceil($num_pages)+1;$i++)
 {
  if($i==1)
   echo 'Page:';
  if($i==$page)
   echo '&nbsp;['.$i.']';
  else
   echo '&nbsp;[<a href="'.$_SERVER['SCRIPT_NAME'].'?area='.$area.'&page='.$i.'">'.$i.'</a>]';
 }
 echo '<br>';
 echo '<form method="POST" action="?area='.$area.'&pid='.$post_id.'&type=post">';
 echo '<table border="1" align="center"  cellpadding="0" bordercolor="000000" cellspacing=0>';
 echo '<tr><td>';
 echo '<table border="0" cellpadding="3">';
 echo '<tr><td>subject:</td><td><input type="text" name="subject" maxlength="20"><font size="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><i>New Topic</i></b></font></td></tr>';
 echo '<tr><td valign="top">message:</td><td><textarea name="message" rows="6" cols="35"></textarea></td></tr>';
 echo '<tr><td></td><td><input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;<input type="reset"></td></tr>';
 echo '</table>';
 echo '</td></tr>';
 echo '</table>';
 echo '</form>';
}
}
else{
 echo 'Not logged in.';
}
include("foot.php");
?>