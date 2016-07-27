<?php
$method = filter_input(INPUT_GET, "method", FILTER_SANITIZE_STRING);
$msg = filter_input(INPUT_GET, "msg", FILTER_SANITIZE_STRING);
if($method=="add")
 header("Location: $_SERVER[SCRIPT_NAME]?msg=1");
include("head.php");
if($logged_in)
{
if($user_level <= 1)
{
 if($msg=="1")
  echo '<font color="white">News item successfully added</font>';
 else
  echo '<br>';
 if($method=="add")
 {
  $date = date("M d, Y");
  $query = "INSERT INTO news (category,message,`date`) VALUES ('$category','$message','$date')";
  mysql_query($query,$conn);
 }
 else
 {
?>
<table border="0" cellpadding="3" width="80%">
<tr><th align="left">Category</th><th align="left">News item</th><th>Date</th></tr>
<?php
 $result = mysql_query("SELECT * FROM news ORDER BY id DESC");
 while($row = mysql_fetch_array($result))
         $color = $result['color'];
 {
  if($row["category"]=="Site update")
   $color = "#ff0000";
  elseif($row["category"]=="Maintenance")
   $color = "#800080";
  elseif($row["category"]=="Community")
   $color = "#0000ff";
  elseif($row["category"]=="Reminder")
   $color = "green";
  echo '<tr>';
  echo '<td><font color="'.$color.'">'.$row["category"].'</font></td>';
  echo '<td><font color="'.$color.'">'.$row["message"].'</font></td>';
  echo '<td align="center"><font color="#FFFFFF">'.$row["date"].'</font></td>';
  echo '</tr>';
 }
?>
</table>
<br><br>
<table border="0" width="600">
<?php
 echo '<tr>';
 echo '<form method="POST" action="?method=add">';
 echo '<th>category:</th><td><select name="category"><option value="Site update">Site update</option><option value="Maintenance">Maintenance</option><option value="Community">Community</option><option value="Reminder">Reminder</option></select></td>';
 echo '<th>news item:</th><td><input type="text" name="message" size="30"></td>';
 echo '<td><input type="submit" value="Add Item"></td>';
 echo '</form>';
 echo '</tr>';
?>
</table>
<?php
 }
}
else
 echo 'You\'re now allowed to see this page.';
 }
 else
  echo 'Not logged in.';
?>