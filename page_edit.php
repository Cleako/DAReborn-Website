<?php
include("head.php");
if($logged_in)
{
 if($user_level <= 1)
 {
?>

<h4 align="center"><font face="Geneva, Arial, Helvetica, sans-serif">Page Control</font></h4>
<table width="76%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor=000000>
  <tr> 
    <td width="3%" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td width="97%" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Options</strong></font></td>
  </tr>
  <tr> 
    <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
  </tr>
  <tr> 
    <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="newrecord.php">Add Pages</a></font></td>
  </tr>
  <tr> 
    <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="listrecord.php">Edit/Remove Pages</a></font></td>
  </tr>
  <tr> 
    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
  </tr>
</table>

</body>
</html>
<?php
 }
 else
  echo 'You\'re now allowed to see this page';
}
else
 echo 'Not logged in.';
include("foot.php");
?>