<?php
$topic_id = filter_input(INPUT_GET, "tid", FILTER_SANITIZE_STRING);
$stage = filter_input(INPUT_GET, "stage", FILTER_SANITIZE_STRING);
$msg = filter_input(INPUT_GET, "msg", FILTER_SANITIZE_STRING);
if($stage=="update"&&isset($vote))
 header("Location: $_SERVER[SCRIPT_NAME]?msg=1");
elseif($stage=="update"&&!isset($vote))
 header("Location: $_SERVER[SCRIPT_NAME]?msg=2");
include("head.php");
if($stage=="update"&&isset($vote))
{
 $result = mysql_query("SELECT * FROM poll WHERE id='$topic_id'");
 $row = mysql_fetch_array($result);
 $total = $row["total"]+1;
 $update = $row["votes$vote"]+1;
 $query = "UPDATE poll SET `votes$vote`='$update', total='$total' WHERE id='$topic_id'";
 mysql_query($query,$conn);
 $result = mysql_query("SELECT * FROM users WHERE username='$username'");
 $row = mysql_fetch_array($result);
 $voting = $row["voting"];
 if($voting=="")
  $voting = $topic_id;
 else
  $voting = "$voting,$topic_id";
 $query = "UPDATE users SET voting='$voting' WHERE username='$username'";
 mysql_query($query,$conn);
}

if($logged_in)
{
 $num = 1;
 if($msg=="1")
  print "<font color=\"000000\">Successfully Voted</font>";
 elseif($msg=="2")
  print "<font color=\"000000\">Select an answer before submiting poll</font>";

 $result = mysql_query("SELECT * FROM users WHERE username='$username' LIMIT 1");
 $row = mysql_fetch_array($result);
 $voting = $row["voting"];
 $voting = explode(",",$voting);
 $result = mysql_query("SELECT * FROM poll");
 while($row = mysql_fetch_array($result))
 {
  $status = $row["status"];
  for($i=0;$i!=count($voting);$i++)
  {
   if($voting[$i]==$row["id"])
   {
    $status = "close";
    break;
   }
  }
  if($status=="open"||$status=="close")
  {
   $total = $row["total"];
   if($total=="0")
    $total++;
   print "<form method=\"POST\" action=\"$_SERVER[SCRIPT_NAME]?stage=update&tid=".$row["id"]."\">";
   print "<table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"000000\">";
   print "<tr><td>";
   print "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" width=\"375\" bordercolor=\"000000\">";
   print "<tr><td colspan=\"3\"><small>Total votes: ".$row["total"]."</small></td></tr>";   
print "<tr><td colspan=\"3\">".$row["question"]."</td></tr>";

   for($i=1;$i!=7;$i++)
   {
    if($row["answer$i"]!="")
    {
     if($i%2==1)
      print "<tr class=\"one\">\n";
     else
      print "<tr class=\"two\">\n";
     print "<td width=\"100\"><font color=\"#000000\"><small>".$row["answer$i"]."</small></font></td><td width=\"185\"><table border=\"0\" width=\"100%\"><td width=\"35\"><font color=\"#000000\"><small>".round(($row["votes$i"]/$total)*100)."%</small></font></td><td width=\"150\"><table border=\"0\" width=\"";
     if(round(($row["votes$i"]/$total)*100)!="0")
      print round(($row["votes$i"]/$total)*100)."%";
     else
      print "1";
     print "\"><tr><td style=\"background:#1432AF\" width=\"100%\">&nbsp;</td></tr></table></td></tr></table></td><td align=\"center\" width=\"50\"><input type=\"radio\" name=\"vote\" value=\"$i\"";
     if($status=="close")
      print " DISABLED";
     print "></td></tr>";
    }

    else
     $i = "6";
   }
   print "<tr><td colspan=\"2\">";
   if($status=="close")
    print "<small>Closed: this poll has either been closed by an admin, or you have already voted for it.</small>";
   else
    print "&nbsp;";
   print "</td><td align=\"center\"><input type=\"submit\" value=\"Vote!\"";
   if($status=="close")
    print " DISABLED";
   print "></td></tr>";
   print "</table>";
   print "</td></tr>";
   print "</table>";
   print "</form>\n";
  }
 }
}
else
 echo 'Not logged in.';
include("foot.php");
?>
