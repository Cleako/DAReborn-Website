<body bgcolor=000000>
<table border="1" bordercolor=FF0000 cellpadding=0 cellspacing=0 width="100%">
<tr><th align="left">Category</th><th align="center">News item</th><th>Date</th></tr>
<?php
include("style.css");
include("database.php");

 $result = mysql_query("SELECT * FROM news ORDER BY id DESC");
 while($row = mysql_fetch_array($result))
 $color = $result["color"];
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
<br /><br />