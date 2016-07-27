<?php 
/* Include Files *********************/
include("head.php");
/*************************************/

if($logged_in){

?>
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


$sql = "SELECT catdesc FROM categories WHERE catid = 1";
$result = mysql_query($sql);
while ($row = mysql_fetch_assoc($result)) {
      $catdesc = preg_replace($pattern,$replace,$row["catdesc"]);
      $catdesc = nl2br($catdesc);



}

?>
<center>Welcome <?php echo $username; ?>, you are logged in now.<BR><BR>
<BR>
<BR>
<h1>To do list:</h1><BR>
<>Install a html/bbcode parser for the forum<BR>
<>Fix the account setup to update passwords with MD5 encryption<BR>
<BR><BR>
<div align="center" id="cboxdiv">
<iframe frameborder="0" width="200" height="305" src="http://www.cbox.ws/box/?boxid=105041&amp;boxtag=7409&amp;sec=main" marginheight="2" marginwidth="2" scrolling="auto" allowtransparency="yes" name="cboxmain" style="border: 0px solid;" id="cboxmain"></iframe><br/>
<iframe frameborder="0" width="200" height="75" src="http://www.cbox.ws/box/?boxid=105041&amp;boxtag=7409&amp;sec=form" marginheight="2" marginwidth="2" scrolling="no" allowtransparency="yes" name="cboxform" style="border: 0px solid;border-top:0px" id="cboxform"></iframe>
</div>
<br /><br />
<div align="center" id="news">
<iframe frameborder="0" width="80%" height="100" src="readnews.php" marginheight="2" marginwidth="2" scrolling="auto" allowtransparency="yes" name="news" style="border: 0px solid;" id="news"></iframe>

<?php

}else{
   echo 'Logging in...';
}
?>

<?php 
/* Include Files *********************/
include("foot.php");
/*************************************/
?>