<?php
$stage = filter_input(INPUT_GET, "stage", FILTER_SANITIZE_STRING);
$poll_id = filter_input(INPUT_GET, "pid", FILTER_SANITIZE_STRING);
$msg = filter_input(INPUT_GET, "msg", FILTER_SANITIZE_STRING);
$type = filter_input(INPUT_GET, "type", FILTER_SANITIZE_STRING);
if($stage=="update"&&$type=="answers")
 header("Location: $_SERVER[SCRIPT_NAME]?stage=answers&pid=$poll_id&msg=1");
elseif($stage=="update"&&$type=="main")
 header("Location: $_SERVER[SCRIPT_NAME]?msg=1");
elseif($stage=="delete")
 header("Location: $_SERVER[SCRIPT_NAME]?msg=2");
elseif($stage=="create")
 header("Location: $_SERVER[SCRIPT_NAME]?msg=4");
include("head.php");
if($logged_in)
{
 if($user_level <= 1)
 {
  if($msg=="1")
   print "<font color=\"000000\">Answers Successfully Updated</font>";
  elseif($msg=="2")
   print "<font color=\"000000\">Poll Successfully Deleted</font>";
  elseif($msg=="3")
   print "<font color=\"000000\">Poll Deletion Canceled</font>";
  elseif($msg=="4")
   print "<font color=\"000000\">Poll Successfully Created</font>";
  if($stage=="update")
  {
   if($type=="answers")
   {
    $query = "UPDATE poll SET answer1='$answer1', answer2='$answer2', answer3='$answer3', answer4='$answer4', answer5='$answer5', answer6='$answer6' WHERE id='$poll_id'";
    mysql_query($query,$conn);
   }
   elseif($type=="main")
   {
    $num = "1";
    $result = mysql_query("SELECT * FROM poll");
    while($row = mysql_fetch_array($result))
    {
     $query = "UPDATE poll SET question='$question[$num]', status='$status[$num]' WHERE id='".$row["id"]."'";
     mysql_query($query,$conn);
     $num++;
    }
   }
  }
  if(!(isset($stage)))
  {
   $num = 1;
   print "<table border=\"1\" bordercolor=\"000000\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">";
   print "<tr><td><h1>Current Polls:</h1></td></tr>";
   print "<tr><td>";
   print "<table border=\"0\" cellpadding=\"1\" cellspacing=\"3\" align=\"center\">";
   print "<tr><th>#</th><th>question</th><th></th><th>status</th><th></th><th colspan=\"3\"><small>extra controls</small></th></tr>";
   print "<form method=\"POST\" action=\"$_SERVER[SCRIPT_NAME]?stage=update&type=main\">";
   $result = mysql_query("SELECT * FROM poll");
   while($row = mysql_fetch_array($result))
   {
    print "<tr>";
    print "<td>$num</td>";
    print "<td><textarea name=\"question[$num]\" cols=\"20\" rows=\"3\">".$row["question"]."</textarea></td>";
    print "<td width=\"10\">&nbsp;</td>";
    print "<td><select name=\"status[$num]\"><option value=\"open\"";
    if($row["status"]=="open")
     print " SELECTED";
    print ">open</option><option value=\"close\"";
    if($row["status"]=="close")
     print " SELECTED";
    print ">close</option><option value=\"hide\"";
    if($row["status"]=="hide")
     print " SELECTED";
    print ">hide</option></select></td>";
    print "<td width=\"10\">&nbsp;</td>";
    print "<td align=\"center\"><small><a href=\"$_SERVER[SCRIPT_NAME]?stage=answers&pid=".$row["id"]."\">edit answers</a></small></td>";
    print "<td width=\"10\">&nbsp;</td>";
    print "<td align=\"center\"><small><a href=\"$_SERVER[SCRIPT_NAME]?stage=confirm&pid=".$row["id"]."\">delete poll</a></small></td>";
    print "</tr>";
    $num++;
   }
   print "<tr><td colspan=\"7\"><input type=\"submit\" value=\"Update\">&nbsp;&nbsp;<input type=\"reset\"></td></tr>";
   print "</form>";
   print "</table>";
   print "</td></tr>";
   print "</table>";
   print "<br><br>";
   print "<table border=\"1\" bordercolor=\"000000\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">";
   print "<tr><td><h1>New Poll:</h1></td></tr>";
   print "<tr><td>";
   print "<table border=\"0\" cellpadding=\"1\" cellspacing=\"3\" align=\"center\">";
   print "<tr><th>question</th><th></th><th>status</th></tr>";
   print "<form method=\"POST\" action=\"$_SERVER[SCRIPT_NAME]?stage=create\">";
   print "<tr>";
   print "<td><textarea name=\"question\" cols=\"30\" rows=\"3\">".$row["question"]."</textarea></td>";
   print "<td width=\"10\">&nbsp;</td>";
   print "<td><select name=\"status\"><option value=\"open\">open</option><option value=\"close\">close</option><option value=\"hide\">hide</option></select></td>";
   print "</tr>";
   print "</table>";
   print "<table border=\"0\" cellpadding=\"1\" cellspacing=\"3\" align=\"center\">";
   print "<tr>";
   print "<tr><th>answer #1</th><th></th><th>answer #2</th><th></th><th>answer #3</th></tr>";
   print "<td><input type=\"text\" name=\"answer1\" size=\"15\" maxlength=\"50\"></td>";
   print "<td width=\"10\">&nbsp;</td>";
   print "<td><input type=\"text\" name=\"answer2\" size=\"15\" maxlength=\"50\"></td>";
   print "<td width=\"10\">&nbsp;</td>";
   print "<td><input type=\"text\" name=\"answer3\" size=\"15\" maxlength=\"50\"></td>";
   print "</tr>";
   print "<tr><th>answer #4</th><th></th><th>answer #5</th><th></th><th>answer #6</th></tr>";
   print "<td><input type=\"text\" name=\"answer4\" size=\"15\" maxlength=\"50\"></td>";
   print "<td width=\"10\">&nbsp;</td>";
   print "<td><input type=\"text\" name=\"answer5\" size=\"15\" maxlength=\"50\"></td>";
   print "<td width=\"10\">&nbsp;</td>";
   print "<td><input type=\"text\" name=\"answer6\" size=\"15\" maxlength=\"50\"></td>";
   print "</tr>";
   print "<tr><td><input type=\"submit\" value=\"Create\">&nbsp;&nbsp;<input type=\"reset\"></td></tr>";
   print "</form>";
   print "</table>";
   print "</td></tr>";
  }
  elseif($stage=="answers")
  {
   $result = mysql_query("SELECT * FROM poll WHERE id='$poll_id'");
   while($row = mysql_fetch_array($result))
   {
    print "<form method=\"POST\" action=\"$_SERVER[SCRIPT_NAME]?stage=update&type=answers&pid=".$row["id"]."\">";
   print "<table border=\"1\" bordercolor=\"000000\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">";
    print "<tr><td><b>Question</b>:&nbsp;<i>".$row["question"]."</i></td></tr>";
    print "<tr><td>";
    print "<table border=\"0\" cellpadding=\"1\" cellspacing=\"3\" align=\"center\">";
    print "<tr><th>answer #1</th><th></th><th>answer #2</th><th></th><th>answer #3</th></tr>";
    print "<tr>";
    print "<td><input type=\"text\" name=\"answer1\" value=\"".$row["answer1"]."\"></td>";
    print "<td width=\"10\">&nbsp;</td>";
    print "<td><input type=\"text\" name=\"answer2\" value=\"".$row["answer2"]."\"></td>";
    print "<td width=\"10\">&nbsp;</td>";
    print "<td><input type=\"text\" name=\"answer3\" value=\"".$row["answer3"]."\"></td>";
    print "<td width=\"10\">&nbsp;</td>";
    print "<tr><th>answer #4</th><th></th><th>answer #5</th><th></th><th>answer #6</th></tr>";
    print "<td><input type=\"text\" name=\"answer4\"></td>";
    print "<td width=\"10\">&nbsp;</td>";
    print "<td><input type=\"text\" name=\"answer5\"></td>";
    print "<td width=\"10\">&nbsp;</td>";
    print "<td><input type=\"text\" name=\"answer6\"></td>";
    print "</tr>";
    print "<td><input type=\"submit\" value=\"Submit\">&nbsp;&nbsp;<input type=\"reset\"></td>";
    print "</tr>";
    print "</form>";
   }
   print "</table>";
   print "</td></tr>";
   print "</table>";
   print "<center><a href=\"$_SERVER[SCRIPT_NAME]\">back</a></center>";
  }
  elseif($stage=="create")
  {
   $query = "INSERT INTO poll (question,answer1,answer2,answer3,answer4,answer5,answer6,status) values ('$question','$answer1','$answer2','$answer3','$answer4','$answer5','$answer6','$status')";
   mysql_query($query,$conn);
  }
  elseif($stage=="confirm")
  {
   echo '<font color="white">Are you sure you want to delete poll id #'.$poll_id.'?</font><br>';
   echo '<a href="'.$_SERVER[SCRIPT_NAME].'?stage=delete&pid='.$poll_id.'">Yes, delete</a>&nbsp;&nbsp;<a href="'.$_SERVER[SCRIPT_NAME].'?msg=3">No, cancel</a>';
   exit;
  }
  elseif($stage=="delete")
  {
   $query = "DELETE FROM poll WHERE id='$poll_id'";
   mysql_query($query,$conn);
  }
 }
 else
  echo 'You\'re now allowed to see this page';
}
else
 echo 'Not logged in.';
include("foot.php");
?>
</body>
</html>