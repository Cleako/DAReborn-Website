<?php
/* Include Files *********************/
session_start();
include("head.php");



/*************************************/

if($logged_in)  {

$result = mysql_query("SELECT * FROM users WHERE username='$username'");

while($row = mysql_fetch_assoc($result))
   $user_level = $row["user_level"];
if ($user_level <= 100)
{
?>
<body bgcolor="#000000" text="#0000FF" link="#0000FF" alink="#0080FF">

<p>&nbsp;</p>

<p>&nbsp;</p>

<p align="center"><big><big><big><big><strong>DawnZombie Moviez</strong></big></big></big></big></p>

<p align="center"><font color="#FF0000">**</font><font color="#FFFFFF"><strong><u>An
Absolute must watch</u></strong></font><font color="#FF0000">**</font><font
color="#0000FF"><br>
<strong><big><big>It is recommended that you watch them in order</big></big></strong></font></p>

<table border="1" width="100%" bordercolor="#008080" cellspacing="1"
bordercolorlight="#000080" bordercolordark="#000000" height="450">
  <tr>
    <td width="50%" align="center" height="28"><font color="#FFFFFF" face="Comic Sans MS"><big><strong>M0ViEZ</strong></big></font></td>
    <td width="50%" height="28"><p align="left"><small><font color="#FFFFFF"
    face="Comic Sans MS"><strong>If picture next to movie shows, then movie works</strong></font></small></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="19"><a
    href="http://www.angelfire.com/dragon/annihilators2/promo.htm" target="_blank"><font
    face="Arial">Dragon Annihilators Clan Promotional Video </font></a></td>
    <td width="50%" height="19"><img src="http://www.dracconian.net/cleako/bandwidthok.jpg"
    width="196" height="30"></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="19"><a
    href="http://www.angelfire.com/dragon/annihilators2/stupidnoobs1.htm" target="_blank"><font
    face="Arial">Stupid Noobs 1</font></a></td>
    <td width="50%" height="19"><img src="http://www.dracconian.net/cleako/bandwidthok.jpg"
    width="196" height="30"></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="19"><a
    href="http://www.angelfire.com/dragon/annihilators2/stupidnoobs2.htm" target="_blank"><font
    face="Arial">Stupid Noobs 2</font></a></td>
    <td width="50%" height="19"><img src="http://www.dracconian.net/cleako/bandwidthok.jpg"
    width="196" height="30"></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="19"><a
    href="http://www.angelfire.com/dragon/annihilators2/stupidnoobs31.htm" target="_blank"><font
    face="Arial">Stupid Noobs 3 part 1</font></a></td>
    <td width="50%" height="19"><img src="http://www.dracconian.net/cleako/bandwidthok.jpg"
    width="196" height="30"></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="19"><a
    href="http://www.angelfire.com/dragon/annihilators2/stupidnoobs32.htm" target="_blank"><font
    face="Arial">Stupid Noobs 3 part 2</font></a></td>
    <td width="50%" height="19"><img src="http://www.dracconian.net/cleako/bandwidthok.jpg"
    width="196" height="30"></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="19"><a
    href="http://www.dracconian.net/cleako/weedman.html" target="_blank"><font face="Arial">The
    Weedman</font></a></td>
    <td width="50%" height="19"><img src="http://www.dracconian.net/cleako/bandwidthok.jpg"
    width="196" height="30"></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="19"><a
    href="http://www.angelfire.com/dragon/annihilators2/march16pk.htm" target="_blank"><font
    face="Arial">March 16th PK trip</font></a></td>
    <td width="50%" height="19"><img src="http://www.dracconian.net/cleako/bandwidthok.jpg"
    width="196" height="30"></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="19"><a
    href="http://www.angelfire.com/dragon/annihilators2/soad.htm" target="_blank"><font
    face="Arial">Erez Gold's Cousin's VIDEO</font></a></td>
    <td width="50%" height="19"><img src="http://www.dracconian.net/cleako/bandwidthok.jpg"
    width="196" height="30"></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="19"><a
    href="http://www.angelfire.com/dragon/annihilators2/crackcat.htm" target="_blank"><font
    face="Arial">Cat on crack movie</font></a></td>
    <td width="50%" height="19"><img src="http://www.dracconian.net/cleako/bandwidthok.jpg"
    width="196" height="30"></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="38"><a
    href="http://www.dracconian.net/cleako/april72004pk.html" target="_blank">April 7th 2004
    PK TRIP</a></td>
    <td width="50%" height="38"><img src="http://www.dracconian.net/cleako/bandwidthok.jpg"
    width="196" height="30"></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="38"><a
    href="http://www.dracconian.net/cleako/april82004pk.html" target="_blank">April 8th 2004
    PK TRIP</a></td>
    <td width="50%" height="38"><img src="http://www.dracconian.net/cleako/bandwidthok.jpg"
    width="196" height="30"></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="38"><a
    href="http://www.dracconian.net/cleako/pktripjune26.html" target="_blank">The Lost movie
    of the PK Trip of June 26 2003</a>**NEW <br>
    -<a href="http://www.dracconian.net/cleako/pktripjune262.html" target="_blank">Part 2</a>-</td>
    <td width="50%" height="38"><img src="http://www.dracconian.net/cleako/bandwidthok.jpg"
    width="196" height="30"></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="19"><strong><big>BELOW ARE THE DZ MOVIES</big></strong></td>
    <td width="50%" height="19"></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="19"><a
    href="http://www.dracconian.net/cleako/dawnzombiebanner.html" target="_blank"><strong><big>DAWNBUGGIE
    AD</big></strong></a></td>
    <td width="50%" height="19"><img src="http://www.dracconian.net/cleako/bandwidthok.jpg"
    width="196" height="30"></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="19"><big><strong>*<a
    href="http://www.dracconian.net/cleako/dawnzombie.html" target="_blank">DAWNZOMBIE MOVIE
    (1)</a>*</strong></big></td>
    <td width="50%" height="19"><img src="http://www.dracconian.net/cleako/bandwidthok.jpg"
    width="196" height="30"></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="41"><big><strong>**<a
    href="http://www.dracconian.net/cleako/dz2movie.html" target="_blank">DZ RELOADED
    (2):&nbsp; RISE OF TOWELON</a>**</strong></big></td>
    <td width="50%" height="41"><img src="http://www.dracconian.net/cleako/bandwidthok.jpg"
    width="196" height="30"></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="41"><big><strong><a
    href="http://www.dracconian.net/cleako/EAF.html" target="_blank">DZ3 (Still in production)</a></strong></big></td>
    <td width="50%" height="41"><img src="http://www.dracconian.net/cleako/bandwidthok.jpg"
    width="196" height="30"></td>
  </tr>
  <tr>
    <td width="50%" align="center" height="41"></td>
    <td width="50%" height="41"></td>
  </tr>
</table>
<?php
}else{
echo 'You\'re not allowed to see this page';
}
 }else{
   echo 'Not logged in.';
}
include("foot.php");
?>


