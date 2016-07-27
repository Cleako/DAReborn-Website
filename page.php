<?php
include("head.php");
if($logged_in)
{
 
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

$msg = "";
$catname = "";
$catdesc = "";


if(isset($_GET['catid']))
{
	$result = mysql_query("Select * From categories where catid=".$_GET['catid'],$conn);
	$row = mysql_fetch_array($result, MYSQL_BOTH);
	$catname = $row['catname'];
	$catdesc = $row['catdesc'];


      $catdesc = preg_replace($pattern,$replace,$row["catdesc"]);
$catdesc = nl2br($catdesc);
}
?>



<?php echo $catdesc?>

<?php
}
else
 echo 'Not logged in.';


include("foot.php");
?>