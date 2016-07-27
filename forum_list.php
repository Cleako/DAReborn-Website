<?php
include("head3.php");
if($logged_in)
{

 $a_table = "forum_list";
 $a_result = mysql_query("SELECT * FROM $a_table ORDER BY id ASC");
 $b_table = "forum";
 $num = 1;
 echo '<table border="0" cellpadding="0" cellspacing="0" align="center" bordercolor="000000" width="600">';
 echo '<tr><td>';
 echo '<table border="1" cellpadding="0" cellspacing="0" bordercolor="000000" align="center" width="100%">';
 echo '<tr><th align="center">Board</th><th align="center">Topics</th><th align="center"># of posts</th><th align="center">Last post @</th></tr>';
 while ($a_row = mysql_fetch_array($a_result))
 {
    $b_result = mysql_query("SELECT * FROM $b_table WHERE topic='1' AND board='".$a_row["id"]."'");
    $topics = mysql_num_rows($b_result);
    $b_result = mysql_query("SELECT * FROM $b_table WHERE board='".$a_row["id"]."'");
    $posts = mysql_num_rows($b_result);
    if($num%2==0)
       echo '<tr class="one">';
    else
       echo '<tr class="two">';
    echo '<td><left><a href="forum.php?area='.$a_row["id"].'&lastpost='.$a_row["timestamp"].'" class="visit">'.$a_row["forum"].'</a><br><small>'.$a_row["description"].'</small></td>';
    echo '<td><center>'.$topics.'</td>';
    echo '<td><center>'.$posts.'</td>';
    echo '<td><center>'.$a_row["lastpost"].'</td>';
    echo '</tr>';
    $num++;
 }
 echo '</table>';
 echo '</td></tr>';
 echo '</table>';
}
else
 echo 'Not logged in.';
include("foot.php");
?>
