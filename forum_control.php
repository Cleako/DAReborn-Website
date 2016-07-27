<?php
$forum_id = filter_input(INPUT_GET, "fid", FILTER_SANITIZE_STRING);
$stage = filter_input(INPUT_GET, "stage", FILTER_SANITIZE_STRING);
$type = filter_input(INPUT_GET, "type", FILTER_SANITIZE_STRING);
$msg = filter_input(INPUT_GET, "msg", FILTER_SANITIZE_STRING);
if($stage=="create")
 header("Location: $_SERVER[SCRIPT_NAME]?msg=1");
elseif($stage=="update")
 header("Location: $_SERVER[SCRIPT_NAME]?msg=2");
elseif($stage=="delete")
 header("Location: $_SERVER[SCRIPT_NAME]?msg=4.1");
elseif($stage=="empty")
 header("Location: $_SERVER[SCRIPT_NAME]?msg=4.2");
include("head.php");
if($logged_in)
{
 if($user_level <= 1)
 {
  if($msg=="1")
   print "<font color=\"000000\">Forum Successfully Created</font>";
  elseif($msg=="2")
   print "<font color=\"000000\">Forum Successfully Updated</font>";
  elseif($msg=="3.1")
   print "<font color=\"000000\">Forum Deletion Canceled</font>";
  elseif($msg=="3.2")
   print "<font color=\"000000\">Forum Emptying Canceled</font>";
  elseif($msg=="4.1")
   print "<font color=\"000000\">Forum Successfully Deleted</font>";
  elseif($msg=="4.2")
   print "<font color=\"000000\">Forum Successfully Emptied</font>";
  if($stage=="update")
  {
   $num = "1";
   $result = mysql_query("SELECT * FROM forum_list");
   while($row = mysql_fetch_array($result))
   {
    $query = "UPDATE forum_list SET description='$description[$num]', forum='$forum[$num]' WHERE id='".$row["id"]."'";
    mysql_query($query,$conn);
    $num++;
   }
  }
  if(!(isset($stage)))
  {
   $num = 1;
   print "<table border=\"1\" bordercolor=\"000000\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">";
   print "<tr><td><h1><center>Current Forums:</h1></td></tr>";
   print "<tr><td>";
   print "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"000000\" align=\"center\">";
   print "<tr><th>#</th><th>forum name</th><th></th><th>description</th><th></th><th colspan=\"3\"><small>extra controls</small></th></tr>";
   print "<form method=\"POST\" action=\"$_SERVER[SCRIPT_NAME]?stage=update\">";
   $result = mysql_query("SELECT * FROM forum_list");
   while($row = mysql_fetch_array($result))
   {
    print "<tr>";
    print "<td>$num</td>";
    print "<td><input type=\"text\" name=\"forum[$num]\" maxlength=\"35\" value=\"".$row["forum"]."\"></td>";
    print "<td width=\"10\"></td>";
    print "<td><textarea name=\"description[$num]\" cols=\"20\" rows=\"3\">".$row["description"]."</textarea></td>";
    print "<td width=\"10\"></td>";
    print "<td align=\"center\"><small><a href=\"$_SERVER[SCRIPT_NAME]?stage=confirm&type=empty&fid=".$row["id"]."\">empty forum</a></small></td>";
    print "<td width=\"10\"></td>";
    print "<td align=\"center\"><small><a href=\"$_SERVER[SCRIPT_NAME]?stage=confirm&type=delete&fid=".$row["id"]."\">delete forum</a></small></td>";
    print "</tr>";
    $num++;
   }
   print "<tr><td colspan=\"5\"><input type=\"submit\" value=\"Update\">&nbsp;&nbsp;<input type=\"reset\"></td></tr>";
   print "</form>";
   print "</table>";
   print "</td></tr>";
   print "</table>";
   print "<br><br>";
   print "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"000000\" align=\"center\">";
   print "<tr><td><h1>New Forum:</h1></td></tr>";
   print "<tr><td>";
   print "<table border=\"1\" cellpadding=\"1\" cellspacing=\"3\" align=\"center\">";
   print "<tr><th>forum name</th><th></th><th>description</th></tr>";
   print "<form method=\"POST\" action=\"$_SERVER[SCRIPT_NAME]?stage=create\">";
   print "<tr>";
   print "<td><input type=\"text\" name=\"forum\" maxlength=\"35\"></td>";
   print "<td width=\"10\">&nbsp;</td>";
   print "<td><textarea name=\"description\" cols=\"25\" rows=\"3\"></textarea></td>";
   print "</tr>";
   print "<tr><td><input type=\"submit\" value=\"Create\">&nbsp;&nbsp;<input type=\"reset\"></td></tr>";
   print "</form>";
   print "</table>";
   print "</td></tr>";
   print "</table>";
  }
  elseif($stage=="create")
  {
   $query = "INSERT INTO forum_list (forum,description) values ('$forum','$description')";
   mysql_query($query,$conn);
  }
  elseif($stage=="confirm")
  {
   $result = mysql_query("SELECT * FROM forum_list WHERE id='$forum_id'");
   $row = mysql_fetch_array($result);
   echo '<font color="white">Are you sure you want to '.$type.' forum id #'.$forum_id.' ('.$row["forum"].')?</font><br>';
   echo '<a href="'.$_SERVER['SCRIPT_NAME'].'?stage='.$type.'&fid='.$forum_id.'">Yes, '.$type.'</a>&nbsp;&nbsp;<a href="'.$_SERVER['SCRIPT_NAME'].'?msg=3';
   if($type=="delete")
    echo '.1';
   else
    echo '.2';
   echo '">No, cancel</a>';
   exit;
  }
  elseif($stage=="delete"||$stage=="empty")
  {
   $query = "DELETE FROM forum";
   if($stage=="delete")
    $query .= "_list";
   $query .= " WHERE ";
   if($stage=="delete")
    $query .= "id";
   else
    $query .= "board";
   $query .= "='$forum_id'";
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