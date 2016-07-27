<?php
include("head.php");
if($logged_in)
{
 if($user_level <= 1)
 {
$msg = "";

if(isset($_POST['Delete']))
{
	$total = $_POST['total'];
	$td = 0;
	$i = 0;
	
	for($i = 1; $i <= $total; $i++)
	{
		if(isset($_POST["d$i"]))
		{
			mysql_query("DELETE FROM categories WHERE catid=".$_POST["d$i"],$conn);
			$td++;
		}
	}

	$msg = "$td record(s) deleted!";
}



$result = mysql_query("Select * from categories order by nummer");

$n = 0;
?>
<h3>List of Pages.</h3>
<p><?php echo $msg?></p>
<form name="form1" method="post" action="">
  <p>&nbsp;</p>
  <table width="49%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr bgcolor="#CCCCCC"> 
      <td width="3%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
<td width="3%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Rank</font></td>
      <td width="97%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Title</strong></font></td>
    </tr>
    <?php while($row = mysql_fetch_array($result, MYSQL_BOTH)){
$n++;
?>
    <tr> 
      <td><input type="checkbox" name="d<?php echo $n;?>" value="<?php echo $row['catid'];?>"></td>
      <td><?php echo $row['nummer']?></td>
      <td><a href="newrecord.php?catid=<?php echo $row['catid']?>"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row['catname'];?></font></a></td>
    </tr>
    <?php

 }?>
    <tr> 
      <td><input type="submit" name="Delete" value="Delete"> <input name="total" type="hidden" id="total" value="<?php echo $n?>"></td>
<td></td>
<td></td>
      
    </tr>
  </table>
<p>&nbsp;</p></form>
<p>&nbsp;</p>
<?php
 }
 else
  echo 'You\'re now allowed to see this page';
}
else
 echo 'Not logged in.';
include("foot.php");
?>