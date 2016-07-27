<?php
$pattern = array();
$replace = array();
$pattern[] = '/\[url=(.+)\](.+)\[\/url\]/i';
$replace[] = '<a href="\\1" class="visit">\\2</a>';
$pattern[] = '/\[b](.+)\[\/b\]/i';
$replace[] = '<b>\\1</b>';
$pattern[] = '/\[i](.+)\[\/i\]/i';
$replace[] = '<i>\\1</i>';
$pattern[] = '/\[u](.+)\[\/u\]/i';
$replace[] = '<u>\\1</u>';
$pattern[] = '/\[s](.+)\[\/u\]/i';
$replace[] = '<s>\\1</s>';
$pattern[] = '/\[left](.+)[\/left]/i';
$replace[] = '<p align="left">\\1</p>';
$pattern[] = '/\[center](.+)[\/center]/i';
$replace[] = '<p align="center">\\1</p>';
$pattern[] = '/\[right](.+)[\/right]/i';
$replace[] = '<p align="right">\\1</p>';
$replace[] = '\\1<img src="images/sad.png" width="15" height="15">\\2';
$pattern[] = '/(.+)?:-[(](.?+)/i';
$replace[] = '\\1<img src="images/happy.png" width="15" height="15">\\2';
$pattern[] = '/(.+)?:-](.?+)/i';
$replace[] = '\\1<img src="images/o.png" width="15" height="15">\\2';
$pattern[] = '/(.+)?:-o(.?+)/i';
$replace[] = '\\1<img src="images/grin.png" width="15" height="15">\\2';
$pattern[] = '/(.+):-D(.?+)/i';
$replace[] = '\\1<img src="images/unsure.png" width="15" height="15">\\2';
$pattern[] = '/(.+):-s(.?+)/i';
$message_id = filter_input(INPUT_GET, "mid", FILTER_SANITIZE_STRING);
$method = filter_input(INPUT_GET, "method", FILTER_SANITIZE_STRING);
$area = filter_input(INPUT_GET, "area", FILTER_SANITIZE_STRING);
$msg = filter_input(INPUT_GET, "msg", FILTER_SANITIZE_STRING);
if($method=="send"&&isset($subject)&&isset($message)&&isset($to))
 header("Location: $_SERVER[SCRIPT_NAME]?area=$area"); //Message successfully sent.
elseif($method=="send")
 header("Location: $_SERVER[SCRIPT_NAME]?area=$area"); //Please fill in all fields before sending message.
elseif($method=="delete"&&$area!="trash")
 header("Location: $_SERVER[SCRIPT_NAME]?area=$area"); //Message sent to trash.
elseif($method=="$_SERVER[SCRIPT_NAME]"&&$area=="trash")
 header("Location: $_SERVER[SCRIPT_NAME]?area=$area"); //Message successfully deleted.
