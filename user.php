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
$uid = filter_input(INPUT_GET, "uid", FILTER_SANITIZE_STRING);
if($method=="send"&&isset($subject)&&isset($message)&&isset($to))
 header("Location: $_SERVER[SCRIPT_NAME]?area=$area"); //Message successfully sent.
elseif($method=="send")
 header("Location: $_SERVER[SCRIPT_NAME]?area=$area"); //Please fill in all fields before sending message.
elseif($method=="delete"&&$area!="trash")

session_start();
include("head.php");



if($logged_in)
{

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
   echo 'Message successfully sent. <a href="javascript:history.go(-1)">back</a>';
  }
  else
   $msg = 'Please fill in all fields';
 }




?>

<?php

 echo '<center><table border="1" cellspacing=0 cellpadding="0" bordercolor=000000 align="center">';

 $result = mysql_query("SELECT * FROM users WHERE id='$uid'");
 while ($row = mysql_fetch_array($result))
         $uid = $result['uid'];
 {
  echo '<tr><th align="center" colspan="4"><h2><u>User Info For "<i>'.$row["username"].'</i>"</h2></th></tr>';
  echo '<tr><td colspan="4"><b><center><B>Rank: '.$row["rank"].'</b></center></td></tr>';
  echo '<tr><td colspan="4"><b><center>Contact Info:</a></center></td></tr>';
  echo '<tr><th>Email:</th><td>'.$row["email"].'</td><th>MSN:</th><td>'.$row["msn"].'</td></tr>';
  echo '<tr><th>AIM:</th><td>'.$row["aim"].'</td><th>ICQ:</th><td>'.$row["icq"].'</td></tr>';
  echo '<tr><th>Yahoo</th><td>'.$row["yahoo"].'</td><th>SKYPE:</th><td>'.$row["skype"].'</td></tr>';
  echo '<tr><td colspan="4"><b><center>Personal Details:</b></center></td></tr>';
  echo '<tr><th>Name:</th><td>'.$row["name"].'</td><th>Birthdate:</th><td>'.$row["birth"].'</td></tr>';
  echo '<tr><th>Country:</th><td>'.$row["country"].'</td></tr>';

  echo '</tr>';
 echo '</table>';

echo '<center><a href="javascript:history.go(-1)">Back</a>';


if($cur_uid == $uid)
{
echo '&nbsp';
}
else{
  echo '<center><form method="POST" action="?area='.$area.'&method=send">';
  echo '<center><table border="1" cellspacing="0" cellpadding=0 bordercolor=000000>';
  echo '<tr><td colspan=2><center>Send message.</td></tr>';
  echo '<input type="hidden" name="to" value="'.$row["id"].'">';
  echo '<tr><td>subject:</td><td><input type="text" name="subject"';
  echo ' maxlength="20"></td></tr>';
  echo '<tr><td valign="top">message:</td><td><textarea name="message" rows="6" cols="35" maxlength="255"></textarea></td></tr>';
  echo '<tr><td colspan=2><center><input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;<input type="reset"></td></tr>';
  echo '</table>';
  echo '</form>';

}
}

}
else {
 echo 'Not logged in.';
}
include("foot.php");
?>