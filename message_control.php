<?php
$stage = filter_input(INPUT_GET, "stage", FILTER_SANITIZE_STRING);
$message_id = filter_input(INPUT_GET, "message_id", FILTER_SANITIZE_STRING);
$msg = filter_input(INPUT_GET, "msg", FILTER_SANITIZE_STRING);
if(isset($message_id))
{
 if($stage=="delete")
  header("Location: $_SERVER[SCRIPT_NAME]?msg=2");
}
include("head.php");
if($logged_in)
{
 
 if($stage=="confirm")
 {
  $result = mysql_query("SELECT * FROM messaging WHERE id='$message_id'");
  while($row = mysql_fetch_assoc($result))
   $v_id = $row["id"];
  echo '<font color="000000">Are you sure you want to delete message #'.$message_id.' ("'.$v_id.'")?</font><br>';
  echo '<a href="'.$_SERVER[SCRIPT_NAME].'?stage=delete&message_id='.$message_id.'">Yes, delete</a>&nbsp;&nbsp;<a href="'.$_SERVER[SCRIPT_NAME].'">No, cancel</a>';
  exit;
 }
 elseif($stage=="delete")
 {
  $query = "DELETE FROM messaging WHERE id='$message_id'";
  mysql_query($query,$conn);
 }
if($msg=="2")
  echo '<font color="000000">Message Successfully Deleted</font>';
 if ($user_level <= 1)
 {



  echo '<br>';
 echo'<h1><center>Messages in inboxes.</h1>';
  echo '<table border="1" cellpadding="0" cellspacing=0 bordercolor=000000 align="center">';
  echo '<tr><th align="center">id</th><th align="center">Subject</th><th align="center">Message</th><th align="center">From</th><th align="center">To</th><th align="center">Recieved</th><th align="center" colspan="2">Delete</th></tr>';
  $result = mysql_query("SELECT * FROM messaging WHERE folder='inbox'");  
while ($row = mysql_fetch_array($result))
{
   echo '<tr>';
   echo '<td>'.$row["id"].'</td>';
   echo '<td>'.$row["subject"].'</td>';
   echo '<td>'.$row["message"].'</td>';
   echo '<td>'.$row["from"].'</td>';
   echo '<td>'.$row["to"].'</td>';
   echo '<td>'.$row["recieved"].'</td>';
   echo '<form method="POST" action="'.$_SERVER[SCRIPT_NAME].'?stage=confirm&message_id='.$row["id"].'">';
   echo '<td><input type="submit" value="Delete"></td>';
   echo '</form>';
   echo '</tr>';
  }
  echo '</table>';
 echo '<BR>';
  $result = mysql_query("SELECT * FROM messaging WHERE folder='outbox' ORDER BY id");
  echo '<br>';
 echo'<h1><center>Messages in outboxes.</h1>';
  echo '<table border="1" cellpadding="0" cellspacing=0 bordercolor=000000 align="center">';
  echo '<tr><th align="center">id</th><th align="center">Subject</th><th align="center">Message</th><th align="center">From</th><th align="center">To</th><th align="center">Recieved</th><th align="center" colspan="2">Delete</th></tr>';
  while ($row = mysql_fetch_array($result))
{

   echo '<tr>';
   echo '<td>'.$row["id"].'</td>';
   echo '<td>'.$row["subject"].'</td>';
   echo '<td>'.$row["message"].'</td>';
   echo '<td>'.$row["from"].'</td>';
   echo '<td>'.$row["to"].'</td>';
  echo '<td>'.$row["recieved"].'</td>';
   echo '<form method="POST" action="'.$_SERVER[SCRIPT_NAME].'?stage=confirm&message_id='.$row["id"].'">';
   echo '<td><input type="submit" value="Delete"></td>';
   echo '</form>';
   echo '</tr>';
  }
  echo '</table>';
 echo '<BR>';
  $result = mysql_query("SELECT * FROM messaging WHERE folder='trash' ORDER BY id");
  echo '<br>';
 echo'<h1><center>Messages in trash.</h1>';
  echo '<table border="1" cellpadding="0" cellspacing=0 bordercolor=000000 align="center">';
  echo '<tr><th align="center">id</th><th align="center">Subject</th><th align="center">Message</th><th align="center">From</th><th align="center">To</th><th align="center">Recieved</th><th align="center" colspan="2">Delete</th></tr>';
  while ($row = mysql_fetch_array($result))
{

   echo '<tr>';
   echo '<td>'.$row["id"].'</td>';
   echo '<td>'.$row["subject"].'</td>';
   echo '<td>'.$row["message"].'</td>';
   echo '<td>'.$row["from"].'</td>';
   echo '<td>'.$row["to"].'</td>';
  echo '<td>'.$row["recieved"].'</td>';
   echo '<form method="POST" action="'.$_SERVER[SCRIPT_NAME].'?stage=confirm&message_id='.$row["id"].'">';
   echo '<td><input type="submit" value="Delete"></td>';
   echo '</form>';
   echo '</tr>';
  }
  echo '</table>';
 echo '<BR>';
  $result = mysql_query("SELECT * FROM messaging WHERE folder='deleted' ORDER BY id");
  echo '<br>';
 echo'<h1><center>Deleted messages.</h1>';
  echo '<table border="1" cellpadding="0" cellspacing=0 bordercolor=000000 align="center">';
  echo '<tr><th align="center">id</th><th align="center">Subject</th><th align="center">Message</th><th align="center">From</th><th align="center">To</th><th align="center">Recieved</th><th align="center" colspan="2">Delete</th></tr>';
  while ($row = mysql_fetch_array($result))
{

   echo '<tr>';
   echo '<td>'.$row["id"].'</td>';
   echo '<td>'.$row["subject"].'</td>';
   echo '<td>'.$row["message"].'</td>';
   echo '<td>'.$row["from"].'</td>';
   echo '<td>'.$row["to"].'</td>';
  echo '<td>'.$row["recieved"].'</td>';
   echo '<form method="POST" action="'.$_SERVER[SCRIPT_NAME].'?stage=confirm&message_id='.$row["id"].'">';
   echo '<td><input type="submit" value="Delete"></td>';
   echo '</form>';
   echo '</tr>';
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