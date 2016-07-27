<?php
$pattern = array();
$replace = array();
$pattern[] = '/\[url=(.+)\](.+)\[\/url\]/i';
$replace[] = '<a href="traffic.php?url=\\1" class="visit">\\2</a>';
$pattern[] = '/\[img=(.+)\]/i';
$replace[] = '<img src="\\1">';
$pattern[] = '/\[b](.+)\[\/b\]/i';
$replace[] = '<b>\\1</b>';
$pattern[] = '/\[i](.+)\[\/i\]/i';
$replace[] = '<i>\\1</i>';
$pattern[] = '/\[u](.+)\[\/u\]/i';
$replace[] = '<u>\\1</u>';
$pattern[] = '/\[s](.+)\[\/s\]/i';
$replace[] = '<s>\\1</s>';
$pattern[] = '/\[left](.+)[\/left]/i';
$replace[] = '<p align="left">\\1</p>';
$pattern[] = '/\[center](.+)[\/center]/i';
$replace[] = '<p align="center">\\1</p>';
$pattern[] = '/\[right](.+)[\/right]/i';
$replace[] = '<p align="right">\\1</p>';

include("head.php");
include("database.php");
if($logged_in)
{
 if($user_level <= 1)
 {
$msg = "";
$catname = "";
$catdesc = "";



if(isset($_POST['Submit']))
{

	$catname = $_POST['catname'];
	$catdesc = $_POST['catdesc'];
	$nummer = $_POST['nummer'];
	if(!isset($_GET['catid']))
	{
		$result = mysql_query("Insert into categories(catname,catdesc, nummer) values('$catname','$catdesc', '$nummer')");
		$msg = "New record is saved";
	}
	else
	{
		$result = mysql_query("Update categories set catname='$catname', catdesc='$catdesc', nummer='$nummer' where catid=".$_GET['catid']);
		$msg = "Record is updated";
	}
}
if(isset($_GET['catid']))
{
	$result = mysql_query("Select * From categories where catid=".$_GET['catid'],$conn);
	$row = mysql_fetch_array($result, MYSQL_BOTH);
	$catname = $row['catname'];
	$catdesc = $row['catdesc'];
$nummer = $row['nummer'];
}
?>
<html>
<head>
<title>Admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<h3>New/Edit Record</h3>
<p><a href="listrecord.php">List of pages.</a><br>
<p><?php echo $msg?></p>
<form name="form1" method="post" action="">
  <p>&nbsp;</p>
  <table width="54%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr> 
      <td width="42%"><strong>Title</strong></td>
      <td width="58%"><input name="catname" type="text" id="catname" value="<?php echo $catname?>"></td>
    </tr>
    <tr> 
      <td width="42%"><strong>Rank</strong></td>
      <td width="58%"><input name="nummer" type="text" id="nummer" value="<?php echo $nummer?>"></td>
    </tr>
    <tr> 
      <td><strong>Content.</strong></td>
      <td><textarea name="catdesc" id="textarea2" rows=15 cols=50 maxlength=500000><?php echo $catdesc?></textarea></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Submit">
        <input type="reset" name="Submit2" value="Reset"></td>
    </tr>
  </table>
  <p>&nbsp; </p>
  <p>&nbsp;</p>
</form>
<?php
 }
 else
  echo 'You\'re now allowed to see this page';
}
else
 echo 'Not logged in.';
include("foot.php");
?>