include("head.php");
if($logged_in)
{

 echo '<br>';
 if(($method=="read"||$method=="delete")&&!isset($message_id))
 {
  echo '<b>Error</b>: Cannot find message ID. <a href="javascript:history.go(-1)">back</a>';
  exit;
 }
 $result = mysql_query("SELECT * FROM users WHERE username='$username' LIMIT 1");
 $row = mysql_fetch_array($result);
 $id = $row["id"];
 if($method=="send")
 {
  if(isset($subject)&&isset($message)&&isset($to))
  {
   $sent = date("M d h:iA");
   $stamp = time();
   $subject = ereg_replace("<","&lt;",$subject);
   $subject = ereg_replace(">","&gt;",$subject);
   $message = ereg_replace("<","&lt;",$message);
   $message = ereg_replace(">","&gt;",$message);
   $query = "INSERT INTO messaging (subject,message,`from`,`to`,recieved,timestamp,folder) values ('$subject','$message','$id','$to','$sent','$stamp','inbox')";
   mysql_query($query,$conn);
   $query = "INSERT INTO messaging (subject,message,`from`,`to`,recieved,timestamp,folder,`read`) values ('$subject','$message','$id','$to','$sent','$stamp','outbox','1')";
   mysql_query($query,$conn);
   echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$_SERVER[SCRIPT_NAME].'?area='.$area.'">';
   echo 'Message successfully sent. <a href="javascript:history.go(-1)">back</a>';
   exit;
  }
  else
   $msg = 'Please fill in all fields. <a href="javascript:history.go(-1)">back</a>';
 }
 elseif($method=="delete")
 {
  $b_result = mysql_query("SELECT * FROM users WHERE username='$username'");
  $b_row = mysql_fetch_array($b_result);
  $a_result = mysql_query("SELECT * FROM messaging WHERE id='$message_id' ORDER BY id ASC");
  $a_row = mysql_fetch_array($a_result);
  if($area=="outbox")
   $way = "from";
  else
   $way = "to";
  if($b_row["id"]==$a_row[$way])
  {
   if($area!="trash")
   {
    $query = "UPDATE messaging SET folder='trash' WHERE id='$message_id'";
    mysql_query($query,$conn);
    echo 'Message moved to trash. <a href="javascript:history.go(-1)">back</a>';
    exit;
   }
   else
   {
    $query = "UPDATE messaging SET folder='deleted', `read`='1' WHERE id='$message_id'";
    mysql_query($query,$conn);
    echo 'Message has been deleted. <a href="javascript:history.go(-1)">back</a>';
    exit;
   }
  }
  else
  {
   echo 'This message does not belong to you. <a href="javascript:history.go(-1)">back</a>';
   exit;
  }
 }
 if(isset($msg))
  echo '<b>Error</b>: '.$msg;
 echo '<div align="center">';

 if(!isset($area))
 {

  echo '<table border="1" bordercolor="#000000" cellspacing=0 cellpadding="0" align="center" width="90%">';
  echo '<tr><th>folder</th><th>messages</th><th>unread</th><th>last message</th></tr>';
  $a_result = mysql_query("SELECT * FROM messaging WHERE `to`='$id' AND folder='inbox'");
  $b_result = mysql_query("SELECT * FROM messaging WHERE `to`='$id' AND folder='inbox' AND `read`='0'");
  $c_result = mysql_query("SELECT * FROM messaging WHERE `to`='$id' AND folder='inbox' ORDER BY timestamp DESC LIMIT 1");
  $c_row = mysql_fetch_array($c_result);
  if($c_row["recieved"]=="")
   $c_row["recieved"] = "-";
  echo '<tr><td><a href="?area=inbox">Inbox</a></td><td align="center">'.mysql_num_rows($a_result).'</td><td align="center">'.mysql_num_rows($b_result).'</td><td align="center">'.$c_row["recieved"].'</td></tr>';
  $a_result = mysql_query("SELECT * FROM messaging WHERE `from`='$id' AND folder='outbox'");
  $c_result = mysql_query("SELECT * FROM messaging WHERE `from`='$id' AND folder='outbox' ORDER BY timestamp DESC LIMIT 1");
  $c_row = mysql_fetch_array($c_result);
  if($c_row["recieved"]=="")
   $c_row["recieved"] = "-";
  echo '<tr><td><a href="?area=outbox">Outbox</a></td><td align="center">'.mysql_num_rows($a_result).'</td><td align="center">0</td><td align="center">'.$c_row["recieved"].'</td></tr>';
  $a_result = mysql_query("SELECT * FROM messaging WHERE `to`='$id' AND folder='trash'");
  $b_result = mysql_query("SELECT * FROM messaging WHERE folder='trash' AND `read`='0'");
  $c_result = mysql_query("SELECT * FROM messaging WHERE `to`='$id' AND folder='trash' ORDER BY timestamp DESC LIMIT 1");
  $c_row = mysql_fetch_array($c_result);
  if($c_row["recieved"]=="")
   $c_row["recieved"] = "-";
  echo '<tr><td><a href="?area=trash">Trash</a></td><td align="center">'.mysql_num_rows($a_result).'</td><td align="center">'.mysql_num_rows($b_result).'</td><td align="center">'.$c_row["recieved"].'</td></tr>';
  echo '</table>';
 }
 elseif($method=="read")
 {
  $b_result = mysql_query("SELECT * FROM users WHERE username='$username'");
  $b_row = mysql_fetch_array($b_result);
  $a_result = mysql_query("SELECT * FROM messaging WHERE id='$message_id' AND folder='$area' ORDER BY id ASC");
  $a_row = mysql_fetch_array($a_result);
if($area=="deleted"){
echo 'This message has been deleted';
exit;
}


  if($area=="outbox")
   $way = "from";
  else
   $way = "to";
  if($b_row["id"]==$a_row[$way])
  {
   $b_result = mysql_query("SELECT * FROM users WHERE id='".$a_row["from"]."' ORDER BY id ASC");
   $b_row = mysql_fetch_array($b_result);
   $message = preg_replace($pattern,$replace,$a_row["message"]);
   if($a_row["read"]=="0")
   {
    $query = "UPDATE messaging SET `read`='1' WHERE id='".$a_row["id"]."'";
    mysql_query($query,$conn);
   }
   echo '<table border="0" cellpadding=01" bordercolor=000000 cellspacing="0" width="90%" align="center">';
   echo '<tr><td>[<a href="'.$_SERVER[SCRIPT_NAME].'">messaging</a>] -&gt; [<a href="?area='.$area.'">'.$area.'<a>] -&gt; [<a href="?area='.$area.'&method=read&mid='.$message_id.'">'.$a_row["subject"].'</a>]</td></tr>';
   echo '<tr><td>';
   echo '<table border="1" bordercolor="#000000" cellpadding="0" cellspacing="0" width="100%">';
   echo '<tr>';
   echo '<td valign="top" width="15%"><a href="user.php?uid='.$b_row["id"].'" class="visit">'.$b_row["username"].'</a></b><br>'.$b_row["rank"].'</td><td width="85%"><div title="'.$a_row["id"].'"><b><u>'.$a_row["subject"].'</u></b></div>'.$message.'<br><br><small>Recieved on <b>'.$a_row["recieved"].'</b></small></td></tr>';
   echo '</table>';
   echo '</td></tr>';
   echo '</table>';
  }


else
{
echo 'This message does not belong to you or has been deleted. <a href="javascript:history.go(-1)">back</a>';
exit;
}
}

 elseif($method=="delete")
 {
  $result = mysql_query("SELECT * FROM messaging WHERE id='$message_id'");
  echo '<form method="POST" action="?area='.$area.'&method=delete&mid='.$message_id.'">';
  echo '<table border="1" cellpadding="3" width="90%">';
  echo '<tr><td valign="top" width="15%">'.$row["username"].'</td><td width="85%"><b><u>'.$row["subject"].'</u></b><br>'.$row["message"].'</td></tr>';
  echo '<tr><td colspan="2">';
  echo '<table border="0" cellpadding="3">';
  echo '<tr><td></td><td><input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;<input type="reset"></td></tr>';
  echo '</table>';
  echo '</table>';
  echo '</form>';
 }
 else
 {
  $num = 1;
  $a_result = mysql_query("SELECT * FROM users WHERE username='$username'");
  $a_row = mysql_fetch_array($a_result);
  $a_result = "SELECT * FROM messaging WHERE ";
  if($area!="outbox")
   $a_result .= "`to`='".$a_row["id"]."'";
  else
   $a_result .= "`from`='".$a_row["id"]."'"; 
  $a_result .= " AND folder='$area' ORDER BY timestamp DESC";
  $a_result = mysql_query($a_result);
  echo '<table border="0" cellpadding="1" cellspacing="0" align="center" width="100%">';
  echo '<tr><td>[<a href="'.$_SERVER['SCRIPT_NAME'].'">messaging</a>] -&gt; [<a href="?area='.$area.'">'.$area.'<a>]</td></tr>';
  echo '<tr><td>';
  echo '<table border="1" bordercolor="#000000" cellpadding="0" cellspacing=0 align="center" width="100%">';
  echo '<tr><th align="center">#</th><th align="center">subject</th><th align="center">from</th><th align="center">recieved</th><th>Delete</th></tr>';
  $rresult = mysql_query("SELECT * FROM messaging WHERE id='$message_id'");
  $rrrow = mysql_fetch_array($rresult);
  

  while ($a_row = mysql_fetch_array($a_result))
  {
   $b_result = mysql_query("SELECT * FROM users WHERE id='".$a_row["from"]."' LIMIT 1");
   $b_row = mysql_fetch_array($b_result);
   echo '<tr>';
   echo '<td>'.$num.'</td>';
   echo '<td><a href="?area='.$area.'&method=read&mid='.$a_row["id"].'" title="'.substr($a_row["message"], 0, 100).'..." class="visit">';
   if($a_row["read"]=="0")
{
    echo '<b>'.$a_row["subject"].'</b>';
} 
  else
{ 
   echo $a_row["subject"];
} 
  echo '</a></td>';
   echo '<td>'.$b_row["username"].'</td>';
   echo '<td>'.$a_row["recieved"].'</td>';

  echo '<form method="POST" action="?area='.$area.'&method=delete&mid='.$a_row["id"].'">';

   echo '<td align="center"><input type="submit" name=delete value="Delete"></td>';
 echo '</form>';
   echo '</tr>';
   $num++;
  }
  if(mysql_num_rows($a_result)=="0")
   echo '<tr><td colspan="5">There are no messages in this folder.</td></tr>';
  else

  echo '</form>';
  echo '</table>';
  echo '</table>';
 }
 if(($area=="inbox"&&(($method!="read"&&$method!="delete")||$method=="read")))
 {
  echo '<br>';
  echo '<form method="POST" action="?area='.$area.'&method=send">';
  echo '<table border="1" cellspacing="0" cellpadding=0 bordercolor=000000>';
  if($method!="read"&&$method!="delete")
  {
   echo '<tr><td>to:</td><td><select name="to" size="2">';
   $result = mysql_query("SELECT * FROM users ORDER BY username");
   while($row = mysql_fetch_array($result))
   {
    if($row["username"]!="$username")
     echo '<option value="'.$row["id"].'">'.$row["username"].'</option>';
   }
   echo '</select></td></tr>';
  }
  else
  {
   $result = mysql_query("SELECT * FROM messaging WHERE id='$message_id'");
   $row = mysql_fetch_array($result);
   echo '<input type="hidden" name="to" value="'.$row["from"].'">';
  }
  echo '<tr><td>subject:</td><td><input type="text" name="subject"';
  if($method=="read")
  {
   $result = mysql_query("SELECT * FROM messaging WHERE id='$message_id'");
   $row = mysql_fetch_array($result);
   echo ' value="RE: '.$row["subject"].'"';
  }
  echo ' maxlength="20"></td></tr>';
  echo '<tr><td valign="top">message:</td><td><textarea name="message" rows="6" cols="35" maxlength="255"></textarea></td></tr>';
  echo '<tr><td colspan=2><center><input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;<input type="reset"></td></tr>';
  echo '</table>';
  echo '</form>';
 }
 echo '</div>';

}
else
 echo 'Not logged in.';
include("foot.php");
?></body>
</html>